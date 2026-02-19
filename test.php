<?php
echo "hello world<br>";
var_dump(667);
echo "<br>lambo<br>";

$kelas= 11;

echo $kelas;
// loop
while ($kelas < 15){
 echo "world <br>";
$kelas++;
}
//function
$y =  date("Y");
echo $y;

$data = [1,44,3336,7,8,4,2,233,53];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .ganjil{
    
            margin: 10px;
            background-color: gray;
            width: 50px;
            height: 50px;
            text-align: center;
            float: left;
            line-height: 50px;
        }
    </style>
</head>
<body>
    
    <table border="1" cellpadding="10" cellspacing="0"  >
        <?php
        for ($i = 1; $i<=5;$i++){
            echo "<tr></tr>";
           for ($j=1; $j <= 5; $j++){
            echo "<td>$i.$j</td>";
           }

        }
        ?>
    </table>
    <?php for ($i=0;$i < count($data);$i++){ ?>
    <div class="ganjil"><?= $data[$i] ?></div>
    <?php }?>
</body>
</html>