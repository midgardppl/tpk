<?php
include('../../../koneksi.php');

$KODEKLS = $_GET['kodekelas'];
$SQL = mysqli_query($koneksi,"DELETE FROM KELAS WHERE kodekelas='$KODEKLS'") or die (mysql_error());
if ($SQL) {
    header('location:insertview_kelas.php');
}
?>