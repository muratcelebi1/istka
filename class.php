<?php
/*
class Arabalar{
public $marka;
public $sinif;
public $renk;

private $yil;

// public function __construct($marka,$sinif,$renk,$yil){
//     $this-> marka = $marka;
//     $this-> sinif = $sinif;
//      $this-> renk = $renk;
//     $this-> yil = $yil;
// }

public function setMarka($marka){
    $this-> marka = $marka;
}
public function setyil($yil){
    $this-> yil = $yil;
}

public function getSinif(){
    return  $this-> sinif ;
}
public function getyil(){
    return  $this-> yil ;
}
}



//$araba = new Arabalar("mercedes","sedan","siyah",2012);
$araba = new Arabalar();

$araba -> setMarka("BeMeWe");

$araba -> setyil("2006");

var_dump($araba);


// echo $araba-> marka ."<br>";
// echo $araba-> getSinif() ."<br>";
// echo $araba-> getyil() ."<br>";




class dikdortgen{
public $kisakenar;
public $uzunkenar;

public function __construct($kisa,$uzun){
    $this-> kisakenar = $kisa;
    $this -> uzunkenar = $uzun;

    echo " construct metodunu caliştirdim <br>";
}
public function alanhesapla()  {
    return $this-> kisakenar *  $this-> uzunkenar ;
}

public function cevrehesapla()  {
    return ($this-> kisakenar  +  $this-> uzunkenar)*2 ;
}

public function __destruct(){
        echo " destruct metodunu caliştirdim <br>";

}

}


$dik =  new dikdortgen(5,15);

$alan = $dik ->alanhesapla();
$cevre = $dik ->cevrehesapla();

var_dump($dik);
echo "dikdorgen alan = ". $alan . "<br>";
echo "dikdorgen cevre= ". $cevre . "<br>" ;


class daire{
    public $yaricap;
    const PI =3.14;

    public function __construct($yaricap){
        $this->yaricap  =$yaricap;
    }

    public function alanhesapla(){
        return self::PI * ($this->yaricap * $this->yaricap) ;
    }

      public function cevrehesapla(){
        return self::PI * $this->yaricap*2 ;
    }
}

$dai = new daire(5);
var_dump($dai);
$alan = $dai ->alanhesapla();
$cevre = $dai ->cevrehesapla();

echo "dikdorgen alan = ". $alan . "<br>";
echo "dikdorgen cevre= ". $cevre . "<br>" ;
*/

class aut{
    public $kullaniciad;
    private $sifre;

public function __construct($kullaniciad,$sifre){
    $this-> kullaniciad = $kullaniciad;
    $this-> sifre = $sifre;

}

public function login(){
    if($this->kullaniciad=="admin" && $this->sifre =="123"){
    echo "giris başarılı" ;

    }else {
            echo "giris başarısız" ;
    }

}
public function logout(){
    echo "çıkışbaşarılı" ;
  }

}

$kontrol = new aut("admin","123");
echo $kontrol-> login(). "<br>";
echo $kontrol-> logout(). "<br>";




?>
