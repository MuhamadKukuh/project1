<?php session_start(); ?>
<form action="../route/web.php" method="post">
	Masukan Saldo : 
	<input type="number" name="saldo">
	<button type="submit" name="tambah" value="<?php echo $_SESSION['id'] ?>">Kirim</button>
</form>