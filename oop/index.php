<?php 
//======================================================== oop ====================================================================
class handphone {
    public 
    $username,
    $merek,
    $harga,
    $jenis
    ;
    // ============ patokan ===========
    public function __construct($merek = "merek",$username = "username",$harga = 0)
    {
        $this->merek = $merek;
        $this->username = $username;
        $this->harga = $harga;
     
    }
    public function getinfo(){
        return $data = "{$this->username} <br> merek = {$this->merek} | harga = {$this->harga} ";
    }


}
class iphone extends handphone{
    public$msgiphone = "foto live";
    public function __construct($merek = "merek", $username = "username", $harga = 0)
    {
        return parent::__construct($merek, $username, $harga);
    }
    public function getinfo(){
        return $data = "<br>".parent::getinfo()."<br> {$this->msgiphone}";
    }
}
class android extends handphone{
    public $msgandroid = "Kamera zoom ";
    public function __construct($merek = "merek", $username = "username", $harga = 0)
    {
        return parent::__construct($merek, $username, $harga);
    }
    public function getinfo(){
        return $data = "<br>".parent::getinfo()."<br> {$this->msgandroid}";
    }
}
$user1 = new android('samsung','syafik',1.5);
$user2 = new iphone('ip12','jono',12.5);

echo $user1->getinfo();
echo $user2->getinfo();