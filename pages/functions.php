<?php 

// koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "perpustakaan");

function query ($query) {
	global $koneksi;
	$result = mysqli_query ($koneksi, $query);
	$rows = [];
	while ( $row = mysqli_fetch_assoc ($result)) {
		$rows [] = $row;
	}
	return $rows;
}

function tambahAdmin ($data) {
	global $koneksi;

	$kode_admin = htmlspecialchars($data["kode_admin"]);
	$nama_admin = htmlspecialchars($data["nama_admin"]);
	$username = strtolower(stripslashes($data["username"]));
	$password = mysqli_real_escape_string($koneksi, $data["password"]);
	$password2 = mysqli_real_escape_string($koneksi, $data["password2"]);

	// cek username sudah ada atau belum
	$result = mysqli_query($koneksi, "SELECT username FROM admin WHERE username = '$username'");

	if (mysqli_fetch_assoc($result) ) {
		echo "<script>
				alert ('Username sudah terdaftar');
			  </script>";

		return false;
	}

	// cek konfirmasi password
	if ( $password !== $password2) {
		echo "<script>
				alert ('Konfirmasi password tidak sesuai');
			  </script>";

		return false;
	}

	// enkripsi password
	$password = password_hash($password, PASSWORD_DEFAULT);

	// tambahkan user baru ke database
	mysqli_query($koneksi, "INSERT INTO admin VALUES ('$kode_admin', '$nama_admin', '$username', '$password')");

	return mysqli_affected_rows($koneksi);
}

function editAdmin($data) {
	global $koneksi;

	$kode_admin = htmlspecialchars($data["kode_admin"]);
	$nama_admin = htmlspecialchars($data["nama_admin"]);
	$username = strtolower(stripslashes($data["username"]));
	
	$query = "UPDATE admin SET kode_admin = '$kode_admin', nama_admin = '$nama_admin', username = '$username' WHERE kode_admin = '$kode_admin' ";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);

}

function editPasswordAdmin($data) {
	global $koneksi;

	$password_lama = mysqli_real_escape_string($koneksi, $data["password_lama"]);
	$password_baru = mysqli_real_escape_string($koneksi, $data["password_baru"]);
	$password_baru2 = mysqli_real_escape_string($koneksi, $data["password_baru2"]);

	// cek password sudah ada atau belum
	$result = mysqli_query($koneksi, "SELECT * FROM admin WHERE kode_admin = '$_SESSION[kode_admin]' ");
	$data = mysqli_fetch_array($result);

    // cek password
   	$pass = password_verify($password_lama, $data['password']);

   	if ($pass === TRUE) {
        
        	// cek konfirmasi password
			if ( $password_baru !== $password_baru2) {
				echo "<script>
						alert ('konfirmasi password tidak sesuai');
					  </script>";

				return false;
			}

			// enkripsi password
			$password_baru = password_hash($password_baru, PASSWORD_DEFAULT);
			
			$query = "UPDATE admin SET password = '$password_baru' WHERE kode_admin = '$_SESSION[kode_admin]' ";
			mysqli_query($koneksi, $query);

			return mysqli_affected_rows($koneksi);

	}
}

function tambahKategori($data) {
	global $koneksi;

	$kode_kategori = htmlspecialchars($data["kode_kategori"]);
	$nama_kategori = htmlspecialchars($data["nama_kategori"]);

	$query = "INSERT INTO kategori VALUES ('$kode_kategori', '$nama_kategori')";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function hapusKategori($kode_kategori) {
	global $koneksi;
	mysqli_query ($koneksi, "DELETE FROM kategori WHERE kode_kategori = '$kode_kategori'");
	
	return mysqli_affected_rows($koneksi);
}

function ubahKategori($data) {
	global $koneksi;

	$kode_kategori = htmlspecialchars($data["kode_kategori"]);
	$nama_kategori = htmlspecialchars($data["nama_kategori"]);
	
	$query = "UPDATE kategori SET kode_kategori = '$kode_kategori', nama_kategori = '$nama_kategori' WHERE kode_kategori = '$kode_kategori' ";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function tambahBuku($data) {
	global $koneksi;

	$kode_buku = htmlspecialchars($data["kode_buku"]);
	$judul_buku = htmlspecialchars($data["judul_buku"]);
	$pengarang = htmlspecialchars($data["pengarang"]);
	$penerbit = htmlspecialchars($data["penerbit"]);
	$stok = htmlspecialchars($data["stok"]);
	$kode_kategori = htmlspecialchars($data["nama_kategori"]);

	$query = "INSERT INTO buku VALUES ('$kode_buku', '$judul_buku', '$pengarang', '$penerbit',  '$stok', '$kode_kategori')";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function hapusBuku($kode_buku) {
	global $koneksi;
	mysqli_query ($koneksi, "DELETE FROM buku WHERE kode_buku = '$kode_buku'");
	
	return mysqli_affected_rows($koneksi);
}

function ubahBuku($data) {
	global $koneksi;

	$kode_buku = htmlspecialchars($data["kode_buku"]);
	$judul_buku = htmlspecialchars($data["judul_buku"]);
	$pengarang = htmlspecialchars($data["pengarang"]);
	$penerbit = htmlspecialchars($data["penerbit"]);
	$stok = htmlspecialchars($data["stok"]);
	$kode_kategori = htmlspecialchars($data["nama_kategori"]);

	$query = "UPDATE buku SET kode_buku = '$kode_buku', judul_buku = '$judul_buku', pengarang = '$pengarang', penerbit = '$penerbit', stok = '$stok', kode_kategori = '$kode_kategori' WHERE kode_buku = '$kode_buku' ";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function tambahAnggota ($data) {
	global $koneksi;

	$kode_anggota = htmlspecialchars($data["kode_anggota"]);
	$nama_anggota = htmlspecialchars($data["nama_anggota"]);
	$tanggal_lahir = htmlspecialchars(date('Y-m-d', strtotime($data["tanggal_lahir"])));
	$jenis_kelamin = htmlspecialchars($data["jenis_kelamin"]);
	$alamat = htmlspecialchars($data["alamat"]);

	// upload gambar
	$foto = upload();
	if( !$foto) {
		return false;
	}

	$query = "INSERT INTO anggota VALUES ('$kode_anggota', '$nama_anggota', '$tanggal_lahir', '$jenis_kelamin', '$alamat', '$foto')";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function upload() {

	$namaFile = $_FILES['foto']['name'];
	$_ukuranFile = $_FILES['foto']['size'];
	$error = $_FILES['foto']['error'];
	$tmpName = $_FILES['foto']['tmp_name'];

	// cek apakah tidak ada gambar yang diupload
	if( $error === 4 ) {
		echo "<script>
					alert('Pilih foto terlebih dahulu');
			  </script>";
		return false;
	}

	// cek apakah yang diupload adalah gambar
	$ekstensiFotoValid = ['jpg', 'jpeg', 'png'];
	$ekstensiFoto = explode ('.', $namaFile);
	$ekstensiFoto = strtolower ( end ($ekstensiFoto));
	if ( !in_array ($ekstensiFoto, $ekstensiFotoValid) ) {
		echo "<script>
					alert('Yang diupload bukan foto');
			  </script>";
		return false;
	}

	// cek jika ukurannya terlalu besar
	if ($_ukuranFile > 1000000) {
		echo "<script>
					alert('Ukuran foto terlalu besar');
			  </script>";
		return false;
	}

	// gambar siap diupload
	// generate nama gambar baru
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiFoto;

	move_uploaded_file($tmpName, '../img/' .$namaFileBaru);

	return  $namaFileBaru;

}

function hapusAnggota($kode_anggota) {
	global $koneksi;
	mysqli_query ($koneksi, "DELETE FROM anggota WHERE kode_anggota = '$kode_anggota'");
	
	return mysqli_affected_rows($koneksi);
}

function ubahAnggota($data) {
	global $koneksi;

	$kode_anggota = $data["kode_anggota"];
	$nama_anggota = htmlspecialchars($data["nama_anggota"]);
	$tanggal_lahir = htmlspecialchars(date('Y-m-d', strtotime($data["tanggal_lahir"])));
	$jenis_kelamin = htmlspecialchars($data["jenis_kelamin"]);
	$alamat = htmlspecialchars($data["alamat"]);
	$fotoLama = htmlspecialchars($data["fotoLama"]);

	// cek apakah user pilih gambar baru tau tidak
	if ( $_FILES['foto']['error'] === 4) {
		$foto = $fotoLama;
	} else {
		$foto = upload();
	};
	
	$query = "UPDATE anggota SET kode_anggota = '$kode_anggota', nama_anggota = '$nama_anggota', tanggal_lahir = '$tanggal_lahir', jenis_kelamin = '$jenis_kelamin', alamat = '$alamat', foto = '$foto' WHERE kode_anggota = '$kode_anggota' ";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function pinjamBuku($data) {
	global $koneksi;

	$kode_pinjam = htmlspecialchars($data["kode_pinjam"]);
	$kode_admin = htmlspecialchars($_SESSION["kode_admin"]);
	$kode_anggota = htmlspecialchars($data["nama_anggota"]);
	$kode_kategori = htmlspecialchars($data["nama_kategori"]);
	$kode_buku = htmlspecialchars($data["judul_buku"]);
	$tanggal_pinjam = date("Y-m-d");
	$masa_pinjam      = mktime(0,0,0,date("n"),date("j")+7,date("Y"));
	$tanggal_kembali = date("Y-m-d", $masa_pinjam);

	$result = mysqli_query($koneksi, "SELECT kode_anggota FROM pinjam WHERE kode_anggota = '$kode_anggota'");

	if (mysqli_num_rows($result) >= 2 ) {
		echo "<script>
				alert ('Anggota sudah meminjam 2 buku');
			  </script>";

		return false;
	} else {

	$query = "INSERT INTO pinjam VALUES ('$kode_pinjam', '$kode_admin', '$kode_anggota', '$kode_kategori',  '$kode_buku', '$tanggal_pinjam', '$tanggal_kembali')";
	mysqli_query($koneksi, $query);

	mysqli_query($koneksi, "UPDATE buku SET stok = stok - 1 WHERE kode_buku = '$kode_buku'");   

	return mysqli_affected_rows($koneksi);
	}
}

function perpanjangPinjam($kode_pinjam) {

	global $koneksi;
	
	$tanggal_pinjam = date("Y-m-d");
	$masa_pinjam      = mktime(0,0,0,date("n"),date("j")+7,date("Y"));
	$tanggal_kembali = date("Y-m-d", $masa_pinjam); 

	$query = "UPDATE pinjam SET tanggal_pinjam = '$tanggal_pinjam', tanggal_kembali = '$tanggal_kembali' WHERE kode_pinjam = '$kode_pinjam' ";
	mysqli_query($koneksi, $query);

	return mysqli_affected_rows($koneksi);
}

function pengembalianBuku($kode_pinjam) {

	global $koneksi;

	$tanggal_kembali = date("Y-m-d");

	mysqli_query($koneksi, "UPDATE buku SET stok = stok + 1"); 

	$peminjaman = "INSERT INTO peminjaman (kode_pinjam, kode_admin, kode_anggota, kode_kategori, kode_buku, tanggal_pinjam) 
	SELECT kode_pinjam, kode_admin, kode_anggota, kode_kategori, kode_buku, tanggal_pinjam FROM pinjam WHERE kode_pinjam = '$kode_pinjam'";
	
	$pengembalian = "INSERT INTO pengembalian (kode_pinjam, kode_admin, kode_anggota, kode_kategori, kode_buku, tanggal_kembali) 
	SELECT kode_pinjam, kode_admin, kode_anggota, kode_kategori, kode_buku, '$tanggal_kembali' FROM pinjam WHERE kode_pinjam = '$kode_pinjam'";  

	$pinjam = "DELETE FROM pinjam WHERE kode_pinjam = '$kode_pinjam'";

	mysqli_query($koneksi, $peminjaman);

	mysqli_query($koneksi, $pengembalian);

	mysqli_query ($koneksi, $pinjam);

	return mysqli_affected_rows($koneksi);
}

?>



                                        