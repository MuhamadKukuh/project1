<?php include 'database.php';
	session_start();
	  $username = $_POST['username'];
	  $password = $_POST['password'];

	  $data	= mysqli_query($koneksi, "SELECT * FROM register WHERE username= '$username' ");


	  // var_dump($data);

	  if ( mysqli_num_rows($data) === 1) {
	  	
	  	$row = mysqli_fetch_assoc($data);

	  	if ( password_verify($password, $row["password"]) ) {
	  		$_SESSION['Login'] = true;
	  		$_SESSION["nama"]  = $row['nama'];
	  		$_SESSION["id"]	   = $row['id_user'];
	  		$_SESSION["no_tlp"]= $row['no_tlp'];
	  		$_SESSION["nis"]   = $row['nis'];		
	  		header("Location: ../tampilan/home.php");	
	  		exit;
	  	}else{
	  		$_SESSION['pw'] = false;
			header("Location: ../register/login.php");
	  	}
	}else{
		$_SESSION['us'] = false;
		header("Location: ../register/login.php");
	}

 ?>