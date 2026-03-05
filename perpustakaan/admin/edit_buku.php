<?php
session_start();
require '../config/koneksi.php';
// if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
//     header('Location: ../public/login.php');
//     exit();
// }

// Ambil data buku berdasarkan ID (contoh hardcode dulu)
// $id = $_GET['id'];
// $query = mysqli_query($koneksi, "SELECT * FROM books WHERE id_buku='$id'");
// $buku = mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku · Syafik Library</title>
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

    <!-- NAVBAR ADMIN (sama seperti tambah_buku.php) -->
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
                <h1 class="text-2xl md:text-3xl font-bold">Edit Buku</h1>
                <p class="text-gray-400 mt-1">Perbarui informasi buku</p>
            </div>
        </div>
    </div>

    <main class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <!-- FORM EDIT BUKU -->
        <div class="bg-dark-200 rounded-xl border border-dark-300 p-6">
            <form action="../proses/edit_buku_proses.php" method="POST" enctype="multipart/form-data">
                <!-- ID Buku (hidden) -->
                <input type="hidden" name="id_buku" value="BK001">
                
                <!-- Grid 2 kolom -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Kiri -->
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm text-gray-400 mb-1">Kode Buku <span class="text-red-400">*</span></label>
                            <input type="text" name="kode_buku" required value="BK001" readonly
                                   class="w-full bg-dark-300/50 border border-dark-400 rounded-lg px-4 py-2.5 text-sm text-gray-400 cursor-not-allowed">
                            <p class="text-xs text-gray-500 mt-1">Kode buku tidak dapat diubah</p>
                        </div>
                        <div>
                            <label class="block text-sm text-gray-400 mb-1">Judul Buku <span class="text-red-400">*</span></label>
                            <input type="text" name="judul" required value="Filosofi Teras"
                                   class="w-full bg-dark-300 border border-dark-400 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-blue-500 transition">
                        </div>
                        <div>
                            <label class="block text-sm text-gray-400 mb-1">Penulis <span class="text-red-400">*</span></label>
                            <input type="text" name="penulis" required value="Henry Manampiring"
                                   class="w-full bg-dark-300 border border-dark-400 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-blue-500 transition">
                        </div>
                        <div>
                            <label class="block text-sm text-gray-400 mb-1">Penerbit</label>
                            <input type="text" name="penerbit" value="Gramedia"
                                   class="w-full bg-dark-300 border border-dark-400 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-blue-500 transition">
                        </div>
                    </div>
                    
                    <!-- Kanan -->
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm text-gray-400 mb-1">Tahun Terbit</label>
                            <input type="number" name="tahun" value="2023"
                                   class="w-full bg-dark-300 border border-dark-400 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-blue-500 transition"
                                   min="1900" max="2025">
                        </div>
                        <div>
                            <label class="block text-sm text-gray-400 mb-1">ISBN</label>
                            <input type="text" name="isbn" value="978-602-1234-56-7"
                                   class="w-full bg-dark-300 border border-dark-400 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-blue-500 transition">
                        </div>
                        <div>
                            <label class="block text-sm text-gray-400 mb-1">Kategori</label>
                            <select name="kategori" class="w-full bg-dark-300 border border-dark-400 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-blue-500 transition">
                                <option value="Fiksi" selected>Fiksi</option>
                                <option value="Nonfiksi">Nonfiksi</option>
                                <option value="Teknologi">Teknologi</option>
                                <option value="Sejarah">Sejarah</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm text-gray-400 mb-1">Lokasi Rak</label>
                            <input type="text" name="rak" value="A1"
                                   class="w-full bg-dark-300 border border-dark-400 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-blue-500 transition">
                        </div>
                    </div>
                </div>

                <!-- Stok (full width) -->
                <div class="grid grid-cols-2 gap-6 mt-4">
                    <div>
                        <label class="block text-sm text-gray-400 mb-1">Stok Total <span class="text-red-400">*</span></label>
                        <input type="number" name="stok_total" required min="1" value="12"
                               class="w-full bg-dark-300 border border-dark-400 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-blue-500 transition">
                    </div>
                    <div>
                        <label class="block text-sm text-gray-400 mb-1">Stok Tersedia</label>
                        <input type="number" name="stok_tersedia" value="10"
                               class="w-full bg-dark-300 border border-dark-400 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-blue-500 transition">
                    </div>
                </div>

                <!-- Deskripsi -->
                <div class="mt-4">
                    <label class="block text-sm text-gray-400 mb-1">Deskripsi / Sinopsis</label>
                    <textarea name="deskripsi" rows="4" 
                              class="w-full bg-dark-300 border border-dark-400 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-blue-500 transition">Buku filsafat praktis yang membahas tentang cara menghadapi hidup dengan stoikisme.</textarea>
                </div>

                <!-- Cover Preview -->
                <div class="mt-4">
                    <label class="block text-sm text-gray-400 mb-1">Cover Buku</label>
                    <div class="flex items-center space-x-4">
                        <div class="w-16 h-20 bg-dark-400 rounded-lg flex items-center justify-center text-3xl">📘</div>
                        <div class="flex-1">
                            <div class="border-2 border-dashed border-dark-400 rounded-lg p-3 text-center hover:border-blue-500/50 transition">
                                <input type="file" name="cover" accept="image/*" class="hidden" id="coverInput">
                                <label for="coverInput" class="cursor-pointer block">
                                    <p class="text-sm text-gray-400">Klik untuk ganti cover</p>
                                    <p class="text-xs text-gray-500">PNG, JPG, JPEG (Maks. 2MB)</p>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tombol Submit -->
                <div class="flex justify-end space-x-3 mt-6 pt-4 border-t border-dark-300">
                    <a href="kelola_buku.php" class="px-5 py-2.5 bg-dark-300 hover:bg-dark-400 text-white rounded-lg text-sm font-medium transition border border-dark-400">
                        Batal
                    </a>
                    <button type="submit" name="update" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition">
                        Update Buku
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