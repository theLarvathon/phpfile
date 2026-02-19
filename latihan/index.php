<?php 
$DataOp = [

    [
    "name"=> "strawhat",    
    "kapten" => "luffy",
    "kru"=>"nami,zoro,sanji",
    "lambang"=> "img/strawhat.png"
    ],

    [
    "name"=> "akagami",    
    "kapten" => "shanks",
    "kru"=>"ben beckman,yasop,lucky roux",
    "lambang"=> "img/shanks.jpg"
    ],
    [
    "name"=> "whitebeard",    
    "kapten" => "edward newgate",
    "kru"=>"marco,ace,jozu",
    "lambang"=> "img/shirohige.jpg"
    ],
    [
    "name"=> "Bigmom",    
    "kapten" => "charlote linlin",
    "kru"=>"katakuri,smoothie,cracker",
    "lambang"=> "img/bigmom.jpg"
    ],
    [
    "name"=> "heart",    
    "kapten" => "trafalgar law",
    "kru"=>"bepo,shaci,penguin",
    "lambang"=> "img/law.jpg"
    ],
    [
    "name"=> "roger",    
    "kapten" => "Gol D roger",
    "kru"=>"rayleigh,gaban,crocus",
    "lambang"=> "img/roger.jpg"
    ],
    [
    "name"=> "buggy",    
    "kapten" => "buggy",
    "kru"=>"alvida,mohji,cabaji",
    "lambang"=> "img/buggy.jpg"
    ],
];


if (isset($_POST['submit'])) {
    if ($_POST['nama'] == "admin" && $_POST['pw'] == "123"){
        header("Location: admin.php");
        exit ;
        }else{
        $err = true;
        };
   };


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>latihan</title>
    <!-- cdn -->
     <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body>
    <section class="ml-4">

        <h2 class="font-mono text-2xl font-bold text-teal-400">Daftar Bajak laut</h2>
        <?php foreach($DataOp as $Op) {?>
        <ul>
            
            <?php 
        ?>
        <img class="w-10 h-10" src="<?= $Op['lambang']?>">
        
        <li><?php echo $Op["name"]?></li>
        <li><?php echo $Op["kapten"]?></li>
        <li> <?php echo $Op['kru'] ?></li>
        
    </ul>
    <?php }?>
</section>
<section class="p-14">
    <form action="" method="post">

    <h2 class="font-bold text-center">login</h2>
    <?php if(isset($err)){?>
    <p>login gagal</p>
    <?php }?>
    <div>
        <label for="nama">username :</label>
        <input type="text" name="nama" id="nama">
    </div>
    <div>
        <label for="pw">password :</label>
        <input type="password" name="pw" id="pw">
    </div>
    <div>
        <button class="bg-teal-500 rounded-full p-2 ml-40" type="submit" name="submit">kirim</button>
    </div>
    </form>
</section>
</body>

</html>
</html>