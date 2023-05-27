<?php
include('../../../koneksi.php');

$k=$_REQUEST['k'];
$x=$_REQUEST['x'];

if($k=="a"){
$r = $_POST['r'];
$h = $_POST['h'];
$j1 = $_POST['j1'];
$j2 = $_POST['j2'];
$p = $_POST['p'];
$k = $_POST['kl'];

$ck=mysql_num_rows(mysql_query("select * from detailjadwal where koderuang='$r' and kodehari='$h' and kodejam='$j1' and kodejam2='$j2'"));
if($ck==0){
	mysql_query("insert into detailjadwal values(date_format(now(),'%Y%m%d%h%i%s'),'$r','$x','$j1','$h','$p','$k','$j2')") or die (mysql_error());
	header('location:det-jadwal.php?kd='.$x.'');
} else {
		echo '<script type="text/javascript">'; 
		echo 'alert("Jadwal Sudah Tersedia");'; 
		echo 'window.location.href = "det-jadwal.php?kd='.$x.'";';
		echo '</script>';
		}
} else {
		$kd=$_REQUEST['kd'];
		mysql_query("delete from detailjadwal where iddetail='".$kd."'") or die (mysql_error());
		header('location:det-jadwal.php?kd='.$x.'');
		}
?>