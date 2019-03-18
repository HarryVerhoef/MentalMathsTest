<?php
session_start();
include "connect.php";
if (isset($_COOKIE["rememberMe"])) {
	include "connect.php";
	$query = mysqli_stmt_init($db);
	mysqli_stmt_prepare($query,"SELECT USER_TOKEN, USER_SALT FROM users WHERE USER_ID=?");
	mysqli_stmt_bind_param($query,"s",$id);
	$id = mysqli_real_escape_string($db,explode("_",$_COOKIE["rememberMe"])[0]);
	mysqli_stmt_bind_result($query,$token,$salt);
	mysqli_stmt_execute($query);
	mysqli_stmt_fetch($query);
	mysqli_stmt_close($query);
	if (hash("sha512",$token.$salt) === explode("_",$_COOKIE["rememberMe"])[1]) {
		include "rememberme.php";
		$_SESSION["loggedIn"] = true;
		$_SESSION["userID"] = $id;
	} else {
		$_SESSION["loggedIn"] = false;
		$_SESSION["userID"] = null;
	};
};
if ($_SESSION["loggedIn"] == true && isset($_SESSION["userID"])) {
	include "connect.php";
	$query = mysqli_stmt_init($db);
	mysqli_stmt_prepare($query,"SELECT USER_NAME FROM users WHERE USER_ID=?");
	mysqli_stmt_bind_param($query,"s",$id);
	$id = $_SESSION["userID"];
	mysqli_stmt_bind_result($query,$username);
	mysqli_stmt_execute($query);
	mysqli_stmt_fetch($query);
	mysqli_stmt_close($query);
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="plugins/pace.min.js"></script>
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<script>
	  (adsbygoogle = window.adsbygoogle || []).push({
	    google_ad_client: "ca-pub-8271963858208371",
	    enable_page_level_ads: true
	  });
	</script>
	<meta name="viewport" content="width=device-width" />
	<meta charset="UTF-8"/>
	<meta name="description" content="MentalMathsTest is an online maths practice and maths test site, for SAT maths, GCSE and A-Level. Test yourself now!">
	<meta name="keywords" content="Maths,Mental Maths Test,Online Maths Test,Year 3,Year 4,Year 5,Year 6,KS3,KS4,KS5,GCSE,A-Level,Maths Test Login">
	<meta name="author" content="Harry Verhoef">
	<meta name="google-site-verification" content="gbBgpfLZHhHZ-P6hY7mlvky-u9pr-t4v0Hn5DgvkxfQ" />
	<html itemscope itemtype="https://schema.org/Article">
	<!--Twitter-->
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:site" content="@MentalMathsTest">
	<meta name="twitter:title" content="#1 for Online Arithmetic Tests, what do you score?" />
	<meta name="twitter:description" content="Online maths practice and maths test site, for SAT maths, GCSE and A-Level. Test yourself now!">
	<meta name="twitter:creator" content="@HarryVerhoef">
	<meta name="twitter:image" content="http://mentalmathstest.com/images/bg2.jpg">
	<!--Google+-->
	<meta itemprop="name" content="#1 for Online Arithmetic Tests, what do you score?">
	<meta itemprop="description" content="Online maths practice and maths test site, for SAT maths, GCSE maths and A-Level maths. Test yourself now!">
	<meta itemprop="image" content="http://mentalmathstest.com/images/bg2.jpg">
	<!---->
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
	<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
	<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
	<link rel="manifest" href="/manifest.json">
	<title>MentalMathsTest | Welcome to the #1 Online Arithmetic Test</title>
	<link rel="stylesheet" type="text/css" href="header.css?343q6sdsdd5"/>
	<link rel="stylesheet" type="text/css" href="mainbody.css?12dd7s2qqqsdgddfdd3d6sddwdrsfassasftssssddqssfsssaadsddswfsd4s3s3"/>
	<link rel="stylesheet" type="text/css" href="footer.css"/>
	<link rel="stylesheet" type="text/css" href="plugins/unslider.css">
	<link rel="stylesheet" type="text/css" href="plugins/unslider-dots.css">
	<div class="hiddenMenu">
		<div class="socialLinks">
			<ol>
				<li id="TwitterLinkHeader"><a href="http://twitter.com/MentalMathsTest" target="_blank"><img src="images/TwitterIcon.png" class="socialIcon" alt="MentalMathsTest Twitter Link"><p>@MentalMathsTest</p></a></li>
				<li id="FacebookLinkHeader"><a href="http://www.facebook.com/MentalMathsTest" target="_blank"><img src="images/FacebookIcon.png" class="socialIcon" alt="MentalMathsTest Facebook Link"><p>/MentalMathsTest</p></a></li>
				<li id="EmailLinkHeader"><img src="images/EmailIcon.png" class="socialIcon" alt="Email Address"><p>Admin@mentalmathstest.com</p></li>
			</ol>
			<div class="twitterEmbed">
				<a class="twitter-timeline" data-width="400" data-height="225" href="http://twitter.com/MentalMathsTest">Tweets by MentalMathsTest</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
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
	<div class="finishedOverlay">
		<div class="finishedContent">
			<img class="closeIcon" src="images/CloseIcon2.png" alt="Close Menu">
			<p id="FinishedOverlay">Thanks for registering!</p>
			<p id="ScoreOverlay">Close this message and then login to access the #1 online arithmetic testing and training website!</p>
			<p id="AnswerOverlay"></p>
			<ol id="FinishedBars">
				<li><div class="finishedBar"></li>
				<li><div class="finishedBar"></li>
				<li><div class="finishedBar"></li>
				<li><div class="finishedBar"></li>
				<li><div class="finishedBar"></li>
				<li><div class="finishedBar"></li>
				<li><div class="finishedBar"></li>
				<li><div class="finishedBar"></li>
			</ol>
		</div>
		<div class="userAccountDialog">
			<img class="closeIcon" src="images/CloseIcon2.png" alt="Close Menu">
			<h3 id="UserAccountDialogHeader"></h3>
			<form id="UserAccountLoginForm" action="login.php" method="post">
				<input type="text" placeholder="Email / Username" id="LoginEmail" name="loginemail" required/>
				<input type="password" placeholder="Password" id="LoginPassword" name="loginpassword" required/>
				<input type="submit" value="Log In" id="LoginButton1" name="loginbutton" required/><br>
				<input type="checkbox" id="LoginRememberMe" name="loginrememberme" value="RememberMe" checked/><label for="LoginRememberMe">Remember Me</label><br>
			</form>
			<form id="UserAccountSignUpForm" action="register.php" method="post">
				<div class="signUp1">
					<input type="email" placeholder="Email" id="SignUpEmail" name="signupemail" required autofocus/><br>
					<input type="text" placeholder="Username" id="SignUpUsername" name="signupusername" required/><br>
					<input type="password" placeholder="Password" id="SignUpPassword" name="signuppassword" required/><br>
					<input type="password" placeholder="Re-enter password" id="SignUpRePassword" name="signuprepassword" required/>
				</div>
				<div class="signUp2">
					Date Of Birth: <br><input type="number" placeholder="DD" id="SignUpD" name="signupd" min="1" max="31" maxlength="2" required/>
					<input type="number" placeholder="MM" id="SignUpM" name="signupm" min="1" max="12" maxlength="2" required/>
					<input type="number" placeholder="YYYY" id="SignUpY" name="signupy" min="1900" max="2017" maxlength="4" required/><br>
					Gender: <select form="UserAccountSignUpForm" name="signupgender" required>
						<option value="test">------</option>
						<option value="Male">Male</option>
						<option value="Female">Female</option>
					</select><br>
					<input type="checkbox" id="SignUpTermsAndConditions" name="signuptermsandconditions" value="termsandconditions" required/>
					<label for="SignUpTermsAndConditions">By registering to this website I agree to the
					<a href="http://mentalmathstest.com/termsandconditions" id="TermsAndConditionsLink">Terms and Conditions</a>
					and the <a href="http://mentalmathstest.com/privacypolicy" id="PrivacyPolicyLink">Privacy Policy</a></label><br>
					<input type="submit" value="Sign Up" id="SignUpSubmit" name="signupsubmit" required/>
				</div>
			</form>
		</div>
	</div>
	<div class="guestOverlay">
		<div class="guestFinishedContent">
			<div class="guestFinishedHeader">
				<h2 id="GuestFinishedHeader"></h2>
				<img class="closeIcon2" src="images/CloseIcon2.png" alt="Close Guest-Finished Menu">
			</div>
			<div class="percentageMeter">
				<div class="percentageExplanation">
					<p id="PercentageStats"></p>
				</div>
				<div class="percentageBarParent">
					<div class="percentageBar">
						<div class="percentageBarLeft">
							<p id="PercentageScoreLeft"></p>
						</div>
						<div class="percentageBarRight">
							<p id="PercentageScoreRight"></p>
						</div>
					</div>
				</div>
				<div class="lineBreak">
				</div>
			</div>
			<div class="otherStats">
				<div class="timeStats">
					<div class="lineBreak">
					</div>
					<p id="GuestFinishedP1"></p>
				</div>
				<div class="signUpStats">
					<p id="GuestFinishedP2">Sign up for free to play unlimited tests, practice key mathematical areas and create infinite custom tests!</p>
				</div>
				<div class="practiceStats">
					<div class="practiceAddition">
						<div class="carouselButton blue">
							<p>Practice Addition</p>
						</div>
					</div>
					<div class="practiceDivision">
						<div class="carouselButton blue">
							<p>Practice Division</p>
						</div>
					</div>
					<div class="practiceQuadratics">
						<div class="carouselButton blue">
							<p>Practice Quadratics</p>
						</div>
					</div>
					<div class="practiceLogarithms">
						<div class="carouselButton blue">
							<p>Practice Logarithms</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="bodyContent">
		<div class="bodyWrapper">
			<div class="carouselParent">
				<div class="playGuest2">
					<img src="images/BackgroundCarousel/int_blurred.jpg" class="carouselBackground">
					<div class="centreTextParent">
						<div class="centreText">
							<h1>Join a class test!</h1>
							<h3>Enter the class code to join the test lobby </h3>
							<form id="JoinClassForm" action="joinClass.php" method="post">
								<input type="text" name="classcode" id="ClassCode" placeholder="Enter Code"><br>
								<div class="submitClassCode">
									<input type="submit" name="submitclasscode" id="SubmitClassCode" value="Let's Play!">
									<div class="arrowArea">
										<div class="arrowBox">
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="lowerBody">
			<ol id="LowerBodyOL">
				<li>
					<div class="individualTest">
						<h3>Join an individual offline test</h3>
						<form action="play.php" method="get">
							<input type="text" name="t" id="IndividualTestCode" placeholder="Enter Offline Code"><br><br>
							<input type="submit" value="Play Test" id="OfflineSubmit">
						</form>
					</div>
				</li>
				<li>
					<?
					if ($_SESSION["loggedIn"]) {
						echo "<div class='classTest'>
							<h2>Create a class test!</h2>
							<p>Start an interactive, fair and fun class test!</p>
							<a href='http://mentalmathstest.com/createClassTest'>
							<div class='submitCreateClassTest'>
								<input type='submit' id='SubmitCreateClassTest' value='Start!'>
								<div class='arrowArea'>
									<div class='arrowBox'>
									</div>
								</div>
							</div>
						</div>";
					};
					?>
					<div class="classTest" style="<? if($_SESSION["loggedIn"]) {echo "display: none !important;";}; ?>">
						<h2>Test your mathematical ability without signing up!</h2>
						<p>How good at maths are you? Test yourself with the #1 Online Mental Arithmetic Testing/Practice website...</p>
						<a href="http://mentalmathstest.com/playGuest.php">
							<div class="carouselButton">
								<p>Let's Go!</p>
							</div>
						</a>
					</div>
				</li>
				<li>
					<div class="createTest">
						<h3>Create offline test</h3>
						<p id="CreateTestP">We offer the easiest way to create tests &amp; teach mathematical concepts online, whether individually or interactively as a class!</p>
						<a href="http://mentalmathstest.com/createtest">
							<div class="createTestButton">
								<p>Create!</p>
							</div>
						</a>
					</div>
				</li>
			</ol>
			<p id="SignUpPrompt" style="<? if($_SESSION["loggedIn"]) {echo 'display: none;';}; ?>"><span class="signUpButton">Sign Up</span> to create online class tests easily.</p>
		</div>
		<div class="lowerDescription">
			<img src="images/YourScorePreview.png" id="YourScorePreview" alt="Example of user score">
			<div class="yourScoreDescription">
				<h4 id="YourScoreHeader">How it works</h4>
				<p>The Mental Maths Test consists of 15 levels, each of these levels contain 10 questions and you are allocated a certain amount of time to each level, not each question. This amount of time varies and will not be displayed while you are being tested - just to make it that little bit more challenging.</p>
				<p>The score you get if you run out of time is obtained by: Level Reached + ((Question Reached - 1) / 10) + (Time Taken On Level / (Time Available for Level) * 10), the score you get if you finish the test is obtained by 17 - (Time Taken / Time Available), therefore the maximum score is 17.00 and although we openly invite you to try getting that, if you did we'd probably have to test whether you're human or not. If somebody got a score of 10.36, this means that they reached Level 10, question 3 and spent 60% of the time available for level 10 on question 3.</p>
			</div>
		</div>
		<div class="responsiveDescription">
			<div class="responsiveContent">
				<h4 id="ResponsiveHeader">Create public custom maths tests</h4>
				<p>With MentalMathsTest, you're able to make a maths test up to 150 questions long. Don't worry though, you only have to choose the topic of each question (Addition, Division, Linear Algebra, etc.). Although, you can write your own maths questions too!</p>
				<p>Once you've finished with the structure and time allocation of the test, you can generate it and make it public! You'll be given a code to access the custom maths test you've just created and this can be given to any user so that they can access the test too. You can then monitor the performance of users on your test by visiting the <a href="http://mentalmathstest.com/leaderboard" id="LeaderboardLinkBulk">Leaderboard</a> and entering the code generated earlier. This feature is really helpful if you're a mathematics teacher and you want to set a class a maths test built by you, don't want to have to do the marking and want to see who has performed the best.</p>
			</div>
			<img src="images/ipad-air-white.png" id="ResponsivePreview" alt="Example of MentalMathsTest on an iPad">
		</div>
		<div class="levelBreakdown">
			<h4 id="LevelHeader">Practice key mathematical topics</h4>
			<p>In practice mode there is no end, and the questions only get harder. For example, if I chose to practice my basic decimal arithmetic, I would face progressively tougher questions with alternating formats, but all still on decimals. As a result, the constant and progressive thinking on the practice area means that our practice mode is proven to increase mathematical ability and confidence.</p>
			<p>There are plenty of practice topics, and more being added each week. These topics range in difficulty, from SAT maths practice areas to GCSE maths, to A-Level topics. (Years Reception to 13 all covered). Each user's highscore is stored for every individual practice topic and therefore, progress can be monitored.</p>
			<ul>
				<li>Try <a href="http://mentalmathstest.com/play?t=Addition">Addition</a> or <a href="http://mentalmathstest.com/play?t=Subtraction">Division</a>, for Year 3/Year 4/Year 5/Year 6/SAT practice.</li>
				<li>How about some <a href="http://mentalmathstest.com/play?t=Quadratics">Quadratics</a>, for the confident Year 9/Year 10/Year 11/GCSE student.</li>
				<li>Feeling smart? Have a go at <a href="http://mentalmathstest.com/play?t=Logarithms">Logarithms</a>, for a Year 12/Year 13/A-Level mathematician.</li>
			</ul>
		</div>
		<div class="footer">
			<h5>Site created and managed by <a href="http://www.twitter.com/HarryVerhoef" target="_blank">@HarryVerhoef</a></h5>
			<a href="http://mentalmathstest.com/termsandconditions" class="footerLink">Terms and Conditions</a><br>
			<a href="http://mentalmathstest.com/privacypolicy" class="footerLink">Privacy Policy</a><br>
			<a href="http://mentalmathstest.com/sitemap" class="footerLink">Sitemap</a><br>
			<a href="http://mentalmathstest.com/contact" class="footerLink">Contact</a>
		</div>
	</div>
	<script src="plugins/unslider-min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$(".bodyContent").height($(".levelBreakdown").offset().top + 190);
			function returnPrompt(returnString) {
				$("#LogInReturnPrompt").html(returnString);
				$("#LogInReturnPrompt").addClass("unsuccessful");
				setTimeout(function() {
					$("#LogInReturnPrompt").removeClass("unsuccessful");
				}, 5000);
			};
			$(".carousel").unslider({
				autoplay: false,
				delay: 5500,
				nav: true,
				dots: true
			});
			$(".carouselBackground,.playGuest2,.createCustom,.practiceGuest2,.unslider-nav").width($(window).width());
			$(".arrowArea").click(function() {
				$("#JoinClassForm").submit();
			});
			var s = location.search.split("s=")[1];
			if (s === "false") {
				returnPrompt("Invalid Login Details");
			} else if (s === "reg") {
				returnPrompt("Thank you for registering! Log In to start");
			};
			$(".guest").click(function() {
				$("#GuestForm").submit();
			});
			$(".menuIcon").click(function() {
				if ($(".menuIcon").hasClass("menu-active")) {
					$(".menuIcon,.hiddenMenu,.header,.bodyContent").removeClass("menu-active");
				} else {
					$(".menuIcon,.hiddenMenu,.header,.bodyContent").addClass("menu-active");
				};
			});
			$(window).resize(function() {
				$(".bodyContent").height($(".levelBreakdown").offset().top + 190);
				$(".questionParent1,.questionParent2").width(($(document).width()-$(".login").width())/2);
				$(".carouselBackground,.playGuest2,.createCustom,.practiceGuest2,.unslider-nav").width($(window).width());
			});
			if (location.search.length > 1) {
				if (location.search.split("s=")[1] == "reg") {
					$(".finishedOverlay, #FinishedOverlay").addClass("active");
					setTimeout(function() {
						$(".finishedBar").addClass("active");
					},550);
					$(".finishedContent").addClass("active");
					$("#FinishedBars > li").each(function() {
						var rand = Math.floor(Math.random() * (136)) + 15;
						$(this).height(rand);
						$(this).css("margin-top",150-rand);
					});
				} else {
					s = location.search.split("s=")[1];
					if (s == "false") {
						userPrompt("Invalid Registration Inputs","Please try again with valid inputs.");
					} else if (s == "username") {
						userPrompt("Invalid Username","Please use standard characters only.");
					} else if (s == "usernametaken") {
						userPrompt("Username already being used","Please try again with a different username.");
					} else if (s == "email") {
						userPrompt("Invalid Email","Please use a standard email address.");
					} else if (s == "emailtaken") {
						userPrompt("Email already being used","Please try again with a different username.");
					} else if (s == "passwordsdifferent") {
						userPrompt("Passwords didn't match","Please try again with matching passwords.");
					} else if (s == "date") {
						userPrompt("Invalid Date","Date doesn't exist. Please use dd/mm/yyyy.");
					} else if (s == "termsandconditions") {
						userPrompt("Please accept the terms and conditions","Please accept the T's and C's then try again.");
					} else if (s === "guestfinished") {
						userPrompt("Guests can only reach level 5!","Please sign up to access higher levels and tests.");
					} else if (s === "customguestfinished") {
						userPrompt("You have reached the end of the custom test!","Sign up for more!");
					} else if (s.split("guestwrong").length > 1) {
						v = s.split("guestwrong")[1];
						$(".guestOverlay,.guestFinishedContent").addClass("active");
						$("#GuestFinishedHeader").html("You scored " + v.split("&")[1] + " in guest mode!");
						$("#PercentageStats").html("You scored higher than " + v.split("&")[2] + "%");
						$(".percentageBarLeft").css("width",v.split("&")[2] + "%");
						$(".percentageBarRight").css("width",(100 - Number(v.split("&")[2])).toString() + "%");
						$("#PercentageStats").css("line-height",$(".percentageMeter").height() + "px");
						if ((Number(v.split("&")[2]) / 100) * $(".percentageBar").width() > 100) {
							$("#PercentageScoreLeft").html(v.split("&")[2] + "%");
						};
						if ((1 - (Number(v.split("&")[2]) / 100)) * $(".percentageBar").width() > 100) {
							$("#PercentageScoreRight").html((100 - Number(v.split("&")[2])).toString() + "%");
						};
						$("#GuestFinishedP1").html("You took " + (Math.floor(Number(v.split("&")[3]) / 60) ).toString() + " minutes and " + Math.floor(Number(v.split("&")[3]) % 60) + " seconds to reach level " + Math.floor(v.split("&")[1]) + ", question " + (v.split("&")[1]).split(".")[1][0] + " and spent " +  (100 - (10 * (v.split("&")[1]).split(".")[1][1])) + "% of the time available.");
					};
				};
			};
			$(".closeIcon,.closeIcon2").click(function() {
				$(".active").removeClass("active");
			});
			$("#LoginButton").click(function() {
				$("#UserAccountDialogHeader").html("Login");
				$(".active").removeClass("active");
				$("#UserAccountLoginForm,.userAccountDialog,.finishedOverlay,.userAccountDialog").addClass("active");
			});
			$("#SignUpButton,.signUpButton").click(function() {
				$("#UserAccountDialogHeader").html("Sign Up");
				$(".active").removeClass("active");
				$("#UserAccountSignUpForm,.userAccountDialog,.finishedOverlay,.userAccountDialog").addClass("active");
			});
		});
		function userPrompt(header,message) {
			$("#FinishedOverlay").html(header);
			$("#ScoreOverlay").html(message);
			$(".finishedOverlay, #FinishedOverlay").addClass("active");
			setTimeout(function() {
				$(".finishedBar").addClass("active");
			},550);
			$(".finishedContent").addClass("active");
			$("#FinishedBars > li").each(function() {
				var rand = Math.floor(Math.random() * (136)) + 15;
				$(this).height(rand);
				$(this).css("margin-top",150-rand);
			});
		};
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
