<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>login to time management</title>
	<link rel="stylesheet" type="text/css" href=css/evening.css>
</head>
<body  >
 <style>
 	body{
 		font-family: arial,sans-serif;text-decoration:revert-layer;text-align:top left;border-radius:50px 30px ;text-decoration-color: rebeccapurple;padding: 30px; ;background-image:url(https://wallpaperaccess.com/thumb/83914.jpg);
 	}
 </style>
	<h1>Welocome</h1>
	<h2>login to time_manager</h2>
	<br>
	<hr>
	<form method="POST" action="main_site.php">
		<div>
		<label for="email">email</label>
		<input id="email" type="email" required name="email">
	</div>
	<br>
	<br>
	<div>
		<label for="username">username</label>
		<input id="username" type="text"required name="username">
	</div>
	<br>
	<br>
	<div>
		<label for="password">password</label>
		<input id="password" type="password"required name="password">
	</div>
	<br>
	<br>
		<input type="submit" name="submit">
	</form>
	<div id="activities"></div>
	<script type="text/javascript">
		document.getELementByid('activity-form').addEventListener('submit',function(event){
			event.preventDefault();
			var email=
			document.getELementByid('email').value;
			var username = 
			document.getELementByid('username').value;
			var password = document.getELementByid('password').value;
			document.getELementByid('activity-form').innerHtml +='<p>' + email+ ''+ username +':'+ password +'</p>';
		});

	</script>
	

<?php
if ($_POST){
$username =isset( $_POST["username"]) ?$_POST[" username"] :"";
$email =isset( $_POST["email"]) ? $_POST["email"] :"";
$password =isset($_POST["password"]) ? md5($_POST["password"]) :"";//hashing
     //create connection
	$conn = new mysqli('localhost','root','','time_manager');
	//check connection
	if ($conn->connect_error) {
		die("connection failed:" . $conn->connect_error);
	}else{ 
	//prepare and bind
	$stmt = $conn ->prepare("INSERT INTO A1(username, email, password) VALUES (?, ?, ?)");
	$stmt -> bind_param("sss",$username,$email,$password);
	//set parameters and execute
	if($stmt ->execute()) {
	header("location: main site.php");
     }else{
     	echo "Error :" . $stmt->error;
     }
	$stmt ->close();
	$conn ->close();
	}
  }  

?>
</body>
</html>