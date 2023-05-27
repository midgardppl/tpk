<?php
include('../../../koneksi.php');

//$NAMAMATKUL = $_POST['namamatkul'];
//$KODEMATKUL = $_POST['kodematkuls'];
//$SKS = $_POST['sks'];
//$THNKURI = $_POST['thnkuri'];
//$KODESEM = $_POST['kodesemester'];
//$STATUS = $_POST['statusaktif'];
$c2=mysqli_fetch_array(mysqli_query($koneksi,"select TAHUNKURIKULUM from matakuliah order by TAHUNKURIKULUM desc limit 1"));
$THN = $c2[0];

$SQL = mysqli_query($koneksi,"UPDATE `matakuliah` SET `STATUSAKTIF` = 'Aktif', `STATUSTAWAR` = 1 WHERE `TAHUNKURIKULUM` = '$THN'") or die (mysql_error());
//$SQL = mysql_query("update matakuliah set statusaktif='$STATUS',namamatkul='$NAMAMATKUL', kodematkul='$KODEMATKUL',sks='$SKS',tahunkurikulum='$THNKURI',kodesemester='$KODESEM' WHERE kodematkul='$KODEMATKUL'") or die (mysql_error());
if ($SQL) {
	header('location:matkul_trans_insertview.php');
}

?>