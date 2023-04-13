<?php


$error = [];

if(file_exists(__DIR__ . "/configure.json")){
	if(!defined("DONE")){
		define("DONE", true);
	}
}else{
	if(isset($_POST["host"], $_POST["port"], $_POST["username"], $_POST["password"])){
		$config = [
			"host"		=> $_POST["host"],
			"port"		=> $_POST["port"],
			"username"	=> $_POST["username"],
			"password"	=> $_POST["password"]
		];
		
		$f = fopen(__DIR__ . "/configure.json", "w+");
		fwrite($f, json_encode($config));
		fclose($f);
		
		$conn = mysqli_connect($config["host"] . ":" . $config["port"], $config["username"], $config["password"], "sqli_lab");
		
		if($conn){
			mysqli_query($conn, <<<SQL
				CREATE TABLE users (
					id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
					name VARCHAR(100),
					email VARCHAR(100),
					password VARCHAR(100),
					picture VARCHAR(100)
				);
SQL);
		
			$password = ["12345678", "abc123", "123abc", "12341234", "123123"];
			
			$pass = hash("md5", $password[0]);
			mysqli_query($conn, <<<SQL
			INSERT INTO users (name, email, password, picture) VALUES ("user1", "user1@email.com", "$pass", "user1.jpg");
SQL);
		
			$pass = hash("md5", $password[1]);
			mysqli_query($conn, <<<SQL
			INSERT INTO users (name, email, password, picture) VALUES ("user2", "user2@email.com", "$pass", "user2.jpg");
SQL);

			$pass = hash("md5", $password[2]);
			mysqli_query($conn, <<<SQL
			INSERT INTO users (name, email, password, picture) VALUES ("user3", "user3@email.com", "$pass", "user3.jpg");
SQL);

			$pass = hash("md5", $password[3]);
			mysqli_query($conn, <<<SQL
			INSERT INTO users (name, email, password, picture) VALUES ("user4", "user4@email.com", "$pass", "user4.jpg");
SQL);

			$pass = hash("md5", $password[4]);
			mysqli_query($conn, <<<SQL
			INSERT INTO users (name, email, password, picture) VALUES ("user5", "user5@email.com", "$pass", "user5.jpg");
SQL);
		
			define("DONE", true);
		}else{
			$error[] = "Fail connecting to your database.";
		}	
	}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>SQL Injection Training Lab</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container pt-4">
	<h1>Welcome to SQL Injection Lab Training!</h1>
<?php
	if(defined("DONE")){
	?>
	<div class="alert alert-success">
		<strong>Completed!</strong> Your database information has been saved.</a>.
	</div>
	
	<div class="alert alert-info">
		<strong>Completed!</strong> You can continue for practice.</a>.
	</div>
	
	<div class="card">
		<div class="card-body">
		<h4>Available Levels:</h4>
		<?php
			$dirs = [];
			foreach (scandir(__DIR__) as $d) {
				$dirs[] = $d;
			}
			
			natsort($dirs);
			
			foreach($dirs as $dir){
				if(!in_array($dir, [".", "..", ".git", ".gitignore", ".gitattributes", "README.md", "configure.json", "assets", "index.php", "core"])){
					echo "<a href='./$dir' class='mb-2 fs-5' target='_blank'>" . $dir . "</a><br />";
				}
			}
		?>
		</div>
	</div>	
<?php
	}else{
?>
	
	<p>To continue setup this training, you need to follow these step:</p>
	<p>1. Make sure you have started MySQL database.</p>
	<p>2. Create a database named <code>sqli_lab</code>.</p>
	<p>3. Fill up these info & Submit:</p>

	<p>
		<form action="" method="POST">
			DB Host
			<input type="text" class="form-control" name="host" value="127.0.0.1" /><br />

			DB Port (default 3306):
			<input type="text" class="form-control" name="port" value="3306" /><br />

			DB Username:
			<input type="text" class="form-control" name="username" value="root" /><br />

			DB Password:
			<input type="text" class="form-control" name="password" value=""  /><br />

			<button class="btn btn-primary">
				Submit
			</button>
		</form>
	</p>
<?php
	}
?>
</div>

</body>
</html> 