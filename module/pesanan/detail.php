<?php  

$pesanan_id = $_GET['pesanan_id'];

$query = mysqli_query($koneksi, "SELECT pesanan.nama_penerima, pesanan.nomor_telepon, pesanan.alamat, pesanan.tanggal_pemesanan, user.nama, kota.kota, kota.tarif FROM pesanan JOIN user ON pesanan.user_id=user.user_id JOIN kota ON kota.kota_id=pesanan.kota_id WHERE pesanan.pesanan_id='$pesanan_id'");

$row=mysqli_fetch_assoc($query);

$tanggal_pesanan = $row['tanggal_pemesanan'];
$nama_penerima = $row['nama_penerima'];
$nomor_telepon = $row['nomor_telepon'];
$alamat = $row['alamat'];
$tarif = $row['tarif'];
$nama = $row['nama'];
$kota = $row['kota'];

?>

<div id="frame-faktur">
	<h3><center>Detai Pesanan</center></h3>

	<hr/>

	<table>
		<tr>
			<td>Nomor Faktur</td>
			<td>:</td>
			<td><?php echo $pesanan_id; ?></td>
		</tr>

		<tr>
			<td>Nama Pemesan</td>
			<td>:</td>
			<td><?php echo $nama; ?></td>
		</tr>

		<tr>
			<td>Nama Penerima</td>
			<td>:</td>
			<td><?php echo $nama_penerima; ?></td>
		</tr>

		<tr>
			<td>Alamat</td>
			<td>:</td>
			<td><?php echo $alamat; ?></td>
		</tr>

		<tr>
			<td>Nomor Telepon</td>
			<td>:</td>
			<td><?php echo $nomor_telepon; ?></td>
		</tr>

		<tr>
			<td>Tanggal Pemesanan</td>
			<td>:</td>
			<td><?php echo $tanggal_pesanan; ?></td>
		</tr>
	</table>
</div>

<table class="table-list">
	<tr class="baris-title">
		<th class="no">No</th>
		<th class="kiri">Nama Barang</th>
		<th class="tengah">QTY</th>
		<th class="kanan">Harga</th>
		<th class="kanan">Total</th>
	</tr>

	<?php  
		$queryDetail = mysqli_query($koneksi, "SELECT pesanan_detail.*, barang.nama_barang FROM pesanan_detail JOIN barang ON pesanan_detail.barang_id=barang.barang_id WHERE pesanan_detail.pesanan_id='$pesanan_id'");

		$no=1;
		$subtotal = 0;
		while ($row_detail = mysqli_fetch_assoc($queryDetail)) {

		$harga=$row_detail['harga'];
		$quantity=$row_detail['quantity'];

		$total = $harga*$quantity;
		$subtotal = $subtotal + $total;
			
			echo "<tr>
					<td class='no'>$no</td>
					<td class='kiri'>$row_detail[nama_barang]</td>
					<td class='tengah'>$row_detail[quantity]</td>
					<td class='kanan'>".rupiah($row_detail["harga"])."</td>
					<td class='kanan'>".rupiah($total)."</td>
				</tr>";

			$no++;	
		}

		$subtotal = $subtotal + $tarif;

	?>	

	<tr>
		<td class="kanan" colspan="4">Biaya Pengiriman</td>
		<td class="kanan"><?php echo rupiah($tarif); ?></td>
	</tr>

	<tr>
		<td class="kanan" colspan="4">Sub Total</td>
		<td class="kanan"><?php echo rupiah($subtotal); ?></td>
	</tr>
</table>

<div id="frame-keterangan">
	<p>
		<a href="<?php echo BASE_URL."index.php?page=my_profile&module=pesanan&action=konfirmasi_pembayaran&pesanan_id=$pesanan_id"; ?>">Lakukan Pembayaran</a></br>
		Nomor Rekening : 0000-0008-9888 (A/N WESHOP)</br>
	</p>
</div>