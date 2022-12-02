<?php
ob_start();
session_start();
include "../../../includes/config/config.php";
date_default_timezone_set( 'Europe/Istanbul' );
$settings=$db->prepare("SELECT * from ayarlar where id='1'");
$settings->execute(array(0));
$ayar=$settings->fetch(PDO::FETCH_ASSOC);
$siteurl = $ayar['site_url'];

//todo sitemap
?>


<?php
include_once '../secure_post.php';
if ($adminsorgusu->rowCount()===0) {
    header("Location: 404");
} else { ?>

<?php if($_POST['adresID']  ) {?>

        <?php
        $mapAdresCek = $db->prepare("select * from sitemap where id=:id ");
        $mapAdresCek->execute(array(
            'id' => $_POST['adresID']
        ));
        $mapAdresRow = $mapAdresCek->fetch(PDO::FETCH_ASSOC);
        ?>

        <div class="row">
            <div class="form-group col-md-12">
                <label for="baslik" class="control-label">Adres Başlığı :</label>
                <input type="text" class="form-control" id="baslik" name="baslik" value="<?=$mapAdresRow['baslik']?>" placeholder="Örn : Anasayfa" required  >
            </div>
            <div class="form-group col-md-12">
                <label for="adres" class="control-label">Link :</label>
                <input type="text" class="form-control" id="adres" name="adres" value="<?=$mapAdresRow['adres']?>" placeholder="http://" required  >
            </div>
        </div>

        <input type="hidden" name="hidden_id" value="<?=$mapAdresRow['id']?>" >
        
<?php }?>

<?php } ?>


