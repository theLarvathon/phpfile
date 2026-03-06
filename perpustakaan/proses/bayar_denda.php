<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require '../config/koneksi.php';
$idpinjam = (int)$_GET['id'];
if(isset($idpinjam)){

    // update table fines
    $updatefines = mysqli_query($connect,"UPDATE fines set status_bayar='lunas',keterangan = 'done',tanggal_bayar = now() WHERE id_pinjam = $idpinjam ");

    if(mysqli_affected_rows($connect) > 0){
         $_SESSION['success'] = "pembayaran berhasil 😁!";
        header('Location: ../users/dashboard.php');
        exit();
    }else{
         $_SESSION['error'] = "Pembayaran Gagal!";
        header('Location: ../users/dashboard.php');
        exit();
    }
}