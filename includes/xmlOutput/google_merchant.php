<?php
error_reporting(0);
include '../config/config.php';
$xmlKontrol = $db->prepare("select * from urun_xml_export where url=:url and durum=:durum and tur=:tur ");
$xmlKontrol->execute(array(
    'url' => $_GET['url'],
    'durum' => '1',
    'tur' => '2'
));
$xmlRow = $xmlKontrol->fetch(PDO::FETCH_ASSOC);
$settings=$db->prepare("SELECT * from ayarlar where id='1'");
$settings->execute(array(0));
$ayar=$settings->fetch(PDO::FETCH_ASSOC);
$siteurl = $ayar['site_url'];
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
/* Kategori Durum */
if($xmlRow['kategoriler'] == '0' ) {
    $kategori_durum = '0';
}
if($xmlRow['kategoriler'] > '0' ) {
    $kategori_durum = '1';
}
function karhesap($fiyat,$oran){
    $kartutar = $fiyat * ($oran/100);
    $karfiyat = $fiyat + $kartutar;
    return $karfiyat;
}
function kdvfiyat($fiyat,$kdvoran)
{
    $kdv = $fiyat * $kdvoran/100;
    $kdvli = $fiyat+$kdv;
    return $kdvli;
}
/*  <========SON=========>>> Kategori Durum SON */
?>
<?php if($xmlKontrol->rowCount() > '0'  ) {
    header('Content-Type: text/xml');
    header('Content-type: application/xml; charset="utf8"',true);
    echo '<?xml version="1.0" encoding="UTF-8" ?>';
    echo '<rss xmlns:g="http://base.google.com/ns/1.0" version="2.0">';
    ?>
    <channel>
    <title><?=$ayar['site_baslik']?></title>
    <description><?=$ayar['site_desc']?></description>
    <link><?=$ayar['site_url']?></link>
    <?php if($kategori_durum == '0'  ) {
        $urunCek = $db->prepare("select * from urun where durum=:durum and dil=:dil and stok >'0' ");
        $urunCek->execute(array(
            'durum' => '1',
            'dil' => $xmlRow['dil']
        ));
        ?>
        <?php foreach ($urunCek as $urun) {
            $katCek = $db->prepare("select * from urun_cat where id=:id  ");
            $katCek->execute(array(
                'id' => $urun['kat_id']
            ));
            $katRow = $katCek->fetch(PDO::FETCH_ASSOC);
                $AnaKat = $db->prepare("select * from urun_cat where id=:id ");
                $AnaKat->execute(array(
                    'id' => $katRow['ust_id']
                ));
                $anakatRow = $AnaKat->fetch(PDO::FETCH_ASSOC);
            ?>
                <item>
                    <g:id><?=$urun['id']?></g:id>
                    <title><?=$urun['baslik']?></title>
                    <link><?=$siteurl?>urun/<?=$urun['id']?>/<?=seo_new($urun['baslik'])?></link>
                    <description><![CDATA[<?=$urun['icerik'];?>]]></description>
                    <g:brand><?=$urun['marka']?></g:brand>
                    <g:condition>new</g:condition>
                    <g:image_link><?=$siteurl?>images/product/<?=$urun['gorsel']?></g:image_link>
                    <g:mpn><?=$urun['urun_kod']?></g:mpn>
                    <g:availability>in stock</g:availability>
                    <?php if($xmlRow['kar_oran'] > '0' && $xmlRow['kar_oran'] == !null) {?>
                        <?php if($urun['kdv'] == '1' ) {?>
                            <g:price><?php echo kdvfiyat(karhesap($urun['fiyat'],$xmlRow['kar_oran']),$urun['kdv_oran']); ?> <?=$xmlRow['para_birimi']?></g:price>
                        <?php }else { ?>
                            <g:price><?php echo karhesap($urun['fiyat'],$xmlRow['kar_oran']); ?> <?=$xmlRow['para_birimi']?></g:price>
                        <?php }?>
                    <?php }else { ?>
                        <?php if($urun['kdv'] == '1' ) {?>
                            <g:price><?php echo kdvfiyat($urun['fiyat'],$urun['kdv_oran']); ?> <?=$xmlRow['para_birimi']?></g:price>
                        <?php }else { ?>
                            <g:price><?php echo $urun['fiyat']; ?> <?=$xmlRow['para_birimi']?></g:price>
                        <?php }?>
                    <?php }?>
                    <g:google_product_category></g:google_product_category>
                    <g:product_type><?php if($AnaKat->rowCount()> '0'  ) { ?><?=$anakatRow['baslik']?> > <?php }?><?=$katRow['baslik']?></g:product_type>
                </item>
        <?php }?>
    <?php }?>
    <?php if($kategori_durum == '1'  ) {
        $katEx = $xmlRow['kategoriler'];
        $katEx = explode(',', $katEx);
        foreach ($katEx as $katx){
            if($katx != '') {
                $kat_like.="or kat_id like '%$katx%'";
            }
        }
        $urunCek = $db->prepare("select * from urun where (kat_id like '' $kat_like) and durum=:durum and dil=:dil and stok >'0' ");
        $urunCek->execute(array(
            'durum' => '1',
            'dil' => $xmlRow['dil']
        ));
        ?>
        <?php foreach ($urunCek as $urun) {
            $katCek = $db->prepare("select * from urun_cat where id=:id  ");
            $katCek->execute(array(
                'id' => $urun['kat_id']
            ));
            $katRow = $katCek->fetch(PDO::FETCH_ASSOC);
                $AnaKat = $db->prepare("select * from urun_cat where id=:id ");
                $AnaKat->execute(array(
                    'id' => $katRow['ust_id']
                ));
                $anakatRow = $AnaKat->fetch(PDO::FETCH_ASSOC);
            ?>
            <item>
                <g:id><?=$urun['id']?></g:id>
                <title><?=$urun['baslik']?></title>
                <link><?=$siteurl?>urun/<?=$urun['id']?>/<?=seo_new($urun['baslik'])?></link>
                <description><![CDATA[<?=$urun['icerik'];?>]]></description>
                <g:brand><?=$urun['marka']?></g:brand>
                <g:condition>new</g:condition>
                <g:image_link><?=$siteurl?>images/product/<?=$urun['gorsel']?></g:image_link>
                <g:mpn><?=$urun['urun_kod']?></g:mpn>
                <g:availability>in stock</g:availability>
                    <?php if($xmlRow['kar_oran'] > '0' && $xmlRow['kar_oran'] == !null) {?>
                        <?php if($urun['kdv'] == '1' ) {?>
                            <g:price><?php echo kdvfiyat(karhesap($urun['fiyat'],$xmlRow['kar_oran']),$urun['kdv_oran']); ?> <?=$xmlRow['para_birimi']?></g:price>
                        <?php }else { ?>
                            <g:price><?php echo karhesap($urun['fiyat'],$xmlRow['kar_oran']); ?> <?=$xmlRow['para_birimi']?></g:price>
                        <?php }?>
                    <?php }else { ?>
                        <?php if($urun['kdv'] == '1' ) {?>
                            <g:price><?php echo kdvfiyat($urun['fiyat'],$urun['kdv_oran']); ?> <?=$xmlRow['para_birimi']?></g:price>
                        <?php }else { ?>
                            <g:price><?php echo $urun['fiyat']; ?> <?=$xmlRow['para_birimi']?></g:price>
                        <?php }?>
                    <?php }?>
                <g:google_product_category></g:google_product_category>
                <g:product_type><?php if($AnaKat->rowCount() > '0'  ) { ?><?=$anakatRow['baslik']?> > <?php }?><?=$katRow['baslik']?></g:product_type>
            </item>
        <?php }?>
    <?php }?>
    </channel>
    <?php echo '</rss>'; ?>
<?php }else { ?>
    <div style="width: 100%; box-sizing: border-box; border: 1px solid #EBEBEB; padding: 25px; text-align: center; font-family : Arial ; font-size: 20px ; background-color: #f8f8f8;    ">
        Bu veri beslemesi geçici olarak devre dışıdır
    </div>
<?php }?>
