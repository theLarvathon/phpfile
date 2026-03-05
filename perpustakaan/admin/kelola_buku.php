<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require '../config/koneksi.php';
// if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
//     header('Location: ../public/login.php');
//     exit();
// }
$dbpaginationbuku = QuerySelect("SELECT * FROM books LIMIT $indexpertama,$dataperpage"); 


if(isset($_POST['search'])){
    $dbpaginationbuku = Searchbuku($_POST['keyword']);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Buku · Syafik Library</title>
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
                    <a href="kelola_buku.php" class="text-white text-sm border-b border-blue-500 pb-1">Kelola Buku</a>
                    <a href="kelola_anggota.php" class="text-gray-400 hover:text-white text-sm transition">Kelola Anggota</a>
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
                <h1 class="text-2xl md:text-3xl font-bold">Kelola Buku</h1>
                <p class="text-gray-400 mt-1">Tambah, edit, atau hapus koleksi buku</p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="tambah_buku.php" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg text-sm font-medium transition flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Tambah Buku Baru
                </a>
            </div>
        </div>
    </div>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">

        <!-- SEARCH & FILTER BAR -->
        <div class="bg-dark-200 rounded-xl border border-dark-300 p-4 mb-6">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1 relative">
                    <form class="flex space-x-2" action="" method="post">
                        <input name="keyword" type="text" placeholder="Cari judul, penulis, atau penerbit..." 
                           class="w-full bg-dark-300 border border-dark-400 rounded-lg py-2.5 pl-10 pr-4 text-sm focus:outline-none focus:border-blue-500 transition">
                           <svg class="absolute left-3 top-3 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                               <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                           </svg>
                        <button name="search" class="p-4 bg-blue-600 rounded-full" type="submit">mencari</button>
                    </form>
                </div>
                <div class="flex gap-2">
                    <select class="bg-dark-300 border border-dark-400 rounded-lg px-4 py-2.5 text-sm text-gray-300 focus:outline-none focus:border-blue-500">
                        <option>Semua Kategori</option>
                        <option>Fiksi</option>
                        <option>Nonfiksi</option>
                        <option>Teknologi</option>
                    </select>
                    <select class="bg-dark-300 border border-dark-400 rounded-lg px-4 py-2.5 text-sm text-gray-300 focus:outline-none focus:border-blue-500">
                        <option>Semua Status</option>
                        <option>Tersedia</option>
                        <option>Hampir Habis</option>
                        <option>Habis</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- TABEL BUKU -->
        <div class="bg-dark-200 rounded-xl border border-dark-300 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-dark-300 text-gray-300">
                        <tr>
                            <th class="text-left py-3 px-4">ID</th>
                            <th class="text-left py-3 px-4">Sampul</th>
                            <th class="text-left py-3 px-4">Judul</th>
                            <th class="text-left py-3 px-4">Penulis</th>
                            <th class="text-left py-3 px-4">Penerbit</th>
                            <th class="text-left py-3 px-4">Tahun</th>
                            <th class="text-left py-3 px-4">Stok</th>
                            <th class="text-left py-3 px-4">Status</th>
                            <th class="text-left py-3 px-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-dark-300">
                        <?php foreach($dbpaginationbuku as $row):?>
                            <tr class="hover:bg-dark-300/50 transition">
                                <td class="py-3 px-4 font-mono text-xs"><?= 'bk'.$row['id_buku'] ?></td>
                                <td class="py-3 px-4">
                                    <div class="w-8 h-10 bg-dark-400 rounded flex items-center justify-center text-sm">📘</div>
                                </td>
                                <td class="py-3 px-4 font-medium"><?= $row['judul'] ?></td>
                                <td class="py-3 px-4 text-gray-400"><?= $row['penulis'] ?></td>
                                <td class="py-3 px-4 text-gray-400"><?= $row['penerbit'] ?></td>
                            <td class="py-3 px-4 text-gray-400"><?= $row['tahun_terbit'] ?></td>
                            <td class="py-3 px-4"><?= $row['stok_tersedia'] ?></td>
                            <td class="py-3 px-4">
                                 <?php 
                                 $presentase = ($row['stok_total']/100) * $row['stok_tersedia'] * 100;
                                 $presentase = round($presentase);
                                if($row['stok_tersedia'] == 0 ){
                                    echo '<span class="bg-red-500/20 text-red-400 px-2 py-1 rounded-full text-xs">Tidak Tersedia</span>';
                                    }elseif($presentase <= 30){
                                        echo '<span class="bg-yellow-500/20 text-yellow-400 px-2 py-1 rounded-full text-xs">Hampir habis</span>';
                                        }elseif($row['stok_tersedia'] > 0){
                                    echo '<span class="bg-green-500/20 text-green-400 px-2 py-1 rounded-full text-xs">Tersedia </span>';
                                }
                                ?>
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex space-x-2">
                                    <a href="edit_buku.php?id=BK001" class="p-1.5 bg-blue-600/20 text-blue-400 rounded-lg hover:bg-blue-600/30 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>
                                    <a href="#" onclick="return confirm('Yakin ingin menghapus?')" class="p-1.5 bg-red-600/20 text-red-400 rounded-lg hover:bg-red-600/30 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach;?>
                        
                              
                    </tbody>
                </table>
            </div>
            
            <!-- PAGINATION -->
            <div class="flex items-center justify-between px-4 py-3 border-t border-dark-300">
                <div class="text-sm text-gray-400">
                    Menampilkan 1-4 dari <?= $jumlahbuku ?> buku
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