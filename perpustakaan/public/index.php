<?php 
include '../includes/header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- cdn css -->
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>
<body class="bg-gray-900 font-sans">

    <section id="hero">
    <div>
        <h1 class="font-bold text-4xl text-center my-8 bg-gradient-to-r from-pink-700 via-indigo-500 to-teal-800 bg-clip-text text-transparent">PERPUSTAKAAN DIGITAL</h1>
    </div>
    <div class="ml-4 space-y-2 text-lg">
        <div class="">
            <h2 class="font-semibold text-gray-400">Selamat datang di perpustakaan digital</h2>
        </div>
        <div>
            <h3 class="font-semibold text-sm text-gray-400">temukan banyak buku ...</h3>
        </div>
    </div>
    </section>
    <section>
        <div>
            <div class="h-16 p-16">
                
                <h2 class="font-semibold bg-gradient-to-r from-pink-950 via-indigo-500 to-teal-900 bg-clip-text text-transparent text-center text-3xl">BUKU TERBARU</h2>
            </div>
        </div>
    </section>

    <?= include '../includes/footer.php' ?> 
</body>
</html>