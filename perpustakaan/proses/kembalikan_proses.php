<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require '../config/koneksi.php';


// get id buku
if(isset($_GET['id'])){
    $idbuku = (int)$_GET['id'];
    //proses pengembalian buku
    $updateloans = mysqli_query($connect,"UPDATE loans 
    SET tanggal_kembali = now(),
    status = CASE 
    WHEN tanggal_tenggat >= now() THEN 'dikembalikan'
    WHEN tanggal_tenggat < now() THEN 'terlambat' 
    END
    WHERE id_buku = $idbuku 
    AND status = 'dipinjam'");
    if(mysqli_affected_rows($connect) > 0 && $updateloans){
        // Insert pada table fines where mengembalikan telat
        $dendaloans = mysqli_query($connect,"INSERT INTO fines (id_pinjam,id_user, jumlah_denda, status_bayar, keterangan)
          SELECT 
            id_pinjam, 
            id_user,
            DATEDIFF(tanggal_kembali, tanggal_tenggat), 
            'belum', 
            'Terlambat'
          FROM loans 
          WHERE id_buku = $idbuku 
          AND tanggal_kembali > tanggal_tenggat
          AND status = 'terlambat'
          ORDER BY tanggal_kembali DESC LIMIT 1");
        // upgrade pada tabel books
        mysqli_query($connect,"UPDATE books SET stok_tersedia = stok_tersedia + 1 WHERE id_buku = $idbuku");
        
        $_SESSION['succes'] = "buku berhasil dikembalikan😁!";
        header('Location: ../users/dashboard.php');
        exit();
        }else{
            
        $_SESSION['error'] = "buku gagal dikembalikan!!!" . mysqli_errno($connect);
        header('Location: ../users/dashboard.php');
        exit();
    }
    


}


