<?php
$conn = mysqli_connect("localhost", "root", "", "students");

$array = json_decode(file_get_contents("php://input"));
if ($array) {
    $year = mysqli_real_escape_string($conn, $array->year);
    $sem = mysqli_real_escape_string($conn, $array->sem);
    $course = mysqli_real_escape_string($conn, $array->course);
    $t="SELECT year,sem,course FROM manage_course WHERE year='$year' AND sem='$sem' AND course='$course'";
    $result= mysqli_query($conn, $t);
    if(mysqli_num_rows($result)>0){
        echo "Already Exists";  
    }else{
        $btn_name = $array->btnName;
        if ($btn_name == "Insert") {
            $query = "INSERT INTO manage_course(year,sem,course) VALUES ('$year','$sem','$course')";
            if (mysqli_query($conn, $query)) {
                echo "Data Inserted Successfully";
            } else {
                echo 'Failed';
            }
        }
    }
}
