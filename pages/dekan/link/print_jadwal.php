<?php
session_start();
include('../../../koneksi.php');
if (!isset($_SESSION['username']) || empty($_SESSION['username']) || !isset($_SESSION['jabatan']) || empty($_SESSION['jabatan']) || $_SESSION['jabatan']!="jab003"){
echo "<META http-equiv='refresh' content='0;URL=../../../logout.php'>";
        }
echo "<META http-equiv='refresh' content='1800;URL=../../../logout.php'>";
$nama = $_SESSION['namapegawai'];
$jabatan = $_SESSION['jabatan'];
$sql=mysql_query("select namajabatan from jabatan where kodejabatan='$jabatan'");
$row=mysql_fetch_array($sql);
$dt=mysql_fetch_array(mysql_query("select * from penjadwalan where kodejadwal='".$_REQUEST['kd']."'"));
$peg=mysql_fetch_array(mysql_query("select * from pegawai where nip='".$dt[1]."'"));
$sm=mysql_fetch_array(mysql_query("select * from semester where kodesemester='".$dt[2]."'"));
$th=mysql_fetch_array(mysql_query("select * from tahunajaran where kodethnajaran='".$dt[3]."'"));
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
<script type="text/javascript" src="jquery-1.7.2.min.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<script>
$(document).ready(function(){});
function getPd(){
var t = $('#p').val();
	$.ajax({
		url: "getPd.php?t="+t,
		success: function(msg){
			$('.dtl').html(msg);
		},
		dataType: "html"
		});
}
</script>
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
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">DETAIL PENJADWALAN</h1>
                </div>
                <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Tahun Ajaran : <?php echo $th[1];?> | Semester : <?php echo $sm[1];?>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                   
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
                            Detail Jadwal
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <?php
echo "<table width='100%' class='table table-striped table-bordered table-hover' id='dataTables-example'>";
echo "<thead>";
echo "<tr>";
	echo "<th style='width:60px'>No. </th>";
   echo "<th>Mata Kuliah</th>";
   echo "<th>Dosen</th>";
   echo "<th>Ruangan</th>";
   echo "<th>Hari</th>";
    echo "<th style='width:100px'>Jam Mulai</th>";
    echo "<th style='width:100px'>Jam Selesai</th>";
	echo "<th style='width:100px'>Prodi</th>";
	echo "<th style='width:100px'>Kelas</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";
$sql = mysql_query("select * from detailjadwal where kodejadwal='".$_REQUEST['kd']."'") or die (mysql_error());
mysql_select_db($nama_db, $koneksi) or die("Gagal memilih database!");
$no = 0;
while ($row = mysql_fetch_array($sql)){
    $no = $no+1;
	$r=mysql_fetch_array(mysql_query("select * from ruangan where koderuang='".$row[1]."'"));
$h=mysql_fetch_array(mysql_query("select * from hari where kodehari='".$row[4]."'"));
$j1=mysql_fetch_array(mysql_query("select * from jam where kodejam='".$row[3]."'"));
$j2=mysql_fetch_array(mysql_query("select * from jam where kodejam='".$row[7]."'"));
$p=mysql_fetch_array(mysql_query("select * from prodi where kodeprodi='".$row[5]."'"));
$k=mysql_fetch_array(mysql_query("select * from kelas where kodekelas='".$row[6]."'"));
$dk=mysql_fetch_array(mysql_query("select * from detailkelas where kodeprodi='".$row[5]."' and kodekelas='".$row[6]."'"));
$dsn=mysql_fetch_array(mysql_query("select * from pegawai where nip='".$dk[5]."'"));
$mk=mysql_fetch_array(mysql_query("select * from matakuliah where kodematkul='".$dk[3]."'"));
?>
    <tr>
        <td> <?php echo $no."."; ?> </td>
        <td><?php echo $mk[1]; ?> </td>
		<td><?php echo $dsn[3]; ?> </td>
		<td><?php echo $r[2]; ?> </td>
        <td><?php echo $h[1];?></td>
        <td><?php echo $j1[1];?></td>
        <td><?php echo $j2[1];?></td>
		<td><?php echo $p[2];?></td>
		<td><?php echo $k[1];?></td>
    </tr>
<?php
}
echo "</tbody>";
echo "</table>";
?>
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
