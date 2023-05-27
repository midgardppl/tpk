<?php

$username = 'root';
$password = '';
$hostname = 'localhost'; 
$mydb = 'db_jadwal_baru2';//'coba_jadwalmk';

/*
//$con = mysqli_connect("localhost","my_user","my_password","my_db");
$con = mysqli_connect($hostname,$username,$password,$mydb);

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
*/

//echo "wah ... ";
//*
//connection to the database
$koneksi = mysqli_connect($hostname, $username, $password)
    or die("Unable to connect to MySQL");
//echo "Connected to MySQL<br>";

//select a database to work with
$selected = mysqli_select_db($koneksi, $mydb)
  or die("Could not select jadwalmk");
//*/
  
?>
