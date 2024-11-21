// kredi limitinden fazla sipariş veren musterileri listeleme
SELECT m.musteri_adi, 
m.kredi_limiti,
 SUM(st.birim_fiyat * st.siparis_miktari) as Toplam_Siparis_Tutarı 
FROM musteriler m 
INNER JOIN siparisler s ON m.musteri_numarasi = s.musteri_numarasi 
INNER JOIN siparis_detayi st ON st.siparis_no = s.siparis_no 
GROUP BY m.musteri_adi, m.kredi_limiti HAVING SUM(st.birim_fiyat * st.siparis_miktari) > m.kredi_limiti;

// calışanların amirlerini bulma
SELECT c.ad,c.soyad ,ca.ad,ca.soyad FROM calisanlar c INNER JOIN calisanlar ca ON c.calisan_numarasi = ca.amir ;

//şehirlere göre sipariş adetini bulma
SELECT m.sehir,SUM(st.siparis_miktari) as toplamsiparis 
from musteriler m 
INNER JOIN siparisler s ON s.musteri_numarasi=m.musteri_numarasi
INNER JOIN siparis_detayi st on st.siparis_no=s.siparis_no 
GROUP by m.sehir;

// bir siparişte 1 fazla ürün veren müşterileri listeleme:
SELECT m.musteri_adi,COUNT(s.siparis_no) as adet
from musteriler m 
INNER JOIN siparisler s ON s.musteri_numarasi=m.musteri_numarasi
INNER JOIN siparis_detayi st on st.siparis_no=s.siparis_no 
GROUP by s.siparis_no
HAVING adet > 1;
// musterlerin ortalama siparis tutarı
SELECT m.musteri_adi, ROUND(AVG(st.siparis_miktari*st.birim_fiyat),2) as ortalama 
from musteriler m INNER JOIN siparisler s ON s.musteri_numarasi=m.musteri_numarasi 
INNER JOIN siparis_detayi st on st.siparis_no=s.siparis_no GROUP by m.musteri_adi;
