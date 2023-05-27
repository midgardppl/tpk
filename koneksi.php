<?php
$host = "localhost";
$uname = "root";
$pswd= "";
$nama_db = "db_jadwal_baru2";
$koneksi = mysqli_connect($host,$uname,$pswd,$nama_db); //or die ("Gagal terhubung ke server MySQL!");
//mysqli_select_db($koneksi, $nama_db) or die ("Gagal memilih database!");

if (!$koneksi) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
/*
echo "Success: A proper connection to MySQL was made! The my_db database is great." . PHP_EOL;
echo "</br>";
echo "Host information: " . mysqli_get_host_info($koneksi) . PHP_EOL;
echo "</br>";
echo "db: " . $nama_db;
echo "</br>";
*/

?>
