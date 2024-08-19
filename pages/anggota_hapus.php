<?php

session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location:login.php");
    exit;
}

require 'functions.php';

$kode_anggota = $_GET["kode_anggota"];

if ( hapusAnggota($kode_anggota) > 0) {
		echo "
			<script>
				alert('Data anggota berhasil dihapus');
				document.location.href = 'anggota.php';
			</script>
			";
	} else {
		echo "
			<script>
				alert('Data anggota gagal dihapus');
				document.location.href = 'anggota.php';
			</script>
			";
	}

?>