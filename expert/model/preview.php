<?php
error_reporting(0);
//ob_start();
session_start();

function connection() {
    //  $servername = "localhost";
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


$ids = array();
$skill = array();
$sqlString = "";
$aboutyou=array();
$queryStr="";
$conn = connection();

if(isset($_POST['doc'])){
    $id = $_POST['doc'];
  //  echo 'ok here';
$sql = "SELECT user_id FROM skill WHERE skill like '%$id%'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $sqlString.=' user_id=' . $row['user_id'] . ' or ';
    }
   //  print_r($sqlString);
}
$queryStr = "SELECT * FROM aboutyou WHERE ";
$sqlString = substr($sqlString, 0, $sqlString . strlen($sqlString) - 4);
//$sql = "SELECT * FROM aboutyou WHERE user_id='$id'";
$result = $conn->query($queryStr.$sqlString);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        array_push($aboutyou, $row);
    }       
}

return;


}

$id=$_SESSION['id'];
$sql = "SELECT * FROM aboutyou WHERE user_id='$id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        array_push($aboutyou, $row);
    }
//            print_r($aboutyou);
}
