<?php
	$c = $_GET['c'];
	$a = $_GET['a'];
	include "./controller/{$c}Controller.class.php";
	include "./common/function.php";
	session_start();
	header("Content-type:text/html;charset=utf-8");
	$className = "{$c}Controller";
	$obj = new $className();
	$obj -> $a();
	// DocBlockr