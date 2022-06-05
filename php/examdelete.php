<?php
$conn = mysqli_connect("localhost", "root", "", "students");

$array = json_decode(file_get_contents("php://input"));
if ($array) {
    $ename = $array->ename;
    $edate = $array->edate;
    $query="SELECT * FROM manage_exam WHERE ename='$ename' AND edate='$edate'";
    $result=mysqli_query($conn,$query);
    while($r=mysqli_fetch_array($result)){
       $examid=$r['examid'];
    }
    $query1 = "DELETE FROM manage_exam WHERE examid='$examid'";
    if (mysqli_query($conn, $query1)) {
        echo 'Data Deleted Successfully';
    } else {
        echo 'Failed';
    }
}
