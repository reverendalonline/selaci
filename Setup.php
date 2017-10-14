<?php include 'session.php';
if(isset($_SESSION['id']))
{
    if ($_SESSION['id'] > 1) {
        header('location: CustomerDash.php');
    }
    else {
        header('location: party.php');
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
        <head>
        <style>
        p
        {
            padding:20px;
            color:white;
            width:300px;
            margin: 10px auto;
        }
        p.success{
            background-color:green;
        }
        p.error {
            background-color:red;
        }
        a.link
        {
            background-color: blue;
            display: block;
            padding:20px;
            width:80%;
            text-align: center;
            color:white;
        }

        </style>
        </head>
    </head>
    <body>
        <?php
        $servername = 'localhost';
        $username = 'root';
        $password = '';
        $dbname = 'selaci';

        // Create connection
        $conn = new mysqli($servername, $username, $password);
        // Check connection
        if ($conn->connect_error) {
            die('Connection failed!:'. $conn->connect_error . '</p>');
        }


        // Create database
        $conn = new mysqli($servername, $username, $password);
        $sql = 'CREATE DATABASE ' . $dbname;
        if ($conn->query($sql) === TRUE) {
            echo '<p class="success">Database created successfully</p>';
        } else {
            echo '<p class="error">Error creating database: ' . $conn->error . '</p>';

        	}


        // sql to create table customer
        $conn = new mysqli($servername, $username, $password,$dbname);
        $sql = 'CREATE TABLE IF NOT EXISTS customer (
          customerid int(6) unsigned PRIMARY KEY NOT NULL AUTO_INCREMENT,
          customername varchar(30) NOT NULL,
          address varchar(30) NOT NULL,
          childDateOfBirth date NOT NULL,
          childage int(11) NOT NULL,
          childgender varchar(30) NOT NULL,
          email varchar(50) DEFAULT NULL,
          username varchar(30) NOT NULL,
          password varchar(30) NOT NULL,
          Accesslevel varchar(30) NOT NULL DEFAULT "user",
          reg_date timestamp NULL DEFAULT NULL
        )';

        if ($conn->query($sql) === TRUE) {
            echo '<p class="success">Table customer created successfully</p>';
        } else {
            echo '<p class="error">Error creating table: ' . $conn->error . '</p>';
        }

        // sql to create table party
        $sql = 'CREATE TABLE IF NOT EXISTS booking (
          bookingid int(6) unsigned NOT NULL AUTO_INCREMENT,
          customername varchar(30) NOT NULL,
          Number int(10) DEFAULT NULL,
          BookingDate date DEFAULT NULL,
          PartyBooked varchar(30) DEFAULT NULL,
          fullcost int(20) DEFAULT NULL,
          amount_perchild int(20) DEFAULT NULL,
          reg_date timestamp NULL DEFAULT NULL,
          bookstatus enum("1","0") NOT NULL,
          PRIMARY KEY (bookingid)
        )';

        if ($conn->query($sql) === TRUE) {
            echo '<p class="success">Table bookings created successfully</p>';
        } else {
            echo '<p class="error">Error creating table: ' . $conn->error . '</p>';
        }


        // sql to create table user
        $sql = 'CREATE TABLE IF NOT EXISTS party (
          partyid int(6) unsigned NOT NULL AUTO_INCREMENT,
          partytype varchar(30) NOT NULL,
          partyDesc TEXT NOT NULL,
          costperchild double(9,2) DEFAULT NULL,
          partylength varchar(30) NOT NULL,
          nochildattend varchar(30) NOT NULL,
          prodnservices TEXT NOT NULL,
          reg_date timestamp NULL DEFAULT NULL,
          partyImg varchar(100) NOT NULL,
          PRIMARY KEY (partyid)
        )';

        if ($conn->query($sql) === TRUE) {
            echo '<p class="success">Table party created successfully</p>';
        } else {
            echo '<p class="error">Error creating table: ' . $conn->error . '</p>';
        }


        $conn->close();

        ?>
         <p>
        <a href = './' class="link">Go to Login </a>

    </body>
</html>
