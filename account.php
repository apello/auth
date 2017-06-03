<?php

session_start();

include 'database.php';

if(isset($_SESSION['user_id'])){
	$records = $conn->prepare('SELECT id,fname,username FROM users WHERE id = :id');
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
	<title>Account</title>
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

<div class="subjectBox">Account Info:</div>

<div class="titleBox">Full Name: <?= $user['fname'] ?></div>
<div class="titleBox">Username: <?= $user['username'] ?></div>



<div class="subjectBox">Other Account Stuff:</div>

<div class="titleBox"><a href="editacc.php">Edit Account</a></div>
<div class="titleBox"><a href="delaccount.php">Delete Account</a></div>





<div id="footer">
	<img src="Logo.png">
	<h1>Created by Abdi Nur.</h1>
</div>



</div>




</body>
</html>


<?php else: ?>


<html>
<head>
	<title>Account</title>
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



<?php endif; ?>
