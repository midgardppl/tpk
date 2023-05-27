<?php
include('../../../koneksi.php');
$t = $_GET['t'];
	echo '<select class="form-control" name="prodi" id="prodiku" required >
     <option value="null" selected="selected">-- Pilih --</option>';
 	
	$q6 = mysqli_query($koneksi, "SELECT * FROM prodi WHERE `KODEFAKULTAS`='".$t."' order by namaprodi") or die (mysqli_error($koneksi));
	while($b6 = mysqli_fetch_array($q6)){
		echo "<option value='".$b6[0]."'>".$b6[2]."</option>";
        }
	echo '</select><br>';
?>
