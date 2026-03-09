<?php
session_start();
require '../config/koneksi.php';
// jika admin


if($_SESSION['role'] != 'admin'){
        
        header('Location: ../public/login.php');
        exit();
};
if(!isset($_SESSION['id_user'])) {
    header('Location: ../public/login.php');
    exit();
};

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku · Syafik Library</title>
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
        <div class="flex items-center space-x-4">
            <a href="kelola_buku.php" class="p-2 bg-dark-200 rounded-lg hover:bg-dark-300 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <div>
                <h1 class="text-2xl md:text-3xl font-bold">Tambah Buku Baru</h1>
                <p class="text-gray-400 mt-1">Isi form berikut untuk menambahkan koleksi buku</p>
            </div>
        </div>
    </div>

    <main class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <!-- FORM TAMBAH BUKU -->
        <div class="bg-dark-200 rounded-xl border border-dark-300 p-6">
            <form action="../proses/tambah_buku.php" method="POST" enctype="multipart/form-data">
                 <?php if(isset($_SESSION['addbooksucces'])): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline"><?php echo $_SESSION['addbooksucces']; ?></span>
                </div>
                <?php unset($_SESSION['addbooksucces']); ?>
                <?php endif; ?>
                 <?php if(isset($_SESSION['addbookerror'])): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline"><?php echo $_SESSION['addbookerror']; ?></span>
                </div>
                <?php unset($_SESSION['addbookerror']); ?>
                <?php endif; ?>
                <!-- Grid 2 kolom -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Kiri -->
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm text-gray-400 mb-1">Judul Buku <span class="text-red-400">*</span></label>
                            <input type="text" name="judul" required 
                                   class="w-full bg-dark-300 border border-dark-400 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-blue-500 transition"
                                   placeholder="Masukkan judul buku">
                        </div>
                        <div>
                            <label class="block text-sm text-gray-400 mb-1">Penulis <span class="text-red-400">*</span></label>
                            <input type="text" name="penulis" required 
                                   class="w-full bg-dark-300 border border-dark-400 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-blue-500 transition"
                                   placeholder="Nama penulis">
                        </div>
                        <div>
                            <label class="block text-sm text-gray-400 mb-1">Penerbit</label>
                            <input type="text" name="penerbit" 
                                   class="w-full bg-dark-300 border border-dark-400 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-blue-500 transition"
                                   placeholder="Nama penerbit">
                        </div>
                    </div>
                    
                    <!-- Kanan -->
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm text-gray-400 mb-1">Tahun Terbit</label>
                            <input type="number" name="tahun" 
                                   class="w-full bg-dark-300 border border-dark-400 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-blue-500 transition"
                                   placeholder="2025" min="1900" max="2025">
                        </div>
                        <div>
                            <label class="block text-sm text-gray-400 mb-1">Kategori</label>
                            <select name="kategori" class="w-full bg-dark-300 border border-dark-400 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-blue-500 transition">
                                <option value="Agama">Agama</option>
                                <option value="Fiksi">Fiksi</option>
                                <option value="Filsafat">Filsafat</option>
                                <option value="Hukum">Hukum</option>
                                <option value="Kedokteran">Kedokteran</option>
                                <option value="Keuangan">Keuangan</option>
                                <option value="Kuliner">Kuliner</option>
                                <option value="Nonfiksi">Nonfiksi</option>
                                <option value="Olahraga">Olahraga</option>
                                <option value="Pendidikan">Pendidikan</option>
                                <option value="Psikologi">Psikologi</option>
                                <option value="Sains">Sains</option>
                                <option value="Sejarah">Sejarah</option>
                                <option value="Seni">Seni</option>
                                <option value="Teknologi">Teknologi</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm text-gray-400 mb-1">Lokasi Rak</label>
                            <input type="text" name="rak" 
                                   class="w-full bg-dark-300 border border-dark-400 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-blue-500 transition"
                                   placeholder="Contoh: A1, B2, dll">
                        </div>
                    </div>
                </div>

                <!-- Stok (full width) -->
                <div class="grid grid-cols-2 gap-6 mt-4">
                    <div>
                        <label class="block text-sm text-gray-400 mb-1">Stok Total <span class="text-red-400">*</span></label>
                        <input type="number" name="stok_total" required min="1" 
                               class="w-full bg-dark-300 border border-dark-400 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-blue-500 transition"
                               placeholder="Jumlah buku">
                    </div>
                    <div>
                        <label class="block text-sm text-gray-400 mb-1">Stok Tersedia</label>
                        <input type="number" name="stok_tersedia" 
                               class="w-full bg-dark-300 border border-dark-400 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-blue-500 transition"
                               placeholder="Kosongkan jika sama dengan stok total">
                        <p class="text-xs text-gray-500 mt-1">Kosongkan jika sama dengan stok total</p>
                    </div>
                </div>

                <!-- Deskripsi -->
                <div class="mt-4">
                    <label class="block text-sm text-gray-400 mb-1">Deskripsi / Sinopsis</label>
                    <textarea name="deskripsi" rows="4" 
                              class="w-full bg-dark-300 border border-dark-400 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-blue-500 transition"
                              placeholder="Tulis deskripsi singkat tentang buku..."></textarea>
                </div>

                <!-- Upload Cover -->
                <!-- <div class="mt-4">
                    <label class="block text-sm text-gray-400 mb-1">Cover Buku</label>
                    <div class="border-2 border-dashed border-dark-400 rounded-lg p-6 text-center hover:border-blue-500/50 transition">
                        <input type="file" name="cover" accept="image/*" class="hidden" id="coverInput">
                        <label for="coverInput" class="cursor-pointer">
                            <svg class="w-10 h-10 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <p class="text-sm text-gray-400 mt-2">Klik untuk upload cover buku</p>
                            <p class="text-xs text-gray-500">PNG, JPG, JPEG (Maks. 2MB)</p>
                        </label>
                    </div>
                </div> -->

                <!-- Tombol Submit -->
                <div class="flex justify-end space-x-3 mt-6 pt-4 border-t border-dark-300">
                    <a href="kelola_buku.php" class="px-5 py-2.5 bg-dark-300 hover:bg-dark-400 text-white rounded-lg text-sm font-medium transition border border-dark-400">
                        Batal
                    </a>
                    <button type="submit" name="submit" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition">
                        Simpan Buku
                    </button>
                </div>
            </form>
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