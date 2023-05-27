<?php
include('../../../koneksi.php');

$KODEPROD = $_POST['kodeprodi'];
$NAMAPROD = $_POST['namaprodi'];
$KODEFAK  = $_POST['kodefakultas'];

$SQL = mysqli_query($koneksi,"insert into prodi values('$KODEPROD','$KODEFAK','$NAMAPROD')") or die (mysqli_error($koneksi));
if($SQL){
	header('location:insertview_prodi.php');
}
?>

