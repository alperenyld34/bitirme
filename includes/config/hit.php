<?php
include 'includes/config/config.php';
$bugun=date("d"); // bugünün tarihi
$ay=date("m"); // bu ay
$yil=date("Y"); // bu yıl
$onlineSuresi=time()-2*60*60; // iki dakika aktif olmazsa onlineden düşecek
$ip=$_SERVER['REMOTE_ADDR']; // ziyaretçinin ip si
$todayEnter = $db->prepare("select * from hit where ip='$ip' and gun='$bugun' and ay='$ay' and yil='$yil'");
$todayEnter->execute();
if($todayEnter->rowCount() > '0'){ // yani bugün girilmişse

    $allsana=$db->prepare("SELECT * FROM `hit` WHERE  `ip`='".$ip."' AND `gun`='".$bugun."'");
    $allsana->execute();
    $al = $allsana->fetch(PDO::FETCH_ASSOC);

    $guncelle = $db->prepare("UPDATE hit SET
            sayac=:sayac
     WHERE id={$al['id']}      
    ");
    $sonuc = $guncelle->execute(array(
        'sayac' => $al['sayac']+1
    ));

}else{ // griş yapılmamışsa kaydettirelim

    $kaydet = $db->prepare("INSERT INTO hit SET
         gun=:gun,   
         ay=:ay,
         yil=:yil,
         sayac=:sayac,
         ip=:ip
    ");
    $sonuc = $kaydet->execute(array(
        'gun' => $bugun,
        'ay' => $ay,
        'yil' => $yil,
        'sayac' => '1',
        'ip' => $ip
    ));


}
// evet sıra geldi online, tekil ve çoğulu Göstermeye

// çoğul hitler
$bugunFor = $db->prepare("SELECT SUM(sayac) FROM hit WHERE gun='$bugun' AND ay='$ay' AND yil='$yil' ORDER BY id desc");
$bugunFor->execute();
$bugunx = $bugunFor->fetch(PDO::FETCH_ASSOC);
$bugun_cogul=$bugunx['SUM(sayac)']; // bugün çoğul

$dunFor = $db->prepare("SELECT SUM(sayac) FROM hit WHERE gun='".($bugun-1)."' AND ay='$ay' AND yil='$yil' ORDER BY id desc");
$dunFor->execute();
$dunx = $dunFor->fetch(PDO::FETCH_ASSOC);
$dun_cogul=$dunx['SUM(sayac)']; // dün Çoğul

$ayFor = $db->prepare("SELECT SUM(sayac) FROM hit WHERE ay='$ay' AND yil='$yil' ORDER BY id desc");
$ayFor->execute();
$ayx = $ayFor->fetch(PDO::FETCH_ASSOC);
$buay_cogul=$ayx['SUM(sayac)']; // dün Çoğul

$toplamFor = $db->prepare("SELECT SUM(sayac) FROM hit WHERE ay='$ay' AND yil='$yil' ORDER BY id desc");
$toplamFor->execute();
$toplamx = $toplamFor->fetch(PDO::FETCH_ASSOC);
$toplam_cogul=$toplamx['SUM(sayac)']; // dün Çoğul



// tekil hitler





$bugun_tekil=$db->prepare("SELECT * FROM hit WHERE gun='$bugun' AND ay='$ay' AND yil='$yil'")->rowCount(); // bugün tekil
$dun_tekil=$db->prepare("SELECT * FROM hit WHERE gun='".($bugun-1)."' AND ay='$ay' AND yil='$yil'")->rowCount(); // dün tekil
$buay_tekil=$db->prepare("SELECT * FROM hit WHERE  ay='$ay' AND yil='$yil'")->rowCount(); // dün tekil
$toplam_tekil=$db->prepare("SELECT * FROM hit")->rowCount(); // dün tekil



function total_online()
{
    global $db;
    include 'includes/config/config.php';

    $current_time = time();
    $timeout = $current_time - (80);


    $session_exist = $db->prepare("SELECT * FROM total_visitors WHERE session='".$_SESSION['session']."'");
    $session_exist->execute();
    $session_check = $session_exist->rowCount();

    if($session_check == '0' && $_SESSION['session']!="")
    {

        $kaydet = $db->prepare("INSERT INTO total_visitors SET
            session=:session,
            time=:time
        ");
        $kaydet->execute(array(
            'session' => $_SESSION['session'],
            'time' => $current_time
        ));

    }
    else
    {
        $kaydet = $db->prepare("UPDATE total_visitors SET
            time=:time
            WHERE session='$_SESSION[session]'
        ");
        $kaydet->execute(array(
            'time' => time()
        ));
    }
    $select_total = $db->prepare("SELECT * from total_visitors WHERE time>='$timeout'");
    $select_total->execute();
    $total_online_visitors = $select_total->rowCount();
    return $total_online_visitors;
}

if (isset($_POST['get_online_visitor']))
{
    $total_online = $total_online();
    echo $total_online;
    exit();
}
?>