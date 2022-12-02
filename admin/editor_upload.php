<?php
// Allowed origins to upload images
$random = rand(0, 9999999999999);
if (empty($_SERVER['HTTPS'])) {
    $protokol2 = 'https://';
}
if (empty($_SERVER['HTTP'])) {
    $protokol = 'http://';
}
$accepted_origins = array($protokol.$_SERVER['SERVER_NAME'],$protokol2.$_SERVER['SERVER_NAME'],"http://localhost");

// Images upload path
$imageFolder = "../images/uploads/";

reset($_FILES);
$temp = current($_FILES);
if(is_uploaded_file($temp['tmp_name'])){
    if(isset($_SERVER['HTTP_ORIGIN'])) {
        // Same-origin requests won't set an origin. If the origin is set, it must be valid.
        if(in_array($_SERVER['HTTP_ORIGIN'], $accepted_origins)){
            header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
        }else{
            header("HTTP/1.1 403 Origin Denied");
            return;
        }
    }
  
    // Sanitize input
    if (preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $temp['name'])) {
        header("HTTP/1.1 400 Invalid file name.");
        return;
    }
  
    // Verify extension
    if (!in_array(strtolower(pathinfo($temp['name'], PATHINFO_EXTENSION)), array("gif", "jpg", "png"))) {
        header("HTTP/1.1 400 Invalid extension.");
        return;
    }
  
    // Accept upload if there was no origin, or if it is an accepted origin
    $filetowrite = $imageFolder . $random.$temp['name'];
    move_uploaded_file($temp['tmp_name'], $filetowrite);
  
    // Respond to the successful upload with JSON.
    // Use a location key to specify the path to the saved image resource.
    // { location : '/your/uploaded/image/file'}
    echo json_encode(array('location' => $filetowrite));
} else {
    // Notify editor that the upload failed
    header("HTTP/1.1 500 Server Error");
}
?>
