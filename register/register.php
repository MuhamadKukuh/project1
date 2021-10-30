<?php 
	session_start();
	include '../controller/controller.php';
	include '../controller/database.php';

	if(isset($_SESSION["Login"])){
		header("Location: ../tampilan/home.php");
	}

	$kelas = mysqli_query($koneksi, "SELECT * FROM kelas");
	$gender= mysqli_query($koneksi, "SELECT * FROM gender");
 ?>
<form action="../route/web.php" method="post">
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