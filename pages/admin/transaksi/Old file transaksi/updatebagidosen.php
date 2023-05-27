<?php
include('../../../koneksi.php');

$NIP = $_POST['nip'];
$KODETHN = $_POST['kodethnajaran'];
$KODESEM = $_POST['kodesemester'];
$KODEMATKUL = $_POST['kodematkul'];


$SQL = mysql_query("update detailajar set nip='$NIP', kodethnajaran='$KODETHN',kodesemester='$KODESEM',kodematkul='$KODEMATKUL' WHERE kodethnajaran='$KODETHN' and nip='$NIP' and kodesemester='$KODESEM' and kodematkul='$KODEMATKUL'") or die (mysql_error());
if ($SQL) {
	header('location:insertview_bagidosen.php');
}

?>