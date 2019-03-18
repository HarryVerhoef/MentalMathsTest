<?
session_start();
if (isset($_POST["timeperlevel"]) && isset($_POST["questions"]) && is_array($_POST["timeperlevel"]) && is_array($_POST["questions"]) && count($_POST["timeperlevel"]) === count($_POST["questions"])) {
	$valid = true;
	foreach ($_POST["timeperlevel"] as $time) {
		if (!is_numeric($time) || !is_int(intval($time)) || intval($time) <= 0 || intval($time) > 2147483647) {
			$valid = false;
			echo "Please enter a valid numerical value for time allocated for each level.";
			break 1;
		};
	};
	foreach ($_POST["questions"] as $level) {
		foreach ($level as $question) {
			if ((!is_numeric($question) || !in_array(intval($question),range(1,29,1))) && count(explode("&&&",$question)) !== 2) {
				$valid = false;
				echo "Please make sure all questions are either selected from the random menu or manually written from the custom menu.";
				break 2;
			};
		};
	};
	if (!$valid) {
		echo "#4";
	} else {
		include "connect.php";
		$rowcount = 1;
		while ($rowcount === 1) {
			$testToken = (string)substr(md5(microtime()),rand(0,26),5);;
			str_replace('"', "", $testToken);
			str_replace("'", "", $testToken);
			if ($result = mysqli_query($db,"SELECT * FROM customtokens WHERE TOKEN='".$testToken."' LIMIT 1")) {
				$rowcount = mysqli_num_rows($result);
			};
		};
		$userID2 = isset($_SESSION["userID"]) ? $_SESSION["userID"] : "0";
		if (strpos($testToken.$userID2,"'") === false && strpos($testToken.$userID2,"\"") === false && $result = mysqli_query($db,"INSERT INTO customtokens (TOKEN,CREATOR_ID) VALUES ('".mysqli_real_escape_string($db,$testToken)."',".mysqli_real_escape_string($db,$userID2).")")) {
			if ($result = mysqli_query($db,"CREATE TABLE levels_".$testToken." (".mysqli_real_escape_string($db,$testToken)."_LEVELID int AUTO_INCREMENT, NO_QUESTIONS int NOT NULL, LEVELTIME int NOT NULL, PRIMARY KEY (".mysqli_real_escape_string($db,$testToken)."_LEVELID))")) {
				$query = mysqli_stmt_init($db);
				mysqli_stmt_prepare($query,"INSERT INTO levels_".$testToken." (NO_QUESTIONS,LEVELTIME) VALUES (?,?)");
				mysqli_stmt_bind_param($query,"ii",$numberQuestions,$levelTime);
				for ($i=0; $i < count($_POST["timeperlevel"]); $i++) { 
					$levelTime = mysqli_real_escape_string($db,intval($_POST["timeperlevel"][$i]));
					$numberQuestions = count($_POST["questions"][$i]);
					mysqli_stmt_execute($query);
				};
				mysqli_stmt_close($query);
				if ($result = mysqli_query($db,"CREATE TABLE questions_".$testToken." (".$testToken."_QUESITONID int PRIMARY KEY AUTO_INCREMENT NOT NULL, QUESTION varchar(255) NOT NULL)" )) {
					$query = mysqli_stmt_init($db);
					mysqli_stmt_prepare($query,"INSERT INTO questions_".$testToken." (QUESTION) VALUES (?)");
					mysqli_stmt_bind_param($query,"s",$escapedQuestion);
					foreach ($_POST["questions"] as $level) {
						foreach ($level as $question) {
							$escapedQuestion = mysqli_real_escape_string($db,$question);
							mysqli_stmt_execute($query); 
						};
					};
					if ($userID2 === "0" && $_SESSION["loggedIn"] != true) {
						echo "token2=".strval($testToken);
					} else {
						echo "token=".strval($testToken);
					};
				} else {
					echo "Error creating test. #1";
				};

			} else {
				echo "Error creating test. #2";
			};
		} else {
			echo "Error creating test. #3";
		};
		

	};
} else {
	echo "Invalid inputs #5";
};
?>