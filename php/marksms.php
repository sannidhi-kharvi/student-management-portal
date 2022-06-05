<?php
$conn = mysqli_connect("localhost", "root", "", "students");
$array = json_decode(file_get_contents("php://input"),true);
$var8='';
$all1=array();
$all2=array();
$c=array();
if (is_array($array) || is_object($array)){
    foreach($array as $row){
        $all1[] =$row['rollno'];
        $all2[]=$row['examid'];
        $item1[]=$row["examid"];
        $arr=explode("/",$item1[0]);
        $a=$arr[0];
        $b=$arr[1];
        $query1="SELECT examid FROM manage_exam WHERE ename='$a' AND edate='$b'";
        $result1= mysqli_query($conn, $query1);
        while($r=mysqli_fetch_array($result1)){
            $c[]=$r['examid'];
        }
    }
    $hello1= array_unique($all1);
    $hello2= array_unique($c);
    foreach($hello2 as $row2){
        foreach($hello1 as $row1){
            $index1=0;
            $row1;
            $query1="SELECT p1.rollno,scode,max_marks,marks_obtain,phoneno,examid FROM manage_marks p1,add_student p2 WHERE p1.rollno='$row1' AND examid='$row2' AND p1.rollno=p2.rollno";
            $result1= mysqli_query($conn, $query1);
            while($r=mysqli_fetch_array($result1)){
                if($index1==0){
                    $var1=$r['examid'];
                    $query3="SELECT ename from manage_exam where examid='$var1'";
                    $result3= mysqli_query($conn, $query3);
                    while($row4=mysqli_fetch_array($result3)){
                        $var7=$row4['ename'];
                    }
                }
                $index1=$index1+1;
                $var2=$r['scode'];
                $query2="SELECT sname from manage_sub where scode='$var2'";
                $result2= mysqli_query($conn, $query2);
                while($row3=mysqli_fetch_array($result2)){
                    $var3=$row3['sname'];
                }
                $var4=$r['max_marks'];
                $var5=$r['marks_obtain'];
                $var6=$r['phoneno'];
                $var8.="Subject Name : ".$var3."\n"."Maximum Marks : ".$var4."\n"."Marks Obtained : ".$var5."\n";
            }
            $url="https://www.sms4india.com/api/v1/sendCampaign";
            $message = urlencode("RollNo : ".$row1."\n"."Exam Name : ".$var7."\n".$var8);// urlencode your message  
            $curl = curl_init();
            $var8='';
            curl_setopt($curl, CURLOPT_POST, 1);// set post data to true
            curl_setopt($curl, CURLOPT_POSTFIELDS, "apikey=W3H0FU28CO88HT8OWP2YHRYO46A6QN45&secret=CM5HRP9TL468B8DP&usetype=stage&phone=$var6&senderid=SMSIND&message=$message");// post data
            // query parameter values must be given without squarebrackets.
            // Optional Authentication:
            curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $result10 = curl_exec($curl);
            curl_close($curl);
            echo $result10;
        }
    }
}