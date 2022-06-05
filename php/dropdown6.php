<?php
$conn = mysqli_connect("localhost", "root", "", "students");

$output=array();
$query ="select scode,sname from manage_sub";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_array($result)) {
    $output[]=$row;
}
echo json_encode($output);
