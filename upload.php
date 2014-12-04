<?php
//include("../function/conn.php");
//include("../function/function.php");
ini_set('display_errors',1);
error_reporting(E_ALL);
ini_set('log_errors',1);
ini_set('error_log','/var/www/meibao/log2');
file_put_contents('log',print_r($_FILES,1));
$target_dir = "data/";
$target_file = $target_dir . basename($_FILES["filename"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
$a = false;
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["filename"]["tmp_name"]);
    if($check !== false) {
//        echo "File is an image - " . $check["mime"] . ".";
        $a = move_uploaded_file($_FILES["filename"]["tmp_name"], 'a.jpg');
        $uploadOk = 1;
    } else {
        //      echo "File is not an image.";
        $uploadOk = 0;
    }
}
if($a == true)
    file_put_contents('log2','true');
else

    file_put_contents('log2','false');

echo $uploadOk;
