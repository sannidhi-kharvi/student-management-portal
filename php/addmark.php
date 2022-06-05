<?php
$conn = mysqli_connect("localhost", "root", "", "students");

$array = json_decode(file_get_contents("php://input"), true);
$index=0;
$index1=0;
$index3=0;
$index6=0;
$index7=0;
$index8=0;
$index9=0;
$marks_obtain=0;
$result2="";
$result4="";
$item1=array();
$item2=array();
$item3=array();
if (is_array($array) || is_object($array)){
    foreach($array as $row){
        if($index6==0){
            $item4=$row["max"];
        }
        $index6=$index6+1;
        if(isset($row["marks_obtain"])){
            $marks_obtain=$row["marks_obtain"];
            if($marks_obtain>$item4){
                $index9=$index9+1;
            }
            $index8=$index8+1;
            $index=0;
        }else{
            $index7=$index7+1;
        }
    }
}else{
    echo 'Record Already Exists';
}
if($index9<1){
    if($index7<=0){
        if (is_array($array) || is_object($array)){
            foreach($array as $row){ 
                $rollno=$row["rollno"];
                if($index3==0){
                    $item1[]=$row["examid"];
                    if($item1[0]!=null){
                        $arr=explode("/",$item1[0]);
                        $a=$arr[0];
                        $b=$arr[1];
                        $query1="SELECT examid FROM manage_exam WHERE ename='$a' AND edate='$b'";
                        $result1= mysqli_query($conn, $query1);
                        while($r=mysqli_fetch_array($result1)){
                            $c=$r['examid'];
                        }
                        $item2[]=$row["scode"];
                        $arr1=explode("-",$item2[0]);
                        $d=$arr1[0];
                        $e=$arr1[1];
                        $item3[]=$row["max"];
                    }else{
                        $index1=$index1+1;
                    }
                }
                $index3=$index3+1;
                if($item1[0]!=null){
                    $query3="SELECT * FROM manage_marks WHERE examid='$c' AND scode='$d' AND rollno='$rollno'";
                    $result2= mysqli_query($conn, $query3);
                    if(mysqli_num_rows($result2)>0){
                        $index=$index+1;
                    }else{
                        $query = "INSERT INTO manage_marks(rollno,examid,scode,max_marks,marks_obtain) VALUES (".$rollno.",".$c.",'".$d."',".$item3[0].",".$row["marks_obtain"].")"; 
                        $result4=mysqli_query($conn, $query);
                    }
                }
            }
        }
    }else{
         echo 'Please Enter Marks obtained';
    }
}else{
     echo 'Maximum Marks Should be greater Than Marks Obtained';
}
if($result4){
    echo 'Data Inserted Successfully';
}
if($index>0){
 echo 'Marks for this exam Already Exists';
}
if($index1>0){
    echo 'Please Select Exam';
}