<?php 

session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location:login.php");
    exit;
}

require 'functions.php';

$admin = mysqli_query($koneksi, "SELECT * FROM admin");
$jumlah_admin = mysqli_num_rows($admin);

$anggota = mysqli_query($koneksi, "SELECT * FROM anggota");
$jumlah_anggota = mysqli_num_rows($anggota);

$kategori = mysqli_query($koneksi, "SELECT * FROM kategori");
$jumlah_kategori = mysqli_num_rows($kategori);

$buku = mysqli_query($koneksi, "SELECT * FROM buku");
$jumlah_buku = mysqli_num_rows($buku);

$pinjam = mysqli_query($koneksi, "SELECT * FROM pinjam");
$jumlah_pinjam = mysqli_num_rows($pinjam);

$peminjaman = mysqli_query($koneksi, "SELECT * FROM peminjaman");
$jumlah_peminjaman = mysqli_num_rows($peminjaman);

$pengembalian = mysqli_query($koneksi, "SELECT * FROM pengembalian");
$jumlah_pengembalian = mysqli_num_rows($pengembalian);

$nama_admin = query("SELECT * FROM admin WHERE kode_admin = '$_SESSION[kode_admin]' ");

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>APLIKASI PERPUSTAKAAN</title>

        <!-- Bootstrap Core CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="../css/metisMenu.min.css" rel="stylesheet">

        <!-- Timeline CSS -->
        <link href="../css/timeline.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../css/startmin.css" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="../css/morris.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <link rel="shorcut icon" href="../img/perpustakaan.png">

        <style type="text/css">
        	 .navbar-inverse {
				    background-color: #5cb85c;
				    border-color: green;
				}

			 li a {
				    color: #5cb85c;
				    text-decoration: none;
				}

			li a:hover {
				    color: green;
				    text-decoration: none;
			}
            .panel-purple {
                    background-color: #6f42c1;
                    color: white;
                }
            .panel-pink {
                    background-color: #d63384;
                    color: white;
            }
            .navbar-header a {
                font-weight: bold;
            }

        </style>
		       
    </head>
    <body>
    	   <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" >
                <div class="navbar-header">
                    <a class="navbar-brand" style="color:white;" href="#">APLIKASI PERPUSTAKAAN</a>
                </div>

                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <ul class="nav navbar-right navbar-top-links">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color:white;">
                            <i class="fa fa-user fa-fw"></i>
                            <?php foreach ($nama_admin as $row) : ?>
                                <?php echo $row["nama_admin"]; ?>
                            <?php endforeach; ?>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li>
                                <a href="admin_edit.php"><i class="fa fa-user fa-fw"></i> Edit Profil</a>
                            </li>
                            <li>
                                <a href="admin_edit_password.php"><i class="fa fa-gear fa-fw"></i> Ganti Password</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- /.navbar-top-links -->

                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <li>
                                <a href="index.php"><i class="fa fa-home fa-fw"></i> Dashboard</a>
                            </li>
                            <li>
                                <a href="admin.php"><i class="fa fa-user fa-fw"></i> Data Admin</a>
                            </li>
                            <li>
                                <a href="anggota.php"><i class="fa fa-users fa-fw"></i> Data Anggota</a>
                            </li>
                            <li>
                                <a href="kategori.php"><i class="fa fa-list-alt fa-fw"></i> Data Kategori</a>
                            </li>
                            <li>
                                <a href="buku.php"><i class="fa fa-book fa-fw"></i> Data Buku</a>
                            </li>
                           <li>
                                <a href="#"><i class="fa fa-list fa-fw"></i> Pinjam Buku<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="pinjam_data.php">Data Pinjam Buku</a>
                                    </li>
                                    <li>
                                        <a href="pinjam_buku.php">Pinjam Buku</a>
                                    </li>
                                 </ul>
                            </li>
                            <li>
                                <a href="pengembalian.php"><i class="fa fa-archive fa-fw"></i> Rekap Perpustakaan<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="peminjaman_buku.php">Peminjaman Buku</a>
                                    </li>
                                    <li>
                                        <a href="pengembalian_buku.php">Pengembalian Buku</a>
                                    </li>
                                 </ul>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-print fa-fw"></i> Laporan<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="admin_laporan.php" target="_blank">Laporan Data Admin</a>
                                    </li>
                                    <li>
                                        <a href="anggota_laporan.php" target="_blank">Laporan Data Anggota</a>
                                    </li>
                                    <li>
                                        <a href="kategori_laporan.php" target="_blank">Laporan Data Kategori</a>
                                    </li>
                                    <li>
                                        <a href="buku_laporan.php" target="_blank">Laporan Data Buku</a>
                                    </li>
                                    <li>
                                        <a href="pinjam_laporan.php" target="_blank">Laporan Data Pinjam</a>
                                    </li>
                                    <li>
                                        <a href="peminjaman_laporan.php" target="_blank">Laporan Data Peminjaman</a>
                                    </li>
                                    <li>
                                        <a href="pengembalian_laporan.php" target="_blank">Laporan Data Pengembalian</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
     
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header"><i class="fa fa-home fa-fw"></i> Dashboard</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-user fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge"><?php echo $jumlah_admin; ?></div>
                                            <div>Data Admin</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="admin.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-yellow">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-users fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge"><?php echo $jumlah_anggota; ?></div>
                                            <div>Data Anggota</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="anggota.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-red">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-list-alt fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge"><?php echo $jumlah_kategori; ?></div>
                                            <div>Data Kategori</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="kategori.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-green">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-book fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge"><?php echo $jumlah_buku; ?></div>
                                            <div>Data Buku</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="buku.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-list fa-5x" style="color:#33ffff;"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge" style="color:#33ffff;"><?php echo $jumlah_pinjam; ?></div>
                                            <div style="color:#33ffff;">Data Pinjam</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="pinjam_data.php">
                                    <div class="panel-footer">
                                        <span class="pull-left" style="color:#33ffff;">View Details</span>
                                        <span class="pull-right" style="color:#33ffff;"><i class="fa fa-arrow-circle-right"></i></span>

                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>


                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-purple">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-list-ul fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge"><?php echo $jumlah_peminjaman; ?></div>
                                            <div>Data Peminjaman</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="peminjaman_buku.php">
                                    <div class="panel-footer">
                                        <span class="pull-left" style="color:#6f42c1; ">View Details</span>
                                        <span class="pull-right" style="color:#6f42c1;"><i class="fa fa-arrow-circle-right"></i></span>

                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-pink">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-list-ol fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge"><?php echo $jumlah_pengembalian; ?></div>
                                            <div>Data Pengembalian</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="pengembalian_buku.php">
                                    <div class="panel-footer">
                                        <span class="pull-left" style="color:#d63384;">View Details</span>
                                        <span class="pull-right" style="color:#d63384; "><i class="fa fa-arrow-circle-right"></i></span>

                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>

                    </div>	
        </div>
	  <!-- /#wrapper -->
        
        <!-- jQuery -->
        <script src="../js/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="../js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="../js/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="../js/startmin.js"></script>
    </body>
	
</html>
