<?php

session_start();

include 'database.php';

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
	<title>Edit Address</title>
</head>

<link rel="stylesheet" type="text/css" href="style.css">

<body>
<div id="borderTop"></div>
<div id="borderBottom"></div>




<div id="invisiBar">
	<div id="logo">
		<a href="editpat.php">
		<img src="Logo.png">
		</a>
	</div>
</div> 

<div id="contentCenter">


<?php 


include 'database[2].php';

$id = $_POST['id'];
$newaddress = $_POST['newaddress'];

if($newaddress === '' || $id === ''){
	echo '<div class="titleBox">Please fill in all values.</div>';
} elseif(!empty($_POST['newaddress']) && !empty($_POST['id'])){

	
	$sql = "UPDATE patient SET address = '$newaddress' WHERE id = '$id'";
	$result = $conn->query($sql);

	$num = mysqli_affected_rows($conn);

	echo "<br/>" . $num;


	if($num > 0){
		echo "<script>window.location.replace('editpat.php');</script>";
	} else {
		echo '<div class="titleBox">There may have been an issue editing the patient\'s account.</div>';
	}
}

?>





<div class="subjectBox">Edit Patient:</div>
<div class="titleBox">Wondering what an ID is? Check out our <a href="faq.html">frequently asked question page.</a></div>



<div class="subjectBox">Edit Address:</div>

<form action="editaddress.php" method="post">

<input type="number" name="id" class="inputBox" placeholder="Enter patient's ID here:">
<input type="text" name="newaddress" class="inputBox" placeholder="Enter new address here:">
<input type="submit" class="inputBox" style="margin-bottom: 50px;" value="go.">

</form>

</div>



</div>




</body>
</html>


<?php else: ?>


<html>
<head>
	<title>Edit Doctor</title>
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
