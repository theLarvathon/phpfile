<?php 
session_start();


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
        </div>
        <form action="../proses/login_proses.php" method="post">
              <div>
                <label class="block" for="">email 📧:</label>
                <input class="my-2 w-60 border-1 border-black bg-gray-300 rounded-sm p-1" type="email" name="email" placeholder="email" required>
            </div>
            <div>
                <label class="block" for="password">Password 🔒:</label>
                <input class="my-2 w-60 border-1 border-black bg-gray-300 rounded-sm p-1"  type="password" name="password" id="password" placeholder="password"required>
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

      
            <a href="register.php">Buat Akun</a>

        </p>
    </section>
  
</body>
</html>