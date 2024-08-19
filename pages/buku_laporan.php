<?php 

session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location:login.php");
    exit;
};
 
require 'functions.php';

//Memanggil file FPDF dari file yang anda download tadi
require('../fpdf/fpdf.php');

$pdf = new FPDF("L","cm","A4");

$pdf->SetMargins(1,0.5,1);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',70);
$pdf->Cell(28,2.5,"IT KOMPUTER",0,20,'C');
$pdf->SetFont('Times','I',10);
$pdf->Cell(28,0,"Jalan Puspa Nyidera Pantai Hambawang Timur RT.005 RW.001 Kec. Labuan Amas Selatan Kab. Hulu Sungai Tengah 71361",0,20,'C');

$pdf->Line(1,3.3,28.5,3.3);
$pdf->Line(1,3.4,28.5,3.4);

$pdf->SetFont('Times','B',11);
$pdf->ln(1);
$pdf->SetFont('Arial','B',18);
$pdf->Cell(28,0.7,"Data Buku",0,10,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);

//Tidak berpengaruh dengan database hanya sebagai keterangan pada tabel nantinya
$pdf->Cell(1, 0.8, 'No', 1, 0, 'C');
$pdf->Cell(3.5, 0.8, 'Kode Buku', 1, 0, 'C');
$pdf->Cell(5, 0.8, 'Judul Buku', 1, 0, 'C');
$pdf->Cell(5, 0.8, 'Pengarang', 1, 0, 'C');
$pdf->Cell(5, 0.8, 'Penerbit', 1, 0, 'C');
$pdf->Cell(2.5, 0.8, 'Stok', 1, 0, 'C');
$pdf->Cell(5.5, 0.8, 'Kategori', 1, 0, 'C');

$pdf->ln(0.8);
$pdf->SetFont('Arial','',10);
$no=1;

$query = mysqli_query($koneksi,"SELECT * FROM buku INNER JOIN kategori ON buku.kode_kategori = kategori.kode_kategori");
while ($lihat = mysqli_fetch_array($query) ) {

 $pdf->Cell(1, 0.8, $no, 1, 0, 'C');
 $pdf->Cell(3.5, 0.8, $lihat['kode_buku'], 1, 0,'C');
 $pdf->Cell(5, 0.8, $lihat['judul_buku'], 1, 0,'L');
 $pdf->Cell(5, 0.8, $lihat['pengarang'],1, 0, 'L');
 $pdf->Cell(5, 0.8,$lihat['penerbit'],1, 0, 'L');
 $pdf->Cell(2.5, 0.8,$lihat['stok'],1, 0, 'C');
 $pdf->Cell(5.5, 0.8,$lihat['nama_kategori'],1, 0, 'C');

 $no++;
 $pdf->ln(0.8);
}

$pdf->ln(1);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(45,0.7,"Author",0,10,'C');

$pdf->ln(1);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(45,0.7,"Taufik Rahman",0,10,'C');
//Nama file ketika di print
$pdf->Output("laporan_buku.pdf","I");

?>