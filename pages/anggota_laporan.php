<?php

session_start();
ob_start();

require 'functions.php';//buat koneksi ke database

$anggota = query("SELECT * FROM anggota");
?>

<html xmlns="http://www.w3.org/1999/xhtml"> <!-- Bagian halaman HTML yang akan konvert -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>APLIKASI PERPUSTAKAAN</title>
</head>
<body>
	
	<p align="center"><span><h1 align="center">IT KOMPUTER</h1></span>Jalan Puspa Nyidera Pantai Hambawang Timur RT.005 RW.001 Kec. Labuan Amas Selatan Kab. Hulu Sungai Tengah 71361</p>

	<table width="120" border="1" align="center" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th width="30"><div align="center">No</div></th>
                <th width="100"><div align="center">Kode Anggota</div></th>
                <th><div align="center">Nama</div></th>
                <th width="100"><div align="center">Tanggal Lahir</div></th>
                <th><div align="center">Jenis Kelamin</div></th>
                <th><div align="center">Alamat</div></th>
                <th><div align="center">Foto</div></th>
            </tr>
        </thead>

        <?php $i = 1; ?>
        <?php foreach ($anggota as $row) : ?>

        <tr>
            <td align="center"><?php echo $i; ?></td>
            <td align="center"><?php echo $row["kode_anggota"]; ?></td>
            <td align="center"><?php echo $row["nama_anggota"]; ?></td>
            <td align="center"><?php echo date("d-m-Y", strtotime($row["tanggal_lahir"])); ?></td>
            <td align="center"><?php echo $row["jenis_kelamin"]; ?></td>
            <td align="center"><?php echo $row["alamat"]; ?></td>
            <td align="center"><img src="../img/<?php echo $row["foto"]; ?>" width="50"></td>
        </tr>

        <?php $i++; ?>
        <?php endforeach; ?>

    </table>
</body>
</html><!-- Akhir halaman HTML yang akan di konvert -->
<?php
$filename="laporan_anggota.pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya
//==========================================================================================================
//Copy dan paste langsung script dibawah ini,untuk mengetahui lebih jelas tentang fungsinya silahkan baca-baca tutorial tentang HTML2PDF
//==========================================================================================================
$content = ob_get_clean();
$content = '<page style="font-family: freeserif">'.nl2br($content).'</page>';
 require_once(dirname(__FILE__).'/../html2pdf/html2pdf.class.php');
 try
 {
  $html2pdf = new HTML2PDF('P','A4','en', false, 'ISO-8859-15',array(10, 3, 10, 3));
  $html2pdf->setDefaultFont('Arial');
  $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
  $html2pdf->Output($filename);
 }
 catch(HTML2PDF_exception $e) { echo $e; }
?>