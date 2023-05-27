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

                <div class="col-lg-12">
                    <h1 class="page-header">UBAH DATA DETAILKELAS</h1>
                </div>
                <div class="row col-lg-6">
                <?php

//,JUMLAHMAHASISWA,TAHUNANGKATAN,kodefakultas				
				
$sql = mysqli_query($koneksi,"SELECT DETAILKELAS.NIP, PEGAWAI.NAMAPEGAWAI,DETAILKELAS.KODEMATKUL,DETAILKELAS.KDPECAH,MATAKULIAH.NAMAMATKUL,
        DETAILKELAS.`KODETHNAJARAN`,TAHUNAJARAN.`TAHUNAJARAN`,DETAILKELAS.`KODESEMESTER`,SEMESTER.`NAMASEMESTER`,
        DETAILKELAS.KODEPRODI,PRODI.NAMAPRODI,DETAILKELAS.KODEKELAS,KELAS.NAMAKELAS,DETAILKELAS.JUMLAHMAHASISWA,DETAILKELAS.TAHUNANGKATAN,DETAILKELAS.KODEFAKULTAS, FAKULTAS.NAMAFAKULTAS
        FROM DETAILKELAS INNER JOIN MATAKULIAH INNER JOIN PEGAWAI INNER JOIN TAHUNAJARAN INNER JOIN SEMESTER
        INNER JOIN DETAILAJAR INNER JOIN PRODI INNER JOIN KELAS INNER JOIN FAKULTAS
        ON DETAILKELAS.`NIP`=DETAILAJAR.`NIP` AND PEGAWAI.`NIP` =DETAILAJAR.`NIP` AND MATAKULIAH.`KODEMATKUL`=DETAILAJAR.`KODEMATKUL` AND
        DETAILAJAR.`KODEMATKUL`=DETAILKELAS.`KODEMATKUL` AND
        TAHUNAJARAN.`KODETHNAJARAN`=DETAILKELAS.`KODETHNAJARAN` AND
        SEMESTER.`KODESEMESTER`=DETAILKELAS.`KODESEMESTER` AND
        PRODI.KODEPRODI=DETAILKELAS.KODEPRODI AND KELAS.KODEKELAS=DETAILKELAS.KODEKELAS AND FAKULTAS.KODEFAKULTAS=DETAILKELAS.KODEFAKULTAS
		WHERE DETAILKELAS.KODEPRODI = '$_GET[KODEPRODI]' AND DETAILKELAS.KODEKELAS ='$_GET[KODEKELAS]' AND DETAILKELAS.kdpecah='$_GET[KDPECAH]' 
		AND DETAILKELAS.KODETHNAJARAN='$_GET[KODETHNAJARAN]' AND DETAILKELAS.KODEMATKUL='$_GET[KODEMATKUL]' 
		AND  DETAILKELAS.KODESEMESTER='$_GET[KODESEMESTER]' AND  DETAILKELAS.NIP='$_GET[NIP]'") or die (mysqli_error($koneksi));
mysqli_select_db($koneksi,$nama_db) or die("Gagal memilih database!");
$row=mysqli_fetch_array($sql);

?>
<form method="post" action="updatetranskelas.php" style="font-size:16px">

<div class="form-group">
<label>NAMA Fakultas</label>
<select class="form-control" name="kodefakultas" required>
	 <option value="<?php echo $row['KODEFAKULTAS']; ?>" selected="selected">--<?php echo $row['NAMAFAKULTAS']; ?>--</option>
                <?php				
		$q5 = mysqli_query($koneksi,"SELECT * FROM fakultas") or die (mysqli_error($koneksi));		
        //$q5 = mysqli_query("select * from ruangan") or die (mysqli_error());
        while($b5 = mysqli_fetch_array($q5)){
            echo "<option value='".$b5[0]."'>".$b5[1]."</option>";
        }
                ?>

</select><br>
</div>

<div class="form-group">
<label>NAMA Program studi </label>
<select class="form-control" name="kodeprodi" required>
	 <option value="<?php echo $row['KODEPRODI']; ?>" selected="selected">--<?php echo $row['NAMAPRODI']; ?>--</option>
                <?php				
		$q5 = mysqli_query($koneksi,"SELECT * FROM PRODI") or die (mysqli_error($koneksi));		
        //$q5 = mysqli_query("select * from ruangan") or die (mysqli_error());
        while($b5 = mysqli_fetch_array($q5)){
            echo "<option value='".$b5[0]."'>".$b5[1]."</option>";
        }
                ?>

</select><br>
</div>
									
<div class="form-group">
<input type="hidden" name="kodepecah" value="<?php echo $row['KDPECAH']; ?>"/>
<label>Kelas Paralel</label>
<input class="form-control" type="number" name="kodepecah" value="<?php echo $row['KDPECAH']; ?>" required/><br>
</div>


<div class="form-group">
<label>Nama Kelas</label>
<select class="form-control" name="kodekelas" required>
     <option value="<?php echo $row['KODEKELAS']; ?>" selected="selected">--<?php echo $row['NAMAKELAS']; ?>--</option>
        <?php
        $querykelas = mysqli_query($koneksi,"select kodekelas, namakelas from kelas") or die (mysqli_error($koneksi));
        //$satuan = $queryjabatan['namajabatan'];
        while($bariskelas = mysqli_fetch_array($querykelas)){
            echo "<option value='".$bariskelas['kodekelas']."'>".$bariskelas['namakelas']."</option>";
        }
        ?>
</select><br>
</div>

<div class="form-group">
<label>Tahun Ajaran</label>
<select class="form-control" name="kodethnajaran" required>
	 <option value="<?php echo $row['KODETHNAJARAN']; ?>" selected="selected">--<?php echo $row['TAHUNAJARAN']; ?>--</option>
        <?php
        $querytahun = mysqli_query($koneksi,"select distinct kodethnajaran, tahunajaran from tahunajaran order by tahunajaran desc limit 3") or die (mysqli_error($koneksi));
        //$satuan = $queryjabatan['namajabatan'];
        while($baristahun = mysqli_fetch_array($querytahun)){
            echo "<option value='".$baristahun['kodethnajaran']."'>".$baristahun['tahunajaran']."</option>";
        }
        ?>
</select><br>
</div>
<div class="form-group">
<label>Semester</label>
<select class="form-control" name="kodesemester" required>
     <option value="<?php echo $row['KODESEMESTER']; ?>" selected="selected">--<?php echo $row['NAMASEMESTER']; ?>--</option>
        <?php
        //$querysemester = mysqli_query("select distinct detailajar.kodesemester, semester.namasemester from semester inner join detailajar on detailajar.kodesemester=semester.kodesemester") or die (mysqli_error());
        //$satuan = $queryjabatan['namajabatan'];
	   $querysemester = mysqli_query($koneksi,"select * from semester") or die (mysqli_error($koneksi));       
	   while($barissemester = mysqli_fetch_array($querysemester)){
            echo "<option value='".$barissemester[0]."'>".$barissemester[1]."</option>";
        }
        ?>
</select><br>
</div>

<div class="form-group">
<label>Dosen</label>
<select class="form-control" name="nip" required>
     <option value="<?php echo $row['NIP']; ?>" selected="selected">--<?php echo $row['NAMAPEGAWAI']; ?>--</option>
        <?php
        $queryajar = mysqli_query($koneksi,"SELECT detailajar.nip, pegawai.namapegawai,detailajar.kodematkul,matakuliah.namamatkul,
        detailajar.`KODETHNAJARAN`,tahunajaran.`TAHUNAJARAN`,detailajar.`KODESEMESTER`,semester.`NAMASEMESTER`
        FROM detailajar INNER JOIN matakuliah INNER JOIN pegawai INNER JOIN tahunajaran INNER JOIN semester
        ON pegawai.`NIP` =detailajar.`NIP` AND matakuliah.`KODEMATKUL`=detailajar.`KODEMATKUL` AND
        tahunajaran.`KODETHNAJARAN`=detailajar.`KODETHNAJARAN` AND semester.`KODESEMESTER`=detailajar.`KODESEMESTER` group by detailajar.nip") or die (mysqli_error($koneksi));
        //$satuan = $queryjabatan['namajabatan'];
        while($barisajar = mysqli_fetch_array($queryajar)){
            echo "<option value='".$barisajar['nip']."'>".$barisajar['namapegawai']."</option>";
        }
        ?>
</select><br>
</div>

<div class="form-group">
<label>Mata Kuliah</label>
<select class="form-control" name="kodematkul" required>
	 <option value="<?php echo $row['KODEMATKUL']; ?>" selected="selected">--<?php echo $row['NAMAMATKUL']; ?>--</option>
        <?php
        $queryajar = mysqli_query($koneksi,"SELECT detailajar.nip, pegawai.namapegawai,detailajar.kodematkul,matakuliah.namamatkul,
        detailajar.`KODETHNAJARAN`,tahunajaran.`TAHUNAJARAN`,detailajar.`KODESEMESTER`,semester.`NAMASEMESTER`
        FROM detailajar INNER JOIN matakuliah INNER JOIN pegawai INNER JOIN tahunajaran INNER JOIN semester
        ON pegawai.`NIP` =detailajar.`NIP` AND matakuliah.`KODEMATKUL`=detailajar.`KODEMATKUL` AND
        tahunajaran.`KODETHNAJARAN`=detailajar.`KODETHNAJARAN` AND semester.`KODESEMESTER`=detailajar.`KODESEMESTER` group by detailajar.kodematkul") or die (mysqli_error($koneksi));

        //$satuan = $queryjabatan['namajabatan'];
        while($barisajar = mysqli_fetch_array($queryajar)){
            echo "<option value='".$barisajar['kodematkul']."'>".$barisajar['namamatkul']."</option>";
        }
        ?>
</select><br>
</div>

<div class="form-group">
<input type="hidden" name="jumlahmahasiswa" value="<?php echo $row['JUMLAHMAHASISWA']; ?>"/>
<label>Jumlah Mahasiswa</label>
<input class="form-control" type="number" name="jumlahmahasiswa" value="<?php echo $row['JUMLAHMAHASISWA']; ?>" required/><br>
</div>

<div class="form-group">
<input type="hidden" name="tahunangkatan" value="<?php echo $row['TAHUNANGKATAN']; ?>"/>
<label>Jumlah Mahasiswa</label>
<input class="form-control" type="number" name="tahunangkatan" value="<?php echo $row['TAHUNANGKATAN']; ?>" required/><br>
</div>

<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Perbarui </button>
<a href="insertview_trans_kelas.php"><button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Batal</button></a>
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
