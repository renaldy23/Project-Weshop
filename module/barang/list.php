<?php  

$search = isset($_GET['search']) ? $_GET['search'] : false;

?>
<div id="frame-tambah">
	<div id="left">
		<form action="<?php echo BASE_URL."index.php" ?>" method=GET>
			<input type="hidden" name="page" value="<?php echo $_GET["page"]; ?>">
			<input type="hidden" name="module" value="<?php echo $_GET["module"]; ?>">
			<input type="hidden" name="action" value="<?php echo $_GET["action"]; ?>">
			<input type="text" name="search" value="<?php echo $search; ?>">
			<input type="submit" value="Search">
		</form>
	</div>

	<div class="right">
		<a id="tombol" href="<?php echo BASE_URL . "index.php?page=my_profile&module=barang&action=form"; ?>" >+ Tambah Barang</a>
	</div>
</div>

	<?php

		
		$pagination = isset($_GET['pagination']) ? $_GET['pagination'] : 1;
		$data_halaman = 4;
		$mulai = ($pagination-1)*$data_halaman;

		$where=" ";
		$search_url=" ";

		if ($search) {
		 	$search_url = "&search=$search";
		 	$where="WHERE barang.nama_barang LIKE '%$search%'";
		 } 

		$queryBarang = mysqli_query($koneksi, "SELECT barang.*, kategori.kategori FROM barang JOIN kategori ON barang.kategori_id=kategori.kategori_id $where LIMIT $mulai, $data_halaman");

		if (mysqli_num_rows($queryBarang)==0) {
			echo "<h3>Mohon maaf , data belum terdaftar</h3>";
		}
		else{
			echo "<table class='table-list'>";

				echo "<tr class='baris-title'>
						<th class='kolom-nomor'>No</th>
						<th class='kiri'>Barang</th>
						<th class='kiri'>Kategori</th>
						<th class='kiri'>Harga</th>
						<th class='tengah'>Status</th>
						<th class='tengah'>Action</th>
					</tr>";

				$no=1 + $mulai;
				while ($row=mysqli_fetch_assoc($queryBarang)) {
					
					echo "<tr>

							<td class='kolom-nomor'>$no</td>
							<td class='kiri'>$row[nama_barang]</td>
							<td class='kiri'>$row[kategori]</td>
							<td class='kiri'>".rupiah($row["harga"])."</td>
							<td class='tengah'>$row[status]</td>
							<td class='tengah'>
								<a href='".BASE_URL."index.php?page=my_profile&module=barang&action=form&barang_id=$row[barang_id]'>Edit</a>
								<a href='".BASE_URL."module/barang/action.php?button=Delete&barang_id=$row[barang_id]'>Delete</a>
							</td>

						</tr>";

					$no++;

				}
			echo "</table>";

			$queryHitungKategori = mysqli_query($koneksi, "SELECT * FROM barang $where");
			$total_data = mysqli_num_rows($queryHitungKategori);
			$total_halaman = ceil($total_data/$data_halaman);


			echo "<ul class='pagination'>";
				for ($i=1; $i<=$total_halaman; $i++) { 
					if ($pagination == $i) {
						echo "<li><a class='active' href='".BASE_URL."index.php?page=my_profile&module=barang&action=list$search_url&pagination=$i'>$i</a></li>";
					}
					else{
						echo "<li><a href='".BASE_URL."index.php?page=my_profile&module=barang&action=list&pagination=$i'>$i</a></li>";
					}
					
				}
			echo "</ul>";
		}

	?>

