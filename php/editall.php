<?php
$conn = mysqli_connect("localhost", "root", "", "students");

$cid=array();
$ids=array();
$result4="";
$query="SELECT cid FROM add_student";
$result=mysqli_query($conn,$query);
while($r= mysqli_fetch_array($result)){
    $cid[]=$r['cid'];
}
$ids=array_filter($cid);
if (is_array($ids) || is_object($ids)){
    foreach($ids as $id){
        $query1="SELECT * FROM manage_course WHERE cid='$id'";
        $result1=mysqli_query($conn,$query1);
        while($r= mysqli_fetch_array($result1)){
            $year=$r['year'];
            $sem=$r['sem'];
            $course=$r['course'];
        }
        $query2="SELECT rollno FROM add_student WHERE cid='$id'";
        $result2=mysqli_query($conn,$query2);
        while($r= mysqli_fetch_array($result2)){
            $rollno=$r['rollno'];
        }
        if($year=="FIRST" && $sem=="I")
        {
            $year1="FIRST";
            $sem1="II";
            $course1=$course;
            $query3="SELECT cid FROM manage_course WHERE course='$course1' AND year='$year1' AND sem='$sem1'";
            $result3=mysqli_query($conn,$query3);
            if(mysqli_num_rows($result3)>0){
            while($r= mysqli_fetch_array($result3)){
                $cid1=$r['cid'];
            }
            $query4 = "UPDATE add_student SET cid='$cid1' where cid='$id' AND rollno='$rollno'";
            $result4=mysqli_query($conn, $query4);
            }
        }
        if($year=="FIRST" && $sem=="II")
        {
            $year1="SECOND";
            $sem1="III";
            $course1=$course;
            $query3="SELECT cid FROM manage_course WHERE course='$course1' AND year='$year1' AND sem='$sem1'";
            $result3=mysqli_query($conn,$query3);
            if(mysqli_num_rows($result3)>0){
            while($r= mysqli_fetch_array($result3)){
                $cid1=$r['cid'];
            }
            $query4 = "UPDATE add_student SET cid='$cid1' where cid='$id' AND rollno='$rollno'";
            $result4=mysqli_query($conn, $query4);
            }
        }
        if($year=="SECOND" && $sem=="III")
        {
            $year1="SECOND";
            $sem1="IV";
            $course1=$course;
            $query3="SELECT cid FROM manage_course WHERE course='$course1' AND year='$year1' AND sem='$sem1'";
            $result3=mysqli_query($conn,$query3);
            if(mysqli_num_rows($result3)>0){
            while($r= mysqli_fetch_array($result3)){
                $cid1=$r['cid'];
            }
            $query4 = "UPDATE add_student SET cid='$cid1' where cid='$id' AND rollno='$rollno'";
            $result4=mysqli_query($conn, $query4);
            }
        }
        if($year=="SECOND" && $sem=="IV")
        {
            $year1="THIRD";
            $sem1="V";
            $course1=$course;
            $query3="SELECT cid FROM manage_course WHERE course='$course1' AND year='$year1' AND sem='$sem1'";
            $result3=mysqli_query($conn,$query3);
            if(mysqli_num_rows($result3)>0){
            while($r= mysqli_fetch_array($result3)){
                $cid1=$r['cid'];
            }
            $query4 = "UPDATE add_student SET cid='$cid1' where cid='$id' AND rollno='$rollno'";
            $result4=mysqli_query($conn, $query4);
            }
        }
        if($year=="THIRD" && $sem=="V")
        {
            $year1="THIRD";
            $sem1="VI";
            $course1=$course;
            $query3="SELECT cid FROM manage_course WHERE course='$course1' AND year='$year1' AND sem='$sem1'";
            $result3=mysqli_query($conn,$query3);
            if(mysqli_num_rows($result3)>0){
            while($r= mysqli_fetch_array($result3)){
                $cid1=$r['cid'];
            }
            $query4 = "UPDATE add_student SET cid='$cid1' where cid='$id' AND rollno='$rollno'";
            $result4=mysqli_query($conn, $query4);
            }
        }
        if($year=="THIRD" && $sem=="VI")
        {
            $year1="THIRD";
            $sem1="VI";
            $course1=$course;
            $query3="SELECT cid FROM manage_course WHERE course='$course1' AND year='$year1' AND sem='$sem1'";
            $result3=mysqli_query($conn,$query3);
            if(mysqli_num_rows($result3)>0){
            while($r= mysqli_fetch_array($result3)){
                $cid1=$r['cid'];
            }
            $query4 = "DELETE FROM add_student WHERE cid='$cid1'";
            $result4=mysqli_query($conn, $query4);
            }
        }   
    }
}
if($result4){
    echo 'Data Updated Successfully';
}
else{
    echo 'Failed';
}