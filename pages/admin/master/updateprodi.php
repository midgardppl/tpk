<?php
include('../../../koneksi.php');

$KODEPROD = $_POST['kodeprodis'];
$NAMAPROD = $_POST['namaprodi'];
$KODEFAK  = $_POST['kodefakultas'];

$SQL = mysqli_query($koneksi,"update prodi set kodeprodi='$KODEPROD', namaprodi='$NAMAPROD' , kodefakultas='$KODEFAK' WHERE kodeprodi= '$KODEPROD' ") or die (mysql_error());
if ($SQL) {
	header('location:insertview_prodi.php');
}

?>