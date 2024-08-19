<?php

require 'functions.php';

    $sql = "SELECT * FROM buku WHERE stok > 0 AND kode_kategori = '".$_POST["kategori"]."' ";
    $hasil = mysqli_query($koneksi, $sql);
    while ($data = mysqli_fetch_array($hasil)) {

?>
        <option value="<?php echo  $data['kode_buku']; ?>"><?php echo $data['kode_buku']; ?> <?php echo $data['judul_buku']; ?></option>
<?php
    }
?>
