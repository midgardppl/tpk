<?php
include('../../../koneksi.php');

$KODEFAK = $_GET['kodefakultas'];
$SQL = mysqli_query($koneksi,"DELETE FROM FAKULTAS WHERE kodefakultas='$KODEFAK'") or die (mysql_error());
if ($SQL) {
    header('location:insertview_fakultas.php');
}
?>