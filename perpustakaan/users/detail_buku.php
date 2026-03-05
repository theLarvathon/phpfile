<?php
session_start();
require '../config/koneksi.php';
// Cek session login (aktifkan nanti)
// if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'anggota') {
//     header('Location: ../public/login.php');
//     exit();
// }




// get id
$id = $_GET['id'];
// ambil db
$db_buku = mysqli_query($connect,"SELECT * FROM books WHERE id_buku = '$id'");
$row_buku = mysqli_fetch_assoc($db_buku);
// PROGRESS BAR STOCK
$stokTersedia=$row_buku['stok_tersedia'];
$stokTotal=$row_buku['stok_total'];
$presentase = ($stokTersedia/$stokTotal) * 100;
$presentase = round($presentase);
//PROGRESS WARNA
if($presentase >= 50){
    $warnabar = 'bg-green-400';
}elseif ($presentase >= 30 && $presentase <=30) {
    $warnabar = 'bg-yellow-400';
}else{
    $warnabar ='bg-red-400';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Buku · Perpustakaan</title>
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
    </style>
</head>
<body class="text-gray-200">

    <!-- NAVBAR (sama dengan sebelumnya) -->
    <nav class="bg-dark-200 border-b border-dark-300 sticky top-0 z-50">
        <!-- ... sama dengan navbar di katalog ... -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-3">
                    <span class="text-2xl font-bold bg-gradient-to-r from-blue-400 to-purple-500 text-transparent bg-clip-text">Syafik</span>
                    <span class="text-gray-400 text-sm hidden sm:inline">· Detail Buku</span>
                </div>
                <div class="hidden md:block flex-1 max-w-md mx-8">
                    <div class="relative">
                        <input type="text" placeholder="Cari judul, penulis, penerbit..." 
                               class="w-full bg-dark-300 border border-dark-400 rounded-lg py-2 pl-10 pr-4 text-sm focus:outline-none focus:border-blue-500 transition">
                        <svg class="absolute left-3 top-2.5 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <button class="p-2 hover:bg-dark-300 rounded-lg transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Back link -->
        <a href="dashboard.php" class="inline-flex items-center text-sm text-gray-400 hover:text-blue-400 transition mb-6">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke homepage
        </a>

        <!-- Detail Buku -->
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Cover -->
            <div class="lg:w-1/3">
                <div class="bg-dark-200 rounded-2xl border border-dark-300 p-6 flex justify-center">
                    <div class="w-64 h-80 bg-gradient-to-br from-dark-400 to-dark-300 rounded-xl flex items-center justify-center text-8xl shadow-2xl">
                        📚
                    </div>
                </div>
            </div>

            <!-- Info Buku -->
            <div class="lg:w-2/3">
                <div class="bg-dark-200 rounded-2xl border border-dark-300 p-6">
                    <h1 class="text-3xl font-bold mb-2"><?= $row_buku['judul'] ?></h1>
                    <p class="text-gray-400 text-lg mb-4"><?= $row_buku['penulis'] ?></p>

                    <!-- Meta info grid -->
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <span class="text-sm text-gray-400 block">Penerbit</span>
                            <span class="font-medium"><?= $row_buku['penerbit'] ?></span>
                        </div>
                        <div>
                            <span class="text-sm text-gray-400 block">Tahun Terbit</span>
                            <span class="font-medium"><?= $row_buku['tahun_terbit'] ?></span>
                        </div>
                        <div>
                            <span class="text-sm text-gray-400 block">Kategori</span>
                            <span class="font-medium"><?= $row_buku['kategori'] ?></span>
                        </div>
                        <div>
                            <span class="text-sm text-gray-400 block">Lokasi Rak</span>
                            <span class="font-medium"><?= $row_buku['lokasi_rak'] ?></span>
                        </div>
                    </div>

                    <!-- Status & Stok -->
                    <div class="bg-dark-300 rounded-xl p-4 mb-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-sm text-gray-400">Status</span>
                                <div class="flex items-center mt-1">
                                    <span class="w-2 h-2 bg-green-400 rounded-full mr-2"></span>
                                    <span class="font-semibold text-green-400">Tersedia</span>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="text-sm text-gray-400">Stok</span>
                                <div class="font-semibold text-xl"><?= $row_buku['stok_tersedia'] ?> <span class="text-sm text-gray-400">/ <?= $row_buku['stok_total'] ?></span></div>
                            </div>
                        </div>
                        <!-- Progress bar -->
                        <div class="w-full bg-dark-400 rounded-full h-2 mt-3">
                            <div class="<?= $warnabar ?> h-2 rounded-full" style="width: <?= $presentase ?>%"></div>
                        </div>
                        <p class="text-xs text-gray-400 mt-2">* 2 buku sedang dipinjam</p>
                    </div>

                    <!-- Action buttons -->
                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="../proses/pinjam_proses.php?id=<?= $row_buku['id_buku'] ?>" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 rounded-xl transition flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Pinjam Buku
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Deskripsi -->
        <div class="mt-8 bg-dark-200 rounded-2xl border border-dark-300 p-6">
            <h2 class="text-xl font-semibold mb-4 flex items-center">
                <span class="w-1 h-6 bg-blue-500 rounded-full mr-3"></span>
                Deskripsi
            </h2>
            <p class="text-gray-300 leading-relaxed">
          <?= $row_buku['deskripsi'] ?>
            </p>
        </div>

        <!-- Buku Lain dari Penulis yang Sama -->
        <div class="mt-8">
            <h2 class="text-xl font-semibold mb-4 flex items-center">
                <span class="w-1 h-6 bg-purple-500 rounded-full mr-3"></span>
                Buku Lain dari <?= $row_buku['penulis'] ?>
            </h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-dark-200 rounded-xl border border-dark-300 p-3">
                    <div class="aspect-[3/4] bg-dark-400 rounded-lg mb-2 flex items-center justify-center text-4xl">📘</div>
                    <h3 class="font-semibold text-sm truncate">Atomic Habits (Hardcover)</h3>
                    <p class="text-xs text-gray-400">James Clear</p>
                    <div class="mt-2">
                        <span class="text-xs text-green-400">Tersedia</span>
                    </div>
                </div>
                <div class="bg-dark-200 rounded-xl border border-dark-300 p-3">
                    <div class="aspect-[3/4] bg-dark-400 rounded-lg mb-2 flex items-center justify-center text-4xl">📙</div>
                    <h3 class="font-semibold text-sm truncate">Atomic Habits (Edisi Inggris)</h3>
                    <p class="text-xs text-gray-400">James Clear</p>
                    <div class="mt-2">
                        <span class="text-xs text-green-400">Tersedia</span>
                    </div>
                </div>
                <div class="bg-dark-200 rounded-xl border border-dark-300 p-3">
                    <div class="aspect-[3/4] bg-dark-400 rounded-lg mb-2 flex items-center justify-center text-4xl">📕</div>
                    <h3 class="font-semibold text-sm truncate">Atomic Habits Workbook</h3>
                    <p class="text-xs text-gray-400">James Clear</p>
                    <div class="mt-2">
                        <span class="text-xs text-red-400">Dipinjam</span>
                    </div>
                </div>
                <div class="bg-dark-200 rounded-xl border border-dark-300 p-3">
                    <div class="aspect-[3/4] bg-dark-400 rounded-lg mb-2 flex items-center justify-center text-4xl">📓</div>
                    <h3 class="font-semibold text-sm truncate">Atomic Habits Summary</h3>
                    <p class="text-xs text-gray-400">James Clear</p>
                    <div class="mt-2">
                        <span class="text-xs text-green-400">Tersedia</span>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- FOOTER -->
 <?php echo include '../includes/footer.php'?>
</body>
</html>