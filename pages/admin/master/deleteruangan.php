<?php
include('../../../koneksi.php');

$KODERNG = $_GET['koderuangan'];
$SQL = mysqli_query($koneksi,"DELETE FROM RUANGAN WHERE koderuang='$KODERNG'") or die (mysql_error());
if ($SQL) {
    header('location:insertview_ruangan.php');
}
?>