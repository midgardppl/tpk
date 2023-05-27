<?php
session_start();
include('../../../koneksi.php');
if (!isset($_SESSION['username']) || empty($_SESSION['username']) || !isset($_SESSION['jabatan']) || empty($_SESSION['jabatan']) || $_SESSION['jabatan']!="jab001"){
echo "<META http-equiv='refresh' content='0;URL=../../../logout.php'>";
        }
echo "<META http-equiv='refresh' content='1800;URL=../../../logout.php'>";
$nama = $_SESSION['namapegawai'];
$jabatan = $_SESSION['jabatan'];
$sql=mysqli_query($koneksi,"select namajabatan from jabatan where kodejabatan='$jabatan'");
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

                <div class="col-lg-12">
                    <h1 class="page-header">UBAH DATA PEGAWAI</h1>
                </div>
                <div class="row col-lg-6">
                <?php

$sql = mysqli_query($koneksi,"SELECT PEGAWAI.NIP, PEGAWAI.NAMAPEGAWAI, PEGAWAI.ALAMATPEGAWAI, PEGAWAI.TELPPEGAWAI,PEGAWAI.TANGGALLAHIR,PEGAWAI.AGAMA,PEGAWAI.PASSWORD,JABATAN.NAMAJABATAN,JABATAN.KODEJABATAN, FAKULTAS.NAMAFAKULTAS ,FAKULTAS.KODEFAKULTAS
FROM PEGAWAI INNER JOIN JABATAN INNER JOIN FAKULTAS
ON PEGAWAI.KODEJABATAN=JABATAN.KODEJABATAN AND PEGAWAI.KODEFAKULTAS=FAKULTAS.KODEFAKULTAS WHERE PEGAWAI.NIP='$_GET[NIP]'
") or die (mysqli_error());
mysqli_select_db($koneksi, $nama_db) or die("Gagal memilih database!");
$row=mysqli_fetch_array($sql);
?>
<form method="post" action="updatepegawai.php">
<div class="form-group">
<label>NIP</label>
<input class="form-control" type="text" name="nip" value="<?php echo $row['NIP']; ?>" disabled/><br>
<input type="hidden" name="nips" value="<?php echo $row['NIP']; ?>">
</div>
<div class="form-group">
<label>Nama</label>
<input class="form-control" type="text" name="namapegawai" value="<?php echo $row['NAMAPEGAWAI']; ?>" required/><br>
</div>
<div class="form-group">
<label>Fakultas</label>
<select class="form-control" name="fakultas" required>
     <option value="<?php echo $row['KODEFAKULTAS']; ?>" selected="selected">--<?php echo $row['NAMAFAKULTAS']; ?>--</option>
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
<label>Jabatan</label>
<select class="form-control" name="jabatan" required>
     <option value="<?php echo $row['KODEJABATAN']; ?>" selected="selected">--<?php echo $row['NAMAJABATAN']; ?>--</option>
        <?php
        $queryfakultas = mysqli_query($koneksi,"select KODEJABATAN, NAMAJABATAN from JABATAN group by KODEJABATAN") or die (mysql_error());
        //$satuan = $queryjabatan['namajabatan'];
        while($barisfakultas = mysqli_fetch_array($queryfakultas)){
            echo "<option value='".$barisfakultas['KODEJABATAN']."'>".$barisfakultas['NAMAJABATAN']."</option>";
        }
        ?>
</select><br>
</div>
<div class="form-group">
<label>Alamat</label>
<textarea class="form-control" name="alamatpegawai" maxlength="50" required><?php echo $row['ALAMATPEGAWAI'];?></textarea><br>
</div>
<div class="form-group">
<label>Tanggal Lahir</label>
<input class="form-control" type="date" name="tanggallahir" value="<?php echo $row['TANGGALLAHIR'];?>" required/><br>
</div>
<div class="form-group">
<label>Telepon</label>
<input class="form-control" type="text" name="tlppegawai" value="<?php echo $row['TELPPEGAWAI'];?>" maxlength="15" required=""/><br>
</div>
<div class="form-group">
<label>Agama</label>
<select class="form-control" name="agama" required>
	<option value="<?php echo $row['AGAMA']; ?>" selected="selected">--<?php echo $row['AGAMA']; ?>--</option>
	<option value="islam">islam</option>
    <option value="kristen">kristen</option>
    <option value="katolik">katolik</option>
    <option value="hindu">hindu</option>
    <option value="buddha">buddha</option>
</select><br>
</div>
<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Perbarui </button>
<a href="insertview_pegawai.php"><button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Batal</button></a></td>
</form>
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

    <!-- Custom Theme JavaScript -->
    <script src="../../../dist/js/sb-admin-2.js"></script>

</body>

</html>
