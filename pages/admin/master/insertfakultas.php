<?php
include('../../../koneksi.php');

$KODEFAK = $_POST['kodefakultas'];
$NAMAFAK = $_POST['namafakultas'];
$SELECTKODE = mysqli_query($koneksi,"select kodefakultas from fakultas where kodefakultas='$KODEFAK'");
$SELECTNAMA = mysql_query("select namafakultas from fakultas where namafakultas='$NAMAFAK'");
if(mysqli_num_rows($SELECTKODE)>0 || mysqli_num_rows($SELECTNAMA)>0){
        echo '<script language="javascript">alert("Fakultas Sudah Ada!")</script>';
        echo "<META http-equiv='refresh' content='0;URL=insertview_fakultas.php'>";
}else{
    $SQL = mysqli_query($koneksi,"insert into fakultas values('$KODEFAK','$NAMAFAK')") or die (mysqli_error($koneksi));
    if($SQL){
    echo '<script language="javascript">';
    echo 'alert("Sukses!")';
    echo '</script>';
    echo "<META http-equiv='refresh' content='0;URL=insertview_fakultas.php'>";
}
}
?>

