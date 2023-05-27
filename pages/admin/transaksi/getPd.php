<?php
include('../../../koneksi.php');
$t = $_GET['t'];
	echo '<select class="form-control" name="kl" id="kl" required >
     <option value="null" selected="selected">-- Pilih --</option>';
        $q6 = mysql_query("select * from kelas where kodekelas in (select kodekelas from detailkelas where kodeprodi='".$t."')") or die (mysql_error());
        while($b6 = mysql_fetch_array($q6)){
            echo "<option value='".$b6[0]."'>".$b6[1]."</option>";
        }
echo '</select><br>';

?>