<?php

session_start();
ob_start();

require 'functions.php';//buat koneksi ke database

// ambil data di URL
$kode_anggota = $_GET["kode_anggota"];
// query data mahasiswa berdasarkan id
$anggota = query("SELECT * FROM anggota WHERE kode_anggota = '$kode_anggota'")[0];

?>
<html xmlns="http://www.w3.org/1999/xhtml"> <!-- Bagian halaman HTML yang akan konvert -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>APLIKASI PERPUSTAKAAN</title>
</head>
<body>
	<h1 align="center">IT KOMPUTER</h1>
	<p align="center">Jalan Puspa Nyidera Pantai Hambawang Timur RT.005 RW.001 Kec. Labuan Amas Selatan 
	Kab. Hulu Sungai Tengah 71361</p>

	<table width="150" border="0" align="center" cellpadding="0" cellspacing="10">

		<tr>
            <td rowspan="10"><img src="../img/<?php echo $anggota["foto"]; ?>" width="80" ></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
        	<td width="100">Kode Anggota</td>
		    <td width="10">:</td>
		    <td width="250"><?php echo $anggota["kode_anggota"]; ?></td>
        </tr>
        <tr>
        	<td width="100">Nama Anggota</td>
		    <td width="10">:</td>
		    <td width="250"><?php echo $anggota["nama_anggota"]; ?></td>
        </tr>
         <tr>
        	<td width="100">Tanggal Lahir</td>
		    <td width="10">:</td>
		    <td width="250"><?php echo date('d-m-Y', strtotime($anggota["tanggal_lahir"])); ?></td>
        </tr>
         <tr>
        	<td width="100">Jenis Kelamin</td>
		    <td width="10">:</td>
		    <td width="250"><?php echo $anggota["jenis_kelamin"]; ?></td>
        </tr>
         <tr>
        	<td width="100">Alamat</td>
		    <td width="10">:</td>
		    <td width="250"><?php echo $anggota["alamat"]; ?></td>
        </tr>

    </table>
</body>
</html><!-- Akhir halaman HTML yang akan di konvert -->
<?php
$filename="anggota_cetak.pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya
//==========================================================================================================
//Copy dan paste langsung script dibawah ini,untuk mengetahui lebih jelas tentang fungsinya silahkan baca-baca tutorial tentang HTML2PDF
//==========================================================================================================
$content = ob_get_clean();
$content = '<page style="font-family: freeserif">'.nl2br($content).'</page>';
 require_once(dirname(__FILE__).'/../html2pdf/html2pdf.class.php');
 try
 {
  $html2pdf = new HTML2PDF('L','A4','en', false, 'ISO-8859-15',array(20, 0, 20, 0));
  $html2pdf->setDefaultFont('Arial');
  $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
  $html2pdf->Output($filename);
 }
 catch(HTML2PDF_exception $e) { echo $e; }
?>