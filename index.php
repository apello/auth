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
	<title>Home</title>
</head>

<link rel="stylesheet" type="text/css" href="style.css">

<body>
<div id="borderTop"></div>
<div id="borderBottom"></div>


<div id="invisiBar">
	<div id="logo">
		<img src="Logo.png">
	</div>
</div> 

<div id="contentCenter">

<div class="subjectBox">Hello, <?= $user['fname']; ?></div>

<div class="subjectBox">Get some work done:</div>

<div class="titleBox"><a href="patient.php">Patients</a></div>




<div class="subjectBox">Other Stuff:</div>

<div class="titleBox"><a href="account.php">Account</a></div>

<div class="titleBox"><a href="faq.html">FAQ</a></div>


<div class="subjectBox">Other Other Stuff:</div>

<div class="titleBox"><a href="logout.php">Logout</a></div>






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
	<title>Home</title>
</head>

<link rel="stylesheet" type="text/css" href="style.css">


<body>

<div id="borderTop"></div>
<div id="borderBottom"></div>

<div id="invisiBar">
	<div id="logo">
		<img src="Logo.png">
	</div>
</div> 

<div id="contentCenter">

<div class="subjectBox"><a href="login.php">Login</a> or <a href="register.php">Register</a></div>

<div class="titleBox">Welcome to it.beta.net! The purpose of it.net is to allow the instant communication of crucial information between users. Inputed information is immediately posted on a central forum for all eyes. Anyone can view, edit, or delete data. Intertwined work that inhances productivity is what motivates it.beta.net.</div>

<div class="titleBox"><a href="faq.html">FAQ</a></div>





<div id="footer"><img src="Logo.png"><h1>Created by Abdi Nur.</h1></div>

<div style="text-align: center; margin-bottom: 65px;" class="titleBox"><a href="adminin.php">Administrator</a></div>


</div>




</body>
</html>

<?php endif; ?>
