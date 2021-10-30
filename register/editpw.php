<?php session_start(); ?>
<form action="../route/web.php" method="post">
	<input type="password" name="password">
	<input type="password" name="password2">
	<button type="submit" value="<?php echo $_SESSION["id"] ?>" name="editpw">Kirim</button>
</form>