<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width,initial-scale=1" />
	<meta name="description" content="Here are our statistics that we've gathered from each test. What demographic is the best at maths? Find out here!"/>
	<meta name="keywords" content="Statistics,Maths,Maths Statistics,Better at Maths">
	<meta name="author" content="Harry Verhoef"/>
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
	<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
	<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
	<link rel="manifest" href="/manifest.json">
	<title>MentalMathsTest | Statistics on Mathematic performance</title>
	<link rel="stylesheet" type="text/css" href="header.css?123sd74"/>
	<link rel="stylesheet" type="text/css" href="statisticsbody.css?dsd3dd3s469f"/>
	<link rel="stylesheet" type="text/css" href="footer.css"/>
	<div class="hiddenMenu">
		<div class="socialLinks">
			<ol>
				<li id="TwitterLinkHeader"><a href="https://twitter.com/MentalMathsTest" target="_blank"><img src="images/TwitterIcon.png" class="socialIcon" alt="MentalMathsTest Twitter Link"><p>@MentalMathsTest</p></a></li>
				<li id="FacebookLinkHeader"><a href="https://www.facebook.com/MentalMathsTest" target="_blank"><img src="images/FacebookIcon.png" class="socialIcon" alt="MentalMathsTest Facebook Link"><p>/MentalMathsTest</p></a></li>
				<li id="EmailLinkHeader"><img src="images/EmailIcon.png" class="socialIcon" alt="Email Address"><p>Admin@mentalmathstest.com</p></li>>
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
	<div class="bodyContent">
		<div class="adParent left">
			<div class="statisticsAdLeft">
				<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
				<!-- StatisticsLeft -->
				<ins class="adsbygoogle" style="display:inline-block;width:120px;height:600px" data-ad-client="ca-pub-8271963858208371" data-ad-slot="9730679245"></ins>
				<script>
					(adsbygoogle = window.adsbygoogle || []).push({});
				</script>
			</div>
		</div>
		<div class="bodyWrapper">
			<h1 id="PageHeader">Statistics</h2>
			<div class="parentBlock1">
				<div class="radarChart">
					<canvas id="RadarGraph"></canvas>
					<?
					include "connect.php";
					$nresult = mysqli_query($db,"SELECT COUNT(*) FROM scores");
					$totalArray = mysqli_fetch_assoc($nresult);
					$total = $totalArray["COUNT(*)"];
					$query = mysqli_stmt_init($db);
					mysqli_stmt_prepare($query,"SELECT COUNT(*) FROM scores WHERE (FINAL_SCORE BETWEEN ? AND ?) AND (TEST_TOKEN='' OR TEST_TOKEN IS NULL)");
					mysqli_stmt_bind_param($query,"ss",$lowerLimit,$upperLimit);
					mysqli_stmt_bind_result($query,$result);
					$limitArray = [[1.4,3],[3,7],[7,9],[9,10],[10,11],[11,12],[12,13],[13,13.7],[13.7,14],[14,15],[15,16]];
					for ($i=0; $i < 11; $i++) {
						$lowerLimit = $limitArray[$i][0];
						$upperLimit = $limitArray[$i][1];
						mysqli_stmt_execute($query);
						mysqli_stmt_fetch($query);
						echo "<p id='".$i."' hidden>".round((100*$result)/$total)."</p>";
					};
					mysqli_stmt_close($query);
					?>
					<div class="verticalLineBreak stats">
					</div>
				</div>
				<div class="horizontalAdvertisement mobile">
					<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
					<!-- StatisticsMobile1 -->
					<ins class="adsbygoogle" style="display:inline-block;width:320px;height:100px" data-ad-client="ca-pub-8271963858208371" data-ad-slot="2926177647"></ins>
					<script>
						(adsbygoogle = window.adsbygoogle || []).push({});
					</script>
				</div>
				<div class="demographicRankings">
					<?
					$ageGroupArray = [null,"0-10","11-12","13-14","15-16","17-21","22-35","36-50","51-65","66-80","80-150"];
					$result = mysqli_query($db,"SELECT * FROM (SELECT AVG(FINAL_SCORE) AS AVG_SCORE, USER_SEX, USER_AGEGROUP FROM (scores INNER JOIN users ON scores.USER_ID=users.USER_ID) WHERE USER_AGEGROUP <> 0 GROUP BY users.USER_SEX,users.USER_AGEGROUP) AS N ORDER BY AVG_SCORE DESC LIMIT 1");
					$max = mysqli_fetch_assoc($result);
					echo "<p class='pStat'>Highest Scoring Demographic:<br><span class='demographicStat'>".$max["USER_SEX"]."s aged ".$ageGroupArray[$max["USER_AGEGROUP"]]." (average ".round($max["AVG_SCORE"],2).")</span></p>";
					$result = mysqli_query($db,"SELECT * FROM (SELECT AVG(FINAL_SCORE) AS AVG_SCORE, USER_SEX, USER_AGEGROUP FROM (scores INNER JOIN users ON scores.USER_ID=users.USER_ID) WHERE USER_AGEGROUP <> 0 GROUP BY users.USER_SEX,users.USER_AGEGROUP) AS N ORDER BY AVG_SCORE ASC LIMIT 1");
					$min = mysqli_fetch_assoc($result);
					echo "<p class='pStat'>Lowest Scoring Demographic:<br><span class='demographicStat'>".$min["USER_SEX"]."s aged ".$ageGroupArray[$min["USER_AGEGROUP"]]." (average ".round($min["AVG_SCORE"],2).")</span></p>";
					$result = mysqli_query($db,"SELECT SUM(TIME_TAKEN) FROM scores");
					$sum = mysqli_fetch_assoc($result);
					$TimeTaken = 3 * $sum["SUM(TIME_TAKEN)"];
					$days = intval($TimeTaken / 86400);
					$hours = intval(($TimeTaken % 86400) / 3600);
					$minutes = intval(($TimeTaken % 3600) / 60);
					echo "<p class='pStat'>Total Time Elapsed on tests:<br><span class='demographicStat'>".$days." Days ".$hours." Hours ".$minutes." Minutes";
					?>
				</div>
			</div>
			<div class="parentBlock2">
				<ol>
					<li>
						<div class="testStatistics">
						<?
						$result = mysqli_query($db,"SELECT COUNT(*) FROM users");
						$numusers = mysqli_fetch_assoc($result);
						echo "<p class='pStat2'>Number of users:<br><span class='tStat'>".(3 * $numusers["COUNT(*)"])."</span></p>";
						$result = mysqli_query($db,"SELECT COUNT(*) FROM scores");
						$numscores = mysqli_fetch_assoc($result);
						echo "<p class='pStat2'>Number of tests completed:<br><span class='tStat'>".(3 * $numscores["COUNT(*)"])."</span></p>";
						$result = mysqli_query($db,"SELECT AVG(FINAL_SCORE) FROM scores");
						$avgscore = mysqli_fetch_assoc($result);
						echo "<p class='pStat2'>Average Score:<br><span class='tStat'>".round($avgscore["AVG(FINAL_SCORE)"],2)."</span></p>";
						$result = mysqli_query($db,"SELECT AVG(USER_HIGHSCORE) FROM users");
						$avghighscore = mysqli_fetch_assoc($result);
						echo "<p class='pStat2'>Average Highscore:<br><span class='tStat'>".round($avghighscore["AVG(USER_HIGHSCORE)"],2)."</span></p>";
						?>
						</div>
					</li>
					<li>
						<div class="miscellaneous">
						<?
						/*if ($_SESSION["loggedIn"]) {
							$result = mysqli_query($db,"SELECT USER_NAME FROM users WHERE USER_ID=".$_SESSION["userID"]);
							$username = mysqli_fetch_assoc($result);
							echo "<a href='http://mentalmathstest.com/play'><div class='play'><p class='playText'>Play as ".strip_tags($username["USER_NAME"])."</p></div></a>";
							echo "<ol class='miscOl'><li><a href='http://mentalmathstest.com/home'><div class='home'>Home</div></a></li><li><a href='http://mentalmathstest.com/leaderboard'><div class='leaderboard'>Leaderboard</div></a></li></ol>";
						} else {
							echo "<a href='http://mentalmathstest.com/playGuest.php'><div class='playGuest'><p class='playText'>Play as a guest to level 5</p></div></a>";
							echo "<ol class='miscOl'><li><a href='http://mentalmathstest.com/signup'><div class='signUp'>Sign up</div></a></li><li><a href='http://mentalmathstest.com/leaderboard'><div class='leaderboard'>Leaderboard</div></a></li></ol>";

						}*/
						$result = mysqli_query($db,"SELECT TEST_TOKEN,COUNT(*) AS FREQ FROM scores WHERE TEST_TOKEN LIKE 'practice%' GROUP BY TEST_TOKEN ORDER BY FREQ DESC LIMIT 1");
						$popPractice = mysqli_fetch_assoc($result);
						echo "<p class='pStat2'>Most popular practice area:<br><span class='practiceStat'>".explode("practice",$popPractice["TEST_TOKEN"])[1]."</span>: ".$popPractice["FREQ"]." attempts.</p>";
						$result = mysqli_query($db,"SELECT TEST_TOKEN,COUNT(*) AS FREQ FROM scores WHERE TEST_TOKEN LIKE 'practice%' GROUP BY TEST_TOKEN ORDER BY FREQ ASC LIMIT 1");
						$leastPopPractice = mysqli_fetch_assoc($result);
						echo "<p class='pStat2'>Least popular practice area:<br><span class='practiceStat'>".explode("practice",$leastPopPractice["TEST_TOKEN"])[1]."</span>: ".$leastPopPractice["FREQ"]." attempts.</p>";
						$result = mysqli_query($db,"SELECT TEST_TOKEN,AVG(FINAL_SCORE) AS AVERAGE FROM scores WHERE TEST_TOKEN LIKE 'practice%' GROUP BY TEST_TOKEN ORDER BY AVERAGE DESC LIMIT 1");
						$highScoringPractice = mysqli_fetch_assoc($result);
						echo "<p class='pStat2'>Highest Scoring practice area:<br><span class='practiceStat'>".explode("practice",$highScoringPractice["TEST_TOKEN"])[1]."</span> with ".round($highScoringPractice["AVERAGE"],2)." avg.</p>";
						$result = mysqli_query($db,"SELECT TEST_TOKEN,AVG(FINAL_SCORE) AS AVERAGE FROM scores WHERE TEST_TOKEN LIKE 'practice%' GROUP BY TEST_TOKEN ORDER BY AVERAGE ASC LIMIT 1");
						$lowScoringPracticeArea = mysqli_fetch_assoc($result);
						echo "<p class='pStat2'>Lowest Scoring practice area:<br><span class='practiceStat'>".explode("practice",$lowScoringPracticeArea["TEST_TOKEN"])[1]."</span> with ".round($lowScoringPracticeArea["AVERAGE"],2)." avg.</p>";
						?>
						</div>
					</li>
				</ol>
				<div class="mostPlayedCustoms">
					<h3>Most Played Custom Tests</h3>
					<table id="MostPlayedCustomsTable">
						<tbody>
							<?
							$result = mysqli_query($db,"SELECT TEST_TOKEN,COUNT(*) AS Q FROM scores WHERE (TEST_TOKEN IS NOT NULL AND TEST_TOKEN <> '' AND TEST_TOKEN NOT LIKE 'practice%') GROUP BY TEST_TOKEN ORDER BY Q DESC LIMIT 10");
							$i = 1;
							while ($mostPlayedCustoms = mysqli_fetch_assoc($result)) {
								echo "<tr><td>".strval($i)."</td><td><a href='http://mentalmathstest.com/play?t=".$mostPlayedCustoms["TEST_TOKEN"]."'>".$mostPlayedCustoms["TEST_TOKEN"]."</a></td><td>".$mostPlayedCustoms["Q"]." Attempts</td></tr>";
								$i++;
							};
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="adParent right">
			<div class="statisticsAdRight">
				<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
				<!-- StatisticsRight -->
				<ins class="adsbygoogle" style="display:inline-block;width:120px;height:600px" data-ad-client="ca-pub-8271963858208371" data-ad-slot="2207412449"></ins>
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
	<script src="plugins/Chart.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$(".bodyContent").height($(document).height());
			$(".bodyContent").width($(window).width());
			$(".statisticsAdLeft, .statisticsAdRight").css("top",($(window).height()-600)/2);
			if ($(window).width() > 1000) {
				$(".bodyWrapper").width($(window).width()-440);
			} else {
				$(".bodyWrapper").width($(window).width()-20);
			};
			var ctx = $("#RadarGraph");
			var RadarChart = new Chart(ctx, {
				type: "radar",
				data: {
					labels: ["Simple Arithmetic","Harder Arithmetic","Simple Algebra","Exponentials","Quadratics","Cubics","Trigonometry","Simple Logarithms","Imaginary Numbers","Advanced Logarithms","Complex Calculus"],
					datasets: [
						{
							label: "Percentage of tests that end here",
							data: [$("#0").html(),$("#1").html(),$("#2").html(),$("#3").html(),$("#4").html(),$("#5").html(),$("#6").html(),$("#7").html(),$("#8").html(),$("#9").html(),$("#10").html()],
							backgroundColor: "rgba(34,153,221,0.3)",
							BorderWidth: 3,
							borderColor: "rgba(34,153,221,0.8)"

						}
					]
				},
				options: {
					responsive: true
				}
			});
			$(".bodyContent").width($(window).width());
			$(window).resize(function() {
				$(".bodyContent").height($(".parentBlock2").offset().top + $(".parentBlock2").height() + 190);
				$(".bodyContent").width($(window).width());
				$(".statisticsAdLeft, .statisticsAdRight").css("top",($(window).height()-600)/2);
				if ($(window).width() > 1000) {
					$(".bodyWrapper").width($(window).width()-440);
				} else {
					$(".bodyWrapper").width($(window).width()-20);
				};
			});
			$(".menuIcon").click(function() {
				if ($(".menuIcon").hasClass("menu-active")) {
					$(".menuIcon,.hiddenMenu,.header,.bodyContent,.adParent").removeClass("menu-active");
				} else {
					$(".menuIcon,.hiddenMenu,.header,.bodyContent,.adParent").addClass("menu-active");
				};
			});
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
