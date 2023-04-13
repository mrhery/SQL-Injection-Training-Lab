<?php
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

define("LOCAL", true);
include_once(dirname(__DIR__) . "/core/connection.php");

if(!isset($_GET["id"])){
	header("Location: ./index.php?id=1");
}

$id = $_GET["id"];
$q = mysqli_query($conn, "SELECT * FROM users WHERE id = '$id'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Level 1 - Basic GET SQL Injection</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container text-center mt-5">
	
	<h4>User Profile</h4>
<?php
	$n = mysqli_num_rows($q);
	
	if($n > 0){
		$r = mysqli_fetch_object($q);
?>
	Name: <?= $r->name ?><br />
	Email: <?= $r->email ?><br />
<?php
	}
?>
</div>
</body>
</html>
