<?php
ob_start();
session_start();
include "../../../../includes/config/config.php";
date_default_timezone_set( 'Europe/Istanbul' );
$settings=$db->prepare("SELECT * from ayarlar where id='1'");
$settings->execute(array(0));
$ayar=$settings->fetch(PDO::FETCH_ASSOC);
$siteurl = $ayar['site_url'];
?>


<?php
include_once '../../secure_post.php';
if ($adminsorgusu->rowCount()===0) {
    header("Location: 404");
} else {
    if (isset($_POST['siteayardegis'])) {

        $ayarkaydet = $db->prepare(
            "UPDATE ayarlar SET
			site_baslik=:site_baslik,
			site_slogan=:site_slogan,
			site_url=:site_url,
			site_tags=:site_tags,
			site_desc=:site_desc		
			WHERE id='1'"
        );
        $update = $ayarkaydet->execute(
            array(
                'site_baslik' => $_POST['site_baslik'],
                'site_slogan' => $_POST['site_slogan'],
                'site_url' => $_POST['site_url'],
                'site_tags' => $_POST['site_tags'],
                'site_desc' => $_POST['site_desc']
            )
        );

        if ($update) {

            Header("location: ../../../pages.php?sayfa=siteayar&status=success");
        } else {

            Header("location: ../../../pages.php?sayfa=siteayar&status=warning");
        }


    }

}

?>


