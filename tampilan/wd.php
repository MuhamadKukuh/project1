<?php 
	session_start();

	$id = $_SESSION["id"];

	if(!isset($_SESSION["cocok"])){
		header("Location: home.php");
	}
 ?>

<form action="../route/web.php" method="post">
	<input type="number" name="saldo">
	<button type="submit" value="<?php echo $id; ?>" name="wd" >Kirim</button>
</form>