<?php
include('../../../koneksi.php');

$KODEMATKUL = $_GET['kodematkul'];
$SQL = mysql_query("DELETE FROM MATAKULIAH WHERE kodematkul='$KODEMATKUL'") or die (mysql_error());
if ($SQL) {
    header('location:matkul_trans_insertview.php');
}
?>