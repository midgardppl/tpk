<?php
include('../../../koneksi.php');

//$NIP = $_POST['nip'];
//$KODETHN = $_POST['kodethnajaran'];
//$KODESEM = $_POST['kodesemester'];
//$KODEMATKUL = $_POST['kodematkul'];

$KODENIP = $_GET['nip'];
$KODEMK = $_GET['kodematkul'];
$KODESTATUS = $_GET['status'];
  
//$SQL = mysql_query("update detailajar set nip='$NIP', kodethnajaran='$KODETHN',kodesemester='$KODESEM',kodematkul='$KODEMATKUL' WHERE kodematkul='$KODEMATKUL'") or die (mysql_error());
IF($KODESTATUS == 0)
	$SQL = mysql_query("update detailajar set statusajar=1 WHERE nip='$KODENIP' AND kodematkul='$KODEMK'") or die (mysql_error());
ELSE 
	$SQL = mysql_query("update detailajar set statusajar=0 WHERE nip='$KODENIP' AND kodematkul='$KODEMK'") or die (mysql_error());
if ($SQL) {
	header('location:insertview_bagidosen.php');
}

?>