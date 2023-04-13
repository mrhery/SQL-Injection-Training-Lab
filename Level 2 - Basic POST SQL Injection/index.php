<?php
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

define("LOCAL", true);
include_once(dirname(__DIR__) . "/core/connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Level 2 - Basic POST SQL Injection</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container text-center mt-5">
	
	<h4>Find User Email</h4>
	<form action="" method="POST">
		<input type="text" class="form-control text-center" name="name" value="<?= isset($_POST['name']) ? $_POST["name"] : "user1" ?>" placeholder="user1" /><br />
		
		<button class="btn btn-primary">
			Search
		</button>
	</form>
	<br />
	<b>Result:</b><br />
<?php
	if(isset($_POST["name"])){
		$name = $_POST["name"];
		$q = mysqli_query($conn, "SELECT * FROM users WHERE name = '$name'");
		$n = mysqli_num_rows($q);
	
		if($n > 0){
			$r = mysqli_fetch_object($q);
	?>
		Name: <?= $r->name ?><br />
		Email: <?= $r->email ?><br />
	<?php
		}
	}
?>
</div>
</body>
</html>
