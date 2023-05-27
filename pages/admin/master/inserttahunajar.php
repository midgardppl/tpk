<?php
include('../../../koneksi.php');

$KODETHN = $_POST['kodethnajaran'];
$NAMATHN = $_POST['tahunajaran'];

$SQL = mysqli_query($koneksi,"insert into tahunajaran values('$KODETHN','$NAMATHN')") or die (mysqli_error($koneksi));
if($SQL){
	header('location:insertview_tahunajar.php');
}
?>

