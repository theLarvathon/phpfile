<?php 
session_start();
require 'connection.php';

//cek cookie
if(isset($_COOKIE['id']) && isset($_COOKIE['key'])){
    //inisialisasi
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];
    $ress = mysqli_query($connect,"SELECT * FROM users WHERE id = $id");
    $rows = mysqli_fetch_assoc($ress);
    if($id === $rows['id']&&$key === hash('sha256',$rows['username'])){
        $_SESSION['login'] = true;
        }

}



if (isset($_SESSION['login'])){
    header('Location: index.php');
    exit;
}
if (isset($_POST['login'])){
    // inisialisasi
    $username = $_POST['username'];
    $password = $_POST['password'];
    //ambil data dari database
    $res = mysqli_query($connect,"SELECT * FROM users WHERE username = '$username'");

    // validasi username
    if(mysqli_num_rows($res) > 0 ){
        // validasi password
        $row = mysqli_fetch_assoc($res);
        if (password_verify($password, $row['password'])){
            // create cookie
            if (isset($_POST['remember'])){
                setcookie('id',$row['id'],time()+60);
                setcookie('key',hash('sha256',$row['username']),time()+60);
            }
            // create session
            $_SESSION['login'] = true;

            //arahkan ke page index
            header('Location: index.php');
            exit;
        }
    }
 $error = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- cdn css -->
     <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Register</title>
</head>
<body class="h-screen flex items-center justify-center bg-gray-900">
    <section class="font-sans font-semibold bg-slate-200 p-10 rounded-md">
        <div>
            <h1 class="p-4 text-3xl font-sans font-bold text-gray-700">Halaman Login  📌</h1>
        </div>
        <div>
            <?php if(isset($error)){?>
            <p class="text-red-700 font-semibold italic">Login gagal!!</p>
            <?php }?>
        </div>
        <form action="" method="post">
            <div>
                <label class="block" for="">Username 👤:</label>
                <input class="my-2 w-60 border-1 border-black bg-gray-300 rounded-sm p-1" type="text" name="username" placeholder="username">
            </div>
            <div>
                <label class="block" for="password">Password 🔒:</label>
                <input class="my-2 w-60 border-1 border-black bg-gray-300 rounded-sm p-1"  type="password" name="password" id="password" placeholder="password">
            </div>
            <div>
                <input type="checkbox" name="remember">
                <label for="">remember me</label>
            </div>
            <div  class="flex justify-center">
                <button class="mx-10 my-4 bg-gray-600 text-white rounded-full px-4 p-2 font-semibold"  type="submit" name="login">Login</button>
            </div>
        </form>
        <p class="font-semibold font-sans text-steal-100 text-end">

        <?php if(!isset($_SESSION['login'])){?>
            <a href="register.php">Buat Akun</a>
        <?php }?>
        </p>
    </section>
</body>
</html>