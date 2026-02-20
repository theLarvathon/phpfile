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
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center h-16">
            <div class="text-xl font-bold">📚 Perpustakaan</div>
            <div class="flex space-x-4">
                <a href="../public/index.php" class="hover:text-blue-600">Home</a>
                <a href="../public/daftar_buku.php" class="hover:text-blue-600">Buku</a>
                <?php if(isset($_SESSION['login'])): ?>
                    <a href="../<?= $_SESSION['role'] ?>/dashboard.php" class="hover:text-blue-600">Dashboard</a>
                    <a href="../proses/logout.php" class="hover:text-red-600">Logout</a>
                <?php else: ?>
                    <a href="../public/login.php" class="hover:text-blue-600">Login</a>
                    <a href="../public/register.php" class="hover:text-blue-600">Register</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

<!-- Konten halaman dimulai DI SINI (header.php ditutup, lalu lanjut ke halaman masing-masing) -->