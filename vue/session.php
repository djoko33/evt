<?php
if (isset($_POST["debut"])) {
	$_SESSION["debut"] = $_POST["debut"];}
if (isset($_POST["fin"])) {
		$_SESSION["fin"] = $_POST["fin"];
	}
if (isset($_GET['serv'])) {
		$_SESSION["serv"]=$_GET['serv'];
	}
if (isset($_GET['sp'])) {
		$_SESSION["sp"]=$_GET['sp'];
	}
if (isset($_GET['code'])) {
		$_SESSION["code"]=$_GET['code'];
	}
?>