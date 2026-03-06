<?php
session_start();
require '../config/koneksi.php';
// Cek session login (aktifkan nanti)
// if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'anggota') {
//     header('Location: ../public/login.php');
//     exit();
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog · Perpustakaan</title>
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

    <!-- NAVBAR (sama dengan dashboard) -->
    <nav class="bg-dark-200 border-b border-dark-300 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-3">
                    <span class="text-2xl font-bold bg-gradient-to-r from-blue-400 to-purple-500 text-transparent bg-clip-text">Syafik</span>
                    <span class="text-gray-400 text-sm hidden sm:inline">· Katalog Buku</span>
                </div>
                 <div class="hidden md:flex items-center space-x-6">
                    <a href="dashboard.php" class="text-gray-400 hover:text-white text-sm transition">Dashboard</a>
                    <a href="katalog.php" class="text-white text-sm border-b border-blue-500 pb-1">Katalog</a>
                    <a href="peminjaman_saya.php" class="text-gray-400 hover:text-white text-sm transition">Peminjaman</a>
                    <a href="denda.php" class="text-gray-400 hover:text-white text-sm transition ">Denda</a>
                </div>
                <div class="flex items-center space-x-4">
                    <button class="p-2 hover:bg-dark-300 rounded-lg transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="md:hidden pb-3">
                <div class="relative">
                    <input type="text" placeholder="Cari buku..." class="w-full bg-dark-300 border border-dark-400 rounded-lg py-2 pl-10 pr-4 text-sm">
                    <svg class="absolute left-3 top-2.5 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Breadcrumb -->
        <div class="text-sm text-gray-400 mb-6">
            <a href="dashboard.php" class="hover:text-blue-400">Dashboard</a> <span class="mx-2">/</span>
            <span class="text-gray-200">Katalog Buku</span>
        </div>

        <h1 class="text-2xl md:text-3xl font-bold mb-6">Jelajahi Koleksi Buku</h1>
        
        <!-- Search Bar Besar (Mobile) -->
        <div class="mb-8 md:hidden">
            <div class="relative">
                <input type="text" placeholder="Cari judul, penulis, penerbit..." 
                       class="w-full bg-dark-200 border border-dark-300 rounded-xl py-3 pl-12 pr-4 text-sm focus:outline-none focus:border-blue-500 transition">
                <svg class="absolute left-4 top-3.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-6">
            
            <!-- SIDEBAR FILTER -->
            <div class="lg:w-1/4 my-12">
                <div class="bg-dark-200 rounded-xl border border-dark-300 p-5 sticky top-24">
                    <h3 class="font-semibold text-lg mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                        </svg>
                        Filter
                    </h3>
                    
                    <!-- Kategori -->
                    <div class="mb-5">
                        <h4 class="text-sm font-medium text-gray-300 mb-2">Kategori</h4>
                        <div class="space-y-2">
                            <label class="flex items-center text-sm">
                                <input type="checkbox" class="rounded bg-dark-300 border-dark-400 text-blue-500 focus:ring-blue-500 focus:ring-offset-0">
                                <span class="ml-2">Semua</span>
                            </label>
                            <label class="flex items-center text-sm">
                                <input type="checkbox" class="rounded bg-dark-300 border-dark-400 text-blue-500">
                                <span class="ml-2">Fiksi</span>
                            </label>
                            <label class="flex items-center text-sm">
                                <input type="checkbox" class="rounded bg-dark-300 border-dark-400 text-blue-500">
                                <span class="ml-2">Non-Fiksi</span>
                            </label>
                            <label class="flex items-center text-sm">
                                <input type="checkbox" class="rounded bg-dark-300 border-dark-400 text-blue-500">
                                <span class="ml-2">Teknologi</span>
                            </label>
                            <label class="flex items-center text-sm">
                                <input type="checkbox" class="rounded bg-dark-300 border-dark-400 text-blue-500">
                                <span class="ml-2">Sejarah</span>
                            </label>
                            <label class="flex items-center text-sm">
                                <input type="checkbox" class="rounded bg-dark-300 border-dark-400 text-blue-500">
                                <span class="ml-2">Bisnis</span>
                            </label>
                        </div>
                    </div>

                    <!-- Penerbit -->
                    <div class="mb-5">
                        <h4 class="text-sm font-medium text-gray-300 mb-2">Penerbit</h4>
                        <select class="w-full bg-dark-300 border border-dark-400 rounded-lg px-3 py-2 text-sm">
                            <option>Semua Penerbit</option>
                            <option>Gramedia</option>
                            <option>Andi Offset</option>
                            <option>Erlangga</option>
                            <option>Elex Media</option>
                        </select>
                    </div>

                    <!-- Tahun -->
                    <div class="mb-5">
                        <h4 class="text-sm font-medium text-gray-300 mb-2">Tahun Terbit</h4>
                        <div class="flex items-center space-x-2">
                            <input type="number" placeholder="Dari" class="w-1/2 bg-dark-300 border border-dark-400 rounded-lg px-3 py-2 text-sm">
                            <span>-</span>
                            <input type="number" placeholder="Sampai" class="w-1/2 bg-dark-300 border border-dark-400 rounded-lg px-3 py-2 text-sm">
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="mb-6">
                        <h4 class="text-sm font-medium text-gray-300 mb-2">Status</h4>
                        <div class="space-y-2">
                            <label class="flex items-center text-sm">
                                <input type="radio" name="status" class="bg-dark-300 border-dark-400 text-blue-500 focus:ring-blue-500" checked>
                                <span class="ml-2">Semua</span>
                            </label>
                            <label class="flex items-center text-sm">
                                <input type="radio" name="status" class="bg-dark-300 border-dark-400 text-blue-500">
                                <span class="ml-2">Tersedia</span>
                            </label>
                            <label class="flex items-center text-sm">
                                <input type="radio" name="status" class="bg-dark-300 border-dark-400 text-blue-500">
                                <span class="ml-2">Dipinjam</span>
                            </label>
                        </div>
                    </div>

                    <button class="w-full bg-blue-600 hover:bg-blue-700 text-white rounded-lg py-2.5 text-sm font-medium transition">
                        Terapkan Filter
                    </button>
                    <button class="w-full mt-2 border border-dark-400 hover:bg-dark-300 rounded-lg py-2.5 text-sm transition">
                        Reset
                    </button>
                </div>
            </div>

            <!-- GRID BUKU -->
            <div class="lg:w-3/4">
                <!-- Info & Sorting -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4">
                    <p class="text-sm text-gray-400 mb-2 sm:mb-0">Menampilkan <span class="text-white">1-12</span> dari <span class="text-white">128</span> buku</p>
                    <div class="flex items-center space-x-2">
                        <span class="text-sm text-gray-400">Urutkan:</span>
                        <select class="bg-dark-200 border border-dark-300 rounded-lg px-3 py-1.5 text-sm">
                            <option>Terbaru</option>
                            <option>Judul A-Z</option>
                            <option>Judul Z-A</option>
                            <option>Penulis</option>
                            <option>Paling Populer</option>
                        </select>
                    </div>
                </div>

                <!-- Grid 4 Kolom -->
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        <?php foreach($dbpaginationbukuktlg as $row):?>
                        <!-- Buku 1 -->
                        <div class="bg-dark-200 rounded-xl border border-dark-300 p-3 card-hover">
                            <img class="aspect-[3/4] bg-dark-400 rounded-lg mb-2 flex items-center justify-center text-4xl" src="<?= $row['sampul'] ?>"></img>
                            <h3 class="font-semibold text-sm truncate"><?= $row['judul'] ?></h3>
                            <p class="text-xs text-gray-400 truncate"><?= $row['penulis'] ?></p>
                            <div class="mt-2 flex items-center justify-between">
                                <span class="text-xs text-green-400">Tersedia (<?= $row['stok_tersedia'] ?>)</span>
                                <a href="detail_buku.php?id=<?= $row['id_buku'] ?>" class="text-xs bg-blue-600 hover:bg-blue-700 px-2 py-1 rounded transition">Pinjam</a>
                            </div>
                        </div>
                        <?php endforeach;?>
                    </div>

                <!-- PAGINATION -->
                <div class="mt-8 flex justify-center">
                    <nav class="flex items-center space-x-2">
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
                    </nav>
                </div>
            </div>
        </div>
    </main>

    <?php echo include '../includes/footer.php' ?>
</body>
</html>