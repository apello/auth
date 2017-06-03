<?php
$server = 'localhost';
$username = 'root2';
$password = 'Passwordking';
$database = 'root2';

try{
	$conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch(PDOException $e){
	die( "Connection failed: " . $e->getMessage());
}