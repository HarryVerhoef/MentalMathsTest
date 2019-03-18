<?php
session_start();

if (isset($_POST["classcode"]) && isset($_POST["submitclasscode"]) && $_POST["classcode"] != "" && $_POST["submitclasscode"] === "Let's Play!") {
	include "connect.php";
	if($query = mysqli_query($db,"SELECT FINAL_SCORE FROM ".mysqli_real_escape_string($db,"CLASS_".$_POST["classcode"])." WHERE USER_TOKEN = 1")) {
		$result = mysqli_fetch_assoc($query);
		if (mysqli_num_rows($query) == 1) {
			$_SESSION["test_token"] = $_POST["classcode"];
			$_SESSION["test_format"] = $result["FINAL_SCORE"];
			$query = mysqli_stmt_init($db);
			mysqli_stmt_prepare($query,"INSERT INTO ".mysqli_real_escape_string($db,"CLASS_".$_POST["classcode"])." (USER_ID) VALUES (?)");
			mysqli_stmt_bind_param($query,"s",$id);
			$id = isset($_SESSION["userID"]) ? mysqli_real_escape_string($db,$_SESSION["userID"]) : "";
			if (mysqli_stmt_execute($query)) {
				header("Location: http://mentalmathstest.com/play.php?class=true");
			} else {
				echo "Error #1";
			};
		} else {
			echo "Error #2";
		};
	} else {
		echo "No class test with that name!";
	};
} else {
	echo "Error #3";
};


?>
