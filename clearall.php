<?php

session_start();

include 'database.php';

$sql = "DELETE FROM patient WHERE 1";
$query = $conn->query($sql);

if($query){
	header("Location: delpat.php");
} else {
	echo "Deletion of all registered patients was unsuccessful.";
}
