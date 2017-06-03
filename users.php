<?php

session_start();

include 'database.php';

if(isset($_SESSION['user_id'])){
	$records = $conn->prepare('SELECT id FROM admin WHERE id = :id');
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
	<title>Delete Users</title>
</head>

<link rel="stylesheet" type="text/css" href="style.css">

<body>
<div id="borderTop"></div>
<div id="borderBottom"></div>



<div id="invisiBar">
	<div id="logo">
		<a href="admin.php">

		<img src="Logo.png">
		</a>
	</div>
</div> 

<div id="contentCenter">

<div class="subjectBox">Users:</div>





<div class="subjectBox" style="margin-bottom: 5px;">Search:</div>


<form action="users.php" method="post">

<input type="text" name="search" class="inputBox" style="text-align: center; font-size: 1.9em" placeholder="Enter name here...">
<input type="submit" class="inputBox" value="go.">

</form>



<?php

include 'database[2].php';

if(isset($_POST['search'])){ 

		if(!empty($_POST['search'])){

			$search = $_POST['search'];

			$sql = "SELECT * FROM users WHERE id LIKE '%$search%' OR fname LIKE '%$search%' OR username LIKE '%$search%' ORDER BY id DESC"; 

			$result = $conn->query($sql);

			$num_row = mysqli_num_rows($result);

			echo "<div class='subjectBox'>Search Results:</div>";

			if($num_row > 1){
				echo "<div class='titleBox' style='margin-bottom: 45px;'>There were " . $num_row . " results for your query.</div>";
			} else if($num_row === 1){
				echo "<div class='titleBox' style='margin-bottom: 45px;'>There was 1 result for your query.</div>";
			} else {
				echo "<div class='titleBox' style='margin-bottom: 45px;'>There are no results for your query.</div>";
			}

			while ($row = mysqli_fetch_array($result)){ 
					echo "<div class='titleBox'>#" . $row['id'] . "</div>
					<div class='titleBox'>User's Full Name: " . $row['fname'] . "</div>
					<div class='titleBox'>User's Username: " . $row['username'] . "</div>";					
			} 


				echo "<div class='titleBox' >Searched for: " . $search . ".</div>";


	} else {
		echo '<div class="titleBox" style="margin-top: 50px;"">Please fill in all values.</div>';
	}
} 

?>

<div class="titleBox" style="margin-top: 60px;"><a href="clearallin[1].php">Clear All</a></div>


<div class="subjectBox" style="margin-bottom: 5px;">Delete Users</div>
<form action="users.php" method="post">

<input type="text" name="query" style="text-align: center; font-size: 1.9em" class="inputBox" placeholder="Enter ID here:">
<input type="submit" class="inputBox" value="go.">

</form>

<?php

include 'database[2].php';

$query = $_POST['query'];

if($query === ''){
	echo "<div class='titleBox' style='margin-top: 50px;'>Please fill in all values.</div>";
} elseif(!empty($query)) { 

	$sql = "DELETE FROM users WHERE id = '$query'";
	$result = $conn->query($sql);
	$nrow = mysqli_affected_rows($conn);

	if($nrow === 0){
		echo "<div class='titleBox' style='margin-top: 50px;'>Unsuccessfully deleted user.</div>";
	} else {
		echo "<div class='titleBox' style='margin-top: 50px;'>Successfully deleted user.</div>";
	}
}


?>



<div class="subjectBox">All Users:</div>

  <?php

	include 'database[2].php';

	$sql = "SELECT * FROM users ORDER BY id DESC"; 

	$result = $conn->query($sql);

	$num_row = mysqli_num_rows($result);


	
		if($num_row > 1){
			echo "<div class='titleBox' style='margin-bottom: 45px;'>There are " . $num_row . " users currently registered.</div>";
		} else if($num_row === 1){
			echo "<div class='titleBox' style='margin-bottom: 45px;'>There is currently 1 user registered.</div>";
		} else {
			echo "<div class='titleBox' style='margin-bottom: 45px;'>There are currently no users registered.</div>";
		}

	    
	    while ($row = mysqli_fetch_array($result)){ 

	     echo "<div class='titleBox'>#" . $row['id'] . "</div>
			<div class='titleBox'>User's Full Name: " . $row['fname'] . "</div>
			<div class='titleBox' style='margin-bottom: 55px;'>User's Username: " . $row['username'] . "</div>";
				
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
	<title>Delete Users</title>
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
