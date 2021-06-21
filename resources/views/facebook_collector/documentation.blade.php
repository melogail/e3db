@extends('app')
@section('content')

    <!-- Hero Section-->
    <section class="hero py-3 text-white dark-overlay">
        <img class="bg-image" src="{{asset('img/photo/banner.jpg')}}" alt="page banner">
        <div class="container overlay-content">
            <!-- Breadcrumbs -->
            <ol class="breadcrumb text-white justify-content-center no-border mb-0">
                <li class="breadcrumb-item">
                    <a href="#">Downloads</a>
                </li>
                <li class="breadcrumb-item active">Facebook Collector Software</li>
            </ol>
            <h3 class="hero-heading">Facebook Collector Software Documentation</h3>
            <p>Version 1.0 Beta</p>
        </div>
    </section>
    <section class="py-6">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 mx-auto">
                    <h3>Introduction</h3>
                    <p>E3mel Business introduces this software (Facebook Data Collector) to collect some information from Facebook and compare it with our saved data on database. The main purpose of this software is to facilitate getting Facebook users personal and profession information and send it to the registered agent&rsquo;s email.</p>
                    <p>Some important terminologies:</p>
                    <ul>
                        <li>
                            <p>User = Facebook user.</p>
                        </li>
                        <li>
                            <p>Agent = Registered user on E3mel Business Database.</p>
                        </li>
                    </ul>
                    <h3>How does it work</h3>
                    <p>The software uses your Facebook account to collect the desired data. These data are users IDs or Usernames, then the software connects to our database system and retrieve the users details, then it generates an excel file and send it to the agent&rsquo;s email.</p>
                    <p>Note: During retrieving the data, the software gets ONLY the data of the users saved on our system. If the user is not saved on our system his/her data won&rsquo;t be retrieved. Also you may encounter that some user&rsquo;s data arenot present - ex: email, position, or hometown &ndash; we are doing our best to collect users&rsquo; data as much as possible.</p>
                    <p>There are three main options in this project, first, you can collect single user data by adding the user&rsquo;s Facebook ID, Facebook Username, or phone number. This option is based on the online system, it&rsquo;s not presented in the desktop software (Figure-1).</p>
                    <figure class="text-center">
                        <img class="img-fluid img-thumbnail" src="{{asset('img/documentation/image1.png')}}" alt="figure1">
                        <figcaption class="text-center"> Figure 1</figcaption>
                    </figure>
                    <p>Second, you can collect a bulk of users at the same time by using the desktop software, here you can collect users either reacted or commented on a single post in a page or group, or you can collect some of the users joined a particular group. Also, the same process goes on, after collecting the user&rsquo; data, the agent will receive and email attached with CSV file containing the data of the users presented in our database (Figure 2).</p>
                    <figure class="text-center">
                        <img class="img-fluid img-thumbnail" src="{{asset('img/documentation/image2.png')}}" alt="figure2">
                        <figcaption class="text-center"> Figure 2</figcaption>
                    </figure>
                    <p>Note: Retrieving users&rsquo; data, generating the CSV file and sending the email may take time based on the size of data collected by the system.</p>
                    <p>The desktop software uses the command line, don&rsquo;t worry the software is self-documented and easy to use with few steps.</p>
                    <h3>How to use</h3>
                    <h4>getting single user data</h4>
                    <p>As mentioned before, the system has three main options. The first option &ndash; Getting single user data &ndash; is based online, you have to contact your administrator to create your account and send your account credentials so you can use either the online or the desktop based options.</p>
                    <h3>Logging to the system</h3>
                    <p>To login to your account, open your browser and navigate to the following IP: <a href="http://139.59.187.102/">http://139.59.187.102/</a>, then add your account credentials (Username, and Password) (Figure-3).</p>
                    <figure class="text-center">
                        <img class="img-fluid img-thumbnail" src="{{asset('img/documentation/image3.png')}}" alt="figure3">
                        <figcaption class="text-center"> Figure 3</figcaption>
                    </figure>
                    <h3>The home page gets user's data</h3>
                    <p>After logging in to the web portal, you will find a search bar. Add the user's search criteria and press the "Search" button. Inside the search input add either user Facebook ID, user Facebook username, or even his/her phone number, next choose the type of data you have added inside the search input (Figure 4 - Figure 5).</p>
                    <figure class="text-center">
                        <img class="img-fluid img-thumbnail" src="{{asset('img/documentation/image1.png')}}" alt="figure4">
                        <figcaption class="text-center"> Figure 4</figcaption>
                    </figure>
                    <figure class="text-center">
                        <img class="img-fluid img-thumbnail" src="{{asset('img/documentation/image4.png')}}" alt="figure5">
                        <figcaption class="text-center"> Figure 5</figcaption>
                    </figure>
                    <p>Note: if the user is saved inside the database first you will get the main user's data, if you want more details, hit on the "More Details" link or you can preview the user's profile.</p>
                    <h4>Collecting Bulk of users details</h4>
                    <p>To collect bulk of user's details you will need to use the desktop based software. You will also need your account credentials to login to the system from the desktop software.</p>
                    <blockquote class="blockquote" align="center">Tip: To collect users joined to a particular group, your Facebook account must be also joined to that group.</blockquote>
                    <h3>Add your Google Chrome Profile To the software</h3>
                    <p>In order to use the software properly you need to use your own Facebook account. To use your Facebook account inside the software to collect data, open your Google chrome browser and type the following in the address bar: chrome://version/</p>
                    <figure class="text-center">
                        <img class="img-fluid img-thumbnail" src="{{asset('img/documentation/image5.png')}}" alt="figure6">
                        <figcaption class="text-center"> Figure 6</figcaption>
                    </figure>
                    <p>You will be navigated to a page containing some information about your Google Chrome browser. Beside the Profile path, you will find your Google Chrome browser user profile like this:</p>
                    <p>"<mark class=>C:\Users\MyPC\AppData\Local\Google\Chrome</mark>\User Data\Default"</p>
                    <p>Go to the highlighted sector &ndash; Just before the &ldquo;User Data&rdquo; directory and copy all the &ldquo;User Data&rdquo; directory and past it inside the your software on the same level with &ldquo;Facebook Collector.exe&rdquo; file.</p>
                    <p>The last word in the profile path &ndash; highlighted with green - is the name of your current Google Chrome profile which is generated by default as &ldquo;Default&rdquo; but you may have more than profile inside your Google Chrome for example: (Profile 1, Profile 2&hellip; etc.).</p>
                    <hr>
                    <h3>Starting your program</h3>
                    <p>Go to your program directory and open the file &ldquo;Facebook Collector.exe&rdquo; to start the program. First, you will see a greeting message then the software will prompt for your username and password (Figure 6 &ndash; Figure 7).</p>
                    <figure class="text-center">
                        <img class="img-fluid img-thumbnail" src="{{asset('img/documentation/image6.png')}}" alt="">
                        <figcaption class="text-center"> Figure 7</figcaption>
                    </figure>
                    <figure class="text-center">
                        <img class="img-fluid img-thumbnail" src="{{asset('img/documentation/image7.png')}}" alt="">
                        <figcaption class="text-center"> Figure 8</figcaption>
                    </figure>
                    <p>Note: Your username and password are set by the administrators, if you don&rsquo;t know your username and password please contact the administrators.</p>
                    <p>Note: When entering your password, you will not be able to see something is typing on the screen, this is for security reasons. Just type your password normally and hit enter.</p>
                    <h3>Scraping Facebook</h3>
                    <p>When you are successfully logged in, the software will ask for the type of scrapping, either scrapping users in a post, or scrape users joined to a particular group.</p>
                    <p>Choose one of two options by typing the number of the option (1 or 2) then hit Enter. If you choose the first choice &ndash; Post &ndash; the software will ask you what do you want to collect from this post, users in comments, or users in reacts? Choose the desired option then hit Enter (Figure &ndash; 9).</p>
                    <figure class="text-center">
                        <img class="img-fluid img-thumbnail" src="{{asset('img/documentation/image8.png')}}" alt="">
                        <figcaption class="text-center"> Figure 9</figcaption>
                    </figure>
                    <p>The next step you will be asked to insert the Facebook post link to be scrapped (Figure &ndash; 10).</p>
                    <figure class="text-center">
                        <img class="img-fluid img-thumbnail" src="{{asset('img/documentation/image9.png')}}" alt="">
                        <figcaption class="text-center"> Figure 10</figcaption>
                    </figure>
                    <blockquote class="blockquote">TIP: If you forget to add your Google Chrome &ldquo;User Data&rdquo; file inside the software main directory, you will encounter an error with describing message and the software will automatically shut down.</blockquote>
                    <p>Next you will be asked to add your Google Chrome profile name &ldquo;Default, Profile 1, Profile 2 &hellip; etc.&rdquo;, or you can leave it blank to use the &ldquo;Default&rdquo; profile name (Figure &ndash; 11).</p>
                    <figure class="text-center">
                        <img class="img-fluid img-thumbnail" src="{{asset('img/documentation/image10.png')}}" alt="">
                        <figcaption class="text-center"> Figure 11</figcaption>
                    </figure>
                    <p>Next the software will do its work and scrape the desired target and collect the data for you. After the scrapping process you will be prompted if you need to continue using the software or close.</p>
                    <blockquote class="blockquote">Tip: After scrapping users&rsquo; data, it will take some time (minutes or hours) to process your data and send it to your registered email based on the size of the collected data.</blockquote>
                </div>
            </div>
        </div>
    </section>
@stop
