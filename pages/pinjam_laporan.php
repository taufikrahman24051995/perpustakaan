<?php 

session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location:login.php");
    exit;
};
 
require 'functions.php';

$pinjam = query("SELECT * FROM pinjam INNER JOIN admin ON pinjam.kode_admin = admin.kode_admin INNER JOIN anggota ON pinjam.kode_anggota = anggota.kode_anggota INNER JOIN kategori ON pinjam.kode_kategori = kategori.kode_kategori INNER JOIN buku ON pinjam.kode_buku = buku.kode_buku");

?>

<html xmlns="http://www.w3.org/1999/xhtml"> <!-- Bagian halaman HTML yang akan konvert -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>APLIKASI PERPUSTAKAAN</title>
</head>
<body>
	<table width="150" border="1" align="center" cellpadding="0" cellspacing="0">
         <thead>
            <tr>
                <th width="20"><div align="center">No</div></th>
                <th width="100"><div align="center">Kode Pinjam</div></th>
                <th width="100"><div align="center">Anggota</div></th>
                <th width="150"><div align="center">Kategori</div></th>
                <th width="150"><div align="center">Judul Buku</div></th>
                <th width="100"><div align="center">Tanggal Pinjam</div></th>
                <th width="100"><div align="center">Tanggal Kembali</div></th>
                <th width="70"><div align="center">Terlambat</div></th>
                <th width="60"><div align="center">Denda</div></th>
            </tr>
        </thead>

        <?php $i = 1; ?>
        <?php foreach ($pinjam as $row) : ?>

         <?php 

             $s = date('Y-m-d');
            // untuk menghitung selisih hari terlambat
             if ($t = date_create($s > $row["tanggal_kembali"])) {
                     $t = date_create($s > $row["tanggal_kembali"]);
                     $n = date_create(date('Y-m-d'));
                     $terlambat = date_diff($t, $n);
                     $hari = $terlambat->format("%a");

             }else{
                     $t = date_create($row["tanggal_kembali"]);
                     $n = date_create(date('Y-m-d'));
                     $terlambat = date_diff($t, $n);
                     $hari = $terlambat->format("%a");
             }

                    // menghitung denda
                    $denda = $hari * 1000;
            
        ?>

        <tr>
            <td align="center"><?php echo $i; ?></td>
            <td align="center"><?php echo $row["kode_pinjam"]; ?></td>
            <td align="center"><?php echo $row["nama_anggota"]; ?></td>
            <td align="center"><?php echo $row["nama_kategori"]; ?></td>
            <td align="center"><?php echo $row["judul_buku"]; ?></td>
            <td align="center"><?php echo date("d-m-Y", strtotime($row["tanggal_pinjam"])); ?></td>
            <td align="center"><?php echo date("d-m-Y", strtotime($row["tanggal_kembali"])); ?></td>
            <td align="center"><?php echo $hari; ?></td>
            <td align="center"><?php echo $denda; ?></td>
        </tr>

        <?php $i++; ?>
        <?php endforeach; ?>

    </table>
</body>
</html><!-- Akhir halaman HTML yang akan di konvert -->

<?php
$filename="laporan_pinjam.pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya
//==========================================================================================================
//Copy dan paste langsung script dibawah ini,untuk mengetahui lebih jelas tentang fungsinya silahkan baca-baca tutorial tentang HTML2PDF
//==========================================================================================================
$content = ob_get_clean();
$content = '<page style="font-family: freeserif">'.nl2br($content).'</page>';
 require_once(dirname(__FILE__).'/../html2pdf/html2pdf.class.php');
 try
 {
  $html2pdf = new HTML2PDF('P','A3','en', false, 'ISO-8859-15',array(20, 3, 20, 3));
  $html2pdf->setDefaultFont('Arial');
  $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
  $html2pdf->Output($filename);
 }
 catch(HTML2PDF_exception $e) { echo $e; }
?>