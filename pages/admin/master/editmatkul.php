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
                    <h1 class="page-header">UBAH DATA MATKUL</h1>
                </div>
                <div class="row col-lg-6">
                <?php
$sql = mysqli_query($koneksi,"SELECT MATAKULIAH.KODEMATKUL,MATAKULIAH.NAMAMATKUL,MATAKULIAH.KATAUP,
MATAKULIAH.SKS,MATAKULIAH.TAHUNKURIKULUM,MATAKULIAH.KODESEMESTER,MATAKULIAH.SEMESTER,
SEMESTER.NAMASEMESTER,MATAKULIAH.STATUSAKTIF ,MATAKULIAH.STATUSTAWAR,MATAKULIAH.KODEPRODI,PRODI.NAMAPRODI  
FROM MATAKULIAH INNER JOIN SEMESTER INNER JOIN PRODI ON SEMESTER.KODESEMESTER=MATAKULIAH.KODESEMESTER 
AND MATAKULIAH.KODEPRODI=PRODI.KODEPRODI WHERE KODEMATKUL='$_GET[kodematkul]'") or die (mysqli_error());

mysqli_select_db($koneksi,$nama_db) or die("Gagal memilih database!");
$row=mysqli_fetch_array($sql);
?>
<form method="post" action="updatematkul.php" style="font-size:16px">
<div class="form-group">
<label>Kode Matkul</label>
<input class="form-control" type="text" name="kodematkul" placeholder="masukkan kode mata kuliah" value="<?php echo $row['KODEMATKUL']; ?>" maxlength="6" autofocus disabled/><br>
<input type="hidden" name="kodematkul" placeholder="masukkan kode mata kuliah" value="<?php echo $row['KODEMATKUL']; ?>" maxlength="6" autofocus/>
</div>
<div class="form-group">
<label>Nama Matkul</label>
<input class="form-control" type="text" name="namamatkul" placeholder="masukkan nama mata kuliah" value="<?php echo $row['NAMAMATKUL']; ?>" required/><br>
</div>
<div class="form-group">
<label>SKS</label>
<input class="form-control" type="number" name="sks" placeholder="masukkan jumlah SKS" value="<?php echo $row['SKS']; ?>" required/><br>
</div>

<div class="form-group">
<input type="hidden" name="semesterke" value="<?php echo $row['SEMESTER']; ?>"/>
<label>Semester</label>
<input class="form-control" type="number" name="semesterke" value="<?php echo $row['SEMESTER']; ?>" required/><br>
</div>

<div class="form-group">
<label>Kuliah atau Praktikum</label>
<select class="form-control dependant" name="kodekataup" id="" required>
	 <option value="<?php echo $row['KODEKATAUP']; ?>" selected="selected">-- <?php 
	 IF($row['KATAUP']=="k") echo "kuliah"; else echo "praktikum"; ?> --</option>
        <?php
        $querysem = array(array(0=>k,1=>kuliah),array(0=>p,1=>praktikum));        
		for($i=0;$i<count($querysem);$i++){	
            echo "<option value='".$querysem[$i][0]."'>".$querysem[$i][1]."</option>";
        }
        ?>
</select><br>
</div>

<div class="form-group">
<label>Tahun Kurikulum</label>
<input class="form-control" type="number" name="thnkuri" placeholder="masukkan tahun kurikulum" value="<?php echo $row['TAHUNKURIKULUM']; ?>" required/><br>
</div>
<div class="form-group">
<label>Semester  (Gasal-Genap)</label>
<select class="form-control" name="kodesemester" id="kodesemester" required>
     <option value="<?php echo $row['KODESEMESTER']; ?>" selected="selected">--<?php echo $row['NAMASEMESTER']; ?>--</option>
             <?php
        $querysemester = mysqli_query($koneksi,"select kodesemester,namasemester from semester") or die (mysqli_error());
        //$satuan = $queryjabatan['namajabatan'];
        while($barissemester = mysqli_fetch_array($querysemester)){
            echo "<option value='".$barissemester['kodesemester']."'>".$barissemester['namasemester']."</option>";
        }
        ?>

</select><br>
</div>
<div class="form-group">
<label>Status Aktif</label>
<select class="form-control" name="statusaktif" id="statusaktif" required>
     <option value="<?php echo $row['STATUSAKTIF']; ?>" selected="selected">--<?php echo $row['STATUSAKTIF']; ?>--</option>
     <option value="Aktif">Aktif</option>
     <option value="Tidak Aktif">Tidak Aktif</option>
</select><br>
</div>

<div class="form-group">
<label>Status Tawar</label>
<select class="form-control" name="statustawar" id="statustawar" required>
     <option value="<?php echo $row['STATUSTAWAR']; ?>" selected="selected">--<?php IF($row['STATUSTAWAR']==0) echo "Tidak Ditawarkan";	else echo "Ditawarkan"; ?>--</option>
     <?php
        $querysem = array(array(0=>1,1=>"Ditawarkan"),array(0=>0,1=>"Tidak Ditawarkan"));        
		for($i=0;$i<count($querysem);$i++){	
            echo "<option value='".$querysem[$i][0]."'>".$querysem[$i][1]."</option>";
        }
        ?>
</select><br>
</div>

<div class="form-group">
<label>Prodi</label>
<select class="form-control" name="kodeprodi" id="kodeprodi" required>
     <option value="<?php echo $row['KODEPRODI']; ?>" selected="selected">--<?php echo $row['NAMAPRODI']; ?>--</option>
             <?php
        $queryprodi = mysqli_query($koneksi,"select kodeprodi,namaprodi from prodi") or die (mysqli_error());
        //$satuan = $queryjabatan['namajabatan'];
        while($barisprodi = mysqli_fetch_array($queryprodi)){
            echo "<option value='".$barisprodi['kodeprodi']."'>".$barisprodi['namaprodi']."</option>";
        }
        ?>

</select><br>
</div>
<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Perbarui </button>
<a href="insertview_matkul.php"><button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Batal</button></a></td>
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
