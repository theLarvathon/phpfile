<?php 
session_start();
require '../config/koneksi.php';

if(!isset($_SESSION['id_user'])){
    header('Location: ../public/login.php');
    exit();
}

if(isset($_POST['update'])){
    // get semua data
    $id = (int)$_POST['id'];
    $judul = mysqli_real_escape_string($connect, $_POST['judul']);
    $penulis = mysqli_real_escape_string($connect, $_POST['penulis']);
    $penerbit = mysqli_real_escape_string($connect, $_POST['penerbit']);
    $tahunterbit = mysqli_real_escape_string($connect, $_POST['tahun']);
    $kategori = mysqli_real_escape_string($connect, $_POST['kategori']);
    $lokasirak = mysqli_real_escape_string($connect, $_POST['rak']);
    $stoktotal = (int)$_POST['stok_total']; 
    $stoktersedia = (int)$_POST['stok_tersedia']; 
    $deskripsi = mysqli_real_escape_string($connect, $_POST['deskripsi']);
    $gambar = 'https://placehold.co/400x500'; 
    
    $addbook = mysqli_query($connect,"UPDATE  books SET judul='$judul',penulis='$penulis',penerbit='$penerbit',tahun_terbit='$tahunterbit',stok_total='$stoktotal',stok_tersedia='$stoktersedia',lokasi_rak='$lokasirak',deskripsi='$deskripsi',sampul='$gambar',kategori='$kategori'
     WHERE id_buku = $id");
    
    if($addbook){
        $_SESSION['succes'] = "buku berhasil diubah😁!";
        header('Location: ../admin/kelola_buku.php');
        exit();
        }else{
            
            $_SESSION['error'] = "buku gagal diubah!!!" . mysqli_errno($connect);
            header('Location: ../admin/kelola_buku.php');
            exit();
    }
}
