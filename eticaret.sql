-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 01 Ara 2022, 18:59:01
-- Sunucu sürümü: 10.4.24-MariaDB
-- PHP Sürümü: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `eticaret`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `about_ayar`
--

CREATE TABLE `about_ayar` (
  `id` int(11) NOT NULL,
  `width` varchar(2) NOT NULL,
  `padding` varchar(22) NOT NULL,
  `font_weight` varchar(22) NOT NULL,
  `back_color` varchar(22) NOT NULL,
  `divider` varchar(222) NOT NULL,
  `baslik_color` varchar(22) NOT NULL,
  `meta_desc` text NOT NULL,
  `tags` text NOT NULL,
  `text_color` varchar(22) NOT NULL,
  `button_bg` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `about_ayar`
--

INSERT INTO `about_ayar` (`id`, `width`, `padding`, `font_weight`, `back_color`, `divider`, `baslik_color`, `meta_desc`, `tags`, `text_color`, `button_bg`) VALUES
(1, '1', '40', 'bold', 'F8F8F8', 'divider', '000000', '12', '2,22', '333333', 'danger');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `about_page`
--

CREATE TABLE `about_page` (
  `id` int(11) NOT NULL,
  `baslik` varchar(222) DEFAULT NULL,
  `spot` text DEFAULT NULL,
  `icerik` text DEFAULT NULL,
  `galeri_id` varchar(22) DEFAULT NULL,
  `dil` varchar(11) DEFAULT NULL,
  `counter` varchar(2) DEFAULT NULL,
  `beceri` varchar(2) DEFAULT NULL,
  `counter_bgcolor` varchar(22) DEFAULT NULL,
  `counter_textcolor` varchar(22) DEFAULT NULL,
  `seo_url` varchar(222) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `about_page`
--

INSERT INTO `about_page` (`id`, `baslik`, `spot`, `icerik`, `galeri_id`, `dil`, `counter`, `beceri`, `counter_bgcolor`, `counter_textcolor`, `seo_url`) VALUES
(1, 'Hakkımızda', 'Kadın ve Erkek Kol Saati Modelleri', '<p>Kadın ve Erkek Kol Saati Modelleri</p>', '', 'tr', '0', '0', 'EE293C', 'FFFFFF', 'hakkimizda');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ayarlar`
--

CREATE TABLE `ayarlar` (
  `id` int(12) NOT NULL,
  `site_url` varchar(222) NOT NULL,
  `site_baslik` varchar(222) NOT NULL,
  `site_slogan` varchar(222) NOT NULL,
  `site_desc` text NOT NULL,
  `site_tags` text NOT NULL,
  `site_tel` varchar(222) NOT NULL,
  `site_whatsapp` varchar(222) NOT NULL,
  `site_mail` varchar(222) NOT NULL,
  `smtp_durum` varchar(2) NOT NULL,
  `smtp_bildirim_mail` varchar(222) NOT NULL,
  `smtp_mail` varchar(222) NOT NULL,
  `smtp_host` varchar(222) NOT NULL,
  `smtp_port` varchar(11) NOT NULL,
  `smtp_pass` varchar(222) NOT NULL,
  `smtp_protokol` varchar(22) NOT NULL,
  `analytics_code` text NOT NULL,
  `yandex_code` text NOT NULL,
  `canli_destek_kodu` text NOT NULL,
  `site_logo` varchar(222) NOT NULL,
  `site_mobil_logo` text NOT NULL,
  `site_favicon` varchar(222) NOT NULL,
  `site_footer_logo` varchar(222) NOT NULL,
  `site_gsm` varchar(222) NOT NULL,
  `adres_bilgisi` text NOT NULL,
  `copyright_1` text NOT NULL,
  `copyright_2` text NOT NULL,
  `site_maps_kodu` text NOT NULL,
  `site_workhour` text NOT NULL,
  `site_bg_color` varchar(22) NOT NULL,
  `dots_color` varchar(22) NOT NULL,
  `ticaret_text_home` varchar(2) NOT NULL,
  `ticaret_text_urun` varchar(2) NOT NULL,
  `ticaret_text_sepet` varchar(2) NOT NULL,
  `ticaret_text_color` varchar(22) NOT NULL,
  `ticaret_text_icon` varchar(22) NOT NULL,
  `ticaret_text_border` varchar(22) NOT NULL,
  `ticaret_text_back` varchar(22) NOT NULL,
  `sosyal_icon_tip` varchar(2) NOT NULL,
  `site_captcha` varchar(1) NOT NULL,
  `site_loader` varchar(2) NOT NULL,
  `totop` varchar(2) NOT NULL,
  `totop_bg` varchar(22) NOT NULL,
  `totop_icon` varchar(22) NOT NULL,
  `totop_bottom` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `ayarlar`
--

INSERT INTO `ayarlar` (`id`, `site_url`, `site_baslik`, `site_slogan`, `site_desc`, `site_tags`, `site_tel`, `site_whatsapp`, `site_mail`, `smtp_durum`, `smtp_bildirim_mail`, `smtp_mail`, `smtp_host`, `smtp_port`, `smtp_pass`, `smtp_protokol`, `analytics_code`, `yandex_code`, `canli_destek_kodu`, `site_logo`, `site_mobil_logo`, `site_favicon`, `site_footer_logo`, `site_gsm`, `adres_bilgisi`, `copyright_1`, `copyright_2`, `site_maps_kodu`, `site_workhour`, `site_bg_color`, `dots_color`, `ticaret_text_home`, `ticaret_text_urun`, `ticaret_text_sepet`, `ticaret_text_color`, `ticaret_text_icon`, `ticaret_text_border`, `ticaret_text_back`, `sosyal_icon_tip`, `site_captcha`, `site_loader`, `totop`, `totop_bg`, `totop_icon`, `totop_bottom`) VALUES
(1, 'http://localhost/public_html/', 'Kol Saati', 'Saat Modelleri', 'Popüler saat modelleri ile sana uygun olan saati bul.', 'saat', '+90 553 200 02 28', '905532000228', 'yalperenyld@gmail.com', '0', '', '', '', '465', '', 'tls', '', '', '', '934065616503-315-Screenshot_18.png', '9995871948649-754-934065616503-315-Screenshot_18.png', 'favicon.ico', '2095172203021-865-934065616503-315-Screenshot_18.png', '+90 850 850 50 50', 'Pelitözü Mah. Fatih Sultan Mehmet Bulvarı No:27, 11230 Bilecik Merkez/Bilecik\r\n', '', '', '', '<u>______________________________</u><br>Pzt.- Cuma :<b> </b>09:00 - 18:00<br>Cmt. - Pazar: 10:00 - 15:00<br>', 'FFFFFF', '000000', '1', '1', '1', '000000', '000000', 'EBEBEB', 'FFFFFF', '0', '0', '0', '1', 'E9003F', 'FFFFFF', '30');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `banka`
--

CREATE TABLE `banka` (
  `id` int(11) NOT NULL,
  `gorsel` text DEFAULT NULL,
  `sira` int(2) DEFAULT NULL,
  `banka_adi` varchar(222) DEFAULT NULL,
  `hesap_sahibi` varchar(222) DEFAULT NULL,
  `sube` varchar(22) DEFAULT NULL,
  `hesap_no` varchar(222) DEFAULT NULL,
  `iban` varchar(222) DEFAULT NULL,
  `durum` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `baslik` varchar(222) DEFAULT NULL,
  `spot` text DEFAULT NULL,
  `gorsel` text DEFAULT NULL,
  `icerik` text DEFAULT NULL,
  `anasayfa` varchar(2) DEFAULT NULL,
  `tags` text DEFAULT NULL,
  `meta_desc` text DEFAULT NULL,
  `hit` int(11) DEFAULT 0,
  `tarih` datetime DEFAULT NULL,
  `dil` varchar(22) DEFAULT NULL,
  `durum` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `blog`
--

INSERT INTO `blog` (`id`, `baslik`, `spot`, `gorsel`, `icerik`, `anasayfa`, `tags`, `meta_desc`, `hit`, `tarih`, `dil`, `durum`) VALUES
(1, '2022\'de Erkekler için en iyi 5 Saat - Mükemmel Saati Bulma Rehberi', 'Erkekler için harika bir saat aksesuardan daha fazlasıdır.', '9923128326328-446-2022\'de Erkekler için en iyi 5 Saat.png', '<p>Erkekler i&ccedil;in harika bir saat aksesuardan daha fazlasıdır. Bu bir stil ifadesi, bir başarı sembol&uuml; ve zamanın ge&ccedil;tiğinin bir hatırlatıcısıdır. İster g&uuml;ndelik bir saat, ister gardırobunuzu giydirmek i&ccedil;in bir saat arıyorsanız, m&uuml;kemmel saat sadece birka&ccedil; tık uzaklıktadır. İşte 2022\'de erkekler i&ccedil;in en iyi beş saat rehberi. Klasik elbise saatlerinden modern spor saatlerine kadar bu yıl dikkat edilmesi gereken saatler bunlar. Zamansız tasarımlardan ileri teknolojiye kadar bu saatler, tarzınızın zirvesinde kalmanıza ve zamanınızı takip etmenize yardımcı olarak her iki d&uuml;nyanın da en iyisini sunar. İster kendiniz i&ccedil;in ister hayatınızdaki &ouml;zel adam i&ccedil;in alışveriş yapıyor olun, bunlar gelecek yıllar boyunca devam edecek saatler.</p>\r\n<h2><br />Bir Erkek Saatinde Nelere Dikkat Edilmeli</h2>\r\n<p><br />Yeni bir saat i&ccedil;in alışveriş yaparken akılda tutulması gereken birka&ccedil; temel &ouml;zellik vardır. İlk olarak, g&uuml;ndelik bir saat mi yoksa elbise saati mi aradığınıza karar verin. G&uuml;ndelik saatler g&uuml;nl&uuml;k kullanım i&ccedil;in harikadır ve daha dayanıklı ve suya dayanıklı olma eğilimindeyken, elbise saatleri daha zariftir ve &ouml;zel g&uuml;nlerde giyilmesi ama&ccedil;lanmıştır. Ardından, ne t&uuml;r bir grup istediğinize karar verin. Deri bantlar klasik ve dayanıklıdır, paslanmaz &ccedil;elik bantlar modern ve hafiftir ve metal bantlar klasik ve zamansızdır. Son olarak, ne t&uuml;r bir saat y&uuml;z&uuml;n&uuml; tercih ettiğinize karar verin. Bazı saat y&uuml;zleri analog, diğerleri dijitaldir. Analog saatler, tek bir d&ouml;nen tekerlek &uuml;zerinde hem saati hem de dakikayı g&ouml;sterirken, dijital saatler zamanın daha hassas bir şekilde okunmasını sağlar.</p>\r\n<h2>2022\'de Erkekler i&ccedil;in en iyi elbise Saatleri</h2>\r\n<p><br />Bir elbise saati ararken, zamanın testine dayanacak klasik bir tasarıma dikkat edin. Deri veya metal bantlı paslanmaz &ccedil;elik bir saat hafif ve &ccedil;ok y&ouml;nl&uuml;d&uuml;r, hemen hemen her durum i&ccedil;in m&uuml;kemmeldir. Biraz daha klasik bir şey arıyorsanız, siyah veya g&uuml;m&uuml;ş kadran hemen hemen her renge uyacak ve her kıyafetle harika g&ouml;r&uuml;necek. G&uuml;m&uuml;ş veya altın bir saat de resmi kıyafetlerle eşleşerek onu &ouml;zel g&uuml;nler i&ccedil;in m&uuml;kemmel hale getirecektir. Daha modern bir tasarımın peşindeyseniz, cesur bir tasarıma sahip siyah veya paslanmaz &ccedil;elik bir saat, her kıyafete şık bir dokunuş katacaktır. Ne ararsan ara, mutlaka sana uygun bir saat vardır.</p>\r\n<h2>2022\'de Erkekler i&ccedil;in en iyi spor saatleri</h2>\r\n<p><br />Sportif bir saat i&ccedil;in alışveriş yapıyorsanız, herhangi bir aktivite sırasında lastik veya plastik bir bant hafif ve rahattır. Lastik bant ayrıca suya dayanıklı ve dayanıklıdır, bu da onu g&uuml;nl&uuml;k kullanım i&ccedil;in harika kılar. Plastik bir bant da dayanıklıdır, ancak giyilmesi o kadar rahat olmayabilir. Bir spor saati i&ccedil;in alışveriş yaparken, t&uuml;m aydınlatma koşullarında okunması kolay bir ekran arayın. Su ge&ccedil;irmez bir saat arıyorsanız, 100 metre veya daha fazla derecelendirilmiş bir model arayın. Son olarak, şarj edilmesi kolay bir saat arayın. Dahili GPS ve / veya h&uuml;cresel &ouml;zelliklere sahip bir spor saati, ilerlemenizi izlemenize, kısa mesaj g&ouml;nderip almanıza ve hatta bileğinizden arama yapmanıza olanak tanır.</p>\r\n<h2>2022\'de Erkekler i&ccedil;in en iyi l&uuml;ks saatler</h2>\r\n<p><br />İşlevsel olduğu kadar g&uuml;zel olan l&uuml;ks bir saatin peşindeyseniz, deri bantlı paslanmaz &ccedil;elik veya altın bir saat her kıyafete şık bir dokunuş katacaktır. Altın bir saat hem şık hem de zariftir, bu da onu &ouml;zel g&uuml;nler i&ccedil;in veya &ouml;zel biri i&ccedil;in hediye olarak m&uuml;kemmel kılar. Deri bantlı paslanmaz &ccedil;elik saat şık ve moderndir, g&uuml;nl&uuml;k kullanım i&ccedil;in m&uuml;kemmeldir. Daha klasik bir tasarımın peşindeyseniz metal bantlı altın bir saat her kıyafete şıklık katacak. Hediye olarak l&uuml;ks bir saat satın alıyorsanız, metal bantlı paslanmaz &ccedil;elik veya altın saat hem klasik hem de moderndir ve her durum i&ccedil;in m&uuml;kemmeldir. Yatırım olarak bir saat satın alıyorsanız, altın saatler paslanmaz &ccedil;elik saatlerden daha y&uuml;ksek fiyatlara sahiptir; Ancak, altın fiyatları genellikle daha değişkendir ve sıklıkla dalgalanır.</p>\r\n<h2>2022\'de Erkekler i&ccedil;in en iyi akıllı saatler</h2>\r\n<p><br />Zamanı anlatmaktan fazlasını yapan bir saatin peşindeyseniz, hem şık hem de işlevsel bir model arayın. Yerleşik fitness izleme &ouml;zelliklerine sahip bir saat, sağlıklı kalmanıza ve daha aktif olmanıza yardımcı olarak formda kalmanıza yardımcı olur. Bileğinizden arama yapmak ve almakla ilgileniyorsanız, h&uuml;cresel &ouml;zelliklere sahip bir model arayın. Ayrıca akıllı telefonunuza dahili Wi-Fi ve Bluetooth ile bağlanarak bildirim almanıza ve ilerlemenizi izlemenize olanak tanır. Hareket halindeyken akıllı evinizi kontrol etmekle ilgileniyorsanız, Amazon Alexa veya Google Asistan uyumluluğu sunan bir model arayın. Okunması kolay ve dokunuşunuza hızlı yanıt veren geniş ekranlı bir saat se&ccedil;in.</p>\r\n<p>&nbsp;</p>', '1', 'saat', 'Erkekler için harika bir saat sadece bir aksesuardan daha fazlasıdır.', 7, '2022-12-01 11:17:02', 'tr', '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `blog_ayar`
--

CREATE TABLE `blog_ayar` (
  `id` int(11) NOT NULL,
  `back_color` varchar(22) NOT NULL,
  `width` varchar(2) NOT NULL,
  `padding` varchar(22) NOT NULL,
  `font_weight` varchar(22) NOT NULL,
  `baslik_color` varchar(222) NOT NULL,
  `spot_color` varchar(22) NOT NULL,
  `divider` varchar(22) NOT NULL,
  `box_bg_color` varchar(22) NOT NULL,
  `box_header_color` varchar(22) NOT NULL,
  `box_spot_color` varchar(22) NOT NULL,
  `box_more_color` varchar(22) NOT NULL,
  `blog_limit` varchar(22) NOT NULL,
  `border_radius` varchar(2) NOT NULL,
  `tags` text NOT NULL,
  `meta_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `blog_ayar`
--

INSERT INTO `blog_ayar` (`id`, `back_color`, `width`, `padding`, `font_weight`, `baslik_color`, `spot_color`, `divider`, `box_bg_color`, `box_header_color`, `box_spot_color`, `box_more_color`, `blog_limit`, `border_radius`, `tags`, `meta_desc`) VALUES
(1, 'F8F8F8', '0', '65', 'bold', 'E9003F', '666666', 'divider', 'F8F8F8', '000000', '666666', 'E9003F', '3', '5', '', '');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `cerez_ayar`
--

CREATE TABLE `cerez_ayar` (
  `id` int(11) NOT NULL,
  `durum` varchar(2) DEFAULT NULL,
  `dil` varchar(22) DEFAULT NULL,
  `spot` text DEFAULT NULL,
  `link` text DEFAULT NULL,
  `link_text` text DEFAULT NULL,
  `button_text` varchar(222) DEFAULT NULL,
  `button_bg` varchar(22) DEFAULT NULL,
  `button_text_color` varchar(22) DEFAULT NULL,
  `bg_color` varchar(22) DEFAULT NULL,
  `bg_text_color` varchar(22) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `cerez_ayar`
--

INSERT INTO `cerez_ayar` (`id`, `durum`, `dil`, `spot`, `link`, `link_text`, `button_text`, `button_bg`, `button_text_color`, `bg_color`, `bg_text_color`) VALUES
(2, '0', 'tr', 'Deneyimlerinizi daha iyi hale getirebilmek için çerezleri kullanıyoruz. Devam ederek çerez kullanımımızı kabul etmiş oluyorsunuz.', 'sayfa/gizlilik-sozlesmesi', 'Şartlar ve Koşullar', 'Anladım', '000000', 'FFFFFF', '2956F8', 'FFFFFF');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `dil`
--

CREATE TABLE `dil` (
  `id` int(11) NOT NULL,
  `baslik` varchar(22) DEFAULT NULL,
  `kisa_ad` varchar(3) DEFAULT NULL,
  `icerik` text DEFAULT NULL,
  `sira` int(11) DEFAULT NULL,
  `flag` varchar(222) DEFAULT NULL,
  `varsayilan` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `dil`
--

INSERT INTO `dil` (`id`, `baslik`, `kisa_ad`, `icerik`, `sira`, `flag`, `varsayilan`) VALUES
(53, 'Türkçe', 'tr', '<?php\n$diller[\'buradasiniz\'] = \"Buradasınız\";\n$diller[\'anasayfa\'] = \"Anasayfa\";\n$diller[\'arama-area\']   = \"Aramak istediğiniz ürünün bilgisini veya kodunu girin enter\'a basın\";\n$diller[\'arama-sonuclari\'] = \"Arama Sonuçları\";\n$diller[\'arama-sonuc-bulunamadi\'] = \"Aradığınız kelime veya cümleye ait ürün bulunamadı!\";\n$diller[\'mega-menu-baslik\'] = \"YENİ SEZON İNDİRİMLERİ\";\n$diller[\'mega-menu-icerik\'] = \"Bir Çok Üründe Geçerli Olmak Üzere İnanılmaz İndirim Sezonu Başladı.\";\n$diller[\'mega-menu-button\'] = \"ALIŞVERİŞE BAŞLA\";\n$diller[\'populer-urunler\'] = \"POPÜLER ÜRÜNLER\";\n$diller[\'kategoriler\'] = \"KATEGORİLER\";\n$diller[\'tum-kategoriler\'] = \"TÜM KATEGORİLER\";\n$diller[\'sepetiniz\'] = \"Sepetiniz\";\n$diller[\'teslimat-ve-odeme\'] = \"Teslimat ve Ödeme Yönteminiz\";\n$diller[\'odeme-bilgileri\'] = \"Ödeme Bilgileriniz\";\n$diller[\'sepete-git\'] = \"SEPETE GİT\";\n$diller[\'hizmetlerimiz\'] = \"Hizmetlerimiz\";\n$diller[\'hizmetlerimiz-aciklamasi\'] = \"Verdiğimiz hizmetlere aşağıdan ulaşabilirsiniz\";\n$diller[\'urunlerimiz\'] = \"ÜRÜNLERİMİZ\";\n$diller[\'urunlerimiz-aciklamasi\'] = \"Kredi kartına taksit imkanı ile ürünlerimizi satın alabilirsiniz\";\n$diller[\'incele\'] = \"İNCELE\";\n$diller[\'populer\'] = \"Popüler\";\n$diller[\'yeni\'] = \"Yeni\";\n$diller[\'urun-gruplari\'] =\"ÜRÜN GRUPLARI\";\n$diller[\'urunlere-git\'] =\"Ürünlere Git\";\n$diller[\'pricing-table\'] = \"Pricing Table\";\n$diller[\'pricing-aciklamasi\'] = \"Aşağıdaki tabloları inceleyerek kendinize en uygun paketi seçebilirsiniz\";\n$diller[\'pricing-button-yazisi\'] = \"SATIN AL\";\n$diller[\'pricing-tavsiye\'] =\"TAVSİYE EDİLEN\";\n$diller[\'blog\'] = \"BLOG\";\n$diller[\'blog-aciklamasi\'] = \"Bizden son haberlere ve duyurulara ulaşmak için aşağıdaki listelere gözatabilirsiniz\";\n$diller[\'blog-devamini-oku\'] = \"Devamını Oku\";\n$diller[\'blog-detay-populer\'] = \"Popüler Yazılar\";\n$diller[\'proje\'] = \"PROJELER\";\n$diller[\'proje-aciklamasi\'] = \"Bugüne kadar yaptığımız çalışmalara aşağıdan ulaşabilirsiniz\";\n$diller[\'proje-tumu\'] = \"TÜMÜ\";\n$diller[\'ekip\'] = \"PROFESYONEL EKİBİMİZ\";\n$diller[\'ekip-aciklamasi\'] = \"Yaptığımız güzel işleri kimler yapıyor merak ediyorsanız aşağıdan ulaşabilirsiniz\";\n$diller[\'ozellik\'] = \"Özellikler Neler?\";\n$diller[\'ozellik-aciklamasi\'] = \"Bu alanda satış yaptığınız ürününüze ait özellikleri sıralayabilirsiniz\";\n$diller[\'ozellik-tumu\'] = \"TÜM ÖZELLİKLER\";\n$diller[\'yorum\'] = \"Müşterilerimizin Yorumları\";\n$diller[\'yorum-aciklamasi\'] = \"Birlikte çalıştığımız müşterilerimiz hakkımızda neler söyledi?\";\n$diller[\'ebulten\'] = \"E-Bülten Aboneliği\";\n$diller[\'ebulten-aciklamasi\'] = \"Tüm gelişmelerden ve indirimlerden haberdar olmak istiyorsanız e-bülten aboneliğine kayıt olun.\";\n$diller[\'ebulten-placeholder\'] = \"Lütfen E-Posta Adresinizi Girin\";\n$diller[\'ebulten-submit\'] = \"ABONE OL\";\n$diller[\'marka\'] = \"MARKALAR\";\n$diller[\'marka-aciklamasi\'] = \"Partnerlerimiz ve referanslarımız\";\n$diller[\'footer-hakkimizda-devami\'] = \"Devamı\";\n$diller[\'calisma-saatleri\'] = \"ÇALIŞMA SAATLERİ\";\n$diller[\'kurumsal\'] = \"KURUMSAL\";\n$diller[\'baglantilar\'] = \"BAĞLANTILAR\";\n$diller[\'video\'] = \"VİDEOLAR\";\n$diller[\'video-aciklamasi\'] = \"Firmamıza ait yapılan çalışamalardan oluşan kolaj videolar\";\n$diller[\'videoyu-izle\'] = \"Videoyu İzle\";\n$diller[\'belge\'] = \"BELGELERİMİZ\";\n$diller[\'belge-aciklamasi\'] = \"Firmamıza ait tüm sertifika ve belgeler\";\n$diller[\'belge-incele\'] = \"İNCELE\";\n$diller[\'beceri\'] = \"UZMANLIKLARIMIZ\";\n$diller[\'beceri-aciklamasi\'] = \"Duis vel nibh at velit scelerisque suscipit. Nunc sed turpis. Fusce egestas elit eget lorem. Sed cursus turpis vitae tortor\";\n$diller[\'katalog\'] = \"E-Katalog\";\n$diller[\'katalog-aciklamasi\'] = \"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris scelerisque lacus quis nibh pulvinar dignissim. Duis sagittis nisi et sem aliquet, non ultrices risus egestas. Nam et varius libero\";\n$diller[\'banka-hesap\'] = \"Hesap Numaralarımız\";\n$diller[\'banka-hesap-aciklamasi\'] = \"EFT/Havale seçeneği ile satın alımı gerçekleştirdiyseniz lütfen aşağıdaki hesap bilgilerimizden birine gönderim yapınız\";\n$diller[\'banka-adi\'] = \"BANKA\";\n$diller[\'banka-hesap-sahibi\'] = \"HESAP SAHİBİ\";\n$diller[\'banka-sube\'] = \"ŞUBE KODU\";\n$diller[\'banka-hesap-no\'] = \"HESAP NUMARASI\";\n$diller[\'banka-iban\'] = \"IBAN\";\n$diller[\'foto-galeri\'] = \"Foto Galeri\";\n$diller[\'foto-galeri-aciklamasi\'] = \"Firmamıza ait fotoğraf albümlerine aşağıdan ulaşabilirsiniz\";\n$diller[\'insan-kaynaklari\'] = \"İnsan Kaynakları\";\n$diller[\'insan-kaynaklari-aciklamasi\'] = \"Firmamızdaki boş pozisyonlar için formu doldurarak iş başvurusunda bulunabilirsiniz\";\n$diller[\'isim-soyisim\'] = \"İsim Soyisim\";\n$diller[\'dogum-tarihi\'] = \"Doğum Tarihiniz\";\n$diller[\'dogum-tarihi-kisa\'] = \"gg/aa/yyyy\";\n$diller[\'cinsiyetiniz\'] = \"Cinsiyetiniz\";\n$diller[\'secim-yap\'] = \"Seçim Yapın\";\n$diller[\'erkek\'] = \"Erkek\";\n$diller[\'kadin\'] = \"Kadın\";\n$diller[\'medeni-haliniz\'] = \"Medeni Haliniz\";\n$diller[\'evli\'] = \"Evli\";\n$diller[\'bekar\'] = \"Bekar\";\n$diller[\'kan-grubu\'] = \"Kan Grubunuz\";\n$diller[\'telefon-numaraniz\'] = \"Telefon Numaranız\";\n$diller[\'email-adresiniz\'] = \"E-Mail Adresiniz\";\n$diller[\'il\'] = \"Şehir\";\n$diller[\'ilce\'] = \"İlçe\";\n$diller[\'askerlik\'] = \"Askerlik Durumu\";\n$diller[\'askerlik-aciklamasi\'] = \"Tecilli ise süresini belirtiniz\";\n$diller[\'ehliyet\'] = \"Ehliyetiniz var mı?\";\n$diller[\'ehliyet-aciklamasi\'] = \"Var ise hangisi olduğunu belirtiniz\";\n$diller[\'egitim-durumu\'] = \"Eğitim Durumunuz\";\n$diller[\'yabanci-dil-durumu\'] = \"Yabancı Dil Durumunuz\";\n$diller[\'calisma-tecrubeleri\'] = \"Önceki Çalışma Deneyimleriniz\";\n$diller[\'bilgi-referans\'] = \"Kısaca Hakkınızda ve Referanslarınız\";\n$diller[\'form-eksiksiz-doldur-alani\'] = \"Lütfen tüm alanları eksiksiz doldurunuz.\";\n$diller[\'diger-bilgileriniz\'] = \"Diğer Bilgileriniz\";\n$diller[\'guvenlik-kodu\'] = \"Güvenlik Kodu\";\n$diller[\'basvuruyu-gonder\'] = \"Başvuruyu Gönder\";\n$diller[\'button-tamam\'] = \"TAMAM\";\n$diller[\'post-basarili\'] = \"BAŞARILI!\";\n$diller[\'post-basvuru-basarili-aciklamasi\'] = \"Başvurunuz bize ulaşmıştır. En kısa sürede sizinle iletişime geçilecektir.\";\n$diller[\'post-iletisim-basarili-aciklamasi\'] = \"Mesajınız bize ulaşmıştır.\";\n$diller[\'post-hata\'] = \"HATA!\";\n$diller[\'post-guvenlik-kod-hata\'] = \"Güvenlik Kodunu Yanlış Girdiniz.\";\n$diller[\'paylas\'] = \"Paylaşın\";\n$diller[\'etiketler\'] = \"Etiketler\";\n$diller[\'iletisim-title\'] = \"İletişim\";\n$diller[\'iletisime-gec\'] = \"İletişime Geçin\";\n$diller[\'bize-yazin\'] = \"Bize Yazın\";\n$diller[\'iletisim-isim\'] = \"İsim\";\n$diller[\'iletisim-mail\'] = \"E-Posta\";\n$diller[\'iletisim-telno\'] = \"Telefon\";\n$diller[\'iletisim-mesaj\'] = \"Mesaj\";\n$diller[\'iletisim-button-gonder\'] = \"Mesajı Gönder\";\n$diller[\'proje-adi\'] = \"PROJE ADI\";\n$diller[\'proje-baslangic\'] = \"BAŞLAMA\";\n$diller[\'proje-bitis\'] = \"BİTİŞ\";\n$diller[\'proje-link\'] = \"Proje Web Sitesi\";\n$diller[\'proje-hakkinda\'] = \"PROJE HAKKINDA\";\n$diller[\'proje-ulasim\'] = \"ULAŞIM\";\n$diller[\'proje-galeri\'] = \"GALERİ\";\n$diller[\'proje-videosu\'] = \"PROJE VİDEOSU\";\n$diller[\'urun-toplam-sayi\'] = \"Toplam ürün sayısı\";\n$diller[\'urun-siralama-yeni\'] = \"En Yeni Ürünler\";\n$diller[\'urun-siralama-populer\'] = \"Popüler Ürünler\";\n$diller[\'urun-siralama-artan\'] = \"Fiyatı Artan\";\n$diller[\'urun-siralama-azalan\'] = \"Fiyatı Azalan\";\n$diller[\'urun-kategorileri\'] = \"ÜRÜN KATEGORİLERİ\";\n$diller[\'urun-sayi-yazisi\'] = \"Ürün\";\n$diller[\'urun-arayin\'] = \"ÜRÜN ARAYIN\";\n$diller[\'urun-ara-button-yazi\'] = \"ARA\";\n$diller[\'urun-ara-input-aciklama\'] = \"Kelime veya ürün kodu\";\n$diller[\'sayfalama-ilk\'] = \"İlk\";\n$diller[\'sayfalama-onceki\'] = \"Önceki\";\n$diller[\'sayfalama-sonraki\'] = \"Sonraki\";\n$diller[\'sayfalama-son\'] = \"Son\";\n$diller[\'urun-kodu\'] = \"Ürün Kodu\";\n$diller[\'kategori\'] = \"Kategori\";\n$diller[\'stok-durumu\'] = \"Stok Durumu\";\n$diller[\'stok-mevcut\'] = \"Mevcut\";\n$diller[\'stok-yok\'] = \"Stokta Yok\";\n$diller[\'stok-adet-yazisi\'] = \"Adet\";\n$diller[\'kargo-ucreti\'] = \"Kargo Ücreti\";\n$diller[\'kargo-ucretsiz\'] = \"Ücretsiz Kargo\";\n$diller[\'kargo-limit-aciklamasi\'] = \"ve Üzeri Alışverişlerinizde Kargo Bedava!\";\n$diller[\'sepete-ekle\'] = \"SEPETE EKLE\";\n$diller[\'whatsapp-siparis\'] = \"WHATSAPP\'TAN SİPARİŞ\";\n$diller[\'normal-siparis\'] = \"SİPARİŞ VER\";\n$diller[\'urun-detay-aciklama\'] = \"AÇIKLAMA\";\n$diller[\'urun-detay-ekbilgi\'] = \"EK BİLGİLER\";\n$diller[\'urun-detay-video\'] = \"ÜRÜN VİDEOSU\";\n$diller[\'benzer-urunler\'] = \"BENZER ÜRÜNLER\";\n$diller[\'normal-siparis-gonder\'] = \"Siparişi Gönder\";\n$diller[\'modal-kapat\'] = \"Kapat\";\n$diller[\'siparis-isim\'] = \"İsim Soyisim\";\n$diller[\'siparis-eposta\'] = \"E-Posta Adresiniz\";\n$diller[\'siparis-tel\'] = \"Telefon Numaranız\";\n$diller[\'siparis-urun\'] = \"Sipariş Edilen Ürün ve Ürün Kodu\";\n$diller[\'siparis-sehir\'] = \"İlçe / Şehir\";\n$diller[\'siparis-postakodu\'] = \"Posta Kodu\";\n$diller[\'siparis-adres\'] = \"Adresiniz\";\n$diller[\'siparis-not\'] = \"Sipariş İle İlgili Notunuz\";\n$diller[\'normal-siparis-basarili\'] = \"Siparişiniz Başarılı\";\n$diller[\'normal-siparis-basarili-aciklamasi\'] = \"Siparişiniz elimize ulaştı. En Kısa Sürede Sizinle İletişime Geçilecektir.\";\n$diller[\'kupon-kodu\'] = \"Kupon Kodu\";\n$diller[\'kupon-kodu-button\'] = \"GÜNCELLE\";\n$diller[\'sepet-urun\'] = \"ÜRÜN\";\n$diller[\'sepet-birim-fiyat\'] = \"BİRİM FİYATI\";\n$diller[\'sepet-adet\'] = \"ADET\";\n$diller[\'sepet-toplam-1\'] = \"TOPLAM\";\n$diller[\'sepet-toplam-2\'] = \"SEPET TOPLAMI\";\n$diller[\'siparis-detaylari\'] = \"SİPARİŞ DETAYLARI\";\n$diller[\'alisverise-devam\'] = \"ALIŞVERİŞE DEVAM ET\";\n$diller[\'ara-toplam\'] = \"Ara Toplam\";\n$diller[\'kdv\'] = \"KDV\";\n$diller[\'kargo-bedeli\'] = \"Kargo Bedeli\";\n$diller[\'sepet-ilerle-button\'] = \"ONAYLA VE İLERLE\";\n$diller[\'sepet-bos-aciklamasi\'] = \"Alışveriş sepetiniz boş!\";\n$diller[\'odeme-yontemi-secin\'] = \"ÖDEME YÖNTEMİ SEÇİN\";\n$diller[\'odeme-isim\'] = \"Adınız\";\n$diller[\'odeme-soyisim\'] = \"Soyadınız\";\n$diller[\'odeme-eposta\'] = \"E-Posta\";\n$diller[\'odeme-tel\'] = \"Telefon Numaranız\";\n$diller[\'odeme-sehir\'] = \"Şehir\";\n$diller[\'odeme-ilce\'] = \"İlçe\";\n$diller[\'odeme-postakodu\'] = \"Posta Kodu\";\n$diller[\'odeme-adres\'] = \"Sipariş Adresiniz\";\n$diller[\'odeme-not\'] = \"Sipariş İle İlgili Notunuz\";\n$diller[\'odeme-tur-kredi-karti\'] = \"Kredi Kartı / Banka Kartı\";\n$diller[\'odeme-tur-kredi-karti-aciklamasi\'] = \"Kredi kartınızın taksit avantajlarıyla satın alabilirsiniz\";\n$diller[\'odeme-tur-havale\'] = \"Havale / EFT\";\n$diller[\'odeme-tur-havale-aciklamasi\'] = \"Havale - Eft seçeneği ile satın almak için siparişinizin ardından banka hesap numaralarımızdan birisine ödemeniz gereken tutarı eksiksiz göndermeniz gerekmektedir\";\n$diller[\"mesafeli-satis-sozlesmesi\"] = \"Mesafeli Satış Sözleşmesi\";\n$diller[\"mesafeli-satis-sozlesmesi-onay\"] = \"Mesafeli Satış Sözleşmesini Onaylıyorum\";\n$diller[\'odemeye-gec\'] = \"ÖDEMEYE GEÇ\";\n$diller[\'siparis-sonucu\'] = \"Sipariş Sonucu\";\n$diller[\'siparis-basarili\'] = \"Siparişiniz başarıyla oluşturulmuştur.\";\n$diller[\'eft-havale-basarili-aciklamasi\'] = \"Siparişinizin tamamlanabilmesi için lütfen ödeyeceğiniz tutarı eksiksiz olarak hesap numaralarımızdan birisine gönderip bize bilgi veriniz\";\n$diller[\'siparis-numaraniz\'] = \"Sipariş Numaranız\";\n$diller[\'odenecek-tutar\'] = \"Ödenecek Tutar\";\n$diller[\'banka-hesap-numaralarimiz\'] = \"BANKA HESAP NUMARALARIMIZ\";\n$diller[\'sss\'] = \"Sık Sorulan Sorular\";\n$diller[\'sss-aciklamasi\'] = \"Firmamız hakkında tüm merak ettiklerinizi aşağıdaki sorular içinde bulabilirsiniz\";\n$diller[\'modul-hakkimizda-devami\'] = \"DEVAMI\";\n$diller[\'varyant-secin-yazisi\'] = \"Seçim Yapın\";\n$diller[\'404-aciklama\'] = \"Üzgünüz! Aradığınız sayfayı bulamadık. Tekrardan anasayfaya gidebilirsiniz\";\n$diller[\'form-eksik-alan\'] = \"Lütfen Tüm Alanları Eksiksiz Doldurunuz\";\n$diller[\'urunler-mobil-kategoriler-yazisi\'] = \"ÜRÜN KATEGORİLERİ\";\n$diller[\'uyelik-header\'] = \"Üyelik/Giriş\";\n$diller[\'uyelik-header-ok\'] = \"Hesabım\";\n$diller[\'uyelik-giris-yapilmamis\'] = \"Üye Girişi Yapılmamış!\";\n$diller[\'uyelik-kisa-aciklama\'] = \"Dev fırsatlardan veya kampanyalardan yararlanmak için hemen üye olun!\";\n$diller[\'uyelik-giris-button\'] = \"Üye Girişi\";\n$diller[\'uyelik-uye-ol-button\'] = \"Yeni Üyelik\";\n$diller[\'uyelik-giris-sayfa-baslik\'] = \"Üye Girişi Sayfası\";\n$diller[\'uyelik-giris-sayfa-uyelik-baslik\'] = \"Üye Değil misiniz?\";\n$diller[\'uyelik-giris-sayfa-uyelik-aciklama\'] = \"Ürünlerimizi satın alabilmek ve bir çok kampanya\'dan faydalanabilmek için üye olmanız gerekmektedir.\";\n$diller[\'hemen-uye-olun\'] = \"Hemen Üye Olun\";\n$diller[\'uye-girisi\'] = \"Üye Girişi\";\n$diller[\'uye-girisi-eposta\'] = \"E-Posta Adresiniz\";\n$diller[\'uye-girisi-sifre\'] = \"Şifreniz\";\n$diller[\'uye-girisi-hatirla\'] = \"Beni Hatırla\";\n$diller[\'uye-girisi-unuttum\'] = \"Şifremi Unuttum!\";\n$diller[\'uye-girisi-button\'] = \"GİRİŞ YAP\";\n$diller[\'uyepanel-hesap\'] = \"Hesap Bilgileriniz\";\n$diller[\'uyepanel-sifredegis\'] = \"Şifrenizi Değiştirin\";\n$diller[\'uyepanel-siparis\'] = \"Siparişleriniz\";\n$diller[\'uyepanel-adresler\'] = \"Kayıtlı Adresleriniz\";\n$diller[\'uyepanel-destek\'] = \"Destek Mesajları\";\n$diller[\'uyepanel-cikis\'] = \"Çıkış Yapın\";\n$diller[\'yeni-uyelik-sayfa-baslik\'] = \"Yeni Üyelik Formu\";\n$diller[\'yeni-uyelik-isim\'] = \"İsim\";\n$diller[\'yeni-uyelik-soyisim\'] = \"Soyisim\";\n$diller[\'yeni-uyelik-telefon\'] = \"Telefon Numaranız\";\n$diller[\'yeni-uyelik-eposta\'] = \"E-Posta Adresiniz\";\n$diller[\'yeni-uyelik-sifre\'] = \"Şifreniz\";\n$diller[\'yeni-uyelik-sifre-tekrar\'] = \"Şifreniz Tekrar\";\n$diller[\'yeni-uyelik-tc\'] = \"TC Kimlik Numaranız\";\n$diller[\'yeni-uyelik-cinsiyet\'] = \"Cinsiyetiniz\";\n$diller[\'yeni-uyelik-erkek\'] = \"Erkek\";\n$diller[\'yeni-uyelik-kadin\'] = \"Kadın\";\n$diller[\'yeni-uyelik-sozlesme\'] = \"Üyelik Sözleşmesini Onaylıyorum\";\n$diller[\'yeni-uyelik-button\'] = \"ÜYE OL\";\n$diller[\'uyelik-sozlesmesi\'] = \"Üyelik Sözleşmesi\";\n$diller[\'yeni-uyelik-basarili\'] = \"Üyeliğiniz Başarıyla Oluşturulmuştur\";\n$diller[\'yeni-uyelik-basarili-aciklama\'] = \"Yukarıdaki hesabım alanına tıklayarak hesabınızla ilgili herşeyi bulabilirsiniz\";\n$diller[\'uyelik-sifre-degistir\'] = \"Şifrenizi Değiştirmek İçin Tıklayın\";\n$diller[\'uyelik-sifre-aciklama\'] = \"Güvenliğiniz için tahmin edilemez bir şifre belirleyin\";\n$diller[\'uyelik-sifre-eski\'] = \"Mevcut Şifreniz\";\n$diller[\'uyelik-sifre-yeni\'] = \"Yeni Şifreniz\";\n$diller[\'uyelik-sifre-yeni-tekrar\'] = \"Yeni Şifreniz Tekrar\";\n$diller[\'uyelik-guncelle-button\'] = \"Güncelle\";\n$diller[\'uyelik-guncellendi-yazisi\'] = \"Bilgileriniz Güncellenmiştir\";\n$diller[\'uyelik-bos-alan\'] = \"Boş Alan Bırakılamaz!\";\n$diller[\'uyelik-yanlis-bilgiler\'] = \"Bilgileriniz Yanlış!\";\n$diller[\'uyelik-gecersiz-eposta\'] = \"Geçerli Bir E-Posta Adresi Girin!\";\n$diller[\'uyelik-eposta-mevcut\'] = \"Bu E-Posta Adresini Kullanamazsınız!\";\n$diller[\'uyelik-sifre-hata\'] = \"Mevcut şifrenizi yanlış girdiniz\";\n$diller[\'uyelik-sifre-hata-2\'] = \"Yeni şifreniz ile tekrarı aynı değil\";\n$diller[\'uyelik-sifre-hata-3\'] = \"Mevcut şifreniz yenisi ile aynı olamaz!\";\n$diller[\'uyelik-bilgi-destek\'] = \"Siparişleriniz ile ilgili soru veya problemleriniz için <strong>destek mesajları</strong> alanından bize mesaj gönderebilirsiniz\";\n$diller[\'uyelik-siparis-siralama-bilgi\'] = \"En son verilen siparişlerden ilk verilenlere doğru sıralanır\";\n$diller[\'uyelik-siparis-no\'] = \"Sipariş Numarası\";\n$diller[\'uyelik-siparis-sahibi\'] = \"Sipariş Sahibi\";\n$diller[\'uyelik-siparis-tur\'] = \"Ödeme Yöntemi\";\n$diller[\'uyelik-siparis-durum\'] = \"Sipariş Durumu\";\n$diller[\'uyelik-siparis-eposta\'] = \"Alıcı E-Posta Adresi\";\n$diller[\'uyelik-siparis-telefon\'] = \"Alıcı Telefon Numarası\";\n$diller[\'uyelik-siparis-adres\'] = \"Sipariş Adresi\";\n$diller[\'uyelik-siparis-fatura-adres\'] = \"Fatura Adresi\";\n$diller[\'uyelik-siparis-adet-yazisi\'] = \"Adet Ürün\";\n$diller[\'uyelik-siparis-tarih\'] = \"Sipariş Tarihi\";\n$diller[\'uyelik-siparis-toplam\'] = \"Toplam\";\n$diller[\'uyelik-siparis-button\'] = \"SİPARİŞ DETAYI\";\n$diller[\'uyelik-siparis-durum-yeni\'] = \"Yeni Sipariş\";\n$diller[\'uyelik-siparis-durum-odeme\'] = \"Ödeme Bekleniyor\";\n$diller[\'uyelik-siparis-durum-hazirlanma\'] = \"Hazırlanıyor\";\n$diller[\'uyelik-siparis-durum-tedarik\'] = \"Tedarik Ediliyor\";\n$diller[\'uyelik-siparis-durum-kargolandi\'] = \"Kargoya Verildi\";\n$diller[\'uyelik-siparis-durum-tamamlandi\'] = \"Tamamlandı\";\n$diller[\'uyelik-siparis-durum-iptal\'] = \"İptal Edildi\";\n$diller[\'uyelik-siparis-bulunamadi\'] = \"Henüz siparişiniz bulunmamaktadır. Hemen alışveriş yaparak fırsatlardan faydalanabilirsiniz\";\n$diller[\'uyelik-siparis-detay-baslik\'] = \"Numaralı Siparişinizin Detayları\";\n$diller[\'uyelik-siparis-detay-urunler\'] = \"Sipariş Edilen Ürün veya Ürünler\";\n$diller[\'uyelik-geridon-button-yazisi\'] = \"Geri Dön\";\n$diller[\'uyelik-siparis-urun-birim\'] = \"BİRİM FİYAT\";\n$diller[\'uyelik-siparis-urun-adet\'] = \"ADET\";\n$diller[\'uyelik-siparis-urun-kdv\'] = \"TOPLAM KDV\";\n$diller[\'uyelik-siparis-urun-kargo\'] = \"KARGO ÜCRETİ\";\n$diller[\'uyelik-siparis-urun-toplam\'] = \"TOPLAM\";\n$diller[\'uyelik-siparis-urun-kargofirma\'] = \"KARGO FİRMASI\";\n$diller[\'uyelik-siparis-urun-takipno\'] = \"TAKİP NUMARASI\";\n$diller[\'uyelik-adres-yok\'] = \"Henüz adres eklenmemiş. Sipariş verebilmek için adres tanımlaması yapmanız gerekmektedir.\";\n$diller[\'uyelik-adres-ekle\'] = \"YENİ ADRES EKLE\";\n$diller[\'uyelik-adres-duzenle\'] = \"ADRESİ DÜZENLE\";\n$diller[\'uyelik-adres-basligi\'] = \"Adres Başlığı\";\n$diller[\'uyelik-adres-sehir\'] = \"Şehir\";\n$diller[\'uyelik-adres-ilce\'] = \"İlçe\";\n$diller[\'uyelik-adres-postakodu\'] = \"Posta Kodu\";\n$diller[\'uyelik-adres-adres\'] = \"Sipariş Adresiniz\";\n$diller[\'uyelik-adres-adres-fatura\'] = \"Fatura Adresiniz\";\n$diller[\'uyelik-adres-ekle-button\'] = \"Adresi Ekle\";\n$diller[\'uyelik-adres-duzenle-button\'] = \"Adresi Düzenle\";\n$diller[\'uyelik-adres-ekle-basarili\'] = \"Adres Bilgileriniz Eklenmiştir\";\n$diller[\'uyelik-adres-guncelle-basarili\'] = \"Adres Bilgileriniz Güncellenmiştir\";\n$diller[\'uyelik-adres-button-duzenle\'] = \"Düzenle\";\n$diller[\'uyelik-adres-button-sil\'] = \"Adresi Sil\";\n$diller[\'uyelik-adres-sil-uyari\'] = \"Seçtiğiniz adresin silinmesini istiyor musunuz?\";\n$diller[\'uyelik-adres-sil-iptal\'] = \"İptal\";\n$diller[\'uyelik-adres-sil\'] = \"Evet Sil\";\n$diller[\'uyelik-adres-sil-basarili\'] = \"Seçtiğiniz Adres Silinmiştir\";\n$diller[\'uyelik-destek-mesaj-yok\'] = \" Sipariş veya diğer konularda herhangi bir destek hizmeti almak için lütfen bize mesaj gönderin\";\n$diller[\'uyelik-destek-yeni\'] = \"YENİ DESTEK TALEBİ\";\n$diller[\'uyelik-destek-olusturulma-tarih\'] = \"Oluşturulma Tarihi\";\n$diller[\'uyelik-destek-son-tarih\'] = \"Son İşlem Tarihi\";\n$diller[\'uyelik-destek-no\'] = \"Destek No\";\n$diller[\'uyelik-destek-mesajiniz\'] = \"Mesajınız\";\n$diller[\'uyelik-destek-siparisno-uyari\'] = \"Sipariş ile ilgili destek talepleriniz için sipariş numaranızı eklemeyi unutmayınız\";\n$diller[\'uyelik-destek-konu\'] = \"Konu\";\n$diller[\'uyelik-destek-durum\'] = \"Durumu\";\n$diller[\'uyelik-destek-acik\'] = \"Açık\";\n$diller[\'uyelik-destek-cevaplandi\'] = \"Cevaplandı\";\n$diller[\'uyelik-destek-incele\'] = \"TALEBİ İNCELE\";\n$diller[\'uyelik-destek-detay-baslik\'] = \"Numaralı Destek Talebiniz\";\n$diller[\'uyelik-destek-mesajlar\'] = \"Mesajlar\";\n$diller[\'uyelik-destek-yeni-mesaj-gonder\'] = \"YENİ MESAJ GÖNDER\";\n$diller[\'uyelik-destek-mesaj-destek-birimi\'] = \"DESTEK BİRİMİ\";\n$diller[\'uyelik-destek-mesaj-gonder\'] = \"GÖNDER\";\n$diller[\'uyelik-destek-mesaj-basarili-yazisi\'] = \"Mesajınız Başarıyla Gönderilmiştir\";\n$diller[\'uyelik-destek-mesaj-hat-yazisi\'] = \"Boş Alan Bırakılamaz!\";\n$diller[\'uyepanel-kullanici-menusu\'] = \"KULLANICI MENÜSÜ\";\n$diller[\'uyegiris-modal-baslik\'] = \"İlerleyebilmek İçin Giriş Yapmalısınız\";\n$diller[\'uyegiris-modal-aciklama\'] = \"En uygun fiyat ve hızlı alışveriş garantisi\";\n$diller[\'uyegiris-modal-uyelik-yok\'] = \"ÜYELİĞİNİZ YOK MU?\";\n$diller[\'uyelik-siparis-uyari-yazisi\'] = \"UYARI!\";\n$diller[\'uyelik-sifemi-unuttum-bilgi\'] = \"BİLGİLENDİRME\";\n$diller[\'reset-my-password\'] = \"ŞİFREMİ SIFIRLA\";\n$diller[\'uyelik-sifemi-unuttum-bilgi-aciklama\'] = \"Girdiğiniz e-posta adresi eğer geçerli ise size bir e-posta gönderilecektir. Gönderilen mesaj içerisindeki adrese tıklayarak yeni şifrenizi oluşturabilirsiniz\";\n$diller[\'uyelik-sifre-sifirla-title\'] = \"Şifrenizi Sıfırlayın\";\n$diller[\'uyelik-sifemi-unuttum-basarili-baslik\'] = \"BAŞARILI\";\n$diller[\'uyelik-sifemi-unuttum-basarili-aciklama\'] = \"Şifrenizi sıfırlayabileceğiniz link e-posta adresinize gönderilmiştir\";\n$diller[\'urun-detay-yorum-baslik\'] = \"ÜRÜN YORUMLARI\";\n$diller[\'urun-detay-yorum-degerlendirme\'] = \"Değerlendirme\";\n$diller[\'urun-detay-toplam-yorum-degerlendirme-yazisi\'] = \"değerlendirme ve yorum\";\n$diller[\'urun-detay-yorum-yapin-yazisi\'] = \"Yorum Yapın\";\n$diller[\'urun-detay-yorum-uyelik-uyarisi\'] = \"Yorum yapabilmek için giriş yapmanız gerekmektedir.\";\n$diller[\'urun-detay-yorum-uyelik-button-yazisi\'] = \"ÜYE GİRİŞİ / YENİ ÜYELİK\";\n$diller[\'urun-detay-yorum-bilgi-yazisi\'] = \"Bu ürüne yorum yazmak için aşağıdaki butonu kullanabilirsiniz.\";\n$diller[\'urun-detay-yorum-yap-button-yazisi\'] = \"YORUM YAPMAK İÇİN TIKLAYIN\";\n$diller[\'urun-detay-yorum-ortalama-yazisi\'] = \"Bu ürünün toplam değerlendirme ortalaması\";\n$diller[\'urun-detay-modal-urunu-degerlendirin\'] = \"Bu Ürünü Değerlendirin\";\n$diller[\'urun-detay-modal-puaniniz\'] = \"Puanınızı Seçin\";\n$diller[\'urun-detay-modal-yorum-basliginiz\'] = \"Yorum Başlığınız\";\n$diller[\'urun-detay-modal-yorumunuz\'] = \"Yorumunuz\";\n$diller[\'urun-detay-modal-gizlilik\'] = \"İsmim ve Soyismim Gizlensin\";\n$diller[\'urun-detay-modal-yorumu-gonder-button-yazisi\'] = \"Yorumu Gönder\";\n$diller[\'urun-detay-yorum-basarili-baslik\'] = \"Yorumunuz Gönderilmiştir\";\n$diller[\'urun-detay-yorum-basarili-aciklama\'] = \"Yorumunuz onaylandıktan sonra yayınlanacaktır. Değerlendirmeniz için teşekkür ederiz\";\n$diller[\'urun-detay-yorum-uye-girisi-basarili\'] = \"Giriş Başarılı\";\n$diller[\'urun-detay-yorum-uye-girisi-basarili-aciklamasi\'] = \"Şimdi yorumunuzu yazabilirsiniz\";\n$diller[\'urun-detay-daha-fazla-yorum-goster\'] = \"Daha Fazla Yorum Göster\";\n$diller[\'urun-detay-daha-fazla-yorum-bitis\'] = \"Başka Yorum Bulunamadı\";\n$diller[\'urun-detay-yorum-yok\'] = \"Henüz Yorum Eklenmemiş!\";\n$diller[\'urun-detay-degerlendirme-yok\'] = \"Bu ürün için değerlendirme yapılmamış!\";\n$diller[\'urun-detay-yorum-bos-alan-baslik\'] = \"Hata Oluştu\";\n$diller[\'urun-detay-yorum-bos-alan-aciklama\'] = \"Boş alan bırakamazsınız\";\n$diller[\'uyelik-uye-yorumlari\'] = \"Ürün Yorumlarınız\";\n$diller[\'uyelik-uye-yorumlar-sayisi-yazisi\'] = \"Toplam yorum ve değerlendirme sayınız\";\n$diller[\'uyelik-uye-yorum-bulunamadi-yazisi\'] = \"Henüz hiç bir ürüne yorum ve değerlendirme yapılmamış.\";\n$diller[\'uyelik-uye-onay-bekleyen-yazisi\'] = \"ONAY BEKLEYEN\";\n$diller[\'uyelik-uye-onaylanan-yazisi\'] = \"ONAYLANAN\";\n$diller[\'uyelik-uye-urun-oyunuz\'] = \"Bu ürün için verdiğiniz oy\";\n$diller[\'topheader-teklif-button-yazisi\'] = \"TEKLİF AL\";\n$diller[\'topheader-siparis-takip-button-yazisi\'] = \"SİPARİŞ TAKİP\";\n$diller[\'teklif-form-baslik\'] = \"Bizden Teklif Alın\";\n$diller[\'teklif-form-aciklama\'] = \"Projeleriniz için bize detaylı bilgi verip fiyat teklifi alabilirsiniz. Lütfen tüm alanları doldurup aklınızdaki projeyi detaylarıyla yazınız\";\n$diller[\'teklif-form-isim\'] = \"Adınız Soyadınız\";\n$diller[\'teklif-form-eposta\'] = \"E-Posta Adresiniz\";\n$diller[\'teklif-form-tel\'] = \"Telefon Numaranız\";\n$diller[\'teklif-form-firma-bilgi\'] = \"Firmanız Hakkında Kısa Bilgi\";\n$diller[\'teklif-form-konu\'] = \"Proje Konusu\";\n$diller[\'teklif-form-icerik\'] = \"Projeniz Hakkında Detaylar\";\n$diller[\'teklif-form-dosya\'] = \"Ek Dosya\";\n$diller[\'teklif-form-gonder-button\'] = \"Teklif Talebinde Bulun\";\n$diller[\'teklif-form-hatali-eposta-uyari\'] = \"Lütfen Geçerli Bir E-Posta Adresi Giriniz\";\n$diller[\'teklif-form-hatali-dosya-tipi\'] = \"Belirtilen dosya tipleri harici uzantı kullanılamaz\";\n$diller[\'teklif-form-basarili-yazisi\'] = \"Projeniz incelenip en kısa sürede tarafınıza teklif yapılacaktır\";\n$diller[\'siparis-takip-baslik\'] = \"Sipariş Takip\";\n$diller[\'siparis-takip-aciklama\'] = \"Siparişinizin son durumunu öğrenmek için lütfen sipariş numaranızı giriniz\";\n$diller[\'siparis-takip-button\'] = \"Siparişi Sorgula\";\n$diller[\'siparis-takip-tekrar-sorgula-button\'] = \"Yeni Bir Sipariş Sorgulayın\";\n$diller[\'siparis-takip-bulunamadi\'] = \"Herhangi bir sipariş bulunamadı!\";\n$diller[\'siparis-takip-no\'] = \"Sipariş Numarası\";\n$diller[\'siparis-takip-order-sahibi\'] = \"Sipariş Sahibi\";\n$diller[\'siparis-takip-order-tur\'] = \"Ödeme Yöntemi\";\n$diller[\'siparis-takip-order-durum\'] = \"Sipariş Durumu\";\n$diller[\'siparis-takip-order-eposta\'] = \"Alıcı E-Posta Adresi\";\n$diller[\'siparis-takip-order-telefon\'] = \"Alıcı Telefon Numarası\";\n$diller[\'siparis-takip-order-adres\'] = \"Sipariş Adresi\";\n$diller[\'siparis-takip-order-fatura-adres\'] = \"Fatura Adresi\";\n$diller[\'siparis-takip-order-adet-yazisi\'] = \"Adet Ürün\";\n$diller[\'siparis-takip-order-tarih\'] = \"Sipariş Tarihi\";\n$diller[\'siparis-takip-order-toplam\'] = \"Toplam\";\n$diller[\'siparis-takip-order-button\'] = \"SİPARİŞ DETAYI\";\n$diller[\'siparis-takip-order-durum-yeni\'] = \"Yeni Sipariş\";\n$diller[\'siparis-takip-order-durum-odeme\'] = \"Ödeme Bekleniyor\";\n$diller[\'siparis-takip-order-durum-hazirlanma\'] = \"Hazırlanıyor\";\n$diller[\'siparis-takip-order-durum-tedarik\'] = \"Tedarik Ediliyor\";\n$diller[\'siparis-takip-order-durum-kargolandi\'] = \"Kargoya Verildi\";\n$diller[\'siparis-takip-order-durum-tamamlandi\'] = \"Tamamlandı\";\n$diller[\'siparis-takip-order-durum-iptal\'] = \"İptal Edildi\";\n$diller[\'siparis-takip-order-detay-baslik\'] = \"Numaralı Siparişinizin Detayları\";\n$diller[\'siparis-takip-order-detay-urunler\'] = \"Sipariş Edilen Ürün veya Ürünler\";\n$diller[\'siparis-takip-order-urun-birim\'] = \"BİRİM FİYAT\";\n$diller[\'siparis-takip-order-urun-adet\'] = \"ADET\";\n$diller[\'siparis-takip-order-urun-kdv\'] = \"TOPLAM KDV\";\n$diller[\'siparis-takip-order-urun-kargo\'] = \"KARGO ÜCRETİ\";\n$diller[\'siparis-takip-order-urun-toplam\'] = \"TOPLAM\";\n$diller[\'siparis-takip-order-urun-kargofirma\'] = \"KARGO FİRMASI\";\n$diller[\'siparis-takip-order-urun-takipno\'] = \"TAKİP NUMARASI\";\n$diller[\'marka-text-1\'] = \"Markaya Git\";\n$diller[\'marka-text-2\'] = \"Markası\";\n$diller[\'marka-text-3\'] = \"Markasına Ait Ürünler\";?>', 1, 'tr', '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `footer_ayar`
--

CREATE TABLE `footer_ayar` (
  `id` int(11) NOT NULL,
  `tip` varchar(2) DEFAULT NULL,
  `width` varchar(2) DEFAULT NULL,
  `gorsel_onay` varchar(2) NOT NULL,
  `gorsel` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `footer_ayar`
--

INSERT INTO `footer_ayar` (`id`, `tip`, `width`, `gorsel_onay`, `gorsel`) VALUES
(1, '1', '0', '0', '4485158464299-546-odemebanner.png');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `footer_menu`
--

CREATE TABLE `footer_menu` (
  `id` int(11) NOT NULL,
  `baslik` varchar(222) DEFAULT NULL,
  `url` text DEFAULT NULL,
  `durum` varchar(2) DEFAULT NULL,
  `dil` varchar(22) DEFAULT NULL,
  `yer` varchar(2) DEFAULT NULL,
  `sira` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `footer_menu`
--

INSERT INTO `footer_menu` (`id`, `baslik`, `url`, `durum`, `dil`, `yer`, `sira`) VALUES
(7, 'Hakkımızda', 'kurumsal/hakkimizda', '1', 'tr', '0', 1),
(8, 'Gizlilik Sözleşmesi', 'sayfa/gizlilik-sozlesmesi', '1', 'tr', '0', 2),
(11, 'İnsan Kaynakları', 'insan-kaynaklari', '1', 'tr', '0', 5),
(12, 'Hesap Numaralarımız', 'hesap-numaralarimiz', '1', 'tr', '0', 6),
(13, 'Ürünlerimiz', 'urunler', '1', 'tr', '1', 1),
(15, 'Markalarımız', '#', '1', 'tr', '1', 3),
(16, 'Blog ve Haberler', 'bloglar', '1', 'tr', '1', 4),
(20, 'Bize Ulaşın', 'iletisim', '1', 'tr', '0', 8);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `header_ayar`
--

CREATE TABLE `header_ayar` (
  `id` int(11) NOT NULL,
  `durum` varchar(1) NOT NULL DEFAULT '1',
  `padding` varchar(11) NOT NULL,
  `back_color` varchar(11) NOT NULL,
  `text_color` varchar(11) NOT NULL,
  `font` varchar(222) NOT NULL,
  `header_width` varchar(22) NOT NULL,
  `header_limit` varchar(2) NOT NULL,
  `topheader_width` varchar(2) NOT NULL,
  `sosyal` varchar(2) NOT NULL DEFAULT '1',
  `tel` varchar(2) NOT NULL DEFAULT '1',
  `tel_2` varchar(2) NOT NULL,
  `whatsapp` varchar(2) NOT NULL DEFAULT '1',
  `mail` varchar(2) NOT NULL DEFAULT '1',
  `border_color` varchar(11) NOT NULL,
  `icon_color` varchar(22) NOT NULL,
  `arama_button` varchar(2) NOT NULL,
  `dil_secim` varchar(2) NOT NULL,
  `mega_gorsel` varchar(222) NOT NULL,
  `font_weight` varchar(22) NOT NULL,
  `font_size` varchar(22) NOT NULL,
  `menu_hover_color` varchar(22) NOT NULL,
  `menu_text_color` varchar(22) NOT NULL,
  `menu_text_hover_color` varchar(22) NOT NULL,
  `mobil_bg` text NOT NULL,
  `mobil_bar_color` varchar(22) NOT NULL,
  `header_menu_bg` varchar(22) DEFAULT NULL,
  `arama_button_bg` varchar(22) DEFAULT NULL,
  `dil_border` varchar(22) DEFAULT NULL,
  `menu_bg` varchar(11) NOT NULL,
  `header_tip` varchar(2) NOT NULL,
  `menu_align` varchar(2) NOT NULL,
  `arama_button_color` varchar(11) NOT NULL,
  `header2_cart_bg` varchar(11) NOT NULL,
  `header2_menu_border` varchar(11) NOT NULL,
  `header2_menu_height` varchar(11) NOT NULL,
  `header2_bottom_margin` varchar(11) NOT NULL,
  `uyelik_icon` varchar(255) NOT NULL,
  `uyelik_icon_color` varchar(255) NOT NULL,
  `header2_uyelik_bg` varchar(255) NOT NULL,
  `teklif_button` varchar(22) NOT NULL,
  `siparis_takip_button` varchar(22) NOT NULL,
  `teklif_button_bg` varchar(22) NOT NULL,
  `siparis_takip_button_bg` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `header_ayar`
--

INSERT INTO `header_ayar` (`id`, `durum`, `padding`, `back_color`, `text_color`, `font`, `header_width`, `header_limit`, `topheader_width`, `sosyal`, `tel`, `tel_2`, `whatsapp`, `mail`, `border_color`, `icon_color`, `arama_button`, `dil_secim`, `mega_gorsel`, `font_weight`, `font_size`, `menu_hover_color`, `menu_text_color`, `menu_text_hover_color`, `mobil_bg`, `mobil_bar_color`, `header_menu_bg`, `arama_button_bg`, `dil_border`, `menu_bg`, `header_tip`, `menu_align`, `arama_button_color`, `header2_cart_bg`, `header2_menu_border`, `header2_menu_height`, `header2_bottom_margin`, `uyelik_icon`, `uyelik_icon_color`, `header2_uyelik_bg`, `teklif_button`, `siparis_takip_button`, `teklif_button_bg`, `siparis_takip_button_bg`) VALUES
(1, '0', '2', 'FFFFFF', 'A7A7A7', 'raleway', '0', '9', '0', '1', '1', '1', '1', '1', 'E9003F', 'A7A7A7', '1', '0', '', 'normal', '13px', '14BCA4', 'FFFFFF', 'FFFFFF', 'FFFFFF', '000000', 'FFFFFF', '292929', 'EBEBEB', '3E7DE9', '2', '0', '2B2B2B', 'danger', 'FFFFFF', '75px', '', 'fa fa-user-o', '292929', 'secondary', '0', '0', 'danger', 'success');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `header_menu`
--

CREATE TABLE `header_menu` (
  `id` int(11) NOT NULL,
  `baslik` varchar(222) DEFAULT NULL,
  `url` text DEFAULT NULL,
  `ust_id` int(22) DEFAULT NULL,
  `sira` int(11) DEFAULT NULL,
  `dil` varchar(22) DEFAULT NULL,
  `mega_durum` varchar(2) DEFAULT NULL,
  `durum` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `header_menu`
--

INSERT INTO `header_menu` (`id`, `baslik`, `url`, `ust_id`, `sira`, `dil`, `mega_durum`, `durum`) VALUES
(1, 'Anasayfa', 'index.html', 0, 1, 'tr', '0', '1'),
(2, 'Ürünler', 'urunler', 0, 3, 'tr', '0', '1'),
(11, 'Gizlilik Sözleşmesi', 'sayfa/gizlilik-sozlesmesi', 10, 1, 'tr', '0', '1'),
(14, 'Blog', 'bloglar', 0, 7, 'tr', '0', '1'),
(16, 'İletişim', 'iletisim', 0, 9, 'tr', '0', '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hit`
--

CREATE TABLE `hit` (
  `id` int(11) NOT NULL,
  `gun` int(11) DEFAULT 1,
  `ay` int(11) DEFAULT 1,
  `yil` int(11) DEFAULT 1,
  `simdi` int(11) DEFAULT 1,
  `sayac` int(11) DEFAULT 1,
  `ip` varchar(100) COLLATE utf8_turkish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `hit`
--

INSERT INTO `hit` (`id`, `gun`, `ay`, `yil`, `simdi`, `sayac`, `ip`) VALUES
(1, 11, 2, 2020, 1, 78, '::1'),
(2, 12, 2, 2020, 1, 25, '::1'),
(3, 19, 2, 2020, 1, 67, '::1'),
(4, 20, 2, 2020, 1, 694, '::1'),
(5, 21, 2, 2020, 1, 20, '::1'),
(6, 22, 2, 2020, 1, 1, '::1'),
(7, 23, 2, 2020, 1, 24, '::1'),
(8, 25, 2, 2020, 1, 43, '::1'),
(9, 27, 2, 2020, 1, 13, '::1'),
(10, 4, 3, 2020, 1, 12, '::1'),
(11, 5, 3, 2020, 1, 8, '::1'),
(12, 3, 9, 2020, 1, 10, '::1'),
(13, 11, 9, 2020, 1, 1, '::1'),
(14, 12, 9, 2020, 1, 1, '::1'),
(15, 13, 9, 2022, 1, 965, '78.181.164.69'),
(16, 13, 9, 2022, 1, 1, '205.210.31.48'),
(17, 14, 9, 2022, 1, 120, '78.181.164.69'),
(18, 14, 9, 2022, 1, 537, '88.231.191.80'),
(19, 14, 9, 2022, 1, 100, '51.178.130.44'),
(20, 14, 9, 2022, 1, 22, '68.235.60.198'),
(21, 14, 9, 2022, 1, 75, '147.135.255.195'),
(22, 14, 9, 2022, 1, 223, '85.103.165.60'),
(23, 14, 9, 2022, 1, 1223, '2001:67c:198c:906:17::3ba'),
(24, 14, 9, 2022, 1, 28, '178.240.74.65'),
(25, 14, 9, 2022, 1, 2, '185.191.171.8'),
(26, 14, 9, 2022, 1, 1, '185.191.171.42'),
(27, 14, 9, 2022, 1, 1, '102.129.152.248'),
(28, 14, 9, 2022, 1, 934, '78.170.164.133'),
(29, 14, 9, 2022, 1, 111, '2001:67c:198c:906:16::3ba'),
(30, 14, 9, 2022, 1, 5, '65.108.62.76'),
(31, 14, 9, 2022, 1, 11, '37.130.122.79'),
(32, 14, 9, 2022, 1, 33, '164.132.163.139'),
(33, 14, 9, 2022, 1, 1, '51.222.253.14'),
(34, 14, 9, 2022, 1, 1, '51.222.253.8'),
(35, 14, 9, 2022, 1, 2, '2001:67c:198c:906:f::2cd'),
(36, 14, 9, 2022, 1, 1, '101.0.73.142'),
(37, 14, 9, 2022, 1, 45, '88.246.208.75'),
(38, 14, 9, 2022, 1, 1, '185.191.171.40'),
(39, 14, 9, 2022, 1, 1, '185.191.171.1'),
(40, 14, 9, 2022, 1, 1, '2a02:6b8:c29:f1d0:0:492c:53ff:0'),
(41, 14, 9, 2022, 1, 2, '5.45.207.149'),
(42, 14, 9, 2022, 1, 1, '87.250.224.22'),
(43, 14, 9, 2022, 1, 1, '185.191.171.38'),
(44, 15, 9, 2022, 1, 1, '185.191.171.45'),
(45, 15, 9, 2022, 1, 2, '185.191.171.35'),
(46, 15, 9, 2022, 1, 1, '185.191.171.8'),
(47, 15, 9, 2022, 1, 1, '185.191.171.34'),
(48, 15, 9, 2022, 1, 1, '185.191.171.39'),
(49, 15, 9, 2022, 1, 2, '185.191.171.11'),
(50, 15, 9, 2022, 1, 1, '185.191.171.9'),
(51, 15, 9, 2022, 1, 1, '185.191.171.2'),
(52, 15, 9, 2022, 1, 2, '185.191.171.7'),
(53, 15, 9, 2022, 1, 3, '185.191.171.36'),
(54, 15, 9, 2022, 1, 7, '2a01:4f9:1a:aba3::2'),
(55, 15, 9, 2022, 1, 1, '185.191.171.38'),
(56, 15, 9, 2022, 1, 1, '185.191.171.16'),
(57, 15, 9, 2022, 1, 1, '185.191.171.20'),
(58, 15, 9, 2022, 1, 1, '185.191.171.42'),
(59, 15, 9, 2022, 1, 2, '185.191.171.41'),
(60, 15, 9, 2022, 1, 1, '185.191.171.5'),
(61, 15, 9, 2022, 1, 2, '185.191.171.37'),
(62, 15, 9, 2022, 1, 4, '185.191.171.44'),
(63, 15, 9, 2022, 1, 1, '185.191.171.6'),
(64, 15, 9, 2022, 1, 520, '88.240.12.44'),
(65, 15, 9, 2022, 1, 2, '185.191.171.3'),
(66, 15, 9, 2022, 1, 66, '5.135.136.191'),
(67, 15, 9, 2022, 1, 1, '185.191.171.4'),
(68, 15, 9, 2022, 1, 1, '185.191.171.14'),
(69, 15, 9, 2022, 1, 17, '2001:67c:198c:906:f::24e'),
(70, 15, 9, 2022, 1, 1, '185.191.171.21'),
(71, 15, 9, 2022, 1, 1, '185.191.171.10'),
(72, 15, 9, 2022, 1, 2, '185.191.171.17'),
(73, 15, 9, 2022, 1, 11, '127.0.0.1'),
(74, 15, 9, 2022, 1, 1, '185.191.171.13'),
(75, 16, 9, 2022, 1, 2, '185.191.171.44'),
(76, 16, 9, 2022, 1, 2, '185.191.171.13'),
(77, 16, 9, 2022, 1, 1, '185.191.171.3'),
(78, 16, 9, 2022, 1, 1, '185.191.171.23'),
(79, 16, 9, 2022, 1, 2, '185.191.171.26'),
(80, 16, 9, 2022, 1, 1, '185.191.171.33'),
(81, 16, 9, 2022, 1, 1, '185.191.171.20'),
(82, 16, 9, 2022, 1, 3, '185.191.171.35'),
(83, 16, 9, 2022, 1, 2, '185.191.171.37'),
(84, 16, 9, 2022, 1, 1, '102.165.48.78'),
(85, 16, 9, 2022, 1, 1, '185.191.171.11'),
(86, 16, 9, 2022, 1, 1, '185.191.171.5'),
(87, 16, 9, 2022, 1, 3, '185.191.171.24'),
(88, 16, 9, 2022, 1, 2, '185.191.171.7'),
(89, 16, 9, 2022, 1, 107, '88.231.177.185'),
(90, 16, 9, 2022, 1, 4, '85.102.55.118'),
(91, 16, 9, 2022, 1, 1, '185.191.171.38'),
(92, 16, 9, 2022, 1, 3, '185.191.171.8'),
(93, 16, 9, 2022, 1, 3, '138.128.118.130'),
(94, 16, 9, 2022, 1, 10, '37.130.122.79'),
(95, 16, 9, 2022, 1, 1, '185.191.171.36'),
(96, 16, 9, 2022, 1, 1, '185.191.171.1'),
(97, 16, 9, 2022, 1, 1, '185.191.171.39'),
(98, 16, 9, 2022, 1, 1, '185.191.171.2'),
(99, 16, 9, 2022, 1, 1, '185.191.171.15'),
(100, 16, 9, 2022, 1, 1, '185.191.171.16'),
(101, 16, 9, 2022, 1, 1, '185.191.171.41'),
(102, 16, 9, 2022, 1, 1, '185.191.171.22'),
(103, 17, 9, 2022, 1, 234, '88.231.177.185'),
(104, 17, 9, 2022, 1, 4, '185.191.171.10'),
(105, 17, 9, 2022, 1, 31, '88.234.80.239'),
(106, 17, 9, 2022, 1, 1, '185.191.171.44'),
(107, 17, 9, 2022, 1, 2, '185.191.171.21'),
(108, 17, 9, 2022, 1, 60, '54.39.48.111'),
(109, 17, 9, 2022, 1, 14, '217.182.175.74'),
(110, 17, 9, 2022, 1, 17, '2001:67c:198c:906:21::1b9'),
(111, 17, 9, 2022, 1, 14, '2001:67c:198c:906:15::1b9'),
(112, 17, 9, 2022, 1, 123, '78.170.167.155'),
(113, 17, 9, 2022, 1, 14, '2001:67c:198c:906:23::1b9'),
(114, 17, 9, 2022, 1, 1, '185.191.171.37'),
(115, 17, 9, 2022, 1, 2, '185.191.171.38'),
(116, 17, 9, 2022, 1, 1, '185.191.171.8'),
(117, 17, 9, 2022, 1, 15, '178.247.178.56'),
(118, 17, 9, 2022, 1, 24, '188.165.65.182'),
(119, 17, 9, 2022, 1, 2, '185.191.171.34'),
(120, 17, 9, 2022, 1, 1, '185.191.171.6'),
(121, 17, 9, 2022, 1, 3, '185.191.171.26'),
(122, 17, 9, 2022, 1, 1, '185.191.171.24'),
(123, 17, 9, 2022, 1, 3, '185.191.171.9'),
(124, 17, 9, 2022, 1, 3, '185.191.171.11'),
(125, 17, 9, 2022, 1, 1, '185.191.171.25'),
(126, 17, 9, 2022, 1, 2, '185.191.171.7'),
(127, 17, 9, 2022, 1, 1, '185.191.171.23'),
(128, 17, 9, 2022, 1, 4, '185.191.171.43'),
(129, 17, 9, 2022, 1, 1, '185.191.171.35'),
(130, 17, 9, 2022, 1, 2, '185.191.171.3'),
(131, 17, 9, 2022, 1, 2, '185.191.171.45'),
(132, 17, 9, 2022, 1, 1, '185.191.171.20'),
(133, 17, 9, 2022, 1, 2, '185.191.171.40'),
(134, 17, 9, 2022, 1, 2, '185.191.171.41'),
(135, 17, 9, 2022, 1, 601, '85.102.45.46'),
(136, 17, 9, 2022, 1, 1, '185.191.171.5'),
(137, 17, 9, 2022, 1, 13, '2001:67c:2628:647:d::1b9'),
(138, 17, 9, 2022, 1, 2, '185.191.171.1'),
(139, 17, 9, 2022, 1, 1, '185.191.171.18'),
(140, 17, 9, 2022, 1, 2, '185.191.171.13'),
(141, 17, 9, 2022, 1, 1, '185.191.171.22'),
(142, 17, 9, 2022, 1, 33, '78.182.255.200'),
(143, 17, 9, 2022, 1, 1, '185.191.171.16'),
(144, 17, 9, 2022, 1, 1, '41.93.82.7'),
(145, 17, 9, 2022, 1, 1, '185.191.171.2'),
(146, 17, 9, 2022, 1, 1, '185.191.171.4'),
(147, 17, 9, 2022, 1, 1, '185.191.171.33'),
(148, 18, 9, 2022, 1, 1, '178.243.118.26'),
(149, 18, 9, 2022, 1, 1, '185.191.171.20'),
(150, 18, 9, 2022, 1, 1, '185.191.171.33'),
(151, 18, 9, 2022, 1, 4, '85.102.41.47'),
(152, 18, 9, 2022, 1, 1, '88.232.214.63'),
(153, 19, 9, 2022, 1, 1, '88.232.214.63'),
(154, 19, 9, 2022, 1, 7, '78.189.178.180'),
(155, 2, 10, 2022, 1, 21, '::1'),
(156, 3, 10, 2022, 1, 1, '::1'),
(157, 6, 10, 2022, 1, 4, '::1'),
(158, 12, 10, 2022, 1, 1, '::1'),
(159, 30, 10, 2022, 1, 213, '::1'),
(160, 14, 11, 2022, 1, 15, '::1'),
(161, 23, 11, 2022, 1, 1, '::1'),
(162, 24, 11, 2022, 1, 45, '::1'),
(163, 25, 11, 2022, 1, 1, '::1'),
(164, 30, 11, 2022, 1, 1, '::1'),
(165, 1, 12, 2022, 1, 357, '::1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `htmlsayfa`
--

CREATE TABLE `htmlsayfa` (
  `id` int(11) NOT NULL,
  `baslik` varchar(222) DEFAULT NULL,
  `icerik` text DEFAULT NULL,
  `seo_url` varchar(222) DEFAULT NULL,
  `tags` text DEFAULT NULL,
  `meta_desc` text DEFAULT NULL,
  `dil` varchar(22) DEFAULT NULL,
  `durum` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `htmlsayfa`
--

INSERT INTO `htmlsayfa` (`id`, `baslik`, `icerik`, `seo_url`, `tags`, `meta_desc`, `dil`, `durum`) VALUES
(1, 'Gizlilik Sözleşmesi', '<p>Gizlilik S&ouml;zleşmesi</p>', 'gizlilik-sozlesmesi', 'Gizlilik Sözleşmesi', 'Gizlilik Sözleşmesi', 'tr', '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `insan_kaynaklari`
--

CREATE TABLE `insan_kaynaklari` (
  `id` int(11) NOT NULL,
  `isim` varchar(222) DEFAULT NULL,
  `d_tarih` varchar(22) DEFAULT NULL,
  `cinsiyet` varchar(22) DEFAULT NULL,
  `medeni` varchar(22) DEFAULT NULL,
  `kangrubu` varchar(22) DEFAULT NULL,
  `mailadresi` varchar(44) DEFAULT NULL,
  `telno` varchar(22) DEFAULT NULL,
  `askerlik` varchar(222) DEFAULT NULL,
  `ehliyet` varchar(222) DEFAULT NULL,
  `il` varchar(22) DEFAULT NULL,
  `ilce` varchar(222) DEFAULT NULL,
  `egitim` text DEFAULT NULL,
  `yabancidil` text DEFAULT NULL,
  `tecrube` text DEFAULT NULL,
  `kisabilgi` text DEFAULT NULL,
  `tarih` datetime DEFAULT NULL,
  `durum` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kargo`
--

CREATE TABLE `kargo` (
  `id` int(11) NOT NULL,
  `kargo_adi` varchar(222) DEFAULT NULL,
  `takip_no` text DEFAULT NULL,
  `siparis_urun_id` varchar(22) DEFAULT NULL,
  `sms_mesaj` text DEFAULT NULL,
  `eposta_mesaj` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `marka`
--

CREATE TABLE `marka` (
  `id` int(11) NOT NULL,
  `baslik` varchar(222) DEFAULT NULL,
  `gorsel` text DEFAULT NULL,
  `url` text DEFAULT NULL,
  `sira` int(11) DEFAULT NULL,
  `durum` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `marka_ayar`
--

CREATE TABLE `marka_ayar` (
  `id` int(11) NOT NULL,
  `back_color` varchar(22) DEFAULT NULL,
  `width` varchar(22) DEFAULT NULL,
  `padding` varchar(22) DEFAULT NULL,
  `divider` varchar(22) DEFAULT NULL,
  `font_weight` varchar(22) NOT NULL,
  `baslik_color` varchar(22) DEFAULT NULL,
  `spot_color` varchar(22) DEFAULT NULL,
  `marka_limit` varchar(22) NOT NULL,
  `tags` text NOT NULL,
  `meta_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `marka_ayar`
--

INSERT INTO `marka_ayar` (`id`, `back_color`, `width`, `padding`, `divider`, `font_weight`, `baslik_color`, `spot_color`, `marka_limit`, `tags`, `meta_desc`) VALUES
(1, 'FFFFFF', '0', '0', 'divider', 'bold', 'EE293C', '666666', '15', 'tagla', 'aciklamalar');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `mesaj`
--

CREATE TABLE `mesaj` (
  `id` int(11) NOT NULL,
  `isim` varchar(222) DEFAULT NULL,
  `eposta` varchar(222) DEFAULT NULL,
  `telno` varchar(22) DEFAULT NULL,
  `mesaj` text DEFAULT NULL,
  `durum` varchar(2) DEFAULT NULL,
  `tarih` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `mesaj`
--

INSERT INTO `mesaj` (`id`, `isim`, `eposta`, `telno`, `mesaj`, `durum`, `tarih`) VALUES
(1, 'Alperen', 'yalperenyld@gmail.com', '5532000228', 'deneme', '0', '2022-11-30 16:53:57'),
(2, 'Alperen', 'yalperenyld@gmail.com', '5535', 'denem 2', '0', '2022-11-30 17:31:38');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `moduller`
--

CREATE TABLE `moduller` (
  `id` int(11) NOT NULL,
  `baslik` varchar(222) DEFAULT NULL,
  `kod` text DEFAULT NULL,
  `sira` int(11) DEFAULT NULL,
  `durum` varchar(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `moduller`
--

INSERT INTO `moduller` (`id`, `baslik`, `kod`, `sira`, `durum`) VALUES
(3, 'Ürünler ve Ürün Grupları', 'includes/template/_modules/products.php', 2, '1'),
(5, 'Sayaç', 'includes/template/_modules/counters.php', 3, '1'),
(7, 'Blog', 'includes/template/_modules/blog.php', 4, '1'),
(12, 'Müşteri Yorumları', 'includes/template/_modules/comments.php', 5, '1'),
(20, 'Sık Sorulan Sorular', 'includes/template/_modules/faq.php', 6, '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `odeme_ayar`
--

CREATE TABLE `odeme_ayar` (
  `id` int(11) NOT NULL,
  `pos_tur` varchar(2) DEFAULT NULL,
  `simge` varchar(22) DEFAULT NULL,
  `sepet_sistemi` varchar(2) DEFAULT NULL,
  `wp_siparis` varchar(2) DEFAULT NULL,
  `stok_durum` varchar(2) DEFAULT NULL,
  `stok_gorunum` varchar(2) DEFAULT NULL,
  `normal_siparis` varchar(2) DEFAULT NULL,
  `kredi_kart` varchar(2) NOT NULL,
  `eft` varchar(2) NOT NULL,
  `button_bg` varchar(22) DEFAULT NULL,
  `button_text_color` varchar(22) DEFAULT NULL,
  `kargo_sistemi` varchar(2) NOT NULL,
  `kargo_limit` varchar(30) DEFAULT NULL,
  `cart_icon` text DEFAULT NULL,
  `cart_color` varchar(22) NOT NULL,
  `cart_count_bg` varchar(22) NOT NULL,
  `cart_count_color` varchar(22) NOT NULL,
  `sepet_step` varchar(2) NOT NULL,
  `paytr_id` varchar(222) NOT NULL,
  `paytr_key` varchar(222) NOT NULL,
  `paytr_salt` varchar(222) NOT NULL,
  `shopier_key` text NOT NULL,
  `shopier_secret` text NOT NULL,
  `iyzico_key` text NOT NULL,
  `iyzico_secure` text NOT NULL,
  `payu_merchant` text NOT NULL,
  `payu_secret` text NOT NULL,
  `paywant_key` text NOT NULL,
  `paywant_secret` text NOT NULL,
  `paywant_odeme_tur` varchar(11) DEFAULT NULL,
  `kargolimit_product` varchar(2) NOT NULL,
  `kargolimit_header` varchar(2) NOT NULL,
  `kargolimit_bg_1` varchar(11) NOT NULL,
  `kargolimit_bg_2` varchar(11) NOT NULL,
  `kargolimit_font` varchar(22) NOT NULL,
  `kargolimit_width` varchar(2) NOT NULL,
  `kargolimit_text_color` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `odeme_ayar`
--

INSERT INTO `odeme_ayar` (`id`, `pos_tur`, `simge`, `sepet_sistemi`, `wp_siparis`, `stok_durum`, `stok_gorunum`, `normal_siparis`, `kredi_kart`, `eft`, `button_bg`, `button_text_color`, `kargo_sistemi`, `kargo_limit`, `cart_icon`, `cart_color`, `cart_count_bg`, `cart_count_color`, `sepet_step`, `paytr_id`, `paytr_key`, `paytr_salt`, `shopier_key`, `shopier_secret`, `iyzico_key`, `iyzico_secure`, `payu_merchant`, `payu_secret`, `paywant_key`, `paywant_secret`, `paywant_odeme_tur`, `kargolimit_product`, `kargolimit_header`, `kargolimit_bg_1`, `kargolimit_bg_2`, `kargolimit_font`, `kargolimit_width`, `kargolimit_text_color`) VALUES
(1, '0', '₺', '1', '1', '1', '1', '0', '1', '1', 'F63440', 'FFFFFF', '1', '750', 'fa fa-shopping-basket', 'E8234A', 'EDF62A', '000000', '1', '', '', '', '', '', '', '', '', '', '', '', '1,2,3', '0', '0', 'FF5959', '9E1111', 'raleway', '0', 'FFFFFF');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `page_header`
--

CREATE TABLE `page_header` (
  `id` int(11) NOT NULL,
  `tip` varchar(22) NOT NULL,
  `width` varchar(2) NOT NULL,
  `padding` varchar(11) NOT NULL,
  `bg_color` varchar(11) NOT NULL,
  `text_color` varchar(22) NOT NULL,
  `pasif_text_color` varchar(22) NOT NULL,
  `bg_image` text NOT NULL,
  `page_id` varchar(22) NOT NULL,
  `border_color` varchar(11) NOT NULL,
  `shadow` varchar(1) NOT NULL,
  `baslik` varchar(222) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `page_header`
--

INSERT INTO `page_header` (`id`, `tip`, `width`, `padding`, `bg_color`, `text_color`, `pasif_text_color`, `bg_image`, `page_id`, `border_color`, `shadow`, `baslik`) VALUES
(1, '0', '1', '30', 'f9f9f9', '000000', '999999', '1.jpg', 'hakkimizda', 'EBEBEB', '1', 'Hakkımızda'),
(2, '0', '0', '30', 'F9F9F9', '000000', '999999', '', 'htmlsayfa', 'EBEBEB', '1', 'HTML Sayfalar'),
(10, '0', '1', '30', 'f9f9f9', '000', '666', '', 'blog', 'ebebeb', '1', 'Blog'),
(13, '0', '1', '30', 'F9F9F9', '000', '666', '', 'bank', 'EBEBEB', '1', 'Hesap Numaraları'),
(15, '0', '1', '30', 'F9F9F9', '000', '666', '', 'video', 'EBEBEB', '1', 'Video Galeri'),
(16, '0', '1', '30', 'f9f9f9', '000', '666', '', 'ik', 'ebebeb', '1', 'İnsan Kaynakları'),
(17, '0', '1', '30', 'F9F9F9', '000', '666', '', 'products', 'EBEBEB', '1', 'Ürünler'),
(18, '0', '1', '30', 'F9F9F9', '000000', '666666', '879136992-185-demo-slider.jpg', 'products_detail', 'EBEBEB', '1', 'Ürün Detayları'),
(19, '0', '1', '30', 'f9f9f9', '000', '666', '', 'cart', 'EBEBEB', '1', 'Sepet'),
(20, '0', '1', '30', 'F9F9F9', '000', '666', '', 'alert', 'EBEBEB', '1', 'Başarılı Sipariş'),
(21, '0', '1', '30', 'F9F9F9', '000', '666', '', 'search', 'EBEBEB', '1', 'Arama Sayfası'),
(23, '0', '1', '30', 'F9F9F9', '000', '666', '', 'faq', 'EBEBEB', '1', 'Sık Sorulan Sorular'),
(24, '0', '1', '30', 'F9F9F9', '000000', '666666', '', 'uyeler', 'EBEBEB', '1', 'Üyeler'),
(25, '0', '1', '30', 'F9F9F9', '000', '666', '', 'offer', 'EBEBEB', '1', 'Teklif Formu'),
(26, '0', '1', '30', 'F9F9F9', '000000', '666666', '', 'tracing', 'EBEBEB', '1', 'Sipariş Takip');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `paywant_user`
--

CREATE TABLE `paywant_user` (
  `id` int(11) NOT NULL,
  `user_id` varchar(22) DEFAULT NULL,
  `user_email` varchar(222) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sabit_header`
--

CREATE TABLE `sabit_header` (
  `id` int(11) NOT NULL,
  `durum` varchar(2) DEFAULT NULL,
  `padding` varchar(222) DEFAULT NULL,
  `shadow` varchar(22) DEFAULT NULL,
  `arkaplan` varchar(22) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `sabit_header`
--

INSERT INTO `sabit_header` (`id`, `durum`, `padding`, `shadow`, `arkaplan`) VALUES
(1, '0', '10', '0', 'FFFFFF');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sayac`
--

CREATE TABLE `sayac` (
  `id` int(1) NOT NULL,
  `baslik` varchar(222) DEFAULT NULL,
  `count` varchar(22) DEFAULT NULL,
  `icon` varchar(222) DEFAULT NULL,
  `plus` varchar(2) DEFAULT NULL,
  `sira` int(11) DEFAULT NULL,
  `dil` varchar(22) DEFAULT NULL,
  `durum` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `sayac`
--

INSERT INTO `sayac` (`id`, `baslik`, `count`, `icon`, `plus`, `sira`, `dil`, `durum`) VALUES
(1, 'MUTLU MÜŞTERİ', '500', 'fa-handshake-o', '1', 1, 'tr', '1'),
(2, 'ÇALIŞAN SAYISI', '55', 'fa-hashtag', '0', 3, 'tr', '1'),
(3, 'ŞUBE SAYISI', '16', 'fa-motorcycle', '0', 2, 'tr', '1'),
(4, 'POZİTİF YORUM', '1000', 'fa-heart-o', '1', 4, 'tr', '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sayac_ayar`
--

CREATE TABLE `sayac_ayar` (
  `id` int(11) NOT NULL,
  `back_color` varchar(22) NOT NULL,
  `width` varchar(2) NOT NULL,
  `padding` varchar(22) NOT NULL,
  `box_bg_color` varchar(22) NOT NULL,
  `box_text_color` varchar(22) NOT NULL,
  `box_border_color` varchar(22) NOT NULL,
  `icon` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `sayac_ayar`
--

INSERT INTO `sayac_ayar` (`id`, `back_color`, `width`, `padding`, `box_bg_color`, `box_text_color`, `box_border_color`, `icon`) VALUES
(1, 'F8F8F8', '0', '40', 'F8F8F8', 'E9003F', 'F8F8F8', '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `siparis`
--

CREATE TABLE `siparis` (
  `id` int(11) NOT NULL,
  `ara_tutar` varchar(222) DEFAULT NULL,
  `kdv_tutar` varchar(222) DEFAULT NULL,
  `kargo_tutar` varchar(222) DEFAULT NULL,
  `toplam_tutar` varchar(222) DEFAULT NULL,
  `isim` varchar(222) DEFAULT NULL,
  `tel` varchar(222) DEFAULT NULL,
  `eposta` varchar(222) DEFAULT NULL,
  `adres` text DEFAULT NULL,
  `adres_fatura` text DEFAULT NULL,
  `sehir` varchar(222) DEFAULT NULL,
  `postakodu` varchar(22) DEFAULT NULL,
  `notlar` text DEFAULT NULL,
  `odeme_tip` varchar(2) DEFAULT NULL,
  `siparis_id` varchar(22) DEFAULT NULL,
  `siparis_tarih` datetime DEFAULT NULL,
  `siparis_no` varchar(22) DEFAULT NULL,
  `siparis_durum` varchar(2) DEFAULT NULL,
  `user_id` varchar(11) DEFAULT NULL,
  `shopier_no` varchar(22) DEFAULT NULL,
  `shopier_sip_no` varchar(22) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `siparis_urunler`
--

CREATE TABLE `siparis_urunler` (
  `id` int(11) NOT NULL,
  `urun_id` varchar(22) DEFAULT NULL,
  `siparis_id` varchar(22) DEFAULT NULL,
  `urun_baslik` varchar(222) DEFAULT NULL,
  `adet` varchar(11) DEFAULT NULL,
  `tutar` varchar(33) DEFAULT NULL,
  `kdv_tutar` varchar(33) DEFAULT NULL,
  `kargo_tutar` varchar(33) DEFAULT NULL,
  `varyantlar` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sitemap`
--

CREATE TABLE `sitemap` (
  `id` int(11) NOT NULL,
  `baslik` varchar(222) DEFAULT NULL,
  `adres` text DEFAULT NULL,
  `sira` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `sitemap`
--

INSERT INTO `sitemap` (`id`, `baslik`, `adres`, `sira`) VALUES
(1, 'Anasayfa', 'https://', 2),
(8, 'Hakkımızda', 'https://', 1),
(9, 'Hesap Numaralarımız', 'https://', 3),
(10, 'İnsan Kaynakları', 'https://', 4);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sitemap_ayar`
--

CREATE TABLE `sitemap_ayar` (
  `id` int(11) NOT NULL,
  `statik_map` varchar(2) DEFAULT NULL,
  `urun` varchar(2) DEFAULT NULL,
  `urun_kat` varchar(2) DEFAULT NULL,
  `blog` varchar(2) DEFAULT NULL,
  `hizmet` varchar(2) DEFAULT NULL,
  `foto` varchar(2) DEFAULT NULL,
  `video` varchar(2) DEFAULT NULL,
  `proje` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `sitemap_ayar`
--

INSERT INTO `sitemap_ayar` (`id`, `statik_map`, `urun`, `urun_kat`, `blog`, `hizmet`, `foto`, `video`, `proje`) VALUES
(1, '1', '1', '1', '1', '1', '1', '1', '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `tur` varchar(2) DEFAULT NULL,
  `baslik` varchar(222) DEFAULT NULL,
  `spot` text DEFAULT NULL,
  `url` text DEFAULT NULL,
  `text_status` varchar(2) DEFAULT NULL,
  `baslik_animation` varchar(22) DEFAULT NULL,
  `spot_animation` varchar(22) DEFAULT NULL,
  `button_animation` varchar(22) DEFAULT NULL,
  `dark_bg` varchar(2) DEFAULT NULL,
  `area` varchar(11) DEFAULT NULL,
  `gorsel` text DEFAULT NULL,
  `button_text` varchar(22) DEFAULT NULL,
  `button_bg` varchar(22) DEFAULT NULL,
  `text_bg` varchar(22) DEFAULT NULL,
  `button_text_color` varchar(22) DEFAULT NULL,
  `slider_2_bg` varchar(22) DEFAULT NULL,
  `dil` varchar(22) DEFAULT NULL,
  `sira` int(11) DEFAULT NULL,
  `durum` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `slider`
--

INSERT INTO `slider` (`id`, `tur`, `baslik`, `spot`, `url`, `text_status`, `baslik_animation`, `spot_animation`, `button_animation`, `dark_bg`, `area`, `gorsel`, `button_text`, `button_bg`, `text_bg`, `button_text_color`, `slider_2_bg`, `dil`, `sira`, `durum`) VALUES
(25, '1', 'Kol Saati', 'Kol Saati slider düzenlenecek', '', '1', 'fade-up', 'fade-up', 'fade-up', '0', 'left', '4258046361815-216-Sunum2.png', '', 'warning', 'FFFFFF', 'FFFFFF', NULL, 'tr', 5, '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `slider_ayar`
--

CREATE TABLE `slider_ayar` (
  `id` int(11) NOT NULL,
  `width` varchar(2) NOT NULL,
  `height` varchar(2) NOT NULL,
  `mobil_height` varchar(22) NOT NULL,
  `font` varchar(222) NOT NULL,
  `width_2` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `slider_ayar`
--

INSERT INTO `slider_ayar` (`id`, `width`, `height`, `mobil_height`, `font`, `width_2`) VALUES
(1, '0', '1', '400', 'Raleway', '0');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sosyal`
--

CREATE TABLE `sosyal` (
  `id` int(11) NOT NULL,
  `baslik` varchar(222) DEFAULT NULL,
  `url` text DEFAULT NULL,
  `icon` varchar(222) DEFAULT NULL,
  `bg_color` varchar(22) DEFAULT NULL,
  `icon_color` varchar(22) DEFAULT NULL,
  `sira` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `sosyal`
--

INSERT INTO `sosyal` (`id`, `baslik`, `url`, `icon`, `bg_color`, `icon_color`, `sira`) VALUES
(3, 'instagram', 'https://www.instagram.com/yalperenyld/', 'fa-instagram', '000', '000', 1),
(4, 'Linkedin', 'https://www.linkedin.com/in/alperen-y%C4%B1ld%C4%B1r%C4%B1m-b42331118/', 'fa-linkedin', '000', '000', 6),
(6, 'WhatsApps', 'https://api.whatsapp.com/send?phone=905532000228', 'fa-whatsapp', '', '', 7);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sozlesme`
--

CREATE TABLE `sozlesme` (
  `id` int(11) NOT NULL,
  `icerik` text DEFAULT NULL,
  `dil` varchar(22) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `sozlesme`
--

INSERT INTO `sozlesme` (`id`, `icerik`, `dil`) VALUES
(8, '<div>Praesent congue erat at massa. Nunc sed turpis. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. In turpis. Nullam tincidunt adipiscing enim.<br></div><div>Maecenas malesuada. Praesent turpis. Fusce neque. Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. Donec mi odio, faucibus at, scelerisque quis, convallis in, nisi.<br></div><div>Phasellus a est. Donec posuere vulputate arcu. Fusce pharetra convallis urna. Proin viverra, ligula sit amet ultrices semper, ligula arcu tristique sapien, a accumsan nisi mauris ac eros. Fusce egestas elit eget lorem.Praesent congue erat at massa. Nunc sed turpis. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. In turpis. Nullam tincidunt adipiscing enim.</div><div>Maecenas malesuada. Praesent turpis. Fusce neque. Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. Donec mi odio, faucibus at, scelerisque quis, convallis in, nisi.<br></div><div>Phasellus a est. <br><br>Donec posuere vulputate arcu. Fusce pharetra convallis urna. Proin viverra, ligula sit amet ultrices semper, ligula arcu tristique sapien, a accumsan nisi mauris ac eros. Fusce egestas elit eget lorem.Praesent congue erat at massa. Nunc sed turpis. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. In turpis. Nullam tincidunt adipiscing enim.</div><div>Maecenas malesuaretra convallis urna. Proin viverra, ligula sit amet ultrices semper, ligula arcu tristique sapien, a accumsan nisi mauris ac eros. Fusce egestas elit eget lorem.</div><div><br><div>Praesent congue erat at massa. Nunc sed turpis. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. In turpis. Nullam tincidunt adipiscing enim.<br></div><div>Maecenas malesuada. Praesent turpis. Fusce neque. Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. Donec mi odio, faucibus at, scelerisque quis, convallis in, nisi.<br></div><div>Phasellus a est. Donec posuere vulputate arcu. Fusce pharetra convallis urna. Proin viverra, ligula sit amet ultrices semper, ligula arcu tristique sapien, a accumsan nisi mauris ac eros. Fusce egestas elit eget lorem.</div></div>', 'tr'),
(9, '<p>EN- Lorem ipsum dolor sit amet, consectetur adipiscing elit. In malesuada, velit vitae sollicitudin malesuada, metus lacus ornare dui, et dignissim velit augue non justo. In hac habitasse platea dictumst. Integer imperdiet ante mauris, ut malesuada purus imperdiet quis. Nulla id purus ultrices, tempus nisl vitae, faucibus felis. Cras ullamcorper leo odio, bibendum condimentum nisi suscipit sed. Phasellus posuere augue vel mi consectetur, ac commodo arcu vestibulum. Sed ullamcorper tortor lacus, in lacinia ante sodales et. Duis sagittis dictum ligula, eu consectetur tortor iaculis eu. Ut consequat iaculis ligula, vehicula euismod arcu efficitur quis.</p>\r\n<p>Sed congue lobortis elit, a volutpat augue pellentesque nec. Pellentesque at dapibus lacus. Sed sit amet neque commodo, interdum elit a, fermentum risus. Fusce et vestibulum felis, at varius mi. Fusce quis rutrum tellus, ac tempor lacus. Ut egestas sem magna, ac egestas massa auctor a. Aliquam arcu purus, suscipit at tempor ac, commodo sit amet lorem. In eu mollis nunc.</p>\r\n<p>Mauris eu elit consectetur, finibus odio nec, tempor risus. Integer consequat auctor sem vehicula sagittis. Aenean mattis arcu nisl, sed ultrices erat varius vitae. Vestibulum tincidunt velit eget turpis suscipit bibendum. Aliquam id sollicitudin purus. Praesent vehicula, risus quis condimentum maximus, eros elit egestas eros, sed tempus mi dolor nec sapien. Suspendisse lobortis sodales quam ut elementum.</p>\r\n<p>Proin libero mauris, auctor ut vestibulum ut, fermentum eget ipsum. Proin maximus malesuada ante in cursus. Donec arcu tortor, placerat eget sollicitudin a, lacinia euismod mi. Pellentesque ut urna vitae orci finibus sodales. Integer porttitor dolor in libero ornare, in convallis est mattis. Vivamus at accumsan justo, eu tincidunt ex. Proin semper, massa ac malesuada eleifend, odio libero feugiat tellus, ut laoreet nisi leo aliquet lorem. Interdum et malesuada fames ac ante ipsum primis in faucibus. Duis eu dui sed magna bibendum tempus nec eget lorem. Morbi sit amet nunc eget est mollis fringilla. In at magna nisi. Duis a lectus et nunc feugiat gravida ac ut enim. Duis augue ligula, gravida vitae euismod in, semper in ipsum. Praesent nec ex at nisi mattis interdum. Nam venenatis hendrerit justo, quis dapibus ex molestie sit amet.</p>\r\n<p>Ut in diam fringilla, vestibulum mauris nec, congue nulla. Vivamus eu diam sagittis, pharetra nisl eget, eleifend nisl. Curabitur placerat, eros vel euismod eleifend, orci tellus sollicitudin purus, quis bibendum leo est eget magna. Aenean nisi sem, tincidunt quis finibus quis, ultrices a velit. Mauris consequat neque in ornare semper. Etiam vel tincidunt metus, sit amet iaculis turpis. Suspendisse venenatis ultrices lectus, vel bibendum mi bibendum at. Nam purus arcu, aliquet ac varius eu, congue interdum felis. Sed id aliquam elit, tincidunt placerat neque. Etiam volutpat felis at mauris iaculis porttitor. Morbi dapibus varius commodo. Nullam et magna non ante aliquet semper ut imperdiet sem. Nullam eu nisi nec mauris tincidunt gravida eu a enim.</p>', 'en');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sss`
--

CREATE TABLE `sss` (
  `id` int(11) NOT NULL,
  `soru` varchar(300) DEFAULT NULL,
  `cevap` text DEFAULT NULL,
  `sira` int(11) DEFAULT NULL,
  `anasayfa` varchar(2) DEFAULT NULL,
  `dil` varchar(22) DEFAULT NULL,
  `durum` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `sss`
--

INSERT INTO `sss` (`id`, `soru`, `cevap`, `sira`, `anasayfa`, `dil`, `durum`) VALUES
(1, 'Soru 1 ', 'Soru 1 cevabı', 1, '1', 'tr', '1'),
(2, 'Soru 2 ', 'Soru 2 cevabı', 2, '1', 'tr', '1'),
(3, 'Soru 3 ', 'Soru 3 cevabı', 3, '1', 'tr', '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sss_ayar`
--

CREATE TABLE `sss_ayar` (
  `id` int(11) NOT NULL,
  `back_color` varchar(22) NOT NULL,
  `width` varchar(2) NOT NULL,
  `padding` varchar(22) NOT NULL,
  `font_weight` varchar(22) NOT NULL,
  `baslik_color` varchar(22) NOT NULL,
  `spot_color` varchar(22) NOT NULL,
  `divider` varchar(222) NOT NULL,
  `sss_limit` varchar(22) NOT NULL,
  `tags` text NOT NULL,
  `meta_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `sss_ayar`
--

INSERT INTO `sss_ayar` (`id`, `back_color`, `width`, `padding`, `font_weight`, `baslik_color`, `spot_color`, `divider`, `sss_limit`, `tags`, `meta_desc`) VALUES
(1, 'F7F7F7', '0', '65', 'bold', 'E9003F', '666666', 'divider', '5', 'tag', 'meta');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ticaret_bilgi`
--

CREATE TABLE `ticaret_bilgi` (
  `id` int(11) NOT NULL,
  `baslik` varchar(222) DEFAULT NULL,
  `icon` varchar(222) DEFAULT NULL,
  `sira` int(11) DEFAULT NULL,
  `dil` varchar(22) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `ticaret_bilgi`
--

INSERT INTO `ticaret_bilgi` (`id`, `baslik`, `icon`, `sira`, `dil`) VALUES
(1, 'AYNI GÜN KARGO İMKANI', 'fa-truck', 1, 'tr'),
(2, 'ÜCRETSİZ İADE GARANTİSİ', 'fa-recycle', 2, 'tr'),
(3, '256Bit GÜVENLİ ÖDEME', 'fa-umbrella', 3, 'tr'),
(4, '7/24 DESTEK HİZMETİ', 'fa-headphones', 4, 'tr'),
(6, '45', 'fa-500px', 1, 'en');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `total_visitors`
--

CREATE TABLE `total_visitors` (
  `id` int(11) NOT NULL,
  `session` text DEFAULT NULL,
  `time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `total_visitors`
--

INSERT INTO `total_visitors` (`id`, `session`, `time`) VALUES
(1, 'veu86jv70mh3r7fcjsausaqfm3', 1581442038),
(2, '0lal9ul3u4q9qg2iukspnk3rj4', 1581501151),
(3, 'dekd8b55k2bbqvh29pceqpocl5', 1582218501),
(4, 'sltetvqmv8leeh4nelr8ska6h9', 1582292233),
(5, 'c8i08l4q732vvk9oe7jfghv1eo', 1582457380),
(6, 'r9m9ntnihlj5ec3qqe15cod7f3', 1582660145),
(7, '06mhr0ud8a6ktr6ua03g8s9j60', 1582810694),
(8, 'qsq62ks6avj17prh8r4nuljug5', 1583349717),
(9, 'ovsfl0r569202lkrujgv2r8it9', 1583436516),
(10, 'g5pnpsdnppvpbtui67jknsnv5m', 1599143383),
(11, 'jb843f2gbg1a4t36cg5t7mu9s8', 1599859351),
(12, 'cc0c28877c0f497c3362dae8dc3b2715', 1663081410),
(13, 'b013dde85c01065eccc6ed5432421bc4', 1663079574),
(14, 'f51afd878d03ac2f5c15a979007a6be1', 1663105045),
(15, '4da4be5ce1cfcb502eed57f1e78a509f', 1663082941),
(16, '40d8941fb79c7ea89675a503a4b2ed54', 1663084669),
(17, '7a77d959ed2d3122c88f66ee715db5f4', 1663088217),
(18, '64ba9432b5b4c5af719967eeef68ebbc', 1663089378),
(19, 'c8cb4455ea997470f0a668019b3b6522', 1663089772),
(20, 'f8a28c1777e40939c9152f1b84be840f', 1663089774),
(21, 'e23ef9b8a62abad684d511ae783d3598', 1663090831),
(22, '4baa39bc9c4a1f3686c3483af5cc8936', 1663094378),
(23, '6ccda6ae3a485571e28ebdb0e225b4cc', 1663092833),
(24, 'f7d145c59cd5b5c6388464930188e03f', 1663092863),
(25, 'c15ca450879cf3fca7db021deb25b79d', 1663105473),
(26, '64b514893b14e1cf69d49421c0d10236', 1663104989),
(27, '3d9a144b7a9df4731c394a81c4407650', 1663106747),
(28, '1a16aae7195dccc3094143630ad54fe9', 1663111045),
(29, 'e66fe0c3c9415a910c065835fb0960c1', 1663115614),
(30, 'e475932144352032db4abc98f3c825eb', 1663111060),
(31, '1ca927b248c57e7756b5fcad6d22743b', 1663115489),
(32, '78826a68cebd36839dc0e7789942669d', 1663113291),
(33, '7182475c1133bebda49230954c2d7d85', 1663113608),
(34, 'eedcc6816bd4fe7f317f4c00c2c8cbd8', 1663116260),
(35, 'afc500bdb8274f50647e29d0187f6438', 1663125121),
(36, '8d6dd1a44ea708f56d371515f45399ff', 1663116600),
(37, '435570bd454fbabbb85ecb01f2bc0651', 1663116608),
(38, '44de5d793df031f62dbf1a6445e656ed', 1663421591),
(39, '4a49e857ac546bc2380062c8c5364ce7', 1663124201),
(40, 'd7a07ed2c6b84cb2a4b74ce023c3b372', 1663126951),
(41, 'b39a67e259c57bc7b5ec168ba2d07fa7', 1663126952),
(42, 'a7da5e8ffd65bff4c95a9cb4b1290fef', 1663138115),
(43, 'dfda2d351eddffbf4367b7a8d370a931', 1663148373),
(44, '87781e30e6d8ddf20b92efa0c2f62086', 1663148497),
(45, 'dac525effc04b145ca511b8473d855a0', 1663145066),
(46, '9614d265c11e3d826c8df8b703e315ee', 1663145077),
(47, 'c79b6da215d90b41435bf218679513b1', 1663145092),
(48, 'd63b83c08bcde68203c02ca4f33c1ea8', 1663145102),
(49, 'c53f4de6a57225bf0451425995791507', 1663145111),
(50, '003c498e2d44487e8908f2a21755ee2e', 1663149590),
(51, '0894c3cf7daf6c8c247b75f426e62471', 1663145869),
(52, '1f982ebb864bfc3c9ddd7fc2741be48a', 1663147773),
(53, '86a4b3eb24b16051a98d52c395ae81a9', 1663148282),
(54, 'c91abf6b5e7363c9ba53bc4e08444af9', 1663154248),
(55, 'a0a844fc90e71ba063bca0b50d6f81cc', 1663154249),
(56, '848083182f8b69281eeea65b5db40aab', 1663162746),
(57, 'df09899110c95c5628eed96fd119919a', 1663170150),
(58, '3f65305e11fae7caec3f7540b85815a7', 1663175300),
(59, 'ba52c4140da734c9f922fc2a7095e3fd', 1663177054),
(60, 'ec4277890f412adb37a7d3852d371d32', 1663177055),
(61, '7e27b5fc25b920e628ba450515060c83', 1663177540),
(62, '6c3cf0f04c22ae3624a4391ba990925b', 1663180899),
(63, '35bbd17dbbcef49097fd9b6091a7aca4', 1663180908),
(64, 'cafe69c304d34aecef6ae9655ab7eb23', 1663180912),
(65, '7a92e70675b97437e1a3291346f2524c', 1663180966),
(66, '46a48b2885df3623e506507cc952da71', 1663184210),
(67, 'a470bb07fac1b1acb11dc5dcc85a9aea', 1663192077),
(68, '96bc7209e373a127d6abfb90ad590b7d', 1663192079),
(69, '9b99e03d4004e34f6e07413ce29c2771', 1663193588),
(70, '75bd0723ef444cdc43bfce27566576c1', 1663195480),
(71, 'f7318b605657304b686557acc8cf99b7', 1663198967),
(72, 'fd6194f7da5eddfe689256e7259b1725', 1663198968),
(73, '113ab022a10e0b4433c2abe4f1e5230c', 1663206785),
(74, 'fe5373ab7d2046e6ef2f4c6157f81f1d', 1663206789),
(75, '063677adddd47437cdc3d161680d1103', 1663207233),
(76, 'e6e23a7eadbd9d083e4ee06dd30b660a', 1663208791),
(77, 'a2289df5987642a612cd0a16938d8b0d', 1663210837),
(78, '9bf92cb25d3fdfcbf5175e411f7d5f4a', 1663210853),
(79, '62b7b20e8976e825c27e51cd7f3c756d', 1663211918),
(80, 'aaff5687d39a7f5d031ecdfd6188d2dd', 1663211920),
(81, '53f8a39da1d7c1ef5d71b46c9622306a', 1663211922),
(82, '4f17dc385119d141c71d01620ddaadbd', 1663211924),
(83, 'afebb0ebcd8756371db5407a1f9d9e4a', 1663211926),
(84, '7d8c160fa2036c67260466807d2065d6', 1663212261),
(85, 'a6d304d5d19cffd443eb5b3941999414', 1663212261),
(86, 'fe2b1e991966e3011381d25bbea9f7bd', 1663212557),
(87, 'c91fe545078ab15a786d4c6969ea461b', 1663218392),
(88, '0450784365d39246b1b94cb56e3e952d', 1663218393),
(89, '0f8c7759347fe7e02e082c4bbda21843', 1663224919),
(90, '2cc0b653ae048e52c703d7dcde3fc148', 1663224919),
(91, 'e26ded3cf884a50a5acf886f9c0422e2', 1663225697),
(92, 'b102bc9c0e737ae42e7c73a80be83039', 1663228686),
(93, 'a3511c704b9ec4e073314eed2c81f9ee', 1663228687),
(94, 'eb1da5feb1575f513d23bbb1c76abba5', 1663230049),
(95, '63080969a51d6f3c3e6ea51421fcf0e1', 1663239295),
(96, 'b69e1ea9c5e818312e97741800fd36eb', 1663239295),
(97, 'ad182e0d0cd989a286e90accd44bab9a', 1663252008),
(98, '65b91572018ce6f020d62aafbe869798', 1663247583),
(99, '332e0062b3faf2d44c61cffddce47de3', 1663247746),
(100, 'e69cfb060a32e296457162924c64602b', 1663247764),
(101, 'cf806efd1996f20bec3c6478f92e0402', 1663248934),
(102, '131f076f1523418597e501c16336a12d', 1663249515),
(103, '8fec5e2e07fbe20145c63dd904777b47', 1663249516),
(104, 'be33124aa6317c9f89741ecf3877228f', 1663250751),
(105, '3b1e56803190db1d96e1e1759fef9af7', 1663251439),
(106, '0938b2503311d167f745ac582acdd69d', 1663251890),
(107, '7bf77535d3e1267a2d36a71ca56cc4ee', 1663252207),
(108, '8b0f8a8adf2dad0f2c55bd7b6fc7f690', 1663252342),
(109, '2a47ceb55d07062c3dd0112f81a4cdb6', 1663252426),
(110, '04c9fd42efd679a62082d3e614de9407', 1663252441),
(111, 'f0274ed76c2eb6df5b11ae0493c3e186', 1663252645),
(112, 'ffc4a2ccc27afe3385425890f0709554', 1663254654),
(113, '777b88d146ba698c4a989e2a6202dcfb', 1663254655),
(114, '12d712213162cd1edc862b4059bf259a', 1663254962),
(115, '75d1579a8f3b92032b584b5fe04c1df3', 1663257988),
(116, '760bccdb871b5b428b27b508a9e358eb', 1663262597),
(117, '4905db91cc4efac3ab86dd7ef1fc6e8f', 1663262765),
(118, '2f2e33c416fdd6ca0fa895aeb18d6136', 1663262767),
(119, 'f824f6181764cb13d18623e014374f41', 1663264803),
(120, '568ea0f31fcef7927ceb66dd9a774775', 1663266671),
(121, '5d2abb9c6c86c83116c2e3cf9152855e', 1663267234),
(122, 'b9ff0dc32c2a055ecaf0d9426d32609d', 1663267235),
(123, 'a7b708ab6fc2878f53b3ac1656fa3d54', 1663267325),
(124, '345af23d2f40401bef203b5c3a51badc', 1663268062),
(125, '1d5b1bf0d6ae5994ff8db44b82995634', 1663269588),
(126, '2afae37fcb1124165db11f40d4834290', 1663269593),
(127, '0c642fa7dc3bcce0624e3c3c47fe38b8', 1663272524),
(128, '42c6d92a4ac8e6ce52fdf9de760c0c27', 1663272524),
(129, '346d0411ceb82335faa273a3f031e6c0', 1663272823),
(130, 'a51189f15f4c88b967b3658ca58fdbc1', 1663278754),
(131, 'd3bd0a6794f762f9a7ff5f357c59eda9', 1663278755),
(132, 'bbde318acdf2635f54f4b599849a0018', 1663279976),
(133, '3b23bed97657ac676fae3fad4dcc6739', 1663280693),
(134, '6c517eaab5ba126c40e9d9ffac868c42', 1663280833),
(135, 'b0c1960f8a51b906535e2fcf2d58ad1b', 1663285944),
(136, 'c4768d9c9889a76db053dacb419336d0', 1663285944),
(137, '031f4cc6ad3dd1d4b5cda3f92975d8b4', 1663289456),
(138, 'bea55c669bb784ba45e7f9e265742355', 1663290360),
(139, 'b5a16295c814470a853fa2d6c09edf80', 1663290361),
(140, 'ae859602a8439bf7cb99aa2ac57dc6db', 1663294910),
(141, 'b160037ab57bfa391f532f48431d05e2', 1663294911),
(142, 'ad23c411ba96429173e416226c69919e', 1663296717),
(143, 'e7bead22e2fb22c080b3c4afeeda28af', 1663297521),
(144, '8d825b4b98cb6a622c572c46c7e7925f', 1663299426),
(145, 'ce419b7dfd5dee31802a527677c540c0', 1663299427),
(146, '3f7391bc4a662fc5163a6dbd35957c46', 1663300201),
(147, 'dfe4d387c2bd2a61484daa0e92daa328', 1663304726),
(148, '6d66295e85d705d5243c20d2ae05eada', 1663304727),
(149, '0d5a33143af307258678ba36febd871b', 1663327591),
(150, '549581ac6c0ce90b0b53c68c549cfd34', 1663322464),
(151, 'd9db2cb4602ac5823a1871c681d0c987', 1663328483),
(152, 'd97f717f3b99d0b59c2c35d2cdc840b0', 1663328482),
(153, 'fc582c283bf6009c6aac081f20dc31d1', 1663329721),
(154, 'ac07a7c51a470a2b11f84803f7a782a2', 1663329722),
(155, '6ea07d555724bc4624edca8d57eec941', 1663338318),
(156, '1bd55cb239fdf5ac8e1041370a627203', 1663339331),
(157, 'a8c81b79d497e95e407c0007f87fda01', 1663341041),
(158, '131f41594f2cc17f63fdedf4791c256a', 1663341042),
(159, '57e17945f58414e5d29782492fb1fe13', 1663341839),
(160, 'aba12a09611bc10674c1f5c5b6558d4f', 1663344847),
(161, 'fde649d2cd4e19b446d86f9535e59fb1', 1663344848),
(162, 'edc8f7d397184c2e5085bd16ae4cb33b', 1663344850),
(163, 'c26944692fc26c1c703dad25cab72196', 1663348345),
(164, '08969246eef6633fd2414b2816989a0d', 1663353353),
(165, '615b39fef05f6b909846d776f6bf72c9', 1663353354),
(166, 'a5f3b449fd4252654895b3280494f756', 1663354107),
(167, 'eebcaabd5d6c1f62979207878624c032', 1663355193),
(168, 'dbabe10dfe6ca4c6bf980c4730f4fad6', 1663356247),
(169, '6f24c2a448eb13d91605bac3ff0baaff', 1663362065),
(170, '79d66b17ed8309a82db7fcec3aaeebe0', 1663361646),
(171, '1f1a72cf5aa6437a3aea995db075c57d', 1663361647),
(172, 'a9408acf8f8d7c40f67d58048739c3b6', 1663368700),
(173, '70f98ad23cd69d21b1178f14b8d2f2bb', 1663364447),
(174, '6e6fe828ab1e49e0328dd7ad7db94282', 1663365284),
(175, 'fae0b5581c34e9b3422425c54f8c31df', 1663366858),
(176, '7bd28f6507ae15eac711bd9261425324', 1663366165),
(177, '3fe795027b26df77209176eb15ec3ce8', 1663366559),
(178, 'b98f5661180e5f568d9f90c647319fa0', 1663366942),
(179, '4f868f17f77054eb8c1147b9111cd018', 1663366986),
(180, '2e5670ed6714ec071400cc8e30361ab0', 1663367216),
(181, '7f90ce2f84131d0a9741a7a78b104971', 1663367479),
(182, '10486496ec453148b0f17afd76a7392e', 1663367480),
(183, 'd405b0345174ea2502b9b6d8ab0b13db', 1663368501),
(184, '63040531733c045f00a1810b5f527be7', 1663369271),
(185, '41f327a9f1a4fd07cba53cecacb2256b', 1663370805),
(186, '0fa93886559c34142e389a31cb724fb2', 1663371349),
(187, '47aec16eeadfb926112ff27c02d9b5b0', 1663371350),
(188, 'e7144bc2c3c52025b8cb38e844762fe7', 1663372838),
(189, 'd25b73430188e7902327c542b38aa1ba', 1663375807),
(190, 'f3d1e4f17b453bdbb87e033d337ef03d', 1663373998),
(191, '0a8a011ecb949071f19f9ae2b0721340', 1663374121),
(192, 'bfce5f41fd079616050a3541218b96c5', 1663374279),
(193, 'ffe9c1a8c856016a47502f7c030f4715', 1663374280),
(194, '24f6a23af5945ff6893e30084cf1bbc6', 1663374280),
(195, '337c9992279bdf446340a1d36702cd5d', 1663374280),
(196, '312c34384d1732681d72067203d2926c', 1663374282),
(197, '52ac34e2457bc3fad0db7ccef9363061', 1663374282),
(198, '331392f7d9c5deefa46a3d1c6fb31ca3', 1663374282),
(199, '6045985b1d5b19d9d188e51c4c96801e', 1663375672),
(200, 'df5f9b3dfb9b19d76a4a2c42d13409d0', 1663376121),
(201, 'f141f371d973c46d80f2467100ef9ac8', 1663377054),
(202, '1ffec6ff3b3f92a82fb93e42084a0f36', 1663377057),
(203, 'f718271e3813c9fef91c1d46dc7aa4fc', 1663379166),
(204, 'c929fc1c23c940c88c58ef8237d6a1ac', 1663379653),
(205, '49ab6c3b00c26a7bd77c122c4bda3f41', 1663382093),
(206, '81b8897d4f0ee4db873604699649aeb9', 1663382094),
(207, '0dfe43d525a5d0b3b9d899845cca73e0', 1663383386),
(208, 'c67d8b8263cd160f86fca3173a5aed43', 1663390623),
(209, '6db331895ac507c514e680a4f8f04c03', 1663390627),
(210, '659ab04244ef882286f2fd6ed873f9dc', 1663394961),
(211, '6e6cf7bc4839783ae36825cba2e88821', 1663394962),
(212, '100eaf31e441c669239a14f156c85854', 1663398319),
(213, 'fa84067dfa979550b96ae8e3fcdcc841', 1663401026),
(214, 'a81bf10299135f1c76416acd6feaf6b7', 1663401026),
(215, '5764f0813da4b78f85578f665d6d1156', 1663403399),
(216, 'ed34629e3cfa85d74cf7bb25260007a7', 1663403998),
(217, '90f9cc0a5308c55aa5c13eb5539dba08', 1663408255),
(218, '0f9ae4ca0c89d0f36513b1e2092c2c0b', 1663408255),
(219, 'a8293e05bc5bce095bae9d73b4d38a44', 1663408257),
(220, '99c83f53dfde11af37fc4229033fd449', 1663409429),
(221, '37466c08b965226299a0a5f6b4ef7502', 1663410913),
(222, '83ffafab304571399e09c131cd329bdc', 1663411932),
(223, 'eb61e379cbe673a7e014f9dd6f0a1b81', 1663411933),
(224, 'e4ff2c0a68291319562a6e84b8bc759b', 1663413017),
(225, '63223dada5e5459da7dfe74a17dce8cb', 1663421468),
(226, '55528405d27d94cc4f0b6cf42ea4bf87', 1663419268),
(227, 'a725a7aca78ca60b3f7446bf957fd072', 1663419270),
(228, 'e36c6c10fccffbcf056da866d7b889a2', 1663420237),
(229, '6b3485fa84c20776246099538db7a7f0', 1663421155),
(230, '4a1eb9e094d4c82d3608381df700f1ce', 1663421628),
(231, '6fcbebc439ea54375edbab945970b476', 1663422812),
(232, 'e82bb6f3e122bb97298a29b1b29588fe', 1663422818),
(233, '33a2e0d41d4b285e886dd7a9115277f5', 1663422939),
(234, '1d084ae2de08ff3fffc47c94bc03b883', 1663422940),
(235, '047f9cd7d600c84545536fbb5d47e17d', 1663423271),
(236, 'ef5ccc6b318b4b9b365c33725f08fe2f', 1663425179),
(237, 'dd0eb692507d412f88cbd08716590a13', 1663427260),
(238, '5a6615852ea0a7615bfa9dd6abc349fc', 1663427261),
(239, '5e1d0293097cf254bacaa897b9e0a159', 1663432701),
(240, '3d7d3a722835f2e94d4a2d74e00e17fe', 1663433287),
(241, 'd723c94a67e0ecf8639db7cfe5f41ae6', 1663428138),
(242, '0561d5f85c1818e51e18ef7880ab634d', 1663428693),
(243, '8d2a5edca7c4797123034ddb98875914', 1663431473),
(244, '73e838b834123c2d9d5b074dcaa24d8c', 1663431613),
(245, 'd23caeead3d29e9e29bb9eb3d96bacfd', 1663433056),
(246, '776945d85d26464b9ef208e25bebd041', 1663433238),
(247, '143212922b6a4bb63510dc1764cebee2', 1663433238),
(248, '602794e527b4cd19cbd46e9ee8d1ff13', 1663433583),
(249, '63db277b8c03e37d8c5e19b90c892c1f', 1663437327),
(250, '1f3c288c5f9077bdf34f9430ec340c27', 1663437742),
(251, '6fcc3b671eb5b16aed3cb23cb1eee389', 1663437743),
(252, 'fc4c9331f6a77c46ec58b25c00177ccd', 1663438050),
(253, '2571aff0dc9e713e81a52b175b97591e', 1663440888),
(254, '8a597a607ceb25eace28e7a236240680', 1663441015),
(255, '53f77bcfc428ce04acfa29781e0fb97d', 1663442228),
(256, '3911a8234f3df7615cf4ccbd4db55779', 1663442230),
(257, '70ce43d9c40d46939ab90a0c61045fc7', 1663446789),
(258, '1d1403ce60e0e7abdbfdc8f445745a96', 1663446790),
(259, 'b1e429e4a34d0612d927a5a2ac2bdf73', 1663459276),
(260, '0a3b19279a062a1948029f50169687b0', 1663464991),
(261, '13d89654b508f37eaddfb1c833dd6353', 1663464992),
(262, '840d539670427cbdb32ff6f80b3d1d8c', 1663533862),
(263, '6b0b102e327c766b5d1260712aa886b7', 1663533875),
(264, '22a17fefc36e85371666dc0575a0f81f', 1663535993),
(265, 'ld955che67mu3gf3nt1sopsnf0', 1664717010),
(266, 'hn60cm7flkkgadcuk65j9ed3d0', 1664796061),
(267, '8tdnp397raq78skodb3aa1q5jj', 1665055946),
(268, '8qeg194a4ddn7ri8fmtslro1bh', 1665574954),
(269, '72kodpp7c0h7sfogqph812hdgr', 1667130256),
(270, 'd3s9k8qkfvqk93r9dlhrtb3gkg', 1668432522),
(271, 'usqcddbanntg0c807reaa7levo', 1668438198),
(272, 'u18bmru60i4fed9b2bcvclbvg5', 1669211301),
(273, 'catem1kpi7nr6i0juqu9bd7mjg', 1669211334),
(274, '0th0ui9aihe2drma3rd1or0b60', 1669310171),
(275, 'm0dlrmctpk059knf8ctbf7l5gj', 1669310172),
(276, '7qqjgm5q0qagfnr7klbe8psfhg', 1669317688),
(277, 'k2ie9ksf7fgtfvene9imbjfu8o', 1669395500),
(278, 'gebk29813hj30u53hvun3g75bv', 1669845604),
(279, 'dcdv97ho9eui2blpbo0337cl69', 1669802980),
(280, '7k22rg26lgo7k2vs6ajihim811', 1669904434);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urun`
--

CREATE TABLE `urun` (
  `id` int(11) NOT NULL,
  `baslik` varchar(222) DEFAULT NULL,
  `spot` text DEFAULT NULL,
  `icerik` text DEFAULT NULL,
  `gorsel` text DEFAULT NULL,
  `tags` text DEFAULT NULL,
  `meta_desc` text DEFAULT NULL,
  `kat_id` varchar(22) DEFAULT NULL,
  `fiyat` decimal(22,4) DEFAULT NULL,
  `eski_fiyat` varchar(22) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `kdv` varchar(2) DEFAULT NULL,
  `kdv_oran` varchar(11) DEFAULT NULL,
  `kargo` varchar(2) DEFAULT NULL,
  `kargo_ucret` varchar(22) DEFAULT NULL,
  `star_rate` varchar(11) DEFAULT NULL,
  `hit` int(22) DEFAULT 0,
  `tarih` datetime DEFAULT NULL,
  `urun_kod` varchar(11) DEFAULT NULL,
  `durum` varchar(2) DEFAULT NULL,
  `dil` varchar(22) DEFAULT NULL,
  `ek_bilgi` text DEFAULT NULL,
  `embed` text DEFAULT NULL,
  `yorum_durum` varchar(11) DEFAULT NULL,
  `marka` varchar(222) DEFAULT NULL,
  `xml_no` varchar(22) DEFAULT '0',
  `xml_urun_id` varchar(22) DEFAULT NULL,
  `galeri_xml_durum` varchar(2) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `urun`
--

INSERT INTO `urun` (`id`, `baslik`, `spot`, `icerik`, `gorsel`, `tags`, `meta_desc`, `kat_id`, `fiyat`, `eski_fiyat`, `stok`, `kdv`, `kdv_oran`, `kargo`, `kargo_ucret`, `star_rate`, `hit`, `tarih`, `urun_kod`, `durum`, `dil`, `ek_bilgi`, `embed`, `yorum_durum`, `marka`, `xml_no`, `xml_urun_id`, `galeri_xml_durum`) VALUES
(388, 'FES4322 Kadın Kol Saati', 'Çelik / Quartz Teknoloji / 36 mm Kasa Çapı / Yuvarlak Kasa Şekli / Mineral Cam Özellik / 3 ATM Su Geçirmezlik\r\n', '<p class=\"mnm-g-info mb15\">Sitemizde bulunan t&uuml;m&nbsp;<strong>Fossil</strong>&nbsp;&Uuml;r&uuml;n Modelleri SAAT VE SAAT SANAYİ TİCARET A.Ş g&uuml;vencesi altındadır. Alacağınız bu &uuml;r&uuml;n 2 yıl garanti kapsamındadır. Siparişiniz orijinal kutusu ile anlaşmalı kargo firması (MNG Kargo) tarafından adresinize teslim edilecektir. Distrib&uuml;t&ouml;r&uuml; olduğumuz markalarımızın garanti belgesi dijital ortamda &uuml;retilip sms ve mail ile, yetkili satıcısı olduğumuz markalarımız onaylanmış garanti belgesi ile g&ouml;nderilmektedir.\"Aynı g&uuml;n Kargoda\" ibaresi yer alan &uuml;r&uuml;nler \"Hızlı Teslimat&rdquo; se&ccedil;eneği tercih edildiği takdirde g&uuml;n i&ccedil;inde teslim edilmektedir. Bu hizmetten 14:00\'a kadar faydalanabilirsiniz. Bunun dışındaki siparişleriniz ortalama 5 iş g&uuml;n&uuml; i&ccedil;erisinde kargo yetkilisine teslim edilecektir.</p>\r\n<div class=\"mnm-product-attr-groups\">\r\n<div class=\"col-md-2 col-sm-2 col-xs-2\">&nbsp;</div>\r\n</div>', '5212280937768-481-fes4322_1.jpg', '', '', '24', '2330.0000', '2999', 10, '0', '', '0', '', '1', 2, '2022-11-25 19:23:19', '2', '1', 'tr', '', '', '1', '0', '0', NULL, '0'),
(389, 'DZ1437 Kol Saati', 'Çelik / Quartz Teknoloji / 44 mm Kasa Çapı / Yuvarlak Kasa Şekli / Mineral Cam Özellik / 5 ATM Su Geçirmezlik\r\n', '<p class=\"mnm-g-info mb15\">Sitemizde bulunan t&uuml;m&nbsp;<strong>Diesel</strong>&nbsp;&Uuml;r&uuml;n Modelleri SAAT VE SAAT SANAYİ TİCARET A.Ş g&uuml;vencesi altındadır. Alacağınız bu &uuml;r&uuml;n 2 yıl garanti kapsamındadır. Siparişiniz orijinal kutusu ile anlaşmalı kargo firması (MNG Kargo) tarafından adresinize teslim edilecektir. Distrib&uuml;t&ouml;r&uuml; olduğumuz markalarımızın garanti belgesi dijital ortamda &uuml;retilip sms ve mail ile, yetkili satıcısı olduğumuz markalarımız onaylanmış garanti belgesi ile g&ouml;nderilmektedir.\"Aynı g&uuml;n Kargoda\" ibaresi yer alan &uuml;r&uuml;nler \"Hızlı Teslimat&rdquo; se&ccedil;eneği tercih edildiği takdirde g&uuml;n i&ccedil;inde teslim edilmektedir. Bu hizmetten 14:00\'a kadar faydalanabilirsiniz. Bunun dışındaki siparişleriniz ortalama 5 iş g&uuml;n&uuml; i&ccedil;erisinde kargo yetkilisine teslim edilecektir.</p>\r\n<div class=\"mnm-product-attr-groups\">\r\n<div class=\"col-md-2 col-sm-2 col-xs-2\">&nbsp;</div>\r\n</div>', '3294369425564-482-dz1437_1_2 (1).jpg', '', '', '25', '1588.0000', '2000', 10, '0', '', '0', '', '1', 18, '2022-11-25 19:26:20', '3', '1', 'tr', '', '', '1', 'Diesel', '0', NULL, '0'),
(390, 'DZ1819 Kol Saati', 'Silikon / Quartz Teknoloji / 45 mm Kasa Çapı / Yuvarlak Kasa Şekli / Mineral Cam Özellik / 10 ATM Su Geçirmezlik\r\n', '<p class=\"mnm-g-info mb15\">Sitemizde bulunan t&uuml;m&nbsp;<strong>Diesel</strong>&nbsp;&Uuml;r&uuml;n Modelleri SAAT VE SAAT SANAYİ TİCARET A.Ş g&uuml;vencesi altındadır. Alacağınız bu &uuml;r&uuml;n 2 yıl garanti kapsamındadır. Siparişiniz orijinal kutusu ile anlaşmalı kargo firması (MNG Kargo) tarafından adresinize teslim edilecektir. Distrib&uuml;t&ouml;r&uuml; olduğumuz markalarımızın garanti belgesi dijital ortamda &uuml;retilip sms ve mail ile, yetkili satıcısı olduğumuz markalarımız onaylanmış garanti belgesi ile g&ouml;nderilmektedir.\"Aynı g&uuml;n Kargoda\" ibaresi yer alan &uuml;r&uuml;nler \"Hızlı Teslimat&rdquo; se&ccedil;eneği tercih edildiği takdirde g&uuml;n i&ccedil;inde teslim edilmektedir. Bu hizmetten 14:00\'a kadar faydalanabilirsiniz. Bunun dışındaki siparişleriniz ortalama 5 iş g&uuml;n&uuml; i&ccedil;erisinde kargo yetkilisine teslim edilecektir.</p>\r\n<div class=\"mnm-product-attr-groups\">\r\n<div class=\"col-md-2 col-sm-2 col-xs-2\">&nbsp;</div>\r\n</div>', '5779386871696-300-dz1819_1.jpg', '', '', '24', '993.0000', '1250', 10, '0', '', '0', '', '5', 48, '2022-11-30 14:20:03', '1', '1', 'tr', '', '', '0', 'Diesel', '0', NULL, '0');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urunmodul_ayar`
--

CREATE TABLE `urunmodul_ayar` (
  `id` int(11) NOT NULL,
  `divider` varchar(22) NOT NULL,
  `back_color` varchar(22) NOT NULL,
  `padding` varchar(22) NOT NULL,
  `font_weight` varchar(22) NOT NULL,
  `tab_font_size` varchar(22) NOT NULL,
  `tab_back_color` varchar(22) NOT NULL,
  `tab_text_color` varchar(22) NOT NULL,
  `tab_border_color` varchar(22) NOT NULL,
  `tab_border_radius` varchar(22) NOT NULL,
  `tab_act_text_color` varchar(22) NOT NULL,
  `tab_limit` varchar(2) NOT NULL,
  `tab_urun_limit` varchar(22) NOT NULL,
  `spot_color` varchar(22) NOT NULL,
  `baslik_color` varchar(22) NOT NULL,
  `width` varchar(22) NOT NULL,
  `star_rate` varchar(2) NOT NULL,
  `incele_button_back` varchar(22) NOT NULL,
  `incele_button_color` varchar(22) NOT NULL,
  `populer` varchar(2) NOT NULL,
  `yeni` varchar(2) NOT NULL,
  `urun_grup` varchar(2) NOT NULL,
  `urun_grup_back` varchar(22) NOT NULL,
  `urun_grup_textcolor` varchar(22) NOT NULL,
  `urun_grup_incele_back` varchar(22) NOT NULL,
  `urun_grup_incelecolor` varchar(22) NOT NULL,
  `urun_grup_border` varchar(22) NOT NULL,
  `urun_grup_limit` varchar(2) NOT NULL,
  `tags` text NOT NULL,
  `meta_desc` text NOT NULL,
  `detay_altmenu_tip` varchar(2) NOT NULL,
  `detay_altmenu_bg` varchar(22) DEFAULT NULL,
  `detay_altmenu_hover` varchar(22) DEFAULT NULL,
  `detay_altmenu_border` varchar(22) DEFAULT NULL,
  `detay_altmenu_textcolor` varchar(22) DEFAULT NULL,
  `detay_altmenu_hovertextcolor` varchar(22) DEFAULT NULL,
  `detay_altmenu_megaborder` varchar(22) NOT NULL,
  `detay_altmenu_megashadow` varchar(22) NOT NULL,
  `detay_etiket` varchar(2) NOT NULL,
  `detay_benzer_urun` varchar(2) NOT NULL,
  `detay_arama` varchar(2) NOT NULL,
  `detay_populer` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `urunmodul_ayar`
--

INSERT INTO `urunmodul_ayar` (`id`, `divider`, `back_color`, `padding`, `font_weight`, `tab_font_size`, `tab_back_color`, `tab_text_color`, `tab_border_color`, `tab_border_radius`, `tab_act_text_color`, `tab_limit`, `tab_urun_limit`, `spot_color`, `baslik_color`, `width`, `star_rate`, `incele_button_back`, `incele_button_color`, `populer`, `yeni`, `urun_grup`, `urun_grup_back`, `urun_grup_textcolor`, `urun_grup_incele_back`, `urun_grup_incelecolor`, `urun_grup_border`, `urun_grup_limit`, `tags`, `meta_desc`, `detay_altmenu_tip`, `detay_altmenu_bg`, `detay_altmenu_hover`, `detay_altmenu_border`, `detay_altmenu_textcolor`, `detay_altmenu_hovertextcolor`, `detay_altmenu_megaborder`, `detay_altmenu_megashadow`, `detay_etiket`, `detay_benzer_urun`, `detay_arama`, `detay_populer`) VALUES
(1, 'divider', 'FFFFFF', '85', 'medium', '16px', '000000', '000000', '000000', '0', 'FFFFFF', '3', '15', '666666', '000000', '0', '1', 'DB0000', 'FFFFFF', '1', '1', '1', 'FFFFFF', '000000', '5331CC', 'FFFFFF', 'FFFFFF', '12', 'En yeni ürünler,ticaret paketleri,vivakurumsal,viva agency', 'Ürünler', '1', 'FFFFFF', 'F8F8F8', 'EBEBEB', '333333', '000000', '292929', '1', '1', '1', '1', '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urun_cat`
--

CREATE TABLE `urun_cat` (
  `id` int(11) NOT NULL,
  `baslik` varchar(222) DEFAULT NULL,
  `gorsel` text DEFAULT NULL,
  `icon` varchar(222) DEFAULT NULL,
  `dil` varchar(22) DEFAULT NULL,
  `tags` text DEFAULT NULL,
  `meta_desc` text DEFAULT NULL,
  `ust_id` varchar(22) DEFAULT NULL,
  `anasayfa` varchar(2) DEFAULT NULL,
  `anasayfa_grup` varchar(2) DEFAULT NULL,
  `grup_sira` int(11) DEFAULT NULL,
  `sira` int(11) DEFAULT NULL,
  `durum` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `urun_cat`
--

INSERT INTO `urun_cat` (`id`, `baslik`, `gorsel`, `icon`, `dil`, `tags`, `meta_desc`, `ust_id`, `anasayfa`, `anasayfa_grup`, `grup_sira`, `sira`, `durum`) VALUES
(23, 'Saat', NULL, 'fa-500px', 'tr', '', '', '0', '1', '0', NULL, 1, '1'),
(24, 'Kadın Saat', '5060588449322-157-kadın saat.jpg', '', 'tr', '', '', '23', '0', '0', NULL, 2, '1'),
(25, 'Erkek Saat', '8372200876751-147-erkek-saat-bileklik-kombini-3lu-set--15e8-.jpg', '', 'tr', '', '', '23', '0', '0', NULL, 3, '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urun_galeri`
--

CREATE TABLE `urun_galeri` (
  `id` int(11) NOT NULL,
  `gorsel` text DEFAULT NULL,
  `urun_id` varchar(22) DEFAULT NULL,
  `sira` int(11) DEFAULT NULL,
  `xml_urun_id` varchar(22) DEFAULT '0',
  `xml_no` varchar(22) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `urun_galeri`
--

INSERT INTO `urun_galeri` (`id`, `gorsel`, `urun_id`, `sira`, `xml_urun_id`, `xml_no`) VALUES
(1, 'urun.jpg', '12', 2, '0', '0'),
(2, '3.jpg', '12', 1, '0', '0'),
(3, '4.jpg', '12', 3, '0', '0'),
(4, 'urun2.jpg', '12', 4, '0', '0'),
(5, '3.jpg', '12', 5, '0', '0'),
(37, '017415652410232366727218.jpg', '23', 2, '0', '0'),
(38, '16591117510232366825522.jpg', '23', 1, '0', '0'),
(39, '081827466422699526429351986.jpg', '24', 4, '0', '0'),
(40, '17918072165929526429515826.jpg', '24', 1, '0', '0'),
(41, '014948663301760007163_apple-watch-sport-space-grey-smart-watch-with-black-sport-band-refurbished.jpeg', '24', 2, '0', '0'),
(42, '19969559693709images.jfif', '24', 3, '0', '0'),
(43, '0200840144418110232366694450.jpg', '25', 0, '0', '0'),
(44, '1195069163572010232366727218.jpg', '25', 1, '0', '0'),
(45, '2691619701217810232366825522.jpg', '25', 2, '0', '0'),
(46, '0427654698956710107307655218.jpg', '26', 0, '0', '0'),
(47, '1623763056937610107307687986.jpg', '26', 1, '0', '0'),
(48, '2173658374231310107307720754.jpg', '26', 2, '0', '0'),
(49, '3619837681297210107307753522.jpg', '26', 3, '0', '0'),
(50, '0233490320388210169043386418.jpg', '27', 0, '0', '0'),
(51, '1664127310737910211469000754.jpg', '27', 1, '0', '0'),
(52, '2606819199863810229592129586.jpg', '27', 2, '0', '0'),
(53, '0317770268302410147897540658.jpg', '28', 0, '0', '0'),
(54, '1499446577858110147897573426.jpg', '28', 1, '0', '0'),
(55, '080466507468379977992118322.jpg', '29', 0, '0', '0'),
(56, '133005221700299977992151090.jpg', '29', 1, '0', '0'),
(57, '249646902782849977992216626.jpg', '29', 2, '0', '0'),
(58, '06692588357254v2-92938-1_medium.jpg', '30', 0, '0', '0'),
(59, '14864252381958v2-92938-2_medium.jpg', '30', 1, '0', '0'),
(60, '05576289277523v2-91794-5_medium.jpg', '31', 0, '0', '0'),
(61, '1697823371738v2-91794-6_medium.jpg', '31', 1, '0', '0'),
(62, '26565144648775v2-92527-2_medium.jpg', '31', 2, '0', '0'),
(63, '32590100183151v2-92527-3_medium.jpg', '31', 3, '0', '0'),
(64, '08209195872768v2-87994-1_medium.jfif', '32', 0, '0', '0'),
(65, '0163811076898110185916153906.jpg', '33', 2, '0', '0'),
(66, '151448798738410185916186674.jpg', '33', 3, '0', '0'),
(67, '2627483388874610185916219442.jpg', '33', 1, '0', '0'),
(69, '1248936336021810169530449970.jpg', '34', 2, '0', '0'),
(70, '273326202575110169530515506.jpg', '34', 3, '0', '0'),
(71, '079375325236469804638584882.jpg', '35', 1, '0', '0'),
(72, '186904102470729804638650418.jpg', '35', 3, '0', '0'),
(73, '240929949330169804638715954.jpg', '35', 2, '0', '0');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urun_marka`
--

CREATE TABLE `urun_marka` (
  `id` int(11) NOT NULL,
  `baslik` varchar(22) DEFAULT NULL,
  `gorsel` text DEFAULT NULL,
  `sira` int(211) DEFAULT NULL,
  `durum` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `urun_marka`
--

INSERT INTO `urun_marka` (`id`, `baslik`, `gorsel`, `sira`, `durum`) VALUES
(9, 'Diesel', NULL, 1, '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `urun_yorum`
--

CREATE TABLE `urun_yorum` (
  `id` int(11) NOT NULL,
  `urun_id` varchar(222) DEFAULT NULL,
  `baslik` varchar(222) DEFAULT NULL,
  `isim` varchar(222) DEFAULT NULL,
  `soyisim` varchar(222) DEFAULT NULL,
  `yildiz` varchar(2) DEFAULT NULL,
  `yorum` text DEFAULT NULL,
  `gizli` varchar(2) DEFAULT NULL,
  `tarih` timestamp NULL DEFAULT NULL,
  `onay` varchar(2) DEFAULT NULL,
  `uye_id` varchar(22) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `uyeler`
--

CREATE TABLE `uyeler` (
  `id` int(11) NOT NULL,
  `isim` varchar(255) DEFAULT NULL,
  `soyisim` varchar(255) DEFAULT NULL,
  `telefon` varchar(255) DEFAULT NULL,
  `eposta` varchar(255) DEFAULT NULL,
  `tcno` varchar(255) DEFAULT NULL,
  `cinsiyet` varchar(255) DEFAULT NULL,
  `uyesifre` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `tarih` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `uyeler`
--

INSERT INTO `uyeler` (`id`, `isim`, `soyisim`, `telefon`, `eposta`, `tcno`, `cinsiyet`, `uyesifre`, `ip`, `tarih`) VALUES
(3, 'alperen2', 'yıldırım2', '05532000228', 'alperenyld@gmail.com', '', 'Erkek', '52ffd76bc4b9f566351d7966454b74e9', '2001:67c:198c:906:17::3ba, 141.101.77.41', '2022-11-14 03:01:26');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `uyeler_adres`
--

CREATE TABLE `uyeler_adres` (
  `id` int(11) NOT NULL,
  `baslik` varchar(255) DEFAULT NULL,
  `sehir` varchar(255) DEFAULT NULL,
  `ilce` varchar(255) DEFAULT NULL,
  `posta_kodu` varchar(255) DEFAULT NULL,
  `adres` text DEFAULT NULL,
  `fatura_adres` text DEFAULT NULL,
  `uye_id` varchar(11) DEFAULT NULL,
  `adres_id` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Tablo döküm verisi `uyeler_adres`
--

INSERT INTO `uyeler_adres` (`id`, `baslik`, `sehir`, `ilce`, `posta_kodu`, `adres`, `fatura_adres`, `uye_id`, `adres_id`) VALUES
(2, 'ev', 'Adana', 'asd', 'asd', 'sadasd', 'asd', '2', '57221190');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `uyeler_ayar`
--

CREATE TABLE `uyeler_ayar` (
  `id` int(11) NOT NULL,
  `durum` varchar(2) NOT NULL,
  `sms_ekle` varchar(2) NOT NULL,
  `eposta_ekle` varchar(2) NOT NULL,
  `adres_alani` varchar(2) DEFAULT NULL,
  `destek_alani` varchar(2) DEFAULT NULL,
  `siparisler_alani` varchar(2) DEFAULT NULL,
  `yorumlar_alani` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `uyeler_ayar`
--

INSERT INTO `uyeler_ayar` (`id`, `durum`, `sms_ekle`, `eposta_ekle`, `adres_alani`, `destek_alani`, `siparisler_alani`, `yorumlar_alani`) VALUES
(1, '1', '1', '1', '1', '1', '1', '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `uyeler_destek`
--

CREATE TABLE `uyeler_destek` (
  `id` int(11) NOT NULL,
  `user_id` varchar(22) DEFAULT NULL,
  `support_id` varchar(11) DEFAULT NULL,
  `durum` varchar(2) DEFAULT NULL,
  `tarih` timestamp NULL DEFAULT NULL,
  `konu` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `uyeler_destek`
--

INSERT INTO `uyeler_destek` (`id`, `user_id`, `support_id`, `durum`, `tarih`, `konu`) VALUES
(2, '3', '75610306', '0', '2022-09-14 03:02:06', 'deneme destek mesajı');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `uyeler_destek_mesaj`
--

CREATE TABLE `uyeler_destek_mesaj` (
  `id` int(11) NOT NULL,
  `mesaj` text DEFAULT NULL,
  `tarih` timestamp NULL DEFAULT NULL,
  `support_id` varchar(25) DEFAULT NULL,
  `tip` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `uyeler_destek_mesaj`
--

INSERT INTO `uyeler_destek_mesaj` (`id`, `mesaj`, `tarih`, `support_id`, `tip`) VALUES
(3, 'deneme destek mesajı içeriği', '2022-11-14 03:02:06', '75610306', '1'),
(4, 'sonuc basarılı', '2022-11-14 08:39:06', '75610306', '0');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `uyeler_sozlesme`
--

CREATE TABLE `uyeler_sozlesme` (
  `id` int(11) NOT NULL,
  `icerik` text DEFAULT NULL,
  `dil` varchar(11) DEFAULT NULL,
  `durum` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `uyeler_sozlesme`
--

INSERT INTO `uyeler_sozlesme` (`id`, `icerik`, `dil`, `durum`) VALUES
(4, '<div>Deneme Sözleşme Düzenlenececek<div> <br><div>Deneme Sözleşme Düzenlenececek<div> <br><div>Deneme Sözleşme Düzenlenececek<div> <br><div>Deneme Sözleşme Düzenlenececek<div> <br><div>Deneme Sözleşme Düzenlenececek<div> <br><div>Deneme Sözleşme Düzenlenececek<div> <br><div>Deneme Sözleşme Düzenlenececek<div> <br><div>Deneme Sözleşme Düzenlenececek<div> <br><div>Deneme Sözleşme Düzenlenececek<div> <br><div>Deneme Sözleşme Düzenlenececek<div> <br><div>Deneme Sözleşme Düzenlenececek<div> <br><div>Deneme Sözleşme Düzenlenececek<div> <br><div>Deneme Sözleşme Düzenlenececek<div> <br><div>Deneme Sözleşme Düzenlenececek<div> <br><div>Deneme Sözleşme Düzenlenececek<div> <br><div>Deneme Sözleşme Düzenlenececek<div> <br><div>Deneme Sözleşme Düzenlenececek<div> <br><div>Deneme Sözleşme Düzenlenececek<div> <br><div>Deneme Sözleşme Düzenlenececek<div> <br><div>Deneme Sözleşme Düzenlenececek<div> <br><div>Deneme Sözleşme Düzenlenececek<div> <br><div>Deneme Sözleşme Düzenlenececek<div> <br>', 'tr', '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `varyant`
--

CREATE TABLE `varyant` (
  `id` int(11) NOT NULL,
  `baslik` varchar(222) DEFAULT NULL,
  `tur` varchar(2) DEFAULT NULL,
  `urun_id` varchar(222) DEFAULT NULL,
  `sira` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `varyant`
--

INSERT INTO `varyant` (`id`, `baslik`, `tur`, `urun_id`, `sira`) VALUES
(4, 'RENK', '0', '12', 1),
(7, 'BEDEN', '0', '23', 2),
(8, 'RENK SEÇİMİ', '0', '25', 1),
(9, 'RENK SEÇİMİ', '0', '27', 1),
(10, 'BEDEN', '0', '27', 2),
(11, 'RENK SEÇİMİ', '0', '31', 1),
(15, 'RENK', '0', '35', 1),
(16, 'Kapasite', '0', '32', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `varyant_oz`
--

CREATE TABLE `varyant_oz` (
  `id` int(11) NOT NULL,
  `ozellik` text DEFAULT NULL,
  `varyant_id` varchar(222) DEFAULT NULL,
  `sira` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `varyant_oz`
--

INSERT INTO `varyant_oz` (`id`, `ozellik`, `varyant_id`, `sira`) VALUES
(10, 'Space Gray', '4', 1),
(11, 'Black', '4', 2),
(16, 'S', '7', 1),
(17, 'M', '7', 2),
(18, 'XL', '7', 3),
(19, 'Siyah', '8', 1),
(20, 'Beyaz', '8', 2),
(21, 'Kırmızı', '9', 1),
(22, 'Mavi', '9', 2),
(23, 'Beyaz', '9', 3),
(24, 'Yeşil', '9', 4),
(25, 'S', '10', 1),
(26, 'M', '10', 2),
(27, 'L', '10', 3),
(28, 'XL', '10', 4),
(29, 'Gümüş', '11', 1),
(30, 'Altın', '11', 2),
(35, 'Gümüş', '15', 1),
(36, 'Siyah', '15', 2),
(37, '64GB', '16', 1),
(38, '128GB', '16', 2);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yonetici`
--

CREATE TABLE `yonetici` (
  `id` int(11) NOT NULL,
  `user_adi` varchar(222) DEFAULT NULL,
  `pass_sifre` varchar(222) DEFAULT NULL,
  `isim` varchar(222) DEFAULT NULL,
  `foto` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `yonetici`
--

INSERT INTO `yonetici` (`id`, `user_adi`, `pass_sifre`, `isim`, `foto`) VALUES
(3, 'alperen', 'e10adc3949ba59abbe56e057f20f883e', 'Alperen Yıldırım', NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yorum`
--

CREATE TABLE `yorum` (
  `id` int(11) NOT NULL,
  `isim` varchar(222) DEFAULT NULL,
  `icerik` text DEFAULT NULL,
  `tarih` datetime DEFAULT NULL,
  `gorsel` text DEFAULT NULL,
  `star_rate` varchar(2) DEFAULT NULL,
  `pozisyon` varchar(222) DEFAULT NULL,
  `sira` int(11) DEFAULT NULL,
  `dil` varchar(22) DEFAULT NULL,
  `durum` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `yorum`
--

INSERT INTO `yorum` (`id`, `isim`, `icerik`, `tarih`, `gorsel`, `star_rate`, `pozisyon`, `sira`, `dil`, `durum`) VALUES
(12, 'Ahmet Can', 'Her zaman çalışıyoruz, sorunsuz.', '2022-12-01 11:04:24', 'no-image', '5', 'Yönetici', 1, 'tr', '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yorum_ayar`
--

CREATE TABLE `yorum_ayar` (
  `id` int(11) NOT NULL,
  `back_color` varchar(22) DEFAULT NULL,
  `width` varchar(2) DEFAULT NULL,
  `padding` varchar(22) DEFAULT NULL,
  `divider` varchar(22) DEFAULT NULL,
  `baslik_color` varchar(22) DEFAULT NULL,
  `spot_color` varchar(22) DEFAULT NULL,
  `font_weight` varchar(22) DEFAULT NULL,
  `yorum_limit` varchar(22) DEFAULT NULL,
  `star_color` varchar(22) DEFAULT NULL,
  `box_isim_color` varchar(22) DEFAULT NULL,
  `box_pozisyon_color` varchar(22) DEFAULT NULL,
  `box_icerik_color` varchar(22) DEFAULT NULL,
  `meta_desc` text DEFAULT NULL,
  `tags` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `yorum_ayar`
--

INSERT INTO `yorum_ayar` (`id`, `back_color`, `width`, `padding`, `divider`, `baslik_color`, `spot_color`, `font_weight`, `yorum_limit`, `star_color`, `box_isim_color`, `box_pozisyon_color`, `box_icerik_color`, `meta_desc`, `tags`) VALUES
(1, 'F8F8F8', '0', '10', 'divider', 'EE293C', '666666', 'bold', '6', 'FF9600', 'EE293C', '666666', '000000', '2', '1');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `about_ayar`
--
ALTER TABLE `about_ayar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `about_page`
--
ALTER TABLE `about_page`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `ayarlar`
--
ALTER TABLE `ayarlar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `banka`
--
ALTER TABLE `banka`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `blog_ayar`
--
ALTER TABLE `blog_ayar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `cerez_ayar`
--
ALTER TABLE `cerez_ayar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `dil`
--
ALTER TABLE `dil`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `footer_ayar`
--
ALTER TABLE `footer_ayar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `footer_menu`
--
ALTER TABLE `footer_menu`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `header_ayar`
--
ALTER TABLE `header_ayar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `header_menu`
--
ALTER TABLE `header_menu`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `hit`
--
ALTER TABLE `hit`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `htmlsayfa`
--
ALTER TABLE `htmlsayfa`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `insan_kaynaklari`
--
ALTER TABLE `insan_kaynaklari`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `kargo`
--
ALTER TABLE `kargo`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `marka`
--
ALTER TABLE `marka`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `marka_ayar`
--
ALTER TABLE `marka_ayar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `mesaj`
--
ALTER TABLE `mesaj`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `moduller`
--
ALTER TABLE `moduller`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `odeme_ayar`
--
ALTER TABLE `odeme_ayar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `page_header`
--
ALTER TABLE `page_header`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `paywant_user`
--
ALTER TABLE `paywant_user`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `sabit_header`
--
ALTER TABLE `sabit_header`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `sayac`
--
ALTER TABLE `sayac`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `sayac_ayar`
--
ALTER TABLE `sayac_ayar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `siparis`
--
ALTER TABLE `siparis`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `siparis_urunler`
--
ALTER TABLE `siparis_urunler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `sitemap`
--
ALTER TABLE `sitemap`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `sitemap_ayar`
--
ALTER TABLE `sitemap_ayar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `slider_ayar`
--
ALTER TABLE `slider_ayar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `sosyal`
--
ALTER TABLE `sosyal`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `sozlesme`
--
ALTER TABLE `sozlesme`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `sss`
--
ALTER TABLE `sss`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `sss_ayar`
--
ALTER TABLE `sss_ayar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `ticaret_bilgi`
--
ALTER TABLE `ticaret_bilgi`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `total_visitors`
--
ALTER TABLE `total_visitors`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `urun`
--
ALTER TABLE `urun`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `urunmodul_ayar`
--
ALTER TABLE `urunmodul_ayar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `urun_cat`
--
ALTER TABLE `urun_cat`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `urun_galeri`
--
ALTER TABLE `urun_galeri`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `urun_marka`
--
ALTER TABLE `urun_marka`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `urun_yorum`
--
ALTER TABLE `urun_yorum`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `uyeler`
--
ALTER TABLE `uyeler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `uyeler_adres`
--
ALTER TABLE `uyeler_adres`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `uyeler_ayar`
--
ALTER TABLE `uyeler_ayar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `uyeler_destek`
--
ALTER TABLE `uyeler_destek`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `uyeler_destek_mesaj`
--
ALTER TABLE `uyeler_destek_mesaj`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `uyeler_sozlesme`
--
ALTER TABLE `uyeler_sozlesme`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `varyant`
--
ALTER TABLE `varyant`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `varyant_oz`
--
ALTER TABLE `varyant_oz`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `yonetici`
--
ALTER TABLE `yonetici`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `yorum`
--
ALTER TABLE `yorum`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `yorum_ayar`
--
ALTER TABLE `yorum_ayar`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `about_ayar`
--
ALTER TABLE `about_ayar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `about_page`
--
ALTER TABLE `about_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `ayarlar`
--
ALTER TABLE `ayarlar`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `banka`
--
ALTER TABLE `banka`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Tablo için AUTO_INCREMENT değeri `blog_ayar`
--
ALTER TABLE `blog_ayar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `cerez_ayar`
--
ALTER TABLE `cerez_ayar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `dil`
--
ALTER TABLE `dil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- Tablo için AUTO_INCREMENT değeri `footer_ayar`
--
ALTER TABLE `footer_ayar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `footer_menu`
--
ALTER TABLE `footer_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Tablo için AUTO_INCREMENT değeri `header_ayar`
--
ALTER TABLE `header_ayar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `header_menu`
--
ALTER TABLE `header_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Tablo için AUTO_INCREMENT değeri `hit`
--
ALTER TABLE `hit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- Tablo için AUTO_INCREMENT değeri `htmlsayfa`
--
ALTER TABLE `htmlsayfa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `insan_kaynaklari`
--
ALTER TABLE `insan_kaynaklari`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `kargo`
--
ALTER TABLE `kargo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `marka`
--
ALTER TABLE `marka`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Tablo için AUTO_INCREMENT değeri `marka_ayar`
--
ALTER TABLE `marka_ayar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `mesaj`
--
ALTER TABLE `mesaj`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `moduller`
--
ALTER TABLE `moduller`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Tablo için AUTO_INCREMENT değeri `odeme_ayar`
--
ALTER TABLE `odeme_ayar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `page_header`
--
ALTER TABLE `page_header`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Tablo için AUTO_INCREMENT değeri `paywant_user`
--
ALTER TABLE `paywant_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `sabit_header`
--
ALTER TABLE `sabit_header`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `sayac`
--
ALTER TABLE `sayac`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `sayac_ayar`
--
ALTER TABLE `sayac_ayar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `siparis`
--
ALTER TABLE `siparis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `siparis_urunler`
--
ALTER TABLE `siparis_urunler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `sitemap`
--
ALTER TABLE `sitemap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Tablo için AUTO_INCREMENT değeri `sitemap_ayar`
--
ALTER TABLE `sitemap_ayar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Tablo için AUTO_INCREMENT değeri `slider_ayar`
--
ALTER TABLE `slider_ayar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `sosyal`
--
ALTER TABLE `sosyal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `sozlesme`
--
ALTER TABLE `sozlesme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Tablo için AUTO_INCREMENT değeri `sss`
--
ALTER TABLE `sss`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `sss_ayar`
--
ALTER TABLE `sss_ayar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `ticaret_bilgi`
--
ALTER TABLE `ticaret_bilgi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `total_visitors`
--
ALTER TABLE `total_visitors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=281;

--
-- Tablo için AUTO_INCREMENT değeri `urun`
--
ALTER TABLE `urun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=391;

--
-- Tablo için AUTO_INCREMENT değeri `urunmodul_ayar`
--
ALTER TABLE `urunmodul_ayar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `urun_cat`
--
ALTER TABLE `urun_cat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Tablo için AUTO_INCREMENT değeri `urun_galeri`
--
ALTER TABLE `urun_galeri`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- Tablo için AUTO_INCREMENT değeri `urun_marka`
--
ALTER TABLE `urun_marka`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Tablo için AUTO_INCREMENT değeri `urun_yorum`
--
ALTER TABLE `urun_yorum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `uyeler`
--
ALTER TABLE `uyeler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `uyeler_adres`
--
ALTER TABLE `uyeler_adres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `uyeler_ayar`
--
ALTER TABLE `uyeler_ayar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `uyeler_destek`
--
ALTER TABLE `uyeler_destek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `uyeler_destek_mesaj`
--
ALTER TABLE `uyeler_destek_mesaj`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `uyeler_sozlesme`
--
ALTER TABLE `uyeler_sozlesme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `varyant`
--
ALTER TABLE `varyant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Tablo için AUTO_INCREMENT değeri `varyant_oz`
--
ALTER TABLE `varyant_oz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Tablo için AUTO_INCREMENT değeri `yonetici`
--
ALTER TABLE `yonetici`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `yorum`
--
ALTER TABLE `yorum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Tablo için AUTO_INCREMENT değeri `yorum_ayar`
--
ALTER TABLE `yorum_ayar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
