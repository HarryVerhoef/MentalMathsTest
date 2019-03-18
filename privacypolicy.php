<?
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width" />
    <meta name="description" content="Read the privacy policy of MentalMathsTest."/>
    <meta name="keywords" content="Privacy Policy">
    <meta name="author" content="Harry Verhoef"/>
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="/manifest.json">
    <title>MentalMathsTest | Privacy Policy</title>
    <link rel="stylesheet" type="text/css" href="header.css?3458d67"/>
    <link rel="stylesheet" type="text/css" href="privacypolicybody.css"/>
    <link rel="stylesheet" type="text/css" href="footer.css"/>
    <div class="hiddenMenu">
        <div class="socialLinks">
            <ol>
                <li id="TwitterLinkHeader"><a href="https://twitter.com/MentalMathsTest" target="_blank"><img src="images/TwitterIcon.png" class="socialIcon" alt="MentalMathsTest Twitter Link"><p>@MentalMathsTest</p></a></li>
                <li id="FacebookLinkHeader"><a href="https://www.facebook.com/MentalMathsTest" target="_blank"><img src="images/FacebookIcon.png" class="socialIcon" alt="MentalMathsTest Facebook Link"><p>/MentalMathsTest</p></a></li>
                <li id="EmailLinkHeader"><img src="images/EmailIcon.png" class="socialIcon" alt="Email Address"><p>Admin@mentalmathstest.com</p></li>
            </ol>
            <div class="twitterEmbed">
                <a class="twitter-timeline" data-width="400" data-height="225" href="https://twitter.com/MentalMathsTest">Tweets by MentalMathsTest</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
            </div>
            <div class="verticalLineBreakHidden">
            </div>
        </div>
        <div class="siteLinks">
            <ol>
                <li><a href="http://mentalmathstest.com/home"><div class="siteLink"><p>Home</p></div></a></li>
                <li><a href="http://mentalmathstest.com/play"><div class="siteLink"><p>Play</p></div></a></li>
                <li><a href="http://mentalmathstest.com/leaderboard"><div class="siteLink"><p>Leaderboard</p></div></a></li>
                <li><a href="http://mentalmathstest.com/statistics"><div class="siteLink"><p>Statistics</p></div></a></li>
            </ol>
        </div>
    </div>
    <div class="header">
        <div class="logoParent">
            <a href="http://mentalmathstest.com"><img src="images/MentalMathsTestLogo.png" id="Logo" alt="Mental Maths Test Logo"/></a>
        </div>
        <?
        if ($_SESSION["loggedIn"] == true && isset($_SESSION["userID"])) {
            echo "
            <div class='loggedInNav'>
                <ol>
                    <a href='http://mentalmathstest.com/home'><li>Home</li></a>
                    <a href='http://mentalmathstest.com/signout.php'><li>Sign Out</li></a>
                </ol>
            </div>
            ";
        } else {
            echo "
            <div class='loggedInNav'>
                <ol>
                    <li id='LoginButton'>Log In</li>
                    <li id='SignUpButton'>Sign Up</li>
                </ol>
            </div>
            ";
        };
        ?>
        <div class="statisticsHeaderChild"><a href="http://mentalmathstest.com/statistics" id="StatisticsLink"><h2>STATISTICS</h2></a></div>
        <div class="verticalLineBreak"></div>
        <div class="leaderboardHeaderChild"><a href="http://mentalmathstest.com/leaderboard" id="LeaderboardLink"><h2>LEADERBOARD</h2></a></div>
        <div class="menuIcon">
            <div class="menuCircle">
                <div class="rectangleParent">
                    <div class="menuRectangle1">
                    </div>
                    <div class="menuRectangle2">
                    </div>
                    <div class="menuRectangle3">
                    </div>
                </div>
            </div>
        </div>
    </div>
</head>
<body>
    <div class="bodyContent">
        <div class="bodyWrapper">
            <h1 id="PrivacyPolicyHeader">Privacy Policy</h1>
            <div class='innerText'>This privacy policy has been compiled to better serve those who are concerned with how their 'Personally Identifiable Information' (PII) is being used online. PII, as described in US privacy law and information security, is information that can be used on its own or with other information to identify, contact, or locate a single person, or to identify an individual in context. Please read our privacy policy carefully to get a clear understanding of how we collect, use, protect or otherwise handle your Personally Identifiable Information in accordance with our website.<br></div><span id='infoCo'></span><br><div class='grayText'><strong>What personal information do we collect from the people that visit our blog, website or app?</strong></div><br /><div class='innerText'>When ordering or registering on our site, as appropriate, you may be asked to enter your name, email address, Gender or other details to help you with your experience.</div><br><div class='grayText'><strong>When do we collect information?</strong></div><br /><div class='innerText'>We collect information from you when you register on our site or enter information on our site.</div><br> <span id='infoUs'></span><br><div class='grayText'><strong>How do we use your information? </strong></div><br /><div class='innerText'> We may use the information we collect from you when you register, make a purchase, sign up for our newsletter, respond to a survey or marketing communication, surf the website, or use certain other site features in the following ways:<br><br></div><div class='innerText'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>&bull;</strong> To personalize your experience and to allow us to deliver the type of content and product offerings in which you are most interested.</div><div class='innerText'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>&bull;</strong> To improve our website in order to better serve you.</div><div class='innerText'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>&bull;</strong> To allow us to better service you in responding to your customer service requests.</div><span id='infoPro'></span><br><div class='grayText'><strong>How do we protect your information?</strong></div><br /><div class='innerText'>We do not use vulnerability scanning and/or scanning to PCI standards.</div><div class='innerText'>We only provide articles and information. We never ask for credit card numbers.</div><div class='innerText'>We use regular Malware Scanning.<br><br></div><div class='innerText'>Your personal information is contained behind secured networks and is only accessible by a limited number of persons who have special access rights to such systems, and are required to keep the information confidential. In addition, all sensitive/credit information you supply is encrypted via Secure Socket Layer (SSL) technology. </div><br><div class='innerText'>We implement a variety of security measures when a user enters, submits, or accesses their information to maintain the safety of your personal information.</div><br><div class='innerText'>All transactions are processed through a gateway provider and are not stored or processed on our servers.</div><span id='coUs'></span><br><div class='grayText'><strong>Do we use 'cookies'?</strong></div><br /><div class='innerText'>Yes. Cookies are small files that a site or its service provider transfers to your computer's hard drive through your Web browser (if you allow) that enables the site's or service provider's systems to recognize your browser and capture and remember certain information. For instance, we use cookies to help us remember and process the items in your shopping cart. They are also used to help us understand your preferences based on previous or current site activity, which enables us to provide you with improved services. We also use cookies to help us compile aggregate data about site traffic and site interaction so that we can offer better site experiences and tools in the future.</div><div class='innerText'><br><strong>We use cookies to:</strong></div><div class='innerText'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>&bull;</strong> Understand and save user's preferences for future visits.</div><div class='innerText'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>&bull;</strong> Keep track of advertisements.</div><div class='innerText'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>&bull;</strong> Compile aggregate data about site traffic and site interactions in order to offer better site experiences and tools in the future. We may also use trusted third-party services that track this information on our behalf.</div><div class='innerText'><br>You can choose to have your computer warn you each time a cookie is being sent, or you can choose to turn off all cookies. You do this through your browser settings. Since browser is a little different, look at your browser's Help Menu to learn the correct way to modify your cookies.<br></div><div class='innerText'><br><strong>If users disable cookies in their browser:</strong></div><br><div class='innerText'>If you turn cookies off, some features will be disabled. Some of the features that make your site experience more efficient and may not function properly.</div><br><div class='innerText'>However, you will still be able to place orders <div class='innerText'>remembered logins</div>.</div><br><span id='trDi'></span><br><div class='grayText'><strong>Third-party disclosure</strong></div><br /><div class='innerText'>We do not sell, trade, or otherwise transfer to outside parties your Personally Identifiable Information unless we provide users with advance notice. This does not include website hosting partners and other parties who assist us in operating our website, conducting our business, or serving our users, so long as those parties agree to keep this information confidential. We may also release information when it's release is appropriate to comply with the law, enforce our site policies, or protect ours or others' rights, property or safety. <br><br> However, non-personally identifiable visitor information may be provided to other parties for marketing, advertising, or other uses. </div><span id='trLi'></span><br><div class='grayText'><strong>Third-party links</strong></div><br /><div class='innerText'>Occasionally, at our discretion, we may include or offer third-party products or services on our website. These third-party sites have separate and independent privacy policies. We therefore have no responsibility or liability for the content and activities of these linked sites. Nonetheless, we seek to protect the integrity of our site and welcome any feedback about these sites.</div><span id='gooAd'></span><br><div class='blueText'><strong>Google</strong></div><br /><div class='innerText'>Google's advertising requirements can be summed up by Google's Advertising Principles. They are put in place to provide a positive experience for users. https://support.google.com/adwordspolicy/answer/1316548?hl=en <br><br></div><div class='innerText'>We use Google AdSense Advertising on our website.</div><div class='innerText'><br>Google, as a third-party vendor, uses cookies to serve ads on our site. Google's use of the DART cookie enables it to serve ads to our users based on previous visits to our site and other sites on the Internet. Users may opt-out of the use of the DART cookie by visiting the Google Ad and Content Network privacy policy.<br></div><div class='innerText'><br><strong>We have implemented the following:</strong></div><div class='innerText'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>&bull;</strong> Demographics and Interests Reporting</div><br><div class='innerText'>We, along with third-party vendors such as Google use first-party cookies (such as the Google Analytics cookies) and third-party cookies (such as the DoubleClick cookie) or other third-party identifiers together to compile data regarding user interactions with ad impressions and other ad service functions as they relate to our website. </div><div class='innerText'><br><strong>Opting out:<strong><br>
                    Users can set preferences for how Google advertises to you using the Google Ad Settings page. Alternatively, you can opt out by visiting the Network Advertising Initiative Opt Out page or by using the Google Analytics Opt Out Browser add on.</div><span id='calOppa'></span><br><div class='blueText'><strong>California Online Privacy Protection Act</strong></div><br /><div class='innerText'>CalOPPA is the first state law in the nation to require commercial websites and online services to post a privacy policy.  The law's reach stretches well beyond California to require any person or company in the United States (and conceivably the world) that operates websites collecting Personally Identifiable Information from California consumers to post a conspicuous privacy policy on its website stating exactly the information being collected and those individuals or companies with whom it is being shared. -  See more at: https://consumercal.org/california-online-privacy-protection-act-caloppa/#sthash.0FdRbT51.dpuf<br></div><div class='innerText'><br><strong>According to CalOPPA, we agree to the following:</strong><br></div><div class='innerText'>Users can visit our site anonymously.</div><div class='innerText'>Once this privacy policy is created, we will add a link to it on our home page or as a minimum, on the first significant page after entering our website.<br></div><div class='innerText'>Our Privacy Policy link includes the word 'Privacy' and can be easily be found on the page specified above.</div><div class='innerText'><br>You will be notified of any Privacy Policy changes:</div><div class='innerText'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>&bull;</strong> On our Privacy Policy Page<br></div><div class='innerText'>Can change your personal information:</div><div class='innerText'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>&bull;</strong> By emailing us</div><div class='innerText'><br><strong>How does our site handle Do Not Track signals?</strong><br></div><div class='innerText'>We honor Do Not Track signals and Do Not Track, plant cookies, or use advertising when a Do Not Track (DNT) browser mechanism is in place. </div><div class='innerText'><br><strong>Does our site allow third-party behavioral tracking?</strong><br></div><div class='innerText'>It's also important to note that we allow third-party behavioral tracking</div><span id='coppAct'></span><br><div class='blueText'><strong>COPPA (Children Online Privacy Protection Act)</strong></div><br /><div class='innerText'>When it comes to the collection of personal information from children under the age of 13 years old, the Children's Online Privacy Protection Act (COPPA) puts parents in control.  The Federal Trade Commission, United States' consumer protection agency, enforces the COPPA Rule, which spells out what operators of websites and online services must do to protect children's privacy and safety online.<br><br></div><div class='innerText'>We do not specifically market to children under the age of 13 years old.</div><span id='ftcFip'></span><br><div class='blueText'><strong>Fair Information Practices</strong></div><br /><div class='innerText'>The Fair Information Practices Principles form the backbone of privacy law in the United States and the concepts they include have played a significant role in the development of data protection laws around the globe. Understanding the Fair Information Practice Principles and how they should be implemented is critical to comply with the various privacy laws that protect personal information.<br><br></div><div class='innerText'><strong>In order to be in line with Fair Information Practices we will take the following responsive action, should a data breach occur:</strong></div><div class='innerText'>We will notify you via email</div><div class='innerText'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>&bull;</strong> Within 7 business days</div><div class='innerText'>We will notify the users via in-site notification</div><div class='innerText'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>&bull;</strong> Within 7 business days</div><div class='innerText'><br>We also agree to the Individual Redress Principle which requires that individuals have the right to legally pursue enforceable rights against data collectors and processors who fail to adhere to the law. This principle requires not only that individuals have enforceable rights against data users, but also that individuals have recourse to courts or government agencies to investigate and/or prosecute non-compliance by data processors.</div><span id='canSpam'></span><br><div class='blueText'><strong>CAN SPAM Act</strong></div><br /><div class='innerText'>The CAN-SPAM Act is a law that sets the rules for commercial email, establishes requirements for commercial messages, gives recipients the right to have emails stopped from being sent to them, and spells out tough penalties for violations.<br><br></div><div class='innerText'><strong>We collect your email address in order to:</strong></div><div class='innerText'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>&bull;</strong> Send information, respond to inquiries, and/or other requests or questions</div><div class='innerText'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>&bull;</strong> Market to our mailing list or continue to send emails to our clients after the original transaction has occurred.</div><div class='innerText'><br><strong>To be in accordance with CANSPAM, we agree to the following:</strong></div><div class='innerText'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>&bull;</strong> Not use false or misleading subjects or email addresses.</div><div class='innerText'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>&bull;</strong> Identify the message as an advertisement in some reasonable way.</div><div class='innerText'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>&bull;</strong> Include the physical address of our business or site headquarters.</div><div class='innerText'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>&bull;</strong> Monitor third-party email marketing services for compliance, if one is used.</div><div class='innerText'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>&bull;</strong> Honor opt-out/unsubscribe requests quickly.</div><div class='innerText'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>&bull;</strong> Allow users to unsubscribe by using the link at the bottom of each email.</div><div class='innerText'><strong><br>If at any time you would like to unsubscribe from receiving future emails, you can email us at</strong></div><div class='innerText'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>&bull;</strong> Follow the instructions at the bottom of each email.</div> and we will promptly remove you from <strong>ALL</strong> correspondence.</div><br><span id='ourCon'></span><br><div class='blueText'><strong></strong></div><br /><div class='innerText'><br><br></div><div class='innerText'></div><div class='innerText'></div><div class='innerText'></div><div class='innerText'></div><div class='innerText'><br></div></div></strong></strong>
        </div>
        <div class="footer">
            <h5>Site created and managed by <a href="https://www.twitter.com/HarryVerhoef" target="_blank">@HarryVerhoef</a></h5>
            <a href="http://mentalmathstest.com/termsandconditions" class="footerLink">Terms and Conditions</a><br>
            <a href="http://mentalmathstest.com/privacypolicy" class="footerLink">Privacy Policy</a><br>
            <a href="http://mentalmathstest.com/sitemap" class="footerLink">Sitemap</a><br>
            <a href="http://mentalmathstest.com/contact" class="footerLink">Contact</a>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    <script src="plugins/pace.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".bodyContent").height($(document).height());
            $(".footer").css("top",$(".bodyWrapper").height() + 210);
            $(window).resize(function() {
                $(".bodyContent").height($(document).height());
                $(".footer").css("top",$(".bodyWrapper").height() + 210);
            });
            $(".menuIcon").click(function() {
                if ($(".menuIcon").hasClass("menu-active")) {
                    $(".menuIcon,.hiddenMenu,.header,.bodyContent").removeClass("menu-active");
                } else {
                    $(".menuIcon,.hiddenMenu,.header,.bodyContent").addClass("menu-active");
                };
            });
        });
    </script>
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
        ga('create', 'UA-87431031-1', 'auto');
        ga('send', 'pageview');
    </script>
</body>
</html>
