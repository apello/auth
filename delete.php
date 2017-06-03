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


	$records = $conn->prepare('DELETE FROM users WHERE id = :id');
	$records->bindParam(':id', $_SESSION['user_id']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);


}

?>

	<?php if( !empty($user) ): ?>



<html>
<head>
	<title>Delete</title>
</head>


<body>

<script type="text/javascript">

        window.location.reload();
    
</script>


</body>
</html>


<?php else: ?>


<html>
<head>
	<title>Deleted Account</title>
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


<div id="errormsg">Successfully deleted account.</div>



<?php endif; ?>


