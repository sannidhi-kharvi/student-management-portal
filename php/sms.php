<?php
$conn = mysqli_connect("localhost", "root", "", "students");

$array = json_decode(file_get_contents("php://input"));
$message = $array->message;
if(is_array($message)){
    $mes = json_encode($message);
}else{
    $mes = json_encode($message);
}
if($message==null){
    echo 'Please enter message';
}
$query = "SELECT phoneno from add_student";
$result=mysqli_query($conn, $query);
while($row=mysqli_fetch_array($result)){
    $phn=$row['phoneno'];
    //post
    $url="https://www.sms4india.com/api/v1/sendCampaign";
    $mes3=str_replace('"','',(string)$mes);
    $mes4=str_replace(']','',(string)$mes3);
    $mes5=str_replace('[','',(string)$mes4);
    $message1 = urlencode($mes5);// urlencode your message
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_POST, 1);// set post data to true
    curl_setopt($curl, CURLOPT_POSTFIELDS, "apikey=W3H0FU28CO88HT8OWP2YHRYO46A6QN45&secret=CM5HRP9TL468B8DP&usetype=stage&phone=$phn&senderid=SMSIND&message=$message1");// post data
    // query parameter values must be given without squarebrackets.
    // Optional Authentication:
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $result1 = curl_exec($curl);
    curl_close($curl);
    echo $result1;
}
