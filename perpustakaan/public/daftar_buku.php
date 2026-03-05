<?php
session_start();
require '../config/koneksi.php';
// Halaman publik, tidak perlu cek session
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Buku · Syafik Library</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        dark: {
                            100: '#1e1e2e',
                            200: '#2d2d3a',
                            300: '#3b3b4a',
                            400: '#4a4a5a',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body { background: #0f0f17; }
        .card-hover { transition: all 0.2s ease; }
        .card-hover:hover { transform: translateY(-2px); box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.5); }
    </style>
</head>
<body class="text-gray-200">

    <!-- NAVBAR (sama persis dengan dashboard) -->
    <nav class="bg-dark-200 border-b border-dark-300 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo & Brand -->
                <div class="flex items-center space-x-3">
                    <span class="text-2xl font-bold bg-gradient-to-r from-blue-400 to-purple-500 text-transparent bg-clip-text">Syafik</span>
                    <span class="text-gray-400 text-sm hidden sm:inline">· Digital Library</span>
                </div>

                <!-- Search Bar (Desktop) -->
                <div class="hidden md:block flex-1 max-w-md mx-8">
                    <div class="relative">
                        <input type="text" placeholder="Cari judul buku, penulis..." 
                               class="w-full bg-dark-300 border border-dark-400 rounded-lg py-2 pl-10 pr-4 text-sm focus:outline-none focus:border-blue-500 transition">
                        <svg class="absolute left-3 top-2.5 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>

                <!-- Right Menu - Bedanya: tombol Login/Register untuk publik -->
                <div class="flex items-center space-x-3">
                    <a href="login.php" class="text-gray-300 hover:text-white px-3 py-2 text-sm font-medium transition">Masuk</a>
                    <a href="register.php" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">Daftar</a>
                </div>
            </div>

            <!-- Mobile Search -->
            <div class="md:hidden pb-3">
                <div class="relative">
                    <input type="text" placeholder="Cari buku..." 
                           class="w-full bg-dark-300 border border-dark-400 rounded-lg py-2 pl-10 pr-4 text-sm">
                    <svg class="absolute left-3 top-2.5 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </nav>

    <!-- HEADER HALAMAN -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold">Katalog Buku</h1>
                <p class="text-gray-400 mt-1">Temukan koleksi digital perpustakaan Syafik</p>
            </div>
            <!-- Filter chips -->
            <div class="flex gap-2 mt-4 md:mt-0">
                <span class="text-xs px-4 py-2 bg-dark-200 rounded-lg text-blue-400 border border-blue-500/30">Semua</span>
                <span class="text-xs px-4 py-2 bg-dark-200 rounded-lg text-gray-400 hover:bg-dark-300 transition cursor-default">Fiksi</span>
                <span class="text-xs px-4 py-2 bg-dark-200 rounded-lg text-gray-400 hover:bg-dark-300 transition cursor-default">Nonfiksi</span>
                <span class="text-xs px-4 py-2 bg-dark-200 rounded-lg text-gray-400 hover:bg-dark-300 transition cursor-default">Teknologi</span>
            </div>
        </div>
    </div>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">

        <!-- GRID BUKU 5 KOLOM (seperti rekomendasi di dashboard) -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
            
            <?php foreach ($dbpaginationbuku as $row) { ?>
                
                <!-- Card Buku  -->
                <div class="bg-dark-200 rounded-xl border border-dark-300 p-3 card-hover">
                    <img src="<?= $row['sampul'] ?>" class="aspect-[3/4] bg-dark-400 rounded-lg mb-2 flex items-center justify-center text-4xl"></img>
                    <h3 class="font-semibold text-sm truncate"><?= $row['judul'] ?></h3>
                    <p class="text-xs text-gray-400 truncate"><?= $row['penulis'] ?></p>
                    <div class="mt-2 flex items-center justify-between">
                    <span class="text-xs text-green-400">Tersedia</span>
                    <span class="text-xs text-gray-400"><?= $row['tahun_terbit'] ?></span>
                    </div>
                    <a href="detail_buku.php?id=<?= $row['id_buku'] ?>">

                        <button class="w-full mt-2 text-xs bg-blue-600 hover:bg-blue-700 px-2 py-1.5 rounded transition">Detail</button>
                    </a>
                    </div>
                    
                   <?php  } ?>
            
        </main>

        <!-- PAGINATION (seperti style dashboard) -->
        <div class="flex justify-center items-center space-x-2 mt-8">
             <?php if($pageaktif > 1){?>
                    <a class="w-8 h-8 flex items-center justify-center bg-dark-200 rounded-lg text-gray-400 hover:bg-dark-300 transition cursor-default"href="?halaman=<?= $pageaktif - 1 ?>">&laquo;</a>
                    <?php }?>
                    <?php for($i=1;$i<=$jumlahpage; $i++){?>
                    <?php if($pageaktif == $i){?>
                    <a class="w-8 h-8 flex items-center justify-center bg-dark-300 rounded-lg text-blue-400 border border-blue-500/30" href="?halaman=<?= $i ?>"><?= $i ?></a>
                    <?php }else{?>
                    <a class="w-8 h-8 flex items-center justify-center bg-dark-200 rounded-lg text-gray-400 hover:bg-dark-300 transition cursor-default"href="?halaman=<?= $i ?>" ><?= $i ?></a>
                    <?php }?>
                    <?php }?>
                    <?php if($pageaktif < $jumlahpage){?>
                    <a class="w-8 h-8 flex items-center justify-center bg-dark-200 rounded-lg text-gray-400 hover:bg-dark-300 transition cursor-default"href="?halaman=<?= $pageaktif + 1 ?>">&raquo;</a>
                    <?php }?>
        </div>

    <!-- FOOTER -->
    <footer class="border-t border-dark-300 mt-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <p class="text-gray-500 text-xs text-center">© 2025 Syafik · Digital Library. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>