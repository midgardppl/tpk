<?php
include('../../../koneksi.php');
$k=$_REQUEST['k'];
$kd=$_REQUEST['kd'];
if($k=="a"){
mysql_query("update penjadwalan set status='AKTIF' where kodejadwal='".$kd."'") or die (mysql_error());
header('location:insertview_jadwal.php');

} else {
mysql_query("update penjadwalan set status='NONAKTIF' where kodejadwal='".$kd."'") or die (mysql_error());
header('location:insertview_jadwal.php');

}
?>

