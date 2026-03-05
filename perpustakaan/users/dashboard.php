<?php
session_start();
require '../config/koneksi.php';
// jika admin
if(isset($_SESSION['login']) && $_SESSION['role'] == 'admin'){
    header('Location: ../admin/dashboard.php');
    exit();
}
// Cek session login 
if(!isset($_SESSION['login']) || $_SESSION['role'] != 'anggota') {
    header('Location: ../public/login.php');
    exit();
}

// ============================================ SESSSION untuk alert ==================================================
$erraddloans = $_SESSION['addloanserror'] ??null;
$errdelloans = $_SESSION['deleteloanserror'] ??null;
$errstok = $_SESSION['stokhabis'] ??null;
$errcek = $_SESSION['errorcek'] ??null;


$addloans = $_SESSION['addloanssucces'] ??null;
$delloans = $_SESSION['deleteloanssucces'] ??null;




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Anggota · Perpustakaan</title>
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
    
    <!-- NAVBAR -->
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

                <!-- Right Menu -->
                <div class="flex items-center space-x-4">
                    <button class="p-2 hover:bg-dark-300 rounded-lg transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                    </button>
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

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">


        <!--=========================================== alert ======================================== 
        
        
        
        <?php if(isset($_SESSION['stokhabis'])){?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative my-8" role="alert">
            <span class="block sm:inline"><?php echo $_SESSION['stokhabis']; ?></span>
        </div>
        <?php unset($_SESSION['stokhabis']) ?>
        <?php }?>
        
        
        
        
        <?php if(isset($_SESSION['addloanssucces'])): ?>
            <div id="div-addloanssucces" style="display: none;" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span id="target-addloanssucces" class="block sm:inline"><?php echo $_SESSION['addloanssucces']; ?></span>
        </div>
        <?php unset($_SESSION['addloanssucces']); ?>
        <?php endif; ?>
        <?php if(isset($_SESSION['addloanserror'])): ?>
            <div id="div-addloanserror"  class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline"><?php echo $_SESSION['addloanserror']; ?></span>
        </div>
        <?php unset($_SESSION['addloanserror']); ?>
        <?php endif; ?>
        
        
        <?php if(isset($_SESSION['returnloanssucces'])): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline"><?php echo $_SESSION['returnloanssucces']; ?></span>
            </div>
            <?php unset($_SESSION['returnloanssucces']); ?>
            <?php endif; ?>
            <?php if(isset($_SESSION['returnloanserror'])): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline"><?php echo $_SESSION['returnloanserror']; ?></span>
                </div>
                <?php unset($_SESSION['returnloanserror']); ?>
                <?php endif; ?>
                
                
                <?php if(isset($_SESSION['error'])): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline"><?php echo $_SESSION['error']; ?></span>
                    </div>
                    <?php unset($_SESSION['error']); ?>
                    <?php endif; ?>
                    
                    -->

        <!--============================================= WELCOME SECTION ===============================================-->
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8">
            <div>
                <?php if(isset($_SESSION['username'])):?>
                <h1 class="text-2xl md:text-3xl font-bold">Selamat datang kembali, <span class="text-blue-400"><?= $_SESSION['username'] ?></span></h1>
                <?php endif;?>
                <?php if(isset($_SESSION['tanggal'])):?>
                <p class="text-gray-400 mt-1">bergabung pada <?php echo $_SESSION['tanggal']?></p>
                <?php endif;?>
            </div>
            <div class="flex items-center space-x-3 mt-4 md:mt-0">
                <!-- TOMBOL KATALOG BARU -->
                <a href="katalog.php" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Jelajahi Katalog
                </a>
                <div class="bg-dark-200 rounded-lg px-4 py-2 border border-dark-300">
                    <span class="text-sm text-gray-400">Pinjaman</span>
                    <div class="text-2xl font-bold text-blue-400"><?= $sedangdipinjamuser ?></div>
                </div>
                <div class="bg-dark-200 rounded-lg px-4 py-2 border border-dark-300">
                    <span class="text-sm text-gray-400">Jatuh tempo</span>
                    <div class="text-2xl font-bold text-yellow-400">1</div>
                </div>
                <div class="bg-dark-200 rounded-lg px-4 py-2 border border-dark-300">
                    <span class="text-sm text-gray-400">Denda</span>
                    <div class="text-2xl font-bold text-red-400">Rp0</div>
                </div>
            </div>
        </div>

        <!-- ====================================== SEDANG DIPINJAM ===============================================-->
        <section class="mb-10">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold flex items-center">
                    <span class="w-1 h-6 bg-blue-500 rounded-full mr-3"></span>
                    Buku Sedang Dipinjam
                </h2>
                <a href="peminjaman_saya.php" class="text-sm text-blue-400 hover:text-blue-300 transition">Lihat semua →</a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <!-- Item 1 -->
                 <?php foreach($bukuds as $row):?>
                    <div class="bg-dark-200 rounded-xl border border-dark-300 p-4 card-hover">
                        <div class="flex space-x-4">
                            <div class="w-16 h-20 bg-dark-400 rounded-lg flex-shrink-0 flex items-center justify-center text-2xl">📘</div>
                            <div class="flex-1">
                                <h3 class="font-semibold"><?= $row['judul'] ?></h3>
                            <p class="text-sm text-gray-400"><?= $row['penulis'] ?></p>
                            <div class="mt-2 flex items-center justify-between">
                                <a href="detail_buku.php?id=<?= $row['id_buku'] ?>">
                                    <button class="text-xs text-blue-400 hover:text-blue-300">Detail</button>
                                </a>
                                <a href="../proses/kembalikan_proses.php?id=<?= $row['id_buku'] ?>" class="text-sm bg-blue-600 hover:bg-blue-700 rounded py-1 px-2 transition">Kembalikan</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach;?>
            </div>
        </section>
        
        <!-- ======================================== REKOMENDASI BUKU ====================================== -->
        <section class="mb-10">
            <h2 class="text-xl font-semibold mb-4 flex items-center">
                <span class="w-1 h-6 bg-purple-500 rounded-full mr-3"></span>
                Rekomendasi Untukmu
            </h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                <!-- Item 1 -->
                <?php foreach($dbrekom as $rowrekom):?>
                    <div class="bg-dark-200 rounded-xl border border-dark-300 p-3 card-hover">
                        <img class="aspect-[3/4] bg-dark-400 rounded-lg mb-2 flex items-center justify-center text-4xl" src="<?= $rowrekom['sampul'] ?>"></img>
                        <h3 class="font-semibold text-sm truncate"><?= $rowrekom['judul'] ?></h3>
                        <p class="text-xs text-gray-400 truncate"><?= $rowrekom['penulis'] ?></p>
                        <div class="mt-2 flex items-center justify-between">
                            <span class="text-xs text-green-400">Tersedia</span>
                            
                            <a href="../proses/pinjam_proses.php?id=<?= $rowrekom['id_buku'] ?>" class="text-xs bg-blue-600 hover:bg-blue-700 px-2 py-1 rounded transition">Pinjam</a>
                        </div>
                    </div>
                    <?php endforeach;?>
            </div>
        </section>

        <!-- RIWAYAT TERAKHIR -->
        <section>
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold flex items-center">
                    <span class="w-1 h-6 bg-green-500 rounded-full mr-3"></span>
                    Riwayat Peminjaman
                </h2>
                <a href="peminjaman_saya.php" class="text-sm text-blue-400 hover:text-blue-300">Semua riwayat →</a>
            </div>
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
                            <td class="py-3 px-4">Pemrograman PHP</td>
                            <td class="py-3 px-4">10 Feb 2025</td>
                            <td class="py-3 px-4">17 Feb 2025</td>
                            <td class="py-3 px-4"><span class="bg-green-500/20 text-green-400 px-2 py-1 rounded-full text-xs">Tepat waktu</span></td>
                        </tr>
                        <tr class="hover:bg-dark-300/50 transition">
                            <td class="py-3 px-4">2</td>
                            <td class="py-3 px-4">Database MySQL</td>
                            <td class="py-3 px-4">03 Feb 2025</td>
                            <td class="py-3 px-4">10 Feb 2025</td>
                            <td class="py-3 px-4"><span class="bg-red-500/20 text-red-400 px-2 py-1 rounded-full text-xs">Terlambat 2 hari</span></td>
                        </tr>
                        <tr class="hover:bg-dark-300/50 transition">
                            <td class="py-3 px-4">3</td>
                            <td class="py-3 px-4">HTML & CSS</td>
                            <td class="py-3 px-4">25 Jan 2025</td>
                            <td class="py-3 px-4">01 Feb 2025</td>
                            <td class="py-3 px-4"><span class="bg-green-500/20 text-green-400 px-2 py-1 rounded-full text-xs">Tepat waktu</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <!-- FOOTER -->
      <?php echo include '../includes/footer.php' ?>
     

<script>
        <?php if ($erraddloans): ?>
            alert("<?php echo $erraddloans; ?>");
        <?php endif; ?>
        
        <?php if ($addloans): ?>
            alert("<?php echo $addloans; ?>");
        <?php endif; ?>
        <?php if ($delloans): ?>
            alert("<?php echo $delloans; ?>");
        <?php endif; ?>
        <?php if ($errdelloans): ?>
            alert("<?php echo $errdelloans; ?>");
        <?php endif; ?>
        <?php if ($errstok): ?>
            alert("<?php echo $errstok; ?>");
        <?php endif; ?>
        <?php if ($errcek): ?>
            alert("<?php echo $errcek; ?>");
        <?php endif; ?>
       
    </script>
    <?php 
    unset(
    $_SESSION['addloanserror'],
    $_SESSION['returnloanserror'],
    $_SESSION['stokhabis'],
    $_SESSION['addloanssuccess'],
    $_SESSION['returnloanssuccess'],
    $_SESSION['errorcek']
);
    
    ?>
</body>
</html>