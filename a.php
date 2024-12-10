<?php
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
?>
