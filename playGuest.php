<?
session_start();
if (!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] === false) {
	session_destroy();
	session_start();
	$_SESSION["guest"] = "true";
	header("Location: http://mentalmathstest.com/play");
} else {
	$_SESSION["guest"] = "false";
	header("Location: http://mentalmathstest.com/play");
};
?>
