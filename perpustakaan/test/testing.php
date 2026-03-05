<?php 
// Di file cek_login.php atau proses_pinjam.php
$id_user = $_SESSION['id_user'];

// Ambil data anggota termasuk masa_berlaku
$query = "SELECT members.* FROM members WHERE id_user = '$id_user'";
$data = mysqli_fetch_assoc(mysqli_query($koneksi, $query));

$sekarang = date('Y-m-d');

// CEK, apakah masih berlaku?
if ($data['masa_berlaku'] < $sekarang) {
    // KADALUARSA! Tolak akses pinjam
    echo "Maaf, keanggotaan Anda sudah habis. Hubungi admin untuk perpanjang.";
    exit;
} else {
    // MASIH BERLAKU, lanjutkan proses
}

?>
<!-- Card Buku 2 (Dipinjam) -->
            <div class="bg-dark-200 rounded-xl border border-dark-300 p-3 card-hover opacity-90">
                <div class="aspect-[3/4] bg-dark-400 rounded-lg mb-2 flex items-center justify-center text-4xl">📕</div>
                <h3 class="font-semibold text-sm truncate">Atomic Habits</h3>
                <p class="text-xs text-gray-400 truncate">James Clear</p>
                <div class="mt-2 flex items-center justify-between">
                    <span class="text-xs text-yellow-400">Dipinjam</span>
                    <span class="text-xs text-gray-400">2024</span>
                </div>
                <button class="w-full mt-2 text-xs bg-dark-400 text-gray-300 px-2 py-1.5 rounded cursor-default" disabled>Tak Tersedia</button>
            </div>