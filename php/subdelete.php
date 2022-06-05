<?php
$conn = mysqli_connect("localhost", "root", "", "students");

$array = json_decode(file_get_contents("php://input"));
if ($array) {
    $scode = $array->scode;
    $query = "DELETE FROM manage_sub WHERE scode='$scode'";
    if (mysqli_query($conn, $query)) {
        echo 'Data Deleted Successfully';
    } else {
        echo 'Failed';
    }
}
