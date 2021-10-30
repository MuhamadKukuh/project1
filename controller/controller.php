<?php
	$koneksi = mysqli_connect("localhost", "root", "", "latihan");

function registrasi($data){
global $koneksi;

	$username = $data["username"];
	$password = $data["password"];
	$password2= $data["password2"];
	$nama	  = $data["nama"];
	$nis      = $data["nis"];
	$tlp	  = $data["tlp"];
	$gender	  = $data["gender"];
	$kelas	  = $data["kelas"];

	$hash     = password_hash($password, PASSWORD_DEFAULT);

	$vali = mysqli_query($koneksi, "SELECT no_tlp FROM register WHERE no_tlp='$tlp' ");

	if ( $password !== $password2) {
		echo "<script>alert('Password Tidak Cocok');
		document.location= '../register/register.php' 
		</script>";
		return false;
	}

	if (mysqli_fetch_assoc($vali)) {
		echo "<script>alert('Nomor tlp sudah digunakan');
		document.location= '../register/register.php'
		</script>";
		return false;
	}


    $validation = mysqli_query($koneksi, "SELECT username FROM register WHERE username='$username' ");

    if (mysqli_fetch_assoc($validation)) {
        echo "<script>alert('Username sudah dipakai')</script>";
		return false;
    }else{
        $_SESSION["berhasil"]= true;

        $data = mysqli_query($koneksi,"INSERT INTO register(`nama`, `username`, `password`, `id_kelas`, `no_tlp`, `nis`, `id_gender`) VALUES ('$nama', '$username', '$hash', '$kelas', '$tlp', '$nis', '$gender')");

        header("Location: ../register/login.php");
                exit;
    }
}

function tambahSaldo($data){
	global $koneksi;
	$id = $data["tambah"];

	$saldos = mysqli_query($koneksi, "SELECT * FROM saldo WHERE id_user=$id");

	$saldo = mysqli_fetch_assoc($saldos);

	$input = $data["saldo"];

	$tambahSaldo = $input + $saldo["saldo"];

	if($saldo["saldo"] == null){
		$isi = mysqli_query($koneksi, "INSERT INTO saldo(`saldo`, `id_user`) VALUES ('$input', '$id')");
		header("Location: ../tampilan/home.php");
	}else{
		$tambah = mysqli_query($koneksi, "UPDATE saldo SET saldo='$tambahSaldo' WHERE id_user=$id ");

		header("Location: ../tampilan/home.php");
	}
}

function ubahPw($data){
	global $koneksi;

	$username = $data["username"];
	$tlp 	  = $data["tlp"];

	$db = mysqli_query($koneksi, "SELECT * FROM register WHERE username ='$username' ");

	if (mysqli_num_rows($db) === 1) {
		$row = mysqli_fetch_assoc($db);
		if ($tlp == $row["no_tlp"]) {
			session_start();
			$_SESSION["id"] = $row["id_user"];
			header("Location: ../register/editpw.php"); 
		}
	}else{
		header("Location: ../register/changepw.php");
	}
}

function editPw($data){
	global $koneksi;

	$id 	  = $data["editpw"];
	$password = $data["password"];
	$password2= $data["password2"];

	if($password !== $password2){
		header("Location: ../register/changepw.php");
	}else{
		$hash = password_hash($password, PASSWORD_DEFAULT);	
		$change	= mysqli_query($koneksi, "UPDATE register SET password='$hash' WHERE id_user=$id ");

		header("Location: ../register/login.php");
	}
}

function verifNumber($data){
	global $koneksi;

	$id 	= $data["verifnum"];
	$tlp	= $data["tlp"];

	$db 	= mysqli_query($koneksi, "SELECT * FROM register WHERE id_user=$id");

	$row 	= mysqli_fetch_assoc($db);

	if($row["no_tlp"] == $tlp){
		session_start();
		$_SESSION['cocok'] = true;
		header("Location: ../tampilan/wd.php");
	}else {
		header("Location: ../tampilan/tariksaldo.php");
	}
}

function whiteDraw($data){
	global $koneksi;

	$id 	= $data["wd"];
	$saldo  = $data["saldo"];

	$db 	= mysqli_query($koneksi, "SELECT * FROM saldo WHERE id_user = $id");

	if($saldo < 0){
		header("Location: ../tampilan/home.php");
		exit;
	}

	if(mysqli_num_rows($db) === 1){
		$row= mysqli_fetch_assoc($db);

			if($row["saldo"] > $saldo) {
				$kurang = $row["saldo"] - $saldo;
				$wd 	= mysqli_query($koneksi, "UPDATE saldo SET saldo='$kurang' WHERE id_user=$id");

				if ($wd) {
					echo "<script>alert('WD sukses'); 
					document.location= '../tampilan/home.php'
					</script>";
					// header("Location: ../tampilan/home.php");
				}else{
					echo "<script>alert('Maaf Target Pasarnya Bukan Anda'); 
					document.location= '../tampilan/wd.php'
					</script>";
				}

			}else {
				// header("Location: ../tampilan/wd.php");
				echo "<script>alert('Maaf Saldo Anda Kurang'); 
				document.location= '../tampilan/wd.php'
				</script>";
			}

	}else{
		echo "<script>alert('Maaf Saldo Anda Kurang'); 
		document.location= '../tampilan/wd.php'
		</script>";	
	}
}

function verifTf($data){
	global $koneksi;

	$tlp 	= $data["tlp"];

	$db 	= mysqli_query($koneksi, "SELECT * FROM register WHERE no_tlp=$tlp");

	if(mysqli_num_rows($db) === 1){
		session_start();
		$row 	= mysqli_fetch_assoc($db);
		$_SESSION['oke'] = $row["id_user"];
		header("Location: ../tampilan/transfer.php");
	}else {
		header("Location: ../tampilan/verifikasi.php");
	}
}

function tf($data){
	global $koneksi;

	$id 	= $data["trf"];
	$saldo 	= $data["saldotrf"];
	$id2	= $data["id2"];

	$db 	= mysqli_query($koneksi, "SELECT * FROM saldo WHERE id_user = $id2");


	if (mysqli_num_rows($db) === 1) {
		$row    = mysqli_fetch_assoc($db);
		
		if ($row["saldo"] < $saldo) {
			echo "<script>alert('Maaf Saldo Anda Kurang');
			document.location= '../tampilan/transfer.php'
			</script>";
			return false;
		}elseif ($saldo < 0) {
			echo "<script>alert('Maaf Target Pasarnya Bukan Anda');
			document.location= '../tampilan/transfer.php'
			</script>";

			return false;
		}elseif( $row["saldo"] > $saldo || $row["saldo"] == $saldo ){

			$cek = mysqli_query($koneksi, "SELECT * FROM saldo WHERE id_user = $id");
			if (mysqli_num_rows($cek) === 1) {
				$saldo1 = mysqli_fetch_assoc($cek);
				$tambah = $saldo + $saldo1["saldo"];
				$kurang = $row["saldo"] - $saldo;

				$update = mysqli_query($koneksi, "UPDATE saldo SET saldo='$tambah' WHERE id_user=$id ");
				$kurangi= mysqli_query($koneksi, "UPDATE saldo SET saldo='$kurang' WHERE id_user=$id2");

				if($kurangi && $update){
					echo "<script>alert('Transfer Sukses');
					document.location= '../tampilan/home.php'
					</script>";

					exit;
				}else{
					echo "<script>alert('Lagi Error Keknya');
					document.location= '../tampilan/home.php'
					</script>";
				}
			}elseif(mysqli_num_rows($cek) === 0){
				$isi = mysqli_query($koneksi, "INSERT INTO saldo(`saldo`, `id_user`) VALUES ('$saldo', '$id') ");
				$kurang2=mysqli_query($koneski, "UPDATE saldo SET saldo='$kurangi' WHERE id_user=$id2");
				if ($isi && $kurang2) {
					echo "<script>alert('Transfer Sukses');
					document.location= '../tampilan/home.php'
					</script>";
				}else{
					echo "<script>alert('Lagi Error Keknya');
					document.location= '../tampilan/home.php'
					</script>";
				}
			}else{
				echo "<script>alert('Lagi Error Keknya');
				document.location= '../tampilan/home.php'
				</script>";
			}
		}
	}else{
		echo "<script>alert('Nabung Dulu Kau Babi');
			document.location= '../tampilan/home.php'
			</script>";
	}
}

function ubahProfile($data){
	global $koneksi;
			$id = $data['ubahprofile'];
			$ekstensi_diperbolehkan	= array('png','jpg','jpeg');
			$nama = $_FILES["file"]["name"];
			$x = explode('.', $nama);
			$ekstensi = strtolower(end($x));
			$ukuran	= $_FILES['file']['size'];
			$file_tmp = $_FILES['file']['tmp_name'];	

			if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
				if($ukuran < 1044070){		
					move_uploaded_file($file_tmp, '../source/'.$nama);
					$query = mysqli_query($koneksi,"UPDATE register SET gambar='$nama' WHERE id_user=$id");

					if($query){
						header("Location: ../tampilan/profile.php");
					}else{
						echo "<script>
						alert('file Gagal Di upload');
						document.location='../tampilan/ubahprofile.php'
						</script>";
					}
				}else{
					echo "<script>
						alert('file terlalu besar');
						document.location='../tampilan/ubahprofile.php'
						</script>";
				}
			}else{
				echo "<script>
						alert('Tipe file harus gambar');
						document.location='../tampilan/ubahprofile.php'
						</script>";
			}
}

			
 ?>