from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from .scrape import Scrape

import re
import time
import json


class Post(Scrape):
    def __init__(self, driver_path, user_data_dir, chrome_profile_name):
        super().__init__(driver_path, user_data_dir, chrome_profile_name)

    def get_post_data(self):
        """
        Collect some information from the post

        :return:
        """
        # Get post data
        try:
            post_data_div = WebDriverWait(self.driver, 10).until(
                EC.presence_of_element_located((By.XPATH, '//div[@data-ft]'))
            )
            # Get post data as JSON format
            post_data = json.loads(post_data_div.get_attribute('data-ft'))
        except:
            print("Cannot get post data")

        # Get post information
        try:
            # In case post was published on group

            # Get post group name
            post_group_name = self.driver.find_element_by_xpath(
                './/a[contains(@href, "%s")]' % 'facebook.com/groups').text

            # Add post data to data object
            post_dic = {'post_group_name': post_group_name, 'post_group_id': post_data['page_id'],
                        'post_id': post_data['top_level_post_id']}

        except:

            # In case the post was published on page
            try:
                # Get post page header to get name of group or page
                header = WebDriverWait(self.driver, 10).until(
                    EC.presence_of_element_located((By.TAG_NAME, 'header'))
                )

                page_info = header.find_element_by_tag_name('h3').find_element_by_tag_name('a')
                page_name = page_info.text

                # Add post data to data object
                post_dic = {'post_page_name': page_name, 'post_page_id': post_data['page_id'],
                            'post_id': post_data['top_level_post_id']}

            except:
                print('Cannot find page information')
                return False

        self.insert_data(post_dic)

        return self

    def collect_users_data(self, collect_type):
        """
        Collect users data from post
        :param collect_type:
        :return:
        """

        if not collect_type:
            print('You have to specify data collection type')
            return False

        # Collect Reacts
        if collect_type == 'reacts':
            self.collect_from_reacts()

        elif collect_type == 'comments':
            self.collect_from_comments()

        return self

    # TODO::Change this method to be private
    def collect_from_reacts(self):
        """
        Collect post reacts

        :return:
        """
        print('Collecting Reacts')

        # if the post is from page
        if 'post_page_id' in self.data:
            self.driver.get(
                f'https://m.facebook.com/{self.data["post_id"]}')

        elif 'post_group_id' in self.data:
            self.driver.get(
                f'https://m.facebook.com/{self.data["post_id"]}/')

        # Navigate to post reacts page
        reacts_link = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, '//a[contains(@href, "ufi/reaction/profile/browser")]'))
        )

        self.driver.get(reacts_link.get_attribute('href'))

        # Wait for 3 seconds
        time.sleep(3)

        # COLLECT DATA
        # First find all "See More" button using button id
        view_more_press_counter = 0
        while view_more_press_counter < 60:
            try:
                # Find the First "See more" link
                see_more_div = WebDriverWait(self.driver, 10).until(
                    EC.presence_of_element_located((By.ID, 'reaction_profile_pager'))
                )
                see_more_link = see_more_div.find_element_by_tag_name('a')
                see_more_link.click()
                time.sleep(3)
            except:
                print('All reacts are shown')
                break
            view_more_press_counter += 1

        if view_more_press_counter >= 60:
            print('We have reached collection limit.')

        # Get all users and collect data
        all_reacts = self.driver.find_elements_by_class_name('_1uja')
        print('Collecting Data...')
        # Add users as list of dict
        users = []
        for user in all_reacts:
            user_profile_data = user.find_element_by_class_name('_4mn').find_element_by_tag_name('a')
            user_id = None
            user_username = None

            # Try get user id or username
            try:
                user_id = re.findall(r'profile\.php\?id=(.*)&', user_profile_data.get_attribute('href'))[0]
            except:
                user_username = re.findall(r'facebook\.com\/(.*)\?', user_profile_data.get_attribute('href'))[0]

            # Get user name
            user_name = user_profile_data.find_element_by_tag_name('strong').text

            # Append user data to users list
            users.append({'user_id': user_id, 'user_username': user_username, 'user_name': user_name})

        # Adding users data to data object
        self.insert_data({'users': users})
        print('Data collected.')

    def collect_from_comments(self):
        """
        Collecting comments from post
        :return:
        """
        # if the post is from page
        if 'post_page_id' in self.data:
            self.driver.get(
                f'https://m.facebook.com/{self.data["post_id"]}')

        elif 'post_group_id' in self.data:
            self.driver.get(
                f'https://m.facebook.com/{self.data["post_id"]}/')

        # wait for 2 seconds
        time.sleep(2)

        # First, show all comments
        view_more_press_counter = 0
        while view_more_press_counter < 20:
            try:
                # Find the First "See more" link
                see_more_div = WebDriverWait(self.driver, 10).until(
                    EC.presence_of_element_located((By.XPATH, '//div[contains(@id, "%s")]' % 'see_next_'))
                )
                see_more_link = see_more_div.find_element_by_tag_name('a')
                see_more_link.click()
                time.sleep(3)
            except:
                print('All comments are shown')
                break
            view_more_press_counter += 1

        if view_more_press_counter >= 20:
            print('We have reached collection limit.')

        # Get all users and collect data
        try:
            all_comments = self.driver.find_elements_by_class_name('_2b04')
            print('Collecting Data...')
        except:
            print('Failed to collect comments')

        # Add users as list of dict
        users = []
        for user in all_comments:
            user_profile_data = user.find_element_by_class_name('_2b05').find_element_by_tag_name('a')
            user_id = None
            user_username = None

            # Try get user id or username
            try:
                user_id = re.findall(r'profile\.php\?id=(.*)&group', user_profile_data.get_attribute('href'))[0]
            except:
                user_username = re.findall(r'facebook\.com\/(.*)\?', user_profile_data.get_attribute('href'))[0]

            # Get user name
            user_name = user_profile_data.text

            # Append user data to users list
            users.append({'user_id': user_id, 'user_username': user_username, 'user_name': user_name})

        # Adding users data to data object
        self.insert_data({'users': users})
        print('Data collected.')
