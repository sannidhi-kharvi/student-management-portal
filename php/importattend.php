<?php
$conn = mysqli_connect("localhost", "root", "", "students");

$array = json_decode(file_get_contents("php://input"), true);
$result5="";
$rno="";
$exists="";
$index1=0;
$index2=0;
$index3=0;
foreach($array as $row)
{
    $scode=null;
    $rollno=$row["rollno"];
    $month=$row["month"];
    $query1="SELECT rollno FROM add_student WHERE rollno='$rollno'";
    $result1=mysqli_query($conn, $query1);
    if(mysqli_num_rows($result1)<=0){
        $index2=$index2+1;
        $rno.=$rollno.","; 
    }else{  
        $query2="SELECT cid FROM add_student WHERE rollno='$rollno'";
        $result2=mysqli_query($conn, $query2);
        while($r=mysqli_fetch_array($result2)){
            $cid=$r['cid'];
        }
        $sname=$row["sname"];
        if($sname=="KANNADA" || $sname=="HINDI" || $sname=="SANSKRIT"){
            $query5="SELECT lang FROM add_student WHERE rollno='$rollno'";
            $result5=mysqli_query($conn, $query5);
            while($r2=mysqli_fetch_array($result5)){
                $lang=$r2['lang'];
            }
            if($sname==$lang){
                $query3="SELECT scode FROM manage_sub WHERE sname='$sname' AND cid='$cid'";
            }else{
                $index2=$index2+1;
                $rno.=$rollno.",";
                continue;
            }
        }else{
            $query3="SELECT scode FROM manage_sub WHERE sname='$sname' AND cid='$cid'";
        }
        $result3=mysqli_query($conn, $query3);
        if(mysqli_num_rows($result3)>0){
            while($r1=mysqli_fetch_array($result3)){
                $scode=$r1['scode'];
            }
        }else{
            $index2=$index2+1;
            $rno.=$rollno.","; 
        }
        $query4="SELECT * FROM manage_attend WHERE scode='$scode' AND month='$month' AND rollno='$rollno'";
        $result4= mysqli_query($conn, $query4);
        if(mysqli_num_rows($result4)>0){
            $exists.=$rollno.",";
            $index3=$index3+1;
        }else{
            $query5 = "INSERT INTO manage_attend(rollno,month,scode,class_held,class_attend) VALUES (".$rollno.",'".$row["month"]."','".$scode."', ".$row["class_held"].", ".$row["class_attend"].")"; 
            $result5=mysqli_query($conn, $query5);
            if($result5){
                $index1=$index1+1;
            }
        }   
    }
}
if($index1>0){
    echo $index1.' Record Inserted'."\n";
}
if($index2>0){
    echo $index2.' Record Not Inserted'."\n";
}
if($index3>0){
    echo $exists.' Already Exists'."\n";
}
