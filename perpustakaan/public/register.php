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
<body class="h-screen bg-gray-900">
    <section class="h-screen flex items-center justify-center ">

        <section class="font-sans font-semibold bg-slate-200 p-10 rounded-md">
            <div>
            <h1 class="p-4 text-3xl font-sans font-bold text-gray-700">Halaman Register  📌</h1>
        </div>
        <?php if(isset($_SESSION['error'])): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative my-8" role="alert">
                <span class="block sm:inline"><?php echo $_SESSION['error']; ?></span>
            </div>
            <?php unset($_SESSION['error']); ?>
            <?php endif; ?>
            
            <?php if(isset($_SESSION['success'])): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline"><?php echo $_SESSION['success']; ?></span>
                </div>
                <?php unset($_SESSION['success']); ?>
                <?php endif; ?>
                <form action="../proses/register_proses.php" method="post">
                    <div>
                        <label class="block" for="">Username 👤:</label>
                        <input class="my-2 w-60 border-1 border-black bg-gray-300 rounded-sm p-1" type="text" name="username" placeholder="username" required>
                    </div>
                    <div>
                        <label class="block" for="">email 📧:</label>
                        <input class="my-2 w-60 border-1 border-black bg-gray-300 rounded-sm p-1" type="email" name="email" placeholder="email"required>
                    </div>
            <div>
                <label class="block" for="">alamat 📍:</label>
                <input class="my-2 w-60 border-1 border-black bg-gray-300 rounded-sm p-1" type="text" name="alamat" placeholder="Alamat"required>
            </div>
            <div>
                <label class="block" for="">No Telp📱:</label>
                <input class="my-2 w-60 border-1 border-black bg-gray-300 rounded-sm p-1" type="text" name="notelp" placeholder="No Telp"require>
            </div>
            <div>
                <label class="block" for="password">Password 🔒:</label>
                <input class="my-2 w-60 border-1 border-black bg-gray-300 rounded-sm p-1"  type="password" name="password" id="password" placeholder="password"required>
            </div>
            <div>
                <label class="block" for="password">Konfirmasi pasword 🔒 :</label>
                <input class="my-2 w-60 border-1 border-black bg-gray-300 rounded-sm p-1"  type="password" name="passwordconfirm" id="password" placeholder="password"require>
            </div>
            <div  class="flex justify-center">
                <button class="mx-10 my-4 bg-gray-600 text-white rounded-full px-4 p-2 font-semibold"  type="submit" name="register">Register</button>
            </div>
        </form>
        <p class="font-semibold font-sans text-steal-100 text-end"><a href="../public/login.php">sudah punya akun?</a></p>
    </section>
</section>
    <?= include '../includes/footer.php'; ?>
</body>
</html>