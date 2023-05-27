<?php
include('../../../koneksi.php');

$NAMAMATKUL = $_POST['namamatkul'];
$KODEMATKUL = $_POST['kodematkul'];
$SKS = $_POST['sks'];
$THNKURI = $_POST['thnkuri'];
$KP = $_POST['kodekataup'];
$KODESEM = $_POST['kodesemester'];
$SEM = $_POST['semesterke'];
$STATUS = $_POST['statusaktif'];
$STATUSTAWAR = $_POST['statustawar'];


$SQL = mysql_query("update matakuliah set kodematkul='$KODEMATKUL',kodesemester='$KODESEM',
namamatkul='$NAMAMATKUL', kataup='$KP', sks='$SKS', semester='$SEM',
tahunkurikulum='$THNKURI', statusaktif='$STATUS',
statustawar = '$STATUSTAWAR' WHERE kodematkul='$KODEMATKUL'") or die (mysql_error());
if ($SQL) {
	header('location:matkul_trans_insertview.php');
}

?>