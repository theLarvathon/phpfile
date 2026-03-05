<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
} 
require '../config/koneksi.php';
//get data
$idbuku = (int)$_GET['id'];
$username = mysqli_real_escape_string($connect,$_SESSION['username']);
$id_users = (int)$_SESSION['id_user'];

//cek stok
$dbstok = QuerySelect("SELECT * FROM books WHERE id_buku = $idbuku");
if($dbstok[0]['stok_tersedia'] == 0){
    $_SESSION['stokhabis'] = "stock habis";
    header('Location: ../users/dashboard.php');
    exit();
}
//proses pinjam
if(isset($username) ){
    // CEK APAKAH USER SUDAH MEMINJAM BUKU INI DAN BELUM DIKEMBALIKAN
$cekPeminjaman = QuerySelect("SELECT * FROM loans 
                              WHERE id_buku = $idbuku 
                              AND id_user = '$id_users' 
                              AND status = 'dipinjam'");

    if(!empty($cekPeminjaman)) {
        $_SESSION['errorcek'] = "Anda sudah meminjam buku ini dan belum mengembalikan!";
        header('Location: ../users/dashboard.php');
        exit();
    }
    $dbuser = QuerySelect("SELECT * FROM users WHERE username = '$username'");
    $iduser = $dbuser[0]['id_user'];
    $tenggat = date('Y-m-d',strtotime("+7 days"));
    $sekarang = date('Y-m-d');
    $addloans = mysqli_query($connect,"INSERT INTO loans (id_buku,id_user,tanggal_pinjam,tanggal_tenggat,status) VALUES($idbuku,'$iduser','$sekarang','$tenggat','dipinjam')");
    if($addloans){
        // upgrade pada tabel books
        mysqli_query($connect,"UPDATE books SET stok_tersedia = stok_tersedia - 1 WHERE id_buku = $idbuku");
        // feedback
        $_SESSION['addloanssucces'] = "buku berhasil dipinjam😁!";
        header('Location: ../users/dashboard.php');
        exit();
        }else{
            
        $_SESSION['addloanserror'] = "buku gagal dipinjam!!!" . mysqli_errno($connect);
        header('Location: ../users/dashboard.php');
        exit();
    }


}