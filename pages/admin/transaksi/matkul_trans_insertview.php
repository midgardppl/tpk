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
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">PENAWARAN MATA KULIAH</h1>
                </div>
                <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Pilih Semester : Gasal atau Genap
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form method="post" action="matkul_trans_semester_tawar.php" style="font-size:16px">
								
<div class="form-group">
<label>Semester (Gasal-Genap)</label>
<select class="form-control" name="kodesemester" id="kodesemester" required>
     <option value="-" selected="selected">-- Pilih --</option>
             <?php
        $querysemester = mysqli_query($koneksi,"select kodesemester,namasemester from semester") or die (mysql_error());
        //$satuan = $queryjabatan['namajabatan'];
        while($barissemester = mysqli_fetch_array($querysemester)){
            echo "<option value='".$barissemester['kodesemester']."'>".$barissemester['namasemester']."</option>";
        }
        ?>
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
                            Data Matakuliah
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <?php
echo "<table width='100%' class='table table-striped table-bordered table-hover' id='dataTables-example'>";
echo "<thead>";
echo "<tr>";
	echo "<th style='width:30px'>No. </th>";
    echo "<th style='width:120px'>Mata Kuliah (sks) </th>";
	echo "<th>Tahun Kurikulum</th>";
	echo "<th>Semester</th>";
    echo "<th>Status Aktif</th>";
	echo "<th>Status Tawar</th>";
    echo "<th>Aksi</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";
$sql = mysqli_query($koneksi,"SELECT MATAKULIAH.KODEMATKUL,.MATAKULIAH.NAMAMATKUL,MATAKULIAH.SKS,
MATAKULIAH.TAHUNKURIKULUM,MATAKULIAH.KODESEMESTER,MATAKULIAH.STATUSAKTIF,MATAKULIAH.SEMESTER,
MATAKULIAH.STATUSTAWAR,SEMESTER.NAMASEMESTER FROM MATAKULIAH INNER JOIN SEMESTER 
ON SEMESTER.KODESEMESTER=MATAKULIAH.KODESEMESTER") or die (mysql_error($koneksi));
mysqli_select_db($koneksi,$nama_db) or die("Gagal memilih database!");
$no = 0;
while ($row = mysqli_fetch_array($sql)){
    $no = $no+1;
?>
    <tr>
        <td> <?php echo $no."."; ?> </td>
        <td><?php echo $row['KODEMATKUL']." - ".$row['NAMAMATKUL']." (".$row['SKS'].")";?></td>
        <td><?php echo $row['TAHUNKURIKULUM'];?></td>
        <td><?php echo $row['SEMESTER'];?></td>
        <td><?php echo $row['STATUSAKTIF'];?></td>
		<td><?php IF($row['STATUSTAWAR']==0) echo "Tidak Ditawarkan";
						else echo "Ditawarkan";
		?></td>
        <td>
            <a href="matkul_trans_aktif.php?kd=<?php echo $row['KODEMATKUL'];  ?>&kdaktif=<?php echo $row['STATUSAKTIF'];  ?>">
			<button><?php if($row['STATUSAKTIF']=="Aktif") $mu="Men-Tidak-Aktif-kan"; else  $mu="Aktifkan";
					echo $mu;?></button></a>
			<a href="matkul_trans_tawar.php?kd=<?php echo $row['KODEMATKUL'];  ?>&kdtawar=<?php echo $row['STATUSTAWAR'];  ?>">
			<button><?php if($row['STATUSTAWAR']==1) $mu="Men-Tidak-Tawarkan"; else  $mu="Tawarkan";
					echo $mu;?></button></a>
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

    <!-- InputMask -->
    <script src="../../../mask/input-mask/jquery.inputmask.js"></script>
    <script src="../../../mask/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="../../../mask/input-mask/jquery.inputmask.extensions.js"></script>

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
