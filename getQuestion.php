<?php
session_start();
/*if ((($_SESSION["loggedIn"] !== true || !isset($_SESSION["userID"])) && $_SESSION["guest"] !== "true") || ($_GET["t"] !== "") {
	echo "<script>window.location='http://mentalmathstest.com?s=fromgetQuestion".($loggedIn === true ? "true" : "false")."'</script>";
};*/

ob_start();

// Valid Session / Cookie
$end = false;
$guestFinished = false;
$customTest = false;
$practiceWrong = false;
$practice = false;
$practiceCoefficient = 1;
$invalidToken = false;
include "checkAnswer.php";

$answerTime = time();

$timeDifference = $answerTime - $questionTime;

$questionTime = time();

include "connect.php";

$wordedQuestion = false;

$outputArray = [null,null,null,null,null,null,null,null,null,null];

if (isset($_GET["t"]) || isset($_SESSION["customID"])) {
	$_SESSION["customTest"] = true;
	$customTest = true;
	include "getQuestionCustom.php";
	if ($outputArray[0] !== null && $outputArray[1] !== null) {
		$_SESSION["customLevel"] = $outputArray[0];
	} elseif ($valid) {
		$customEnd = true;
	};
} else {
	$_SESSION["customTest"] = false;
	$outputArray[0] = strval($_SESSION["currentQuestion"][0]);
	$outputArray[1] = strval($_SESSION["currentQuestion"][1]);
};
$outputArray[2] = $valid === true ? "right" : "wrong";
$outputArray[3] = $end === true ? "end" : "notEnd";
$outputArray[4] = $_SESSION["loggedIn"] === true ? "notGuest" : "guest";
$outputArray[5] = $customTest === true ? "custom" : "notCustom";
$outputArray[9] = $practice === true ? "practice" : "notPractice";

$timeLimits = array(200,250,300,400,500,700,900,1050,1200,1350,1450,1600,1750,1800,2000,2000);


if (((isset($_POST["answer"]) && isset($_POST["answerbutton"]) && $_POST["answerbutton"] == "Submit Answer" && $valid && !$end && !$customEnd && isset($_SESSION["initialTime"])) || ($firstQuestion && !$invalidToken))) {
	// Valid Inputs from AJAX
	if ($_SESSION["currentQuestion"][0] === 1) {
		// First Level
		if ( in_array($_SESSION["currentQuestion"][1],range(1,5,1))) {
			$rand1 = rand(1,15);
			$rand2 = rand(1,15);
		} else {
			$rand1 = rand(15*$practiceCoefficient,50*$practiceCoefficient);
			$rand2 = rand(15*$practiceCoefficient,50*$practiceCoefficient);
		}
		$_SESSION["answer"] = $rand1 + $rand2;
		$outputArray[7] = "\[".$rand1." + ".$rand2."\]";
		$firstQuestion = false;
	} elseif ($_SESSION["currentQuestion"][0] === 2) {
		// Second Level
		if ( in_array($_SESSION["currentQuestion"][1],range(1,5,1))) {
			$rand1 = rand(5,15);
			$rand2 = rand(5,15);
		} else {
			$rand1 = rand(-15*$practiceCoefficient,25*$practiceCoefficient);
			$rand2 = rand(-15*$practiceCoefficient,25*$practiceCoefficient);
		}
		$_SESSION["answer"] = $rand1 - $rand2;
		$outputArray[7] = "\[".$rand1." - ".$rand2."\]";
	} elseif ($_SESSION["currentQuestion"][0] === 3) {
		// Third Level
		if ( in_array($_SESSION["currentQuestion"][1],range(1,5,1))) {
			$rand1 = rand(0,10);
			$rand2 = rand(1,10);
		} else {
			$rand1 = rand(-2*$practiceCoefficient,15*$practiceCoefficient);
			$rand2 = rand(-2*$practiceCoefficient,15*$practiceCoefficient);
		}
		$_SESSION["answer"] = $rand1 * $rand2;
		$outputArray[7] = "\[".$rand1." \\times ".$rand2."\]";
	} elseif ($_SESSION["currentQuestion"][0] === 4) {
		// Fourth Level
		if ( in_array($_SESSION["currentQuestion"][1],range(1,5,1))) {
			$answer = rand(2,15);
			$rand1 = rand(1,7);
			$rand2 = $answer * $rand1;
		} else {
			$answer = rand(-10*$practiceCoefficient,20*$practiceCoefficient);
			$rand1 = rand(-15*$practiceCoefficient,20*$practiceCoefficient);
			$rand1 = $rand1 === 0 ? 1 : $rand1;
			$rand2 = $answer * $rand1;
		}
		$_SESSION["answer"] = $answer;
		$outputArray[7] = "\[ \\frac {".$rand2."} {".$rand1."}\]";
	} elseif ($_SESSION["currentQuestion"][0] === 5) {
		// Fifth Level
		$op1 = [" \\times "," + "][rand(0,1)];
		$op2 = [" \\times "," + "][rand(0,1)];
		$rand1 = rand(5,10);
		$rand2 = rand(5,10);
		$rand3 = rand(5,10);
		$bracketsAnswer = $op1 == " \\times " ? $rand1 * $rand2 : $rand1 + $rand2;
		$_SESSION["answer"] = $op2 == " \\times " ? $bracketsAnswer * $rand3 : $bracketsAnswer + $rand3;
		$outputArray[7] = "\[(".$rand1.$op1.$rand2.")".$op2.$rand3."\]";
	} elseif ($_SESSION["currentQuestion"][0] === 6) {
		// Sixth Level
		if ( in_array($_SESSION["currentQuestion"][1],range(1,3,1))) {
			$rand1 = rand(5,10);
			$rand2 = rand(5,10);
			$answer = rand(1,8);
			$_SESSION["answer"] = $answer;
			$rand3 = (($answer * $rand2) - $rand1);
			$outputArray[7] = "\[\\frac{(".$rand3." + ".$rand1.")}{".$rand2."}\]";
		} elseif ( in_array($_SESSION["currentQuestion"][1],range(4,7,1))) {
			$rand1 = rand(5,20);
			$rand2 = rand(5,25);
			$answer = rand(5,12);
			$_SESSION["answer"] = $answer;
			$rand3 = ($answer * ($rand1 - $rand2));
			$outputArray[7] = "\[\\frac{".$rand3."}{".$rand1."-".$rand2."}\]";
		} else {
			$rand1 = rand(0,2);
			$rand2 = rand(0,1);
			$rand3 = 0;
			$opArray = [" \\times "," + "," - "];
			$op1 = $opArray[$rand1];
			array_splice($opArray,$rand1,1);
			$op2 = $opArray[$rand2];
			array_splice($opArray,$rand2,1);
			$op3 = $opArray[$rand3];
			$rand1 = rand(1,5);
			$rand2 = rand(1,5);
			$rand3 = rand(1,5);
			$rand4 = rand(1,5);
			if ($op1 == " \\times ") {
				if ($op2 == " + ") {
					$answer = ((($rand1 * $rand2) + $rand3) - $rand4);
				}
				else {
					$answer = (($rand1 * $rand2) - ($rand3 + $rand4));
				};
			} elseif ($op2 == " \\times ") {
				if ($op1 == " + ") {
					$answer = (($rand1 + ($rand2 * $rand3)) - $rand4);
				} else {
					$answer = ($rand1 - (($rand2 * $rand3) + $rand4));
				};
			} else {
				if ($op2 == " + ") {
					$answer = ($rand1 - ($rand2 + ($rand3 * $rand4)));
				} else {
					$answer = (($rand1 + $rand2) - ($rand3 * $rand4));
				};
			};
			$_SESSION["answer"] = $answer;
			$outputArray[7] = "\[".$rand1.$op1.$rand2.$op2.$rand3.$op3.$rand4."\]";
		};
	} elseif ($_SESSION["currentQuestion"][0] === 7) {
		// Seventh Level
		if ( in_array($_SESSION["currentQuestion"][1],range(1,3,1))) {
			$rand1 = rand($practiceCoefficient,500*$practiceCoefficient) / (100);
			$rand2 = rand($practiceCoefficient,500*$practiceCoefficient) / (100);
			$answer = $rand1 + $rand2;
			$_SESSION["answer"] = $answer;
			$outputArray[7] = "\[".$rand1." + ".$rand2."\]";
		} elseif ( in_array($_SESSION["currentQuestion"][1],range(4,6,1))) {
			$rand1 = rand($practiceCoefficient,500*$practiceCoefficient) / (100);
			$rand2 = rand($practiceCoefficient,500*$practiceCoefficient) / (100);
			$answer = $rand1 - $rand2;
			$_SESSION["answer"] = $answer;
			$outputArray[7] = "\[".$rand1." - ".$rand2."\]";
		} else {
			$rand = [[rand(5000,15000),0.1],[rand(5000,15000),0.1],[0.5,2],[3,0.5],[0.5,5],[0.5,1.2],[1.2,5],[1.5,1.2],[1.5,2],[3,1.5],[1.5,4],[5,1.5],[4,2.5]][rand(0,12)];
			$answer = $rand[0] * $rand[1] * (1 + (0.5 * ($practiceCoefficient-1)));
			$_SESSION["answer"] = $answer;
			$outputArray[7] = "\[".$rand[0]." \\times ".($rand[1] * (1 + (0.5 * ($practiceCoefficient-1))))."\]";
		};
	} elseif ($_SESSION["currentQuestion"][0] === 8) {
		// Eighth Level
		$outputArray[6] = "Find x";
		if ( in_array($_SESSION["currentQuestion"][1],range(1,3,1))) {
			$answer = rand(-10*$practiceCoefficient,50*$practiceCoefficient);
			$rand1 = rand($practiceCoefficient,50*$practiceCoefficient);
			$rand2 = $rand1 - $answer;
			$op1 = $rand2 < 0 ? " - " : " + ";
			$_SESSION["answer"] = $answer;
			$outputArray[7] = "\[x".$op1.abs($rand2)." = ".$rand1."\]";
		} elseif ( in_array($_SESSION["currentQuestion"][1],range(4,6,1))) {
			$answer = rand(-5*$practiceCoefficient,25*$practiceCoefficient);
			$rand1 = rand($practiceCoefficient,40*$practiceCoefficient);
			$rand2 = $answer + $rand1;
			$op1 = $rand2 < 0 ? " - " : " + ";
			$_SESSION["answer"] = $answer;
			$outputArray[7] = "\[x".$op1.abs($rand2)." = ".$rand1."\]";
		} elseif ( in_array($_SESSION["currentQuestion"][1],array(7,8))) {
			$answer = rand($practiceCoefficient,15*$practiceCoefficient);
			$rand1 = rand($practiceCoefficient,20*$practiceCoefficient);
			$rand2 = $answer * $rand1;
			$_SESSION["answer"] = $answer;
			$outputArray[7] = "\[".$rand1."x = ".$rand2."\]";
		} else {
			$rand1 = rand($practiceCoefficient,20*$practiceCoefficient);
			$rand2 = rand(-5*$practiceCoefficient,20*$practiceCoefficient);
			$answer = $rand1 * $rand2;
			$_SESSION["answer"] = $answer;
			$outputArray[7] = "\[\\frac{x}{".$rand1."} = ".$rand2."\]";
		};
	} elseif ($_SESSION["currentQuestion"][0] === 9) {
		if ( in_array($_SESSION["currentQuestion"][1],range(1,5,1))) {
			$rand1 = rand(0,11 + $practiceCoefficient);
			$answer = $rand1 * $rand1;
			$_SESSION["answer"] = $answer;
			$outputArray[7] = "\[".$rand1."^{2}\]";
		} else {
			$rand1 = rand(2,3);
			$answer = (rand(0,5 + $practiceCoefficient));
			$rand2 = pow($answer,$rand1);
			$_SESSION["answer"] = $answer;
			$outputArray[7] = "\[\\sqrt[".$rand1."]{".$rand2."}\]";
		};
	} elseif ($_SESSION["currentQuestion"][0] === 10) {
		if ( in_array($_SESSION["currentQuestion"][1],range(1,3,1))) {
			$rand1 = rand(-25*$practiceCoefficient,25*$practiceCoefficient);
			$rand2 = rand(-25*$practiceCoefficient,25*$practiceCoefficient);
			$op1 = $rand1 < 0 ? " - " : " + ";
			$op2 = $rand2 < 0 ? " - " : " + ";
			$rand1 = strval(abs($rand1))."x";
			$rand2 = strval(abs($rand2));
			$rand1 = $rand1 === "1x" ? "x" : $rand1;
			$rand1 = $rand1 === "0x" ? "" : $rand1;
			$rand2 = $rand2 === "0" ? "": $rand2;
			$_SESSION["answer"] = $rand2;
			$outputArray[6] = "Find the y-intercept of the graph";
			$outputArray[7] = "\[y = x^{2}".$op1.$rand1.$op2.$rand2."\]";
		} elseif ( in_array($_SESSION["currentQuestion"][1],range(4,6,1))) {
			$op1 = [" + "," - "][rand(0,1)];
			$op2 = [" + "," - "][rand(0,1)];
			$rand1 = rand(-3*$practiceCoefficient,5*$practiceCoefficient);
			$rand2 = rand($practiceCoefficient,5*$practiceCoefficient);
			$rand3 = rand($practiceCoefficient,5*$practiceCoefficient);
			if ($op1 === " + ") {
				if ($op2 === " - ") {
					$answer = ($rand1 + $rand2) * ($rand1 - $rand3);
				} else {
					$answer = ($rand1 + $rand2) * ($rand1 + $rand3);
				};
			} else {
				if ($op2 === " - ") {
					$answer = ($rand1 - $rand2) * ($rand1 - $rand3);
				} else {
					$answer = ($rand1 - $rand2) * ($rand1 + $rand3);
				};
			};
			$_SESSION["answer"] = $answer;
			$outputArray[6] = "Find f(".$rand1.")";
			$outputArray[7] = "\[f(x) = (x".$op1.$rand2.")(x".$op2.$rand3.")\]";
		} else {
			$answer1 = round(1 + ($practiceCoefficient/5)) * rand(-4,5);
			$answer2 = round(1 + ($practiceCoefficient/5)) * rand(-4,5);
			while ($answer1 === 0 || $answer2 === 0 || $answer1 === $answer2) {
				$answer1 = rand(-4,5);
				$answer2 = rand(-4,5);
			};
			$b = ($answer1 + $answer2) * (-1);
			$op1 = $b < 0 ? " - " : " + ";
			$c = ($answer1 * $answer2);
			$op2 = $c < 0 ? " - " : " + ";
			$b = abs($b);
			$c = abs($c);
			$b = $b === 1 ? "x" : (string)$b."x";
			$c = $c === 1 ? "1" : (string)$c;
			if ($b === "0x") {
				$op1 = "";
				$b = "";
			};
			if ($c === "0") {
				$op2 = "";
				$c = "";
			};
			$answer = [$answer1,$answer2];
			$_SESSION["answer"] = $answer;
			$outputArray[6] = "Separate solutions with a ','";
			$outputArray[7] = "\[x^{2}".$op1.$b.$op2.$c." = 0\]";
		};
	} elseif ($_SESSION["currentQuestion"][0] === 11) {
		if ( in_array($_SESSION["currentQuestion"][1],range(1,3,1))) {
			$answer = rand(1,10);
			$factorsArray = [[[1,1]],[[1,4],[2,2]],[[1,9],[3,3]],[[1,16],[4,4]],[[1,25],[5,5]],[[1,36],[2,18],[3,12],[4,9],[6,6]],[[1,49],[7,7]],[[1,64],[2,32],[4,16],[8,8]],[[1,81],[3,27],[9,9]],[[1,100],[2,50],[4,25],[5,20],[10,10]]];
			$rand1Array = $factorsArray[$answer-1][rand(0,sizeof($factorsArray[$answer-1])-1)];
			$_SESSION["answer"] = $answer;
			$outputArray[7] = "\[\\sqrt{".$rand1Array[0]."} \\times \\sqrt{".$rand1Array[1]."}\]";
		} elseif ( in_array($_SESSION["currentQuestion"][1],array(4,5))) {
			$answer = rand(1,round(5 + ($practiceCoefficient/3)));
			$rand1 = rand(2,round(4 + ($practiceCoefficient/3)));
			$numerator = pow($answer,2) * $rand1;
			$_SESSION["answer"] = $answer;
			$outputArray[7] = "\[\\frac{\\sqrt{".$numerator."}}{\\sqrt{".$rand1."}}\]";
		} elseif ( in_array($_SESSION["currentQuestion"][1],array(6,7))) {
			$answer = rand(-2,2 + round($practiceCoefficient/5));
			if ($answer === 0) {
				$answer = 1;
			};
			function checkFactor($b,$c,$d,$n) {
				if ((pow($n,3) + ($b * pow($n,2)) + ($c * $n) + $d) === 0) {
					return 1;
				} else {
					return 0;
				};
			};
			$b = rand(-3,3 + round($practiceCoefficient/5));
			$c = rand(-3,3 + round($practiceCoefficient/5));
			$d = 0 - pow($answer,3) - ($b * pow($answer,2)) - ($c * $answer);
			while ((checkFactor($b,$c,$d,-3)+checkFactor($b,$c,$d,-2)+checkFactor($b,$c,$d,-1)+checkFactor($b,$c,$d,1)+checkFactor($b,$c,$d,2)+checkFactor($b,$c,$d,3)+checkFactor($b,$c,$d,0)) !== 1) {
				$b = rand(-3,3 + round($practiceCoefficient/5));
				$c = rand(-3,3 + round($practiceCoefficient/5));
				$d = 0 - pow($answer,3) - ($b * pow($answer,2)) - ($c * $answer);
			};
			$opb = $b < 0 ? " - " : " + ";
			$opc = $c < 0 ? " - " : " + ";
			$opd = $d < 0 ? " - " : " + ";
			$b = abs($b);
			$c = abs($c);
			$d = abs($d);
			$b = $b === 1 ? "x^{2}" : (string)$b."x^{2}";
			$c = $c === 1 ? "x" : (string)$c."x";
			$d = $d === 1 ? "1" : (string)$d;
			if ($b === "0x^{2}") {
				$opb = "";
				$b = "";
			};
			if ($c === "0x") {
				$opc = "";
				$c = "";
			};
			if ($d === "0") {
				$opd = "";
				$d = "";
			};
			$_SESSION["answer"] = $answer;
			$outputArray[6] = "Find one solution";
			$outputArray[7] = "\[x^{3}".$opb.$b.$opc.$c.$opd.$d." = 0\]";
		} else {
			$answer1 = rand(-3,3 + round($practiceCoefficient/5));
			$answer2 = rand(-3,3 + round($practiceCoefficient/5));
			while ($answer1 === 0 || $answer2 === 0 || $answer1 === $answer2) {
				$answer1 = rand(-3,3 + round($practiceCoefficient/5));
				$answer2 = rand(-3,3 + round($practiceCoefficient/5));
			};
			$b = ($answer1 + $answer2) * (-1);
			$op1 = $b < 0 ? " - " : " + ";
			$c = ($answer1 * $answer2);
			$op2 = $c < 0 ? " - " : " + ";
			$b = abs($b);
			$c = abs($c);
			$b = $b === 1 ? "x" : (string)$b."x";
			$c = $c === 1 ? "1" : (string)$c;
			if ($b === "0x") {
				$op1 = "";
				$b = "";
			};
			if ($c === "0") {
				$op2 = "";
				$c = "";
			};
			$answer = [0,$answer1,$answer2];
			$_SESSION["answer"] = $answer;
			$outputArray[6] = "Find all three solutions, separated with a ','";
			$outputArray[7] = "\[x(x^{2}".$op1.$b.$op2.$c.") = 0\]";
		};
	} elseif ($_SESSION["currentQuestion"][0] === 12) {
		if ( in_array($_SESSION["currentQuestion"][1],array(1))) {
			$practiceCoefficient = $practiceCoefficient > 7 ? 7 : $practiceCoefficient;
			$rand1 = rand(0,5 + $practiceCoefficient);
			$answer = gmp_intval(gmp_fact($rand1));
			$_SESSION["answer"] = $answer;
			$outputArray[7] = "\[".$rand1."!\]";
		} elseif ( in_array($_SESSION["currentQuestion"][1],array(2,3))) {
			$practiceCoefficient = $practiceCoefficient > 7 ? 7 : $practiceCoefficient;
			$rand1 = rand(0,5 + $practiceCoefficient);
			$rand2 = $rand1 - rand(0,$rand1);
			$answer = gmp_intval(gmp_fact($rand1))/gmp_intval(gmp_fact($rand2));
			$_SESSION["answer"] = $answer;
			$outputArray[7] = "\[\\frac{".$rand1."!}{".$rand2."!}\]";
		} elseif ( in_array($_SESSION["currentQuestion"][1],range(4,7,1))) {
			$function = ["\\sin","\\cos"][rand(0,1)];
			$x = [0,90,180,270,360][rand(0,4)] + (360 * $practiceCoefficient) - 360;
			$answer = $function === "\\sin" ? sin(deg2rad($x)) : cos(deg2rad($x));
			$answer = abs($answer) < 1e-10 ? "0" : $answer;
			$_SESSION["answer"] = $answer;
			$outputArray[7] = "\[".$function."(".$x.")\]";
		} else {
			$function = ["\\sin","\\cos"][rand(0,1)];
			$k = [-1,-1,-1,0,1,1,1,0.5,0.5,0.25][rand(0,9)];
			$xcoefficient = [1,1,1,2,3][rand(0,4)];
			$xcoefficient === 1 ? $xco = "" : $xco = $xcoefficient;
			$answer = $function === "\\sin" ? rad2deg((asin($k)/$xcoefficient)) : rad2deg((acos($k)/$xcoefficient));
			$range = $function === "\\sin" ? "\\left \{ -90\\leq x\\leq 90 \\right \}" : "\\left \{ 0\\leq x\\leq 180 \\right \}";
			if ($k === 0.5) {
				$answer = $function === "\\sin" ? 60/$xcoefficient : 30/$xcoefficient;
				$k = "\\frac{\\sqrt{3}}{2}";
			} elseif ($k === 0.25) {
				$answer = 45/$xcoefficient;
				$k = "\\frac{\\sqrt{2}}{2}";
			};
			$_SESSION["answer"] = $answer;
			$outputArray[6] = "Find the value of x closest to 0";
			$outputArray[7] = "\[".$function."{".$xco."x} = ".$k.", ".$range."\]";
		};
	} elseif ($_SESSION["currentQuestion"][0] === 13) {
		if ($_SESSION["currentQuestion"][1] === 1) {
			$answer = rand(2,4 + round($practiceCoefficient/5));
			$rand1 = rand(2,4 + round($practiceCoefficient/5));
			$rand2 = pow($rand1,$answer);
			$_SESSION["answer"] = $answer;
			$outputArray[6] = "Find x";
			$outputArray[7] = "\[".$rand1."^{x}=".$rand2."\]";
		} elseif ( in_array($_SESSION["currentQuestion"][1],range(2,4,1))) {
			$base = rand(2,11);
			$base = $base === 11 ? $base = M_E : $base;
			$answer = $base > 5 + round($practiceCoefficient/4) ? 2 : [2,3,3][rand(0,2)];
			$result = pow($base,$answer);
			$base === M_E ? $function = "\\ln{e^{".$answer."}}" : $function = "\\log_{".$base."}{".$result."}";
			$_SESSION["answer"] = $answer;
			$outputArray[7] = "\[".$function."\]";
		} elseif ( in_array($_SESSION["currentQuestion"][1],range(5,7,1))) {
			$base = [2,4,8,10][rand(0,3)] + (2 * round($practiceCoefficient/4));
			$answer = in_array($base,range(8,10,1)) ? [-1,0,2][rand(0,2)] : [-2,-1,-1,0,2][rand(0,4)];
			$result = pow($base,$answer);
			$_SESSION["answer"] = $answer;
			$outputArray[7] = "\[\\log_{".$base."}{".round($result,6)."}\]";
		} elseif ($_SESSION["currentQuestion"][1] === 8) {
			$icoefficient = [2,2,3,3,4,4,5,6,7,8,9,10][rand(0,11)] + round($practiceCoefficient/2);
			$answer = (-1) * pow($icoefficient,2);
			$_SESSION["answer"] = $answer;
			$outputArray[7] = "\[(".$icoefficient."i)^{2}\]";
		} elseif ($_SESSION["currentQuestion"][1] === 9) {
			$x = rand(1,9) + (10*$practiceCoefficient) - 10;
			$icoefficient = rand(2,9 + (10*$practiceCoefficient) - 10);
			$answer = $x * 2;
			$_SESSION["answer"] = $answer;
			$outputArray[7] = "\[(".$x."+".$icoefficient."i) + (".$x."-".$icoefficient."i)\]";
		} elseif ($_SESSION["currentQuestion"][1] === 10) {
			$x = rand(1,9) + $practiceCoefficient;
			$icoefficient = rand(2,9 + $practiceCoefficient);
			$answer = (string)(pow($x,2) - pow($icoefficient,2))."+".(string)(2 * $x * $icoefficient)."i";
			$_SESSION["answer"] = $answer;
			$outputArray[6] = "a+bi";
			$outputArray[7] = "\[(".$x."+".$icoefficient."i)(".$x."+".$icoefficient."i)\]";
		} elseif ($_SESSION["currentQuestion"] === 11) {
			$x = rand(1,9) + $practiceCoefficient;
			$icoefficient = rand(2,9 + $practiceCoefficient);
			$answer = pow($x,2) + pow($icoefficient,2);
			$_SESSION["answer"] = $answer;
			$outputArray[6] = "a+bi";
			$outputArray[7] = "\[(".$x."+".$icoefficient."i)(".$x."-".$icoefficient."i)\]";
		};
	} elseif ($_SESSION["currentQuestion"][0] === 14) {
		if ( in_array($_SESSION["currentQuestion"][1],range(1,3,1))) {
			$denom = rand(2,5);
			$answer = [1,2,2,3,4][rand(0,4)] + round($powerCoefficient/5);
			$nom = pow($denom,$answer);
			$base = rand(2,255);
			$_SESSION["answer"] = $answer;
			$outputArray[7] = "\[\\frac{\\log_{".$base."}{".$denom."}}{\\log_{".$base."}{".$nom."}}\]";
		} elseif ( in_array($_SESSION["currentQuestion"][1],range(4,7,1))) {
			$coe1 = rand(0,2);
			$coe2 = rand(0,2);
			$base = rand(2,5);
			$ans1 = [0.5,0.5,0.75,2,2,3,4][rand(0,6)];
			$coe1 === 0 ? $log1 = $ans1." \\log_{".$base."}{".$base."}" : ($ans1 === 0.5 ? $log1 = "\\log_{".$base."}{\\sqrt{".$base."}}" : ($ans1 === 0.75 ? $log1 = "\\log_{".$base."}{\\sqrt[4]{".$base."}^{3}}" : $log1 = "\\log_{".$base."}{".pow($base,$ans1)."}"));
			$ans2 = [0.5,0.5,0.75,2,2,3,4][rand(0,6)];
			$coe2 === 0 ? $log2 = $ans2." \\log_{".$base."}{".$base."}" : ($ans2 === 0.5 ? $log2 = "\\log_{".$base."}{\\sqrt{".$base."}}" : ($ans2 === 0.75 ? $log2 = "\\log_{".$base."}{\\sqrt[4]{".$base."}^{3}}" : $log2 = "\\log_{".$base."}{".pow($base,$ans2)."}"));
			$answer = $ans1 + $ans2;
			$_SESSION["answer"] = $answer;
			$outputArray[7] = "\[".$log1."+".$log2."\]";
		} elseif ( in_array($_SESSION["currentQuestion"][1],array(8,9))) {
			$answer = [1.5,2.5][rand(0,1)];
			$base = [4,9,16][rand(0,2)];
			$_SESSION["answer"] = $answer;
			$outputArray[6] = "Find x";
			$outputArray[7] = "\[\\ln_{}{e^{x}} = \\log_{".$base."}{".pow($base,$answer)."}\]";
		} else {
			$a = [-5,-4,-3,-2][rand(0,3)];
			$answer = [3,5][rand(0,1)];
			$a = $answer === 3 ? [-5,-4,-3,-2][rand(0,3)] : [-3,-2][rand(0,1)];
			$outputArray[7] = "\[\\log_{".$a."}{".pow($a,3)."}\]";
		};
	} elseif ($_SESSION["currentQuestion"][0] === 15) {
		if ( in_array($_SESSION["currentQuestion"][1],array(1,2))) {
			$answer = [2,3,4,5,5,6,6,7,7][rand(0,8)]; + round($practiceCoefficient/6);
			$_SESSION["answer"] = $answer;
			$outputArray[6] = "Find |n|";
			$outputArray[7] = "\[\\int_{0}^{n} (".(2 * $answer)."x) dx = ".pow($answer,3)."\]";
		} elseif ( in_array($_SESSION["currentQuestion"][1],array(3,4))) {
			$answer = [3,4,5,6,7,8,9,10,11,12][rand(0,9)];
			$constant = [2,4,6][rand(0,2)] + (2 * round($practiceCoefficient/3));
			$_SESSION["answer"] = $answer;
			$outputArray[6] = "Find |n|";
			$outputArray[7] = "\[\\int_{0}^{n} (".$constant."x) dx = ".(pow($answer,2) * $constant * 0.5)."\]";
		} elseif ( in_array($_SESSION["currentQuestion"][1],array(5,6))) {
			$opIndex = rand(0,3);
			switch(true) {
				case $opIndex === 0:
					$op = "sin";
					$answer = 2;
					break;
				case $opIndex === 1:
					$op = "cos";
					$answer = 0;
					break;
				case $opIndex === 2:
					$op = "-sin";
					$answer = -2;
					break;
				case $opIndex === 3:
					$op = "-cos";
					$answer = 0;
					break;
			};
			$piCoefficient = 1 + round($practiceCoefficient/3);
			$aLimit = $piCoefficient == 1 ? "\\pi" : strval($piCoefficient)."\\pi";
			$_SESSION["answer"] = $answer;
			$outputArray[7] = "\[\\int_{0}^{".$aLimit."} (".$op."(x)) dx\]";
		} elseif ( in_array($_SESSION["currentQuestion"][1],array(7,8))) {
			$opIndex = rand(0,3);
			$piCoefficient = rand(1,2);
			$param = $piCoefficient == 1 ? "" : "2";
			switch(true) {
				case $opIndex === 0:
					$op = "sin";
					$answer = $piCoefficient === 1 ? -1 : 1;
					break;
				case $opIndex === 1:
					$op = "cos";
					$answer = 0;
					break;
				case $opIndex === 2:
					$op = "-sin";
					$answer = $piCoefficient === 1 ? 1 : -1;
					break;
				case $opIndex === 3:
					$op = "-cos";
					$answer = 0;
					break;
			};
			$piCoefficient = 1 + round($practiceCoefficient/3);
			$aLimit = $piCoefficient == 1 ? "\\pi" : strval($piCoefficient)."\\pi";
			$_SESSION["answer"] = $answer;
			$outputArray[7] = "\[\\frac{\\mathrm{d} }{\\mathrm{d} x} (".$op."x) | x = ".$param.$aLimit."\]";
		} elseif ($_SESSION["currentQuestion"][1] === 9) {
			$answer = 2 * rand(2,50);
			$exponent = $answer."x";
			$xvalue = "0";
			if (rand(0,1) === 1) {
				$exponent = "ln{".(0.5 * $answer)."x^{2}}";
				$xvalue = "1";
			};
			$_SESSION["answer"] = $answer;
			$outputArray[7] = "\[\\frac{\\mathrm{d} }{\\mathrm{d} x} (e^{".$exponent."}) | x = ".$xvalue."\]";
		} else {
			$exponent = rand(1,3);
			$coefficient = rand(2,6);
			$x = rand(1,2);
			$answer = ($exponent/$x);
			$exponent = $exponent === 1 ? "" : $exponent;
			$_SESSION["answer"] = $answer;
			$outputArray[7] = "\[\\frac{\\mathrm{d} }{\\mathrm{d} x} (\\ln_{}{".$coefficient."x^{".$exponent."}}) | x = ".$x."\]";
		};
	};
	if ($_SESSION["currentQuestion"] !== [1,1] && $_SESSION["currentcustomQuestion"] !== 1 && !$practiceWrong && !$invalidToken) {
		echo json_encode($outputArray);
	};
/*} else if ($_SESSION["guest"] == "true" && !$valid) {
	$levelReached = (string)$_SESSION["currentQuestion"][0];
	$questionReached = (string)$_SESSION["currentQuestion"][1];
	$timeTaken = (string)($answerTime - $_SESSION["initialTime"]);
	$hundredth = (string)round((10 - ((10 * $timeTaken)/$timeLimits[$levelReached - 1])));
	$hundredth = $hundredth == 10 ? "9" : (string)$hundredth;
	$finalScore = (double)($levelReached.".".(((integer)$questionReached) - 1).$hundredth);
	if ($practiceWrong) {
		$percentage = round(100 - exp((100-(intval($outputArray[1])))/21.7),2);
		$finalScore = round($outputArray[1],2);
	} else if ($_SESSION["customTest"]) {

		$timeTaken = intval($timeTaken);
		$timeAllocated = 0;
		for ($i = 1; $i <= $levelReached; $i++) {
			$timeAllocated = $timeAllocated + $level[$i][1];
			if ($i > 15) {
				break;
			};
		};
		$tenth = ($questionReached - 1)/intval($level[intval($outputArray[0])][0]);
		$hundredth = round(10 - ((10 * $timeTaken)/$timeAllocated))/100;
		$hundredth = $hundredth == 0.1 ? 0.09 : $hundredth;
		$finalScore = (double)round(100 * ($outputArray[0] + $tenth + $hundredth))/100;

		$hundredth = strval(round((100 - ((100 * $timeTaken)/$timeLimits[$outputArray[0] - 1]))));
		$finalScore = (double)(strval(intval($_SESSION["customLevel"]) + 1).".".$hundredth);
		$denom = 17/sizeof($level);
		$percentage = round((-0.015462026538999 * pow($finalScore * $denom,3)) + (0.192411665838298 * pow($finalScore * $denom,2)) + (7.53732499967728 * $finalScore * $denom) - 7.78495744431249,2);
	} else {
		$percentage = round((-0.015462026538999 * pow($finalScore,3)) + (0.192411665838298 * pow($finalScore,2)) + (7.53732499967728 * $finalScore) - 7.78495744431249,2);
	}
	$finalScore = floor($finalScore) == $finalScore ? strval($finalScore).".00" : strval($finalScore);
	$outputArray[8] = [$finalScore,$percentage,$timeTaken];
	echo json_encode($outputArray);
} else if (!$valid && !$guestFinished && $_SESSION["customTest"] !== true && !$practiceWrong) {
	// Answer incorrect
	$levelReached = (string)$_SESSION["currentQuestion"][0];
	$questionReached = (string)$_SESSION["currentQuestion"][1];
	$timeTaken = (string)($answerTime - $_SESSION["initialTime"]);
	$hundredth = (string)round((10 - ((10 * $timeTaken)/$timeLimits[$levelReached - 1])));
	$hundredth = $hundredth == 10 ? "9" : (string)$hundredth;
	$finalScore = (double)($levelReached.".".(((integer)$questionReached) - 1).$hundredth);
	if ($_SESSION["guest"]) {
		$percentage = round((-0.015462026538999 * pow($finalScore,3)) + (0.192411665838298 * pow($finalScore,2)) + (7.53732499967728 * $finalScore) - 7.78495744431249,2);
		$outputArray[8] = [round($finalScore,2),$percentage,$timeTaken];
		echo json_encode($outputArray);
	} else {
		$query = mysqli_stmt_init($db);
		mysqli_stmt_prepare($query,"SELECT MAX(FINAL_SCORE) FROM scores WHERE USER_ID=? AND (TEST_TOKEN='' OR TEST_TOKEN IS NULL)");
		mysqli_stmt_bind_param($query,"s",$id);
		$id = mysqli_real_escape_string($db,$_SESSION["userID"]);
		mysqli_stmt_bind_result($query,$recordedHighScore);
		mysqli_stmt_execute($query);
		mysqli_stmt_fetch($query);
		if ($finalScore > $recordedHighScore) {
			mysqli_stmt_prepare($query,"UPDATE users SET USER_HIGHSCORE=? WHERE USER_ID=?");
			mysqli_stmt_bind_param($query,"ss",$finalScore,$id);
			mysqli_stmt_execute($query);
		};
		mysqli_stmt_prepare($query,"INSERT INTO scores (USER_ID,LEVEL_REACHED,QUESTION_REACHED,TIME_TAKEN,FINAL_SCORE,DATE_RECORDED) VALUES (?,?,?,?,?,NOW())");
		mysqli_stmt_bind_param($query,"sssss",$id,$levelReached,$questionReached,$timeTaken,$finalScore);
		mysqli_stmt_execute($query);
		mysqli_stmt_close($query);
		$outputArray[8] = [$finalScore,$_SESSION["answer"],$_POST["answer"]];
		echo json_encode($outputArray);
		ob_flush();
	};
} else if ($end && !$guestFinished && $_SESSION["customTest"] !== true && !$invalidToken) {
	// Finished Game
	$levelReached = "16";
	$questionReached = "10";
	$timeTaken = (string)($answerTime - $_SESSION["initialTime"]);
	$hundredth = (string)round((100 - ((100 * $timeTaken)/$timeLimits[$levelReached - 1])));
	if ($hundredth === "100") {
		$hundredth = "00";
		$levelReached = "17";
	};
	$finalScore = (double)($levelReached.".".$hundredth);
	$query = mysqli_stmt_init($db);
	mysqli_stmt_prepare($query,"SELECT MAX(FINAL_SCORE) FROM scores WHERE USER_ID=? AND (TEST_TOKEN='' OR TEST_TOKEN IS NULL)");
	mysqli_stmt_bind_param($query,"s",$id);
	$id = mysqli_real_escape_string($db,$_SESSION["userID"]);
	mysqli_stmt_bind_result($query,$recordedHighScore);
	mysqli_stmt_execute($query);
	mysqli_stmt_fetch($query);
	if ($finalScore > $recordedHighScore) {
		mysqli_stmt_prepare($query,"UPDATE users SET USER_HIGHSCORE=? WHERE USER_ID=?");
		mysqli_stmt_bind_param($query,"ss",$finalScore,$id);
		mysqli_stmt_execute($query);
	};
	mysqli_stmt_prepare($query,"INSERT INTO scores (USER_ID,LEVEL_REACHED,QUESTION_REACHED,TIME_TAKEN,FINAL_SCORE,DATE_RECORDED) VALUES (?,?,?,?,?,NOW())");
	mysqli_stmt_bind_param($query,"sssss",$id,$levelReached,$questionReached,$timeTaken,$finalScore);
	mysqli_stmt_execute($query);
	mysqli_stmt_close($query);
	ob_flush();
	$outputArray[8] = [$finalScore];
	echo json_encode($outputArray);
} else if (!$valid && !$guestFinished && $_SESSION["customTest"] && isset($_SESSION["customID"]) && !$practiceWrong && !$invalidToken) {

} else if ($customEnd && !$guestFinished && $_SESSION["customTest"] && !$invalidToken) {
	$levelReached = strval(intval($_SESSION["customLevel"]) + 1);
	$outputArray[0] = intval($levelReached);
	$questionReached = "10";
	$outputArray[1] = 1;
	$timeTaken = $answerTime - $_SESSION["initialTime"];
	$hundredth = strval(round((100 - ((100 * $timeTaken)/$timeLimits[$levelReached - 1]))));
	$outputArray[2] = $hundredth;
	if ($hundredth === 100) {
		$hundredth = "00";
		$levelReached = strval(intval($levelReached) + 1);
	};
	$finalScore = (double)($levelReached.".".$hundredth);
	$testToken = $_SESSION["customID"];
	$id = mysqli_real_escape_string($db,$_SESSION["userID"]);
	$query = mysqli_stmt_init($db);
	mysqli_stmt_prepare($query,"INSERT INTO scores (USER_ID,LEVEL_REACHED,QUESTION_REACHED,TIME_TAKEN,FINAL_SCORE,DATE_RECORDED,TEST_TOKEN) VALUES (?,?,?,?,?,NOW(),?)");
	mysqli_stmt_bind_param($query,"ssssss",$id,$levelReached,$questionReached,$timeTaken,$finalScore,$testToken);
	mysqli_stmt_execute($query);
	mysqli_stmt_close($query);
	$outputArray[3] = "end";
	$outputArray[8] = [$finalScore];
	echo json_encode($outputArray);
	ob_flush();
} else if ($practiceWrong && !$invalidToken) {
	$id = mysqli_real_escape_string($db,$_SESSION["userID"]);
	$levelReached = 1;
	$questionReached = intval($outputArray[1]);
	$timeTaken = intval($answerTime - $_SESSION["initialTime"]);
	$finalScore = doubleval($questionReached);
	$testToken = "practice".$_SESSION["customID"];
	$query = mysqli_stmt_init($db);
	mysqli_stmt_prepare($query,"INSERT INTO scores (USER_ID,LEVEL_REACHED,QUESTION_REACHED,TIME_TAKEN,FINAL_SCORE,DATE_RECORDED,TEST_TOKEN) VALUES (?,?,?,?,?,NOW(),?)");
	mysqli_stmt_bind_param($query,"ssssss",$id,$levelReached,$questionReached,$timeTaken,$finalScore,$testToken);
	mysqli_stmt_execute($query);
	mysqli_stmt_close($query);
	$outputArray[8] = [$finalScore,$_SESSION["answer"],$_POST["answer"]];
	echo json_encode($outputArray);
	ob_flush();*/
} else if ((!$valid || $practiceWrong) && !$firstQuestion) { // Wrong Answer
	if ($_SESSION["customTest"] && !$practiceWrong && $_SESSION["loggedIn"]) {
		$levelReached = $outputArray[0];
		$questionReached = $outputArray[1];
		$timeTaken = $answerTime - $_SESSION["initialTime"];
		$timeAllocated = 0;
		for ($i = 1; $i <= $levelReached; $i++) {
			$timeAllocated = $timeAllocated + $level[$i][1];
			if ($i > 15) {
				break;
			};
		};
		$tenth = ($questionReached - 1)/intval($level[intval($levelReached)][0]);
		$hundredth = round(10 - ((10 * $timeTaken)/$timeAllocated))/100;
		$hundredth = $hundredth == 0.1 ? 0.09 : $hundredth;
		$finalScore = (double)round(100 * ($levelReached + $tenth + $hundredth))/100;
		$testToken = $_SESSION["customID"];
		$id = mysqli_real_escape_string($db,$_SESSION["userID"]);
		$query = mysqli_stmt_init($db);
		mysqli_stmt_prepare($query,"INSERT INTO scores (USER_ID,LEVEL_REACHED,QUESTION_REACHED,TIME_TAKEN,FINAL_SCORE,DATE_RECORDED,TEST_TOKEN) VALUES (?,?,?,?,?,NOW(),?)");
		mysqli_stmt_bind_param($query,"ssssss",$id,$levelReached,$questionReached,$timeTaken,$finalScore,$testToken);
		mysqli_stmt_execute($query);
		mysqli_stmt_close($query);
		$outputArray[8] = [$finalScore,$_SESSION["answer"],$_POST["answer"]];
		echo json_encode($outputArray);
		ob_flush(); // Custom Test
	} else if ($_SESSION["loggedIn"] != true) {
		$timeTaken = (string)($answerTime - $_SESSION["initialTime"]);
		if ($practiceWrong) {
			$percentage = round(100 - exp((100-(intval($outputArray[1])))/21.7),2);
			$finalScore = strval(round($outputArray[1],2)).".00";
		} else if ((isset($_GET["t"]) && $_GET["t"] != "") || $_SESSION["customTest"]) {
			$levelReached = $outputArray[0];
			$questionReached = $outputArray[1];
			$timeTaken = intval($timeTaken);
			$timeAllocated = 0;
			for ($i = 1; $i <= $levelReached; $i++) {  // Guest
				$timeAllocated = $timeAllocated + $level[$i][1];
				if ($i > 15) {
					break;
				};
			};
			$tenth = ($outputArray[1] - 1)/intval($level[intval($outputArray[0])][0]);
			$hundredth = round(10 - ((10 * $timeTaken)/$timeAllocated))/100;
			$hundredth = $hundredth == 0.1 ? 0.09 : $hundredth;
			$finalScore = (double)round(100 * ($outputArray[0] + $tenth + $hundredth))/100;
			$denom = 17/sizeof($level);
			$percentage = round((-0.015462026538999 * pow($finalScore * $denom,3)) + (0.192411665838298 * pow($finalScore * $denom,2)) + (7.53732499967728 * $finalScore * $denom) - 7.78495744431249,2);
		} else {
			$levelReached = (string)$_SESSION["currentQuestion"][0];
			$questionReached = (string)$_SESSION["currentQuestion"][1];
			$hundredth = (string)round((10 - ((10 * $timeTaken)/$timeLimits[$levelReached - 1])));
			$hundredth = $hundredth == 10 ? "9" : (string)$hundredth;
			$finalScore = (double)($levelReached.".".(((integer)$questionReached) - 1).$hundredth);
			$percentage = round((-0.015462026538999 * pow($finalScore,3)) + (0.192411665838298 * pow($finalScore,2)) + (7.53732499967728 * $finalScore) - 7.78495744431249,2);
		};
		$outputArray[8] = [$finalScore,$percentage,$timeTaken];
		echo json_encode($outputArray); // Guest User
	} else if ($practiceWrong) {
		$id = mysqli_real_escape_string($db,$_SESSION["userID"]);
		$levelReached = 1;
		$questionReached = intval($outputArray[1]);
		$timeTaken = intval($answerTime - $_SESSION["initialTime"]);
		$finalScore = doubleval($questionReached);
		$testToken = "practice".$_SESSION["customID"];
		$query = mysqli_stmt_init($db);
		mysqli_stmt_prepare($query,"INSERT INTO scores (USER_ID,LEVEL_REACHED,QUESTION_REACHED,TIME_TAKEN,FINAL_SCORE,DATE_RECORDED,TEST_TOKEN) VALUES (?,?,?,?,?,NOW(),?)");
		mysqli_stmt_bind_param($query,"ssssss",$id,$levelReached,$questionReached,$timeTaken,$finalScore,$testToken);
		mysqli_stmt_execute($query);
		mysqli_stmt_close($query);
		$outputArray[8] = [$finalScore,$_SESSION["answer"],$_POST["answer"]];
		echo json_encode($outputArray);
		ob_flush(); // Practice Mode
	} else { // Normal Mode
		$levelReached = (string)$_SESSION["currentQuestion"][0];
		$questionReached = (string)$_SESSION["currentQuestion"][1];
		$timeTaken = (string)($answerTime - $_SESSION["initialTime"]);
		$hundredth = (string)round((10 - ((10 * $timeTaken)/$timeLimits[$levelReached - 1])));
		$hundredth = $hundredth == 10 ? "9" : (string)$hundredth;
		$finalScore = (double)($levelReached.".".(((integer)$questionReached) - 1).$hundredth);
		$query = mysqli_stmt_init($db);
		mysqli_stmt_prepare($query,"SELECT MAX(FINAL_SCORE) FROM scores WHERE USER_ID=? AND (TEST_TOKEN='' OR TEST_TOKEN IS NULL)");
		mysqli_stmt_bind_param($query,"s",$id);
		$id = mysqli_real_escape_string($db,$_SESSION["userID"]);
		mysqli_stmt_bind_result($query,$recordedHighScore);
		mysqli_stmt_execute($query);
		mysqli_stmt_fetch($query);
		if ($finalScore > $recordedHighScore) {
			mysqli_stmt_prepare($query,"UPDATE users SET USER_HIGHSCORE=? WHERE USER_ID=?");
			mysqli_stmt_bind_param($query,"ss",$finalScore,$id);
			mysqli_stmt_execute($query);
		};
		mysqli_stmt_prepare($query,"INSERT INTO scores (USER_ID,LEVEL_REACHED,QUESTION_REACHED,TIME_TAKEN,FINAL_SCORE,DATE_RECORDED) VALUES (?,?,?,?,?,NOW())");
		mysqli_stmt_bind_param($query,"sssss",$id,$levelReached,$questionReached,$timeTaken,$finalScore);
		mysqli_stmt_execute($query);
		mysqli_stmt_close($query);
		$outputArray[8] = [$finalScore,$_SESSION["answer"],$_POST["answer"]];
		echo json_encode($outputArray);
		ob_flush();
	};
} else if (($end || $guestFinished || $customEnd) && !$firstQuestion) {
	if ($_SESSION["customTest"] || $customEnd) {
		$levelReached = strval(intval($_SESSION["customLevel"]) + 1);
		$outputArray[0] = intval($levelReached);
		$questionReached = "10";
		$outputArray[1] = 1;
		$timeTaken = $answerTime - $_SESSION["initialTime"];
		$hundredth = strval(round((100 - ((100 * $timeTaken)/$timeLimits[$levelReached - 1]))));
		if ($hundredth === 100) {
			$hundredth = "00";
			$levelReached = strval(intval($levelReached) + 1);
		};
		$finalScore = (double)($levelReached.".".$hundredth);
		$testToken = $_SESSION["customID"];
		$id = mysqli_real_escape_string($db,$_SESSION["userID"]);
		$query = mysqli_stmt_init($db);
		mysqli_stmt_prepare($query,"INSERT INTO scores (USER_ID,LEVEL_REACHED,QUESTION_REACHED,TIME_TAKEN,FINAL_SCORE,DATE_RECORDED,TEST_TOKEN) VALUES (?,?,?,?,?,NOW(),?)");
		mysqli_stmt_bind_param($query,"ssssss",$id,$levelReached,$questionReached,$timeTaken,$finalScore,$testToken);
		mysqli_stmt_execute($query);
		mysqli_stmt_close($query);
		$outputArray[3] = "end";
		$outputArray[8] = [$finalScore];
		echo json_encode($outputArray);
		ob_flush();
	} else {
		$levelReached = "16";
		$questionReached = "10";
		$timeTaken = (string)($answerTime - $_SESSION["initialTime"]);
		$hundredth = (string)round((100 - ((100 * $timeTaken)/$timeLimits[$levelReached - 1])));
		if ($hundredth === "100") {
			$hundredth = "00";
			$levelReached = "17";
		};
		$finalScore = (double)($levelReached.".".$hundredth);
		$query = mysqli_stmt_init($db);
		mysqli_stmt_prepare($query,"SELECT MAX(FINAL_SCORE) FROM scores WHERE USER_ID=? AND (TEST_TOKEN='' OR TEST_TOKEN IS NULL)");
		mysqli_stmt_bind_param($query,"s",$id);
		$id = mysqli_real_escape_string($db,$_SESSION["userID"]);
		mysqli_stmt_bind_result($query,$recordedHighScore);
		mysqli_stmt_execute($query);
		mysqli_stmt_fetch($query);
		if ($finalScore > $recordedHighScore) {
			mysqli_stmt_prepare($query,"UPDATE users SET USER_HIGHSCORE=? WHERE USER_ID=?");
			mysqli_stmt_bind_param($query,"ss",$finalScore,$id);
			mysqli_stmt_execute($query);
		};
		mysqli_stmt_prepare($query,"INSERT INTO scores (USER_ID,LEVEL_REACHED,QUESTION_REACHED,TIME_TAKEN,FINAL_SCORE,DATE_RECORDED) VALUES (?,?,?,?,?,NOW())");
		mysqli_stmt_bind_param($query,"sssss",$id,$levelReached,$questionReached,$timeTaken,$finalScore);
		mysqli_stmt_execute($query);
		mysqli_stmt_close($query);
		ob_flush();
		$outputArray[8] = [$finalScore];
		echo json_encode($outputArray); // Normal
	};
};
?>
