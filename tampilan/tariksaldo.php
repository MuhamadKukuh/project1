<?php 
	session_start();

	$id= $_SESSION['id'];
 ?>
<form action="../route/web.php" method="post">
	Masukan No tlp:<input type="number" name="tlp">
	<button type="submit" name="verifnum" value="<?php echo $id; ?>">Kirim</button>
</form>