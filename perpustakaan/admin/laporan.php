<?php
session_start();
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
    <title>Laporan · Syafik Library</title>
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
    </style>
</head>
<body class="text-gray-200">

    <!-- NAVBAR ADMIN -->
    <nav class="bg-dark-200 border-b border-dark-300 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-3">
                    <span class="text-2xl font-bold bg-gradient-to-r from-blue-400 to-purple-500 text-transparent bg-clip-text">Syafik</span>
                    <span class="text-gray-400 text-sm hidden sm:inline">· Admin Panel</span>
                </div>
                <div class="hidden md:flex items-center space-x-6">
                    <a href="dashboard.php" class="text-gray-400 hover:text-white text-sm transition">Dashboard</a>
                    <a href="kelola_buku.php" class="text-gray-400 hover:text-white text-sm transition">Kelola Buku</a>
                    <a href="kelola_anggota.php" class="text-gray-400 hover:text-white text-sm transition">Kelola Anggota</a>
                   <a href="denda.php" class="text-gray-400 hover:text-white text-sm transition">Denda</a>
                    <a href="laporan.php" class="text-white text-sm border-b border-blue-500 pb-1">Laporan</a>
                </div>
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
                <h1 class="text-2xl md:text-3xl font-bold">Laporan & Statistik</h1>
                <p class="text-gray-400 mt-1">Analisis data peminjaman dan aktivitas perpustakaan</p>
            </div>
            <div class="mt-4 md:mt-0 flex gap-2">
                <button class="bg-dark-200 hover:bg-dark-300 border border-dark-400 text-white px-4 py-2 rounded-lg text-sm font-medium transition flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    Export PDF
                </button>
                <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                    </svg>
                    Export Excel
                </button>
            </div>
        </div>
    </div>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">

        <!-- FILTER PERIODE -->
        <div class="bg-dark-200 rounded-xl border border-dark-300 p-5 mb-8">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <span class="text-sm text-gray-400">Periode:</span>
                    <select class="bg-dark-300 border border-dark-400 rounded-lg px-4 py-2 text-sm text-gray-300 focus:outline-none focus:border-blue-500">
                        <option>7 Hari Terakhir</option>
                        <option>30 Hari Terakhir</option>
                        <option selected>Bulan Ini (Feb 2025)</option>
                        <option>Bulan Lalu</option>
                        <option>Tahun Ini</option>
                        <option>Kustom</option>
                    </select>
                </div>
                <div class="flex gap-2">
                    <input type="date" class="bg-dark-300 border border-dark-400 rounded-lg px-4 py-2 text-sm text-gray-300 focus:outline-none focus:border-blue-500" value="2025-02-01">
                    <span class="text-gray-500 self-center">s/d</span>
                    <input type="date" class="bg-dark-300 border border-dark-400 rounded-lg px-4 py-2 text-sm text-gray-300 focus:outline-none focus:border-blue-500" value="2025-02-23">
                    <button class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg text-sm font-medium transition">
                        Terapkan
                    </button>
                </div>
            </div>
        </div>

        <!-- STATISTIK UTAMA -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div class="bg-dark-200 rounded-xl border border-dark-300 p-5">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-gray-400 text-sm">Total Peminjaman</p>
                        <p class="text-3xl font-bold text-blue-400 mt-1"><?= $totalpinjam  ?></p>
                    </div>
                    <div class="w-12 h-12 bg-blue-600/20 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="bg-dark-200 rounded-xl border border-dark-300 p-5">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-gray-400 text-sm">Buku Dipinjam</p>
                        <p class="text-3xl font-bold text-purple-400 mt-1"><?= $bukudipinjam ?></p>
                    
                    </div>
                    <div class="w-12 h-12 bg-purple-600/20 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="bg-dark-200 rounded-xl border border-dark-300 p-5">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-gray-400 text-sm">Buku Kembali</p>
                        <p class="text-3xl font-bold text-green-400 mt-1"><?= $bukudikembalikan ?></p>
                    
                    </div>
                    <div class="w-12 h-12 bg-green-600/20 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="bg-dark-200 rounded-xl border border-dark-300 p-5">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-gray-400 text-sm">Total Denda</p>
                        <p class="text-3xl font-bold text-yellow-400 mt-1">Rp <?= $totaldenda['jumlahdenda'] ?>k</p>
                    </div>
                    <div class="w-12 h-12 bg-yellow-600/20 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- TABEL LAPORAN PEMINJAMAN TERBARU -->
        <div class="bg-dark-200 rounded-xl border border-dark-300 overflow-hidden mb-8">
            <div class="p-5 border-b border-dark-300">
                <h2 class="text-lg font-semibold flex items-center">
                    <span class="w-1 h-5 bg-green-500 rounded-full mr-3"></span>
                    Laporan Peminjaman Terbaru
                </h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-dark-300 text-gray-300">
                        <tr>
                            <th class="text-left py-3 px-4">No</th>
                            <th class="text-left py-3 px-4">ID Pinjam</th>
                            <th class="text-left py-3 px-4">Anggota</th>
                            <th class="text-left py-3 px-4">Buku</th>
                            <th class="text-left py-3 px-4">Tgl Pinjam</th>
                            <th class="text-left py-3 px-4">Tgl Kembali</th>
                            <th class="text-left py-3 px-4">Status</th>
                            <th class="text-left py-3 px-4">Denda</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-dark-300">
                        <?php $i = 1?>
                        <?php foreach($dbpeminjamanterbarulaporan as $row){?>
                        <tr class="hover:bg-dark-300/50 transition">
                            <td class="py-3 px-4"><?= $i ?></td>
                            <td class="py-3 px-4 font-mono text-xs text-blue-400"><?= $row['id_pinjam'] ?></td>
                            <td class="py-3 px-4"><?= $row['username'] ?></td>
                            <td class="py-3 px-4"><?= $row['judul'] ?></td>
                            <td class="py-3 px-4"><?= $row['tanggal_pinjam'] ?></td>
                            <td class="py-3 px-4"><?= $row['tanggal_kembali'] ?></td>
                            <td class="py-3 px-4">  <?php
                            if($row['status'] == 'dikembalikan'){
                                echo '<span class="bg-green-500/20 text-green-400 px-2 py-1 rounded-full text-xs">Dikembalikan</span>';
                            }elseif($row['status'] == 'dipinjam'){
                                 echo '<span class="bg-yellow-500/20 text-yellow-400 px-2 py-1 rounded-full text-xs">Dipinjam</span>';
                            }elseif ($row['status'] == 'terlambat') {
                                echo '<span class="bg-red-500/20 text-red-400 px-2 py-1 rounded-full text-xs">Terlambat</span>';
                            }
                            
                            ?></td>
                            <td class="py-3 px-4 text-yellow-400">Rp <?= $row['jumlah_denda'] ?> k</td>
                        </tr>
                        <?php $i++?>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>


        <!-- GRAFIK DAN CHART -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Top 5 Anggota dengan Denda Terbanyak -->
            <div class="bg-dark-200 rounded-xl border border-dark-300 p-5">
                <h2 class="text-lg font-semibold mb-4 flex items-center">
                    <span class="w-1 h-5 bg-purple-500 rounded-full mr-3"></span>
                    Top 5 Anggota dengan Denda Terbanyak
                </h2>
                <div class="space-y-3">
                    <?php $i = 1?>
                    <?php foreach($dbanggotadendaterbanyak as $row){ ?>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="text-sm text-gray-400 w-6">#<?= $i ?></span>
                            <span class="font-medium"><?= $row['username'] ?></span>
                        </div>
                        <span class="text-sm text-yellow-400">Rp <?= $row['jumlah_denda'] ?>k</span>
                    </div>
                    <?php $i++?>
                    <?php }?>
                </div>
            </div>
            
            <!-- Kategori Buku Terpopuler -->
            <div class="bg-dark-200 rounded-xl border border-dark-300 p-5">
                <h2 class="text-lg font-semibold mb-4 flex items-center">
                    <span class="w-1 h-5 bg-purple-500 rounded-full mr-3"></span>
                    Kategori Terpopuler
                </h2>
                <div class="space-y-3">
                    <?php foreach ($jumlahbukuperkategori as $row) {?>
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-300"><?= $row['kategori'] ?></span>
                            <span class="text-blue-400"><?= $row['persenan'] ?>%</span>
                        </div>
                        <div class="w-full bg-dark-400 rounded-full h-2">
                            <div class="bg-blue-500 h-2 rounded-full" style="width: <?= $row['persenan']?>%"></div>
                        </div>
                    </div>
                    <?php }?>
                </div>
            </div>
        </div>

        
        <!-- BUKU TERPOPULER & ANGGOTA AKTIF -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Buku Terpopuler -->
            <div class="bg-dark-200 rounded-xl border border-dark-300 p-5">
                <h2 class="text-lg font-semibold mb-4 flex items-center">
                    <span class="w-1 h-5 bg-yellow-500 rounded-full mr-3"></span>
                    5 Buku Paling Populer
                </h2>
                <div class="space-y-3">
                    <?php $i = 1;
                    foreach($dbbukupalingpopuler as $row){ ?>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="text-sm text-gray-400 w-6">#<?= $i ?></span>
                            <span class="font-medium"><?= $row['judul'] ?></span>
                        </div>
                        <span class="text-sm text-blue-400"><?= $row['buku'] ?>x dipinjam</span>
                    </div>
                    <?php 
                $i++;
                };?>
                </div>
            </div>

            <!-- Anggota Paling Aktif -->
            <div class="bg-dark-200 rounded-xl border border-dark-300 p-5">
                <h2 class="text-lg font-semibold mb-4 flex items-center">
                    <span class="w-1 h-5 bg-purple-500 rounded-full mr-3"></span>
                    5 Anggota Paling Aktif
                </h2>
                <div class="space-y-3">
                    <?php $i = 1?>
                    <?php foreach($dbanggotapalingpopuler  as $row){?>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="text-sm text-gray-400 w-6">#<?= $i ?></span>
                            <span class="font-medium"><?= $row['username'] ?></span>
                        </div>
                        <span class="text-sm text-purple-400"><?= $row['user_pinjam'] ?>x pinjam</span>
                    </div>
                    
                <?php $i++; 
                }?>
                </div>
            </div>
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