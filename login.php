<?php
session_start();
include "connect.php"; // Connects server to local database
if (isset($_POST["loginemail"]) && isset($_POST["loginpassword"]) && isset($_POST["loginbutton"]) && $_POST["loginbutton"] == "Log In") {
	if (strlen($_POST["loginemail"]) < 64 && strlen($_POST["loginemail"]) > 0 && strlen($_POST["loginpassword"]) > 0 && strlen($_POST["loginpassword"]) < 64) { // More validity checks
		if (filter_var($_POST["loginemail"], FILTER_VALIDATE_EMAIL)) { // Check valid email address
			$query = mysqli_stmt_init($db); // Initialise prepared statement to database
			mysqli_stmt_prepare($query,"SELECT USER_ID,USER_NAME,USER_HASH FROM users WHERE USER_EMAIL=?"); // prepare statement
			mysqli_stmt_bind_param($query,"s",$escapedemail); // Bind statement paramaters to variables
			$escapedemail = mysqli_real_escape_string($db,$_POST["loginemail"]); // Sanitize email address of SQL-Malicious characters
			mysqli_stmt_execute($query); // Execute Query
			mysqli_stmt_bind_result($query,$id,$username,$hash); // Prepare to assign result to variables
			mysqli_stmt_fetch($query); // Get results & assign
			if ($username === null) { // Invalid email address
				header("Location: http://mentalmathstest.com?s=false"); // Redirect to homepage with invalid login flag
			};
			mysqli_stmt_close($query); // Close SQL Statement object
		} else {
			$query = mysqli_stmt_init($db);
			mysqli_stmt_prepare($query,"SELECT USER_ID,USER_HASH FROM users WHERE USER_NAME=?");
			mysqli_stmt_bind_param($query,"s",$escapedusername);
			$escapedusername = mysqli_real_escape_string($db,$_POST["loginemail"]);
			mysqli_stmt_execute($query);
			mysqli_stmt_bind_result($query,$id,$hash);
			mysqli_stmt_fetch($query);
			mysqli_stmt_close($query);
		};
		if (password_verify($_POST["loginpassword"],$hash)) { // If hashed version of user input + their concatenated salt is identical to their hash then password correct
			// Successful Login
			$_SESSION["loggedIn"] = true; // Assign session variables
			$_SESSION["userID"] = $id;
			$_SESSION["guest"] = "false";
			ob_start(); // Begin output buffering
			if (isset($_POST["loginrememberme"]) && $_POST["loginrememberme"] === "RememberMe") {
				include "rememberme.php"; // Include rememberme cookie code
			} else {
				setcookie("rememberMe","",time()-3600,null,null,null,true);
			};
			echo "<script>window.location = 'http://mentalmathstest.com/home';</script>"; // Redirect to home.php
			ob_end_flush(); // End output buffering
		} else {
			header("Location: http://mentalmathstest.com?s=false"); // Password incorrect
		};
	} else {
		header("Location: http://mentalmathstest.com?s=false"); // Invalid login details
	};
};
?>
