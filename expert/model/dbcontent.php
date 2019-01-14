<?php

//ob_start();
//session_start();

function connection() {



     //$servername = "192.168.43.110";
//    $ip = gethostbyname("");
//    echo $ip;
//    
//    
//    $servername = "$ip";
    $servername = "localhost";
    $username = "root"; 
    $password = "";
     $dbname = "diagnosis";
     
    //echo $_SERVER['server_address'];

   // $host = gethostbyname();
    

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

$id = $_SESSION["id"];
$aboutyou = array();
$skill = "";
$conn = connection();
$sql = "SELECT * FROM aboutyou WHERE user_id='$id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        array_push($aboutyou, $row);
    }
//            print_r($aboutyou);
}

$sql = "SELECT skill FROM skill WHERE user_id='$id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $skill.= $row["skill"] . ",";
    }
//            print_r($skill);
}