<?php
session_start();
if (isset($_COOKIE["rememberMe"])) {
	$test1234 = "true";
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
if ($_SESSION["loggedIn"] !== true || !isset($_SESSION["userID"])) {
	header("Location: http://mentalmathstest.com");
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="Start an online interactive class test session now!"/>
	<meta name="keywords" content="Create class test,Maths test,Online maths test,Maths,Statistics,Play,Maths Games,Demographics">
	<meta name="author" content="Harry Verhoef"/>
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
	<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
	<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
	<link rel="manifest" href="/manifest.json">
	<title>MentalMathsTest | Create a class test!</title>
	<link rel="stylesheet" type="text/css" href="header.css?1227d2573"/>
	<link rel="stylesheet" type="text/css" href="createClassTestBody.css?<? echo time(); ?>"/>
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
	<div class="bodyContent">
		<div class="bodyWrapper">
			<div class="classTestContent">
				<h1 id="CreateClassTestHeader">Join with code:<br>[Class Test Code]</h1>
				<div class="classTestRibbon">
					<div class="playerCounter">
						<h3>0 Players</h3>
					</div>
					<div class="testFormat">
						<h3>Format: [Test Format]</h3>
					</div>
				</div>
			</div>
			<div class="leftTutorial active">
				<form id="LeftTutorialForm">
					<h3>1. Test Structure</h3>
					<label for="CustomTestToken">Enter the name of the custom test you'd like this test to be run with.</label>
					<input type="text" name="customtesttoken" id="CustomTestToken" placeholder="Code">
					<h3>2. Public Name</h3>
					<label for="ClassTestToken">This is the name users will enter to join the lobby. Make sure it's a good one!</label>
					<input type="text" name="classtesttoken" id="ClassTestToken" placeholder="Name">
					<h3>3. Press this button</h3>
					<label for="ClasstestSubmit">This will launch your class test into the internet for the world to see!</label>
					<div class="classTestSubmit">
						<h3>Launch!</h3>
					</div>
				</form>
			</div>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
	<script src="plugins/unslider-min.js"></script>
	<script src="plugins/Chart.min.js"></script>
	<script src="plugins/pace.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#CustomTestToken").on("change keyup paste", function() {
				if ($("#CustomTestToken").val() != "") {
					var html = $("#CustomTestToken").val();
					var div = document.createElement("div");
					div.innerHTML = html;
					var text = div.textContent || div.innerText || "";
					$(".testFormat").html("<h3>Format: " + text + "<h3>");
				} else {
					$(".testFormat").html("<h3>Format: [Test Format]<h3>");
				};
			});
			$("#ClassTestToken").on("change keyup paste", function() {
				if ($("#ClassTestToken").val() != "") {
					var html = $("#ClassTestToken").val();
					var div = document.createElement("div");
					div.innerHTML = html;
					var text = div.textContent || div.innerText || "";
					$("#CreateClassTestHeader").html("Join with code:<br>" + text);
				} else {
					$("#CreateClassTestHeader").html("Join with code:<br>[Enter Test Code]");
				};
			});
			$(".classTestSubmit").click(function() {
				$.ajax({
					url: "startClassTest.php",
					method: "post",
					data: {format: $("#CustomTestToken").val(),name: $("#ClassTestToken").val()},
					success: function(data) {
						console.log(data);
						if (data == "success") {
							$(".leftTutorial").removeClass("active");
							$(".classTestContent,.bodyWrapper").addClass("active");
						};
					}
				});
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
