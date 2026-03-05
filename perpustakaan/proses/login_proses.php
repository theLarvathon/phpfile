<?php 
session_start();
require '../config/koneksi.php';

if(isset($_POST['login'])){
    // ambil data
    $email = $_POST['email'];
    $password = $_POST['password'];
    $db = mysqli_query($connect,"SELECT * FROM users WHERE email = '$email'");
    // validasi data
    if (mysqli_num_rows($db) > 0){
        $row = mysqli_fetch_assoc($db);
        if(password_verify($password,$row['password'])){
            $tanggal_baru = mysqli_query($connect,"SELECT tanggal_daftar FROM users WHERE email = '$email'");
            $username = mysqli_query($connect,"SELECT username FROM users WHERE email = '$email'");
            $row_tanggal = mysqli_fetch_assoc($tanggal_baru);
            $row_username = mysqli_fetch_assoc($username);
            //set session untuk halaman dashboard
            if(isset($row_tanggal)&&isset($row_username)){
                $_SESSION['tanggal'] = $row_tanggal['tanggal_daftar'];
                $_SESSION['username'] = $row_username['username'];
                }
            $_SESSION['login'] = true;
            $_SESSION['role'] = $row['role'];
            $_SESSION['id_user'] = $row['id_user'];
            header('location: ../users/dashboard.php');
            exit();
            }else{
                header('Location: ../public/login.php');
                exit();

            }
        }else{
            header('Location: ../public/login.php');
            exit();
        }
            
    }
    
            

?>