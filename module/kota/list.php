<div id="frame-tambah">
	<a id="tombol" href="<?php echo BASE_URL."index.php?page=my_profile&module=kota&action=form"; ?>">+ Tambah Kota</a>
</div>

<?php

	$pagination = isset($_GET['pagination']) ? $_GET['pagination'] : 1;

	$data_halaman = 3;
	$mulai = ($pagination-1)*$data_halaman; 

	$queryKota = mysqli_query($koneksi, "SELECT * FROM kota ORDER BY kota ASC LIMIT $mulai, $data_halaman");
	
	if(mysqli_num_rows($queryKota) == 0){
		echo "<h3>Saat ini belum ada nama kota yang didalam database.</h3>";
	}
	else{
		echo "<table class='table-list'>";
		
			echo "<tr class='baris-title'>
					<th class='kolom-nomor'>No</th>
					<th class='kiri'>Kota</th>
					<th class='kiri'>Tarif</th>
					<th class='tengah'>Status</th>
					<th class='tengah'>Action</th>
				 </tr>";
				 
			$no = 1;
			while($rowKota=mysqli_fetch_assoc($queryKota)){
				echo "<tr>
						<td class='kolom-nomor'>$no</td>
						<td>$rowKota[kota]</td>
						<td>".rupiah($rowKota['tarif'])."</td>
						<td class='tengah'>$rowKota[status]</td>
						<td class='tengah'>
							<a class='tombol-action' href='".BASE_URL."index.php?page=my_profile&module=kota&action=form&kota_id=$rowKota[kota_id]"."'>Edit</a>
						</td>
					 </tr>";
				
				$no++;
			}
		
		echo "</table>";

		$queryHitungKategori = mysqli_query($koneksi, "SELECT * FROM kota");
		$total_data = mysqli_num_rows($queryHitungKategori);
		$total_halaman = ceil($total_data/$data_halaman);


		echo "<ul class='pagination'>";
			for ($i=1; $i<=$total_halaman; $i++) { 
				if ($pagination == $i) {
					echo "<li><a class='active' href='".BASE_URL."index.php?page=my_profile&module=kota&action=list&pagination=$i'>$i</a></li>";
				}
				else{
					echo "<li><a href='".BASE_URL."index.php?page=my_profile&module=kota&action=list&pagination=$i'>$i</a></li>";
				}
				
			}
		echo "</ul>";
	}
?>