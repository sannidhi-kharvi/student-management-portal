<?php
$conn = mysqli_connect("localhost", "root", "", "students");

$query = "SELECT rollno,name,gender,dob,address,phoneno,year,sem,course,section FROM add_student p1,manage_course p2,manage_section p3 where p2.cid=p1.cid AND p3.sid=p1.sid AND year='THIRD' AND sem='VI'";
$output = array();
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $output[] = $row;
    }
    echo json_encode($output);
} else {
    $output[]="none";
    echo json_encode($output);  
}

