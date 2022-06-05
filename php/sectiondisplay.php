<?php
$conn = mysqli_connect("localhost", "root", "", "students");

$query = "SELECT course,sem,year,section,sid FROM manage_section p1,manage_course p2 WHERE p2.cid=p1.cid";
$output = array();
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $output[] = $row;
    }
    echo json_encode($output);
}
