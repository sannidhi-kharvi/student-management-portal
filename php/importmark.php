<?php
$conn = mysqli_connect("localhost", "root", "", "students");

$sqldate="";
$rno="";
$exists="";
$index1=0;
$index2=0;
$index3=0;
$lang="";
$examid="";
$array = json_decode(file_get_contents("php://input"), true);
foreach($array as $row)
{
    $scode=null;
    $rollno=$row["rollno"];
    $ename=$row["ename"];
    $edate=$row["edate"];
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
        $sqldate=date('Y-m-d', strtotime($edate));
        $query6="SELECT examid FROM manage_exam WHERE ename='$ename' AND edate='$sqldate'";
        $result6=mysqli_query($conn, $query6);
        if(mysqli_num_rows($result6)>0){
            while($r=mysqli_fetch_array($result6)){
                $examid=$r['examid'];
            }
        }else{
            $index2=$index2+1;
            $rno.=$rollno.","; 
        }
        $query4="SELECT * FROM manage_marks WHERE scode='$scode' AND examid='$examid' AND rollno='$rollno'";
        $result4= mysqli_query($conn, $query4);
        if(mysqli_num_rows($result4)>0){
            $exists.=$rollno.",";
            $index3=$index3+1;
        }else{
            $query7 = "INSERT INTO manage_marks(rollno,scode,examid,max_marks,marks_obtain) VALUES (".$row["rollno"].", '".$scode."', ".$examid.",".$row["max_marks"].",".$row["marks_obtain"].")"; 
            $result7=mysqli_query($conn, $query7);
            if($result7){
                $index1=$index1+1;
            }
        }
    }
}
if($index1>0){
    echo $index1.' Record Inserted'."\n";
}
if($index2>0){
    $index2=$index2-1;
    echo $index2.' Record Not Inserted'."\n";
}
if($index3>0){
    echo $exists.' Already Exists'."\n";
}