<?php
function seo($s) {
    $tr = array('ş','Ş','ı','I','İ','ğ','Ğ','ü','Ü','ö','Ö','Ç','ç','(',')','/',' ',',','?','!');
    $eng = array('s','s','i','i','i','g','g','u','u','o','o','c','c','','','-','-','','','');
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
?>
<?php
function ucwords_tr($deger)
{
    $lower_arr = array("I" => "ı", "i" => "İ");
    $deger = strtr($deger, $lower_arr);
    $deger = mb_convert_case($deger, MB_CASE_TITLE, "UTF-8");
    return $deger;
}
?>
<?php
function date_tr($f, $zt = 'now'){
    $z = date("$f", strtotime($zt));
    $donustur = array(
        'Monday'	=> 'Pazartesi',
        'Tuesday'	=> 'Salı',
        'Wednesday'	=> 'Çarşamba',
        'Thursday'	=> 'Perşembe',
        'Friday'	=> 'Cuma',
        'Saturday'	=> 'Cumartesi',
        'Sunday'	=> 'Pazar',
        'January'	=> 'Ocak',
        'February'	=> 'Şubat',
        'March'		=> 'Mart',
        'April'		=> 'Nisan',
        'May'		=> 'Mayıs',
        'June'		=> 'Haziran',
        'July'		=> 'Temmuz',
        'August'	=> 'Ağustos',
        'September'	=> 'Eylül',
        'October'	=> 'Ekim',
        'November'	=> 'Kasım',
        'December'	=> 'Aralık',
        'Mon'		=> 'Pts',
        'Tue'		=> 'Sal',
        'Wed'		=> 'Çar',
        'Thu'		=> 'Per',
        'Fri'		=> 'Cum',
        'Sat'		=> 'Cts',
        'Sun'		=> 'Paz',
        'Jan'		=> 'Oca',
        'Feb'		=> 'Şub',
        'Mar'		=> 'Mar',
        'Apr'		=> 'Nis',
        'Jun'		=> 'Haz',
        'Jul'		=> 'Tem',
        'Aug'		=> 'Ağu',
        'Sep'		=> 'Eyl',
        'Oct'		=> 'Eki',
        'Nov'		=> 'Kas',
        'Dec'		=> 'Ara',
    );
    foreach($donustur as $en => $tr){
        $z = str_replace($en, $tr, $z);
    }
    if(strpos($z, 'Mayıs') !== false && strpos($f, 'F') === false) $z = str_replace('Mayıs', 'May', $z);
    return $z;
}
?>
<?php
function boslukSil($string)
{
    $string = preg_replace("/\s+/", "", $string);
    $string = trim($string);
    return $string;
}
?>
<?php
function temiz($text){
    $text = strip_tags($text);
    $text = preg_replace('/<a\s+.*?href="([^")]+)"[^>]*>([^<]+)<\/a>/is', '\2 (\1)', $text);
    $text = preg_replace('/<!--.+?-->/', '', $text);
    $text = preg_replace('/{.+?}/', '', $text);
    $text = preg_replace('/&nbsp;/', ' ', $text);
    $text = preg_replace('/&amp;/', ' ', $text);
    $text = preg_replace('/&quot;/', ' ', $text);
    $text = htmlspecialchars($text);
    $text = addslashes($text);
    return $text;
}

function gets($par) {
    $par = temiz(@$_GET[$par]);
    return $par;
}

function posts($par) {
    $par = htmlspecialchars(trim($_POST[$par]));
    return $par;
}
?>
