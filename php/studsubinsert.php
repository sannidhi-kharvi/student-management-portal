<?php
$conn = mysqli_connect("localhost", "root", "", "students");

$array = json_decode(file_get_contents("php://input"));
if ($array) {
    $rollno = mysqli_real_escape_string($conn, $array->rollno);
    $lang = mysqli_real_escape_string($conn, $array->lang);
    $btn_name = $array->btnName;
    if ($btn_name == "Update") {
        $rollno = $array->rollno;
        $query = "UPDATE add_student SET lang = '$lang' WHERE rollno = '$rollno'";
        if (mysqli_query($conn, $query)) {
            echo "Data Updated Successfully";
        } else {
            echo "Failed";
        }
    }
}