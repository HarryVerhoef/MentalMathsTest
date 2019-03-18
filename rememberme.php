<?php
include "connect.php";
$token = bin2hex(openssl_random_pseudo_bytes(16));
$query = mysqli_stmt_init($db);
mysqli_stmt_prepare($query,"UPDATE users SET USER_TOKEN=? WHERE USER_ID=?");
mysqli_stmt_bind_param($query,"ss",$token,$id);
mysqli_stmt_execute($query);
if(setcookie("rememberMe",$id."_".hash("sha512",$token.$salt),time() + 2592000,"/","mentalmathstest.com",null,true)) {
	$test1234 = "successful";
} else {
	$test1234 = error_get_last();
};
mysqli_stmt_close($query);
?>