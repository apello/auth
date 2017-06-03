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
	<title>Delete Patients</title>
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

<div class="titleBox"><a href="crtepat.php">Create Patient</a></div>
<div class="titleBox"><a href="editpat.php">Edit Patient</a></div>





<div class="subjectBox" style="margin-bottom: 5px;">Search:</div>


<form action="delpat.php" method="post">

<input type="text" name="search" class="inputBox" style="text-align: center; font-size: 1.9em" placeholder="Enter name here...">
<input type="submit" class="inputBox" value="go.">

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
				echo "<div class='titleBox' style='margin-bottom: 45px;'>There were " . $num_row . " results for your query.</div>";
			} else if($num_row === 1){
				echo "<div class='titleBox' style='margin-bottom: 45px;'>There was 1 result for your query.</div>";
			} else {
				echo "<div class='titleBox' style='margin-bottom: 45px;'>There were no results for your query.</div>";
			}

			while ($row = mysqli_fetch_array($result)){ 
					echo "<div class='titleBox'>#" . $row['id'] . "</div>
					<div class='titleBox' style='margin-bottom: 45px;'>Patient's Full Name: " . $row['fname'] . "</div>";		
				} 


				echo "<div class='titleBox' >Searched for: " . $search . ".</div>";


	} else {
		echo '<div class="titleBox" style="margin-top: 50px;"">Please fill in all values.</div>';
	}
} 

?>

<div class="titleBox" style="margin-top: 60px;"><a href="clearallin.php">Clear All</a></div>


<div class="titleBox">Wondering what an ID is? Check out our <a href="faq.html">frequently asked question page.</a></div>

<div class="subjectBox" style="margin-bottom: 5px;">Delete Patient:</div>
<form action="delpat.php" method="post">

<input type="text" name="query" style="text-align: center; font-size: 1.9em" class="inputBox" placeholder="Enter ID here:">
<input type="submit" class="inputBox" value="go.">

</form>

<?php

include 'database[2].php';

$query = $_POST['query'];

if($query === ''){
	echo "<div class='titleBox' style='margin-top: 50px;'>Please fill in all values.</div>";
} elseif(!empty($query)) { 

	$sql = "DELETE FROM patient WHERE id = '$query'";
	$result = $conn->query($sql);
	$nrow = mysqli_affected_rows($conn);

	if($nrow === 0){
		echo "<div class='titleBox' style='margin-top: 50px;'>Unsuccessfully deleted user.</div>";
	} else {
		echo "<div class='titleBox' style='margin-top: 50px;'>Successfully deleted user.</div>";
	}
}


?>



<div class="subjectBox">All Patients:</div>

  <?php

	include 'database[2].php';

	$sql = "SELECT * FROM patient ORDER BY id DESC"; 

	$result = $conn->query($sql);

	$num_row = mysqli_num_rows($result);


	
		if($num_row > 1){
			echo "<div class='titleBox' style='margin-bottom: 45px;'>There are " . $num_row . " patients currently registered.</div>";
		} else if($num_row === 1){
			echo "<div class='titleBox' style='margin-bottom: 45px;'>There is currently 1 patient registered.</div>";
		} else {
			echo "<div class='titleBox' style='margin-bottom: 45px;'>There are currently no patients registered.</div>";
		}

	    
	    while ($row = mysqli_fetch_array($result)){ 

	     echo "<div class='titleBox'>#" . $row['id'] . "</div>
				<div class='titleBox' style='margin-bottom: 45px;'>Patient's Full Name: " . $row['fname'] . "</div>";
				
			} 
		




?>


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
	<title>Delete Patients</title>
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
