<?php

session_start();

include 'database.php';

if(isset($_SESSION['user_id'])){
	$records = $conn->prepare('SELECT id,fname FROM users WHERE id = :id');
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
	<title>Edit Name</title>
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

$newname = $_POST['newname'];

if($newname === ''){
	echo '<div class="titleBox">Please fill in all values.</div>';
} elseif(!empty($_POST['newname'])){

	$id = $user['id'];

	echo $id;
	
	$sql = "UPDATE users SET fname = '$newname' WHERE id = '$id'";
	$result = $conn->query($sql);

	$num = mysqli_affected_rows($conn);

	echo "<br/>" . $num;


	if($num > 0){
		echo "<script> if (window.location.href.substr(-2) !== '?r') {
    		window.location = window.location.href + '?r';
		}
		</script>";
	} else {
		echo '<div class="titleBox">There may have been an issue editing your account.</div>';
	}
}

?>





<div class="subjectBox">Current Name:</div>

<div class="titleBox"><?= $user['fname']?></div>


<div class="subjectBox">Edit Name:</div>

<form action="editname.php" method="post">

<input type="text" name="oldname" class="inputBox" placeholder="Enter old name here:">
<input type="text" name="newname" class="inputBox" placeholder="Enter new name here:">
<input type="submit" class="inputBox" style="margin-bottom: 50px;" value="go.">

</form>

</div>



</div>




</body>
</html>


<?php else: ?>


<html>
<head>
	<title>Edit Name</title>
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
