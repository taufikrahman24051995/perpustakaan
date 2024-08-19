<?php 

session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location:login.php");
    exit;
}

require 'functions.php';

$kode_pinjam = $_GET["kode_pinjam"];

if ( perpanjangPinjam($kode_pinjam) > 0) {
		echo "
			<script>
				alert('Peminjaman buku berhasil diperpanjang');
				document.location.href = 'pinjam_data.php';
			</script>
			";
	} else {
		echo "
			<script>
				alert('Peminjaman buku gagal diperpanjang');
				document.location.href = 'pinjam_data.php';
			</script>
			";
	}

 ?>