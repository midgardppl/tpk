<?php
include('../../../koneksi.php');

$KODETHNAJARAN 	= $_GET['kodethnajaran'];
$KODEMATKUL     = $_GET['kodematkul'];
$KODESEMESTER   = $_GET['kodesemester'];
$SQL = mysql_query("DELETE FROM TAWARANMATKUL WHERE kodematkul='$KODEMATKUL' AND kodethnajaran='$KODETHNAJARAN' AND kodesemester='$KODESEMESTER'") or die (mysql_error());
if ($SQL) {
    header('location:insertview_trans_matkul.php');
}
?>