<?php 
include '../includes/header.php';
include '../config/koneksi.php'
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Perpustakaan Digital</title>
</head>
<body class="bg-gray-900">

    <!-- Hero Section -->
    <section id="hero" class="h-[500px] w-full relative flex items-center" 
        style="background-image: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('../asset/img/perpus.jpg'); background-size: cover; background-position: center;">
        <div class="container mx-auto px-4">
            <h1 class="font-bold text-5xl text-center bg-gradient-to-r from-pink-500 via-indigo-400 to-teal-400 bg-clip-text text-transparent mb-4">DIGITAL LIBRARY</h1>
            <div class="text-center">
                <h2 class="font-semibold text-gray-200 text-3xl mb-2">Selamat datang di perpustakaan digital</h2>
                <h3 class="font-semibold text-2xl text-gray-300">temukan banyak buku ...</h3>
            </div>
        </div>
    </section>

    <!-- Buku Terbaru Section -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            <!-- Header -->
            <div class="text-center mb-10">
                <h2 class="font-bold text-3xl bg-gradient-to-r from-pink-500 via-indigo-400 to-teal-400 bg-clip-text text-transparent inline-block px-6 py-2 border-b-2 border-indigo-500">BUKU TERBARU</h2>
            </div>

            <!-- Grid Buku -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <?php foreach($dbindex as $row):?>
                <!-- Card Buku 1 -->
                <div class="bg-gray-800 rounded-lg overflow-hidden border border-gray-700 hover:border-indigo-500 transition">
                    <div class="h-48 overflow-hidden">
                        <img class="w-full h-full object-cover hover:scale-105 transition duration-500" src="../asset/img/coverbuku.jpg" alt="Cover Buku">
                    </div>
                    <div class="p-4 space-y-2">
                        <h4 class="text-gray-300 text-sm"><span class="text-gray-400">Judul:</span> <?= $row['judul'] ?></h4>
                        <h4 class="text-gray-300 text-sm"><span class="text-gray-400">Penulis:</span> <?= $row['penulis'] ?></h4>
                        <h4 class="text-gray-300 text-sm"><span class="text-gray-400">Penerbit:</span> <?= $row['penerbit'] ?></h4>
                        <h4 class="text-gray-300 text-sm"><span class="text-gray-400">Tahun:</span> <?= $row['tahun_terbit'] ?></h4>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-400">Stok: <span class="text-green-400"><?= $row['stok_total'] ?></span></span>
                            <span class="text-gray-400">Tersedia: <span class="text-yellow-400"><?= $row['stok_tersedia'] ?></span></span>
                        </div>
                        <div class="flex gap-2 pt-2">
                            <a class="flex-1 bg-indigo-600 text-center hover:bg-indigo-700 text-white py-2 px-3 rounded text-sm transition" href="login.php">

                                pinjam
                               
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach;?>
            </div>

            <!-- Button Lihat Semua -->
            <div class="text-center mt-10">
                <a href="daftar_buku.php" class="inline-block bg-gray-800 hover:bg-gray-700 text-white px-8 py-3 rounded-full border border-indigo-500 transition">
                    LIHAT SEMUA BUKU
                </a>
            </div>
        </div>
    </section>

    <!-- Divider -->
    <div class="container mx-auto px-4">
        <div class="w-full h-px bg-gradient-to-r from-transparent via-indigo-500 to-transparent"></div>
    </div>

    <!-- Statistik Section -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-gray-800 rounded-xl p-8 text-center border border-gray-700 hover:border-indigo-500 transition">
                    <div class="text-indigo-400 text-4xl font-bold mb-2"><?= $jumlahbuku ?>+</div>
                    <div class="text-gray-400">Total Buku</div>
                </div>
                <div class="bg-gray-800 rounded-xl p-8 text-center border border-gray-700 hover:border-indigo-500 transition">
                    <div class="text-purple-400 text-4xl font-bold mb-2"><?= $jumlahanggota ?>+</div>
                    <div class="text-gray-400">Anggota</div>
                </div>
                <div class="bg-gray-800 rounded-xl p-8 text-center border border-gray-700 hover:border-indigo-500 transition">
                    <div class="text-green-400 text-4xl font-bold mb-2">1+</div>
                    <div class="text-gray-400">Peminjam</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Divider -->
    <div class="container mx-auto px-4">
        <div class="w-full h-px bg-gradient-to-r from-transparent via-indigo-500 to-transparent"></div>
    </div>

    <?php include '../includes/footer.php' ?> 
</body>
</html>