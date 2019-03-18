<?php
session_start();
if (isset($_POST["format"]) && isset($_POST["name"]) && $_POST["format"] != "" && $_POST["name"] != "") {
	include "connect.php";
	$query = mysqli_query($db,"SELECT");
	$_SESSION["test_token"] = $_POST["name"];
	$_SESSION["test_format"] = $_POST["format"];
	$query = mysqli_stmt_init($db);
	mysqli_stmt_prepare($query,"CREATE TABLE IF NOT EXISTS ".mysqli_real_escape_string($db,"CLASS_".$_POST["name"])." (USER_TOKEN INT NOT NULL AUTO_INCREMENT PRIMARY KEY,USER_ID INT,CURRENT_QUESTION INT,FINAL_SCORE VARCHAR(255))");
	echo $query->error;
	if (mysqli_stmt_execute($query)) {
		mysqli_stmt_prepare($query,"INSERT INTO ".mysqli_real_escape_string($db,"CLASS_".$_POST["name"])." (FINAL_SCORE) VALUES (?)");
		mysqli_stmt_bind_param($query,"s",$format);
		$format = mysqli_real_escape_string($db,$_POST["format"]);
		if (mysqli_stmt_execute($query)) {
			echo "success";
		} else {
			unset($_SESSION["name"]);
			unset($_SESSION["format"]);
			echo "failure1";
		};
	} else {
		unset($_SESSION["name"]);
		unset($_SESSION["format"]);
		echo "failure2";
	};
} else {
	unset($_SESSION["name"]);
	unset($_SESSION["format"]);
	echo "failure3";
};

?>