<?php
/*kisi hesabı oluştur.
 total hesap sayısı öğrenilecek
  hesap no, bakiyesi, hesap bilgisi istenecek ve total hesap sayısı alınacak
*/
class bank
{
  protected $ad;
  protected $soyad;
  protected $tutar;
  protected $toplamtutar=0;
  protected $hesap = [];
  protected $hesapno = 0;
  

  public function ekle($ad,$soyad,$tutar){
    $this->ad = $ad;
    $this->soyad = $soyad;
    $this->tutar = $tutar;
    $this->hesap[]=[
      "Hesapno" => $this->hesapno ,
      "ad" => $this->ad ,
      "soyad" => $this->soyad,
      "tutar" => $this->tutar,
    ];
    $this->toplamtutar+=$this->tutar;
    $this->hesapno++;
    
  }
  public function nolukisi($sayi){
   return $this->hesap[$sayi];
  }
  public function sira(){
    return $this->hesapno;
   }
   public function toplam(){
    return $this->toplamtutar;
   }
  public function yaz(){
    foreach ($this->hesap as $hesap) {
      foreach ($hesap as $key => $value) {
        echo $key . ": " . $value . "<br>";
      }
      echo "<hr>";
    }
    echo "kayıtlı kişi sayısı: ". $this->sira();
    echo "<br>bankadaki toplam tutar: ". $this->toplam();
  }

}
$kisi= new bank();
$kisi->ekle("murat","sçelebi",5030);
$kisi->ekle("mursdat","sçeselebi",5100);
$kisi->ekle("mursdat","sçeselebi",15100);
$kisi->yaz();

?>