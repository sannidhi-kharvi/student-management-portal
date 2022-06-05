<?php
$conn = mysqli_connect("localhost", "root", "", "students");

$output=array();
session_start();
    $type=$_SESSION['type'];
    $username=$_SESSION['username'];
    $password=$_SESSION['password'];
    $user=$_SESSION['lid'];
    
if($username=="admin"){
    $query = "SELECT CONCAT(scode,'-',sname) AS scode from manage_sub";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_array($result)) {
        $output[] = $row;
    }
   echo json_encode($output);
}
else if($type=="Subject Lecturer"){
    $query1 = "SELECT scode FROM manage_user WHERE lid='$user'";
    $result1 = mysqli_query($conn, $query1);
    while ($row1 = mysqli_fetch_array($result1)) {
        $output1= $row1['scode'];
    }
    $piece= explode(",", $output1);
    foreach ($piece as $i){
        $query = "SELECT CONCAT(scode,'-',sname) AS scode from manage_sub WHERE scode='$i'";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_array($result)) {
            $output[] = $row;
        }
    }
   echo json_encode($output);
}