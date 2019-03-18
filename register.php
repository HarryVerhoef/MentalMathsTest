<?php
session_start();
include "connect.php"; // Connect to local database
if (isset($_POST["signupemail"]) && isset($_POST["signupusername"]) && isset($_POST["signuppassword"]) && isset($_POST["signuprepassword"]) && isset($_POST["signupd"]) && isset($_POST["signupm"]) && isset($_POST["signupy"]) && isset($_POST["signupgender"]) && isset($_POST["signuptermsandconditions"])) {
	$valid = true;
	if ((filter_var($_POST["signupemail"], FILTER_VALIDATE_EMAIL) === false) || strlen($_POST["signupemail"]) === 0 || strlen($_POST["signupemail"]) > 64) { // If email invalid
		$valid = false;
		header("Location: http://mentalmathstest.com?s=email"); // Redirect to sign up with invalid email flag
	};
	$query = mysqli_stmt_init($db); // Initialise MySQLi statement
	mysqli_stmt_prepare($query,"SELECT USER_ID FROM users WHERE USER_EMAIL=?"); // Prepare SQL Query
	mysqli_stmt_bind_param($query,"s",$escapedemail); // Bind parameter to variable
	$escapedemail = mysqli_real_escape_string($db,$_POST["signupemail"]); // Sanitize input email of malicious characters
	mysqli_stmt_execute($query); // Execute query
	mysqli_stmt_store_result($query); // Store result
	$rows = mysqli_stmt_num_rows($query);
	if ($rows >= 1) { // If email already in database
		$valid = false;
		header("Location: http://mentalmathstest.com?s=emailtaken"); // Redirect to sign up with email taken flag
	};
	mysqli_stmt_close($query); // Close mysqli_stmt object
	if (strlen($_POST["signupusername"]) === 0 || strlen($_POST["signupusername"]) > 64) { // If username invalid
		$valid = false;
		header("Location: http://mentalmathstest.com?s=username");
	};
	$query = mysqli_stmt_init($db);
	mysqli_stmt_prepare($query, "SELECT USER_ID FROM users WHERE USER_NAME=?");
	mysqli_stmt_bind_param($query,"s",$escapedusername);
	$escapedusername = mysqli_real_escape_string($db,$_POST["signupusername"]);
	mysqli_stmt_execute($query);
	mysqli_stmt_store_result($query);
	$rows = mysqli_stmt_num_rows($query);
	if ($rows >= 1) { // If username already taken
		$valid = false;
		header("Location: http://mentalmathstest.com?s=usernametaken"); // Redirect to sign up with username taken flag
	};
	if (strlen($_POST["signuppassword"]) == 0 || strlen($_POST["signuppassword"]) > 64) { // More input validation with strlen() function
		$valid = false;
		header("Location: http://mentalmathstest.com?s=false1");
	};
	if (strlen($_POST["signuprepassword"]) == 0 || strlen($_POST["signuprepassword"]) > 64 || !($_POST["signuppassword"] === $_POST["signuprepassword"])) {
		$valid = false;
		header("Location: http://mentalmathstest.com?s=passwordsdifferent");
	};
	if (strlen(strval($_POST["signupd"])) === 0 || strlen(strval($_POST["signupd"])) > 2 || $_POST["signupd"] < 1 || $_POST["signupd"] > 31 || !($_POST["signupd"] == (integer)$_POST["signupd"]) ) {
		$valid = false;
		header("Location: http://mentalmathstest.com?s=false2");
	};
	if (strlen(strval($_POST["signupm"])) === 0 || strlen(strval($_POST["signupm"])) > 2 || $_POST["signupm"] < 1 || $_POST["signupm"] > 12 || !($_POST["signupm"] == (integer)$_POST["signupm"]) ) {
		$valid = false;
		header("Location: http://mentalmathstest.com?s=false3");
	};
	if (strlen(strval($_POST["signupy"])) === 0 || strlen(strval($_POST["signupy"])) > 4 || $_POST["signupy"] < 1900 || $_post["signup"] > 2016 || !($_POST["signupy"] == (integer)$_POST["signupy"]) ) {
		$valid = false;
		header("Location: http://mentalmathstest.com?s=false4");
	};
	if (!(checkdate((integer)$_POST["signupm"],(integer)$_POST["signupd"],(integer)$_POST["signupy"]))) { // If input d.o.b is an invalid date on the gregorian calendar
		$valid = false;
		header("Location: http://mentalmathstest.com?s=date"); // Redirect to sign up with invalid date flag
	};
	if ($_POST["signupgender"] !== "Male" && $_POST["signupgender"] !== "Female") { // If gender isn't either Male or Female
		$valid = false;
		header("Location: http://mentalmathstest.com?s=false5");
	};
	if (!($_POST["signuptermsandconditions"] === "termsandconditions")) { // If user hasn't checked t's and c's box
		$valid = false;
		header("Location: http://mentalmathstest.com?s=termsandconditions");
	};
	if (!(isset($_POST["signupsubmit"])) && !($_POST["signupsubmit"] === "Sign Up")) {
		$valid = false;
		header("Location: http://mentalmathstest.com?s=false6");
	};
	if ($valid) {
		$query = mysqli_stmt_init($db);
		mysqli_stmt_prepare($query,"INSERT INTO users (USER_EMAIL,USER_NAME,USER_HASH,USER_DOB,USER_SEX,USER_AGEGROUP) VALUES (?,?,?,STR_TO_DATE(?,'%Y-%m-%d'),?,?)"); // Prepare to insert data into DB
		mysqli_stmt_bind_param($query,"ssssss",$_POST["signupemail"],$_POST["signupusername"],$hashedpassword,$date,$_POST["signupgender"],$ageGroup); // Bind parameters
		$hashedpassword = password_hash($_POST["signuppassword"],PASSWORD_DEFAULT);
		$date = $_POST["signupy"]."-".$_POST["signupm"]."-".$_POST["signupd"]; // Prepare d.o.b in suitable format
		$age = date_diff(date_create($date), date_create("today"))->y;
		switch(true) {
			case $age < 11:
				$ageGroup = 1;
				break;
			case $age < 13:
				$ageGroup = 2;
				break;
			case $age < 15:
				$ageGroup = 3;
				break;
			case $age < 17:
				$ageGroup = 4;
				break;
			case $age < 22:
				$ageGroup = 5;
				break;
			case $age < 36:
				$ageGroup = 6;
				break;
			case $age < 51:
				$ageGroup = 7;
				break;
			case $age < 66:
				$ageGroup = 8;
				break;
			case $age < 81:
				$ageGroup = 9;
				break;
			case $age > 80:
				$ageGroup = 10;
				break;
		};
		mysqli_stmt_execute($query);
		mysqli_stmt_close($query);
		header("Location: http://mentalmathstest.com?s=reg"); // Redirect user to index.php with successful registration flag
	};
} else {
	header("Location: http://mentalmathstest.com?s=false7".$_POST["signupusername"].$_POST["signupgender"]); // Invalid registration inputs
};
?>
