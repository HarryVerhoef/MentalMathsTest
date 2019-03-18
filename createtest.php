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
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width" />
	<meta name="description" content="Create your own custom test for students or others to complete!"/>
	<meta name="keywords" content="Create,Maths,Create Maths Test,Make Maths Test,Easy,Hard">
	<meta name="author" content="Harry Verhoef"/>
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
	<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
	<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
	<link rel="manifest" href="/manifest.json">
	<title>MentalMathsTest | Create a custom Mathematics test!</title>
	<link rel="stylesheet" type="text/css" href="header.css?12f8d34"/>
	<link rel="stylesheet" type="text/css" href="createtestbody.css?21s3d534"/>
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
	<div class="finishedOverlay">
		<div class="finishedContent">
			<img class="closeIcon" src="images/CloseIcon2.png" alt="Close Menu">
			<p id="FinishedOverlay"></p>
			<p id="ScoreOverlay"></p>
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
	</div>
	<div class="bodyContent">
		<div class="adParent left">
			<div class="createAdLeft">
				<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
				<!-- createTestLeft -->
				<ins class="adsbygoogle" style="display:inline-block;width:160px;height:600px" data-ad-client="ca-pub-8271963858208371" data-ad-slot="7598126840"></ins>
				<script>
					(adsbygoogle = window.adsbygoogle || []).push({});
				</script>
			</div>
		</div>
		<div class="bodyWrapper">
			<h1 id="CreateHeader">Create a Test</h1>
			<div class="createForm">
				<div id="CreateForm">
					<div class="structureForm">
						<h2 id="StructureHeader">Structure</h2>
						<ol id="LevelList">
							<li id="1" class="active-level"><p>1</p></li>
						</ol>
						<form id="LevelForm1" class="current">
							<div class="dragAndDropQuestions">
								<div class="liveQuestions">
									<div class="dragQuestion active">
										<p>Next Question Here</p>
									</div>
									<div class="dragQuestion semi-active">
										<p>Next Question Here</p>
									</div>
								</div>
								<div class="timeAllocated">
									<p>Time allocated to level (seconds):</p>&nbsp;&nbsp;<input type="number" id="TimeAllocated" name="timeallocated" min="1" required>
								</div>
							</div>
						</form>
						<div class="deleteLevel">
							<p>Delete Level</p>
						</div>
						<div class="nextLevel">
							<p>Next Level</p>
						</div>
						<div class="verticalLineBreak create">
						</div>
					</div>
					<div class="horizontalAdvertisement mobile">
						<p class="advertisementPrompt">Please consider disabling AdBlock ;)</p>
						<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
						<!-- CreateTestMobile -->
						<ins class="adsbygoogle" style="display:inline-block;width:320px;height:100px" data-ad-client="ca-pub-8271963858208371" data-ad-slot="2003004445"></ins>
						<script>
							(adsbygoogle = window.adsbygoogle || []).push({});
						</script>
					</div>
					<div class="questionsForm">
						<div class="presetQuestions">
							<h2 id="QuestionsHeader">Randomly Generated Questions</h2>
							<input type="text" id="SearchBar" placeholder="Search for topics">
							<div class="questionSelect">
								<div id="SimpleAddition" class="very-easy">
									<h4 class="topicHeader">Simple Addition</h4>
									<ol class="topicOl">
										<li><p class="topicDifficulty">Difficulty: Very Easy</p></li>
										<li><p class="topicTime">Average Time: 2s</p></li>
										<li><p class="topicYear">Year: Reception</p></li>
									</ol>
									<input type="hidden" value="1" class="hiddenValue">
								</div>
								<div id="SimpleSutraction" class="very-easy">
									<h4 class="topicHeader">Simple Subtraction</h4>
									<ol class="topicOl">
										<li><p class="topicDifficulty">Difficulty: Very Easy</p></li>
										<li><p class="topicTime">Average Time: 5s</p></li>
										<li><p class="topicYear">Year: 1</p></li>
									</ol>
									<input type="hidden" value="2" class="hiddenValue">
								</div>
								<div id="Addition" class="easy">
									<h4 class="topicHeader">Addition</h4>
									<ol class="topicOl">
										<li><p class="topicDifficulty">Difficulty: Easy</p></li>
										<li><p class="topicTime">Average Time: 5s</p></li>
										<li><p class="topicYear">Year: 1-2</p></li>
									</ol>
									<input type="hidden" value="3" class="hiddenValue">
								</div>
								<div id="Subtraction" class="easy">
									<h4 class="topicHeader">Subtraction</h4>
									<ol class="topicOl">
										<li><p class="topicDifficulty">Difficulty: Easy</p></li>
										<li><p class="topicTime">Average Time: 6s</p></li>
										<li><p class="topicYear">Year: 1-2</p></li>
									</ol>
									<input type="hidden" value="4" class="hiddenValue">
								</div>
								<div id="SimpleMultiplication" class="easy">
									<h4 class="topicHeader">Simple Multiplication</h4>
									<ol class="topicOl">
										<li><p class="topicDifficulty">Difficulty: Easy</p></li>
										<li><p class="topicTime">Average Time: 4s</p></li>
										<li><p class="topicYear">Year: 2</p></li>
									</ol>
									<input type="hidden" value="5" class="hiddenValue">
								</div>
								<div id="Multiplication" class="easy">
									<h4 class="topicHeader">Multiplication</h4>
									<ol class="topicOl">
										<li><p class="topicDifficulty">Difficulty: Easy</p></li>
										<li><p class="topicTime">Average Time: 6s</p></li>
										<li><p class="topicYear">Year: 2</p></li>
									</ol>
									<input type="hidden" value="6" class="hiddenValue">
								</div>
								<div id="SimpleDivision" class="easy">
									<h4 class="topicHeader">Simple Division</h4>
									<ol class="topicOl">
										<li><p class="topicDifficulty">Difficulty: Easy</p></li>
										<li><p class="topicTime">Average Time: 5s</p></li>
										<li><p class="topicYear">Year: 3</p></li>
									</ol>
									<input type="hidden" value="7" class="hiddenValue">
								</div>
								<div id="Division" class="easy">
									<h4 class="topicHeader">Division</h4>
									<ol class="topicOl">
										<li><p class="topicDifficulty">Difficulty: Easy</p></li>
										<li><p class="topicTime">Average Time: 6s</p></li>
										<li><p class="topicYear">Year: 3</p></li>
									</ol>
									<input type="hidden" value="8" class="hiddenValue">
								</div>
								<div id="SimpleCombinedOperation" class="medium">
									<h4 class="topicHeader">Simple Combined Operation (Addition + Multiplication)</h4>
									<ol class="topicOl">
										<li><p class="topicDifficulty">Difficulty: Medium</p></li>
										<li><p class="topicTime">Average Time: 12s</p></li>
										<li><p class="topicYear">Year: 4</p></li>
									</ol>
									<input type="hidden" value="9" class="hiddenValue">
								</div>
								<div id="CombinedOperation" class="medium">
									<h4 class="topicHeader">Combined Operation (With Division)</h4>
									<ol class="topicOl">
										<li><p class="topicDifficulty">Difficulty: Medium</p></li>
										<li><p class="topicTime">Average Time: 12s</p></li>
										<li><p class="topicYear">Year: 4-5</p></li>
									</ol>
									<input type="hidden" value="10" class="hiddenValue">
								</div>
								<div id="Bidmas" class="medium">
									<h4 class="topicHeader">BIDMAS</h4>
									<ol class="topicOl">
										<li><p class="topicDifficulty">Difficulty: Medium</p></li>
										<li><p class="topicTime">Average Time: 11s</p></li>
										<li><p class="topicYear">Year: 5</p></li>
									</ol>
									<input type="hidden" value="11" class="hiddenValue">
								</div>
								<div id="DecimalArithmetic" class="medium">
									<h4 class="topicHeader">Decimal Arithmetic</h4>
									<ol class="topicOl">
										<li><p class="topicDifficulty">Difficulty: Medium</p></li>
										<li><p class="topicTime">Average Time: 7s</p></li>
										<li><p class="topicYear">Year: 5</p></li>
									</ol>
									<input type="hidden" value="12" class="hiddenValue">
								</div>
								<div id="LinearAlgebra1" class="medium">
									<h4 class="topicHeader">Linear Algebra (Addition/Subtraction)</h4>
									<ol class="topicOl">
										<li><p class="topicDifficulty">Difficulty: Medium</p></li>
										<li><p class="topicTime">Average Time: 5s</p></li>
										<li><p class="topicYear">Year: 5-6</p></li>
									</ol>
									<input type="hidden" value="13" class="hiddenValue">
								</div>
								<div id="LinearAlgebra2" class="medium">
									<h4 class="topicHeader">Linear Algebra (Multiplication/Division)</h4>
									<ol class="topicOl">
										<li><p class="topicDifficulty">Difficulty: Medium</p></li>
										<li><p class="topicTime">Average Time: 10s</p></li>
										<li><p class="topicYear">Year: 5-6</p></li>
									</ol>
									<input type="hidden" value="14" class="hiddenValue">
								</div>
								<div id="Exponents" class="medium">
									<h4 class="topicHeader">Exponents</h4>
									<ol class="topicOl">
										<li><p class="topicDifficulty">Difficulty: Medium</p></li>
										<li><p class="topicTime">Average Time: 6s</p></li>
										<li><p class="topicYear">Year: 6</p></li>
									</ol>
									<input type="hidden" value="15" class="hiddenValue">
								</div>
								<div id="Roots" class="medium">
									<h4 class="topicHeader">Square/Cube Roots</h4>
									<ol class="topicOl">
										<li><p class="topicDifficulty">Difficulty: Medium</p></li>
										<li><p class="topicTime">Average Time: 12s</p></li>
										<li><p class="topicYear">Year: 6</p></li>
									</ol>
									<input type="hidden" value="16" class="hiddenValue">
								</div>
								<div id="Quadratics" class="medium">
									<h4 class="topicHeader">Quadratics</h4>
									<ol class="topicOl">
										<li><p class="topicDifficulty">Difficulty: Medium</p></li>
										<li><p class="topicTime">Average Time: 16s</p></li>
										<li><p class="topicYear">Year: 7-8</p></li>
									</ol>
									<input type="hidden" value="17" class="hiddenValue">
								</div>
								<div id="Surds" class="medium">
									<h4 class="topicHeader">Surds</h4>
									<ol class="topicOl">
										<li><p class="topicDifficulty">Difficulty: Medium</p></li>
										<li><p class="topicTime">Average Time: 11s</p></li>
										<li><p class="topicYear">Year: 9</p></li>
									</ol>
									<input type="hidden" value="18" class="hiddenValue">
								</div>
								<div id="Cubics" class="hard">
									<h4 class="topicHeader">Cubics</h4>
									<ol class="topicOl">
										<li><p class="topicDifficulty">Difficulty: Hard</p></li>
										<li><p class="topicTime">Average Time: 19s</p></li>
										<li><p class="topicYear">Year: 10-11</p></li>
									</ol>
									<input type="hidden" value="19" class="hiddenValue">
								</div>
								<div id="Factorials" class="hard">
									<h4 class="topicHeader">Factorials</h4>
									<ol class="topicOl">
										<li><p class="topicDifficulty">Difficulty: Hard</p></li>
										<li><p class="topicTime">Average Time: 7s</p></li>
										<li><p class="topicYear">Year: 10-11</p></li>
									</ol>
									<input type="hidden" value="20" class="hiddenValue">
								</div>
								<div id="Trigonometric" class="hard">
									<h4 class="topicHeader">Trigonometric Functions</h4>
									<ol class="topicOl">
										<li><p class="topicDifficulty">Difficulty: Hard</p></li>
										<li><p class="topicTime">Average Time: 15s</p></li>
										<li><p class="topicYear">Year: 11</p></li>
									</ol>
									<input type="hidden" value="21" class="hiddenValue">
								</div>
								<div id="Logarithms" class="hard">
									<h4 class="topicHeader">Logarithms</h4>
									<ol class="topicOl">
										<li><p class="topicDifficulty">Difficulty: Hard</p></li>
										<li><p class="topicTime">Average Time: 14s</p></li>
										<li><p class="topicYear">Year: 12</p></li>
									</ol>
									<input type="hidden" value="22" class="hiddenValue">
								</div>
								<div id="ComplexNumbers" class="hard">
									<h4 class="topicHeader">Complex Numbers</h4>
									<ol class="topicOl">
										<li><p class="topicDifficulty">Difficulty: Hard</p></li>
										<li><p class="topicTime">Average Time: 9s</p></li>
										<li><p class="topicYear">Year: 12</p></li>
									</ol>
									<input type="hidden" value="23" class="hiddenValue">
								</div>
								<div id="HarderLogs" class="hard">
									<h4 class="topicHeader">Harder Logarithms</h4>
									<ol class="topicOl">
										<li><p class="topicDifficulty">Difficulty: Hard</p></li>
										<li><p class="topicTime">Average Time: 14s</p></li>
										<li><p class="topicYear">Year: 12</p></li>
									</ol>
									<input type="hidden" value="24" class="hiddenValue">
								</div>
								<div id="AdvancedLogs" class="very-hard">
									<h4 class="topicHeader">Advanced Logarithms</h4>
									<ol class="topicOl">
										<li><p class="topicDifficulty">Difficulty: Very Hard</p></li>
										<li><p class="topicTime">Average Time: 19s</p></li>
										<li><p class="topicYear">Year: 12</p></li>
									</ol>
									<input type="hidden" value="25" class="hiddenValue">
								</div>
								<div id="Integration" class="very-hard">
									<h4 class="topicHeader">Integration</h4>
									<ol class="topicOl">
										<li><p class="topicDifficulty">Difficulty: Very Hard</p></li>
										<li><p class="topicTime">Average Time: 21s</p></li>
										<li><p class="topicYear">Year: 12</p></li>
									</ol>
									<input type="hidden" value="26" class="hiddenValue">
								</div>
								<div id="TrigIntegration" class="very-hard">
									<h4 class="topicHeader">Integration of Trigonometric Functions</h4>
									<ol class="topicOl">
										<li><p class="topicDifficulty">Difficulty: Very Hard</p></li>
										<li><p class="topicTime">Average Time: 18s</p></li>
										<li><p class="topicYear">Year: 13</p></li>
									</ol>
									<input type="hidden" value="27" class="hiddenValue">
								</div>
								<div id="TrigDifferentiation" class="very-hard">
									<h4 class="topicHeader">Differentiation of Trigonometric Functions</h4>
									<ol class="topicOl">
										<li><p class="topicDifficulty">Difficulty: Very Hard</p></li>
										<li><p class="topicTime">Average Time: 16s</p></li>
										<li><p class="topicYear">Year: 13</p></li>
									</ol>
									<input type="hidden" value="28" class="hiddenValue">
								</div>
								<div id="LogDifferentiation" class="very-hard">
									<h4 class="topicHeader">Differentiation of Logarithms</h4>
									<ol class="topicOl">
										<li><p class="topicDifficulty">Difficulty: Very Hard</p></li>
										<li><p class="topicTime">Average Time: 23s</p></li>
										<li><p class="topicYear">Year: 13</p></li>
									</ol>
									<input type="hidden" value="29" class="hiddenValue">
								</div>
							</div>
						</div>
						<div class="horizontalLineBreak create">
						</div>
						<div class="createQuestion">
							<h3 id="CreateQuestionHeader">Create Question</h3>
							<input type="text" id="CreatedQuestion" placeholder="Question"><br>
							<input type="text" id="CreatedAnswer" placeholder="Answer"><br>
							<input type="button" value="+ Add" id="AddCreatedQuestionButton">
						</div>
					</div>
				</div>
			</div>
			<div class="submitTest">
				<p>Generate Test</p>
			</div>
		</div>
		<div class="adParent right">
			<div class="createAdRight">
				<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
				<!-- createTestRight -->
				<ins class="adsbygoogle" style="display:inline-block;width:160px;height:600px" data-ad-client="ca-pub-8271963858208371" data-ad-slot="3028326441"></ins>
				<script>
					(adsbygoogle = window.adsbygoogle || []).push({});
				</script>
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
		$(document).ready(function() {
			$(".bodyContent").height($(document).height());
			$(".createAdLeft, .createAdRight").css("top",($(window).height()-600)/2);
			$(".bodyWrapper").width($(window).width()-520);
			$(".questionSelect > div").click(function() {
				$(".current .dragQuestion.active").html(
					"<div id='" + $(this).attr("id") + "Active" + "' class='" + $(this).attr("class") + "'>\
						<h4 class='topicHeader'>" + $(this).find(".topicHeader").html() + "</h4>\
						<ol class='topicOl'>\
							<li><p class='topicDifficulty'>" + $(this).find(".topicDifficulty").html() + "</p></li>\
							<li><p class='topicTime'>" + $(this).find(".topicTime").html() + "</p></li>\
							<li><p class='topicYear'>" + $(this).find(".topicYear").html() + "</p></li>\
						</ol>\
						<input type='hidden' value='" + $(this).find(".hiddenValue").val() + "' class='questionType' name='questiontype" + $(".current .questionType").length + "' />\
						<img class='closeIcon' src='images/CloseIcon.png' alt='Remove Question'>\
					</div>"
				);
				$(".current .dragQuestion.active").addClass("inactive");
				$(".current .dragQuestion.active").removeClass("active");
				if ($(".current .dragQuestion").length < 10) {
					$(".current .dragQuestion.semi-active").addClass("active");
					$(".current .dragQuestion.semi-active").removeClass("semi-active");
					$(".current .dragQuestion.active").after("<div class='dragQuestion semi-active'><p>Next Question Here</p></div>");
				} else if ($(".current .dragQuestion").length === 10) {
					$(".current .dragQuestion.semi-active").addClass("active");
					$(".current .dragQuestion.semi-active").removeClass("semi-active");
				};
			});
			$("#AddCreatedQuestionButton").click(function() {
				var numCreated = $(".custom").length;
				$(".current .dragQuestion.active").html(
					"<div class='custom'>\
						<h4 class='topicHeader'>Custom Question</h4>\
						<ol class='topicOl'>\
							<li><p class='topicQuestion'>Question: " + $("#CreatedQuestion").val() + "</p></li>\
							<li><p class='topicAnswer'>Answer: " + $("#CreatedAnswer").val() + "</p></li>\
						</ol>\
						<input type='hidden' value='" + $("#CreatedQuestion").val() + "&&&" + $("#CreatedAnswer").val() + "' class='customQuestion' name='customquestion" + $(".current .customQuestion").length + "' />\
						<img class='closeIcon' src='images/CloseIcon.png' alt='Remove Question'>\
					</div>"
				);
				$(".current .dragQuestion.active").addClass("inactive");
				$(".current .dragQuestion.active").removeClass("active");
				if ($(".current .dragQuestion").length < 10) {
					$(".current .dragQuestion.semi-active").addClass("active");
					$(".current .dragQuestion.semi-active").removeClass("semi-active");
					$(".current .dragQuestion.active").after("<div class='dragQuestion semi-active'><p>Next Question Here</p></div>");
				} else if ($(".current .dragQuestion").length === 10) {
					$(".current .dragQuestion.semi-active").addClass("active");
					$(".current .dragQuestion.semi-active").removeClass("semi-active");
				};
			});
			$(document).on("click", ".closeIcon", function() {
				if ($(".current .dragQuestion.inactive").length < 9) {
					$(this).parent().parent().remove();
				} else if ($(".current .dragQuestion.inactive").length === 9) {
					$(this).parent().parent().remove();
					$(".dragQuestion.active").after("<div class='dragQuestion semi-active'><p>Next Question Here</p></div>");
				} else if ($(".current .dragQuestion.inactive").length === 10) {
					$(this).parent().parent().remove();
					$(".current .dragQuestion.inactive").last().after("<div class='dragQuestion active'><p>Next Question Here</p></div>")
				};
			});
			$(".nextLevel").click(function() {
				var numLevels = $("#LevelList > li").length;
				$(".active-level").removeClass("active-level");
				if (numLevels <= 9) {
					$("#" + numLevels).after("<li id='" + (numLevels + 1).toString() + "' class='active-level'><p>" + (numLevels + 1).toString() + "</p></li>");
				} else {
					alert("Maximum of 10 levels!");
				};
				$(".current").removeClass("current");
				$("#LevelForm" + numLevels.toString()).after("\
						<form id='LevelForm" + (numLevels + 1).toString() + "' class='current'>\
							<div class='dragAndDropQuestions'>\
								<div class='liveQuestions'>\
									<div class='dragQuestion active'>\
										<p>Next Question Here</p>\
									</div>\
									<div class='dragQuestion semi-active'>\
										<p>Next Question Here</p>\
									</div>\
								</div>\
								<div class='timeAllocated'>\
									<p>Time allocated to level (seconds):</p>&nbsp;&nbsp;<input type='number' class='timeAllocated' name='timeallocated" + (numLevels + 1).toString() + "' min='1' required>\
								</div>\
							</div>\
						</form>\
				");
			});
			$(".deleteLevel").click(function() {
				var deletingLevel = $(".active-level p").html();
				var numLevels = $("#LevelList li").length;
				console.log(deletingLevel);
				console.log($("#LevelList li").length);
				if (deletingLevel == numLevels) {
					if (deletingLevel == 1) {
						alert("You cannot delete level 1!");
					} else {
						// Deleting Last level
						$("#LevelList li").last().remove();
						console.log($("#LevelList li").last().html());
						$("#LevelList li").last().addClass("active-level");
						$("#LevelForm" + deletingLevel.toString()).remove();
						$(".current").removeClass("current");
						$("#LevelForm" + $(".active-level p").html()).addClass("current");
					};
				} else {
					// Deleting a Level before last
					$(".active-level").removeClass("active-level");
					$("#LevelList li").last().remove();
					$("#LevelList li:nth-of-type(" + deletingLevel.toString() + ")").addClass("active-level");
					var deletingLevel = $(".active-level p").html();
					var numLevels = $("#LevelList li").length;
					console.log(parseInt(numLevels) - deletingLevel);
					$("#LevelForm" + deletingLevel).remove();
					for (var i = 0; i <= parseInt(numLevels) - deletingLevel; i++) {
						console.log("$(#LevelForm" + (deletingLevel+i+1).toString() + ").attr('id',#LevelForm" + (parseInt(deletingLevel)+parseInt(i)) + ");");
						$("#LevelForm" + (parseInt(deletingLevel)+parseInt(i)+1).toString()).attr("id","LevelForm" + (parseInt(deletingLevel)+parseInt(i)));
					}
					$(".current").removeClass("current");
					$("#LevelForm" + $(".active-level p").html()).addClass("current");
				};

			});

			$("#SearchBar").keyup(function() {
				if ($("#SearchBar").val().length >= 3) {
					var searchQuery = $("#SearchBar").val().toLowerCase();
					var searchQuery = searchQuery.replace("adding"," addition ");
					var searchQuery = searchQuery.replace("plus"," addition ");
					var searchQuery = searchQuery.replace("minusing"," subtraction ");
					var searchQuery = searchQuery.replace("minus"," subtraction ");
					var searchQuery = searchQuery.replace("times"," multiplication ");
					var searchQuery = searchQuery.replace("product"," multiplication ");
					var searchQuery = searchQuery.replace("dividing"," division ");
					var searchQuery = searchQuery.replace("easy"," simple ");
					var searchQuery = searchQuery.replace("indice"," exponent ");
					var searchQuery = searchQuery.replace("log"," logarithms ");
					var searchQuery = searchQuery.replace("integral"," integration ");
					var searchQuery = searchQuery.replace("derivative"," differentiation ");
					var searchQuery = searchQuery.replace("trigonometry"," trigonometric ");
					var searchQuery = searchQuery.replace("bodmas"," bidmas ");
					var searchQueryArray = searchQuery.split(" ");
					searchQueryArray = searchQueryArray.filter(Boolean);
					$(".questionSelect > div").addClass("search-inactive");
					$(".questionSelect > div").each(function() {
						for (var i = 0; i <= searchQueryArray.length - 1; i++) {
							if ($(this).find(".topicHeader").html().toLowerCase().search(searchQueryArray[i]) >= 0) {
								$(this).removeClass("search-inactive");
							};
						};
					});
				} else {
					$(".search-inactive").removeClass("search-inactive");
				};
			});

			$(document).on("click","#LevelList > li", function() {
				$(".current").removeClass("current");
				$(".active-level").removeClass("active-level");
				var level = $(this).find("p").html();
				$("#LevelForm" + level.toString()).addClass("current");
				$(this).addClass("active-level");
			});


			$(".submitTest").click(function() {
				var numLevels = $("#LevelList li").length;
				var timeAllocatedArray = [];
				var levelArray = [];
				for (var i = 1; i <= numLevels; i++) {
					timeAllocatedArray.push($("#LevelForm" + i + " .timeAllocated input").val());
					levelArray.push([]);
					var numQuestions = $("#LevelForm" + i + " .dragQuestion.inactive").length;
					for (var x =  0; x < numQuestions; x++) {
						levelArray[i-1].push($("#LevelForm" + i + " .dragQuestion.inactive:nth-of-type(" + (parseInt(x) + 1) + ") input[type='hidden']").val());
					};
				};
				$.ajax({
					url: "createCustomTest.php",
					data: {timeperlevel:timeAllocatedArray,questions:levelArray},
					type: "post",
					success: function(output) {
						if (output.split("token=").length === 2) {
							window.location = "http://mentalmathstest.com/home?s=token&" + output.split("token=")[1].toString();
						} else if (output.split("token2=").length === 2) {
							$(".finishedOverlay, #FinishedOverlay").addClass("active");
							$("#FinishedOverlay").html("Congratulations, your custom test is now public!");
							$("#ScoreOverlay").html("To access it, use code: <span id='TokenOverlaySpan'>" + output.split("token2=")[1] + "</span> (<b>write that down</b>).<br>To automatically save test codes, <a href='http://mentalmathstest.com/signup'>Sign Up!</a>");
							setTimeout(function() {
								$(".finishedBar").addClass("active");
							},550);
							$(".finishedContent").addClass("active");
							$("#FinishedBars > li").each(function() {
								var rand = Math.floor(Math.random() * (100)) + 15;
								$(this).height(rand);
								$(this).css("margin-top",150-rand);
							});
						} else {
							alert(output);
						};
					}
				});
			});
			$(".closeIcon").click(function() {
				$(".finishedOverlay").removeClass("active");
				$(".finishedContent").removeClass("active");
				$(".finishedBar").removeClass("active");
			});
			$(window).resize(function() {
				$(".bodyContent").height($(".submitTest").offset().top + 340);
				if ($(document).width() >= 1300) {
					$(".bodyWrapper").width($(window).width()-520);
				};
			});
			$(".menuIcon").click(function() {
				if ($(".menuIcon").hasClass("menu-active")) {
					$(".menuIcon,.hiddenMenu,.header,.bodyContent,.adParent").removeClass("menu-active");
				} else {
					$(".menuIcon,.hiddenMenu,.header,.bodyContent,.adParent").addClass("menu-active");
				};
			});
		});
	</script>
</body>
</html>
