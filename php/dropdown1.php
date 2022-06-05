<?php
$conn = mysqli_connect("localhost", "root", "", "students");

$output=array();
$query="SELECT CONCAT(year,' YEAR ',sem,' SEM ',course)AS course FROM manage_course";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_array($result)) {
    $output[]=$row;
}
echo json_encode($output);

