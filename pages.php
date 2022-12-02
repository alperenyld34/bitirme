<?php include 'includes/config/session.php'; ?>
<!doctype html>
<html lang="<?=$current_lang['kisa_ad']?>">
<head>
    <base href="<?php echo"$ayar[site_url]"?>">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <?php
    if(isset($_GET['sayfa'])){
        $s = $_GET['sayfa'];
        switch($s){

            case 'errorpage';
                require_once("includes/template/_pages/404.php");
                break;

            case 'about';
                require_once("includes/template/_pages/about.php");
                break;

            case 'htmlsayfa';
                require_once("includes/template/_pages/htmlpages.php");
                break;

            case 'clients';
                require_once("includes/template/_pages/clients.php");
                break;

            case 'blog';
                require_once("includes/template/_pages/blog.php");
                break;

            case 'bank';
                require_once("includes/template/_pages/bank.php");
                break;

            case 'insankaynak';
                require_once("includes/template/_pages/human_resources.php");
                break;

            case 'blogdetail';
                require_once("includes/template/_pages/blog_detail.php");
                break;

            case 'contact';
                require_once("includes/template/_pages/contact.php");
                break;

            case 'products';
                require_once("includes/template/_pages/products.php");
                break;

            case 'categorysub';
                require_once("includes/template/_pages/products_cat_sub.php");
                break;

            case 'productdetail';
                require_once("includes/template/_pages/products_detail.php");
                break;

            case 'cart';
                require_once("includes/template/_pages/cart.php");
                break;

            case 'delivery';
                require_once("includes/template/_pages/cart-2.php");
                break;

            case 'purchase';
                require_once("includes/template/_pages/cart-3.php");
                break;

            case 'purchasepost';
                require_once("includes/func/purchase.php");
                break;

            case 'ordersuccess';
                require_once("includes/template/_alerts/eft-havale-alerts.php");
                break;

            case 'paysuccess';
                require_once("includes/template/_alerts/pay-success-alerts.php");
                break;

            case 'shopiersuccess';
                require_once("includes/template/_alerts/shopier-success-alerts.php");
                break;

            case 'search';
                require_once("includes/template/_pages/search.php");
                break;

            case 'faq';
                require_once("includes/template/_pages/faq.php");
                break;



            case 'userlogin';
                require_once("includes/template/_pages/user-login.php");
                break;

            case 'userremember';
                require_once("includes/template/_pages/user-password-reset.php");
                break;

            case 'userrememberpasschange';
                require_once("includes/template/_pages/user-password-reset-2.php");
                break;

            case 'register';
                require_once("includes/template/_pages/user-register.php");
                break;

            case 'resetpasswordpost';
                require_once("includes/post/users/resetpassword.php");
                break;

            case 'resetpasswordpostchange';
                require_once("includes/post/users/resetpasswordchange.php");
                break;

            case 'loginpost';
                require_once("includes/post/users/loginpost.php");
                break;

            case 'registerpost';
                require_once("includes/post/users/registerpost.php");
                break;

            case 'userlogout';
                require_once("includes/post/users/logout.php");
                break;

            case 'useraccount';
                require_once("includes/template/_pages/user-account.php");
                break;

            case 'userpassword';
                require_once("includes/template/_pages/user-password.php");
                break;

            case 'userorders';
                require_once("includes/template/_pages/user-orders.php");
                break;

            case 'userordersdetail';
                require_once("includes/template/_pages/user-orders-detail.php");
                break;

            case 'useraddress';
                require_once("includes/template/_pages/user-address.php");
                break;

            case 'useraddressadd';
                require_once("includes/template/_pages/user-address-add.php");
                break;

            case 'useraddressedit';
                require_once("includes/template/_pages/user-address-edit.php");
                break;

            case 'useraddressedelete';
                require_once("includes/post/users/address-delete.php");
                break;

            case 'usersupport';
                require_once("includes/template/_pages/user-support.php");
                break;

            case 'usersupportdetail';
                require_once("includes/template/_pages/user-support-detail.php");
                break;




            case 'usercomment'; //TODO EKLENDİ
                require_once("includes/template/_pages/user-comments.php");
                break;

            case 'productloginpage';
                require_once("includes/post/product_comments/comment_loginpost.php");
                break;

            case 'productaddcomment';
                require_once("includes/post/product_comments/productaddcomment.php");
                break;




            case 'offer';
                require_once("includes/template/_pages/offer.php");
                break;//TODO EKLEME VAR

            case 'offerpost';
                require_once("includes/post/offerpost.php");
                break;

            case 'tracing';
                require_once("includes/template/_pages/tracing.php");
                break;//TODO EKLEME VAR
            case 'tracingresult';
                require_once("includes/template/_pages/tracing_result.php");
                break;


            case 'urunmarkasi';//todo ürün marka
                require_once("includes/template/_pages/urun_marka.php");
                break;

        }
    }else {
        ?>
        <script type='text/javascript'> document.location = 'index.php'; </script>
        <?php
    }
    ?>