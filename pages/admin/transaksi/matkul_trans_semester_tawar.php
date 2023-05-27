<?php
include('../../../koneksi.php');

$KODENYA = $_POST['kodesemester'];
//$KODES = $_GET['kdtawar'];
//if($KODES==1) $nil=0; else $nil=1;
$SQL_NOL = mysqli_query($koneksi,"UPDATE MATAKULIAH SET `STATUSTAWAR` = 0") or die (mysql_error());
$SQL = mysqli_query($koneksi,"UPDATE MATAKULIAH SET `STATUSTAWAR` = 1 WHERE kodesemester='$KODENYA'") or die (mysql_error());

if ($SQL) {
    header('location:matkul_trans_insertview.php');
}

?>