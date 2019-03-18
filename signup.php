<?php
session_start();
$_SESSION["guest"] = false;
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
	if (hash("sha512",$token.$salt) === mysqli_real_escape_string($db,explode("_",$_COOKIE["rememberMe"])[1])) {
		include "rememberme.php";
		$_SESSION["loggedIn"] = true;
		$_SESSION["userID"] = $id;
	} else {
		$_SESSION["loggedIn"] = false;
		$_SESSION["userID"] = null;
	};
};
if ($_SESSION["loggedIn"] === true || isset($_SESSION["userID"])) {
	header("Location: http://mentalmathstest.com");
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width" />
	<meta charset="UTF-8"/>
	<meta name="description" content="Sign up now for free to access levels 5 and over on our mental arithmetic test that caters for all levels!"/>
	<meta name="keywords" content="Signup,Maths,Arithmetic,Mental Maths Test,Online Maths Test,Year 3, Year 4, Year 5, Year 6,KS3,KS4,KS5,GCSE,A-Level,Maths Test Signup">
	<meta name="author" content="Harry Verhoef"/>
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
	<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
	<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
	<link rel="manifest" href="/manifest.json">
	<title>MentalMathsTest | Sign Up to our online Maths testing site</title>
	<link rel="stylesheet" type="text/css" href="header.css?asd"/>
	<link rel="stylesheet" type="text/css" href="signupbody.css">
	<link rel="stylesheet" type="text/css" href="footer.css">
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
					<li><a href='http://mentalmathstest.com/home'><h2>HOME</h2></a><div class='verticalLineBreak loggedInHeader'></div></li>
					<li><a href='http://mentalmathstest.com/play'><h2>PLAY</h2></a></li>
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
	<video id="BodyBackground" autoplay loop>
		<source src="images/MMT_Background.mp4" type="video/mp4">
	</video>
	<div class="bodyContent">
		<div class="bodyWrapper">
			<div class="signUp">
				<h1 id="SignUpHeader">Sign Up</h2>
				<h3 id="SignUpReturnPrompt">Invalid registration details</h3>
				<form id="SignUpForm" action="register.php" method="post">
					<input type="email" placeholder="Email" id="SignUpEmail" name="signupemail" required autofocus/><br>
					<input type="text" placeholder="Username" id="SignUpUsername" name="signupusername" required/><br>
					<input type="password" placeholder="Password" id="SignUpPassword" name="signuppassword" required/><br>
					<input type="password" placeholder="Re-enter password" id="SignUpRePassword" name="signuprepassword" required/><br>
					Date Of Birth: <br><input type="number" placeholder="DD" id="SignUpD" name="signupd" min="1" max="31" maxlength="2" required/>
					<input type="number" placeholder="MM" id="SignUpM" name="signupm" min="1" max="12" maxlength="2" required/>
					<input type="number" placeholder="YYYY" id="SignUpY" name="signupy" min="1900" max="2016" maxlength="4" required/><br>
					Gender: <select form="SignUpForm" name="signupgender" required>
						<option value="">------</option>
						<option value="Male">Male</option>
						<option value="Female">Female</option>
					</select><br>
					<input type="checkbox" id="SignUpTermsAndConditions" name="signuptermsandconditions" value="termsandconditions" required/>
					<label for="SignUpTermsAndConditions">By registering to this website I agree to the
					<a href="termsandconditions.html" id="TermsAndConditionsLink">Terms and Conditions</a>
					and the <a href="privacypolicy.htm" id="PrivacyPolicyLink">Privacy Policy</a></label><br>
					<input type="submit" value="Sign Up" id="SignUpSubmit" name="signupsubmit" required/>
				</form>
			</div>
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
		$(document).ready(function(){
			function returnPrompt(returnString) {
				$("#SignUpReturnPrompt").html(returnString);
				$("#SignUpReturnPrompt").addClass("unsuccessful");
				setTimeout(function() {
					$("#SignUpReturnPrompt").removeClass("unsuccessful");
				}, 6000);
			};
			$(".signUp").css("margin-left",($(".bodyWrapper").width()-$(".signUp").width())/2);
			$(".signUp").css("margin-right",($(".bodyWrapper").width()-$(".signUp").width())/2);
			var s = location.search.split("s=")[1];
			if (location.search.split("s=").length > 1) {
				if (s == "false") {
					returnPrompt("Invalid Registration Inputs");
				} else if (s == "username") {
					returnPrompt("Invalid Username");
				} else if (s == "usernametaken") {
					returnPrompt("Username already being used");
				} else if (s == "email") {
					returnPrompt("Invalid Email");
				} else if (s == "emailtaken") {
					returnPrompt("Email already being used");
				} else if (s == "passwordsdifferent") {
					returnPrompt("Passwords didn't match");
				} else if (s == "date") {
					returnPrompt("Invalid Date");
				} else if (s == "termsandconditions") {
					returnPrompt("Please accept the terms and conditions");
				} else if (s === "guestfinished") {
					returnPrompt("Guests can only reach level 5!");
				} else if (!isNaN((s.split("guestwrong"))[1])) {
					returnPrompt("You scored " + s.split("guestwrong")[1] + ", sign up to access all levels!");
				};
			};
			$(window).resize(function() {
				$(".signUp").css("margin-left",($(".bodyWrapper").width()-$(".signUp").width())/2);
				$(".signUp").css("margin-right",($(".bodyWrapper").width()-$(".signUp").width())/2);
			});
			$(".menuIcon").click(function() {
				if ($(".menuIcon").hasClass("menu-active")) {
					$(".menuIcon,.hiddenMenu,.header").removeClass("menu-active");
				} else {
					$(".menuIcon,.hiddenMenu,.header").addClass("menu-active");
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
