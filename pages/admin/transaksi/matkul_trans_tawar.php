<?php
include('../../../koneksi.php');

$KODENYA = $_GET['kd'];
$KODES = $_GET['kdtawar'];
if($KODES==1) $nil=0; else $nil=1;

$SQL = mysqli_query($koneksi,"UPDATE MATAKULIAH SET `STATUSTAWAR` = '$nil' WHERE KODEMATKUL='$KODENYA'") or die (mysql_error());

if ($SQL) {
    header('location:matkul_trans_insertview.php');
}

?>