<?php
include('../../../koneksi.php');

$NIP = $_POST['nip'];
$KODEFAK = $_POST['kodefakultas'];
$KODEJAB = $_POST['kodejabatan'];
$NAMAPEG = $_POST['namapegawai'];
$ALAMATPEG = $_POST['alamatpegawai'];
$TTL = $_POST['tanggallahir'];
$TELPPEG = $_POST['tlppegawai'];
$JK = $_POST['JK'];
$AGAMA = $_POST['agama'];
$STAFF = "jab001";
$DEKAN = "jab003";
$DOSEN  = "jab002";
$KPS = "jab004";
$TTLconvert = date("Y-m-d", strtotime($TTL));
if($KODEJAB==$STAFF){
$PASSWORD = "staff" ;
    }else if($KODEJAB==$DOSEN){
        $PASSWORD = "dosen";
        }else if($KODEJAB==$DEKAN){
            $PASSWORD = "dekan";
            }else if($KODEJAB==$KPS){
                $PASSWORD = "kps";
                }else
                $PASSWORD = "pegawai";
$SQL = mysqli_query($koneksi, "insert into pegawai values('$NIP','$KODEFAK','$KODEJAB','$NAMAPEG','$ALAMATPEG','$TTLconvert','$TELPPEG','$JK','$AGAMA',md5('$PASSWORD'))") or die (mysqli_error($koneksi));
if($SQL){
	header('location:insertview_pegawai.php');
}
?>

