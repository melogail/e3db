from .scrape import Scrape
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
import json, time


class User(Scrape):
    """
    This class will scrape for user data without agent login need
    """

    def __init__(self, driver_path):
        super().__init__(driver_path)

        self.fb_link = 'https://facebook.com/'

    def user_profile(self, user_name):
        """
        Navigate to user profile

        :param user_name:
        :return:
        """
        # Navigate to use profile
        self.driver.get(self.fb_link + user_name)

        return self

    def get_user_id(self):
        """
        Scrape for user ID

        :return:
        """
        user_id_link = WebDriverWait(self.driver, 10).until(
            EC.presence_of_element_located((By.ID, 'pagelet_timeline_main_column'))
        )
        user_data = user_id_link.get_attribute('data-gt')
        user_id = json.loads(user_data)['profile_owner']

        return user_id
