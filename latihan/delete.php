<?php 
require 'connection.php';
$id = $_GET['id'];
if(QueryDelete($id) > 0){
    echo 'penghapusan berhasil';
}else{
    echo 'penghapusan gagal';
}

?>