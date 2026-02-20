<?php 
session_start();
if (!isset($_SESSION['login'])){
    header('Location: login.php');
    exit;
}
require 'connection.php';

if (isset($_POST['submit'])){
    $namabl = htmlspecialchars($_POST['namabl']);
    $nama = htmlspecialchars($_POST['nama']);
    $posisi= htmlspecialchars($_POST['posisi']);
    $lambangbl = htmlspecialchars($_POST['lambangbl']);

    $res = QueryInsert("INSERT INTO onepiece VALUES ('','$namabl','$nama','$posisi','$lambangbl')");

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css cdn -->
     <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>add</title>
</head>
<body class="bg-gray-900 h-screen flex items-center justify-center">
    

    <section class="font-sans font-semibold bg-slate-200 p-8 rounded-md">
    <h2 class="text-4xl text-center my-10 font-bold text-gray-800 font-sans ">Tambah Data</h2>
    <?php 
     if (mysqli_affected_rows($connect) > 0  ){
      echo "<p class='text-center text-green-600 italic'>berhasil menambahkan data</p>";
    }else{
        echo "gagal";
        mysqli_errno($connect);
    }

    ?>
    <form action="" method="post">
        <div >
            <label for="namabl">Nama Bajak Laut/Team :</label>
            <input class="my-2  ml-4 w-60 border-1 border-black bg-gray-300 rounded-sm p-1" type="text" name="namabl" id="namabl" required>
        </div>
        <div>
            <label for="nama">Nama Character     :</label>
            <input  class="my-2 ml-16 w-60 border-1 border-black bg-gray-300 rounded-sm p-1"type="text" name="nama" id="nama" required>
        </div>
        <div>
            <label for="posisi">Posisi Character   :</label>
            <input class="my-2 ml-17 w-60 border-1 border-black bg-gray-300 rounded-sm p-1" type="text" name="posisi" id="posisi" required>
        </div>
        <div>
            <label for="lambangbl">lambang bendera      :</label>
            <input class="my-2 ml-14 w-60 border-1 border-black bg-gray-300 rounded-sm p-1" type="text" name="lambangbl" id="lambangbl" required>
        </div>
        <div class="flex justify-center">
            <button class="mx-10 my-4 bg-gray-600 text-white rounded-full px-4 p-2 font-semibold"  name="submit" type="submit">Kirim</button>
        </div>
    </form>
    <div>
        <a class="text-blue-500" href="index.php">KEMBALI KE HALAMAN UTAMA</a>
    </div>
</section>

</body>
</html>