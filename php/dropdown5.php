<?php
$conn = mysqli_connect("localhost", "root", "", "students");

$output=array();
$query ="select section from manage_section group by section";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_array($result)) {
    $output[]=$row;
}
echo json_encode($output);
