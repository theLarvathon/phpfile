<?php 
require 'connection.php';
$data = QuerySelect('SELECT * FROM onepiece');

if(isset($_POST['search'])){
    $data = Search($_POST['keyword']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- cdn css -->
     <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>app</title>
</head>
<body>
    

<h2 class="text-center p-4 font-semibold text-4xl font-sans text-amber-400"> Daftar Data</h2>

<a class="ml-14 font-semibold p-4 rounded-full bg-blue-400" href="add.php">Tambah data</a>
<form class="ml-60" action="" method="post">
    <input class="p-2 border-1 border=black rounded-sm" type="text" placeholder="cari data" name="keyword">
    <button class="bg-gray-600 text-white rounded-full p-2 font-semibold" type="submit" name="search" autocomplete="off">search</button>
</form>
<table class="m-auto mt-10">

    <tr >
        <th class="p-4 border-2 border-black">No</th>
        <th class="p-4 border-2 border-black">Aksi</th>
        <th class="p-4 border-2 border-black">nama BL</th>
        <th class="p-4 border-2 border-black">Nama Char</th>
        <th class="p-4 border-2 border-black">Posisi</th>
        <th class="p-4 border-2 border-black">lambang</th>
    </tr>
    <?php $i = 1?>
    <?php foreach($data as $row) { ?>
    <tr>
        <td class="p-4 border-2 border-black"><?= $i ?></td>
        <td class="p-4 border-2 border-black">
            <a href="update.php?id=<?= $row['id'] ?>">Ubah</a> |
            <a href="delete.php?id=<?= $row['id'] ?>">Hapus</a>
        </td>
        <td class="p-4 border-2 border-black"><?php echo $row['namabl']?></td>
        <td class="p-4 border-2 border-black"><?php echo $row['nama']?></td>
        <td class="p-4 border-2 border-black"><?php echo $row['posisi']?></td>
        <td  class="p-4 border-2 border-black"><img class="h-14 w-14" src="img/<?=  $row['lambangbl']  ?>?>" alt=""></td>
    </tr>
    <?php $i++?>
    <?php }?>
</table>

</body>
</html>