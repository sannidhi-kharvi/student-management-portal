<?php
$conn = mysqli_connect("localhost", "root", "", "students");

$array    = json_decode(file_get_contents("php://input"));
if ($array) {
    $lid    = $array->lid;
    $query = "DELETE FROM manage_user WHERE lid='$lid'";
    if (mysqli_query($conn, $query)) {
        echo 'Data Deleted Successfully';
    } else {
        echo 'Failed';
    }
}

    