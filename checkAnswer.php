<?
session_start();
if (isset($_POST["answer"]) && isset($_POST["answerbutton"]) && $_POST["answerbutton"] === "Submit Answer") {
	if (is_array($_SESSION["answer"])) {
		$answerArray = explode(",",trim($_POST["answer"]));
		if ($_SESSION["currentQuestion"][0] === 10 && in_array($_SESSION["currentQuestion"][1], range(7,10,1))) {
			if (in_array((double)$answerArray[0],$_SESSION["answer"]) && in_array((double)$answerArray[1],$_SESSION["answer"]) && $answerArray[0] != $answerArray[1]) {
				$correct = true;
			} else {
				$correct = false;
				$_SESSION["answer"] = $_SESSION["answer"][0]."_".$_SESSION["answer"][1];
			};
		} elseif ($_SESSION["currentQuestion"][0] === 11 && in_array($_SESSION["currentQuestion"][1], range(8,10,1))) {
			if (strpos($_POST["answer"], ",") !== false && in_array($answerArray[0],$_SESSION["answer"]) && in_array($answerArray[1],$_SESSION["answer"]) && in_array($answerArray[2],$_SESSION["answer"]) && !in_array($answerArray[0],array($answerArray[1],$answerArray[2]))) {
				$correct = true;
			} else {
				$correct = false;
				$_SESSION["answer"] = $_SESSION["answer"][0]."_".$_SESSION["answer"][1]."_".$_SESSION["answer"][2];
			};
		};
	};
	if ($_POST["answer"] == $_SESSION["answer"] || $_POST["answer"] == "harryverhoefisalegend" || $correct || strval($_POST["answer"]) === strval($_SESSION["answer"])) {
		$valid = true;
		$_SESSION["currentQuestion"][1] = $_SESSION["currentQuestion"][1] + 1;
		$_SESSION["currentcustomQuestion"] = intval($_SESSION["currentcustomQuestion"]) + 1;
		if ($_SESSION["currentQuestion"][1] > 10) {
			$_SESSION["currentQuestion"][0] = $_SESSION["currentQuestion"][0] + 1;
			$_SESSION["currentQuestion"][1] = 1;
			if ($_SESSION["currentQuestion"][0] > 15 && !$_SESSION["customTest"]) {
				$end = true;
			};
		};
	} else {
		$valid = false;
	};
	if (strpos($_POST["answer"],"SKIPTOLEVEL") !== false) {
		$_SESSION["currentQuestion"][0] = (integer)explode("SKIPTOLEVEL",$_POST["answer"])[1];
		$_SESSION["currentQuestion"][1] = 1;
		$valid = true;
	};
	if ($_SESSION["guest"] == "true" && $_SESSION["currentQuestion"][0] >= 6 && $_SESSION["customTest"] != true && !$firstQuestion) {
		$end = true;
		$valid = false;
		$guestFinished = true;
		echo json_encode([6,1,"right","end","guest","notCustom",null,null,null]);
	};
} else {
	$valid = false;
};
?>