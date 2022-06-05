<?php
$conn = mysqli_connect("localhost", "root", "", "students");

$output=array();
$query ="select examid from manage_exam group by examid";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_array($result)) {
    $output[]=$row;
}
echo json_encode($output);
