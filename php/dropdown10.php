<?php
$conn = mysqli_connect("localhost", "root", "", "students");

$output=array();
$query ="select CONCAT(ename,'/',edate) AS examid from manage_exam";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_array($result)) {
    $output[]=$row;
}
echo json_encode($output);
