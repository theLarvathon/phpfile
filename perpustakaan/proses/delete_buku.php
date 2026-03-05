<?php
session_start();
require '../config/koneksi.php';
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'anggota') {
    header('Location: ../public/login.php');
    exit();
}

// Ambil data buku berdasarkan ID (contoh)
// $id = $_GET['id'];
// $query = mysqli_query($koneksi, "SELECT * FROM books WHERE id_buku='$id'");
// $buku = mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Peminjaman · Syafik Library</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- ... tailwind config sama seperti sebelumnya ... -->
</head>
<body class="bg-[#0f0f17] text-gray-200">

    <!-- NAVBAR (sama seperti halaman anggota) -->
    <!-- ... -->

    <main class="max-w-2xl mx-auto px-4 py-8">
        <div class="bg-dark-200 rounded-xl border border-dark-300 p-6">
            <h1 class="text-2xl font-bold mb-2">Konfirmasi Peminjaman</h1>
            <p class="text-gray-400 text-sm mb-6">Pastikan data berikut sebelum meminjam</p>

            <!-- Detail Buku -->
            <div class="flex space-x-4 pb-4 border-b border-dark-300">
                <div class="w-20 h-24 bg-dark-400 rounded-lg flex items-center justify-center text-4xl">
                    📘
                </div>
                <div class="flex-1">
                    <h2 class="text-xl font-semibold">Filosofi Teras</h2>
                    <p class="text-gray-400">Henry Manampiring</p>
                    <p class="text-sm text-gray-500 mt-1">ISBN: 978-602-1234-56-7</p>
                </div>
            </div>

            <!-- Informasi Peminjaman -->
            <div class="py-4 space-y-3 border-b border-dark-300">
                <div class="flex justify-between">
                    <span class="text-gray-400">Tanggal Pinjam</span>
                    <span class="font-medium"><?= date('d F Y') ?></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-400">Tanggal Jatuh Tempo</span>
                    <span class="font-medium"><?= date('d F Y', strtotime('+7 days')) ?></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-400">Lama Peminjaman</span>
                    <span class="font-medium">7 Hari</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-400">Stok Tersedia</span>
                    <span class="text-green-400 font-medium">12 buah</span>
                </div>
            </div>

            <!-- Informasi Anggota -->
            <div class="py-4 border-b border-dark-300">
                <p class="text-sm text-gray-400 mb-2">Peminjam:</p>
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-dark-400 rounded-full flex items-center justify-center">
                        👤
                    </div>
                    <div>
                        <p class="font-medium">Raden Adjeng</p>
                        <p class="text-xs text-gray-500">AGT-2402-001</p>
                    </div>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex justify-end space-x-3 mt-6">
                <a href="katalog.php" class="px-5 py-2.5 bg-dark-300 hover:bg-dark-400 text-white rounded-lg text-sm transition border border-dark-400">
                    Batal
                </a>
                <a href="pinjam_proses.php?id=BK001&confirm=yes" 
                   onclick="return confirm('Konfirmasi peminjaman?')"
                   class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm transition">
                    Ya, Pinjam Buku
                </a>
            </div>
        </div>
    </main>

    <!-- FOOTER -->
    <!-- ... -->
</body>
</html>