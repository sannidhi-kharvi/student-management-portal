<?php
$conn = mysqli_connect("localhost", "root", "", "students");

$array = json_decode(file_get_contents("php://input"), true);
$index1=0;
$index2=0;
$rno="";
$result3=0;
foreach($array as $row)
{
    $year=$row["year"];
    $sem=$row["sem"];
    $course=$row["course"];
    $section=$row["section"];
    $rollno=$row["rollno"];
    $query="SELECT rollno FROM add_student WHERE rollno='$rollno'";
    $result= mysqli_query($conn, $query);
    if(mysqli_num_rows($result)>0){
        $rno.=$rollno.",";
    }else{
        $query1="SELECT cid FROM manage_course WHERE year='$year' AND sem='$sem' AND course='$course'";
        $result1= mysqli_query($conn, $query1);
        if(mysqli_num_rows($result1)>0){
            while($r=mysqli_fetch_array($result1)){
                $cid=$r['cid'];
            }
            $query2="SELECT sid,cid,section FROM manage_section WHERE cid='$cid' AND section='$section'";
            $result2= mysqli_query($conn, $query2);
            if(mysqli_num_rows($result2)>0){
                while($r=mysqli_fetch_array($result2)){
                    $sid=$r['sid'];
                }
                $query3 = "INSERT INTO add_student(rollno,name,gender,dob,address,phoneno,cid,sid,lang) VALUES (".$row["rollno"].", '".$row["name"]."', '".$row["gender"]."','".$row["dob"]."','".$row["address"]."',".$row["phoneno"].",".$cid.",".$sid.",'".$row['lang']."')"; 
                $result3=mysqli_query($conn, $query3);
                if($result3){
                    $index1=$index1+1;
                }
            }else{
                $index2=$index2+1;
            }
        }else{
            $index2=$index2+1;
        }
    }
}
if($index1>0){
    echo $index1 .' Record Inserted'."\n";
}
if($index2>0){
    echo $index2 .' Record Not Inserted'."\n";
}
if(mysqli_num_rows($result)>0){
    echo $rno. ' Already Exists'."\n";
}