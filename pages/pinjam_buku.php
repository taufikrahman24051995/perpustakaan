<?php
session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location:login.php");
    exit;
}

require 'functions.php';

// cek apakah tombol submit sudah ditekan atau belum
if( isset($_POST["pinjam_buku"]) ) {

    // cek apakah data berhasil ditambahkan atau tidak
    if( pinjamBuku($_POST) > 0) {
        echo "
            <script>
                alert('Buku berhasil dipinjam');
                document.location.href = 'pinjam_data.php';
            </script>
            ";
    } else {
        echo "
            <script>
                alert('Buku gagal dipinjam');
                document.location.href = 'pinjam_data.php';
            </script>
            ";
    }
}

$sql = mysqli_query($koneksi, "SELECT * FROM pinjam");
$ketemu = mysqli_num_rows($sql);
if ($ketemu === 0){
    $query = mysqli_query($koneksi, "SELECT MAX(kode_pinjam) as kodeTerbesar FROM peminjaman");
    $data = mysqli_fetch_array($query);
    $kodePinjam = $data['kodeTerbesar'];

    $urutan = (int) substr ($kodePinjam, 3, 3);

    $urutan++;

    $huruf = "PJM";
    $kodePinjam = $huruf . sprintf("%03s", $urutan);
} else {
    $query = mysqli_query($koneksi, "SELECT MAX(kode_pinjam) as kodeTerbesar FROM pinjam");
    $data = mysqli_fetch_array($query);
    $kodePinjam = $data['kodeTerbesar'];

    $urutan = (int) substr ($kodePinjam, 3, 3);

    $urutan++;

    $huruf = "PJM";
    $kodePinjam = $huruf . sprintf("%03s", $urutan);
}

$nama_admin = query("SELECT * FROM admin WHERE kode_admin = '$_SESSION[kode_admin]' ");

$tanggal_pinjam    = date("d-m-Y");
$masa_pinjam      = mktime(0,0,0,date("n"),date("j")+7,date("Y"));
$tanggal_kembali   = date("d-m-Y", $masa_pinjam); 

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

        <link href="../css/datepicker.css" rel="stylesheet" >

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
                	<form action="" method="post">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header"><i class="fa fa-list fa-fw"></i> Pinjam Buku</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                     <div class="form-group">
						<label for="kode_buku">Kode Pinjam</label>
						<input class="form-control" placeholder="Kode Pinjam" name="kode_pinjam" id="kode_pinjam" value="<?php echo $kodePinjam; ?>" readonly>
					</div>

					<div class="form-group">
                        <label>Nama Anggota</label>
                        <select name="nama_anggota" id="nama_anggota" class="form-control" required>
                            <option value="" >Pilih Nama Anggota</option>
                            <?php 
                                $anggota = mysqli_query($koneksi, "SELECT * FROM anggota");
                                $jsArray = "var prdName = new Array();\n";
                                while($nama_anggota = mysqli_fetch_array($anggota) ) {
                                echo'<option value = "' .$nama_anggota['kode_anggota'].'">'. $nama_anggota['kode_anggota'].'   '. $nama_anggota['nama_anggota'].' </option>';
                                }
                             ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nama Kategori</label>
                        <select name="nama_kategori" id="nama_kategori" class="form-control" required>
                            <option value="" >Pilih Kategori</option>
                            <?php 
                                $kategori = mysqli_query($koneksi, "SELECT * FROM kategori");
                                $jsArray = "var prdName = new Array();\n";
                                while($nama_kategori = mysqli_fetch_array($kategori) ) {
                                echo'<option value = "' .$nama_kategori['kode_kategori'].'">'. $nama_kategori['kode_kategori'].'   '. $nama_kategori['nama_kategori'].' </option>';
                                }
                             ?>
                        </select>
                    </div>
					<div class="form-group">
                        <label>Judul Buku</label>
                        <select name="judul_buku" id="judul_buku" class="form-control" required>
                            <option value="" >Pilih Judul Buku</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_pinjam">Tanggal Pinjam</label>
                        <input class="form-control" placeholder="Tanggal Pinjam" name="tanggal_pinjam" id="tanggal_pinjam" autocomplete="off" value="<?php echo $tanggal_pinjam ?>" readonly>
                    </div>
					<div class="form-group">
                        <label for="tanggal_kembali">Tanggal Kembali</label>
                        <input class="form-control" placeholder="Tanggal Kembali" name="tanggal_kembali" id="tanggal_kembali" autocomplete="off" value="<?php echo $tanggal_kembali ?>" readonly>
                    </div>
					<button type="submit" class="btn btn-success" name="pinjam_buku">Pinjam Buku</button>
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

        <script>
   
            $("#nama_kategori").change(function(){
           
                // variabel dari nilai combo box provinsi
                var kode_kategori = $("#nama_kategori").val();
               
                // mengirim dan mengambil data
                $.ajax({
                    type: "POST",
                    dataType: "html",
                    url: "pinjam_aksi_input.php",
                    data: "kategori="+kode_kategori,
                    success: function(msg){
                       
                        // jika tidak ada data
                        if(msg == 0){
                            alert('Data Buku Lagi Kosong');
                            location.reload();
                        }
                       
                        // jika dapat mengambil data,, tampilkan di combo box kota
                        else{
                            $("#judul_buku").html(msg);                                                     
                        }
                       
                    }
                });    
            });
        </script>

    </body>
</html>
