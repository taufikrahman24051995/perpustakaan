<?php 

session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location:login.php");
    exit;
}

require 'functions.php';

$kode_pinjam = $_GET["kode_pinjam"];

if ( pengembalianBuku($kode_pinjam) > 0) {
		echo "
			<script>
				alert('Buku berhasil dikembalikan');
				document.location.href = 'pengembalian_buku.php';
			</script>
			";
	} else {
		echo "
			<script>
				alert('Buku gagal dikembalikan');
				document.location.href = 'pinjam_data.php';
			</script>
			";
	}

 ?>