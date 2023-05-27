<?php
include('../../../koneksi.php');

$KODERNG = $_POST['koderuangan'];
$NAMARNG = $_POST['namaruangan'];
$KAPASITAS1 = $_POST['kapasitasruangan'];
$KAPASITAS2 = $_POST['kapasitasruangujian'];

$SQL = mysqli_query($koneksi,"insert into ruangan values('$KODERNG','$KAPASITAS1','$KAPASITAS1','$NAMARNG')") or die (mysqli_error($koneksi));
if($SQL){
	header('location:insertview_ruangan.php');
}
?>

