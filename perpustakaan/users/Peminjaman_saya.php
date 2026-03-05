<?php
session_start();
require '../config/koneksi.php';
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
    <title>Peminjaman Saya · Syafik Library</title>
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
                <!-- Logo & Brand -->
                <div class="flex items-center space-x-3">
                    <span class="text-2xl font-bold bg-gradient-to-r from-blue-400 to-purple-500 text-transparent bg-clip-text">Syafik</span>
                    <span class="text-gray-400 text-sm hidden sm:inline">· Digital Library</span>
                </div>

                <!-- Menu Navigasi -->
                <div class="hidden md:flex items-center space-x-6">
                    <a href="dashboard.php" class="text-gray-400 hover:text-white text-sm transition">Dashboard</a>
                    <a href="katalog.php" class="text-gray-400 hover:text-white text-sm transition">Katalog</a>
                    <a href="peminjaman_saya.php" class="text-white text-sm border-b border-blue-500 pb-1">Peminjaman</a>
                </div>

                <!-- Right Menu -->
                <div class="flex items-center space-x-3">
                    <a href="profile.php" class="text-gray-300 hover:text-white px-3 py-2 text-sm font-medium transition">Profil</a>
                    <a href="../proses/logout_proses.php" class="bg-dark-300 hover:bg-dark-400 text-white px-4 py-2 rounded-lg text-sm font-medium transition border border-dark-400">Keluar</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- HEADER HALAMAN -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-2xl md:text-3xl font-bold">Peminjaman Saya</h1>
        <p class="text-gray-400 mt-1">Kelola buku yang sedang kamu pinjam</p>
    </div>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">

        <!-- TAB SECTION (seperti filter chips) -->
        <div class="flex gap-2 border-b border-dark-300 pb-4 mb-6">
            <span class="text-sm px-4 py-2 bg-dark-200 rounded-lg text-blue-400 border border-blue-500/30">Sedang Dipinjam</span>
            <span class="text-sm px-4 py-2 bg-dark-200 rounded-lg text-gray-400 hover:bg-dark-300 transition cursor-default">Riwayat</span>
            <span class="text-sm px-4 py-2 bg-dark-200 rounded-lg text-gray-400 hover:bg-dark-300 transition cursor-default">Denda</span>
        </div>

        <!-- LIST PEMINJAMAN AKTIF (style seperti card di dashboard) -->
        <div class="space-y-3">
            <!-- Item 1 -->
             <?php foreach($bukupeminjamansy as $row):?>
                <div class="bg-dark-200 rounded-xl border border-dark-300 p-4 card-hover">
                    <div class="flex flex-wrap items-center justify-between gap-4">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-16 bg-dark-400 rounded-lg flex items-center justify-center text-2xl">📘</div>
                            <div>
                                <h3 class="font-semibold"><?= $row['judul'] ?></h3>
                                <p class="text-sm text-gray-400"><?= $row['penulis'] ?></p>
                                <p class="text-xs text-gray-500 mt-1"><?= $row['tanggal_pinjam'] ?></p>
                            </div>
                        </div>
                        <div class="flex items-center gap-6">
                            <div class="text-right">
                                <p class="text-xs text-gray-400">Jatuh tempo</p>
                                <p class="text-sm text-yellow-400"><?= $row['tanggal_tenggat'] ?></p>
                            </div>
                            <span class="text-xs bg-green-500/20 text-green-400 px-3 py-1.5 rounded-full">Aktif</span>
                            <a href="../proses/kembalikan_proses.php?id=<?= $row['id_buku'] ?>">
                                <button class="text-xs bg-blue-600 hover:bg-blue-700 px-3 py-1.5 rounded transition">Kembalikan</button>
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>


        <!-- RIWAYAT (dengan tabel seperti di dashboard) -->
        <div class="mt-12">
            <h2 class="text-xl font-semibold mb-4 flex items-center">
                <span class="w-1 h-6 bg-green-500 rounded-full mr-3"></span>
                Riwayat Peminjaman
            </h2>
            <div class="bg-dark-200 rounded-xl border border-dark-300 overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="bg-dark-300 text-gray-300">
                        <tr>
                            <th class="text-left py-3 px-4">No</th>
                            <th class="text-left py-3 px-4">Judul Buku</th>
                            <th class="text-left py-3 px-4">Tanggal Pinjam</th>
                            <th class="text-left py-3 px-4">Tanggal Kembali</th>
                            <th class="text-left py-3 px-4">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-dark-300">
                        <tr class="hover:bg-dark-300/50 transition">
                            <td class="py-3 px-4">1</td>
                            <td class="py-3 px-4">Clean Code</td>
                            <td class="py-3 px-4">10 Feb 2025</td>
                            <td class="py-3 px-4">17 Feb 2025</td>
                            <td class="py-3 px-4"><span class="bg-green-500/20 text-green-400 px-2 py-1 rounded-full text-xs">Tepat waktu</span></td>
                        </tr>
                        <tr class="hover:bg-dark-300/50 transition">
                            <td class="py-3 px-4">2</td>
                            <td class="py-3 px-4">The Pragmatic Programmer</td>
                            <td class="py-3 px-4">03 Feb 2025</td>
                            <td class="py-3 px-4">10 Feb 2025</td>
                            <td class="py-3 px-4"><span class="bg-red-500/20 text-red-400 px-2 py-1 rounded-full text-xs">Terlambat 2 hari</span></td>
                        </tr>
                        <tr class="hover:bg-dark-300/50 transition">
                            <td class="py-3 px-4">3</td>
                            <td class="py-3 px-4">Design Patterns</td>
                            <td class="py-3 px-4">25 Jan 2025</td>
                            <td class="py-3 px-4">01 Feb 2025</td>
                            <td class="py-3 px-4"><span class="bg-green-500/20 text-green-400 px-2 py-1 rounded-full text-xs">Tepat waktu</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- FOOTER -->
    <footer class="border-t border-dark-300 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <p class="text-gray-500 text-xs text-center">© 2025 Syafik · Digital Library. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>