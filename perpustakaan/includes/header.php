<!-- header.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan - <?= $page_title ?? 'Beranda' ?></title>
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 ">

<!-- NAVBAR - muncul di semua halaman -->
<nav class="bg-gray-800 shadow-lg text-white">
    <div class="container mx-auto px-8">
        <div class="flex justify-between text-lg items-center h-24">
            <div class="text-3xl font-bold">📚 Perpustakaan</div>
            <div class="flex space-x-4 ">
                <a href="../public/index.php" class="hover:text-blue-600">Home</a>
                <a href="../public/daftar_buku.php" class="hover:text-blue-600">Buku</a>
                <a href="../public/login.php" class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition duration-300 flex items-center">
                    <i class="fas fa-sign-in-alt mr-1"></i> <span class="hidden sm:inline">Login</span>
                </a>
                <a href="../public/register.php" class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm font-semibold transition duration-300 hidden sm:flex items-center">
                    <i class="fas fa-user-plus mr-1"></i> Register
                </a>
    
            </div>
        </div>
    </div>
</nav>

<!-- Konten halaman dimulai DI SINI (header.php ditutup, lalu lanjut ke halaman masing-masing) -->