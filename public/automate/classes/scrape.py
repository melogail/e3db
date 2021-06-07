from selenium import webdriver
from selenium.webdriver.common.keys import Keys
import time
import re


class Scrape(object):
    def __init__(self, driver_path, user_data_dir=None, chrome_profile_name=None):
        self.fb_link = 'https://m.facebook.com/'
        self.driver_path = driver_path
        self.driver = None
        self.user_data_dir = user_data_dir
        self.chrome_profile_name = chrome_profile_name
        self.link_back = 0
        self.data = {}

    def open_browser(self):
        """
        Open web browser, and start web driver object

        :return:
        """
        try:
            options = webdriver.ChromeOptions()
            #options.add_argument('--disable-extensions')
            #options.add_argument('--headless')
            #options.add_argument('--disable-gpu')
            #options.add_argument('--no-sandbox')
            options.add_argument('--profile-directory=' + self.chrome_profile_name)
            options.add_argument("user-data-dir=" + self.user_data_dir)

            self.driver = webdriver.Chrome(self.driver_path, chrome_options=options)
        except:
            try:
                self.driver = webdriver.Chrome(self.driver_path)
            except:
                return False

        self.driver.get(self.fb_link)

        return self

    def login(self):
        """
        Navigate to the login page and fill login form plus
        clicking the remember button if existed

        :return:
        """

        try:
            email = self.driver.find_element_by_id('m_login_email')
            password = self.driver.find_element_by_id('m_login_password')
            login_btn = self.driver.find_element_by_xpath('//button[@name="login"]')
        except:
            print('Some of login elements are missing')

        # Sending data to input fields
        email.send_keys(self.login_email)
        password.send_keys(self.login_password)
        login_btn.send_keys(Keys.RETURN)

        time.sleep(5)

        # Login with one tab (Remember Me button)
        try:
            one_tap = self.driver.find_element_by_xpath('//input[@value="OK"]')
            one_tap.click()
        except:
            pass

    def insert_data(self, data):
        if type(data) != dict:
            raise TypeError('The "data" type must be of type dictionary ' + type(data) + ' is given!')

        # if already users data exist
        try:
            if 'users' in self.data:
                if 'users' in data:
                    self.data['users'].extend(data['users'])
            else:
                self.data.update(data)
        except:
            print('An error occurred while trying to add users to data object')

    def scrape_url(self, url, url_type=None):
        """
        Navigate to scraping URL and extract group/post data
        :param url_type:
        :param url:
        :return:
        """

        if url_type == 'group':

            # Extract group ID from the url
            try:
                group_id = re.findall(r'(?<=groups\/)(.*)(?=\/permalink)', url)[0]
            except:
                # Make sure that URL has '/' at the end.
                if url[-1] != '/':
                    url = url + '/'
                group_id = re.findall(r'(?<=groups\/)(.*)(?=\/)', url)[0]
                print(group_id)

            # Add group id inside data object
            self.insert_data({'group_id': group_id})

            # Navigate to the group page
            self.driver.get(self.fb_link + 'groups/' + group_id + '?view=info')
            time.sleep(10)

        elif url_type == 'post':

            # Extract post ID from the url
            try:
                post_url = re.findall(r'facebook.com(.*)\/', url + '/')[0]
                # Navigate to the group page
                self.driver.get(self.fb_link + post_url)

            except:
                return False
        else:

            # For scraping single user data
            self.driver.get(f'{self.fb_link}/{url}')

        return self

    def back(self):
        """
        Back to the previous page

        :return:
        """

        # If we want to return back couple of pages for the next option
        if self.link_back > 0:
            for i in range(self.link_back):
                self.driver.back()

        else:
            self.driver.back()

        # Set the link back to its original state
        self.link_back = 0

        return self

    def quit(self):
        """
        Quit the web browser

        :return:
        """
        self.driver.quit()
