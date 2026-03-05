<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$connect = mysqli_connect('localhost','root','','perpus');
$querybuku="SELECT * FROM books LIMIT 3";
$querydaftarbuku="SELECT * FROM books ";
$querybukuTerbaru="SELECT * FROM books ORDER BY id_buku DESC LIMIT 4";
$querybukurekomendasi="SELECT * FROM books ORDER BY stok_tersedia DESC LIMIT 5 OFFSET 1";
$queryusers="SELECT * FROM users";
$dbusers = mysqli_query($connect,$queryusers);
$rowusers = mysqli_fetch_assoc($dbusers);

$id_users = (int)$_SESSION['id_user'] ?? null;

function QuerySelect($quer){
    global $connect;
    $res = mysqli_query($connect,$quer);
    $rows = [];
    while ($row = mysqli_fetch_assoc($res)){
        $rows[] = $row;
    };
    return $rows;
};
function Searchbuku($data){
    $query = "SELECT * FROM books WHERE judul LIKE '%$data$' OR penulis LIKE '%$data%' OR penerbit LIKE '%$data%'";
    return QuerySelect($query);
}
function Searchanggota($data){
    $query = "SELECT * FROM users WHERE username LIKE '%$data$' OR email LIKE '%$data%' OR status LIKE '%$data%'";
    return QuerySelect($query);
}
$dbdaftarbuku = QuerySelect($querydaftarbuku);
$db = QuerySelect($querybuku);
$dbrekom = QuerySelect($querybukurekomendasi);
$dbindex = QuerySelect($querybukuTerbaru);
$dbpeminjamanterbaru = QuerySelect("SELECT b.*,u.status, l.tanggal_pinjam, u.username FROM loans AS l 
JOIN books AS b ON l.id_buku = b.id_buku 
INNER JOIN users AS u ON l.id_user = u.id_user 
WHERE l.status = 'dipinjam' 
ORDER BY l.id_pinjam DESC 
LIMIT 3");

//========================================= anggota =========================================

$jumlahanggotaaktif = count(QuerySelect("SELECT * FROM users WHERE status = 'aktif'"));
$bulan = date('Y-m-d',strtotime("-1 month"));
$jumlahanggotabulanterakhir = count(QuerySelect("SELECT * FROM users WHERE $bulan < now()"));

// ======================================= loans =============================================
// Query untuk mengambil buku yang sedang dipinjam oleh user ini
$queryds = "SELECT b.*, l.tanggal_pinjam, l.tanggal_tenggat, l.status 
          FROM loans AS l
          JOIN books AS b ON l.id_buku = b.id_buku
          WHERE l.id_user = $id_users 
          AND l.status = 'dipinjam' 
          ORDER BY l.id_pinjam DESC
          LIMIt 3";

$querysy = "SELECT b.*, l.tanggal_pinjam, l.tanggal_tenggat, l.status 
          FROM loans AS l
          JOIN books AS b ON l.id_buku = b.id_buku
          WHERE l.id_user = $id_users 
          AND l.status = 'dipinjam' 
          ORDER BY l.id_pinjam DESC";
          


$bukupeminjamansy = QuerySelect($querysy);
$bukuds = QuerySelect($queryds);

$sedangdipinjamuser = count(QuerySelect("SELECT id_buku FROM loans WHERE id_user = $id_users AND status = 'dipinjam'"));
$sedangminjam = count(QuerySelect("SELECT DISTINCT id_user FROM loans "));
$totalpinjam = count(QuerySelect("SELECT * FROM loans "));
$totalpeminjamanaktif = count(QuerySelect("SELECT * FROM loans WHERE status = 'dipinjam' "));
$totalpeminjamanterlambat = count(QuerySelect("SELECT * FROM loans WHERE status = 'terlambat' "));
$bukudipinjam = count(QuerySelect("SELECT DISTINCT id_buku FROM loans"));
$bukudikembalikan = count(QuerySelect("SELECT DISTINCT id_buku FROM loans WHERE status = 'dikembalikan'"));


// ======================================= pagination buku =============================================
$jumlahbuku = count(QuerySelect("SELECT * FROM books"));
$dataperpage = 5;
$jumlahpage = ceil($jumlahbuku/$dataperpage);
$pageaktif = (isset($_GET['halaman'])) ? $_GET['halaman'] : 1;
$indexpertama = ($dataperpage*$pageaktif)-$dataperpage;

$dbpaginationbuku = QuerySelect("SELECT * FROM books LIMIT $indexpertama,$dataperpage"); 
//======================================== pagination anggota ===========================================
$jumlahanggota = count(QuerySelect("SELECT * FROM users"));
$jumlahpageanggota = ceil($jumlahanggota/$dataperpage);
$indexpertamaanggota = ($dataperpage*$pageaktif)-$dataperpage;

$dbpaginationanggota = QuerySelect("SELECT * FROM users LIMIT $indexpertamaanggota,$dataperpage");
//======================================== pagination katalog ===========================================
$dataperpagektlg = 8;
$jumlahpagektl = ceil($jumlahbuku/$dataperpagektlg);
$indexpertamaktlg = ($dataperpagektlg*$pageaktif)-$dataperpagektlg;

$dbpaginationbukuktlg = QuerySelect("SELECT * FROM books LIMIT $indexpertamaktlg,$dataperpagektlg"); 
