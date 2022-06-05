<?php
$conn = mysqli_connect("localhost", "root", "", "students");

$array = json_decode(file_get_contents("php://input"));
if ($array) {
    $year = $array->year;
    $sem = $array->sem;
    $course = $array->course;
    $query = "DELETE FROM manage_course WHERE year='$year' && sem='$sem' && course='$course'";
    if (mysqli_query($conn, $query)) {
        echo 'Data Deleted Successfully';
    } else {
        echo 'Failed';
    }
}

    