<?php
ob_start();
session_start();
error_reporting(0);
header('Content-Type: text/html; charset=utf-8');
ini_set('error_reporting', E_ALL^E_NOTICE);
define("GUVENLIK",true);
include "../includes/config/config.php";
include "../includes/config/admin_language.php";
include "../includes/config/functions.php";
date_default_timezone_set( 'Europe/Istanbul' );
//** Ayar SQL */
$settings=$db->prepare("SELECT * from ayarlar where id='1'");
$settings->execute(array(0));
$ayar=$settings->fetch(PDO::FETCH_ASSOC);
//** Dil SQL */
$language_current=$db->prepare("SELECT * from dil where kisa_ad='$_SESSION[dil]'");
$language_current->execute(array(0));
$lang=$language_current->fetch(PDO::FETCH_ASSOC);
//** ÖDEME AYARLARI  */
$odemesettings=$db->prepare("SELECT * from odeme_ayar where id='1'");
$odemesettings->execute(array(0));
$odemeayar=$odemesettings->fetch(PDO::FETCH_ASSOC);

$adminsorgusu = $db->prepare("select * from yonetici where user_adi ='$_SESSION[admin_username]'");
$adminsorgusu->execute();
if ($adminsorgusu->rowCount()===0) {
    header("Location:login.php");
}
?>