<?php
session_start();
require '../config/koneksi.php';
// if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'anggota') {
//     header('Location: ../public/login.php');
//     exit();
// }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Denda · Syafik Library</title>
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

    <!-- NAVBAR ANGGOTA -->
    <nav class="bg-dark-200 border-b border-dark-300 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-3">
                    <span class="text-2xl font-bold bg-gradient-to-r from-blue-400 to-purple-500 text-transparent bg-clip-text">Syafik</span>
                    <span class="text-gray-400 text-sm hidden sm:inline">· Anggota</span>
                </div>
                <div class="hidden md:flex items-center space-x-6">
                    <a href="dashboard.php" class="text-gray-400 hover:text-white text-sm transition">Dashboard</a>
                    <a href="katalog.php" class="text-gray-400 hover:text-white text-sm transition">Katalog</a>
                    <a href="peminjaman_saya.php" class="text-gray-400 hover:text-white text-sm transition">Peminjaman</a>
                    <a href="denda.php" class="text-white text-sm border-b border-blue-500 pb-1">Denda</a>
                </div>
                <div class="flex items-center space-x-3">
                    <a href="../proses/logout_proses.php" class="bg-dark-300 hover:bg-dark-400 text-white px-4 py-2 rounded-lg text-sm font-medium transition border border-dark-400">Keluar</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- HEADER HALAMAN -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold">Denda Saya</h1>
                <p class="text-gray-400 mt-1">Kelola kewajiban dan riwayat denda</p>
            </div>
            <div class="mt-4 md:mt-0">
                <div class="bg-dark-200 border border-dark-300 rounded-xl px-5 py-3">
                    <p class="text-xs text-gray-400">Total denda belum dibayar</p>
                    <p class="text-2xl font-bold text-yellow-400">Rp <?= $totaldendauser['jumlahdenda'] ?>K</p>
                </div>
            </div>
        </div>
    </div>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">

        <!-- TAB STATUS: Aktif / Riwayat -->
        <div class="bg-dark-200 rounded-xl border border-dark-300 p-1 inline-flex mb-8">
            <button class="px-5 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium">Belum Dibayar</button>
            <button class="px-5 py-2 text-gray-400 hover:text-white rounded-lg text-sm font-medium transition">Riwayat</button>
        </div>

        <!-- LIST DENDA AKTIF -->
        <div class="space-y-4 mb-12">
            <!-- Card Denda 1 -->
            <?php foreach($dendauser as $row){?>
            <div class="bg-dark-200 rounded-xl border border-dark-300 p-5 hover:border-blue-500/30 transition">
                <div class="flex flex-wrap md:flex-nowrap items-start justify-between gap-4">
                    <div class="flex gap-4">
                        <!-- Cover placeholder -->
                        <div class="w-14 h-20 bg-dark-300 rounded-lg border border-dark-400 flex items-center justify-center flex-shrink-0">
                            <svg class="w-7 h-7 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-white"><?= $row['judul'] ?></h3>
                            <p class="text-sm text-gray-400"><?= $row['penerbit'] ?></p>
                            <div class="flex items-center gap-4 mt-2 text-xs">
                                <span class="text-gray-500">tenggat: <?= $row['tanggal_tenggat'] ?></span>
                                <span class="text-gray-600">•</span>
                                <span class="text-gray-500">Kembali: <?= $row['tanggal_kembali'] ?></span>
                            </div>
                            <div class="mt-2">
                                <span class="bg-red-500/20 text-red-400 px-2 py-0.5 rounded-full text-xs">Terlambat 
                                    <?=  
                                        $selisihtanggal; 
                                    ?> hari
                                </span>

                            </div>
                        </div>
                    </div>
                    <div class="flex items-center gap-6 w-full md:w-auto">
                        <div class="text-right">
                            <p class="text-xs text-gray-400">Denda</p>
                            <p class="text-xl font-bold text-yellow-400">RP<?= $row['jumlah_denda'] ?>K</p>
                        </div>
                            <a href="../proses/bayar_denda.php?id=<?= $row['id_pinjam'] ?>">

                                <button type="submit" name="bayar" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg text-sm font-medium transition whitespace-nowrap">
                                    Bayar Denda
                                </button>
                            </a>

                        
                    </div>
                </div>
            </div>
            <?php }?>

        

        <!-- RIWAYAT PEMBAYARAN DENDA -->
        <div class="bg-dark-200 rounded-xl border border-dark-300 overflow-hidden mb-8">
            <div class="p-5 border-b border-dark-300">
                <h2 class="text-lg font-semibold flex items-center">
                    <span class="w-1 h-5 bg-green-500 rounded-full mr-3"></span>
                    Riwayat Pembayaran Denda
                </h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-dark-300 text-gray-300">
                        <tr>
                            <th class="text-left py-3 px-4">Tanggal</th>
                            <th class="text-left py-3 px-4">Judul Buku</th>
                            <th class="text-left py-3 px-4">Keterlambatan</th>
                            <th class="text-left py-3 px-4">Denda</th>
                            <th class="text-left py-3 px-4">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-dark-300">
                        <tr class="hover:bg-dark-300/50 transition">
                            <td class="py-3 px-4">15 Feb 2025</td>
                            <td class="py-3 px-4">The Psychology of Money</td>
                            <td class="py-3 px-4">2 hari</td>
                            <td class="py-3 px-4">Rp 10.000</td>
                            <td class="py-3 px-4"><span class="bg-green-500/20 text-green-400 px-2 py-1 rounded-full text-xs">Lunas</span></td>
                        </tr>
                        <tr class="hover:bg-dark-300/50 transition">
                            <td class="py-3 px-4">2 Feb 2025</td>
                            <td class="py-3 px-4">Clean Code</td>
                            <td class="py-3 px-4">1 hari</td>
                            <td class="py-3 px-4">Rp 5.000</td>
                            <td class="py-3 px-4"><span class="bg-green-500/20 text-green-400 px-2 py-1 rounded-full text-xs">Lunas</span></td>
                        </tr>
                        <tr class="hover:bg-dark-300/50 transition">
                            <td class="py-3 px-4">20 Jan 2025</td>
                            <td class="py-3 px-4">Filosofi Teras</td>
                            <td class="py-3 px-4">3 hari</td>
                            <td class="py-3 px-4">Rp 15.000</td>
                            <td class="py-3 px-4"><span class="bg-green-500/20 text-green-400 px-2 py-1 rounded-full text-xs">Lunas</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- INFORMASI DENDA -->
        <div class="bg-dark-200 rounded-xl border border-dark-300 p-5">
            <h3 class="font-semibold mb-3 flex items-center">
                <svg class="w-5 h-5 text-blue-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Ketentuan Denda
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                <div class="bg-dark-300/50 rounded-lg p-3">
                    <p class="text-gray-400">Denda per hari</p>
                    <p class="text-white font-semibold">Rp 1.000</p>
                </div>
                <div class="bg-dark-300/50 rounded-lg p-3">
                    <p class="text-gray-400">Maksimal denda</p>
                    <p class="text-white font-semibold">= Harga buku</p>
                </div>
                <div class="bg-dark-300/50 rounded-lg p-3">
                    <p class="text-gray-400">Pembayaran</p>
                    <p class="text-white font-semibold">Transfer / Cash</p>
                </div>
            </div>
        </div>
    </main>

    <!-- FOOTER -->
    <footer class="border-t border-dark-300 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <p class="text-gray-500 text-xs text-center">© 2025 Syafik · Digital Library. Anggota Area.</p>
        </div>
    </footer>

   

</body>
</html>