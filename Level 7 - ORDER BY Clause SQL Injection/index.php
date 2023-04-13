<?php
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

define("LOCAL", true);
include_once(dirname(__DIR__) . "/core/connection.php");

if(!isset($_GET["order"])){
	header("Location: ./index.php?order=id");
}

$order = $_GET["order"];

$q = mysqli_query($conn, "SELECT * FROM users ORDER BY '$order'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Level 7 - ORDER BY Clause SQL Injection</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container text-center mt-5">
	
	<h4>User Profile</h4>
<?php
	while($r = mysqli_fetch_object($q)){
?>
	Name: <?= $r->name ?> | Email: <?= $r->email ?><br />
<?php
	}
?>
</div>
</body>
</html>
