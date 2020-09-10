<div id="left">
	
	<?php  
		echo kategori($kategori_id);
	?>

</div>

<div id="right">

	<?php  
		$barang_id = $_GET['barang_id'];

		$query = mysqli_query($koneksi, "SELECT * FROM barang WHERE barang_id='$barang_id' AND status = 'on'");
		$row = mysqli_fetch_assoc($query);

		echo "<div id='detail-barang'>
					<h2>$row[nama_barang]</h2>
					<div id='frame-barang'>
						<img src='".BASE_URL."img/barang/$row[gambar]' />
					</div>
					<div id='frame-harga'>
						<span>".rupiah($row['harga'])."</span>
						<a href='".BASE_URL."tambah_keranjang.php?barang_id=$row[barang_id]'>+Add to Cart</a>
					</div>
					<div id='keterangan'>
						<b>Keterangan : </b> $row[spesifikasi]
					</div>
			</div>";
	?>

</div>