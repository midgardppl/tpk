<?php
include('../../../koneksi.php');

$NIP 		= $_POST['nips'];
$KODEFAK 	= $_POST['fakultas'];
$KODEJAB 	= $_POST['jabatan'];
$NAMAPEG 	= $_POST['namapegawai'];
$ALAMATPEG 	= $_POST['alamatpegawai'];
$TTL 		= $_POST['tanggallahir'];
$TELPPEG 	= $_POST['tlppegawai'];
$AGAMA 		= $_POST['agama'];

$TTLconvert = date("Y-m-d", strtotime($TTL));

$SQL = mysqli_query($koneksi,"update pegawai set nip = '$NIP', kodefakultas = '$KODEFAK', 
kodejabatan='$KODEJAB', namapegawai='$NAMAPEG', alamatpegawai='$ALAMATPEG', 
tanggallahir='$TTLconvert', telppegawai='$TELPPEG', 
agama='$AGAMA' WHERE nip= '$NIP' ") or die (mysql_error());
if ($SQL) {
	header('location:insertview_pegawai.php');
}

?>