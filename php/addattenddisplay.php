<?php
$conn = mysqli_connect("localhost", "root", "", "students");

$array = json_decode(file_get_contents("php://input"));
$course     = mysqli_real_escape_string($conn, $array->course);
$section     = mysqli_real_escape_string($conn, $array->section);
$month=mysqli_real_escape_string($conn, $array->month);
$output=array();
$result3="";
$index=0;
$arr1=explode("-",$course);
$d=$arr1[0];
$e=$arr1[1];
$query ="SELECT cid FROM manage_sub WHERE scode='$d'";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_array($result)) {
    $cid=$row['cid'];
}
$query2 ="SELECT rollno FROM add_student WHERE cid='$cid'";
$result2 = mysqli_query($conn, $query2);
while ($row2 = mysqli_fetch_array($result2)) {
    $rollno=$row2['rollno'];
    $query3 ="SELECT * FROM manage_attend WHERE rollno='$rollno' AND month='$month' AND scode='$d'";
    $result3 = mysqli_query($conn, $query3);
    if(mysqli_num_rows($result3)>0){
        $index=$index+1;
    }else{
        if($e=="KANNADA" || $e=="HINDI" || $e=="SANSKRIT"){
            $query1 ="SELECT rollno,name,year,sem,course,section FROM add_student p1,manage_course p2,manage_section p3 WHERE p1.cid='$cid' AND p1.cid=p2.cid AND p1.sid=p3.sid AND p3.section='$section' AND lang='$e' AND rollno='$rollno'";
        }else{
            $query1 ="SELECT rollno,name,year,sem,course,section FROM add_student p1,manage_course p2,manage_section p3 WHERE p1.cid='$cid' AND p1.cid=p2.cid AND p1.sid=p3.sid AND p3.section='$section' AND rollno='$rollno'";
        }
        $result1 = mysqli_query($conn, $query1);
        while ($row1 = mysqli_fetch_array($result1)) {
            $output[]=$row1;
        }
    }
}
echo json_encode($output);