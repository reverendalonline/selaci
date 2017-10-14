<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'selaci';

// Create connection
try
{
    $db = new PDO("mysql:host=localhost;dbname=" . $dbname, "root", "");
}
catch(Exception $e)
{
    Echo 'launch: <b><a href="setup.php">setup.php</a></b> first';
    die ("error: " . $e->getMessage());
}
