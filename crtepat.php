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
	<title>Create Patient</title>
</head>

<link rel="stylesheet" type="text/css" href="style.css">

<body>
<div id="borderTop"></div>
<div id="borderBottom"></div>



<div id="invisiBar">
	<div id="logo">
		<a href="patient.php">
		<img src="Logo.png">
		</a>
	</div>
</div> 

<div id="contentCenter">

<?php

session_start();

include 'database.php';

$message = '';

$fname = $_POST['fname'];
$age = $_POST['age'];
$dob = $_POST['dob'];
$doc = $_POST['doc'];
$address = $_POST['address'];
$city = $_POST['city'];
$state = $_POST['state'];
$phone = $_POST['phone'];
$comment = $_POST['comment'];

if($fname === '' || $age === '' || $dob === '' || $doc === '' || $address === '' || $city === '' || $state === '' || $phone === '' || $comment === ''){
	$message = '<div class="titleBox">Please fill in all values.</div>';
}  else if(!empty($_POST['fname']) && !empty($_POST['age']) && !empty($_POST['dob']) && !empty($_POST['doc']) && !empty($_POST['address']) && !empty($_POST['city']) && !empty($_POST['state']) && !empty($_POST['phone']) && !empty($_POST['comment'])):

	$sql = "INSERT INTO patient (fname, age, dob, doc, address, city, state, phone, comment) VALUES (:fname, :age, :dob, :doc, :address, :city, :state, :phone, :comment)";
	$stmt = $conn->prepare($sql);

	$stmt->bindParam(':fname', $_POST['fname']);
	$stmt->bindParam(':age', $_POST['age']);
	$stmt->bindParam(':doc', $_POST['doc']);
	$stmt->bindParam(':dob', $_POST['dob']);
	$stmt->bindParam(':address', $_POST['address']);
	$stmt->bindParam(':city', $_POST['city']);
	$stmt->bindParam(':state', $_POST['state']);
	$stmt->bindParam(':phone', $_POST['phone']);
	$stmt->bindParam(':comment', $_POST['comment']);
	

	if($stmt->execute()):
		echo "<script>window.location.replace('patient.php');</script>";
	else:
		echo '<div class="titleBox">There must have been an issue creating your patient.</div>';
	endif;

endif;

?>

	<?php if(!empty($message)): ?><p><?= $message ?></p><?php endif; ?>
<div class="subjectBox" style="margin-bottom: 10px;">Register:</div>

<form action="crtepat.php" method="post">

<input type="text" name="fname" class="inputBox" placeholder="Enter patient's full name here:">
<input type="number" name="age" class="inputBox"  placeholder="Enter patient's age here:">
<div class="titleBox">Date Of Birth:</div>
<input type="date" name="dob" class="inputBox">
<input type="text" name="doc" class="inputBox" placeholder="Enter patient's assigned doctor here:">
<input type="text" name="address" placeholder="Enter patient's current address here:" class="inputBox">
<input type="text" name="city" placeholder="Enter patient's current city here:" class="inputBox">
<input type="text" name="state" placeholder="Enter patient's current state here:" class="inputBox">
<div class="titleBox">Patient's Current Number:</div>
<input name="phone" class="inputBox" type="tel" style="font-size: 1em;" placeholder="Format: +1(555)555-5555" pattern="[\+]\d{1}[\(]\d{3}[\)]\d{3}[\-]\d{4}" required>
<textarea name="comment" class="inputBox" placeholder="Any additional comments:"></textarea>

<input type="submit" class="inputBox"  value="go.">

</form>

</div>

</body>
</html>


<?php else: ?>


<html>
<head>
	<title>Create Patients</title>
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

