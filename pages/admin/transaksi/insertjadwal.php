<?php
session_start();

include('../../../koneksi.php');

date_default_timezone_set("Asia/Jakarta");
$tgl = date("Y-m-d h:i:sa");
//echo "Today is " . $tgl . "<br>";
//$bulan = year(now()); date_format(now(),'%Y%m%d%h%i%s')
//$tgl = year(now());

$NIP = $_SESSION['username'];
$KODEJADWAL = $_POST['kodejadwal'];
$KODEFAK = $_POST['p'];
$KODEPRODI = $_POST['prodi'];
$KODETHNAJARAN = $_POST['kodethnajaran'];
$KODESEMESTER = $_POST['kodesemester'];
$KODEMASAUJIAN = $_POST['kodemasaujian'];

$SQL = mysql_query("insert into penjadwalan values('$KODEJADWAL','$tgl','$NIP','$KODEFAK','$KODEPRODI','$KODESEMESTER','$KODETHNAJARAN','$KODEMASAUJIAN','MENUNGGU')") or die (mysql_error());
if($SQL){
	header('location:insertview_jadwal.php');
}
?>

