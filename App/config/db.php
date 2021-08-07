<?php 

    // Enable us to use Headers
    //ob_start();

    // Set sessions
    //if(!isset($_SESSION)) {
    //    session_start();
    //}
	global $connection;
    $hostname = "localhost"; // you can replace localhost if your mysql is not on local server 
    $username = "root";       // If your username of mysql is different replace root
    $password = "";           // Replace password if you have different password
    $dbname = "Seun";         // Don't change as i given you script of sql with database name is "Seun". 

    //I already showed you how to create the database and tables from sql script in mysql. 
    
    $connection = mysqli_connect($hostname, $username, $password, $dbname) or die("Database connection not established.");
	//var_dump($connection);
?>