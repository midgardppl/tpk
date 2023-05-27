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
<?php
$baca_penjadwalan = mysqli_query($koneksi,"SELECT * FROM penjadwalan ORDER BY kodejadwal DESC limit 1");
$kd_penjadwalan_row = mysqli_fetch_array($baca_penjadwalan);
if(count($kd_penjadwalan_row) == 0) $urut_kd = "00"."1";
else {
	$kd_penjadwalan = $kd_penjadwalan_row[0];
	$urut_kd_no = substr($kd_penjadwalan,3,strlen($kd_penjadwalan))+1;
	$urut_kd = "00".$urut_kd_no;
}
//substr(string,start,length) 
//echo "kd_penjadwalan : ".$urut_kd." === <br />";
?>
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
                    <h1 class="page-header">DATA PENJADWALAN</h1>
                </div>
                <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Masukkan Data Penjadwalan
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form method="post" action="insertjadwal.php" style="font-size:16px">


<?php //$querymatkul = mysql_query("select tawaranmatkul.kodematkul,matakuliah.namamatkul,
//tawaranmatkul.kodethnajaran,tahunajaran.tahunajaran,tawaranmatkul.kodesemester,semester.namasemester from matakuliah
//inner join tahunajaran inner join semester inner join tawaranmatkul on tawaranmatkul.kodematkul=matakuliah.kodematkul and
//tawaranmatkul.kodethnajaran=tahunajaran.kodethnajaran and tawaranmatkul.kodesemester=semester.kodesemester
		//where tawaranmatkul.statustawaran='aktif'") or die (mysql_error());?>

<div class="form-group">
<label>Kode Jadwal</label>
<input class="form-control" type="text" name="kodejadwal" maxlength="20" autofocus required value="jwl<?php  echo $urut_kd; ?>" readonly/><br>
</div>
<div class="form-group">
<label>Program Studi</label>
<select class="form-control" name="p" id="p" onchange="getPd();" required>
     <option value="null" selected="selected">-- Pilih --</option>
                <?php
        $q5 = mysqli_query($koneksi,"select * from prodi") or die (mysql_error($koneksi));
        while($b5 = mysqli_fetch_array($q5)){
            echo "<option value='".$b5[0]."'>".$b5[2]."</option>";
        }
                ?>

</select><br>
</div>

	<div class="form-group">
    <label>Tahun Ajaran</label>
    <select class="form-control dependant" name="kodethnajaran" id="kodethnajaran" required>
        <?php
		//$c1=mysql_fetch_array(mysql_query("select MONTH(now())"));
		//$c2=mysql_fetch_array(mysql_query("select year(now())"));
		//if($c1[0]>6){
		//$querythn = mysql_query("select * from tahunajaran where tahunajaran like '%".$c2[0]."%' order by tahunajaran desc limit 1 ") or die (mysql_error());
		//}else {
		//$querythn = mysql_query("select * from tahunajaran where tahunajaran like '%".$c2[0]."%' order by tahunajaran asc limit 1 ") or die (mysql_error());
		//}
		$querythn = mysqli_query($koneksi,"select * from tahunajaran order by tahunajaran desc limit 1 ") or die (mysql_error());
        //$satuan = $queryjabatan['namajabatan'];
        while($baristhn = mysqli_fetch_array($querythn)){
            echo "<option value='".$baristhn[0]."'>".$baristhn[1]."</option>";
        }
        ?>		
	</select><br>
		<a href="../master/insertview_tahunajar.php">Add Tahun Ajaran</a>
	</div>
<div class="form-group">
<label>Semester</label>
<select class="form-control dependant" name="kodesemester" id="kodesemester" required>
     <option value="-" selected="selected" class="null">-- Pilih --</option>
        <?php
        $querysem = mysqli_query($koneksi,"select * from semester") or die (mysql_error($koneksi));
        //$satuan = $queryjabatan['namajabatan'];
        while($barissem = mysqli_fetch_array($querysem)){
            echo "<option value='".$barissem[0]."'>".$barissem[1]."</option>";
        }
        ?>
</select><br>
</div>
<div class="form-group">
<label>Masa Ujian</label>
<select class="form-control dependant" name="kodemasaujian" id="" required>
     <option value="-" selected="selected" class="null">-- Pilih --</option>
        <?php
        $querysem = array(array(0=>0,1=>uts),array(0=>1,1=>uas));//mysql_query("select * from semester") or die (mysql_error());
        //$satuan = $queryjabatan['namajabatan'];
        //while($barissem = mysql_fetch_array($querysem)){
		for($i=0;$i<count($querysem);$i++){	
            echo "<option value='".$querysem[$i][0]."'>".$querysem[$i][1]."</option>";
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
                            Data Penjadwalan
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <?php
echo "<table width='100%' class='table table-striped table-bordered table-hover' id='dataTables-example'>";
echo "<thead>";
echo "<tr>";
	echo "<th style='width:60px'>No. </th>";
    echo "<th>Pegawai</th>";
    echo "<th style='width:100px'>Tahun Ajaran</th>";
    echo "<th style='width:100px'>Semester</th>";
	echo "<th style='width:100px'>Masa Ujian</th>";
	echo "<th style='width:100px'>Status</th>";
    echo "<th>Aksi</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";
$sql = mysqli_query($koneksi,"select pj.kodejadwal, p.namapegawai, s.namasemester, t.tahunajaran, "
."pj.masaujian,pj.status from penjadwalan pj, pegawai p, semester s, tahunajaran t "
."where pj.nip=p.nip and pj.kodesemester=s.kodesemester and pj.kodethnajaran=t.kodethnajaran") or die (mysql_error());

mysqli_select_db($koneksi,$nama_db) or die("Gagal memilih database!");
$no = 0;
while ($row = mysqli_fetch_array($sql)){
    $no = $no+1;
?>
    <tr>
        <td> <?php echo $no."."; ?> </td>		
        <td><?php echo $row[1]; ?> </td>
        <td><?php echo $row[3];?></td>
        <td><?php echo $row[2];?></td>
		<td><?php if($row[4]==0) $mu="UTS"; else  $mu="UAS";
					echo $mu;?></td>
        <td><?php echo $row[5];?></td>
        <td>
			<a href="det-jadwal.php?kd=<?php echo $row[0]; ?>"><button>Detail</button></a>

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
    <script>
	$(".dependant").each(function() {
  	$(this).chained($("#kodematkul"));
	});

    </script>

</body>

</html>
