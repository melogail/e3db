import requests
import getpass
import json
import time
import os
from classes.post import Post
from classes.group import Group

status = False
access_token = None
user = None

# Greeting Message
print('\n')
print("#".center(87, '#'))
print('Welcome to E3mel Business Users Database, please login using your username and password.')
print("#".center(87, '#'))

# Authorizing User
while not status:
    username = input('Enter username: ')
    password = getpass.getpass('Enter password: ')
    payload = {'username': username, 'password': password}
    response = requests.post('http://ebusiness.com/api/login', data=payload, headers={'Accept': 'application/json'})

    if response.status_code == 200:
        status = True
        response_data = json.loads(response.text)
        access_token = response_data['access_token']
        user = response_data['user']
        print('\n')
        print(" Access Granted - Welcome {first_name} {last_name} ".format(first_name=user['first_name'].capitalize(),
                                                                           last_name=user[
                                                                               'last_name'].capitalize()).center(60,
                                                                                                                 '#'))
        print("".center(60, "#"))
    else:
        print('\n')
        print(" Access Denied! ".center(60, '#'))
        print(" Please make sure you entered your credentials correctly! ".center(60, '#'))
        print("".center(60, "#"))

continue_collecting = True
while continue_collecting:

    # Ask user the type and link of search
    flag = False

    # Validate user input
    while not flag:
        print('What do you want to scrape?')
        print("[1] Post")
        print("[2] Group")
        search_type = int(input("Choose an option: "))

        # if post, ask if want to scrape comments or reacts
        if search_type == 1:
            flag = True
            post_flag = False
            print(''.center(60, '#'))
            print(" Collecting users from post ".center(60, '#'))
            print(''.center(60, '#'))

            # Validate user input
            while not post_flag:
                print("\nWhat would you like to collect from this post?")
                print("[1] Users in comments")
                print("[2] Users in reacts")
                collect_type = int(input("Choose an option: "))

                # Validate user input
                if collect_type == 1 or collect_type == 2:
                    post_flag = True

            # Post link
            post_link = input("\nPlease insert post link: ")

            # Collect post
            # Check for chromedriver and User Data / google-chrome directory
            if os.path.isdir('User Data'):
                pass
            elif os.path.isdir('google-chrome'):
                pass
            else:
                print('\n')
                print(''.center(60, '#'))
                print(' Error! Can\'t find Google chrome user profile! '.center(60, '#'))
                print(''.center(60, '#'))
                print(
                    'Can\'t find Google chrome profile directory "User Data" or "google-chrome" in your application root path, please make sure you add the directory to your application root path\nYou can find your profile directory by opening new tab in Google chorme and type "chrome//:version" in your address bar, You will find your profile path beside the "Profile Path" sector.')
                exit()

            post_obj = Post(driver_path='driver/chromedriver',
                            user_data_dir='/var/www/facebooker/public/automate/google-chrome',
                            chrome_profile_name='Default').open_browser()
            post_obj.scrape_url(post_link, 'post')

            # Setting collect type
            if collect_type == 1:
                collect_type = 'comments'
            elif collect_type == 2:
                collect_type = 'reacts'

            post_obj.get_post_data().collect_users_data(collect_type=collect_type)
            post_obj.driver.quit()

            # Adding user details to post_object.data
            post_obj.data.update({'agent_data': user})
            # Extracting data in CSV TODO::Continue extracting users as CSV
            response = requests.post('http://ebusiness.com/api/search/batch/post', json=post_obj.data,
                                     headers={'Accept': 'application/json; charset=utf8',
                                              'Authorization': 'Bearer ' + access_token})

        elif search_type == 2:
            flag = True
            group_flag = False
            print(''.center(60, '#'))
            print(" Collecting users from group ".center(60, '#'))
            print(''.center(60, '#'))

            # Group link
            group_link = input("\nPlease insert group link: ")

            # Collect group
            group_obj = Group(driver_path='driver/chromedriver',
                              user_data_dir='/var/www/facebooker/public/automate/google-chrome',
                              chrome_profile_name='Default').open_browser()
            group_obj.scrape_url(group_link, 'group')

            group_obj.get_group_information().scrape_members().scrape_other_members().collect_users_data()
            group_obj.driver.quit()

            # Collect group

    answer = input('Do you like to collect more data? [Y][n]')
    while answer != 'y' and answer != 'Y' and answer != 'n':
        print('\nPlease type a right choice!')
        answer = input('\nDo you like to collect more data? [Y][n]')
    if answer != 'y' and answer != 'Y':
        continue_collecting = False
        print("\n ")
        print(' Thank you for using E3mel Business Database Service '.center(60, '*'))

