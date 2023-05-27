<?php
include('../../../koneksi.php');

$NIP = $_GET['NIP'];
$SQL = mysqli_query($koneksi,"DELETE FROM PEGAWAI WHERE NIP='$NIP'") or die (mysql_error());
if ($SQL) {
    header('location:insertview_pegawai.php');
}
?>