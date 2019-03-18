<?
if (session_status() == PHP_SESSION_NONE) {
	session_start();
};
session_destroy();
$_SESSION["loggedIn"] = false;
ob_start();
setcookie("rememberMe","",time()-3600,"/","mentalmathstest.com",null,true);
ob_flush();
?>
<script type="text/javascript">
	window.location = "http://mentalmathstest.com";
</script>
