<?php session_start();
	if (isset($_SESSION["Login"])) {
		header("Location: ../tampilan/home.php");
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>login</title>
	<link rel="stylesheet" type="text/css" href="../bootstrap/style.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body style="background: linear-gradient(to right,#043927,#078d5f, #043927);">
	<?php include '../source/nav.php'; ?>
  <?php if(isset($_SESSION['us'])){ ?>
        <div class="alert bg-danger text-white alert-dismissible fade show" role="alert">
          <strong>Akun Tidak Ditemukan</strong> Mohon Periksa Kembali
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php session_destroy(); ?>
  <?php } ?>
	<div class="container" style="margin-left: 500px;">
		<div class="login-content">
			<form action="../controller/auth.php" method="post">
				<h2 class="text-white">Welcome</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Username</h5>
           		   		<label for="exampleInputEmail1"></label>
           		   		<input type="email" name="username" class="input" id="exampleInputEmail1" required>
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Password</h5>
           		    	<input type="password" name="password" class="input" required>
            	   </div>
            	</div>
            	<a href="changepw.php" style="text-decoration: none; color: white; ">Forgot Password?</a>
            	<button type="submit" class="btn btn-outline-light">login</button>
            </form>
        </div>
    </div>
    <script type="text/javascript" src="main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>