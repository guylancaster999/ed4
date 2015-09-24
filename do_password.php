<?php
$pass = strtoupper($_POST['pass']);
require "classes/classes.php";
$ret=Page::test_psw($pass);
session_start();
if ($ret==1)
{
	$_SESSION['pass'] = $pass;
	header("Location: mngr.php");
}
else
{
	header("Location: mngr_login.php?err=Bad-Password");	
}