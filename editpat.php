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
	<title>Edit Patients</title>
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

<div class="subjectBox">Do some stuff:</div>

<div class="titleBox"><a href="patient.php">Back</a></div>


<div class="subjectBox" style="margin-bottom: 5px;">Search for patients:</div>


<form action="editpat.php" method="post">

<input type="text" name="search" class="inputBox" style="text-align: center; font-size: 1.9em" placeholder="Enter name here...">
<input type="submit" class="inputBox" value="go.">

</form>




</form>


<?php

include 'database[2].php';

if(isset($_POST['search'])){ 

		if(!empty($_POST['search'])){

			$search = $_POST['search'];

			$sql = "SELECT * FROM patient WHERE fname LIKE '%$search%' ORDER BY id DESC"; 

			$result = $conn->query($sql);

			$num_row = mysqli_num_rows($result);

			echo "<div class='subjectBox'>Search Results:</div>";


			if($num_row > 1){
				echo "<div class='titleBox' style='margin-bottom: 35px;'>There were " . $num_row . " results for your query.</div>";

			} else if($num_row === 1){
				echo "<div class='titleBox' style='margin-bottom: 35px;'>There was 1 result for your query.</div>";

			} else {
				echo "<div class='titleBox' style='margin-bottom: 35px;'>There were no results for your query.</div>";
			}


			while ($row = mysqli_fetch_array($result)){ 

			 echo "<div class='titleBox'>Patient's Full Name: " . $row['fname'] . "</div>
			 <div class='titleBox' style='margin-bottom: 35px;'>Patient's Age: " . $row['age'] . "</div>";					
				
			}

				echo "<div class='titleBox' >Searched for: " . $search . ".</div>";


	} else {
		echo '<div class="titleBox" style="margin-top: 50px;">Please fill in all values.</div>';
	}
} 

?>


<div class='subjectBox'>Edit Patient:</div>



<div class="titleBox"><a href="editpname.php">Edit Name</a></div>
<div class="titleBox"><a href="editage.php">Edit Age</a></div>
<div class="titleBox"><a href="editbday.php">Edit Birth Date</a></div>
<div class="titleBox"><a href="editdoc.php">Edit Doctor</a></div>
<div class="titleBox"><a href="editaddress.php">Edit Address</a></div>
<div class="titleBox"><a href="editcity.php">Edit City</a></div>
<div class="titleBox"><a href="editstate.php">Edit State</a></div>
<div class="titleBox"><a href="editnum.php">Edit Phone</a></div>
<div class="titleBox" style="margin-bottom: 45px;"><a href="editcomm.php">Edit Comment</a></div>







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
	<title>Edit Patients</title>
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
