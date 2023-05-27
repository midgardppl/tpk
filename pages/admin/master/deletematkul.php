<?php
include('../../../koneksi.php');

$KODEMATKUL = $_GET['kodematkul'];
$SQL = mysqli_query($koneksi,"DELETE FROM MATAKULIAH WHERE kodematkul='$KODEMATKUL'") or die (mysql_error());
if ($SQL) {
    header('location:insertview_matkul.php');
}
?>