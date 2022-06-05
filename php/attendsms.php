<?php
$conn = mysqli_connect("localhost", "root", "", "students");

$array = json_decode(file_get_contents("php://input"),true);
$var9='';
$all1=array();
$all2=array();
if (is_array($array) || is_object($array)){
    foreach($array as $row){
        $all1[] =$row['rollno'];
        $all2[]=$row['month'];
    }
    $hello1= array_unique($all1);
    $hello2= array_unique($all2);
    foreach($hello2 as $row2){
        foreach($hello1 as $row1){
            $index1=0;
            $query1="SELECT p1.rollno,scode,month,class_held,class_attend,phoneno FROM manage_attend p1,add_student p2 WHERE p1.rollno='$row1' AND month='$row2' AND p1.rollno=p2.rollno";
            $result1= mysqli_query($conn, $query1);
            while($r=mysqli_fetch_array($result1)){
                if($index1==0){
                    $var1=$r['month'];
                }
                $index1=$index1+1;
                $var2=$r['scode'];
                $query2="SELECT sname from manage_sub where scode='$var2'";
                $result2= mysqli_query($conn, $query2);
                while($row3=mysqli_fetch_array($result2)){
                    $var3=$row3['sname'];
                }
                $var4=$r['class_held'];
                $var5=$r['class_attend'];
                $var6=($var5 / $var4)*100;
                $var7=round($var6,2);
                $var8=$r['phoneno'];
                $var9.="Subject Name : ".$var3."\n"."Class Held : ".$var4."\n"."Class Attended : ".$var5."\n"."Percentage : ".$var7."%25"."\n";
            }
            //post
            $url="https://www.sms4india.com/api/v1/sendCampaign";
            $message = urlencode("RollNo : ".$row1."\n"."Month : ".$var1."\n".$var9);// urlencode your message   
            $curl = curl_init();
            $var9='';
            curl_setopt($curl, CURLOPT_POST, 1);// set post data to true
            curl_setopt($curl, CURLOPT_POSTFIELDS, "apikey=W3H0FU28CO88HT8OWP2YHRYO46A6QN45&secret=CM5HRP9TL468B8DP&usetype=stage&phone=$var8&senderid=SMSIND&message=$message");// post data
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
 