<?php
session_start();
$loggedIn = false;
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
		$loggedIn = true;
	} else {
		$_SESSION["loggedIn"] = false;
		$_SESSION["userID"] = null;
	};
};
if (in_array(strval($_GET["t"]),["Addition","Division","Quadratics","Logarithms"]) && !$_SESSION["loggedIn"] && !isset($_SESSION["userID"])) {
	$guestPractice = true;
	$_SESSION["guestPractice"] = true;
} else {
	$guestPractice = false;
	$_SESSION["guestPractice"] = false;
};
if ($_SESSION["loggedIn"]) {
	$loggedIn = true;
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width" />
	<meta name="description" content="Have a go on our mental arithmetic test containing up to 150 unique questions for year receptions to year 6s to year 13s!"/>
	<meta name="keywords" content="Play,Maths Games,Maths,Mental Maths Test,Online Maths Test">
	<meta name="author" content="Harry Verhoef"/>
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
	<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
	<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
	<link rel="manifest" href="/manifest.json">
	<title>MentalMathsTest | Play our online Mathematics tests!</title>
	<link rel="stylesheet" type="text/css" href="header.css?225d4"/>
	<link rel="stylesheet" type="text/css" href="playbody.css?2ddasd3692"/>
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
	<div class="classForm">
		<form>
			<label for="ClassNickname">Enter nickname and wait until the game starts!</label>
			<input type="text" name="classnickname" id="ClassNickname" placeholder="Enter Nickname">
			<input type="submit" name="classnicknamesubmit" id="ClassNicknameSubmit" value="Start!">
		</form>
	</div>
	<div class="bodyContent">
		<div class="bodyWrapper">

			<div class="play">
				<div class="questionArea">
					<h3 id="HeaderH3">Level <span id="LevelCounter">1</span> Question <span id="QuestionCounter">1</span> is...</h3>
					<p id="Question">
					<?
					$_SESSION["customID"] = strval($_GET["t"]);
					if (!isset($_GET["t"])) {
						unset($_SESSION["customID"]);
					} else {
						$_SESSION["customTest"] = true;
						$customTest = true;
					};
					/*
					if (isset($_GET["class"]) && $_GET["class"] == "true" && isset($_SESSION["test_token"]) && isset($_SESSION["test_format"])) {
						// Class Test
						$_SESSION["customID"] = strval($_SESSION["test_format"]);
						$customTest = true;
					};*/
					$_SESSION["currentQuestion"] = array(1,1);
					$_SESSION["currentcustomQuestion"] = 1;
					$firstQuestion = true;
					$_SESSION["initialTime"] = time();
					$questionTime = $_SESSION["initialTime"];
					include "getQuestion.php";
					echo $outputArray[7];
					ob_end_flush();
					?>
					</p>
				</div>
				<div class="answerArea">
					<input type="text" id="Answer" name="answer" placeholder="<? echo $outputArray[6]; ?>" autofocus ><br>
					<input type="submit" id="AnswerButton" name="answerbutton" value="Submit Answer">
				</div>
			</div>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.1/MathJax.js?config=TeX-MML-AM_CHTML"></script>
	<script src="plugins/pace.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			setTimeout(function() {$("#Question").addClass("active")},400);
			$("#Question").css("margin-top",((($(window).height()-380)-$("#Question").height()+($("#HeaderH3").height() + 15))/2));
			$("#AnswerButton").click(function() {
				$("#Question").removeClass("active");
				$.ajax({
					url: "getQuestion.php",
					data: {answer: $("#Answer").val(),answerbutton: $("#AnswerButton").val()},
					dataType: "json",
					type: "post",
					success: function(output) {
						console.log(output);
						$("#LevelCounter").html(output[0]);
						$("#QuestionCounter").html(output[1]);
						$(".bodyContent").css("background-color","#"+["151515","284","b07070","664444","0ba","686","534","534","686","0ba","664444","b07070","284","151515","0ba"][parseInt(output[0])-1]);
						if (output[2] === "wrong" && output[4] === "notGuest") {
							window.location = "http://mentalmathstest.com/home?s=wrong&" + output[8][0] + "&" + output[8][1] + "&" + output[8][2];
						} else if (output[2] === "wrong" && output[4] === "guest") {
							window.location = "http://mentalmathstest.com?s=guestwrong&" + output[8][0] + "&" + output[8][1] + "&" + output[8][2];
						};
						if (output[3] === "end" && output[4] === "notGuest") {
							window.location = "http://mentalmathstest.com/home?s=end&" + output[8][0];
						} else if (output[3] === "end" && output[4] === "guest" && output[5] === "notCustom") {
							window.location = "http://mentalmathstest.com?s=guestfinished";
						} else if (output[3] === "end" && output[4] === "guest" && output[5] === "custom") {
							window.location = "http://mentalmathstest.com?s=customguestfinished";
						};
						$("#Answer").attr("placeholder",output[6]);
						$("#Question").html(output[7].replace("\"",""));
						setTimeout(function(){ $("#Question").addClass("active"); }, 400);
						MathJax.Hub.Queue(["Typeset",MathJax.Hub], function() {
							$("#Question").css("margin-top",((($(window).height()-380)-$("#Question").height()+($("#HeaderH3").height() + 15))/2));
						});
					}
				});
				$("#Answer").val("");
			});
			$("#Answer").focusout(function() {
				if (!$(".classForm").hasClass("active")) {
					$("#Answer").focus();
				};
			});
			$("#Answer").keypress(function(e) {
				if (e.which == 13) { // 13 = key code for "enter".
					$("#AnswerButton").click();
				};
			});
			$(window).resize(function() {
				$("#Question").css("margin-top",((($(window).height()-380)-$("#Question").height()+($("#HeaderH3").height() + 15))/2));
			});
			$(".menuIcon").click(function() {
				if ($(".menuIcon").hasClass("menu-active")) {
					$(".menuIcon,.hiddenMenu,.header,.bodyContent").removeClass("menu-active");
				} else {
					$(".menuIcon,.hiddenMenu,.header,.bodyContent").addClass("menu-active");
				};
			});

			if (location.search.split("class=").length > 1 && location.search.split("class=")[1] == "true") {
				$(".classForm").addClass("active");
			};
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
