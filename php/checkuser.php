<?php
$conn = mysqli_connect("localhost", "root", "", "students");

session_start();
if(!isset($_SESSION['username'])){
    $output[]="user";
    echo json_encode($output);
    exit();
} 

$username=$_SESSION['username'];
$password=$_SESSION['password']; 
if($username=="admin"){
    $output[]="admin";
    echo json_encode($output);
    exit();
}
$type=$_SESSION['type'];
if($type=="Academic Advisor"){
    $output[]="Academic Advisor";
    echo json_encode($output);
}else if($type=="Subject Lecturer"){
    $output[]="Subject Lecturer";
    echo json_encode($output);
}