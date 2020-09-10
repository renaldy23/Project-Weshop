<div id="frame-tambah">
	
	<a id="tombol" href="<?php echo BASE_URL . "index.php?page=my_profile&module=kategori&action=form"; ?>" >+ Tambah Kategori</a>

	<?php 

	$pagination = isset($_GET['pagination']) ? $_GET['pagination'] : 1;

	$data_halaman = 3;
	$mulai = ($pagination-1)*$data_halaman; 

		$queryKategori = mysqli_query($koneksi, "SELECT * FROM kategori LIMIT $mulai, $data_halaman");

		if (mysqli_num_rows($queryKategori)==0) {
			echo "<h3>Mohon maaf , data belum terdaftar</h3>";
		}
		else{
			echo "<table class='table-list'>";

				echo "<tr class='baris-title'>
						<th class='kolom-nomor'>No</th>
						<th class='kiri'>Kategori</th>
						<th class='tengah'>Status</th>
						<th class='tengah'>Action</th>
					</tr>";

				$no=1;
				while ($row=mysqli_fetch_assoc($queryKategori)) {
					
					echo "<tr>

							<td class='kolom-nomor'>$no</td>
							<td class='kiri'>$row[kategori]</td>
							<td class='tengah'>$row[status]</td>
							<td class='tengah'>
								<a href='".BASE_URL."index.php?page=my_profile&module=kategori&action=form&kategori_id=$row[kategori_id]'>Edit</a>
								<a href='".BASE_URL."module/kategori/action.php?button=Delete&kategori_id=$row[kategori_id]'>Delete</a>
							</td>

						</tr>";

					$no++;

				}
			echo "</table>";

			$queryHitungKategori = mysqli_query($koneksi, "SELECT * FROM kategori");
			$total_data = mysqli_num_rows($queryHitungKategori);
			$total_halaman = ceil($total_data/$data_halaman);


			echo "<ul class='pagination'>";
				for ($i=1; $i<=$total_halaman; $i++) { 
					if ($pagination == $i) {
						echo "<li><a class='active' href='".BASE_URL."index.php?page=my_profile&module=kategori&action=list&pagination=$i'>$i</a></li>";
					}
					else{
						echo "<li><a href='".BASE_URL."index.php?page=my_profile&module=kategori&action=list&pagination=$i'>$i</a></li>";
					}
					
				}
			echo "</ul>";
		}

	?>

</div>