<?php

session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location:login.php");
    exit;
}

require 'functions.php';

$kode_kategori = $_GET["kode_kategori"];

if ( hapusKategori($kode_kategori) > 0) {
		echo "
			<script>
				alert('Data kategori berhasil dihapus');
				document.location.href = 'kategori.php';
			</script>
			";
	} else {
		echo "
			<script>
				alert('Data kategori gagal dihapus');
				document.location.href = 'kategori.php';
			</script>
			";
	}

?>