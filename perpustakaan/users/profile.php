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
    <title>Profil Saya · Syafik Library</title>
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

    <!-- NAVBAR -->
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
                    <a href="peminjaman_saya.php" class="text-gray-400 hover:text-white text-sm transition">Peminjaman</a>
                </div>

                <!-- Right Menu -->
                <div class="flex items-center space-x-3">
                    <span class="text-white text-sm border-b border-blue-500 pb-1">Profil</span>
                    <a href="../proses/logout_proses.php" class="bg-dark-300 hover:bg-dark-400 text-white px-4 py-2 rounded-lg text-sm font-medium transition border border-dark-400">Keluar</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- HEADER HALAMAN -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-2xl md:text-3xl font-bold">Profil Saya</h1>
        <p class="text-gray-400 mt-1">Informasi keanggotaan dan akun</p>
    </div>

    <main class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <!-- Profile Card -->
        <div class="bg-dark-200 rounded-xl border border-dark-300 p-6">
            
            <!-- Avatar & Info Dasar -->
            <div class="flex items-center space-x-6 border-b border-dark-300 pb-6">
                <div class="w-20 h-20 bg-dark-400 rounded-full flex items-center justify-center text-4xl">
                    👤
                </div>
                <div>
                    <h2 class="text-2xl font-semibold">Raden Adjeng</h2>
                    <p class="text-gray-400 text-sm">Anggota · AGT-2402-001</p>
                    <p class="text-gray-500 text-xs mt-1">Terdaftar sejak 12 Des 2024</p>
                </div>
            </div>

            <!-- Detail Info (style seperti tabel) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 py-6">
                <div>
                    <label class="text-gray-500 text-xs uppercase tracking-wider">Nama Lengkap</label>
                    <p class="text-white border-b border-dark-300 pb-2 mt-1">Raden Adjeng Kartini</p>
                </div>
                <div>
                    <label class="text-gray-500 text-xs uppercase tracking-wider">Email</label>
                    <p class="text-white border-b border-dark-300 pb-2 mt-1">r.kartini@mail.com</p>
                </div>
                <div>
                    <label class="text-gray-500 text-xs uppercase tracking-wider">Nomor Telepon</label>
                    <p class="text-white border-b border-dark-300 pb-2 mt-1">+62 812 3456 7890</p>
                </div>
                <div>
                    <label class="text-gray-500 text-xs uppercase tracking-wider">Tanggal Lahir</label>
                    <p class="text-white border-b border-dark-300 pb-2 mt-1">21 April 1999</p>
                </div>
                <div class="md:col-span-2">
                    <label class="text-gray-500 text-xs uppercase tracking-wider">Alamat</label>
                    <p class="text-white border-b border-dark-300 pb-2 mt-1">Jl. Bunga No. 10, Yogyakarta</p>
                </div>
            </div>

            <!-- Statistik (seperti di dashboard) -->
            <div class="grid grid-cols-3 gap-4 py-6 border-t border-dark-300">
                <div class="text-center">
                    <p class="text-2xl font-bold text-blue-400">12</p>
                    <p class="text-gray-400 text-xs">Total Pinjam</p>
                </div>
                <div class="text-center">
                    <p class="text-2xl font-bold text-yellow-400">2</p>
                    <p class="text-gray-400 text-xs">Sedang Dipinjam</p>
                </div>
                <div class="text-center">
                    <p class="text-2xl font-bold text-green-400">0RP</p>
                    <p class="text-gray-400 text-xs">Denda</p>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex gap-3 pt-4 border-t border-dark-300">
                <button class="bg-dark-300 hover:bg-dark-400 text-white px-5 py-2 rounded-lg text-sm font-medium transition border border-dark-400">
                    Ubah Password
                </button>
                <button class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg text-sm font-medium transition ml-auto">
                    Edit Profil
                </button>
            </div>
        </div>

        <!-- Aktivitas Terakhir -->
        <div class="mt-8">
            <h2 class="text-lg font-semibold mb-3 flex items-center">
                <