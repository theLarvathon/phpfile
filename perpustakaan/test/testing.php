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

















 <!-- Modal Bayar (hidden) -->
    <div id="paymentModal" class="fixed inset-0 bg-black/80 backdrop-blur-sm flex items-center justify-center hidden z-50">
        <div class="bg-dark-200 border border-dark-300 rounded-xl max-w-md w-full p-6">
            <h3 class="text-xl font-bold mb-4">Konfirmasi Pembayaran</h3>
            <p class="text-gray-400 text-sm mb-6">Denda untuk <span class="text-white">Atomic Habits</span> sebesar</p>
            <p class="text-3xl font-bold text-yellow-400 mb-6">Rp 25.000</p>
            <div class="flex gap-3">
                
                <button class="flex-1 bg-dark-300 hover:bg-dark-400 border border-dark-400 text-white py-2 rounded-lg transition">Batal</button>
                <button class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg transition">Ya, Bayar</button>
            </div>
        </div>
    </div>

    <script>
        // Simple modal toggle (untuk demo)
        document.querySelectorAll('.bg-blue-600').forEach(btn => {
            btn.addEventListener('click', function(e) {
                if(this.textContent.includes('Bayar')) {
                    document.getElementById('paymentModal').classList.remove('hidden');
                }
            });
        });
        document.querySelector('#paymentModal .bg-dark-300').addEventListener('click', function() {
            document.getElementById('paymentModal').classList.add('hidden');
        });
    </script>