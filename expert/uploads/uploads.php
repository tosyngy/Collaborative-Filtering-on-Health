<?php
ob_start();
session_start();
if ((($_FILES["file_data"]["type"] == "image/gif") || ($_FILES["file_data"]["type"] == "image/jpeg") || ($_FILES["file_data"]["type"] == "image/png") || ($_FILES["file_data"]["type"] == "image/pjpeg"))) {

    $type = $_FILES["file_data"]["type"];
    $img = $_FILES["file_data"]["name"];
    $size = $_FILES["file_data"]["size"];
    $tmp = $_FILES["file_data"]["tmp_name"];
    $err = $_FILES["file_data"]["error"];
    if ($err > 0) {
        echo "Return Code: " . $err . "<br />";
    } else {
        $img = "";
        if (!isset($_GET["file_name"])) {
            do {
                for ($i = 0; $i < 20; $i++) {
                    $key = range(0, 9);
                    $img.= $key [array_rand($key)];
                }
            } while (file_exists($img . ".png"));
        } else if (isset($_GET["dir"]) && $_GET["dir"] == "1") {
            //$img = $_GET["file_name"];
            $img = "usr_profile/".$_GET["file_name"];
        }else {
          
        }
        move_uploaded_file($tmp, $img . ".png");
        echo "upload/" . $img . ".png";
       // chmod("upload/".$img.".jpg",0775);
    }
} else {
    echo 0;
}