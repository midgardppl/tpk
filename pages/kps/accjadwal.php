<?php
include('../../koneksi.php');

$k = $_REQUEST['k'];

$SQL = mysql_query("update penjadwalan set status='DISETUJUI' where kodejadwal='".$k."'") or die (mysql_error());
if($SQL){
	header('location:view_jadwal.php');
}
?>

