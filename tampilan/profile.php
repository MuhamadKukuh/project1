<?php session_start(); 
	include '../source/nav.php';
	include '../controller/controller.php';

	$id = $_SESSION['id'];

	$db = mysqli_query($koneksi, "SELECT * FROM register WHERE id_user=$id");

	$row = mysqli_fetch_assoc($db);

	$gambar = $row["gambar"];

	$photo = mysqli_query($koneksi, "SELECT * FROM register INNER JOIN gender ON register.id_gender = gender.id_gender WHERE register.id_user = $id");

	$classes = mysqli_query($koneksi, "SELECT	* FROM	register INNER JOIN kelas ON register.id_kelas = kelas.id_kelas WHERE register.id_user = $id");

	$class 	 = mysqli_fetch_assoc($classes);

	$profile = mysqli_fetch_assoc($photo);

?>
<center>
	<?php if($row["gambar"] == null){ ?>
		<img src="<?php echo $profile["avatar"] ; ?>" style="width: 200px; height:200px ;" class="rounded-circle mt-3">
		<form action="ubahprofile.php" method="post" class="mt-3">
			<button type="submit" value="<?php echo $id; ?>" name="ubahProfile">Ubah Profile</button>
		</form>
	<?php }else{ ?>
		<img src="<?php echo"../source/".$row["gambar"]; ?>" style="width: 200px; height:200px ;" class="rounded-circle mt-3">
		<form action="ubahprofile.php" method="post" class="mt-3">
			<button type="submit" value="<?php echo $id; ?>" name="ubahProfile">Ubah Profile</button>
		</form>
	<?php } ?>
	<h3><?php echo $row["nama"]; ?> </h3>
	<p><?php echo $class["kelas"]; ?></p>
	<p>Nis: <?php echo $row["nis"]; ?></p>
	<p>Gender: <?php echo $profile["gender"]; ?></p>
</center>