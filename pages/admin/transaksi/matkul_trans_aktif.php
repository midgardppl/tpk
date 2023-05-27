<?php
include('../../../koneksi.php');

$KODENYA = $_GET['kd'];
$KODES = $_GET['kdaktif'];
if($KODES=="Aktif") $nil="Tidak Aktif"; else $nil="Aktif";

$SQL = mysqli_query($koneksi,"UPDATE MATAKULIAH SET `STATUSAKTIF` = '$nil' WHERE KODEMATKUL='$KODENYA'") or die (mysql_error());

if ($SQL) {
    header('location:matkul_trans_insertview.php');
}

?>