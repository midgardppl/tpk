<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Pembagian Dosen
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form method="post" action="insertpegawai.php" style="font-size:16px">
<div class="form-group">
<label>NIP</label>
<input class="form-control" type="text" name="nip" placeholder="masukkan nomor induk pegawai" maxlength="12" autofocus required/><br>
</div>
<div class="form-group">
<label>Nama Mata Kuliah</label>
<input class="form-control" type="text" name="namamatkul" placeholder="masukkan nama mata kuliah" required/><br>
</div>
<div class="form-group">
<label>FAKULTAS</label>
<select class="form-control" name="kodefakultas" required>
     <option value="-" selected="selected">-- Pilih --</option>
        <?php
        $queryfakultas = mysql_query("select kodefakultas, namafakultas from fakultas group by kodefakultas") or die (mysql_error());
        //$satuan = $queryjabatan['namajabatan'];
        while($barisfakultas = mysql_fetch_array($queryfakultas)){
            echo "<option value='".$barisfakultas['kodefakultas']."'>".$barisfakultas['namafakultas']."</option>";
        }
        ?>
</select><br>
</div>
<div class="form-group">
<label>JABATAN</label>
<select class="form-control" name="kodejabatan" required>
     <option value="-" selected="selected">-- Pilih --</option>
        <?php
        $queryjabatan = mysql_query("select kodejabatan, namajabatan from jabatan group by kodejabatan") or die (mysql_error());
        //$satuan = $queryjabatan['namajabatan'];
        while($barisjabatan = mysql_fetch_array($queryjabatan)){
            echo "<option value='".$barisjabatan['kodejabatan']."'>".$barisjabatan['namajabatan']."</option>";
        }
        ?>
</select><br>
</div>
<div class="form-group">
<label>ALAMAT</label>
<textarea class="form-control" placeholder="masukkan alamat pegawai" name="alamatpegawai" maxlength="50" required></textarea><br>
</div>
<div class="form-group">
<label>TANGGAL LAHIR</label>
<input class="form-control" type="date" name="tanggallahir" placeholder="yyyy-mm-dd" required/><br>
</div>
<div class="form-group">
<label>TELEPON</label>
<input class="form-control" type="text" name="tlppegawai" placeholder="masukkan telepon pegawai" maxlength="15" required=""/><br>
</div>
<div class="form-group">
<label>JENIS KELAMIN</label>
<select class="form-control" name="JK" required>
	<option selected="selected">-- pilih --</option>
	<option value="Laki Laki">Laki Laki</option>
    <option value="Perempuan">Perempuan</option>
</select><br>
</div>
<div class="form-group">
<label>AGAMA</label>
<select class="form-control" name="agama" required>
	<option selected="selected">-- pilih --</option>
	<option value="islam">islam</option>
    <option value="kristen">kristen</option>
    <option value="katolik">katolik</option>
    <option value="hindu">hindu</option>
    <option value="buddha">buddha</option>
</select><br>
</div>
<div class="form-group">
<label>PASSWORD</label>
<input class="form-control" type="password"  maxlength="12" placeholder="masukkan password" name="pswd" /> <br>
</div>
<button type="submit">Simpan</button>
<button type="reset">Reset</button>
</form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->

                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Data Pegawai
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <?php
echo "<table width='100%' class='table table-striped table-bordered table-hover' id='dataTables-example'>";
echo "<thead>";
echo "<tr>";
	echo "<th style='width:60px'>No. </th>";
    echo "<th style='width:60px'>NIP. </th>";
    echo "<th>Nama Pegawai</th>";
    echo "<th style='width:450px'>Alamat Pegawai</th>";
    echo "<th style='width:100px'>No. Telepon</th>";
    echo "<th>Jabatan</th>";
	echo "<th style='width:100px'>Fakultas</th>";
    echo "<th>Aksi</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";
$sql = mysql_query("SELECT PEGAWAI.NIP, PEGAWAI.NAMAPEGAWAI, PEGAWAI.ALAMATPEGAWAI, PEGAWAI.TELPPEGAWAI, JABATAN.NAMAJABATAN, FAKULTAS.NAMAFAKULTAS
FROM PEGAWAI INNER JOIN JABATAN INNER JOIN FAKULTAS
ON PEGAWAI.KODEJABATAN=JABATAN.KODEJABATAN AND PEGAWAI.KODEFAKULTAS=FAKULTAS.KODEFAKULTAS
") or die (mysql_error());
mysql_select_db($nama_db, $koneksi) or die("Gagal memilih database!");
$no = 0;
while ($row = mysql_fetch_array($sql)){
    $no = $no+1;
?>
    <tr>
        <td> <?php echo $no."."; ?> </td>
        <td><?php echo $row['NIP']; ?> </td>
        <td><?php echo $row['NAMAPEGAWAI'];?></td>
        <td><?php echo $row['ALAMATPEGAWAI'];?></td>
        <td><?php echo $row['TELPPEGAWAI'];?></td>
        <td><?php echo $row['NAMAJABATAN'];?></td>
        <td><?php echo $row['NAMAFAKULTAS'];?></td>
        <td><a href="editpegawai.php?NIP=<?php echo $row['NIP']; ?>"><button> Ubah</button></a>
            <a href="deletepegawai.php?NIP=<?php echo $row['NIP']; ?>"><button> Hapus</button></a>
        </td>
    </tr>
<?php
}
echo "</tbody>";
echo "</table>";
?>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>