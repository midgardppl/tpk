<?php
include('../../../koneksi.php');

//$c2=mysql_fetch_array(mysql_query("select TAHUNKURIKULUM from matakuliah order by TAHUNKURIKULUM desc limit 1"));
//$THN = $c2[0];

$SQL = mysqli_query($koneksi,"UPDATE `matakuliah` SET `STATUSAKTIF` = 'Tidak Aktif', `STATUSTAWAR` = 0 ") or die (mysql_error());
//$SQL = mysql_query("update matakuliah set statusaktif='$STATUS',namamatkul='$NAMAMATKUL', kodematkul='$KODEMATKUL',sks='$SKS',tahunkurikulum='$THNKURI',kodesemester='$KODESEM' WHERE kodematkul='$KODEMATKUL'") or die (mysql_error());
if ($SQL) {
	header('location:matkul_trans_insertview.php');
}

?>