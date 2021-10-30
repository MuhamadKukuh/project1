<?php 
	session_start();

	$id = $_SESSION['id'];
 ?>
<form action="../route/web.php" method="post"  enctype="multipart/form-data">
	<input type="file" name="file">
	<button type="submit" name="ubahprofile" value="<?php echo $id; ?>">Ubah</button>
</form>