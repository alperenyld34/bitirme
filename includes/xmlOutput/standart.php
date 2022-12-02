<?php
error_reporting(0);
include '../config/config.php';
$xmlKontrol = $db->prepare("select * from urun_xml_export where url=:url and durum=:durum and tur=:tur ");
$xmlKontrol->execute(array(
    'url' => $_GET['url'],
    'durum' => '1',
    'tur' => '1'
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
$ip = $_SERVER["REMOTE_ADDR"];
?>
<?php if($xmlKontrol->rowCount() > '0'  ) {?>
<?php if($xmlRow['ip_izin'] == !null  ) {?>
<?php if($xmlRow['ip_izin'] == $ip ) {
            header('Content-Type: text/xml');
            header('Content-type: application/xml; charset="utf8"',true);
            echo '<?xml version="1.0" encoding="UTF-8" ?>';
            echo '<xml>';
            ?>
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
                    /* Galeri */
                    $urunGaleri = $db->prepare("select * from urun_galeri where urun_id=:urun_id ");
                    $urunGaleri->execute(array(
                        'urun_id' => $urun['id']
                    ));
                    $galerisayi ='2';
                    /*  <========SON=========>>> Galeri SON */
                    ?>
                    <item>
                        <product_id><?=$urun['id']?></product_id>
                        <product_name><![CDATA[<?=$urun['baslik']?>]]></product_name>
                        <description><![CDATA[<?=$urun['icerik'];?>]]></description>
                        <images>
                            <image_1><![CDATA[<?=$siteurl?>images/product/<?=$urun['gorsel']?>]]></image_1>
                            <?php foreach ($urunGaleri as $galeri) {
                                $galerisayiplus = $galerisayi++;
                                ?>
                                <image_<?=$galerisayiplus?>><![CDATA[<?=$siteurl?>images/product/<?=$galeri['gorsel']?>]]></image_<?=$galerisayiplus?>>
                            <?php }?>
                        </images>
                        <product_link><?=$siteurl?>urun/<?=$urun['id']?>/<?=seo_new($urun['baslik'])?></product_link>
                        <?php if($xmlRow['kar_oran'] > '0' && $xmlRow['kar_oran'] == !null) {?>
                            <?php if($urun['kdv'] == '1' ) {?>
                                <price><?php echo karhesap(kdvfiyat($urun['fiyat'],$urun['kdv_oran']),$xmlRow['kar_oran']); ?></price>
                            <?php }else { ?>
                                <price><?php echo karhesap($urun['fiyat'],$xmlRow['kar_oran']); ?></price>
                            <?php }?>
                        <?php }else { ?>
                            <?php if($urun['kdv'] == '1' ) {?>
                                <price><?php echo kdvfiyat($urun['fiyat'],$urun['kdv_oran']); ?></price>
                            <?php }else { ?>
                                <price><?php echo $urun['fiyat']; ?></price>
                            <?php }?>
                        <?php }?>
                        <currency_code><?=$xmlRow['para_birimi']?></currency_code>
                        <category_id><?=$urun['kat_id']?></category_id>
                        <category><![CDATA[<?=$katRow['baslik']?>]]></category>
                        <category_full><![CDATA[<?php if($AnaKat->rowCount()>'0'  ) { ?><?=$anakatRow['baslik']?> > <?php }?><?=$katRow['baslik']?>]]></category_full>
                        <brand><![CDATA[<?=$urun['marka']?>]]></brand>
                        <in_stock><?=$urun['stok']?></in_stock>
                        <stock_code><?=$urun['urun_kod']?></stock_code>
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
                    /* Galeri */
                    $urunGaleri = $db->prepare("select * from urun_galeri where urun_id=:urun_id ");
                    $urunGaleri->execute(array(
                        'urun_id' => $urun['id']
                    ));
                    $galerisayi ='2';
                    /*  <========SON=========>>> Galeri SON */
                    ?>
                    <item>
                        <product_id><?=$urun['id']?></product_id>
                        <product_name><![CDATA[<?=$urun['baslik']?>]]></product_name>
                        <description><![CDATA[<?=$urun['icerik'];?>]]></description>
                        <images>
                            <image_1><![CDATA[<?=$siteurl?>images/product/<?=$urun['gorsel']?>]]></image_1>
                            <?php foreach ($urunGaleri as $galeri) {
                                $galerisayiplus = $galerisayi++;
                                ?>
                                <image_<?=$galerisayiplus?>><![CDATA[<?=$siteurl?>images/product/<?=$galeri['gorsel']?>]]></image_<?=$galerisayiplus?>>
                            <?php }?>
                        </images>
                        <product_link><?=$siteurl?>urun/<?=$urun['id']?>/<?=seo_new($urun['baslik'])?></product_link>
                        <?php if($xmlRow['kar_oran'] > '0' && $xmlRow['kar_oran'] == !null) {?>
                            <?php if($urun['kdv'] == '1' ) {?>
                                <price><?php echo karhesap(kdvfiyat($urun['fiyat'],$urun['kdv_oran']),$xmlRow['kar_oran']); ?></price>
                            <?php }else { ?>
                                <price><?php echo karhesap($urun['fiyat'],$xmlRow['kar_oran']); ?></price>
                            <?php }?>
                        <?php }else { ?>
                            <?php if($urun['kdv'] == '1' ) {?>
                                <price><?php echo kdvfiyat($urun['fiyat'],$urun['kdv_oran']); ?></price>
                            <?php }else { ?>
                                <price><?php echo $urun['fiyat']; ?></price>
                            <?php }?>
                        <?php }?>
                        <currency_code><?=$xmlRow['para_birimi']?></currency_code>
                        <category_id><?=$urun['kat_id']?></category_id>
                        <category><![CDATA[<?=$katRow['baslik']?>]]></category>
                        <category_full><![CDATA[<?php if($AnaKat->rowCount()>'0'  ) { ?><?=$anakatRow['baslik']?> > <?php }?><?=$katRow['baslik']?>]]></category_full>
                        <brand><![CDATA[<?=$urun['marka']?>]]></brand>
                        <in_stock><?=$urun['stok']?></in_stock>
                        <stock_code><?=$urun['urun_kod']?></stock_code>
                    </item>
                <?php }?>
            <?php }?>
            <?php echo '</xml>'; ?>
<?php }else{ ?>
            <div style="width: 100%; box-sizing: border-box; border: 1px solid #EBEBEB; padding: 25px; text-align: center; font-family : Arial ; font-size: 20px ; background-color: #f8f8f8;    ">
                Bu alanı görme yetkiniz bulunmamaktadır
            </div>
       <?php }?>
<?php }else { ?>
<?php
        header('Content-Type: text/xml');
        header('Content-type: application/xml; charset="utf8"',true);
        echo '<?xml version="1.0" encoding="UTF-8" ?>';
        echo '<xml>';
?>
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
                 /* Galeri */
                 $urunGaleri = $db->prepare("select * from urun_galeri where urun_id=:urun_id ");
                 $urunGaleri->execute(array(
                         'urun_id' => $urun['id']
                 ));
                 $galerisayi ='2';
                 /*  <========SON=========>>> Galeri SON */
                ?>
                <item>
                    <product_id><?=$urun['id']?></product_id>
                    <product_name><![CDATA[<?=$urun['baslik']?>]]></product_name>
                    <description><![CDATA[<?=$urun['icerik'];?>]]></description>
                    <images>
                        <image_1><![CDATA[<?=$siteurl?>images/product/<?=$urun['gorsel']?>]]></image_1>
                        <?php foreach ($urunGaleri as $galeri) {
                            $galerisayiplus = $galerisayi++;
                            ?>
                            <image_<?=$galerisayiplus?>><![CDATA[<?=$siteurl?>images/product/<?=$galeri['gorsel']?>]]></image_<?=$galerisayiplus?>>
                        <?php }?>
                    </images>
                    <product_link><?=$siteurl?>urun/<?=$urun['id']?>/<?=seo_new($urun['baslik'])?></product_link>
                    <?php if($xmlRow['kar_oran'] > '0' && $xmlRow['kar_oran'] == !null) {?>
                        <?php if($urun['kdv'] == '1' ) {?>
                            <price><?php echo karhesap(kdvfiyat($urun['fiyat'],$urun['kdv_oran']),$xmlRow['kar_oran']); ?></price>
                        <?php }else { ?>
                            <price><?php echo karhesap($urun['fiyat'],$xmlRow['kar_oran']); ?></price>
                        <?php }?>
                    <?php }else { ?>
                        <?php if($urun['kdv'] == '1' ) {?>
                            <price><?php echo kdvfiyat($urun['fiyat'],$urun['kdv_oran']); ?></price>
                        <?php }else { ?>
                            <price><?php echo $urun['fiyat']; ?></price>
                        <?php }?>
                    <?php }?>
                    <currency_code><?=$xmlRow['para_birimi']?></currency_code>
                    <category_id><?=$urun['kat_id']?></category_id>
                    <category><![CDATA[<?=$katRow['baslik']?>]]></category>
                    <category_full><![CDATA[<?php if($AnaKat->rowCount()>'0'  ) { ?><?=$anakatRow['baslik']?> > <?php }?><?=$katRow['baslik']?>]]></category_full>
                    <brand><![CDATA[<?=$urun['marka']?>]]></brand>
                    <in_stock><?=$urun['stok']?></in_stock>
                    <stock_code><?=$urun['urun_kod']?></stock_code>
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

                /* Galeri */
                $urunGaleri = $db->prepare("select * from urun_galeri where urun_id=:urun_id ");
                $urunGaleri->execute(array(
                    'urun_id' => $urun['id']
                ));
                $galerisayi ='2';
                /*  <========SON=========>>> Galeri SON */
                ?>
                <item>
                    <product_id><?=$urun['id']?></product_id>
                    <product_name><![CDATA[<?=$urun['baslik']?>]]></product_name>
                    <description><![CDATA[<?=$urun['icerik'];?>]]></description>
                    <images>
                        <image_1><![CDATA[<?=$siteurl?>images/product/<?=$urun['gorsel']?>]]></image_1>
                        <?php foreach ($urunGaleri as $galeri) {
                            $galerisayiplus = $galerisayi++;
                            ?>
                            <image_<?=$galerisayiplus?>><![CDATA[<?=$siteurl?>images/product/<?=$galeri['gorsel']?>]]></image_<?=$galerisayiplus?>>
                        <?php }?>
                    </images>
                    <product_link><?=$siteurl?>urun/<?=$urun['id']?>/<?=seo_new($urun['baslik'])?></product_link>
                    <?php if($xmlRow['kar_oran'] > '0' && $xmlRow['kar_oran'] == !null) {?>
                        <?php if($urun['kdv'] == '1' ) {?>
                            <price><?php echo karhesap(kdvfiyat($urun['fiyat'],$urun['kdv_oran']),$xmlRow['kar_oran']); ?></price>
                        <?php }else { ?>
                            <price><?php echo karhesap($urun['fiyat'],$xmlRow['kar_oran']); ?></price>
                        <?php }?>
                    <?php }else { ?>
                        <?php if($urun['kdv'] == '1' ) {?>
                            <price><?php echo kdvfiyat($urun['fiyat'],$urun['kdv_oran']); ?></price>
                        <?php }else { ?>
                            <price><?php echo $urun['fiyat']; ?></price>
                        <?php }?>
                    <?php }?>
                    <currency_code><?=$xmlRow['para_birimi']?></currency_code>
                    <category_id><?=$urun['kat_id']?></category_id>
                    <category><![CDATA[<?=$katRow['baslik']?>]]></category>
                    <category_full><![CDATA[<?php if($AnaKat->rowCount()>'0'  ) { ?><?=$anakatRow['baslik']?> > <?php }?><?=$katRow['baslik']?>]]></category_full>
                    <brand><![CDATA[<?=$urun['marka']?>]]></brand>
                    <in_stock><?=$urun['stok']?></in_stock>
                    <stock_code><?=$urun['urun_kod']?></stock_code>
                </item>
<?php }?>
<?php }?>
<?php  echo '</xml>'  ?>
<?php }?>
<?php }else { ?>
    <div style="width: 100%; box-sizing: border-box; border: 1px solid #EBEBEB; padding: 25px; text-align: center; font-family : Arial ; font-size: 20px ; background-color: #f8f8f8;    ">
        Bu veri beslemesi geçici olarak devre dışıdır
    </div>
<?php }?>
