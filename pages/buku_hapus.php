<?php

session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location:login.php");
    exit;
}

require 'functions.php';

$kode_buku = $_GET["kode_buku"];

if ( hapusBuku($kode_buku) > 0) {
		echo "
			<script>
				alert('Data buku berhasil dihapus');
				document.location.href = 'buku.php';
			</script>
			";
	} else {
		echo "
			<script>
				alert('Data buku gagal dihapus');
				document.location.href = 'buku.php';
			</script>
			";
	}

?>