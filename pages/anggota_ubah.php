<?php

session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location:login.php");
    exit;
}

require 'functions.php';

// ambil data di URL
$kode_anggota = $_GET["kode_anggota"];
// query data mahasiswa berdasarkan id
$anggota = query("SELECT * FROM anggota WHERE kode_anggota = '$kode_anggota'")[0];

// cek apakah tombol submit sudah ditekan atau belum
if( isset($_POST["ubah_anggota"]) ) {

    // cek apakah data berhasil diubah atau tidak
    if( ubahAnggota($_POST) > 0) {
        echo "
            <script>
                alert('Data anggota berhasil diubah');
                document.location.href = 'anggota.php';
            </script>
            ";
    } else {
        echo "
            <script>
                alert('Data anggota gagal diubah');
                document.location.href = 'anggota.php';
            </script>
            ";
    }
}

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

        <link href="../css/datepicker.css" rel="stylesheet" >

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
                                <a href="anggota.php" class="active"><i class="fa fa-users fa-fw"></i> Data Anggota</a>
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
                    <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="fotoLama" value="<?php echo $anggota["foto"] ?>" >
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header"><i class="fa fa-users fa-fw"></i> Ubah Data Anggota</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                     <div class="form-group">
                        <label for="kode_anggota">Kode Anggota</label>
                        <input class="form-control" placeholder="Kode Anggota" name="kode_anggota" id="kode_anggota" value="<?php echo $anggota["kode_anggota"]; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nama_anggota">Nama</label>
                        <input class="form-control" placeholder="Nama Anggota" name="nama_anggota" id="nama_anggota" value="<?php echo $anggota["nama_anggota"]; ?>" autofocus autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        <input class="form-control datepicker" placeholder="Tanggal Lahir" name="tanggal_lahir" id="tanggal_lahir" value="<?php echo date('d-m-Y', strtotime($anggota["tanggal_lahir"])); ?>" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control" required>
                        <option value="" >Pilih Jenis Kelamin</option>
                        <option value="Laki-laki"<?php if ($anggota["jenis_kelamin"] == "Laki-laki") { echo "selected=\"selected\""; } ?> >Laki-laki</option>
                            <option value="Perempuan"<?php if ($anggota["jenis_kelamin"] == "Perempuan") { echo "selected=\"selected\""; } ?> >Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control" rows="3" placeholder="Alamat" name="alamat" id="alamat" required><?php echo $anggota["alamat"] ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="foto">Foto</label>
                        <img src="../img/<?php echo $anggota["foto"]; ?> " width="40" >
                        <input class="" type="file" placeholder="Foto" name="foto" id="foto" autocomplete="off">
                    </div>
                    <button type="submit" class="btn btn-success" name="ubah_anggota">Ubah Anggota</button>
                    </form>
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

        <script src="../js/bootstrap-datepicker.js"></script>

        <script type="text/javascript">
            $(function(){
                $(".datepicker").datepicker({
                    format: 'dd-mm-yyyy',
                    autoclose: true,
                    todayHighlight: false,
                });
            });
        </script>

    </body>
</html>
