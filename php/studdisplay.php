<?php
$conn = mysqli_connect("localhost", "root", "", "students");

$output = array();
session_start();
    $type=$_SESSION['type'];
    $cid=$_SESSION['cid'];
    $sid=$_SESSION['sid'];
    $scode=$_SESSION['scode'];
    $username=$_SESSION['username'];
    $password=$_SESSION['password'];
    
if($username=="admin"){
    $query = "SELECT rollno,name,gender,dob,address,phoneno,year,sem,course,section,lang FROM add_student p1,manage_course p2,manage_section p3 where p2.cid=p1.cid AND p3.sid=p1.sid";
}else if($type=="Academic Advisor"){
    $query = "SELECT rollno,name,gender,dob,address,phoneno,year,sem,course,section,lang FROM add_student p1,manage_course p2,manage_section p3 where p2.cid=p1.cid AND p3.sid=p1.sid AND p2.cid='$cid' AND p3.sid='$sid'";
}
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $output[] = $row;
    }
    echo json_encode($output);
}else{
    $output[]="none";
    echo json_encode($output);  
}