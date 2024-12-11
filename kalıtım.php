<?php 
/* okulda öğrencini ad,soyad,yaş ,sınıf ve numara
öğretmende ad soyad yaş branş ve tecrübe,
öğrenci ile ortak olanları bir fonksiyonda çağırılsın
öğrenci sınıf ve numara , öğretmende de branş ve tecrübe

*/

// abstract  protected function getAd();
// abstract  protected function getSoyad();
// abstract  protected function getYas();

abstract class kisi{
    protected $ad;
    protected $soyad;
    protected $yas;
    protected function __construct($ad,$soyad,$yas) {
    $this->ad = $ad;
    $this->soyad = $soyad;
    $this->yas = $yas;
  }

 
}

class ogrenci extends kisi{
    public $numara;
    public $sinif;
    public  function __construct($ad,$soyad,$yas,$numara,$sinif) {
        parent::__construct($ad, $soyad, $yas); // Üst sınıfın constructor'ını çağır
        $this->numara = $numara;
        $this->sinif = $sinif;
      }
      public  function yaz() {
        echo "Ad: {$this->ad}   soyad:  {$this->soyad }  yas: {$this->yas}
         numara: {$this->numara } sınıf:  {$this->sinif}";
      }
}
class ogretmen extends kisi{
    public $brans;
    public $tecrube;
    public  function __construct($ad,$soyad,$yas,$brans,$tecrube) {
        parent::__construct($ad, $soyad, $yas); // Üst sınıfın constructor'ını çağır
        $this->tecrube = $tecrube;
        $this->brans = $brans;
      }
      public  function yaz() {
        echo "Ad: {$this->ad}   soyad:  {$this->soyad }  yas: {$this->yas}
        brans: {$this->brans } tecrube:  {$this->tecrube}";
      }
}

class okul  {
   private $ogrenciler = [];
    public function ogrenciekle(ogrenci $ogrenci)
    {
        $this->ogrenciler[]=$ogrenci;
    }
    public  function ogrenciyaz() {
        foreach ($this->ogrenciler as $ogrenci) {
            echo $ogrenci->yaz() . "<br>";
        }
      }
}


$okul = new okul();
$ogr1= new ogrenci("murat","çelebi",12,333,"A şubesi");
$ogr2= new ogrenci("murat","çelebi",12,333,"b şubesi");
$ogt= new ogretmen("murat2","çeleb3i ",12,"mat",44);

//$ogr->yaz();
$okul->ogrenciekle($ogr1);
$okul->ogrenciekle($ogr2);

$okul->ogrenciyaz();
echo"<br>";
$ogt->yaz();
?>