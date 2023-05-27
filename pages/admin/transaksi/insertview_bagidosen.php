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
    <!-- Select2 -->
    <link rel="stylesheet" type="text/css" href="../../../vendor/select2-4.0.3/css/select2.min.css">

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
                    <h1 class="page-header">DATA PEMBAGIAN DOSEN</h1>
                </div>
                <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Masukkan Data Pembagian Dosen
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form method="post" action="insertbagidosen.php" style="font-size:16px">

	<div class="form-group">
<label>Tahun Ajaran </label>
<select class="form-control" name="kodethnajaran" required>
        <?php
        
		$querythn = mysqli_query($koneksi,"select * from tahunajaran order by tahunajaran desc") or die (mysql_error());		
        while($baristhn = mysqli_fetch_array($querythn)){
            echo "<option value='".$baristhn[0]."'>".$baristhn[1]."</option>";
        }
        ?>
</select><br>
</div>

<div class="form-group">
<label>Semester</label>
<select class="form-control" name="kodesemester" id="kodesemester" required>
        <?php
        
		$querysem = mysqli_query($koneksi,"select * from semester") or die (mysql_error());
		
        while($barissem = mysqli_fetch_array($querysem)){
            echo "<option value='".$barissem[0]."'>".$barissem[1]."</option>";
        }
        ?>

</select><br>
</div>

<div class="form-group">
<label>Mata Kuliah</label>
<select class="form-control dependant" name="kodematkul" id="kodematkul" required>
     <option value="-" selected="selected" class="null">-- Pilih --</option>
        <?php
        $querymat = mysqli_query($koneksi,"select kodematkul, namamatkul,tahunkurikulum,kodesemester from matakuliah where statusaktif='Aktif'") or die (mysql_error());
        //$satuan = $queryjabatan['namajabatan'];
        while($barismat = mysqli_fetch_array($querymat)){
            echo "<option value='".$barismat['kodematkul']."'class=".$barismat['kodesemester'].">".$barismat['namamatkul']."---".$barismat['tahunkurikulum']."</option>";
        }
        ?>
</select><br>
</div>



<div class="form-group">
<label>Dosen</label>
<select class="form-control"  style="100%" multiple name="nip[]" id=dosen required>
        <?php
        $querypeg = mysqli_query($koneksi,"select nip,namapegawai from pegawai where kodejabatan='jab002' group by nip") or die (mysql_error());
        //$satuan = $queryjabatan['namajabatan'];
        while($barispeg = mysqli_fetch_array($querypeg)){
            echo "<option value='".$barispeg['nip']."'>".$barispeg['namapegawai']."</option>";
        }
        ?>
</select><br>



</div>

<?php //$querymatkul = mysql_query("select tawaranmatkul.kodematkul,matakuliah.namamatkul,
//tawaranmatkul.kodethnajaran,tahunajaran.tahunajaran,tawaranmatkul.kodesemester,semester.namasemester from matakuliah
//inner join tahunajaran inner join semester inner join tawaranmatkul on tawaranmatkul.kodematkul=matakuliah.kodematkul and
//tawaranmatkul.kodethnajaran=tahunajaran.kodethnajaran and tawaranmatkul.kodesemester=semester.kodesemester
		//where tawaranmatkul.statustawaran='aktif'") or die (mysql_error());?>
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
                            Data Pembagian Dosen
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <?php
echo "<table width='100%' class='table table-striped table-bordered table-hover' id='dataTables-example'>";
echo "<thead>";
echo "<tr>";
	echo "<th style='width:60px'>No. </th>";
    echo "<th>Mata Kuliah</th>";
    echo "<th>Dosen. </th>";
    echo "<th style='width:70px'>Tahun Ajaran</th>";
    echo "<th style='width:70px'>Semester</th>";
	echo "<th style='width:70px'>Status Ajar</th>";
    echo "<th  style='width:150px'>Aksi</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";

$sql = mysqli_query($koneksi,"SELECT DETAILAJAR.NIP, PEGAWAI.NAMAPEGAWAI, DETAILAJAR.KODEMATKUL, "
."MATAKULIAH.NAMAMATKUL,DETAILAJAR.KODETHNAJARAN,TAHUNAJARAN.TAHUNAJARAN,DETAILAJAR.KODESEMESTER,"
."SEMESTER.NAMASEMESTER,DETAILAJAR.STATUSAJAR FROM DETAILAJAR INNER JOIN PEGAWAI INNER JOIN MATAKULIAH "
."INNER JOIN TAHUNAJARAN INNER JOIN SEMESTER ON DETAILAJAR.NIP=PEGAWAI.NIP AND "
."DETAILAJAR.KODEMATKUL=MATAKULIAH.KODEMATKUL AND DETAILAJAR.KODETHNAJARAN=TAHUNAJARAN.KODETHNAJARAN"
." AND DETAILAJAR.KODESEMESTER=SEMESTER.KODESEMESTER") or die (mysql_error($koneksi));

mysqli_select_db($koneksi,$nama_db) or die("Gagal memilih database!");
$lastmatkul="";
$no = 0;
while ($row = mysqli_fetch_array($sql)){
    $no = $no+1;
?>
    <tr>
        <td> <?php echo $no."."; ?> </td>
        <td><?php
        while ($row['NAMAMATKUL']!=$lastmatkul){
			echo $row['NAMAMATKUL'];
			$lastmatkul=$row['NAMAMATKUL'];
			}
        ?></td>
        <td><?php echo $row['NAMAPEGAWAI']; ?> </td>
        <td><?php echo $row['TAHUNAJARAN'];?></td>
        <td><?php echo $row['NAMASEMESTER'];?></td>
		<td><?php IF($row['STATUSAJAR']==0) echo "Tidak Mengajar";
						else echo "Mengajar";
		?></td>
        <td><a href="updatebagidosen_dosen.php?nip=<?php echo $row['NIP'];?>&kodematkul=<?php echo $row['KODEMATKUL'];?>&status=<?php echo $row['STATUSAJAR'];?>"> <button>Ubah Status Ajar</button></a>
            <a href="deletebagidosen.php?nip=<?php echo $row['NIP'];?>&kodematkul=<?php echo $row['KODEMATKUL'];?>"><button> Hapus</button></a>
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
    <script src="../../../vendor/jquery/jquery.js"></script>
    <script src="../../../vendor/jquery/jquery-migrate-3.0.0.js"></script>
     <!-- jQuery Chained -->
   	<script src="../../../vendor/jquery/jquery.chained.js"></script>

    <!-- Select2 -->
    <script src="../../../vendor/select2-4.0.3/js/select2.full.min.js"></script>


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

    $("#dosen").select2();({
    multiple:true,
    placeholder: "- pilih -",
    });


    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
            //Initialize Select2 Elements
    });
    </script>
    <script>
	$(".dependant").each(function() {
  	$(this).chained($("#kodesemester"));
	});


    </script>


</body>

</html>
