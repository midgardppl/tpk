<?php
session_start();
include('../../../koneksi.php');
if (!isset($_SESSION['username']) || empty($_SESSION['username']) || !isset($_SESSION['jabatan']) || empty($_SESSION['jabatan']) || $_SESSION['jabatan']!="jab001"){
echo "<META http-equiv='refresh' content='0;URL=../../../logout.php'>";
        }
echo "<META http-equiv='refresh' content='1800;URL=../../../logout.php'>";
$nama = $_SESSION['namapegawai'];
$jabatan = $_SESSION['jabatan'];
$sql=mysql_query("select namajabatan from jabatan where kodejabatan='$jabatan'");
$row=mysql_fetch_array($sql);
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
                   <h1 class="page-header">DATA PEMBAGIAN KELAS</h1>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Pembagian Kelas
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form method="post" action="insertkelas.php" style="font-size:16px">

<div class="form-group">
<label>NAMA Ruang Ujian 1</label>
<select class="form-control" name="ruang1" id="ruang" onchange="getRuang();" required>
     <option value="null" selected="selected">-- Pilih --</option>
                <?php				
		$q5 = mysql_query("SELECT DISTINCT * FROM ruangan WHERE `KODERUANG` NOT IN (SELECT `KODERUANG1` FROM `ruangujian` WHERE `KODERUANG1`<>'-' UNION SELECT `KODERUANG2` FROM `ruangujian` WHERE `KODERUANG2`<>'-')") or die (mysql_error());		
        //$q5 = mysql_query("select * from ruangan") or die (mysql_error());
        while($b5 = mysql_fetch_array($q5)){
            echo "<option value='".$b5[0]."'>".$b5[3]."</option>";
        }
                ?>

</select><br>
</div>

<div class="form-group">
<label>NAMA Ruang Ujian 2 </label><div class="dtl" >Pilih Ruang 1 terlebih dahulu</div>
</div>
									
<div class="form-group">
<label>Program studi</label>
<select class="form-control" name="kodeprodi" required>
     <option value="-" selected="selected">-- Pilih --</option>
        <?php
        $queryprodi = mysql_query("select kodeprodi, namaprodi from prodi") or die (mysql_error());
        //$satuan = $queryjabatan['namajabatan'];
        while($barisprodi = mysql_fetch_array($queryprodi)){
            echo "<option value='".$barisprodi['kodeprodi']."'>".$barisprodi['namaprodi']."</option>";
        }
        ?>
</select><br>
</div>
<div class="form-group">
<label>Kelas </label>
<select class="form-control" name="kodekelas" required>
     <option value="-" selected="selected">-- Pilih --</option>
        <?php
        $querykelas = mysql_query("select kodekelas, namakelas from kelas") or die (mysql_error());
        //$satuan = $queryjabatan['namajabatan'];
        while($bariskelas = mysql_fetch_array($querykelas)){
            echo "<option value='".$bariskelas['kodekelas']."'>".$bariskelas['namakelas']."</option>";
        }
        ?>
</select><br>
</div>
<div class="form-group">
<label>Tahun Ajaran</label>
<select class="form-control" name="kodethnajaran" required>
     <option value="-" selected="selected">-- Pilih --</option>
        <?php
        $querytahun = mysql_query("select distinct kodethnajaran, tahunajaran from tahunajaran order by tahunajaran desc") or die (mysql_error());
        //$satuan = $queryjabatan['namajabatan'];
        while($baristahun = mysql_fetch_array($querytahun)){
            echo "<option value='".$baristahun['kodethnajaran']."'>".$baristahun['tahunajaran']."</option>";
        }
        ?>
</select><br>
</div>
<div class="form-group">
<label>Semester</label>
<select class="form-control" name="kodesemester" required>
     <option value="-" selected="selected">-- Pilih --</option>
        <?php
        //$querysemester = mysql_query("select distinct detailajar.kodesemester, semester.namasemester from semester inner join detailajar on detailajar.kodesemester=semester.kodesemester") or die (mysql_error());
        //$satuan = $queryjabatan['namajabatan'];
	   $querysemester = mysql_query("select * from semester") or die (mysql_error());       
	   while($barissemester = mysql_fetch_array($querysemester)){
            echo "<option value='".$barissemester[0]."'>".$barissemester['namasemester']."</option>";
        }
        ?>
</select><br>
</div>
<div class="form-group">
<label>Mata Kuliah</label>
<select class="form-control" name="kodematkul" required>
     <option value="-" selected="selected">-- Pilih --</option>
        <?php
        $queryajar = mysql_query("SELECT detailajar.nip, pegawai.namapegawai,detailajar.kodematkul,matakuliah.namamatkul,
        detailajar.`KODETHNAJARAN`,tahunajaran.`TAHUNAJARAN`,detailajar.`KODESEMESTER`,semester.`NAMASEMESTER`
        FROM detailajar INNER JOIN matakuliah INNER JOIN pegawai INNER JOIN tahunajaran INNER JOIN semester
        ON pegawai.`NIP` =detailajar.`NIP` AND matakuliah.`KODEMATKUL`=detailajar.`KODEMATKUL` AND
        tahunajaran.`KODETHNAJARAN`=detailajar.`KODETHNAJARAN` AND semester.`KODESEMESTER`=detailajar.`KODESEMESTER` group by detailajar.kodematkul") or die (mysql_error());

        //$satuan = $queryjabatan['namajabatan'];
        while($barisajar = mysql_fetch_array($queryajar)){
            echo "<option value='".$barisajar['kodematkul']."'>".$barisajar['namamatkul']."</option>";
        }
        ?>
</select><br>
</div>
<div class="form-group">
<label>Dosen</label>
<select class="form-control" name="nip" required>
     <option value="-" selected="selected">-- Pilih --</option>
        <?php
        $queryajar = mysql_query("SELECT detailajar.nip, pegawai.namapegawai,detailajar.kodematkul,matakuliah.namamatkul,
        detailajar.`KODETHNAJARAN`,tahunajaran.`TAHUNAJARAN`,detailajar.`KODESEMESTER`,semester.`NAMASEMESTER`
        FROM detailajar INNER JOIN matakuliah INNER JOIN pegawai INNER JOIN tahunajaran INNER JOIN semester
        ON pegawai.`NIP` =detailajar.`NIP` AND matakuliah.`KODEMATKUL`=detailajar.`KODEMATKUL` AND
        tahunajaran.`KODETHNAJARAN`=detailajar.`KODETHNAJARAN` AND semester.`KODESEMESTER`=detailajar.`KODESEMESTER` group by detailajar.nip") or die (mysql_error());
        //$satuan = $queryjabatan['namajabatan'];
        while($barisajar = mysql_fetch_array($queryajar)){
            echo "<option value='".$barisajar['nip']."'>".$barisajar['namapegawai']."</option>";
        }
        ?>
</select><br>
</div>
<div class="form-group">
<label>Jumlah Mahasiswa</label>
<input class="form-control" type="number" name="jumlahmahasiswa" placeholder="masukkan telepon pegawai" maxlength="15" required=""/><br>
</div>
<div class="form-group">
<label>Angkatan</label>
<input class="form-control" type="number" name="tahunangkatan" required>
<br>
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
                            Data Fakultas
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <?php
echo "<table width='100%' class='table table-striped table-bordered table-hover' id='dataTables-example'>";
echo "<thead>";
echo "<tr>";
	echo "<th style='width:60px'>No. </th>";
    echo "<th>Prodi </th>";
    echo "<th style='width:60px'>Kelas</th>";
    echo "<th style='width:100px'>Tahun Ajaran</th>";
    echo "<th style='width:100px'>Semester</th>";
    echo "<th>Mata Kuliah</th>";
	echo "<th>Dosen</th>";
    echo "<th>Jumlah mahasiswa</th>";
    echo "<th>Angkatan</th>";
    echo "<th>Aksi</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";
$sql = mysql_query("SELECT DETAILKELAS.NIP, PEGAWAI.NAMAPEGAWAI,DETAILKELAS.KODEMATKUL,MATAKULIAH.NAMAMATKUL,
        DETAILKELAS.`KODETHNAJARAN`,TAHUNAJARAN.`TAHUNAJARAN`,DETAILKELAS.`KODESEMESTER`,SEMESTER.`NAMASEMESTER`,
        DETAILKELAS.KODEPRODI,PRODI.NAMAPRODI,DETAILKELAS.KODEKELAS,KELAS.NAMAKELAS,DETAILKELAS.JUMLAHMAHASISWA,DETAILKELAS.TAHUNANGKATAN
        FROM DETAILKELAS INNER JOIN MATAKULIAH INNER JOIN PEGAWAI INNER JOIN TAHUNAJARAN INNER JOIN SEMESTER
        INNER JOIN DETAILAJAR INNER JOIN PRODI INNER JOIN KELAS
        ON DETAILKELAS.`NIP`=DETAILAJAR.`NIP` AND PEGAWAI.`NIP` =DETAILAJAR.`NIP` AND MATAKULIAH.`KODEMATKUL`=DETAILAJAR.`KODEMATKUL` AND
        DETAILAJAR.`KODEMATKUL`=DETAILKELAS.`KODEMATKUL` AND
        TAHUNAJARAN.`KODETHNAJARAN`=DETAILKELAS.`KODETHNAJARAN` AND
        SEMESTER.`KODESEMESTER`=DETAILKELAS.`KODESEMESTER` AND
        PRODI.KODEPRODI=DETAILKELAS.KODEPRODI AND KELAS.KODEKELAS=DETAILKELAS.KODEKELAS
        ORDER BY DETAILKELAS.KODEMATKUL
") or die (mysql_error());
mysql_select_db($nama_db, $koneksi) or die("Gagal memilih database!");
$no = 0;
while ($row = mysql_fetch_array($sql)){
    $no = $no+1;
?>
    <tr>
        <td> <?php echo $no."."; ?> </td>
        <td><?php echo $row['NAMAPRODI']; ?> </td>
        <td><?php echo $row['NAMAKELAS'];?></td>
        <td><?php echo $row['TAHUNAJARAN'];?></td>
        <td><?php echo $row['NAMASEMESTER'];?></td>
        <td><?php echo $row['NAMAMATKUL'];?></td>
        <td><?php echo $row['NAMAPEGAWAI'];?></td>
        <td><?php echo $row['JUMLAHMAHASISWA'];?></td>
        <td><?php echo $row['TAHUNANGKATAN'];?></td>
        <td><a href="edittranskelas.php?NIP=<?php echo $row['NIP']; ?>"><button> Ubah</button></a>
            <a href="deletetranskelas.php?NIP=<?php echo $row['NIP']; ?>"><button> Hapus</button></a>
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

    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>

</body>

</html>
