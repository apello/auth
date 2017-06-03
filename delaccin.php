<?php

session_start();


include 'database.php';

$message = '';


if($_POST['username'] === '' || $_POST['password'] === ''){
	$message = '<div class="titleBox">Please fill in all values.</div.';
} else if(!empty($_POST['username']) && !empty($_POST['password'])):
	
	$records = $conn->prepare('SELECT id,username,password FROM users WHERE username = :username');
	$records->bindParam(':username', $_POST['username']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);


	if(count($results) > 0 && password_verify($_POST['password'], $results['password']) ){

		$_SESSION['user_id'] = $results['id'];
		header("Location: delete.php");

	} else {
		$message = '<div class="titleBox">Sorry, those credentials do not match.</div.';
	}

endif;


if(isset($_SESSION['user_id'])){
	$records = $conn->prepare('SELECT id FROM users WHERE id = :id');
	$records->bindParam(':id', $_SESSION['user_id']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);

	$user = NULL;

	if( count($results) > 0){
		$user = $results;
	}

}

?>

	<?php if( !empty($user) ): ?>



<html>
<head>
	<title>Login</title>
</head>

<link rel="stylesheet" type="text/css" href="style.css">

<body>
<div id="borderTop"></div>
<div id="borderBottom"></div>



<div id="invisiBar">
	<div id="logo">
		<a href="delaccount.php">
		<img src="Logo.png">
		</a>
	</div>
</div> 

<div id="contentCenter">



<div class="subjectBox" style="margin-bottom: 10px;">Login:</div>

<form action="delaccin.php" method="post">

<input type="text" name="username" class="inputBox" placeholder="Enter username here:">
<input type="password" name="password" class="inputBox" placeholder="Enter password here:">
<input type="submit" class="inputBox" value="go.">

	<?php if(!empty($message)): ?><p><?= $message ?></p><?php endif; ?>
</form>

</div>




</body>
</html>


<?php else: ?>


<html>
<head>
	<title>Login</title>
</head>

<link rel="stylesheet" type="text/css" href="style.css">

<body>

<div id="borderTop"></div>

<div id="sideBar">
	<div id="logo">
		<a href="index.php">
		<img src="Logo.png">
		</a>
	</div>
</div> 


<div id="errormsg">Please login or signup to view more.</div>

</body></html>

<?php endif; ?>


