<?php
include('../../../koneksi.php');

$NAMAKLS = $_POST['namakelas'];
$KODEKLS = $_POST['kodekls'];

$SQL = mysqli_query($koneksi,"update kelas set namakelas='$NAMAKLS', kodekelas='$KODEKLS' WHERE kodekelas='$KODEKLS'") or die (mysql_error());
if ($SQL) {
	header('location:insertview_kelas.php');
}

?>