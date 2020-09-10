<?php  

require '../../function/helper.php';
require '../../function/koneksi.php';

$barang_id = isset($_GET['barang_id']) ? $_GET['barang_id'] : "";
$button = isset($_POST['button']) ? $_POST['button'] : $_GET['button'];

$kategori_id = isset($_POST['kategori_id']) ? $_POST['kategori_id'] : false;
$nama_barang = isset($_POST['nama_barang']) ? $_POST['nama_barang'] : false;
$spesifikasi = isset($_POST['spesifikasi']) ? $_POST['spesifikasi'] : false;
$stok = isset($_POST['stok']) ? $_POST['stok'] : false;
$harga = isset($_POST['harga']) ? $_POST['harga'] :false;
$status = isset($_POST['status']) ? $_POST['status'] :false;
$update_gambar="";

if (!empty($_FILES['file']['name'])) {
	$nama_file = $_FILES['file']['name'];
	move_uploaded_file($_FILES['file']['tmp_name'], "../../img/barang/".$nama_file);

	$update_gambar=", gambar='$nama_file'";
}

if($button == "Add"){
		mysqli_query($koneksi, "INSERT INTO barang (nama_barang, kategori_id,  spesifikasi, gambar, harga, stok, status)  VALUES('$nama_barang', '$kategori_id', '$spesifikasi', '$nama_file', '$harga', '$stok', '$status')");
	}
else if($button == "Update"){
	$barang_id = $_GET['barang_id'];
		
	mysqli_query($koneksi, "UPDATE barang SET kategori_id='$kategori_id',
											nama_barang='$nama_barang',
											spesifikasi='$spesifikasi',
											harga='$harga',
											stok='$stok',
											status='$status'
											$update_gambar WHERE barang_id='$barang_id'");
}
else if ($button == "Delete") {
	mysqli_query($koneksi, "DELETE from barang WHERE barang_id='$barang_id'");
}


header("location:".BASE_URL."index.php?page=my_profile&module=barang&action=list");

?>
