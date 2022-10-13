<?php

// db credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "usradb";

// initialize $con
$con=mysqli_connect($servername, $username, $password, $dbname);

// test $con
if ($con->connect_error) {
  die("USRA Database Connection Failed: ".$con->connect_error);
}
