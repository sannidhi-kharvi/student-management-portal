<?php
$conn = mysqli_connect("localhost", "root", "", "students");

$array = json_decode(file_get_contents("php://input"));
if ($array) {
    $course = mysqli_real_escape_string($conn, $array->course);
    $section  = mysqli_real_escape_string($conn, $array->section);
    $pieces = explode(" ", $course);
    $piece1=$pieces[0];
    $piece2=$pieces[2]; 
    $piece3=$pieces[4]; 
    $query="SELECT cid FROM manage_course WHERE year='$piece1' AND sem='$piece2' AND course='$piece3'";
    $result=mysqli_query($conn, $query);
    while($r=mysqli_fetch_array($result)){
        $cid=$r['cid'];
    }
    $query1="SELECT cid,section FROM manage_section WHERE cid='$cid' AND section='$section'";
    $result1=mysqli_query($conn, $query1);
    if(mysqli_num_rows($result1)>0){
         echo "Data Already Exists";
    }else {
        $btn_name = $array->btnName;
        if ($btn_name == "Insert") {
            $query2 = "INSERT INTO manage_section(cid,section) VALUES ('$cid','$section')";
            if (mysqli_query($conn, $query2)) {
                echo "Data Inserted Successfully";
            } else {
                echo "Not inserted";
            }
        }
    }
}
