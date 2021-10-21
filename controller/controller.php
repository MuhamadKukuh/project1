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
		echo "<script>alert('Password Tidak Cocok')</script>";
		return false;
	}

	if (mysqli_fetch_assoc($vali)) {
		echo "<script>alert('Nomor tlp sudah digunakan')</script>";
		return false;
	}


    $validation = mysqli_query($koneksi, "SELECT username FROM register WHERE username='$username' ");

    if (mysqli_fetch_assoc($validation)) {
        echo "<script>alert('Username sudah dipakai')</script>";
		return false;
    }else{
        $_SESSION["berhasil"]= true;

        $data = mysqli_query($koneksi,"INSERT INTO register(`nama`, `username`, `password`, `id_kelas`, `no_tlp`, `nis`, `id_gender`) VALUES ('$nama', '$username', '$hash', '$kelas', '$tlp', '$nis', '$gender')");

        header("Location: login.php");
                exit;
    }
}


 ?>