<?php
$conn = mysqli_connect("localhost", "root", "", "students");

$array = json_decode(file_get_contents("php://input"));
if ($array) {
    $rollno = mysqli_real_escape_string($conn, $array->rollno);
    $scode = mysqli_real_escape_string($conn, $array->scode);
    $ename = mysqli_real_escape_string($conn, $array->ename);
    $edate = mysqli_real_escape_string($conn, $array->edate);
    $query="SELECT examid FROM manage_exam WHERE ename='$ename' AND edate='$edate'";
    $result= mysqli_query($conn, $query);
    while($r= mysqli_fetch_array($result)){
        $examid=$r['examid'];
    }
    $btn_name = $array->btnName;
    if ($btn_name == "Update") {
        $rollno = $array->rollno;
        $marks_obtain = mysqli_real_escape_string($conn, $array->marks_obtain);
        $query1 = "UPDATE manage_marks SET marks_obtain = '$marks_obtain' WHERE rollno = '$rollno' AND scode='$scode' AND examid='$examid'";
        if (mysqli_query($conn, $query1)) {
            echo "Data Updated Successfully";
        } else {
            echo "Failed";
        }
    }
    if ($btn_name == "Delete") {
        $rollno = $array->rollno;
        $scode = $array->scode;
        $query1 = "DELETE FROM manage_marks WHERE rollno = '$rollno' AND scode='$scode' AND examid='$examid'";
        if (mysqli_query($conn, $query1)) {
            echo "Data Deleted Successfully";
        } else {
            echo "Failed";
        }
    }
}