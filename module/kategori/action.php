<?php  

require '../../function/helper.php';
require '../../function/koneksi.php';

adminonly("kategori", $level);

$status = isset($_POST['status']) ? $_POST['status'] : "";
$kategori = isset($_POST['kategori']) ? $_POST['kategori'] : "";
$kategori_id = isset($_GET['kategori_id']) ? $_GET['kategori_id'] : "";
$button = isset($_POST['button']) ? $_POST['button'] : $_GET['button'];


if($button == "Add"){
		mysqli_query($koneksi, "INSERT INTO kategori (kategori, status) VALUES('$kategori', '$status')");
	}
else if($button == "Update"){
	mysqli_query($koneksi, "UPDATE kategori SET kategori='$kategori',
													status='$status' WHERE kategori_id='$kategori_id'");
}
else if ($button == "Delete") {
	mysqli_query($koneksi, "DELETE from kategori WHERE kategori_id='$kategori_id'");
}


header("location: ".BASE_URL."index.php?page=my_profile&module=kategori&action=list");

?>
