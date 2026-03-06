<?php
session_start();
require '../config/koneksi.php';
// if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
//     header('Location: ../public/login.php');
//     exit();
// }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Denda · Syafik Library</title>
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
                    <a href="denda.php" class="text-white text-sm border-b border-blue-500 pb-1">Denda</a>
                    <a href="laporan.php" class="text-gray-400 hover:text-white text-sm transition">Laporan</a>
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
                <h1 class="text-2xl md:text-3xl font-bold">Manajemen Denda</h1>
                <p class="text-gray-400 mt-1">Kelola semua transaksi denda anggota</p>
            </div>
            <div class="mt-4 md:mt-0 flex gap-3">
                <button class="bg-dark-200 hover:bg-dark-300 border border-dark-400 text-white px-4 py-2 rounded-lg text-sm font-medium transition flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    Export
                </button>
                <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                    + Atur Denda
                </button>
            </div>
        </div>
    </div>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">

        <!-- STATISTIK DENDA -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div class="bg-dark-200 rounded-xl border border-dark-300 p-5">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-gray-400 text-sm">Total Denda</p>
                        <p class="text-3xl font-bold text-blue-400 mt-1">Rp <?= $totaldenda['jumlahdenda'] ?></p>
                        <p class="text-xs text-green-400 mt-2">↑ 8% dari bulan lalu</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-600/20 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="bg-dark-200 rounded-xl border border-dark-300 p-5">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-gray-400 text-sm">Denda Belum Dibayar</p>
                        <p class="text-3xl font-bold text-yellow-400 mt-1">Rp 890.000</p>
                        <p class="text-xs text-red-400 mt-2">↑ 12% dari bulan lalu</p>
                    </div>
                    <div class="w-12 h-12 bg-yellow-600/20 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="bg-dark-200 rounded-xl border border-dark-300 p-5">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-gray-400 text-sm">Denda Lunas</p>
                        <p class="text-3xl font-bold text-green-400 mt-1">Rp 1.560.000</p>
                        <p class="text-xs text-green-400 mt-2">↑ 5% dari bulan lalu</p>
                    </div>
                    <div class="w-12 h-12 bg-green-600/20 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="bg-dark-200 rounded-xl border border-dark-300 p-5">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-gray-400 text-sm">Anggota dengan Denda</p>
                        <p class="text-3xl font-bold text-purple-400 mt-1">24 orang</p>
                        <p class="text-xs text-green-400 mt-2">Aktif</p>
                    </div>
                    <div class="w-12 h-12 bg-purple-600/20 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- FILTER & SEARCH -->
        <div class="bg-dark-200 rounded-xl border border-dark-300 p-5 mb-8">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <span class="text-sm text-gray-400">Filter:</span>
                    <select class="bg-dark-300 border border-dark-400 rounded-lg px-4 py-2 text-sm text-gray-300 focus:outline-none focus:border-blue-500">
                        <option>Semua Status</option>
                        <option>Belum Dibayar</option>
                        <option>Lunas</option>
                    </select>
                    <select class="bg-dark-300 border border-dark-400 rounded-lg px-4 py-2 text-sm text-gray-300 focus:outline-none focus:border-blue-500">
                        <option>Urut: Terbaru</option>
                        <option>Terlama</option>
                        <option>Denda Terbesar</option>
                    </select>
                </div>
                <div class="relative">
                    <input type="text" placeholder="Cari anggota atau buku..." class="bg-dark-300 border border-dark-400 rounded-lg px-4 py-2 pl-10 text-sm text-gray-300 w-full md:w-64 focus:outline-none focus:border-blue-500">
                    <svg class="w-4 h-4 text-gray-500 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- TABEL DENDA -->
        <div class="bg-dark-200 rounded-xl border border-dark-300 overflow-hidden mb-8">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-dark-300 text-gray-300">
                        <tr>
                            <th class="text-left py-3 px-4">ID</th>
                            <th class="text-left py-3 px-4">Anggota</th>
                            <th class="text-left py-3 px-4">Buku</th>
                            <th class="text-left py-3 px-4">Tgl Pinjam</th>
                            <th class="text-left py-3 px-4">Terlambat</th>
                            <th class="text-left py-3 px-4">Denda</th>
                            <th class="text-left py-3 px-4">Status</th>
                            <th class="text-left py-3 px-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-dark-300">
                        <tr class="hover:bg-dark-300/50 transition">
                            <td class="py-3 px-4 font-mono text-xs text-blue-400">#D001</td>
                            <td class="py-3 px-4">
                                <div>
                                    <p class="font-medium">Raden Adjeng</p>
                                    <p class="text-xs text-gray-500">AGT-001</p>
                                </div>
                            </td>
                            <td class="py-3 px-4">Atomic Habits</td>
                            <td class="py-3 px-4">10 Feb 2025</td>
                            <td class="py-3 px-4">5 hari</td>
                            <td class="py-3 px-4 text-yellow-400">Rp 25.000</td>
                            <td class="py-3 px-4"><span class="bg-yellow-500/20 text-yellow-400 px-2 py-1 rounded-full text-xs">Belum</span></td>
                            <td class="py-3 px-4">
                                <button class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded-lg text-xs font-medium transition">Konfirmasi</button>
                            </td>
                        </tr>
                        <tr class="hover:bg-dark-300/50 transition">
                            <td class="py-3 px-4 font-mono text-xs text-blue-400">#D002</td>
                            <td class="py-3 px-4">
                                <div>
                                    <p class="font-medium">Soekarno</p>
                                    <p class="text-xs text-gray-500">AGT-045</p>
                                </div>
                            </td>
                            <td class="py-3 px-4">Sapiens</td>
                            <td class="py-3 px-4">1 Feb 2025</td>
                            <td class="py-3 px-4">4 hari</td>
                            <td class="py-3 px-4 text-yellow-400">Rp 20.000</td>
                            <td class="py-3 px-4"><span class="bg-yellow-500/20 text-yellow-400 px-2 py-1 rounded-full text-xs">Belum</span></td>
                            <td class="py-3 px-4">
                                <button class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded-lg text-xs font-medium transition">Konfirmasi</button>
                            </td>
                        </tr>
                        <tr class="hover:bg-dark-300/50 transition">
                            <td class="py-3 px-4 font-mono text-xs text-blue-400">#D003</td>
                            <td class="py-3 px-4">
                                <div>
                                    <p class="font-medium">Cut Nyak</p>
                                    <p class="text-xs text-gray-500">AGT-089</p>
                                </div>
                            </td>
                            <td class="py-3 px-4">The Psychology of Money</td>
                            <td class="py-3 px-4">5 Feb 2025</td>
                            <td class="py-3 px-4">2 hari</td>
                            <td class="py-3 px-4 text-gray-400 line-through">Rp 10.000</td>
                            <td class="py-3 px-4"><span class="bg-green-500/20 text-green-400 px-2 py-1 rounded-full text-xs">Lunas</span></td>
                            <td class="py-3 px-4">
                                <span class="text-gray-600 text-xs">-</span>
                            </td>
                        </tr>
                        <tr class="hover:bg-dark-300/50 transition">
                            <td class="py-3 px-4 font-mono text-xs text-blue-400">#D004</td>
                            <td class="py-3 px-4">
                                <div>
                                    <p class="font-medium">Dipa Nusantara</p>
                                    <p class="text-xs text-gray-500">AGT-112</p>
                                </div>
                            </td>
                            <td class="py-3 px-4">Clean Code</td>
                            <td class="py-3 px-4">8 Feb 2025</td>
                            <td class="py-3 px-4">1 hari</td>
                            <td class="py-3 px-4 text-gray-400 line-through">Rp 5.000</td>
                            <td class="py-3 px-4"><span class="bg-green-500/20 text-green-400 px-2 py-1 rounded-full text-xs">Lunas</span></td>
                            <td class="py-3 px-4">
                                <span class="text-gray-600 text-xs">-</span>
                            </td>
                        </tr>
                        <tr class="hover:bg-dark-300/50 transition">
                            <td class="py-3 px-4 font-mono text-xs text-blue-400">#D005</td>
                            <td class="py-3 px-4">
                                <div>
                                    <p class="font-medium">Ki Hajar</p>
                                    <p class="text-xs text-gray-500">AGT-067</p>
                                </div>
                            </td>
                            <td class="py-3 px-4">Filosofi Teras</td>
                            <td class="py-3 px-4">12 Feb 2025</td>
                            <td class="py-3 px-4">3 hari</td>
                            <td class="py-3 px-4 text-yellow-400">Rp 15.000</td>
                            <td class="py-3 px-4"><span class="bg-yellow-500/20 text-yellow-400 px-2 py-1 rounded-full text-xs">Belum</span></td>
                            <td class="py-3 px-4">
                                <button class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded-lg text-xs font-medium transition">Konfirmasi</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- PAGINATION -->
        <div class="flex items-center justify-between">
            <p class="text-gray-400 text-sm">Menampilkan 1-5 dari 24 data</p>
            <div class="flex gap-2">
                <span class="w-8 h-8 flex items-center justify-center bg-blue-600 text-white rounded-lg text-sm font-medium">1</span>
                <span class="w-8 h-8 flex items-center justify-center bg-dark-200 hover:bg-dark-300 border border-dark-300 rounded-lg text-gray-400 text-sm cursor-pointer transition">2</span>
                <span class="w-8 h-8 flex items-center justify-center bg-dark-200 hover:bg-dark-300 border border-dark-300 rounded-lg text-gray-400 text-sm cursor-pointer transition">3</span>
                <span class="w-8 h-8 flex items-center justify-center bg-dark-200 hover:bg-dark-300 border border-dark-300 rounded-lg text-gray-400 text-sm cursor-pointer transition">4</span>
            </div>
        </div>

        <!-- GRAFIK SEDERHANA -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-12">
            <!-- Denda per Bulan -->
            <div class="bg-dark-200 rounded-xl border border-dark-300 p-5">
                <h2 class="text-lg font-semibold mb-4 flex items-center">
                    <span class="w-1 h-5 bg-blue-500 rounded-full mr-3"></span>
                    Tren Denda per Bulan
                </h2>
                <div class="h-40 flex items-end justify-between gap-2">
                    <div class="flex flex-col items-center w-full">
                        <div class="w-full bg-blue-500/80 rounded-t" style="height: 80px"></div>
                        <span class="text-xs text-gray-400 mt-2">Jan</span>
                    </div>
                    <div class="flex flex-col items-center w-full">
                        <div class="w-full bg-blue-500/80 rounded-t" style="height: 95px"></div>
                        <span class="text-xs text-gray-400 mt-2">Feb</span>
                    </div>
                    <div class="flex flex-col items-center w-full">
                        <div class="w-full bg-blue-500/80 rounded-t" style="height: 65px"></div>
                        <span class="text-xs text-gray-400 mt-2">Mar</span>
                    </div>
                    <div class="flex flex-col items-center w-full">
                        <div class="w-full bg-blue-500/80 rounded-t" style="height: 70px"></div>
                        <span class="text-xs text-gray-400 mt-2">Apr</span>
                    </div>
                    <div class="flex flex-col items-center w-full">
                        <div class="w-full bg-blue-500/80 rounded-t" style="height: 55px"></div>
                        <span class="text-xs text-gray-400 mt-2">Mei</span>
                    </div>
                    <div class="flex flex-col items-center w-full">
                        <div class="w-full bg-blue-500/80 rounded-t" style="height: 45px"></div>
                        <span class="text-xs text-gray-400 mt-2">Jun</span>
                    </div>
                </div>
            </div>

            <!-- Top 5 Anggota dengan Denda Terbanyak -->
            <div class="bg-dark-200 rounded-xl border border-dark-300 p-5">
                <h2 class="text-lg font-semibold mb-4 flex items-center">
                    <span class="w-1 h-5 bg-purple-500 rounded-full mr-3"></span>
                    Top 5 Anggota dengan Denda Terbanyak
                </h2>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="text-sm text-gray-400 w-6">#1</span>
                            <span class="font-medium">Raden Adjeng</span>
                        </div>
                        <span class="text-sm text-yellow-400">Rp 45.000</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="text-sm text-gray-400 w-6">#2</span>
                            <span class="font-medium">Soekarno</span>
                        </div>
                        <span class="text-sm text-yellow-400">Rp 38.000</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="text-sm text-gray-400 w-6">#3</span>
                            <span class="font-medium">Ki Hajar</span>
                        </div>
                        <span class="text-sm text-yellow-400">Rp 32.000</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="text-sm text-gray-400 w-6">#4</span>
                            <span class="font-medium">Cut Nyak</span>
                        </div>
                        <span class="text-sm text-yellow-400">Rp 28.000</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="text-sm text-gray-400 w-6">#5</span>
                            <span class="font-medium">Dipa Nusantara</span>
                        </div>
                        <span class="text-sm text-yellow-400">Rp 25.000</span>
                    </div>
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