<?php
$conn = mysqli_connect("localhost", "root", "", "students");

$array = json_decode(file_get_contents("php://input"));
if ($array) {
    $rollno = mysqli_real_escape_string($conn, $array->rollno);
    $name = mysqli_real_escape_string($conn, $array->name);
    $gender = mysqli_real_escape_string($conn, $array->gender);
    $dob = mysqli_real_escape_string($conn, $array->dob);
    $address = mysqli_real_escape_string($conn, $array->address);
    $phoneno = mysqli_real_escape_string($conn, $array->phoneno);
    $year = mysqli_real_escape_string($conn, $array->year);
    $sem = mysqli_real_escape_string($conn, $array->sem);
    $course = mysqli_real_escape_string($conn, $array->course);
    $section = mysqli_real_escape_string($conn, $array->section);
    $btn_name = $array->btnName;
    $query="SELECT * FROM manage_course WHERE year='$year' AND sem='$sem' AND course='$course'";
    $result=mysqli_query($conn,$query);
    if(mysqli_num_rows($result)>0){
        while($r= mysqli_fetch_array($result)){
            $cid=$r['cid'];
        }
        $query1="SELECT * FROM manage_section WHERE section='$section' AND cid='$cid'";
        $result1=mysqli_query($conn,$query1);
        if(mysqli_num_rows($result1)>0){
            while($r= mysqli_fetch_array($result1)){
                $sid=$r['sid'];
            }
            if ($btn_name == "Insert") {
                $lang = mysqli_real_escape_string($conn, $array->lang);
                $query2 = "INSERT INTO add_student(rollno,name,gender,dob,address,phoneno,cid,sid,lang) VALUES ('$rollno','$name', '$gender', '$dob', '$address', '$phoneno', '$cid', '$sid','$lang')";
                if (mysqli_query($conn, $query2)) {
                    echo "Data Inserted Successfully";
                } else {
                    echo "Roll No Already exists";
                }
            }
            if ($btn_name == "Update") {
            $rollno = $array->rollno;
            $query2 = "UPDATE add_student SET name = '$name', gender = '$gender', dob = '$dob', address = '$address', phoneno = '$phoneno' , cid='$cid', sid='$sid' WHERE rollno = '$rollno'";
                if (mysqli_query($conn, $query2)) {
                    echo "Data Updated Successfully";
                } else {
                    echo "Failed";
                }
            }
        } else {
            echo "Record Not Exists";
        }
    } else {
        echo "Record Not Exists";
    }
}