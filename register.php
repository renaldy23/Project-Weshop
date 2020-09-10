<?php 

if ($user_id) {
	header("location: ".BASE_URL);
}


?>
<div id="container-user-akses">

	<form action="<?php echo BASE_URL ."proses_register.php"; ?>" method="post">
		<?php 
			$notif=isset($_GET['notif']) ? $_GET['notif'] : false;

			if ($notif=="require") {
				echo "<div id='notif'>*Mohon lengkapi seluruh data di bawah ini</div>";
			}
			else if ($notif=="password") {
				echo "<div id='notif'>*Password yang anda masukkan berbeda</div>";
			}
			else if ($notif=="email") {
				echo "<div id='notif'>*Email yang anda masukkan sudah terdaftar</div>";
			}
		?>
		<div class="element-form">
			<label>Nama Lengkap  : </label>
			<span><input type="text" name="nama_lengkap"></span>
		</div>

		<div class="element-form">
			<label>E-mail  : </label>
			<span><input type="text" name="email"></span>
		</div>

		<div class="element-form">
			<label>Telphone / Handpone  : </label>
			<span><input type="text" name="phone" id="phone"></span>
		</div>

		<div class="element-form">
			<label>Alamat  : </label>
			<span><textarea name="alamat"></textarea></span>
		</div>

		<div class="element-form">
			<label>Password  : </label>
			<span><input type="password" name="password" class="input-password" id="pass"></span>
			<input type="checkbox" name="show" id="show">Show Password
		</div>

		<div class="element-form">
			<label>Re-Type Password  : </label>
			<span><input type="password" name="re_password"></span>
		</div>

		<div class="element-form">
			<span><input type="submit" value="SignUp"></input></span>
		</div>

	</form>

</div>
<script type="text/javascript">
	$(document).ready(function () {
	
		$('#show').click(function(){

			if ($(this).is(':checked')) {
				$('#pass').attr('type', 'text');
			}
			else{
				$('#pass').attr('type', 'password');
			}
		});
	
	});
</script>