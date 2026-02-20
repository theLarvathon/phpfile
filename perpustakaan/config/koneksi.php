<?php 
$connect = mysqli_connect('localhost','root','','perpus');
$query="SELECT * FROM books";

$db = mysqli_query($connect,$query);
$row = mysqli_fetch_assoc($db);




?>