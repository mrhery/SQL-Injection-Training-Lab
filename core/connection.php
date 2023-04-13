<?php
if(!defined("LOCAL")){
	header("HTTP/1.0 404 Not Found");
	
	die("<h2>404 Not Found</h2>");
}

if(file_exists(dirname(__DIR__) . "/configure.json")){
	$json = file_get_contents(dirname(__DIR__) . "/configure.json");
	$obj = json_decode($json);
	
	$conn = mysqli_connect($obj->host . ":" . $obj->port, $obj->username, $obj->password, "sqli_lab");
	
	if(!$conn){
		die("Fail connecting to your database. Please make sure your MySQL server is enabled and this training has been setup properly.");
	}
}else{
	header("Content-Type: text/plain");
	die("you need to setup the database of this training first.");
}
