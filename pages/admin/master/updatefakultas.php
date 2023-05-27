<?php
include('../../../koneksi.php');

$NAMAFAK = $_POST['namafakultas'];
$KODEFAK = $_POST['kodefak'];

$SQL = mysqli_query($koneksi,"update fakultas set namafakultas='$NAMAFAK', kodefakultas='$KODEFAK' WHERE kodefakultas='$KODEFAK'") or die (mysql_error());
if ($SQL) {
	header('location:insertview_fakultas.php');
}

?>