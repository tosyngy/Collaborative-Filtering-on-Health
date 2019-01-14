<?php

//ob_start();
session_start();

// Create connection
function connection() {
//  $servername = "192.168.43.110";
//     $ip = gethostbyname("");
//    echo $ip;
//    
//    
//    $servername = "$ip";
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "diagnosis";

//    $servername = "akudrawsecretscom.ipagemysql.com";
//    $username = "biodata";
//    $password = "biodata";
//    $dbname = "biodata";
    $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

if (isset($_GET["save"])) {
    insertIntoDB();
}

function insertIntoDB() {
    $conn = connection();
    $id = $_SESSION["id"];

    if ($_GET["save"] == "biodata") {
        $name = $_POST["name"];
        $occupation = $_POST["occupation"];
        $email = $_POST["email"];
        $facebook = $_POST["facebook"];
        $status = $_POST["status"];
        $img = $_POST["img"];
        $company = explode("__", $_POST["work"]);
        $company2 = "";
        $position = explode("__", $_POST["position"]);
        $position2 = "";
        $description = explode("__", $_POST["description"]);
        $description2 = "";
        $year = explode("__", $_POST["year"]);
        $yearn = "";
        $skill = explode(",", $_POST["skill"]);
        $about = $_POST["aboutyou"];
        $addr = $_POST["address"];
        $phone = $_POST["phone"];

        foreach ($company as $key => $value) {
            if (empty($value))
                continue;

            $company2.= $company[$key] . ',';
            $position2.=$position[$key] . ',';
            $description2.=$description[$key] . ',';
            $yearn.=$year[$key] . ',';
        }
        
       
            $sql = "UPDATE `diagnosis`.`aboutyou` SET `user_id` = '$id', `name` = '$name', `occupation` = '$occupation', `email` = '$email', `facebook` = '$facebook',  `my_status` = '$status',
                    `company` = '$company2', `position` = '$position2', `description` = '$description2', `year` = '$yearn',`phone` = '$phone', `address` = '$addr', `about` = '$about'
                         where user_id = '$id'";
      

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else if ($_GET["save"] == "experience") {
        $skill = explode(", ", $_POST["skill"]);

        $sql = "DELETE FROM skill where user_id='$id'";
        $conn->query($sql);
        foreach ($skill as $key => $value) {
            if (empty($value))
                continue;
            $sql = "INSERT INTO `skill` (`user_id`, `skill`) VALUES ('$id', '$value' ); ";
            if ($conn->query($sql) === TRUE) {
                //   echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }


        echo "New record created successfully";
    }
    $conn->close();
}
?>


