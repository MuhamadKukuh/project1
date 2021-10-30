<?php 
	include '../controller/controller.php';

	if(isset($_POST['register'])){
		registrasi($_POST);
	}

	if(isset($_POST['tambah'])){
		tambahSaldo($_POST);
	}

	if(isset($_POST['ubahpw'])){
		ubahPw($_POST);
	}

	if (isset($_POST["editpw"])) {
		editPw($_POST);
	}

	if (isset($_POST["tariksaldo"])){
		tarikSaldo($_POST);
	}

	if (isset($_POST["verifnum"])){
		verifNumber($_POST);
	}

	if (isset($_POST['wd'])) {
		whiteDraw($_POST);
	}

	if (isset($_POST["veriftf"])){
		verifTf($_POST);
	}

	if (isset($_POST["trf"])) {
		tf($_POST);
	}

	if(isset($_POST['ubahprofile'])){
		ubahProfile($_POST);
	}

	// Controller Ubah Foto Peofile
	// if (isset($_POST['ubahprofile'])) {

	// 		$id = $_POST['ubahprofile'];
	// 		$ekstensi_diperbolehkan	= array('png','jpg','jpeg');
	// 		$nama = $_FILES["file"]["name"];
	// 		$x = explode('.', $nama);
	// 		$ekstensi = strtolower(end($x));
	// 		$ukuran	= $_FILES['file']['size'];
	// 		$file_tmp = $_FILES['file']['tmp_name'];	
 
	// 		if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
	// 			if($ukuran < 1044070){			
	// 				move_uploaded_file($file_tmp, '../source/'.$nama);
	// 				$query = mysqli_query($koneksi,"UPDATE register SET gambar='$nama' WHERE id_user=$id");

	// 				if($query){
	// 					header("Location: ../tampilan/profile.php");
	// 				}else{
	// 					echo "<script>
	// 					alert('file Gagal Di upload');
	// 					document.location='../tampilan/ubahprofile.php'
	// 					</script>";
	// 				}
	// 			}else{
	// 				echo "<script>
	// 					alert('file terlalu besar');
	// 					document.location='../tampilan/ubahprofile.php'
	// 					</script>";
	// 			}
	// 		}else{
	// 			echo "<script>
	// 					alert('Tipe file harus gambar');
	// 					document.location='../tampilan/ubahprofile.php'
	// 					</script>";
	// 		}
	// 	}		
?>