<?php
$conn = mysqli_connect("localhost", "root", "", "students");

$output=array();
$query ="select course from manage_course group by course";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_array($result)) {
    $output[]=$row;
}
echo json_encode($output);
