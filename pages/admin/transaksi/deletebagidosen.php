<?php
include('../../../koneksi.php');

$NIP	 	= $_GET['nip'];
$KODEMATKUL = $_GET['kodematkul'];

$SQL = mysql_query("DELETE FROM DETAILAJAR WHERE kodematkul='$KODEMATKUL' AND nip='$NIP'") or die (mysql_error());
if ($SQL) {
    header('location:insertview_bagidosen.php');
}
?>