<?php
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

define("LOCAL", true);
include_once(dirname(__DIR__) . "/core/connection.php");

if(!isset($_GET["limit"])){
	header("Location: ./index.php?limit=3");
}

$limit = $_GET["limit"];

$sql = "SELECT * FROM users LIMIT " . $limit;

$q = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Level 6 - Limit Clause SQL Injection</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container text-center mt-5">
	
	<h4>User Profile</h4>
<?php
	$e = mysqli_error($conn);
	
	print_r($e);
	
	while($r = mysqli_fetch_object($q)){
?>
	Name: <?= $r->name ?> | Email: <?= $r->email ?><br />
<?php
	}
?>

	<pre class="mt-5"><?= $sql ?></pre>
</div>
</body>
</html>
