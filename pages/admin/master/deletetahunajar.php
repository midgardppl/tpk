<?php
include('../../../koneksi.php');

$KODETHN = $_GET['kodethnajaran'];
$SQL = mysqli_query($koneksi,"DELETE FROM TAHUNAJARAN WHERE kodethnajaran='$KODETHN'") or die (mysql_error());
if ($SQL) {
    header('location:insertview_tahunajar.php');
}
?>