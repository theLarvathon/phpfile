<?php 
session_start();
require '../config/koneksi.php';


if(isset($_POST['register'])){

    // terima semua data / inialisasi
    $username = mysqli_real_escape_string($connect,$_POST['username']);
    $email = mysqli_real_escape_string($connect,$_POST['email']);
    $alamat = mysqli_real_escape_string($connect,$_POST['alamat']);
    $notelp = mysqli_real_escape_string($connect,$_POST['notelp']);
    $password = $_POST['password'];
    $passwordconfirm = $_POST['passwordconfirm'];
    $usernamedb = mysqli_query($connect,"SELECT username FROM users WHERE username = '$username'");
    $db_email = mysqli_query($connect,"SELECT email FROM users WHERE email = '$email'");
    
    // cek username 
    if (mysqli_num_rows($usernamedb) > 0){    
        $_SESSION['error'] = "Nama sudah digunakan!! Harap ubah"; 
        header('location: ../public/register.php');
            exit();
            }
            // cek kesamaan password
            
            if ($password !== $passwordconfirm){
                $_SESSION['error'] = "Password berbeda!! Harap samakan"; 
                header('location: ../public/register.php');
                exit();
                }
                
                // Validasi email
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $_SESSION['error'] = "Format email tidak valid!";
                    header('Location: ../public/register.php');
                    exit();
                    }
                    // cek email 
                    if (mysqli_num_rows($db_email) > 0){
                        $_SESSION['error'] = "Email sudah terdaftar!! Harap gunakan email lain"; 
                        header('location: ../public/register.php');
                        exit();
                        }
                        
                        // Set masa berlaku = TANGGAL REGISTER + 1 TAHUN
                        $sekarang = date('Y-m-d');
                        $masa_berlaku = date('Y-m-d', strtotime('+1 year', strtotime($sekarang)));
                        
                        
                        // encript password
                        $password = password_hash($password, PASSWORD_DEFAULT);
                        // insert ke table users
                        $query_user = "INSERT INTO users VALUES ('','$username','$email','$password','anggota',now(),'aktif')";
                        $insert_user = mysqli_query($connect,$query_user);

                        if($insert_user){
                            //ambil id dari user
                            $new_id = mysqli_insert_id($connect);
                            //insert ke table members
                            $query_members = "INSERT INTO members VALUES ('','$new_id','$alamat','$notelp',now() ,'$masa_berlaku')";
                            $insert_members = mysqli_query($connect,$query_members);
                //feedback ke page register & beri session
                if($insert_members){
                    $dbrole = mysqli_query($connect,"SELECT * FROM users WHERE email = '$email'");
                    $row = mysqli_fetch_assoc($dbrole);
                    mysqli_commit($connect);
                    $_SESSION['username'] = $row['username']; 
                    $_SESSION['tanggal'] = $row['tanggal_daftar']; 
                    $_SESSION['role'] = $row['role']; 
                    $_SESSION['login'] = true;
                    $_SESSION['success'] = "Data Sudah Terkirim😊!";

                    header("Location: ../users/dashboard.php");
                    exit();
                }else{
                    mysqli_rollback($connect);
                    $_SESSION['error'] = "Gagal mendaftar (member): " . mysqli_error($connect);
                    header("Location: ../public/register.php");
                    exit();
                }

            }else{
                mysqli_rollback($connect);
                $_SESSION['error'] = "Gagal mendaftar (user): " . mysqli_error($connect);
                header("Location: ../public/register.php");
                exit();
            }
           
        
                
}
?>