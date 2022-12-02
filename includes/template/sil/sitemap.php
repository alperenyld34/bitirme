<?php
 header('Content-type: application/xml; charset="utf8"',true);
include '../config/config.php';
include '../config/functions.php';
/* Sitemap Ayar */
$sitemapAyar = $db->prepare("select * from sitemap_ayar where id=:id ");
$sitemapAyar->execute(array(
    'id' => '1'
));
$mapAyar = $sitemapAyar->fetch(PDO::FETCH_ASSOC);
/*  <========SON=========>>> Sitemap Ayar SON */
$settings=$db->prepare("SELECT * from ayarlar where id='1'");
$settings->execute(array(0));
$ayar=$settings->fetch(PDO::FETCH_ASSOC);
$siteurl = $ayar['site_url'];
$tarih=date("Y-m-d");
function seo_new($s) {
    $tr = array('ş','Ş','ı','I','İ','ğ','Ğ','ü','Ü','ö','Ö','Ç','ç','(',')','/',' ',',','?','!','&');
    $eng = array('s','s','i','i','i','g','g','u','u','o','o','c','c','','','-','-','','','','-');
    $s = str_replace($tr,$eng,$s);
    $s = strtolower($s);
    $s = preg_replace('/&amp;amp;amp;amp;amp;amp;amp;amp;amp;.+?;/', '', $s);
    $s = preg_replace('/\s+/', '-', $s);
    $s = preg_replace('|-+|', '-', $s);
    $s = preg_replace('/#/', '', $s);
    $s = str_replace('\'', '-', $s);
    $s = str_replace('.', '', $s);
    $s = trim($s, '-');
    return $s;
}
echo '<?xml version="1.0" encoding="UTF-8" ?>
<urlset
      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';?>
<?php
if($mapAyar['statik_map'] == '1' ) {
    /* Statik Adresler */
    $statikAdresler = $db->prepare("select * from sitemap order by sira asc ");
    $statikAdresler->execute();
    /*  <========SON=========>>> Statik Adresler SON */
    ?>
    <?php foreach ($statikAdresler as $statikmap) {?>
        <url>
            <loc><?=$statikmap['adres']?></loc>
            <lastmod><?=$tarih?></lastmod>
            <priority>0.8</priority>
        </url>
    <?php }?>
<?php }?>
<?php
if($mapAyar['urun_kat'] == '1' ) {
    /* Ürün Kategorileri Adresler */
    $urunKat = $db->prepare("select * from urun_cat where durum=:durum order by sira asc ");
    $urunKat->execute(array(
        'durum' => '1'
    ));
    /*  <========SON=========>>> Ürün Kategorileri Adresler SON */
    ?>
    <url>
        <loc><?=$siteurl?>urunler</loc>
        <lastmod><?=$tarih?></lastmod>
        <priority>0.8</priority>
    </url>
    <?php foreach ($urunKat as $urunkat) {?>
        <url>
            <loc><?=$siteurl?>urun-kategori/<?=$urunkat['id']?>/<?=seo_new($urunkat['baslik'])?></loc>
            <lastmod><?=$tarih?></lastmod>
            <priority>0.8</priority>
        </url>
    <?php }?>
<?php }?>
<?php
if($mapAyar['urun'] == '1' ) {
    /* Ürün  Adresler */
    $urunCek = $db->prepare("select * from urun where durum=:durum order by id desc ");
    $urunCek->execute(array(
        'durum' => '1'
    ));
    /*  <========SON=========>>> Ürün  Adresler SON */
    ?>
    <?php foreach ($urunCek as $urun) {?>
        <url>
            <loc><?=$siteurl?>urun/<?=$urun['id']?>/<?=seo_new($urun['baslik'])?></loc>
            <lastmod><?=$tarih?></lastmod>
            <priority>0.8</priority>
        </url>
    <?php }?>
<?php }?>
<?php
if($mapAyar['blog'] == '1' ) {
    /* bloglarAdresler */
    $blogCek = $db->prepare("select * from blog where durum=:durum order by id desc ");
    $blogCek->execute(array(
        'durum' => '1'
    ));
    /*  <========SON=========>>>bloglar Adresler SON */
    ?>
    <url>
        <loc><?=$siteurl?>bloglar</loc>
        <lastmod><?=$tarih?></lastmod>
        <priority>0.8</priority>
    </url>
    <?php foreach ($blogCek as $blog) {?>
        <url>
            <loc><?=$siteurl?>blog/<?=$blog['id']?>/<?=seo_new($blog['baslik'])?></loc>
            <lastmod><?=$tarih?></lastmod>
            <priority>0.8</priority>
        </url>
    <?php }?>
<?php }?>
<?php
if($mapAyar['hizmet'] == '1' ) {
    /* Hizmetlerin Adresler */
    $hizmetCek = $db->prepare("select * from hizmet where durum=:durum order by id desc ");
    $hizmetCek->execute(array(
        'durum' => '1'
    ));
    /*  <========SON=========>>> Hizmetlerin Adresler SON */
    ?>
    <url>
        <loc><?=$siteurl?>hizmetler</loc>
        <lastmod><?=$tarih?></lastmod>
        <priority>0.8</priority>
    </url>
    <?php foreach ($hizmetCek as $hizmet) {?>
        <url>
            <loc><?=$siteurl?>hizmet/<?=$hizmet['id']?>/<?=seo_new($hizmet['baslik'])?></loc>
            <lastmod><?=$tarih?></lastmod>
            <priority>0.8</priority>
        </url>
    <?php }?>
<?php }?>
<?php
if($mapAyar['proje'] == '1' ) {
    /* Proje Adresler */
    $projeCek = $db->prepare("select * from proje where durum=:durum order by id desc ");
    $projeCek->execute(array(
        'durum' => '1'
    ));
    /*  <========SON=========>>> Proje Adresler SON */
    ?>
    <url>
        <loc><?=$siteurl?>projeler</loc>
        <lastmod><?=$tarih?></lastmod>
        <priority>0.8</priority>
    </url>
    <?php foreach ($projeCek as $proje) {?>
        <url>
            <loc><?=$siteurl?>proje/<?=$proje['id']?>/<?=seo_new($proje['baslik'])?></loc>
            <lastmod><?=$tarih?></lastmod>
            <priority>0.8</priority>
        </url>
    <?php }?>
<?php }?>

<?php
if($mapAyar['foto'] == '1' ) {
    /* Foto Galeri Adresler */
    $fotoCek = $db->prepare("select * from galeri_kat where durum=:durum order by sira asc ");
    $fotoCek->execute(array(
        'durum' => '1'
    ));
    /*  <========SON=========>>> Foto Galeri Adresler SON */
    ?>
    <url>
        <loc><?=$siteurl?>foto-galeri</loc>
        <lastmod><?=$tarih?></lastmod>
        <priority>0.8</priority>
    </url>
    <?php foreach ($fotoCek as $foto) {?>
        <url>
            <loc><?=$siteurl?>galeri/<?=$foto['id']?>/<?=seo_new($foto['baslik'])?></loc>
            <lastmod><?=$tarih?></lastmod>
            <priority>0.8</priority>
        </url>
    <?php }?>
<?php }?>
<?php
if($mapAyar['video'] == '1' ) {
    /* Video Adresler */
    $videoCek = $db->prepare("select * from video where durum=:durum order by sira asc ");
    $videoCek->execute(array(
        'durum' => '1'
    ));
    /*  <========SON=========>>> Video Adresler SON */
    ?>
    <url>
        <loc><?=$siteurl?>foto-galeri</loc>
        <lastmod><?=$tarih?></lastmod>
        <priority>0.8</priority>
    </url>
    <?php foreach ($videoCek as $video) {?>
        <url>
            <loc><?=$siteurl?>video/<?=$video['id']?>/<?=seo_new($video['baslik'])?></loc>
            <lastmod><?=$tarih?></lastmod>
            <priority>0.8</priority>
        </url>
    <?php }?>
<?php }?>


</urlset>
