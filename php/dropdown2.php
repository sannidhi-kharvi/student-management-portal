<?php
$conn = mysqli_connect("localhost", "root", "", "students");

$output=array();
$query="SELECT year FROM manage_course group by year";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_array($result)) {
    $output[]=$row;
}
echo json_encode($output);

