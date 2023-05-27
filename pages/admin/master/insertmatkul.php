<?php
include('../../../koneksi.php');

$KODEMATKUL = $_POST['kodematkul'];
$KODESEM = $_POST['kodesemester'];
$NAMAMATKUL = $_POST['namamatkul'];
$KODEKP = $_POST['kodekataup'];
$SKS = $_POST['sks'];
$SEMKE = $_POST['semesterke'];
$THNKURI = $_POST['thnkuri'];
$STATUSAK = $_POST['statusaktif'];
$STATUSTW = $_POST['statustawar'];
$KODEPROD = $_POST['kodeprodi'];

//$SELECTKODE = mysql_query("select kodematkul from matakuliah where kodematkul='$KODEMATKUL'");
//if(mysql_num_rows($SELECTKODE)>0){
//        echo '<script language="javascript">alert("Kode Mata Kuliah Sudah Ada!")</script>';
//        echo "<META http-equiv='refresh' content='0;URL=insertview_matkul.php'>";
//}else{
	
$SQL = mysqli_query($koneksi,"insert into matakuliah values('$KODEMATKUL','$KODESEM','$NAMAMATKUL','$KODEKP','$SKS','$SEMKE','$THNKURI','$STATUSAK','$STATUSTW','$KODEPROD')") or die (mysqli_error($koneksi));

if($SQL){
	
    echo "<META http-equiv='refresh' content='0;URL=insertview_matkul.php'>";
    }
?>

