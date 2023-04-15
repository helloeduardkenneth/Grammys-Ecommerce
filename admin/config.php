<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */


$db_name = 'mysql:host=localhost;dbname=mbaloyo';
$user_name = 'root';
$user_password = '';
 
/* Attempt to connect to MySQL database */


$link = new PDO($db_name, $user_name, $user_password);
 
?>