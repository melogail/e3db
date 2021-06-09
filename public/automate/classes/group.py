from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from .scrape import Scrape
import re, time


class Group(Scrape):
    def __init__(self, driver_path, user_data_dir, chrome_profile_name):
        super().__init__(driver_path, user_data_dir, chrome_profile_name)

    def scrape(self):
        pass

    def get_group_information(self):
        """
        Scrape group information, link group name... etc

        :return:
        """
        # Navigate to group information page

        # Get group Name
        group_name = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.TAG_NAME, 'header'))
        )

        try:
            group_name = group_name.find_element_by_tag_name('h3')
            self.insert_data({'group_name': group_name.text})

        except:
            # Cannot extract group name
            pass

        return self

    def scrape_members(self):
        """
        Get and click on "Members" link.

        :return:
        """

        # Get members link
        members_link = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.XPATH, '//a[contains(@href, "%s")]' % 'view=members'))
        )

        # click on members link
        ## TODO::UNCOMMENT
        members_link.get_attribute('href')

        self.driver.get(members_link.get_attribute('href'))

        return self

    def scrape_admins(self):
        """
        Navigate to admins members list

        :return:
        """

        # Find the "See All" link for page admin sector

        try:
            link = self.driver.find_element_by_xpath('//a[contains(@href, "%s")]' % 'list_admin_moderator')
            self.driver.get(link.get_attribute('href'))

        except:
            # Not find link abort process
            print('cannot find button')
            return False

        return self

    def scrape_friends(self):
        """
        Navigate to friends members list

        :return:
        """

        # Find the "See All" link for page admin sector
        try:
            link = self.driver.find_element_by_xpath('//a[contains(@href, "%s")]' % 'list_friend')
            self.driver.get(link.get_attribute('href'))
        except:
            # Not find link abort process
            print('cannot find button for collecting friends')
            return False

        return self

    def scrape_other_members(self):
        """
        Navigate to other group members list

        :return:
        """

        # Find the "See All" link for page admin sector
        try:
            link = self.driver.find_element_by_xpath('//a[contains(@href, "%s")]' % 'list_nonfriend_nonadmin')
            self.driver.get(link.get_attribute('href'))
        except:
            # Not find link abort process
            return False

        return self

    def collect_users_data(self):

        # Try to make infinite loop if there are more members
        try:
            print('scrolling')
            scroll_pause_time = 2
            screen_height = self.driver.execute_script("return window.screen.height;")
            i = 1

            # Loop until no more loading
            while True:
                self.driver.execute_script(
                    "window.scrollTo(0, {screen_height}*{i});".format(screen_height=screen_height, i=i))
                i += 1
                time.sleep(scroll_pause_time)

                # update the scrolling height
                scroll_height = self.driver.execute_script("return document.body.scrollHeight;")

                if screen_height * i > scroll_height:
                    print('no more scrolling')
                    break

        except:
            # if there is no load more, continue collecting data
            print('no more scrolling')
            time.sleep(3)
            pass

        # After finishing load more users, collect users data
        users = []
        users_el = WebDriverWait(self.driver, 10).until(
            EC.presence_of_all_elements_located(
                (By.XPATH, '//div[contains(@id, "member_")]'))
        )
        print(len(users_el))

        # loop through each element and extract id and user name
        for el in users_el:
            try:
                user_name = el.find_element_by_xpath('.//div[@aria-hidden="true"]').find_element_by_tag_name('h3')
                users.append({"user_id": re.findall(r"[0-9].*", el.get_attribute('id'))[0], "user_username": None,
                              "user_name": user_name.text})
            except:
                try:
                    user_name = el.find_element_by_xpath('.//div[@aria-hidden="true"]').find_element_by_tag_name('h1')
                    users.append({"user_id": re.findall(r"[0-9].*", el.get_attribute('id'))[0], "user_username": None,
                                  "user_name": user_name.text})
                except:
                    print('cannot find user name')

        # Insert users data to data object
        print(users)
        self.insert_data({'users': users})

        return self

    def back_to_group_members_page(self):
        """
        Navigate back to group memebers page
        :return:
        """
        # Navigate to the group page
        self.driver.get(self.fb_link + 'groups/' + self.data['group_id'] + '?view=members')

        return self
