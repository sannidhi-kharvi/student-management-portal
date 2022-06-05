<?php
$conn = mysqli_connect("localhost", "root", "", "students");

$query="SELECT lid,lname,pass,type,p2.scode,section,CONCAT(year,' YEAR ',sem,' SEM ',course) AS course FROM manage_course p1,manage_user p2,manage_sub p3,manage_section p4 WHERE p2.sid=p4.sid AND p2.cid=p1.cid AND p2.type='Academic Advisor' OR p2.type='Subject Lecturer' group by p2.lid";
$output=array();
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_array($result)) {
    $output[] = $row;
}
echo json_encode($output);
