<?php  

$pesanan_id = $_GET['pesanan_id'];

$query = mysqli_query($koneksi, "SELECT status FROM pesanan WHERE pesanan_id='$pesanan_id'");
$row = mysqli_fetch_assoc($query);
$status = $row['status'];

?>

<form action="<?php echo BASE_URL."module/pesanan/action.php?pesanan_id=$pesanan_id"; ?>" method="POST">
	
	<div class="form">
		<label>Pesanan Id (Faktur Id)</label>
		<span><input type="text" name="pesanan_id" value="<?php echo $pesanan_id; ?>" readonly="true"></span>
	</div>

	<div class="element-form">
		<label>Status</label>
		<span>
			<select name="status">
				<?php  
					foreach ($arrayStatusPesanan as $key => $value) {
						if ($status == $key) {
							echo "<option value='$key' selected='true'>$value</option>";
						}
						else{
							echo "<option value='$key'>$value</option>";
						}	
					}

				?>
			</select>
		</span>
	</div>

	<div class="element-form">
		<span><input class="tombol" type="submit" name="button" value="Edit Status"></span>
	</div>	

</form>