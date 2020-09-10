<?php  

if ($user_id) {
	if (isset($_GET['module'])) {
		$module = $_GET['module'];
	}
	else{
		false;
	}

	if (isset($_GET['action'])) {
		$action = $_GET['action'];
	}
	else{
		false;
	}

	if (isset($_GET['mode'])) {
		$mode = $_GET['mode'];
	}
	else{
		false;
	}
}
else{
	header("location: ".BASE_URL."index.php?page=login");
}

adminonly($module, $level);

?>
<div id="bg-page-profile">
	
	<div id="menu-profile">
		
		<ul type="square">
			<?php  
				if ($level=="superadmin") {				
			?>
				<li>
					<a <?php if($module=="kategori"){echo "class='active'"; } ?>  href="<?php echo BASE_URL."index.php?page=my_profile&module=kategori&action=list"; ?>">Kategori</a>
				</li>

				<li>
					<a <?php if($module=="barang"){echo "class='active'"; } ?> href="<?php echo BASE_URL."index.php?page=my_profile&module=barang&action=list"; ?>">Barang</a>
				</li>

				<li>
					<a <?php if($module=="kota"){echo "class='active'"; } ?> href="<?php echo BASE_URL."index.php?page=my_profile&module=kota&action=list"; ?>">Kota</a>
				</li>

				<li>
					<a <?php if($module=="user"){echo "class='active'"; } ?> href="<?php echo BASE_URL."index.php?page=my_profile&module=user&action=list"; ?>">User</a>
				</li>

				<li>
					<a <?php if($module=="banner"){echo "class='active'"; } ?> href="<?php echo BASE_URL."index.php?page=my_profile&module=banner&action=list"; ?>">Banner</a>
				</li>
			<?php  
				}
			?>

			<li>
				<a <?php if($module=="pesanan"){echo "class='active'"; } ?> href="<?php echo BASE_URL."index.php?page=my_profile&module=pesanan&action=list"; ?>">Pesanan</a>
			</li>
			
		</ul>

	</div>

	<div id="profile-content">
		<?php  

			$file="module/$module/$action.php";

			if (file_exists($file)) {
				require $file;
			}
			else{
				echo "<h3>404 ERROR</h3>";
			}

		?>
	</div>

</div>