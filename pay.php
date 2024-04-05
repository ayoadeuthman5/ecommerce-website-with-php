<?php
include "connection.inc.php";
include "functions.inc.php";
$status = $_GET['status'];
$tx_ref = $_GET['tx_ref'];
$transaction_id = $_GET['transaction_id'];


if($status == "successful"){
 
 $url = "https://api.flutterwave.com/v3/transactions/".$transaction_id."/verify"; //The URL given in the documentation without parameters
 $ch = curl_init();
 curl_setopt($ch, CURLOPT_URL, "$url");
 curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); //return as a variable
 $headers = [
    'Authorization: Bearer FLWSECK_TEST-7217e877679b0a5f959ea609fec91664-X'
  
  ];
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
 $response = curl_exec($ch);
 curl_close($ch);
//echo $response;
 //decode response to get trans_id,network,phone_number,amount,status and balance
 $array = json_decode($response, true); //decode the JSON response
 $pstatus = $array['data']['status'];
 $pamount = $array['data']['amount'];
 $pemail = $array['data']['customer']['email'];

 if($pstatus == "successful"){

    $sql = "UPDATE `order` SET payment_status = '$pstatus',flutter_id='$transaction_id' WHERE trans_id = '$tx_ref'";
    $res = mysqli_query($con,$sql);



    header("location: thank_you.php");

 }else{

    echo "<script>
    alert('Transaction not successful, kindly contact your bank suport if you have been debited');
    window.location.href = ''
    </script>";
    //header("location: index.php");

 }


}else{
    header("location: payment_fail.php");

}


?>