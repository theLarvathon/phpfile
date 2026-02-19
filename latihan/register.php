<?php 
require "connection.php";

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
<body class="h-screen flex items-center justify-center ">
    <section class="font-sans font-semibold bg-slate-200 p-10 rounded-md">
        <div>
            <h1 class="p-4 text-3xl font-sans font-bold text-gray-700">Halaman Register  📌</h1>
            <?php 
            if(isset($_POST['register'])){
                  if (register($_POST) > 0){
                 echo "<p class=' text-center text-2xl text-green-600  font-semibold my-4 '>Data Sudah Terkirim😊!</p>
             ";
    }

}

            ?>
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
                <label class="block" for="password">Konfirmasi pasword 🔒 :</label>
                <input class="my-2 w-60 border-1 border-black bg-gray-300 rounded-sm p-1"  type="password" name="passwordconfirm" id="password" placeholder="password">
            </div>
            <div  class="flex justify-center">
                <button class="mx-10 my-4 bg-gray-600 text-white rounded-full px-4 p-2 font-semibold"  type="submit" name="register">Register</button>
            </div>
        </form>
    </section>
</body>
</html>