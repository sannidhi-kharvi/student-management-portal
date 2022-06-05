<?php
$conn = mysqli_connect("localhost", "root", "", "students");

$array = json_decode(file_get_contents("php://input"));
$sem = mysqli_real_escape_string($conn, $array->sem);
$output=array();
session_start();
    $type=$_SESSION['type'];
    $cid=$_SESSION['cid'];
    $sid=$_SESSION['sid'];
    $scode=$_SESSION['scode'];
    $username=$_SESSION['username'];
    $password=$_SESSION['password'];
    
if(isset($sem)){
    if($username=="admin")
    {
        $query = "SELECT p2.rollno,name,year,sem,course,section,ename,edate,p2.scode,sname,max_marks,marks_obtain FROM add_student p1,manage_marks p2,manage_exam p3,manage_course p4,manage_section p5,manage_sub p6 where p1.rollno=p2.rollno AND p3.examid=p2.examid AND p4.cid=p1.cid AND p5.sid=p1.sid AND p2.scode=p6.scode AND sem LIKE '$sem'";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_array($result)) {
            $output[] = $row;
        }
        echo json_encode($output);
    }
    else if($type=="Academic Advisor"){
        $query = "SELECT p2.rollno,name,year,sem,course,section,ename,edate,p2.scode,sname,max_marks,marks_obtain FROM add_student p1,manage_marks p2,manage_exam p3,manage_course p4,manage_section p5,manage_sub p6 where p1.rollno=p2.rollno AND p3.examid=p2.examid AND p4.cid=p1.cid AND p5.sid=p1.sid AND p2.scode=p6.scode AND p4.cid='$cid' AND p5.sid='$sid' AND sem LIKE '$sem'";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_array($result)) {
            $output[] = $row;
        }
        echo json_encode($output);
    }
    else if($type=="Subject Lecturer"){
        $piece= explode(",", $scode);
        foreach ($piece as $i){
            $query = "SELECT p2.rollno,name,year,sem,course,section,CONCAT(ename,'/',edate) AS examid,ename,edate,p2.scode,sname,max_marks,marks_obtain FROM add_student p1,manage_marks p2,manage_exam p3,manage_course p4,manage_section p5,manage_sub p6 where p1.rollno=p2.rollno AND p3.examid=p2.examid AND p4.cid=p1.cid AND p5.sid=p1.sid AND p6.scode=p2.scode AND p6.scode='$i' AND sem LIKE '$sem'";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_array($result)) {
                $output[] = $row;
            }
        }
        echo json_encode($output);
    }
}