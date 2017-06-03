<?php

session_start();

include 'database.php';

$sql = "DELETE FROM users WHERE 1";
$query = $conn->query($sql);

if($query){
	header("Location: users.php");
} else {
	echo "Deletion of all registered users was unsuccessful.";
}
