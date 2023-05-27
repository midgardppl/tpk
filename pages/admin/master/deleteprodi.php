<?php
include('../../../koneksi.php');

$KODEPROD = $_GET['kodeprodi'];
$SQL = mysqli_query($koneksi,"DELETE FROM PRODI WHERE kodeprodi='$KODEPROD'") or die (mysql_error());
if ($SQL) {
    header('location:insertview_prodi.php');
}
?>