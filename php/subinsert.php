<?php
$conn = mysqli_connect("localhost", "root", "", "students");

$array = json_decode(file_get_contents("php://input"));
if ($array) {
    $course = mysqli_real_escape_string($conn, $array->course);
    $scode = mysqli_real_escape_string($conn, $array->scode);
    $sname = mysqli_real_escape_string($conn, $array->sname);
    $pieces = explode(" ", $course);
    $piece1= $pieces[0];
    $piece2= $pieces[2]; 
    $piece3=$pieces[4]; 
    $query="SELECT cid FROM manage_course WHERE year='$piece1' AND sem='$piece2' AND course='$piece3'";
    $result=mysqli_query($conn, $query);
    while($r=mysqli_fetch_array($result)){
        $cid=$r['cid'];
    }
    $query1="SELECT cid,sname FROM manage_sub WHERE cid='$cid' AND sname='$sname'";
    $result1=mysqli_query($conn, $query1);
    if(mysqli_num_rows($result1)>0){
         echo "Data Already Exists";
    }else{ 
        $btn_name = $array->btnName;
        if ($btn_name == "Insert") {
            $query2 = "INSERT INTO manage_sub(cid,scode,sname) VALUES ('$cid','$scode','$sname')";
            if (mysqli_query($conn, $query2)) {
                echo "Data Inserted Successfully";
            } else {
                echo 'Data Already Exists';
            }
        }
    }
}
