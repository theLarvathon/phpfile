<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require '../config/koneksi.php';
// if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
//     header('Location: ../public/login.php');
//     exit();
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin · Syafik Library</title>
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

    <!-- NAVBAR ADMIN -->
    <nav class="bg-dark-200 border-b border-dark-300 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo & Brand -->
                <div class="flex items-center space-x-3">
                    <span class="text-2xl font-bold bg-gradient-to-r from-blue-400 to-purple-500 text-transparent bg-clip-text">Syafik</span>
                    <span class="text-gray-400 text-sm hidden sm:inline">· Admin Panel</span>
                </div>

                <!-- Menu Navigasi Admin -->
                <div class="hidden md:flex items-center space-x-6">
                    <a href="dashboard.php" class="text-white text-sm border-b border-blue-500 pb-1">Dashboard</a>
                    <a href="kelola_buku.php" class="text-gray-400 hover:text-white text-sm transition">Kelola Buku</a>
                    <a href="kelola_anggota.php" class="text-gray-400 hover:text-white text-sm transition">Kelola Anggota</a>
                    <a href="laporan.php" class="text-gray-400 hover:text-white text-sm transition">Laporan</a>
                </div>

                <!-- Right Menu -->
                <div class="flex items-center space-x-3">
                    <span class="text-sm text-gray-300">Admin</span>
                    <a href="../proses/logout_proses.php" class="bg-dark-300 hover:bg-dark-400 text-white px-4 py-2 rounded-lg text-sm font-medium transition border border-dark-400">Keluar</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- HEADER HALAMAN -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold">Dashboard Admin</h1>
                <p class="text-gray-400 mt-1">Selamat datang kembali, Admin</p>
            </div>
            <div class="mt-4 md:mt-0">
                <span class="text-sm bg-blue-600/20 text-blue-400 px-4 py-2 rounded-lg border border-blue-500/30">
                    <?= date('l, d F Y') ?>
                </span>
            </div>
        </div>
    </div>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">

        <!-- STATISTIK CARD (4 kolom) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div class="bg-dark-200 rounded-xl border border-dark-300 p-5 card-hover">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-400 text-sm">Total Buku</p>
                        <p class="text-3xl font-bold text-blue-400 mt-1"><?= $jumlahbuku ?></p>
                    </div>
                    <div class="w-12 h-12 bg-blue-600/20 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-dark-200 rounded-xl border border-dark-300 p-5 card-hover">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-400 text-sm">Total Anggota</p>
                        <p class="text-3xl font-bold text-purple-400 mt-1"><?= $jumlahanggota ?></p>
                    </div>
                    <div class="w-12 h-12 bg-purple-600/20 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-dark-200 rounded-xl border border-dark-300 p-5 card-hover">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-400 text-sm">Peminjaman Aktif</p>
                        <p class="text-3xl font-bold text-yellow-400 mt-1"><?= $totalpeminjamanaktif ?></p>
                    </div>
                    <div class="w-12 h-12 bg-yellow-600/20 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-dark-200 rounded-xl border border-dark-300 p-5 card-hover">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-400 text-sm">Peminjaman Terlambat</p>
                        <p class="text-3xl font-bold text-red-400 mt-1">1<?= $totalpeminjamanterlambat ?>2</p>
                    </div>
                    <div class="w-12 h-12 bg-red-600/20 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- GRAFIK SEDERHANA (aktivitas 7 hari terakhir) -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <div class="lg:col-span-2 bg-dark-200 rounded-xl border border-dark-300 p-5">
                <h2 class="text-lg font-semibold mb-4 flex items-center">
                    <span class="w-1 h-5 bg-blue-500 rounded-full mr-3"></span>
                    Aktivitas Peminjaman (7 Hari Terakhir)
                </h2>
                <div class="h-48 flex items-end justify-between gap-2">
                    <!-- Bar chart sederhana -->
                    <div class="w-full flex items-end justify-around">
                        <div class="flex flex-col items-center w-10">
                            <div class="w-8 bg-blue-500/80 rounded-t" style="height: 80px"></div>
                            <span class="text-xs text-gray-400 mt-2">Sen</span>
                        </div>
                        <div class="flex flex-col items-center w-10">
                            <div class="w-8 bg-blue-500/80 rounded-t" style="height: 65px"></div>
                            <span class="text-xs text-gray-400 mt-2">Sel</span>
                        </div>
                        <div class="flex flex-col items-center w-10">
                            <div class="w-8 bg-blue-500/80 rounded-t" style="height: 90px"></div>
                            <span class="text-xs text-gray-400 mt-2">Rab</span>
                        </div>
                        <div class="flex flex-col items-center w-10">
                            <div class="w-8 bg-blue-500/80 rounded-t" style="height: 70px"></div>
                            <span class="text-xs text-gray-400 mt-2">Kam</span>
                        </div>
                        <div class="flex flex-col items-center w-10">
                            <div class="w-8 bg-blue-500/80 rounded-t" style="height: 95px"></div>
                            <span class="text-xs text-gray-400 mt-2">Jum</span>
                        </div>
                        <div class="flex flex-col items-center w-10">
                            <div class="w-8 bg-blue-500/80 rounded-t" style="height: 85px"></div>
                            <span class="text-xs text-gray-400 mt-2">Sab</span>
                        </div>
                        <div class="flex flex-col items-center w-10">
                            <div class="w-8 bg-blue-500/80 rounded-t" style="height: 60px"></div>
                            <span class="text-xs text-gray-400 mt-2">Min</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Peminjaman Terbaru -->
            <div class="bg-dark-200 rounded-xl border border-dark-300 p-5">
                <h2 class="text-lg font-semibold mb-4 flex items-center">
                    <span class="w-1 h-5 bg-purple-500 rounded-full mr-3"></span>
                    Peminjaman Terbaru
                </h2>
                <div class="space-y-3">
                    <!-- case -->
                     <?php foreach ($dbpeminjamanterbaru as $item) {?>
                    
                         <div class="flex items-center justify-between">       
                            <div>
                                <p class="text-sm font-medium"><?= $item['judul'] ?></p>
                                <p class="text-xs text-gray-400"><?= $item['username'] ?></p>
                            </div>
                            <span class="text-xs bg-green-500/20 text-green-400 px-2 py-1 rounded-full"><?= $item['status'] ?></span>
                        </div>
                    <?php } ?>
                    <a href="#" class="block text-center text-sm text-blue-400 hover:text-blue-300 mt-4">Lihat semua →</a>
                </div>
            </div>
        </div>
        <!-- TABEL BUKU TERBARU -->
        <div class="bg-dark-200 rounded-xl border border-dark-300 overflow-hidden">
            <div class="p-5 border-b border-dark-300 flex justify-between items-center">
                <h2 class="text-lg font-semibold flex items-center">
                    <span class="w-1 h-5 bg-green-500 rounded-full mr-3"></span>
                    Buku Terbaru
                </h2>
                <a href="kelola_buku.php" class="text-sm text-blue-400 hover:text-blue-300">Kelola Buku →</a>
            </div>
            <table class="w-full text-sm">
                <thead class="bg-dark-300 text-gray-300">
                    <tr>
                        <th class="text-left py-3 px-4">ID</th>
                        <th class="text-left py-3 px-4">Judul</th>
                        <th class="text-left py-3 px-4">Penulis</th>
                        <th class="text-left py-3 px-4">Penerbit</th>
                        <th class="text-left py-3 px-4">Stok</th>
                        <th class="text-left py-3 px-4">Status</th>
                    </tr>
                </thead>
                <tbody class=" divide-y divide-dark-300">
                    <?php foreach($dbindex as $row):?>
                        <tr class="hover:bg-dark-300/50 transition">
                            <td class="py-3 px-4"><?= $row['id_buku'] ?></td>
                            <td class="py-3 px-4"><?= $row['judul'] ?></td>
                            <td class="py-3 px-4"><?= $row['penulis'] ?></td>
                            <td class="py-3 px-4"><?= $row['penerbit'] ?></td>
                            <td class="py-3 px-4"><?= $row['stok_tersedia'] ?></td>
                            <td class="py-3 px-4">
                                <?php 
                                if($row['stok_tersedia']> 0 ){
                                    echo '<span class="bg-green-500/20 text-green-400 px-2 py-1 rounded-full text-xs">Tersedia </span>';

                                }else{
                                    echo '<span class="bg-red-500/20 text-red-400 px-2 py-1 rounded-full text-xs">Tidak Tersedia</span>';
                                }
                                ?>
                           </td>
                        </tr>
                        <?php endforeach;?>
                  
                </tbody>
            </table>
        </div>
    </main>

    <!-- FOOTER -->
    <footer class="border-t border-dark-300 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <p class="text-gray-500 text-xs text-center">© 2025 Syafik · Digital Library. Admin Panel.</p>
        </div>
    </footer>

</body>
</html>