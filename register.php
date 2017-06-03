<?php

session_start();

include 'database.php';

$message = '';

if($_POST['fname'] === '' || $_POST['username'] === '' || $_POST['password'] === ''){
	$message = '<div class="titleBox">Please fill in all values.</div.';
}  else if(!empty($_POST['fname']) && !empty($_POST['username']) && !empty($_POST['password'])):
	
	$sql = "INSERT INTO users (fname, username, password) VALUES (:fname, :username, :password)";
	$stmt = $conn->prepare($sql);

	$stmt->bindParam(':fname', $_POST['fname']);
	$stmt->bindParam(':username', $_POST['username']);
	$stmt->bindParam(':password', password_hash($_POST['password'], PASSWORD_BCRYPT));

	if( $stmt->execute() ):
		header("Location: login.php");
	else:
		$message = '<div class="titleBox">That username may have been in use. Please try again.</div>';
	endif;

endif;

?>


<html>
<head>
	<title>Register</title>
</head>

<link rel="stylesheet" type="text/css" href="style.css">

<body>
<div id="borderTop"></div>
<div id="borderBottom"></div>



<div id="invisiBar">
	<div id="logo">
		<a href="index.php">
		<img src="Logo.png">
		</a>
	</div>
</div> 

<div id="contentCenter">

<div class="titleBox">Already have an account? <a href="login.php">Login.</a></div> 
<div class="titleBox">Remember account credentials for login after registration.</div> 


<div class="subjectBox" style="margin-bottom: 10px;">Register:</div>

<form action="register.php" method="post">

<input type="text" name="fname" class="inputBox" placeholder="Enter full name here:">
<input type="text" name="username" class="inputBox"  placeholder="Enter username here:">
<input type="password" name="password" class="inputBox"  placeholder="Enter password here:">
<input type="submit" class="inputBox"  value="go.">

	<?php if(!empty($message)): ?><p><?= $message ?></p><?php endif; ?>
</form>

</div>




</body>
</html>

