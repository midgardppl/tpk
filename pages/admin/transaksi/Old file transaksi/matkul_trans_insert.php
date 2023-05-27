<?php
include('../../../koneksi.php');

$KODEMATKUL = $_POST['kodematkul'];
$NAMAMATKUL = $_POST['namamatkul'];
$SKS = $_POST['sks'];
$THNKURI = $_POST['thnkuri'];
$KODESEM = $_POST['kodesemester'];

$NAMAMATKUL = $_POST['namamatkul'];
$KODEMATKUL = $_POST['kodematkul'];
$SKS = $_POST['sks'];
$THNKURI = $_POST['thnkuri'];
$KODESEM = $_POST['kodesemester'];
$STATUS = $_POST['statusaktif'];
$STATUSTAWAR = $_POST['statustawar'];

$SELECTKODE = mysql_query("select kodematkul from matakuliah where kodematkul='$KODEMATKUL'");
if(mysql_num_rows($SELECTKODE)>0){
        echo '<script language="javascript">alert("Kode Mata Kuliah Sudah Ada!")</script>';
        echo "<META http-equiv='refresh' content='0;URL=matkul_trans_insertview.php'>";
}else{
$SQL = mysql_query("insert into matakuliah values('$KODEMATKUL','$NAMAMATKUL','$SKS','$THNKURI','$KODESEM','Aktif')") or die (mysql_error());
if($SQL){
	echo '<script language="javascript">';
    echo 'alert("Sukses!")';
    echo '</script>';
    echo "<META http-equiv='refresh' content='0;URL=matkul_trans_insertview.php'>";
    }
}
?>

