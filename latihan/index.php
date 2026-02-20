<?php 
session_start();
require 'connection.php';
if (!isset($_SESSION['login'])){
    header('Location: login.php');
    exit;
}
//paganation
$countdatadividepage= 4;
$countdata=count(QuerySelect("SELECT * FROM onepiece"));
$countpage=ceil($countdata/$countdatadividepage);
$pageactive = (isset($_GET['halaman'])) ? $_GET['halaman']: 1;
$firstindex = ($countdatadividepage * $pageactive)-$countdatadividepage;

var_dump($firstindex);
var_dump($pageactive);
var_dump($countpage);

$data = QuerySelect("SELECT * FROM onepiece LIMIT $firstindex, $countdatadividepage ");

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
    <section class="flex justify-center gap-4">
        
        <div>
            <a class=" font-semibold p-4 rounded-full bg-blue-400" href="add.php">Tambah data</a>
        </div>
        <form class="" action="" method="post">
            <input class="p-2 border-1 border-black rounded-sm" type="text" placeholder="cari data" name="keyword">
            <button class="bg-gray-600 text-white rounded-full p-2 font-semibold" type="submit" name="search" autocomplete="off">search</button>
        </form>
        <div>
            <a class="mx-10 my-4 bg-gray-600 text-white rounded-full px-4 p-2 font-semibold"  href="logout.php">logout</a>
        </div>
        <div>
            <?php if($pageactive > 1){?>
            <a href="?halaman=<?= $pageactive - 1 ?>">prev</a>
            <?php }?>
            <?php for ($i=1; $i <= $countpage ; $i++) {?>
            <?php if($i == $pageactive){?>
            <a class="font-bold text-2xl font-sans " href="?halaman=<?= $i ?>"><?= $i ?></a> 
            <?php }else{?>
            <a href="?halaman=<?= $i ?>"><?= $i  ?></a> 
            <?php }?>
            <?php }?>
            <?php if( $pageactive < $countpage){?>
            <a href="?halaman=<?= $pageactive + 1 ?>">next</a>
            <?php }?>
        </div>
</section>
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