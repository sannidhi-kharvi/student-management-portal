<?php
$conn = mysqli_connect("localhost", "root", "", "students");

$array = json_decode(file_get_contents("php://input"));
if ($array) {
    $rollno = mysqli_real_escape_string($conn, $array->rollno);
    $scode = mysqli_real_escape_string($conn, $array->scode);
    $month = mysqli_real_escape_string($conn, $array->month);
    $btn_name = $array->btnName;
    if ($btn_name == "Update") {
        $rollno = $array->rollno;
        $class_attend        = mysqli_real_escape_string($conn, $array->class_attend);
        $query = "UPDATE manage_attend SET class_attend = '$class_attend' WHERE rollno = '$rollno' AND scode='$scode' AND month='$month'";
        if (mysqli_query($conn, $query)) {
            echo "Data Updated Successfully";
        } else {
            echo "Failed";
        }
    }
    if ($btn_name == "Delete") {
        $rollno = $array->rollno;
        $month=$array->month;
        $scode=$array->scode;
        $query = "DELETE FROM manage_attend WHERE rollno = '$rollno' AND scode='$scode' AND month='$month'";
        if (mysqli_query($conn, $query)) {
            echo "Data Deleted Successfully";
        } else {
            echo "Failed";
        }
    }
}