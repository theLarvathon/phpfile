<?php 
session_start();
require '../config/koneksi.php';

if(!isset($_SESSION['id_user'])){
    header('Location: ../public/login.php');
    exit();
}

if(isset($_POST['submit'])){
    // get semua data
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
    $tanggal_input = date('Y-m-d'); 
    
    $addbook = mysqli_query($connect,"INSERT INTO books (judul,penulis,penerbit,tahun_terbit,stok_total,stok_tersedia,lokasi_rak,deskripsi,sampul,tanggal_masuk,kategori) VALUES('$judul','$penulis','$penerbit','$tahunterbit','$stoktotal','$stoktersedia','$lokasirak','$deskripsi','$gambar','$tanggal_input','$kategori')");
    if($addbook){
        $_SESSION['addbooksucces'] = "buku berhasil ditambahkan😁!";
        header('Location: ../admin/tambah_buku.php');
        exit();
        }else{
            
            $_SESSION['addbookerror'] = "buku gagal ditambahkan!!!" . mysqli_errno($connect);
            header('Location: ../admin/tambah_buku.php');
            exit();
    }
}
