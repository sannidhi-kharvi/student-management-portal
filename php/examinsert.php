<?php
$conn = mysqli_connect("localhost", "root", "", "students");

$array = json_decode(file_get_contents("php://input"));
if ($array) {
    $ename = mysqli_real_escape_string($conn, $array->ename);
    $edate = mysqli_real_escape_string($conn, $array->edate);
    $btn_name = $array->btnName;
    if ($btn_name == "Insert") {
        $t="SELECT examid FROM manage_exam WHERE ename='$ename' AND edate='$edate'";
        $result= mysqli_query($conn, $t);
        if(mysqli_num_rows($result)>0){
            echo "Already Exists";  
        }else{
            $query = "INSERT INTO manage_exam(ename,edate) VALUES ('$ename','$edate')";
            if (mysqli_query($conn, $query)) {
                echo "Data Inserted Successfully";
            } else {
                echo 'Exam Already Exists';
            }
        }
    }
    if ($btn_name == 'Update') {
        $enam = $array->enam;
        $edat = $array->edat;
        $t="SELECT examid FROM manage_exam WHERE ename='$ename' AND edate='$edate'";
        $result= mysqli_query($conn, $t);
        if(mysqli_num_rows($result)>0){
            echo "Already Exists";  
        }else{
            $query1 = "UPDATE manage_exam SET edate = '$edate' WHERE ename='$enam' AND edate='$edat'";
            if (mysqli_query($conn, $query1)) {
                echo 'Data Updated Successfully';
            } else {
                echo 'Exam Already Exists';
            }
        }
    }
}
