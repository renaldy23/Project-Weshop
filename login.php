<?php 

if ($user_id) {
	header("location: ".BASE_URL);
}


?>
<div id="container-user-akses">

	<form action="proses_login.php" method="post">
		<?php 
			$notif=isset($_GET['notif']) ? $_GET['notif'] : false;

			if ($notif=="true") {
				echo "<div id='notif'>*Maaf , Email / Password yang anda masukkan salah </div>";
			}
		?>
		<div class="element-form">
			<label>E-mail  : </label>
			<span><input type="text" name="email"></span>
		</div>

		<div class="element-form">
			<label>Password  : </label>
			<span><input type="password" name="password" class="input-password" id="pass"></span>
			<input type="checkbox" name="show" id="show">Show Password
		</div>

		<div class="element-form">
			<span><input type="submit" value="Login"></input></span>
		</div>

	</form>

</div>
<script type="text/javascript">
	$(document).ready(function () {
	
		$('#show').click(function(){

			if ($(this).is(':checked')) {
				$('#pass').attr('type', 'text');
				// $('#btn').attr('value', 'show');
			}
			else{
				$('#pass').attr('type', 'password');
			}
		});
	
	});
</script>