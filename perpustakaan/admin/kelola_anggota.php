<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
} 
require '../config/koneksi.php';
// if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
//     header('Location: ../public/login.php');
//     exit();
// }

$dbpaginationanggota = QuerySelect("SELECT * FROM users LIMIT $indexpertamaanggota,$dataperpage");


if(isset($_POST['search'])){
    $dbpaginationanggota = Searchanggota($_POST['keyword']);
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Anggota · Syafik Library</title>
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
                    <a href="kelola_anggota.php" class="text-white text-sm border-b border-blue-500 pb-1">Kelola Anggota</a>
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
                <h1 class="text-2xl md:text-3xl font-bold">Kelola Anggota</h1>
                <p class="text-gray-400 mt-1">Manajemen data anggota perpustakaan</p>
            </div>
        </div>
    </div>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">

        <!-- STATISTIK CEPAT ANGGOTA -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <div class="bg-dark-200 rounded-xl border border-dark-300 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-400 text-xs">Total Anggota</p>
                        <p class="text-2xl font-bold text-blue-400"><?= $jumlahanggota ?></p>
                    </div>
                    <div class="w-10 h-10 bg-blue-600/20 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="bg-dark-200 rounded-xl border border-dark-300 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-400 text-xs">Anggota Aktif</p>
                        <p class="text-2xl font-bold text-green-400"><?= $jumlahanggotaaktif ?></p>
                    </div>
                    <div class="w-10 h-10 bg-green-600/20 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="bg-dark-200 rounded-xl border border-dark-300 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-400 text-xs">Sedang Meminjam</p>
                        <p class="text-2xl font-bold text-yellow-400"><?= $sedangminjam ?></p>
                    </div>
                    <div class="w-10 h-10 bg-yellow-600/20 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="bg-dark-200 rounded-xl border border-dark-300 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-400 text-xs">Anggota Baru (Bulan Ini)</p>
                        <p class="text-2xl font-bold text-purple-400"><?= $jumlahanggotabulanterakhir ?></p>
                    </div>
                    <div class="w-10 h-10 bg-purple-600/20 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- SEARCH & FILTER BAR -->
        <div class="bg-dark-200 rounded-xl border border-dark-300 p-4 mb-6">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1 relative">
                    <form class="space-x-2 flex" action="" method="post">

                        <input type="text" name="keyword" placeholder="Cari nama, email, atau nomor anggota..." 
                        class="w-full bg-dark-300 border border-dark-400 rounded-lg py-2.5 pl-10 pr-4 text-sm focus:outline-none focus:border-blue-500 transition">
                        <svg class="absolute left-3 top-3 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <button name="search" class="p-4 bg-blue-600 rounded-full" type="submit">mencari</button>
                    </form>
                </div>
                <div class="flex gap-2">
                    <select class="bg-dark-300 border border-dark-400 rounded-lg px-4 py-2.5 text-sm text-gray-300 focus:outline-none focus:border-blue-500">
                        <option>Semua Status</option>
                        <option>Aktif</option>
                        <option>Nonaktif</option>
                        <option>Denda</option>
                    </select>
                    <select class="bg-dark-300 border border-dark-400 rounded-lg px-4 py-2.5 text-sm text-gray-300 focus:outline-none focus:border-blue-500">
                        <option>Urutkan</option>
                        <option>Terbaru</option>
                        <option>Terlama</option>
                        <option>A-Z</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- TABEL ANGGOTA -->
        <div class="bg-dark-200 rounded-xl border border-dark-300 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-dark-300 text-gray-300">
                        <tr>
                            <th class="text-left py-3 px-4">No</th>
                            <th class="text-left py-3 px-4">Nama Lengkap</th>
                            <th class="text-left py-3 px-4">Email</th>
                            <th class="text-left py-3 px-4">Bergabung</th>
                            <th class="text-left py-3 px-4">Status</th>
                            <th class="text-left py-3 px-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-dark-300">
                        <!-- Row 1 -->
                        <?php $i = 1?>
                         <?php foreach($dbpaginationanggota as $row):?>
                            <tr class="hover:bg-dark-300/50 transition">
                                <td class="py-3 px-4"><?= $i ?></td>
                                <td class="py-3 px-4 font-medium"><?= $row['username'] ?></td>
                                <td class="py-3 px-4 text-gray-400"><?= $row['email'] ?></td>
                                <td class="py-3 px-4 text-gray-400"><?= $row['tanggal_daftar'] ?></td>
                            <td class="py-3 px-4"><span class="bg-green-500/20 text-green-400 px-2 py-1 rounded-full text-xs"><?= $row['status'] ?></span></td>
                            <td class="py-3 px-4">
                                <div class="flex space-x-2">
                                    <a href="edit_anggota.php?id=AGT-001" class="p-1.5 bg-blue-600/20 text-blue-400 rounded-lg hover:bg-blue-600/30 transition" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>
                                    <a href="detail_anggota.php?id=AGT-001" class="p-1.5 bg-purple-600/20 text-purple-400 rounded-lg hover:bg-purple-600/30 transition" title="Detail">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </a>
                                    <a href="#" onclick="return confirm('Yakin ingin menonaktifkan anggota ini?')" class="p-1.5 bg-red-600/20 text-red-400 rounded-lg hover:bg-red-600/30 transition" title="Nonaktifkan">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php $i++?>
                        <?php endforeach;?>
                        
                    </tbody>
                </table>
            </div>
            
            <!-- PAGINATION -->
            <div class="flex items-center justify-between px-4 py-3 border-t border-dark-300">
                <div class="text-sm text-gray-400">
                    Menampilkan 1-5 dari <?= $jumlahanggota ?> anggota
                </div>
                <div class="flex space-x-2">
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
                    <span class="w-8 h-8 flex items-center justify-center bg-dark-200 rounded-lg text-gray-400">...</span>
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