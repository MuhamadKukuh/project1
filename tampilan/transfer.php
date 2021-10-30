<?php 
	session_start();
	include '../controller/database.php';
	$id2= $_SESSION['id'];

	$id = $_SESSION['oke'];

	$db = mysqli_query($koneksi, "SELECT * FROM register WHERE id_user = $id");

	$row= mysqli_fetch_assoc($db);

 ?>

 <h1><?php echo $row["nama"]; ?></h1>
<form action="../route/web.php" method="post">
	<input type="number" hidden="" name="id2" value="<?php echo $id2; ?>">
	<input type="number" name="saldotrf">
	<button type="submit" value="<?php echo $id ?>" name="trf">Kirim</button>
</form>

