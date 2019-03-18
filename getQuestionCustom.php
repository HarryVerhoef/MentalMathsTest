<?
session_start();
if (((isset($_POST["answer"]) && isset($_POST["answerbutton"]) && $_POST["answerbutton"] == "Submit Answer" && !$end && isset($_SESSION["initialTime"])) || $_SESSION["currentQuestion"] === array(1,1)) && $_SESSION["customTest"]) {
	$level = [];
	if (in_array($_SESSION["customID"],["Addition","Subtraction","Multiplication","Division","Decimals","Exponentiation","Quadratics","Surds","Cubics","Factorials","Trigonometry","Logarithms","ComplexNumbers","HarderLogarithms","Calculus"])) {
		$practice = true;
		$outputArray[0] = 1;
		$outputArray[1] = $_SESSION["currentcustomQuestion"];
		if ($outputArray[1] > 10) {
			$practiceCoefficient = $outputArray[1] - 10;
		};
		if (!$valid) {
			$practiceWrong = true;
		};
		if ($_SESSION["customID"] === "Addition") {
			$_SESSION["currentQuestion"] = array(1,1+$_SESSION["currentcustomQuestion"]);
		} elseif ($_SESSION["customID"] === "Subtraction") {
			$_SESSION["currentQuestion"] = array(2,1+$_SESSION["currentcustomQuestion"]);
		} elseif ($_SESSION["customID"] === "Multiplication") {
			$_SESSION["currentQuestion"] = array(3,1+$_SESSION["currentcustomQuestion"]);
		} elseif ($_SESSION["customID"] === "Division") {
			$_SESSION["currentQuestion"] = array(4,1+$_SESSION["currentcustomQuestion"]);
		} elseif ($_SESSION["customID"] === "Decimals") {
			$_SESSION["currentQuestion"] = array(7,rand(1,10));
		} elseif ($_SESSION["customID"] === "LinearAlgebra") {
			$_SESSION["currentQuestion"] = array(8,rand(1,10));
		} elseif ($_SESSION["customID"] === "Exponentiation") {
			$_SESSION["currentQuestion"] = array(9,rand(1,10));
		} elseif ($_SESSION["customID"] === "Quadratics") {
			$_SESSION["currentQuestion"] = array(10,rand(1,10));
		} elseif ($_SESSION["customID"] === "Surds") {
			$_SESSION["currentQuestion"] = array(11,rand(1,5));
		} elseif ($_SESSION["customID"] === "Cubics") {
			$_SESSION["currentQuestion"] = array(11,rand(6,9));
		} elseif ($_SESSION["customID"] === "Factorials") {
			$_SESSION["currentQuestion"] = array(12,rand(1,3));
		} elseif ($_SESSION["customID"] === "Trigonometry") {
			$_SESSION["currentQuestion"] = array(12,rand(4,10));
		} elseif ($_SESSION["customID"] === "Logarithms") {
			$_SESSION["currentQuestion"] = array(13,rand(1,7));
		} elseif ($_SESSION["customID"] === "ComplexNumbers") {
			$_SESSION["currentQuestion"] = array(13,rand(8,10));
		} elseif ($_SESSION["customID"] === "HarderLogarithms") {
			$_SESSION["currentQuestion"] = array(14,rand(1,10));
		} elseif ($_SESSION["customID"] === "Calculus") {
			$_SESSION["currentQuestion"] = array(15,rand(1,10));
		};
	} elseif ($result = mysqli_query($db,"SELECT * FROM levels_".mysqli_real_escape_string($db,$_SESSION["customID"]))) {
		while ($levelRow = mysqli_fetch_row($result)) {
			$level[$levelRow[0]] = array($levelRow[1],$levelRow[2]);
			//level[1] === [Number of Questions, Time for Level];
		};
		$levelFound = false;
		$sum = 0;
		$index = 1;
		while ($levelFound === false) {
			$sum = $sum + $level[$index][0];
			// Cumulative questions between level 1 and level index;
			if ($index > 15) {
				break;
			};
			if (intval($_SESSION["currentcustomQuestion"]) <= $sum) {
				$outputArray[0] = $index;
				$outputArray[1] = ($_SESSION["currentcustomQuestion"] - $sum + $level[$index][0]);
				$levelFound = true;
			};
			$index = $index + 1;
		};
		if ($result = mysqli_query($db,"SELECT * FROM questions_".mysqli_real_escape_string($db,$_SESSION["customID"]))) {
			while ($questionRow = mysqli_fetch_row($result)) {
				$question[$questionRow[0]] = $questionRow[1];
				//question[1] === Question 2;
			};
			switch($question[$_SESSION["currentcustomQuestion"]]) {
				case 1:
					$_SESSION["currentQuestion"] = array(1,2);
					break;
				case 2:
					$_SESSION["currentQuestion"] = array(2,1);
					break;
				case 3:
					$_SESSION["currentQuestion"] = array(1,6);
					break;
				case 4:
					$_SESSION["currentQuestion"] = array(3,1);
					break;
				case 5:
					$_SESSION["currentQuestion"] = array(3,6);
					break;
				case 6:
					$_SESSION["currentQuestion"] = array(4,1);
					break;
				case 7:
					$_SESSION["currentQuestion"] = array(4,6);
					break;
				case 8:
					$_SESSION["currentQuestion"] = array(5,1);
					break;
				case 9:
					$_SESSION["currentQuestion"] = array(6,rand(1,7));
					break;
				case 11:
					$_SESSION["currentQuestion"] = array(6,8);
					break;
				case 12:
					$_SESSION["currentQuestion"] = array(7,rand(1,10));
					break;
				case 13:
					$_SESSION["currentQuestion"] = array(8,rand(1,6));
					break;
				case 14:
					$_SESSION["currentQuestion"] = array(8,rand(7,10));
					break;
				case 15:
					$_SESSION["currentQuestion"] = array(9,1);
					break;
				case 16:
					$_SESSION["currentQuestion"] = array(9,6);
					break;
				case 17:
					$_SESSION["currentQuestion"] = array(10,7);
					break;
				case 18:
					$_SESSION["currentQuestion"] = array(11,1);
					break;
				case 19:
					$_SESSION["currentQuestion"] = array(11,rand(6,10));
					break;
				case 20:
					$_SESSION["currentQuestion"] = array(12,1);
					break;
				case 21:
					$_SESSION["currentQuestion"] = array(12,rand(4,10));
					break;
				case 22:
					$_SESSION["currentQuestion"] = array(13,rand(2,7));
					break;
				case 23:
					$_SESSION["currentQuestion"] = array(13,rand(8,10));
					break;
				case 24:
					$_SESSION["currentQuestion"] = array(14,rand(1,7));
					break;
				case 25:
					$_SESSION["currentQuestion"] = array(14,rand(8,10));
					break;
				case 26:
					$_SESSION["currentQuestion"] = array(15,1);
					break;
				case 27:
					$_SESSION["currentQuestion"] = array(15,5);
					break;
				case 28:
					$_SESSION["currentQuestion"] = array(15,7);
					break;
				case 29:
					$_SESSION["currentQuestion"] = array(15,10);
					break;
			}
			if (count(explode("&&&",$question[$_SESSION["currentcustomQuestion"]])) === 2) {
				$outputArray[7] = htmlspecialchars(explode("&&&",$question[$_SESSION["currentcustomQuestion"]])[0]);
				$_SESSION["currentQuestion"] = array(-1,1);
				$answer = htmlspecialchars(explode("&&&",$question[$_SESSION["currentcustomQuestion"]])[1]);
				$_SESSION["answer"] = $answer;
			};

		};
	} else {
		$invalidToken = true;
		$outputArray[7] = "<script>window.location='http://mentalmathstest.com/home';</script>";
	};
};
/*$query = mysqli_stmt_init($db);
mysqli_stmt_prepare($query,"SELECT * FROM ?");
mysqli_stmt_bind_param($query,"s",$testToken);
$testToken = mysqli_real_escape_string($db,$_GET["t"])."_levels";
mysqli_stmt_execute($query);
mysqli_stmt_bind_result($query,$levelID,$levelQuestions,$levelTime);
if (mysqli_stmt_fetch($query)) {
	str_replace("_levels","_questions",$testToken);
	mysqli_stmt_execute($query);
	mysqli_stmt_bind_result($query,$questionID,$question);
	mysqli_stmt_fetch($query);
};*/
?>
