<?php
session_start();
include('../../../koneksi.php');
if (!isset($_SESSION['username']) || empty($_SESSION['username']) || !isset($_SESSION['jabatan']) || empty($_SESSION['jabatan']) || $_SESSION['jabatan']!="jab001"){
echo "<META http-equiv='refresh' content='0;URL=../../../logout.php'>";
        }
echo "<META http-equiv='refresh' content='1800;URL=../../../logout.php'>";
$nama = $_SESSION['namapegawai'];
$jabatan = $_SESSION['jabatan'];
$sql=mysqli_query($koneksi, "select namajabatan from jabatan where kodejabatan='$jabatan'");
$row=mysqli_fetch_array($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Fakultas Vokasi Universitas Airlangga</title>
    <!-- Bootstrap Core CSS -->
    <link href="../../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../../../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="../../../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../../../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../../../vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->

        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../index.php">Fakultas Vokasi Universitas Airlangga</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">

                <!-- /.dropdown -->

                <!-- /.dropdown -->

                <!-- /.dropdown -->
                <li class="dropdown">
                    <li><a href="#"><i class="fa fa-user fa-fw"></i> <?php echo $row['namajabatan'];?></a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="../../../logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>

                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

<?php include("../sidebaradmin.php")?>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">DATA PEGAWAI</h1>
                </div>
                <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Masukkan Data Pegawai
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form method="post" action="insertpegawai.php" style="font-size:16px">
<div class="form-group">
<label>NIP</label>
<input class="form-control" type="number" name="nip" placeholder="masukkan nomor induk pegawai" maxlength="12" autofocus required/><br>
</div>
<div class="form-group">
<label>NAMA</label>
<input class="form-control" type="text" name="namapegawai" placeholder="masukkan nama pegawai" required/><br>
</div>
<div class="form-group">
<label>FAKULTAS</label>
<select class="form-control" name="kodefakultas" required>
     <option value="-" selected="selected">-- Pilih --</option>
        <?php
        $queryfakultas = mysqli_query($koneksi,"select kodefakultas, namafakultas from fakultas group by kodefakultas") or die (mysql_error());
        //$satuan = $queryjabatan['namajabatan'];
        while($barisfakultas = mysqli_fetch_array($queryfakultas)){
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
        $queryjabatan = mysqli_query($koneksi,"select kodejabatan, namajabatan from jabatan group by kodejabatan") or die (mysql_error());
        //$satuan = $queryjabatan['namajabatan'];
        while($barisjabatan = mysqli_fetch_array($queryjabatan)){
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
<input class="form-control" type="date" name="tanggallahir" placeholder="mm-dd-yyyy" required/><br>
</div>
<div class="form-group">
<label>TELEPON</label>
<input class="form-control" type="text" name="tlppegawai" placeholder="masukkan telepon pegawai" maxlength="13" required=""/><br>
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
$sql = mysqli_query($koneksi,"SELECT PEGAWAI.NIP, PEGAWAI.NAMAPEGAWAI, PEGAWAI.ALAMATPEGAWAI, PEGAWAI.TELPPEGAWAI, JABATAN.NAMAJABATAN, FAKULTAS.NAMAFAKULTAS
FROM PEGAWAI INNER JOIN JABATAN INNER JOIN FAKULTAS
ON PEGAWAI.KODEJABATAN=JABATAN.KODEJABATAN AND PEGAWAI.KODEFAKULTAS=FAKULTAS.KODEFAKULTAS
") or die (mysqli_error());
mysqli_select_db($koneksi, $nama_db) or die("Gagal memilih database!");
$no = 0;
while ($row = mysqli_fetch_array($sql)){
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
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <!-- /.row -->

            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../../../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../../../vendor/raphael/raphael.min.js"></script>
    <script src="../../../vendor/morrisjs/morris.min.js"></script>
    <script src="../../../data/morris-data.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../../../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../../../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../../../vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../../../dist/js/sb-admin-2.js"></script>
    <!-- InputMask -->
    <script src="../../../mask/input-mask/jquery.inputmask.js"></script>
    <script src="../../../mask/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="../../../mask/input-mask/jquery.inputmask.extensions.js"></script>

    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>

</body>

</html>
