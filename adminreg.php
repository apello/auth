<?php

session_start();

include 'database.php';

$message = '';

if($_POST['username'] === '' || $_POST['password'] === ''){
	$message = '<div class="titleBox">Please fill in all values.</div.';
}  else if(!empty($_POST['username']) && !empty($_POST['password'])):
	
	$sql = "INSERT INTO admin (username, password) VALUES (:username, :password)";
	$stmt = $conn->prepare($sql);

	$stmt->bindParam(':username', $_POST['username']);
	$stmt->bindParam(':password', password_hash($_POST['password'], PASSWORD_BCRYPT));

	if($stmt->execute() ):
		$message = '<div class="titleBox">Sucessfully created account.</div>';
	else:
		$message = '<div class="titleBox">There has been an error creating account.</div>';
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
		<img src="Logo.png">
	</div>
</div> 

<div id="contentCenter">



<div class="subjectBox" style="margin-bottom: 10px;">Register:</div>

<form action="adminreg.php" method="post">

<input type="text" name="username" class="inputBox"  placeholder="Enter username here:">
<input type="password" name="password" class="inputBox"  placeholder="Enter password here:">
<input type="submit" class="inputBox"  value="go.">

	<?php if(!empty($message)): ?><p><?= $message ?></p><?php endif; ?>
</form>

</div>




</body>
</html>

