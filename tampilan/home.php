<?php session_start();
    include '../controller/controller.php';
	include '../source/nav.php';

    if (!isset($_SESSION["Login"])) {
        header("Location: ../register/login.php");
    }

    $id = $_SESSION['id'];

    $data = mysqli_query($koneksi, "SELECT * FROM saldo WHERE id_user=$id");
    $saldo= mysqli_fetch_assoc($data);

    // echo date('l-M-d-Y');

    $rupiah= $saldo["saldo"];

    $form = number_format($rupiah, 0, "",".");

    // echo "Rp.", $form;

    // $coba = mysqli_query($koneksi, "SELECT * FROM saldo");

    // foreach ($coba as $key ) {
    //     $uang = $key["saldo"];
    //     $convert = number_format($uang, 2, ",",".");
    //     echo $convert."<br>";
    // }
 ?>

<div class="text-dark container rounded mt-2" >
    <?php if($saldo["saldo"] == null){ ?>
        <h2 class="mt-3">Rp. 0</h2>
    <?php }else{ ?>
        <h2 class="mt-3">Rp. <?php echo $form ?></h2>
    <?php } ?>
    <form action="nabung.php">
        <button class="pt-1 pb-2 border border-2 border-danger bg-dark rounded text-danger text-center mt-2">Isi Saldo</button>
    </form>
    <form action="tariksaldo.php">
        <button class="text-center pt-1 pb-2 border border-2 border-danger bg-dark rounded text-danger mt-2">Tarik Saldo</button>
    </form>
    <form action="verifikasi.php">
        <button class="pt-1 pb-2 text-center border border-2 border-danger bg-dark rounded text-danger mt-2">Transfer Saldo</button>
    </form>
</div>