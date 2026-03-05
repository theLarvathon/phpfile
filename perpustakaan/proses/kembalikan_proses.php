<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require '../config/koneksi.php';


// get id buku
$idbuku = (int)$_GET['id'];
if(isset($idbuku)){
    //proses pengembalian buku
    $updateloans = mysqli_query($connect,"UPDATE loans SET status = 'dikembalikan' WHERE id_buku = $idbuku");
    if(mysqli_affected_rows($connect) > 0){
        // upgrade pada tabel books
        mysqli_query($connect,"UPDATE books SET stok_tersedia = stok_tersedia + 1 WHERE id_buku = $idbuku");
        
        $_SESSION['returnloanssucces'] = "buku berhasil dikembalikan😁!";
        header('Location: ../users/dashboard.php');
        exit();
        }else{
            
        $_SESSION['returnloanserror'] = "buku gagal dikembalikan!!!" . mysqli_errno($connect);
        header('Location: ../users/dashboard.php');
        exit();
    }
    


}


