<?php
session_start();
include('../koneksi.php');

//tangkap data dari form login
$username = $_POST['nip'];
$password = $_POST['password'];

//echo "user : ".$username." dan pass : ".$password."</br>";
//echo "db: " . $nama_db;
//echo "</br>";
//echo "uname : ".mysqli_real_escape_string($nama_db, $username)."</br>";
//untuk mencegah sql injection
//kita gunakan mysqli_real_escape_string
$username = mysqli_real_escape_string($koneksi, $username);
$password = mysqli_real_escape_string($koneksi, $password);


//cek data yang dikirim, apakah kosong atau tidak
if (empty($username) && empty($password)) {
	//kalau username dan password kosong
	header('location:login.php?error=1');
	//break;
} else if (empty($username)) {
	//kalau username saja yang kosong
	header('location:login.php?error=2');
	//break;
} else if (empty($password)) {
	//kalau password saja yang kosong
	header('location:login.php?error=3');
	//break;
}
//echo "user : ".$username." dan pass : ".$password."</br>";

//$login = mysqli_query($koneksi, "select * from pegawai where nip='$username' and password=MD5('$password')");
$login = mysqli_query($koneksi, "select * from pegawai where nip='$username' and password='$password'");
if (mysqli_num_rows($login) == 1) {
while ($row=mysqli_fetch_array($login)){
    switch ($row[2]) {
        case "jab001":
        $_SESSION['username'] = $row[0];
        $_SESSION['jabatan'] = $row[2];
        $_SESSION['namapegawai'] = $row[3];
        echo "<META http-equiv='refresh' content='0;URL=admin/index.php'>";
        break;
        case "jab002":
        $_SESSION['username'] = $row[0];
        $_SESSION['jabatan'] = $row[2];
        $_SESSION['namapegawai'] = $row[3];
        echo "<META http-equiv='refresh' content='0;URL=dosen/index.php'>";
        break;
        case "jab003":
        $_SESSION['username'] = $row[0];
        $_SESSION['jabatan'] = $row[2];
        $_SESSION['namapegawai'] = $row[3];
        echo "<META http-equiv='refresh' content='0;URL=dekan/index.php'>";
        break;
		case "jab004":
        $_SESSION['username'] = $row[0];
        $_SESSION['jabatan'] = $row[2];
        $_SESSION['namapegawai'] = $row[3];
        echo "<META http-equiv='refresh' content='0;URL=kps/index.php'>";
        break;
        default:
        echo "<META http-equiv='refresh' content='0;URL=login.php'>";
        }
    }
}
else{
	//kalau username ataupun password tidak terdaftar di database
	header('location:login.php?error=4');
}
?>