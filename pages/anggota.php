<?php 

session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location:login.php");
    exit;
}

require 'functions.php';

$anggota = query("SELECT * FROM anggota");

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

        <!-- DataTables CSS -->
        <link href="../css/dataTables/dataTables.bootstrap.css" rel="stylesheet">

        <!-- DataTables Responsive CSS -->
        <link href="../css/dataTables/dataTables.responsive.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../css/startmin.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <link rel="stylesheet" type="text/css" href="../css/style.css">

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
                            <h1 class="page-header"><i class="fa fa-users fa-fw"></i> Data Anggota</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <a href="anggota_input.php"><button type="button" class="btn btn-success"><i class="fa fa-plus"></i> Input Anggota</button></a>
                                    <a href="anggota_laporan.php" target="_blank"><button type="button" class="btn btn-info"><i class="fa fa-print"></i> Print Anggota</button></a>
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th><div align="center">No</div></th>
                                                    <th><div align="center">Kode Anggota</div></th>
                                                    <th><div align="center">Nama</div></th>
                                                    <th><div align="center">Tanggal Lahir</div></th>
                                                    <th><div align="center">Jenis Kelamin</div></th>
                                                    <th><div align="center">Alamat</div></th>
                                                    <th><div align="center">Foto</div></th>
                                                    <th><div align="center">Aksi</div></th>
                                                </tr>
                                            </thead>

                                            <?php $i = 1; ?>
                                            <?php foreach ($anggota as $row) : ?>

                                            <tr>
                                                <td align="center"><?php echo $i; ?></td>
                                                <td align="center"><?php echo $row["kode_anggota"]; ?></td>
                                                <td align="center"><?php echo $row["nama_anggota"]; ?></td>
                                                <td align="center"><?php echo date('d-m-Y', strtotime($row["tanggal_lahir"])); ?></td>
                                                <td align="center"><?php echo $row["jenis_kelamin"]; ?></td>
                                                <td align="center"><?php echo $row["alamat"]; ?></td>
                                                <td align="center"><img src="../img/<?php echo $row["foto"]; ?>" width="50"></td>
                                                <td align="center" width="260">
                                                        <a style="text-decoration: none; color: white;" href="anggota_ubah.php?kode_anggota=<?php echo $row["kode_anggota"]; ?>">
                                                        <button class="btn btn-danger">
                                                        <i class="fa fa-edit"></i> Ubah
                                                        </button>
                                                        </a>
                                                        <a style="text-decoration: none; color: white;" href="anggota_hapus.php?kode_anggota=<?php echo $row["kode_anggota"]; ?>" onclick="return confirm('Hapus data anggota');" >
                                                        <button class="btn btn-warning">
                                                        <i class="fa fa-trash"></i> Hapus 
                                                        </button>
                                                        </a>
                                                        <a style="text-decoration: none; color: white;" href="anggota_cetak.php?kode_anggota=<?php echo $row["kode_anggota"]; ?>" target="_blank" >
                                                        <button class="btn btn-primary">
                                                        <i class="fa fa-print"></i> Cetak 
                                                        </button>
                                                        </a>
                                                </td>
                                            </tr>

                                            <?php $i++; ?>
                                            <?php endforeach; ?>

                                        </table>
                                    </div>
                                </div>
                  </div>                <!-- /.table-responsive -->
            </div>
             <!-- jQuery -->
        <script src="../js/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="../js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="../js/metisMenu.min.js"></script>

        <!-- DataTables JavaScript -->
        <script src="../js/dataTables/jquery.dataTables.min.js"></script>
        <script src="../js/dataTables/dataTables.bootstrap.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="../js/startmin.js"></script>

        <!-- Page-Level Demo Scripts - Tables - Use for reference -->
        <script>
            $(document).ready(function() {
                $('#dataTables-example').DataTable({
                        responsive: true
                });
            });
        </script>


    </body>
	
</html>
