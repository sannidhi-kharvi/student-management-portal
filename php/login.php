<?php
$conn = mysqli_connect("localhost", "root", "", "students");

$array = json_decode(file_get_contents("php://input"));
if($array){
    session_start();
    $username = mysqli_real_escape_string($conn,$array->username);
    $password = mysqli_real_escape_string($conn,$array->password);
    $adminuser="admin";
    $adminpass="admin";

    $query = "select lid,type,pass,cid,sid,scode from manage_user";
    $result = mysqli_query($conn,$query);
    if($username==$adminuser && $password==$adminpass){
        echo "Login Successful";
        $_SESSION['username']=$username;
        $_SESSION['password']=$password;
    }
    while($r=mysqli_fetch_array($result))
    {
        $user=$r['lid'];
        $pass=$r['pass'];
        $type=$r['type'];
        $cid=$r['cid'];
        $sid=$r['sid'];
        $scode=$r['scode'];
        $_SESSION['lid']=$user;
        $_SESSION['type']=$type;
        $_SESSION['cid']=$cid;
        $_SESSION['sid']=$sid;
        $_SESSION['scode']=$scode;
        if($username==$user && $password==$pass){
            $_SESSION['username']=$username;
            $_SESSION['password']=$password;
            if($type=="Subject Lecturer"){
                echo "Login Successful";
                exit();
            }else{
                echo "Login Successful";
                exit();
            }
        }
    }
    if($username!=$adminuser || $password!=$adminpass){
        echo "Login Unsuccessful";
    }         
}