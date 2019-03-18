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
	<meta name="description" content="Analyse your previous MentalMathsTest scores and compare them to everybody else's!"/>
	<meta name="keywords" content="Home,Hub,Maths,Statistics,Play,Maths Games,Demographics">
	<meta name="author" content="Harry Verhoef"/>
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
	<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
	<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
	<link rel="manifest" href="/manifest.json">
	<title>MentalMathsTest | Home - Practice, Create, Attempt maths tests</title>
	<link rel="stylesheet" type="text/css" href="plugins/unslider.css">
	<link rel="stylesheet" type="text/css" href="header.css?1227ds2573"/>
	<link rel="stylesheet" type="text/css" href="homebody.css?<? echo time(); ?>"/>
	<link rel="stylesheet" type="text/css" href="footer.css?iu"/>
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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$(".bodyContent").height($(document).height());
			$(window).resize(function() {
				$(".bodyContent").height($(".parentBlock2").offset().top + $(".parentBlock2").height() + $(".practice").height() + 370);
			});
		});
	</script>
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
	<div class="carouselParent">
		<img src="images/BackgroundCarousel/bg.jpg" id="Background" alt="Background">
	</div>
	<div class="bodyContent">
		<div class="bodyWrapper">
			<h1 id="HomeHeader">Home</h1>
			<?php
				include "connect.php";
				$query = mysqli_stmt_init($db);
				mysqli_stmt_prepare($query,"SELECT USER_NAME FROM users WHERE USER_ID=?");
				mysqli_stmt_bind_param($query,"s",$id);
				$id = $_SESSION["userID"];
				mysqli_stmt_bind_result($query,$username);
				mysqli_stmt_execute($query);
				mysqli_stmt_fetch($query);
				mysqli_stmt_close($query);
				echo "<h2 id='UsernameHeader'>".strip_tags($username)."</h2>";
			?>
			<ol id="HomeHeaderOL">
				<li>
					<div class="createCustom">
						<a href="http://mentalmathstest.com/createtest"><h3 id="Custom">Create Custom Test</h3></a>
					</div>
				</li>
				<li>
					<div class="play">
						<a href="http://mentalmathstest.com/play"><h3 id="Play">Play Standard Test</h3></a>
					</div>
				</li>
				<li>
					<div class="playCustomParent">
						<div class="playCustom">
							<h3 id="Play">Play Custom Test</h3>
							<input type="text" placeholder="Enter Code" id="CustomToken"/>
						</div>
					</div>
				</li>
			</ol>
			<div class="parentBlock1">
				<div class="lastAttempts">
					<h3 id="AttemptsHeader">My Last 5 Attempts</h3>
					<div class="attemptsTable">
						<table id="AttemptsTable">
							<tr>
								<th>MMT Score</th>
								<th>Date / Server Time</th>
								<th>Time Taken</th>
							</tr>
							<?

							$query = mysqli_stmt_init($db);
							mysqli_stmt_prepare($query,"SELECT TIME_TAKEN, FINAL_SCORE, DATE_RECORDED FROM scores WHERE (USER_ID=? AND (TEST_TOKEN='' OR TEST_TOKEN IS NULL)) ORDER BY DATE_RECORDED DESC LIMIT 5");
							mysqli_stmt_bind_param($query,"s",$id);
							mysqli_stmt_bind_result($query,$time,$score,$date);
							mysqli_stmt_execute($query);
							$index = 0;
							while (mysqli_stmt_fetch($query)) {
								echo "<tr>";
								echo "<td class='previousScore'>".$score."</td>";
								echo "<td>".date("d-m-Y / H:i:s",strtotime($date))."</td>";
								echo "<td><span class='previousTime'>".$time."</span>s</td>";
								echo "</tr>";
								$index = $index + 1;
							};
							mysqli_stmt_close($query);
							if ($index == 0) {
								echo "<script>
								$('#AttemptsTable').addClass('empty');
								</script>
								<br><br><br>
								<h4 style='color: #8d8; font-weight: normal;'>You haven't completed a test yet!</h4>";
							};
							?>
						</table>
					</div>
				</div>
				<?
				$query = mysqli_stmt_init($db);
				mysqli_stmt_prepare($query,"SELECT USER_HIGHSCORE FROM users WHERE USER_ID=?");
				mysqli_stmt_bind_param($query,"s",$id);
				mysqli_stmt_bind_result($query,$highscore);
				mysqli_stmt_execute($query);
				mysqli_stmt_fetch($query);
				$highmessage = $highscore;
				if (!isset($highscore)) {
					$highmessage = "Nothing Yet!";
				};
				if ($highscore === $highmessage) {
					mysqli_stmt_prepare($query,"SELECT COUNT(*) FROM users WHERE USER_HIGHSCORE > ?");
					mysqli_stmt_bind_param($query,"s",$highscore);
					mysqli_stmt_bind_result($query,$rank);
					mysqli_stmt_execute($query);
					mysqli_stmt_fetch($query);
					$rank = $rank + 1;
				} else {
					$rank = "Last!";
				};
				mysqli_stmt_prepare($query,"SELECT USER_SEX, USER_DOB FROM users WHERE USER_ID=?");
				mysqli_stmt_bind_param($query,"s",$id);
				mysqli_stmt_bind_result($query,$sex,$dob);
				mysqli_stmt_execute($query);
				mysqli_stmt_fetch($query);
				// Get average score of user's sex
				mysqli_stmt_prepare($query,"SELECT AVG(USER_HIGHSCORE) FROM users WHERE USER_SEX=?");
				mysqli_stmt_bind_param($query,"s",$sex);
				mysqli_stmt_bind_result($query,$sexAverage);
				mysqli_stmt_execute($query);
				mysqli_stmt_fetch($query);


				mysqli_stmt_prepare($query,"SELECT AVG(USER_HIGHSCORE) FROM users WHERE TIMESTAMPDIFF(YEAR, USER_DOB, CURDATE()) BETWEEN ? AND ?");
				mysqli_stmt_bind_param($query,"ss",$lowerLimit,$upperLimit);
				$age = date_diff(date_create($dob), date_create("today"))->y;
				switch(true) {
					case $age < 11:
						$lowerLimit = 0;
						$upperLimit = 10;
						break;
					case $age < 13:
					$lowerLimit = 11;
						$upperLimit = 12;
						break;
					case $age < 15:
						$lowerLimit = 13;
						$upperLimit = 14;
						break;
					case $age < 17:
						$lowerLimit = 15;
						$upperLimit = 16;
						break;
					case $age < 22:
						$lowerLimit = 17;
						$upperLimit = 21;
						break;
					case $age < 36:
						$lowerLimit = 22;
						$upperLimit = 35;
						break;
					case $age < 51:
						$lowerLimit = 36;
						$upperLimit = 50;
						break;
					case $age < 66:
						$lowerLimit = 51;
						$upperLimit = 65;
						break;
					case $age < 81:
						$lowerLimit = 66;
						$upperLimit = 80;
						break;
					case $age > 80:
						$lowerLimit = 81;
						$upperLimit = 150;
						break;
				};
				mysqli_stmt_bind_result($query,$ageAverage);
				mysqli_stmt_execute($query);
				mysqli_stmt_fetch($query);
				mysqli_stmt_prepare($query,"SELECT AVG(USER_HIGHSCORE) FROM users WHERE USER_SEX = ? AND TIMESTAMPDIFF(YEAR, USER_DOB, CURDATE()) >= ? AND TIMESTAMPDIFF(YEAR, USER_DOB, CURDATE()) <= ?");
				mysqli_stmt_bind_param($query,"sss",$sex,$lowerLimit,$upperLimit);
				mysqli_stmt_bind_result($query,$demoAverage);
				mysqli_stmt_execute($query);
				mysqli_stmt_fetch($query);
				mysqli_stmt_close($query);
				?>
				<div class="yourStatsCondensed">
					<h3 id="StatisticsHeaderCondensed">Statistics</h3>
					<p>Your high score:</p><span class="condensedStat" id="HighScore"><? echo $highmessage; ?></span>
					<p>Your world rank:</p><span class="condensedStat"><? echo $rank; ?></span>
					<p>Average score for <? echo $sex; ?>s:</p><span class="condensedStat"><? echo round($sexAverage,2); ?></span>
					<p>Average score for ages <? echo $lowerLimit."-".$upperLimit; ?>:</p><span class="condensedStat"><? echo round($ageAverage,2); ?></span>
					<p>Average score for <? echo $sex."s aged ".$lowerLimit."-".$upperLimit; ?>:</p><span class="condensedStat"><? echo round($demoAverage,2); ?></span>
				</div>
			</div>
			<div class="horizontalAdvertisement">
				<p class="advertisementPrompt">Please consider disabling AdBlock ;)</p>
				<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
				<!-- HomeLeaderboard -->
				<ins class="adsbygoogle" style="display:inline-block;width:728px;height:90px" data-ad-client="ca-pub-8271963858208371" data-ad-slot="1667404046"></ins>
				<script>
					(adsbygoogle = window.adsbygoogle || []).push({});
				</script>
			</div>
			<div class="horizontalAdvertisement mobile">
				<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
				<!-- HomeMobileBanner1 -->
				<ins class="adsbygoogle" style="display:inline-block;width:320px;height:100px" data-ad-client="ca-pub-8271963858208371" data-ad-slot="3341966846"></ins>
				<script>
					(adsbygoogle = window.adsbygoogle || []).push({});
				</script>
			</div>
			<div class="parentBlock2">
				<div class="customs">
					<h3 id="CustomHeader">My Custom Tests</h3>
					<div class="customTestsContainer">
						<table id="CustomTestsTable">
							<?php

							$query = mysqli_stmt_init($db);
							mysqli_stmt_prepare($query,"SELECT TOKEN FROM customtokens WHERE CREATOR_ID=?");
							mysqli_stmt_bind_param($query,"s",$id);
							mysqli_stmt_bind_result($query,$token);
							mysqli_stmt_execute($query);
							$index = 0;
							$tokenArray = [];
							while (mysqli_stmt_fetch($query)) {
								array_push($tokenArray,$token);
							};
							$query = mysqli_stmt_init($db);
							mysqli_stmt_prepare($query,"SELECT COUNT(*) FROM scores WHERE TEST_TOKEN=?");
							mysqli_stmt_bind_param($query,"s",$token2);
							mysqli_stmt_bind_result($query,$numberOfAttempts);
							$attemptsArray = [];
							foreach ($tokenArray as $token2) {
								mysqli_stmt_execute($query);
								mysqli_stmt_fetch($query);
								array_push($attemptsArray,$numberOfAttempts);
							};
							foreach ($attemptsArray as $noAttempts) {
								echo "<tr>";
								echo "<td class='testTokenTD'><a href='http://mentalmathstest.com/play?t=".htmlspecialchars($tokenArray[$index])."' class='testToken'>".htmlspecialchars($tokenArray[$index])."</span></td>";
								echo "<td class='numberOfAttempts' data-token='".htmlspecialchars($tokenArray[$index])."'>".htmlspecialchars($noAttempts)." attempts</td>";
								echo "</tr>";
								$index = $index + 1;
							};
							mysqli_stmt_close($query);
							if ($index == 0) {
								echo "<script>
								$('#CustomTestsTable').addClass('empty');
								</script>
								<br><br><br>
								<h4 style='color: #8d8; font-weight: normal;'>You haven't created a test yet!</h4>";
							};
							?>
						</table>
					</div>
					<form id="CustomTestForm" action="leaderboard.php" method="post">
						<input type="hidden" id="TestTokenLeaderboard" name="testtoken" />
					</form>
				</div>
				<div class="demographicStats">
					<h3 id="DemographicsHeader">My demographic's statistics</h3>
					<div class="textAverages">
						<?

						echo "<p>Average score for <span id='SexLabel'>".$sex."s</span> :<br><span class='average' id='SexAverage'>".round($sexAverage, 2)."</span></p>";
						echo "<p>Average score for <span id='AgeLabel'>ages ".$lowerLimit."-".$upperLimit."</span>:<br><span class='average' id='AgeAverage'>".round($ageAverage, 2)."</span></p>";
						echo "<p>Average score for <span id='CombinedLabel'>".$sex."s aged ".$lowerLimit."-".$upperLimit."</span>:<br><span class='average' id='CombinedAverage'>".round($demoAverage, 2)."</span></p>";
						?>
						<div class="verticalLinebreak">
						</div>
					</div>
					<div class="graphAverages">
						<div class="graphAveragesContainer">
							<canvas id="DemographicChart"></canvas>
						</div>
					</div>
				</div>
			</div>
			<div class="horizontalAdvertisement">
				<p class="advertisementPrompt">Please consider disabling AdBlock ;)</p>
				<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
				<!-- HomeLeaderboard2 -->
				<ins class="adsbygoogle" style="display:inline-block;width:728px;height:90px" data-ad-client="ca-pub-8271963858208371" data-ad-slot="9051070049"></ins>
				<script>
					(adsbygoogle = window.adsbygoogle || []).push({});
				</script>
			</div>
			<div class="practice">
				<?
				$query = mysqli_stmt_init($db);
				mysqli_stmt_prepare($query,"SELECT MAX(FINAL_SCORE) FROM scores WHERE TEST_TOKEN=? AND USER_ID=?");
				mysqli_stmt_bind_param($query,"ss",$token,$id);
				mysqli_stmt_bind_result($query,$highscore);
				$tokenArray = ["Addition","Subtraction","Multiplication","Division","Decimals","Exponentiation","Quadratics","Surds","Cubics","Factorials","Trigonometry","Logarithms","ComplexNumbers","HarderLogarithms","Calculus"];
				$resultArray =[];
				$id = mysqli_real_escape_string($db,$id);
				for ($i=0; $i < 15; $i++) {
					$token = "practice".$tokenArray[$i];
					mysqli_stmt_execute($query);
					mysqli_stmt_fetch($query);
					if (!isset($highscore)) {
						array_push($resultArray,"0");
					} else {
						array_push($resultArray,$highscore);
					};
				};
				mysqli_stmt_close($query);
				?>
				<h3 id="PracticeHeader">Practice Mode</h3>
				<ol>
					<li><a href="http://mentalmathstest.com/play?t=Addition"><div class="practiceTopic"><h4 class="topicHeader">Addition</h4><p class="topicHighscore">Highscore: <span class="topicHS"><? echo $resultArray[0]; ?></span></p></div></a></li>
					<li><a href="http://mentalmathstest.com/play?t=Subtraction"><div class="practiceTopic"><h4 class="topicHeader">Subtraction</h4><p class="topicHighscore">Highscore: <span class="topicHS"><? echo $resultArray[1]; ?></span></p></div></a></li>
					<li><a href="http://mentalmathstest.com/play?t=Multiplication"><div class="practiceTopic"><h4 class="topicHeader">Multiplication</h4><p class="topicHighscore">Highscore: <span class="topicHS"><? echo $resultArray[2]; ?></span></p></div></a></li>
					<li><a href="http://mentalmathstest.com/play?t=Division"><div class="practiceTopic"><h4 class="topicHeader">Division</h4><p class="topicHighscore">Highscore: <span class="topicHS"><? echo $resultArray[3]; ?></span></p></div></a></li>
					<li><a href="http://mentalmathstest.com/play?t=Decimals"><div class="practiceTopic"><h4 class="topicHeader">Decimals</h4><p class="topicHighscore">Highscore: <span class="topicHS"><? echo $resultArray[4]; ?></span></p></div></a></li>
					<li><a href="http://mentalmathstest.com/play?t=Exponentiation"><div class="practiceTopic"><h4 class="topicHeader">Exponentiation</h4><p class="topicHighscore">Highscore: <span class="topicHS"><? echo $resultArray[5]; ?></span></p></div></a></li>
					<li><a href="http://mentalmathstest.com/play?t=Quadratics"><div class="practiceTopic"><h4 class="topicHeader">Quadratics</h4><p class="topicHighscore">Highscore: <span class="topicHS"><? echo $resultArray[6]; ?></span></p></div></a></li>
					<li><a href="http://mentalmathstest.com/play?t=Surds"><div class="practiceTopic"><h4 class="topicHeader">Surds</h4><p class="topicHighscore">Highscore: <span class="topicHS"><? echo $resultArray[7]; ?></span></p></div></a></li>
					<li><a href="http://mentalmathstest.com/play?t=Cubics"><div class="practiceTopic"><h4 class="topicHeader">Cubics</h4><p class="topicHighscore">Highscore: <span class="topicHS"><? echo $resultArray[8]; ?></span></p></div></a></li>
					<li><a href="http://mentalmathstest.com/play?t=Factorials"><div class="practiceTopic"><h4 class="topicHeader">Factorials</h4><p class="topicHighscore">Highscore: <span class="topicHS"><? echo $resultArray[9]; ?></span></p></div></a></li>
					<li><a href="http://mentalmathstest.com/play?t=Trigonometry"><div class="practiceTopic"><h4 class="topicHeader">Trigonometry</h4><p class="topicHighscore">Highscore: <span class="topicHS"><? echo $resultArray[10]; ?></span></p></div></a></li>
					<li><a href="http://mentalmathstest.com/play?t=Logarithms"><div class="practiceTopic"><h4 class="topicHeader">Logarithms</h4><p class="topicHighscore">Highscore: <span class="topicHS"><? echo $resultArray[11]; ?></span></p></div></a></li>
					<li><a href="http://mentalmathstest.com/play?t=ComplexNumbers"><div class="practiceTopic"><h4 class="topicHeader">Complex Numbers</h4><p class="topicHighscore">Highscore: <span class="topicHS"><? echo $resultArray[12]; ?></span></p></div></a></li>
					<li><a href="http://mentalmathstest.com/play?t=HarderLogarithms"><div class="practiceTopic"><h4 class="topicHeader">Harder Logarithms</h4><p class="topicHighscore">Highscore: <span class="topicHS"><? echo $resultArray[13]; ?></span></p></div></a></li>
					<li><a href="http://mentalmathstest.com/play?t=Calculus"><div class="practiceTopic"><h4 class="topicHeader">Calculus</h4><p class="topicHighscore">Highscore: <span class="topicHS"><? echo $resultArray[14]; ?></span></p></div></a></li>
				</ol>
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
	<script src="plugins/unslider-min.js"></script>
	<script src="plugins/Chart.min.js"></script>
	<script src="plugins/pace.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$(".carousel").unslider({
				autoplay: true,
				delay: 25000,
				nav: false,
				arrows: false,
				animation: "fade"

			});
			$("#Carousel").height($(window).height());
			var s = location.search.split("s=")[1];
			if (location.search.split("s=").length > 1) {
				var wrongData = s.split("wrong");
				var finishedData = s.split("end");
				var tokenData = s.split("token");
				if (finishedData.length > 1) {
					$(".finishedOverlay, #FinishedOverlay").addClass("active");
					$("#ScoreOverlay").html("You scored: <span id='ScoreOverlaySpan'>" + finishedData[1].split("&")[1] + "</span>");
					$("#FinishedOverlay").html("Congratulations! You finished the test!");
					setTimeout(function() {
						$(".finishedBar").addClass("active");
					},550);
					$(".finishedContent").addClass("active");
					$("#FinishedBars > li").each(function() {
						var rand = Math.floor(Math.random() * (136)) + 15;
						$(this).height(rand);
						$(this).css("margin-top",150-rand);
					});
				} else if (wrongData.length > 1) {
					$(".finishedOverlay").addClass("active");
					$("#ScoreOverlay").html("You scored: <span id='ScoreOverlaySpan'>" + wrongData[1].split("&")[1] + "</span>");
					$("#FinishedOverlay").html("Oops! " + wrongData[1].split("&")[3] + " was the wrong answer!");
					var answer = wrongData[1].split("&")[2];
					if (answer.split("_").length > 1) {
						answer = answer.replace(/_/g,",");
					};
					$("#AnswerOverlay").html("The answer was: " + answer);
					setTimeout(function() {
						$(".finishedBar").addClass("active");
					},550);
					$(".finishedContent").addClass("active");
					$("#FinishedBars > li").each(function() {
						var rand = Math.floor(Math.random() * (136)) + 15;
						$(this).height(rand);
						$(this).css("margin-top",150-rand);
					});
				} else if (tokenData.length > 1) {
					$(".finishedOverlay, #FinishedOverlay").addClass("active");
					$("#FinishedOverlay").html("Congratulations, your custom test is now public!");
					$("#ScoreOverlay").html("To access it, use code: <span id='TokenOverlaySpan'>" + tokenData[1].split("&")[1].toString() + "</span>");
					$("#CustomToken").val(tokenData[1].split("&")[1].toString());
					setTimeout(function() {
						$(".finishedBar").addClass("active");
					},550);
					$(".finishedContent").addClass("active");
					$("#FinishedBars > li").each(function() {
						var rand = Math.floor(Math.random() * (120)) + 15;
						$(this).height(rand);
						$(this).css("margin-top",150-rand);
					});
				};
			};
			$(".closeIcon").click(function() {
				$(".finishedOverlay").removeClass("active");
				$(".finishedContent").removeClass("active");
				$(".finishedBar").removeClass("active");
			});
			if ($(".previousScore").length) {
				var total = 0;
				$(".previousScore").each(function(i,e) {
					total = total + Number($(e).html());
				});
				$("#AttemptsHeader").html("My Last 5 Attempts: Average " + (Math.round((total/$(".previousScore").length) * 100) / 100).toString());
				$(".previousTime").each(function(i, e) {
					if (parseInt($(e).html()) >= 60) {
						$(e).html((Math.floor($(e).html() / 60) ).toString() + "m " + ($(e).html() % 60));
					};
				});
				var ctx = $("#DemographicChart");
				Chart.defaults.global.defaultFontColor = "#ffffff";
				var DemographicsChart = new Chart(ctx, {
					type: "bar",
					data: {

						labels: ["<? echo $sex; ?>s","Ages <? echo $lowerLimit.'-'.$upperLimit; ?>","<? echo $sex.'s aged '.$lowerLimit.'-'.$upperLimit; ?>"],
						datasets: [
							{
								label: "Your High Score",
								backgroundColor: [
									"rgba(136, 221, 136, 0.5)",
	                				"rgba(136, 221, 136, 0.5)",
	                				"rgba(136, 221, 136, 0.5)"
                				],
                				borderColor: [
                					"rgba(136, 221, 136, 1)",
	                				"rgba(136, 221, 136, 1)",
	                				"rgba(136, 221, 136, 1)"
                				],
                				borderWidth: 1,
                				data: [$("#HighScore").html(),$("#HighScore").html(),$("#HighScore").html()]
							},
							{
								label: "Average",
								backgroundColor: [
									"rgba(255, 153, 51, 0.5)",
	                				"rgba(255, 153, 51, 0.5)",
	                				"rgba(255, 153, 51, 0.5)"
                				],
                				borderColor: [
                					"rgba(255, 153, 51, 1)",
	                				"rgba(255, 153, 51, 1)",
	                				"rgba(255, 153, 51, 1)"
                				],
                				borderWidth: 1,
                				data: [$("#SexAverage").html(),$("#AgeAverage").html(),$("#CombinedAverage").html()]
							}
						]
					},
					options: {
						responsive: true,
						scales: {
							xAxes: [{
								barPercentage: 0.45
							}],
							yAxes: [{
								ticks: {
									beginAtZero: true
								}
							}]
						}
					}
				});
			};
			$(".playCustom").click(function() {
				if ($("#CustomToken").val() !== "" && !$("#CustomToken").is(":hover")) {
					window.location = "http://mentalmathstest.com/play?t=" + $("#CustomToken").val();
				};
			});
			$("#CustomToken").keypress(function(e) {
				if (e.which == 13 && $("#CustomToken").val() !== "") {
					window.location = "http://mentalmathstest.com/play?t=" + $("#CustomToken").val();
				};
			});
			$(".numberOfAttempts").click(function() {
				$("#TestTokenLeaderboard").val($(this).attr("data-token"));
				$("#CustomTestForm").submit();
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
