<?php

$pagination = isset($_GET['pagination']) ? $_GET['pagination'] : 1;

$data_halaman = 3;
$mulai = ($pagination-1)*$data_halaman; 

if ($level == "superadmin") {
  	$queryPesanan = mysqli_query($koneksi, "SELECT pesanan.*, user.nama FROM pesanan JOIN user ON pesanan.user_id=user.user_id ORDER BY pesanan.tanggal_pemesanan DESC LIMIT $mulai, $data_halaman");
}
else{

	$queryPesanan = mysqli_query($koneksi, "SELECT pesanan.*, user.nama FROM pesanan JOIN user ON pesanan.user_id=user.user_id WHERE pesanan.user_id='$user_id' ORDER BY pesanan.tanggal_pemesanan DESC LIMIT $mulai, $data_halaman");
}  




if (mysqli_num_rows($queryPesanan)==0) {
	echo "<h3>Saat ini belum ada Data Pesanan</h3>";
}
else{

	echo "<table class='table-list'>
			<tr class='baris-title'>
				<th class='kiri'>Nomor Pesanan</th>
				<th class='kiri'>Status</th>
				<th class='kiri'>Nama</th>
				<th class='kiri'>Action</th>
			</tr>";

	$adminButton = " ";		
	while ($row=mysqli_fetch_assoc($queryPesanan)) {
		if ($level == "superadmin") {
			$adminButton = "<a id='tombol' href='".BASE_URL."index.php?page=my_profile&module=pesanan&action=status&pesanan_id=$row[pesanan_id]'>Update Pesanan</a>";
		}

		$status = $row['status'];
		echo "<tr>
				<td class='kiri'>$row[pesanan_id]</td>
				<td class='kiri'>$arrayStatusPesanan[$status]</td>
				<td class='kiri'>$row[nama]</td>
				<td class='kiri'>
					<a id='tombol' href='".BASE_URL."index.php?page=my_profile&module=pesanan&action=detail&pesanan_id=$row[pesanan_id]'>Detail Pesanan</a>
					$adminButton
				</td>
			</tr>";
	}

	echo "</table>";

	$queryHitungKategori = mysqli_query($koneksi, "SELECT * FROM pesanan");
	$total_data = mysqli_num_rows($queryHitungKategori);
	$total_halaman = ceil($total_data/$data_halaman);


	echo "<ul class='pagination'>";
		for ($i=1; $i<=$total_halaman; $i++) { 
			if ($pagination == $i) {
				echo "<li><a class='active' href='".BASE_URL."index.php?page=my_profile&module=pesanan&action=list&pagination=$i'>$i</a></li>";
			}
			else{
				echo "<li><a href='".BASE_URL."index.php?page=my_profile&module=pesanan&action=list&pagination=$i'>$i</a></li>";
			}
			
		}
	echo "</ul>";
}

?>