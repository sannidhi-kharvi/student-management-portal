<?php
$conn = mysqli_connect("localhost", "root", "", "students");

$array = json_decode(file_get_contents("php://input"));
if ($array) {
    $lid = mysqli_real_escape_string($conn, $array->lid);
    $lname = mysqli_real_escape_string($conn, $array->lname);
    $pass = mysqli_real_escape_string($conn, $array->pass);
    $type = mysqli_real_escape_string($conn, $array->type);  
    if($type=="Academic Advisor"){
        $course = mysqli_real_escape_string($conn, $array->course);
        $section = mysqli_real_escape_string($conn, $array->section);
        $pieces = explode(" ", $course);
        $piece1=$pieces[0];
        $piece2=$pieces[2]; 
        $piece3=$pieces[4]; 
        $query="SELECT cid FROM manage_course WHERE year='$piece1' AND sem='$piece2' AND course='$piece3'";
        $result=mysqli_query($conn, $query);
        if(mysqli_num_rows($result)>0){
            while($r=mysqli_fetch_array($result)){
                $cid=$r['cid'];
            }
            $query1="SELECT sid FROM manage_section WHERE section='$section' AND cid='$cid'";
            $result1=mysqli_query($conn, $query1);
            if(mysqli_num_rows($result1)>0){
                while($r1=mysqli_fetch_array($result1)){
                    $hello6=$r1['sid'];
                }
                $btn_name = $array->btnName;
                if ($btn_name == "Insert") {
                    $query2 = "INSERT INTO manage_user(lid,lname,pass,type,cid,sid) VALUES ('$lid','$lname', '$pass','$type','$cid','$hello6')";
                    if (mysqli_query($conn, $query2)) {
                        echo "Data Inserted Successfully";
                    } else {
                        echo 'Lecturer Id Already Exists';
                    }
                }
                if ($btn_name == 'Update') { 
                    $query2 = "UPDATE manage_user SET lname = '$lname', pass = '$pass',type = '$type',cid = '$cid',sid = '$hello6' WHERE lid = '$lid'";
                    if (mysqli_query($conn, $query2)) {
                        echo 'Data Updated Successfully';
                    } else {
                        echo 'Lecturer Id Already Exists';
                    }
                }
            }else{
                echo 'Record Not Exists...';
            }
        }else{
            echo 'Record Not Exists...';
        }
    }else{
        $scode = mysqli_real_escape_string($conn, $array->scode); 
        $btn_name = $array->btnName;
        if ($btn_name == "Insert") {
            $query2 = "INSERT INTO manage_user(lid,lname,pass,type,scode) VALUES ('$lid','$lname', '$pass','$type','$scode')";
            if (mysqli_query($conn, $query2)) {
                echo "Data Inserted Successfully";
            } else {
                echo 'Lecturer Id Already Exists';
            }
        }
        if ($btn_name == 'Update') { 
            $query2 = "UPDATE manage_user SET lname = '$lname', pass = '$pass',type = '$type',scode = '$scode' WHERE lid = '$lid'";
            if (mysqli_query($conn, $query2)) {
                echo 'Data Updated Successfully';
            } else {
                echo 'Lecturer Id Already Exists';
            }
        }   
    } 
}