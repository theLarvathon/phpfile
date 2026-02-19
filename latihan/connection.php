
<?php 
//connection
$connect  = mysqli_connect("localhost","root","","phpdasar");
// ngambil data dari db
// ngambil subdata dari data (fetch)
// while ($test = mysqli_fetch_assoc($sql)){
//     var_dump($test);
// }
function QuerySelect($quer){
    global $connect;
    $res = mysqli_query($connect,$quer);
    $rows = [];
    while ($row = mysqli_fetch_assoc($res)){
        $rows[] = $row;
    };
    return $rows;
};
function QueryInsert($quer){
    global $connect;
    $res = mysqli_query($connect,$quer);
    return $res;


}
function QueryDelete($id){
    global $connect;
    mysqli_query($connect,"DELETE FROM onepiece WHERE id = $id");
    return mysqli_affected_rows($connect);
}
function search($data){
    $query = "SELECT * FROM onepiece WHERE namabl LIKE '%$data%' OR nama LIKE '%$data%'OR posisi LIKE '%$data%'";
    return QuerySelect($query);
}
function register($data){
    //inisialisasi
    global $connect;

    $username = strtolower($data['username']);

    $password = mysqli_real_escape_string($connect ,$data['password']);
    $confirmpassword = mysqli_real_escape_string($connect,$data['passwordconfirm']);
     // validasi password
     if($password !== $confirmpassword){
       echo "<p class='text-center text-red-600 italic font-semibold'>Password tidak sama!! Harap ubah</p>";
       return false;
     }
    // cek username
    $res = mysqli_query($connect, 'SELECT username FROM users WHERE username = "$username"');
    if($res === $username){
          echo "<p class='text-center text-red-600 italic font-semibold'>Nama sudah digunakan!! Harap ubah</p>";
          return false;
    }
    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);
    
    //insert to db
    mysqli_query($connect,"INSERT INTO users VALUES('','$username','$password')");

    return mysqli_affected_rows($connect);
}
?>