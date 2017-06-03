<?php

session_start();

include 'database.php';

if(isset($_SESSION['user_id'])){
	$records = $conn->prepare('SELECT id,username FROM users WHERE id = :id');
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
	<title>Edit Username</title>
</head>

<link rel="stylesheet" type="text/css" href="style.css">

<body>
<div id="borderTop"></div>
<div id="borderBottom"></div>



<div id="invisiBar">
	<div id="logo">
		<a href="editacc.php">
		<img src="Logo.png">
		</a>
	</div>
</div> 

<div id="contentCenter">


<?php 


include 'database[2].php';

$newuser = $_POST['newuser'];

if($newuser === ''){
	echo '<div class="titleBox">Please fill in all values.</div>';
} elseif(!empty($_POST['newuser']) && !empty($_POST['olduser'])){
	
	$sql = "UPDATE users SET username = '$newuser' WHERE username = '$olduser'";
	$result = $conn->query($sql);

	$id = $user['id'];

	echo $id;
	
	$sql = "UPDATE users SET username = '$newuser' WHERE id = '$id'";
	$result = $conn->query($sql);

	$num = mysqli_affected_rows($conn);

	echo "<br/>" . $num;


	if($num > 0){
		echo "<script> if (window.location.href.substr(-2) !== '?r') {
    		window.location = window.location.href + '?r';
		}
		</script>";
	} else {
		echo '<div class="titleBox">That username may be in use as there has been an error editing your account.</div>';
	}
}

?>





<div class="subjectBox">Current Username:</div>

<div class="titleBox"><?= $user['username']?></div>
	<?php if(!empty($message)): ?><p><?= $message ?></p><?php endif; ?>


<div class="subjectBox">Edit Username:</div>

<form action="edituser.php" method="post">

<input type="text" name="olduser" class="inputBox" placeholder="Enter old username here:">
<input type="text" name="newuser" class="inputBox" placeholder="Enter new username here:">
<input type="submit" class="inputBox" style="margin-bottom: 50px;" value="go.">

</form>

</div>



</div>




</body>
</html>


<?php else: ?>


<html>
<head>
	<title>Edit Username</title>
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
