<?php
$conn = mysqli_connect("localhost", "root", "", "students");

$array = json_decode(file_get_contents("php://input"));
if ($array) {
    $section    = $array->section;
    $query="SELECT * FROM manage_section WHERE section='$section'";
    $result=mysqli_query($conn,$query);
    while($r=mysqli_fetch_array($result)){
        $sid=$r['sid'];
    }
    $query1 = "DELETE FROM manage_section WHERE sid='$sid'";
    if (mysqli_query($conn, $query1)) {
        echo 'Data Deleted Successfully';
    } else {
        echo 'Failed';
    }
}

    