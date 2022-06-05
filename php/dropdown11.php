<?php
$conn = mysqli_connect("localhost", "root", "", "students");

$output=array();
$array = json_decode(file_get_contents("php://input"));
$course = mysqli_real_escape_string($conn, $array->course);
$arr1=explode("-",$course);
$d=$arr1[0];
$e=$arr1[1];
$query ="SELECT cid FROM manage_sub WHERE scode='$d'";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_array($result)) {
    $cid=$row['cid'];
}
$query1 ="SELECT section FROM manage_section WHERE cid='$cid'";
$result1 = mysqli_query($conn, $query1);
while ($row1 = mysqli_fetch_array($result1)) {
    $output[]=$row1;
}
echo json_encode($output);
