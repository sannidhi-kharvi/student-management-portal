<?php
$conn = mysqli_connect("localhost", "root", "", "students");

$array = json_decode(file_get_contents("php://input"));
if ($array) {
    $rollno = $array->rollno;
    $query = "DELETE FROM add_student WHERE rollno='$rollno'";
    if (mysqli_query($conn, $query)) {
        echo 'Data Deleted Successfully';
    } else {
        echo 'Failed';
    }
}
