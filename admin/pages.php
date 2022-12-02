<?php include 'support/session.php'; ?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">


    <?php include 'support/panel_header_libs.php'?>


</head>

<body class="skin-default fixed-layout">


<div id="main-wrapper">

    <?php include "support/panel_parts/panel_topbar.php";?>

    <?php include "support/panel_parts/panel_leftbar.php";?>

    <div class="page-wrapper">

        <div class="container-fluid">

            <?php
            if(isset($_GET['sayfa'])){
                $s = $_GET['sayfa'];
                switch($s){

                    case 'siteayar';
                        require_once("support/_edit/ayar-site.php");
                        break;

                    case 'temaayar';
                        require_once("support/_edit/ayar-tema.php");
                        break;

                    case 'loaderayar';
                        require_once("support/_edit/ayar-loader.php");
                        break;

                    case 'smtpayar';
                        require_once("support/_edit/ayar-smtp.php");
                        break;


                    case 'smsayar';
                        require_once("support/_edit/ayar-sms.php");
                        break;

                    case 'iletisimayar';
                        require_once("support/_edit/ayar-iletisim.php");
                        break;

                    case 'kodekle';
                        require_once("support/_edit/ayar-kod.php");
                        break;

                    case 'ticariayar';
                        require_once("support/_edit/ticaret-ayar.php");
                        break;

                    case 'posayar';
                        require_once("support/_edit/ticaret-pos.php");
                        break;

                    case 'bilgikutulari';
                        require_once("support/_pages/bilgi-kutulari.php");
                        break;

                    case 'kutu';
                        require_once("support/_edit/ticaret-bilgi-kutu.php");
                        break;

                    case 'satissozlesmesi';
                        require_once("support/_pages/satis-sozlesmesi.php");
                        break;

                    case 'sozlesmeekle';
                        require_once("support/_add/satis-sozlesmesi.php");
                        break;

                    case 'sozlesme';
                        require_once("support/_edit/satis-sozlesmesi.php");
                        break;




                    case 'diller';
                        require_once("support/_pages/diller.php");
                        break;

                    case 'dilekle';
                        require_once("support/_add/diller.php");
                        break;

                    case 'dil';
                        require_once("support/_edit/diller.php");
                        break;





                    case 'sessiondestroy';
                        require_once("support/session_destroy.php");
                        break;




                    case 'mesajlar';
                        require_once("support/_pages/mesajlar.php");
                        break;


                    case 'mesaj';
                        require_once("support/_pages/mesajoku.php");
                        break;





                    case 'headermenuayar';
                        require_once("support/_edit/header-menu-ayar.php");
                        break;

                    case 'headermenu';
                        require_once("support/_pages/header-menu.php");
                        break;

                    case 'headermenuekle';
                        require_once("support/_add/header-menu.php");
                        break;

                    case 'headmenu';
                        require_once("support/_edit/header-menu.php");
                        break;



                    case 'footermenuayar';
                        require_once("support/_edit/footer-menu-ayar.php");
                        break;

                    case 'footermenu';
                        require_once("support/_pages/footer-menu.php");
                        break;

                    case 'footermenuekle';
                        require_once("support/_add/footer-menu.php");
                        break;

                    case 'footmenu';
                        require_once("support/_edit/footer-menu.php");
                        break;



                    case 'modulsiralama';
                        require_once("support/_pages/modul-siralama.php");
                        break;

                    case 'modulekle';
                        require_once("support/_add/modul-ekle.php");
                        break;

                    case 'modul';
                        require_once("support/_edit/modul-duzenle.php");
                        break;



                    case 'pageheaders';
                        require_once("support/_pages/page-headers.php");
                        break;

                    case 'pagehead';
                        require_once("support/_edit/page-headers.php");
                        break;

                    case 'banner';
                        require_once("support/_edit/banner-duzenle.php");
                        break;




                    case 'ebultenlistesi';
                        require_once("support/_pages/ebulten-liste.php");
                        break;

                    case 'ebultengonder';
                        require_once("support/_add/ebulten-gonder.php");
                        break;

                    case 'tekilmailgonder';
                        require_once("support/_add/ebulten-tekil-gonder.php");
                        break;

                    case 'ebultenayar';
                        require_once("support/_edit/ebulten-ayar.php");
                        break;





                    case 'smsnumaralar';
                        require_once("support/_pages/sms-liste.php");
                        break;

                    case 'toplusmsgonder';
                        require_once("support/_add/sms-toplu-gonder.php");
                        break;

                    case 'tekilsmsgonder';
                        require_once("support/_add/sms-tekil-gonder.php");
                        break;





                    case 'yonetici';
                        require_once("support/_pages/yoneticiler.php");
                        break;

                    case 'yoneticiekle';
                        require_once("support/_add/yoneticiler.php");
                        break;

                    case 'yoneticiler';
                        require_once("support/_edit/yoneticiler.php");
                        break;

                    case 'sifredegistir';
                        require_once("support/_edit/yoneticiler-sifre-degis.php");
                        break;




                    case 'urunkategorileri';
                        require_once("support/_pages/urun-kategori.php");
                        break;

                    case 'urunkategorisiekle';
                        require_once("support/_add/urun-kategori.php");
                        break;

                    case 'urunkategori';
                        require_once("support/_edit/urun-kategori.php");
                        break;

                    case 'urungrupsiralamasi';
                        require_once("support/_pages/urun-grup-siralamasi.php");
                        break;

                    case 'urunler';
                        require_once("support/_pages/urunler.php");
                        break;

                    case 'urunekle';
                        require_once("support/_add/urunler.php");
                        break;

                    case 'urun';
                        require_once("support/_edit/urunler.php");
                        break;

                    case 'urunfoto';
                        require_once("support/_pages/urunler-fotograflar.php");
                        break;

                    case 'urunmodul';
                        require_once("support/_edit/urun-modul-ayar.php");
                        break;


                    case 'varyantlar';
                        require_once("support/_pages/urun-varyant.php");
                        break;
                    case 'varyantekle';
                        require_once("support/_add/urun-varyant-ekle.php");
                        break;
                    case 'varyant';
                        require_once("support/_edit/urun-varyant-duzenle.php");
                        break;
                    case 'varyantozellikleri';
                        require_once("support/_pages/urun-varyant-ozellik.php");
                        break;
                    case 'varyantozellikekle';
                        require_once("support/_add/urun-varyant-ozellik-ekle.php");
                        break;
                    case 'varyantozellik';
                        require_once("support/_edit/urun-varyant-ozellik-duzenle.php");
                        break;





                    case 'siparisler';
                        require_once("support/_pages/siparisler.php");
                        break;

                    case 'siparis';
                        require_once("support/_pages/siparisler-detay.php");
                        break;

                    case 'kargo';
                        require_once("support/_pages/kargo-ekleme.php");
                        break;

                    case 'kargoekle';
                        require_once("support/_add/kargo-ekleme.php");
                        break;

                    case 'kargoduzenle';
                        require_once("support/_edit/kargo-duzenle.php");
                        break;



                    case 'kataloglar';
                        require_once("support/_pages/kataloglar.php");
                        break;

                    case 'katalogekle';
                        require_once("support/_add/kataloglar.php");
                        break;

                    case 'katalog';
                        require_once("support/_edit/kataloglar.php");
                        break;



                    case 'slidermodul';
                        require_once("support/_edit/slider-modul-ayar.php");
                        break;

                    case 'sliderlar';
                        require_once("support/_pages/slider.php");
                        break;

                    case 'sliderekle';
                        require_once("support/_add/slider.php");
                        break;

                    case 'slider';
                        require_once("support/_edit/slider.php");
                        break;


                    case 'ortasliderlar';
                        require_once("support/_pages/ortaslider.php");
                        break;

                    case 'ortasliderekle';
                        require_once("support/_add/ortaslider.php");
                        break;

                    case 'ortaslider';
                        require_once("support/_edit/ortaslider.php");
                        break;





                    case 'hizmetmodul';
                        require_once("support/_edit/hizmet-modul-ayar.php");
                        break;

                    case 'hizmetler';
                        require_once("support/_pages/hizmetler.php");
                        break;

                    case 'hizmetekle';
                        require_once("support/_add/hizmet-ekle.php");
                        break;

                    case 'hizmet';
                        require_once("support/_edit/hizmet-duzenle.php");
                        break;






                    case 'projemodul';
                        require_once("support/_edit/proje-modul-ayar.php");
                        break;

                    case 'projekategorileri';
                        require_once("support/_pages/proje-kategori.php");
                        break;

                    case 'projekatekle';
                        require_once("support/_add/proje-kategori-ekle.php");
                        break;

                    case 'projekat';
                        require_once("support/_edit/proje-kategori-duzenle.php");
                        break;

                    case 'projeler';
                        require_once("support/_pages/projeler.php");
                        break;

                    case 'projeekle';
                        require_once("support/_add/proje-ekle.php");
                        break;

                    case 'proje';
                        require_once("support/_edit/proje-duzenle.php");
                        break;

                    case 'projegaleri';
                        require_once("support/_pages/proje-galeri.php");
                        break;



                    case 'hakkimizdamodul';
                        require_once("support/_edit/hakkimizda-modul-ayar.php");
                        break;

                    case 'hakkimizdasayfa';
                        require_once("support/_pages/hakkimizda.php");
                        break;

                    case 'hakkimizdaekle';
                        require_once("support/_add/hakkimizda.php");
                        break;

                    case 'hakkimizda';
                        require_once("support/_edit/hakkimizda.php");
                        break;

                    case 'sayfalar';
                        require_once("support/_pages/sayfalar.php");
                        break;

                    case 'sayfaekle';
                        require_once("support/_add/sayfa-ekle.php");
                        break;

                    case 'sayfa';
                        require_once("support/_edit/sayfa-duzenle.php");
                        break;





                    case 'blogmodul';
                        require_once("support/_edit/blog-modul-ayar.php");
                        break;

                    case 'bloglar';
                        require_once("support/_pages/bloglar.php");
                        break;

                    case 'blogekle';
                        require_once("support/_add/blog-ekle.php");
                        break;

                    case 'blog';
                        require_once("support/_edit/blog-duzenle.php");
                        break;




                    case 'pricingmodul';
                        require_once("support/_edit/pricing-modul-ayar.php");
                        break;

                    case 'pricingler';
                        require_once("support/_pages/pricingler.php");
                        break;

                    case 'pricingekle';
                        require_once("support/_add/pricing-ekle.php");
                        break;

                    case 'pricing';
                        require_once("support/_edit/pricing-duzenle.php");
                        break;

                    case 'pricingozellikleri';
                        require_once("support/_pages/pricing-ozellikleri.php");
                        break;

                    case 'pricingozellikekle';
                        require_once("support/_add/pricing-ozellik-ekle.php");
                        break;

                    case 'pricingozellik';
                        require_once("support/_edit/pricing-ozellik-duzenle.php");
                        break;





                    case 'galerimodul';
                        require_once("support/_edit/galeri-modul-ayar.php");
                        break;

                    case 'galeriler';
                        require_once("support/_pages/galeriler.php");
                        break;

                    case 'galeriekle';
                        require_once("support/_add/galeri-ekle.php");
                        break;

                    case 'galeri';
                        require_once("support/_edit/galeri-duzenle.php");
                        break;

                    case 'galerifoto';
                        require_once("support/_pages/galeri-foto.php");
                        break;




                    case 'videomodul';
                        require_once("support/_edit/video-modul-ayar.php");
                        break;

                    case 'videolar';
                        require_once("support/_pages/videolar.php");
                        break;

                    case 'videoekle';
                        require_once("support/_add/video-ekle.php");
                        break;

                    case 'video';
                        require_once("support/_edit/video-duzenle.php");
                        break;





                    case 'yorummodul';
                        require_once("support/_edit/yorum-modul-ayar.php");
                        break;

                    case 'yorumlar';
                        require_once("support/_pages/yorumlar.php");
                        break;

                    case 'yorumekle';
                        require_once("support/_add/yorum-ekle.php");
                        break;

                    case 'yorum';
                        require_once("support/_edit/yorum-duzenle.php");
                        break;




                    case 'markamodul';
                        require_once("support/_edit/marka-modul-ayar.php");
                        break;

                    case 'markalar';
                        require_once("support/_pages/markalar.php");
                        break;

                    case 'markaekle';
                        require_once("support/_add/marka-ekle.php");
                        break;

                    case 'marka';
                        require_once("support/_edit/marka-duzenle.php");
                        break;




                    case 'belgemodul';
                        require_once("support/_edit/belge-modul-ayar.php");
                        break;

                    case 'belgeler';
                        require_once("support/_pages/belgeler.php");
                        break;

                    case 'belgeekle';
                        require_once("support/_add/belge-ekle.php");
                        break;

                    case 'belge';
                        require_once("support/_edit/belge-duzenle.php");
                        break;






                    case 'ekipmodul';
                        require_once("support/_edit/ekip-modul-ayar.php");
                        break;

                    case 'ekipler';
                        require_once("support/_pages/ekipler.php");
                        break;

                    case 'ekipekle';
                        require_once("support/_add/ekip-ekle.php");
                        break;

                    case 'ekip';
                        require_once("support/_edit/ekip-duzenle.php");
                        break;

                    case 'ekipsosyal';
                        require_once("support/_pages/ekipler-sosyal.php");
                        break;

                    case 'ekipsosyalduzenle';
                        require_once("support/_edit/ekip-sosyal-duzenle.php");
                        break;




                    case 'bankalar';
                        require_once("support/_pages/bankalar.php");
                        break;

                    case 'bankaekle';
                        require_once("support/_add/banka-ekle.php");
                        break;

                    case 'banka';
                        require_once("support/_edit/banka-duzenle.php");
                        break;





                    case 'sayacmodul';
                        require_once("support/_edit/sayac-modul-ayar.php");
                        break;

                    case 'sayaclar';
                        require_once("support/_pages/sayaclar.php");
                        break;

                    case 'sayacekle';
                        require_once("support/_add/sayac-ekle.php");
                        break;

                    case 'sayac';
                        require_once("support/_edit/sayac-duzenle.php");
                        break;




                    case 'sorumodul';
                        require_once("support/_edit/soru-modul-ayar.php");
                        break;

                    case 'sorular';
                        require_once("support/_pages/sorular.php");
                        break;

                    case 'soruekle';
                        require_once("support/_add/soru-ekle.php");
                        break;

                    case 'soru';
                        require_once("support/_edit/soru-duzenle.php");
                        break;





                    case 'ozellikmodul';
                        require_once("support/_edit/ozellik-modul-ayar.php");
                        break;

                    case 'ozellikler';
                        require_once("support/_pages/ozellikler.php");
                        break;

                    case 'ozellikekle';
                        require_once("support/_add/ozellik-ekle.php");
                        break;

                    case 'ozellik';
                        require_once("support/_edit/ozellik-duzenle.php");
                        break;






                    case 'usttetikleyiciler';
                        require_once("support/_pages/tetikleyici-ust.php");
                        break;

                    case 'usttetikleyiciekle';
                        require_once("support/_add/tetikleyici-ust-ekle.php");
                        break;

                    case 'usttetikleyici';
                        require_once("support/_edit/tetikleyici-ust-duzenle.php");
                        break;





                    case 'alttetikleyiciler';
                        require_once("support/_pages/tetikleyici-alt.php");
                        break;

                    case 'alttetikleyiciekle';
                        require_once("support/_add/tetikleyici-alt-ekle.php");
                        break;

                    case 'alttetikleyici';
                        require_once("support/_edit/tetikleyici-alt-duzenle.php");
                        break;






                    case 'becerimodul';
                        require_once("support/_edit/beceri-modul-ayar.php");
                        break;

                    case 'beceriler';
                        require_once("support/_pages/beceriler.php");
                        break;

                    case 'beceriekle';
                        require_once("support/_add/beceri-ekle.php");
                        break;

                    case 'beceri';
                        require_once("support/_edit/beceri-duzenle.php");
                        break;





                    case 'insankaynaklari';
                        require_once("support/_pages/insankaynaklari.php");
                        break;

                    case 'basvuruoku';
                        require_once("support/_pages/insankaynaklari-basvuruoku.php");
                        break;





                    case 'sosyalmedyalar';
                        require_once("support/_pages/sosyalmedyalar.php");
                        break;

                    case 'sosyalekle';
                        require_once("support/_add/sosyal-ekle.php");
                        break;

                    case 'sosyal';
                        require_once("support/_edit/sosyal-duzenle.php");
                        break;




                    case 'bakimmodu';
                        require_once("support/_edit/bakim.php");
                        break;


                    case 'popupmodul';
                        require_once("support/_edit/popup.php");
                        break;


                    case 'cookies';
                        require_once("support/_pages/cookies.php");
                        break;

                    case 'cookiesekle';
                        require_once("support/_add/cookies-ekle.php");
                        break;

                    case 'cookie';
                        require_once("support/_edit/cookies-duzenle.php");
                        break;





                    case 'uyeler';
                        require_once("support/_pages/uyeler.php");
                        break;

                    case 'uye';
                        require_once("support/_edit/uyeler-duzenle.php");
                        break;

                    case 'uyesiparis';
                        require_once("support/_pages/uyeler-siparisler.php");
                        break;

                    case 'uyeliksozlesmesi';
                        require_once("support/_pages/uyeler-sozlesme.php");
                        break;

                    case 'uyeliksozlesme';
                        require_once("support/_edit/uyeler-sozlesme.php");
                        break;

                    case 'uyeliksozlesmesiekle';
                        require_once("support/_add/uyeler-sozlesme.php");
                        break;
                        break;

                    case 'uyeayar';
                        require_once("support/_edit/uyeler-ayar.php");
                        break;

                    case 'aktifdestek';
                        require_once("support/_pages/uyeler-destek-aktif.php");
                        break;

                    case 'cevaplanandestek';
                        require_once("support/_pages/uyeler-destek-cevaplanan.php");
                        break;

                    case 'talepincele';
                        require_once("support/_pages/uyeler-talep-incele.php");
                        break;




                    case 'onaybekleyenyorumlar'; //TODO Burası eklendi
                        require_once("support/_pages/urun-yorumlari-onaysiz.php");
                        break;
                    case 'onayliyorumlar';
                        require_once("support/_pages/urun-yorumlari-onayli.php");
                        break;
                    case 'urunyorumu';
                        require_once("support/_pages/urun-yorumlari-detay.php");
                        break;




                    /* Teklif Form Ekleme */
                    case 'teklifler';
                        require_once("support/_pages/offer.php");
                        break;
                    case 'teklifincele';
                        require_once("support/_pages/offerdetail.php");
                        break;
                    /* Teklif Form Ekleme SON */

                    /* Sitemap */
                    case 'sitemap';  //todo sitemap
                        require_once("support/_pages/sitemap.php");
                        break;
                    /*  <========SON=========>>> Sitemap SON */

                    /*  */
                    case 'urunmarkalari';
                        require_once("support/_pages/urun_marka.php"); //todo ürün marka
                        break;
                    /*  <========SON=========>>>  SON */

                    /* XML input Output */
                    case 'urunimport';
                        require_once("support/_pages/urun_import.php");
                        break;
                    case 'urunaktarma';
                        require_once("support/_pages/urun_import_db.php");
                        break;
                    case 'xmlurunler';
                        require_once("support/_pages/urun_import_liste.php");
                        break;
                    case 'urunexport';
                        require_once("support/_pages/urun_export.php");
                        break;
                    case 'uruntoxmlexport';
                        require_once("support/_add/urun_export.php");
                        break;

                    /*  <========SON=========>>> XML input Output SON */

                }
            }else {
                ?>
                <script type='text/javascript'> document.location = 'index.php'; </script>
                <?php
            }
            ?>


            <?php include "support/panel_parts/panel_rightbar.php"; ?>
        </div>

    </div>

    <footer class="footer">
        Yönetim Paneli   -  <?=$ayar['site_baslik']?>
    </footer>

</div>


<?php include 'support/panel_footer_libs.php';?>

</body>

</html>