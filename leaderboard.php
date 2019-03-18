<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width" />
	<meta name="description" content="Search for the best mathematicians to have ever taken our test by each demographic!"/>
	<meta name="keywords" content="Leaderboard,Maths,Maths Leaderboard,Best at Maths,Statistics">
	<meta name="author" content="Harry Verhoef"/>
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
	<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
	<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
	<link rel="manifest" href="/manifest.json">
	<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="theme-color" content="#ffffff">
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	<title>MentalMathsTest | Leaderboard for our Mathematics tests</title>
	<link rel="stylesheet" type="text/css" href="header.css?1s634"/>
	<link rel="stylesheet" type="text/css" href="leaderboardbody.css?<?php echo time(); ?>"/>
	<link rel="stylesheet" type="text/css" href="footer.css?123"/>
	<link rel="stylesheet" type="text/css" href="plugins/nouislider.min.css">
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
			<div class="leaderboardAdLeft">
				<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
				<!-- LeaderboardLeft -->
				<ins class="adsbygoogle" style="display:inline-block;width:120px;height:600px" data-ad-client="ca-pub-8271963858208371" data-ad-slot="3045017249"></ins>
				<script>
					(adsbygoogle = window.adsbygoogle || []).push({});
				</script>
			</div>
		</div>
		<div class="bodyWrapper">
			<h1 id="BodyHeader">Leaderboard</h1>
			<?

			if (isset($_POST["gender"]) && ($_POST["gender"] === "Male_Female" || $_POST["gender"] === "Male_Male" || $_POST["gender"] === "Female_Female") && isset($_POST["lowerage"]) && isset($_POST["upperage"]) && ctype_digit($_POST["lowerage"]) && ctype_digit($_POST["upperage"]) && $_POST["lowerage"] > -1 && $_POST["upperage"] < 121) {
				$sex1 = explode("_",$_POST["gender"])[0];
				$sex2 = explode("_",$_POST["gender"])[1];
				$lowerLimit = $_POST["lowerage"];
				$upperLimit = $_POST["upperage"];
			} else {
				$sex1 = "Male";
				$sex2 = "Female";
				$lowerLimit = "0";
				$upperLimit = "120";
			};
			$gender = $sex1 === $sex2 ? $sex1."s" : $sex1."s and ".$sex2."s";
			$token = isset($_POST["testtoken"]) && $_POST["testtoken"] !== "" ? "test ".htmlspecialchars($_POST["testtoken"]) : "the MMT";
			echo "<h2 id='ShowingHeader'>Showing: ".$gender." aged ".htmlspecialchars($lowerLimit)."-".htmlspecialchars($upperLimit)." on ".$token."</h2>";
			?>
			<div class="leaderboard">
				<div class="leaderboardHeader">
					<form id="DemographicForm" action="leaderboard.php" method="POST">
						<div class="demographicFormLeft">
							<h4>Age Range: </h4>
							<div class=".ageSlider" id="AgeSlider">
							</div>
							<p id="AgeRange">Range: <span id="Range">0 - 120</span><p>
							<input type="hidden" value="0" id="LowerAge" name="lowerage" />
							<input type="hidden" value="120" id="UpperAge" name="upperage" />
						</div>
						<div class="demographicFormMiddle">
							<h4>Gender: </h4>
							<select id="SexSelect" name="gender">
								<option value="Male_Female">Both</option>
								<option value="Male_Male">Male</option>
								<option value="Female_Female">Female</option>
							</select>
						</div>
						<div class="demographicFormRight">
							<input type="text" id="TestToken" name="testtoken" placeholder="Test Token (if applicable)" />
							<input type="submit" id="SubmitButton" value="Update" />
						</div>
					</form>
					<div class="horizontalLineBreak">
					</div>
				</div>
				<div class="leaderboardContent">
					<table id="LeaderboardTable">
						<tr>
							<th>Rank</th>
							<th>Username</th>
							<th>Score</th>
							<th class="timetd">Time Taken</th>
							<th class="datetd">Date</th>
						</tr>
						<?
						include "connect.php";
						$query = mysqli_stmt_init($db);
						if (isset($_POST["testtoken"]) && $_POST["testtoken"] !== "") {
							$token = mysqli_real_escape_string($db,$_POST["testtoken"]);
							mysqli_stmt_prepare($query,"SELECT USER_NAME, FINAL_SCORE, TIME_TAKEN, DATE_RECORDED FROM scores INNER JOIN users ON scores.USER_ID = users.USER_ID WHERE scores.TEST_TOKEN = ? AND (USER_SEX=? OR USER_SEX=?) AND (TIMESTAMPDIFF(YEAR, users.USER_DOB, CURDATE()) BETWEEN ? AND ?) ORDER BY scores.FINAL_SCORE DESC LIMIT 10");
							mysqli_stmt_bind_param($query,"sssss",$token,$sex1,$sex2,$lowerLimit,$upperLimit);
						} else {
							mysqli_stmt_prepare($query,"SELECT USER_NAME, FINAL_SCORE, TIME_TAKEN, DATE_RECORDED FROM scores INNER JOIN users ON scores.USER_ID = users.USER_ID WHERE (scores.TEST_TOKEN = '' OR scores.TEST_TOKEN IS NULL) AND (USER_SEX=? OR USER_SEX=?) AND (TIMESTAMPDIFF(YEAR, users.USER_DOB, CURDATE()) BETWEEN ? AND ?) ORDER BY scores.FINAL_SCORE DESC LIMIT 10");
							mysqli_stmt_bind_param($query,"ssss",$sex1,$sex2,$lowerLimit,$upperLimit);
						};
						mysqli_stmt_bind_result($query,$username,$score,$time,$date);
						mysqli_stmt_execute($query);
						$index = 0;
						while (mysqli_stmt_fetch($query)) {
							echo "<tr>";
							echo "<td class='ranking no".($index + 1)."'>".($index + 1)."</td>";
							echo "<td class='username'>".strip_tags($username)."</td>";
							echo "<td class='score'>".strip_tags($score)."</td>";
							echo "<td class='timetd'><span class='time'>".$time."</span>s</td>";
							echo "<td class='datetd'><span class='date'>".date("d/m/Y",strtotime($date))."</span></td>";
							echo "</tr>";
							$index = $index + 1;
						};
						if ($index == 0) {
							echo "<tr>No records!</tr>";
						};
						?>
					</table>
				</div>
			</div>
		</div>
		<div class="adParent right">
			<div class="leaderboardAdRight">
				<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
				<!-- LeaderboardRight -->
				<ins class="adsbygoogle" style="display:inline-block;width:120px;height:600px" data-ad-client="ca-pub-8271963858208371" data-ad-slot="4382149640"></ins>
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
	<script src="plugins/nouislider.min.js"></script>
	<script src="plugins/pace.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$(".bodyContent").height($(document).height());
			$(".leaderboardAdLeft, .leaderboardAdRight").css("top",($(window).height()-600)/2);
			var ageSlider = document.getElementById("AgeSlider");
			noUiSlider.create(ageSlider, {
				start: [0,150],
				step: 1,
				connect: true,
				range: {
					"min": [0],
					"max": [120]
				}
			});
			ageSlider.noUiSlider.on("update",function() {
				$("#Range").html(Math.round((ageSlider.noUiSlider.get()[0])).toString() + " - " + (Math.round(ageSlider.noUiSlider.get()[1])).toString());
				$("#LowerAge").val(Math.round(ageSlider.noUiSlider.get()[0]));
				$("#UpperAge").val(Math.round(ageSlider.noUiSlider.get()[1]));
			});
			$(".time").each(function(i, e) {
				if (parseInt($(e).html()) >= 60) {
					$(e).html((Math.floor($(e).html() / 60) ).toString() + "m " + ($(e).html() % 60));
				};
			});
			$(window).resize(function() {
				$(".bodyContent").height($(".leaderboard").offset().top + $(".leaderboard").height() + 240);
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
