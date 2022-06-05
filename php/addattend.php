<?php
$conn = mysqli_connect("localhost", "root", "", "students");

$array = json_decode(file_get_contents("php://input"), true);
$index=0;
$index1=0;
$index3=0;
$index4=0;
$index5=0;
$index6=0;
$index7=0;
$index8=0;
$index9=0;
$item1=array();
$item2=array();
$item3=array();
$result1="";
if (is_array($array) || is_object($array)){
    foreach($array as $row){
        if($index9==0){
            $class_hld=$row["class_held"];
        }
        $index9=$index9+1;
        if(isset($row["class_attend"])){
            $class_atnd=$row["class_attend"];
            if($class_atnd>$class_hld){
                $index8=$index8+1;
            }
            $index6=$index6+1;
            $index=0;
        }else{
            $index7=$index7+1;
        }
    }
}else{
    echo 'Record Already Exists';
}
if($index8<1){
    if($index7<=0){
        if (is_array($array) || is_object($array)){    
            foreach($array as $row){ 
                $index7=0;
                $rollno=$row["rollno"];
                if($index==0){
                    $item1[]=$row["scode"];
                }
                $index=$index+1;
                $arr1=explode("-",$item1[0]);
                $d=$arr1[0];
                $e=$arr1[1];
                if($index1==0){
                    $item2[]=$row["month"];
                    $item3[]=$row["class_held"];
                    $month= date('m');
                    $month_name=date("F", mktime(0,0,0,$month,10));
                }
                $index1=$index1+1;
                $query3="SELECT * FROM manage_attend WHERE month='$item2[0]' AND scode='$d' AND rollno='$rollno'";
                $result2= mysqli_query($conn, $query3);
                if(mysqli_num_rows($result2)>0){
                   $index4=$index4+1;
                }else{
                    if($item2[0]!=null){
                        if(strtoupper($month_name)==$item2[0]){
                            $query = "INSERT INTO manage_attend(rollno,scode,month,class_held,class_attend) VALUES (".$rollno.",'".$d."','".$item2[0]."',".$item3[0].",".$row["class_attend"].")"; 
                            $result1=mysqli_query($conn, $query);
                        }else{
                            $index3=$index3+1;
                        }
                    }else{
                        $index5=$index5+1;
                    }
                }
            }
        }
    }else{
        echo 'Please Enter Class Attend';
    }
}else{
    echo 'Class held should be greater than Class Attended';
}
if($result1){
    echo 'Data Inserted Successfully';
}
if($index3>=1){
    echo 'Select Current Month';
}
if($index4>0){
    echo 'Attendance for this month Already Exists';
}
if($index5>0){
    echo 'Please Select Month';
}