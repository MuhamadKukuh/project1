<?php 
	include '../controller/controller.php';
	include '../controller/database.php';

	$kelas = mysqli_query($koneksi, "SELECT * FROM kelas");
	$gender= mysqli_query($koneksi, "SELECT * FROM gender");

	if(isset($_POST['register'])){

		if( registrasi($_POST) > 0){
			echo "<script> alert('Registrasi Berhasil') </script>";
		}else{
			echo mysqli_error($koneksi);
		}

	}	

 ?>
<form action="" method="post">
	username<input type="email" name="username"><br><br>
	password<input type="password" name="password"><br><br>
	konfirmasi password<input type="password" name="password2"><br><br>
	nama<input type="text" name="nama"><br><br>
	no_tlp +62<input type="number" name="tlp"><br><br>
	nis<input type="number" name="nis"><br><br>
	<select name="kelas">
		<?php foreach($kelas as $key): ?>
			<option value="<?php echo $key["id_kelas"] ?>"><?php echo $key["kelas"] ?></option>
		<?php endforeach ?>
	</select>
	<select name="gender">
		<?php foreach($gender as $gen): ?>
			<option value="<?php echo $gen["id_gender"] ?>"><?php echo $gen["gender"] ?></option>
		<?php endforeach ?>
	</select>
	<button type="submit" name="register">Register</button>
</form>