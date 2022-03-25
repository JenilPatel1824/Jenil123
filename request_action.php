<?php
session_start();
require("database.php");
$sql = "select mobile_no from user_info where account_no=".$_SESSION['acc'] ;
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
if(isset($_POST['allow'])){

//send otp

session_start();

 //$otp = rand(1111,9999);
//$_SESSION['pin'] = $otp;
   // $to = $_POST['contact'];
//$_SESSION['to'] = $to;
$post_data = array(
    // 'From' doesn't matter; For transactional, this will be replaced with your SenderId;
    // For promotional, this will be ignored by the SMS gateway
   
    'From'   => '7048132133',
    'To'    => $row['mobile_no'],
    'Body'  => 'Congratulations! Your account is verified Successfully!. For login your account no is '.$_SESSION['acc'].'. thank you. by Bank of Surat(BOS).', //Incase you are wondering who Dr. Rajasekhar is http://en.wikipedia.org/wiki/Dr._Rajasekhar_(actor)
);
 
$exotel_sid = "student272"; // Your Exotel SID - Get it from here: http://my.exotel.in/Exotel/settings/site#api-settings
$exotel_token = "e0095220b5f8e7607a04bcf364437e594a19f5ed"; // Your exotel token - Get it from here: http://my.exotel.in/Exotel/settings/site#api-settings
 
$url = "https://".$exotel_sid.":".$exotel_token."@twilix.exotel.in/v1/Accounts/".$exotel_sid."/Sms/send";
 
$ch = curl_init();
curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FAILONERROR, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
 
$http_result = curl_exec($ch);
$error = curl_error($ch);
$http_code = curl_getinfo($ch ,CURLINFO_HTTP_CODE);
 
curl_close($ch);
 
//print "Response = ".print_r($http_result);





	$sql = "update user_info set status=1 where account_no=".$_SESSION['acc'] ;
    mysqli_query($conn,$sql);
    echo '<script type="text/javascript"> alert("has been allowed successfully.."); window.location = "requested_account.php" </script>';
   // header('location: requested_account.php');
}
if(isset($_POST['deny'])){


session_start();

 //$otp = rand(1111,9999);
//$_SESSION['pin'] = $otp;
   // $to = $_POST['contact'];
//$_SESSION['to'] = $to;
$post_data = array(
    // 'From' doesn't matter; For transactional, this will be replaced with your SenderId;
    // For promotional, this will be ignored by the SMS gateway
   
    'From'   => '7048132133',
    'To'    => $row['mobile_no'],
    'Body'  => 'Sorry! Your account verification is failed! contact your branch manager!. thank you. by Bank of Surat(BOS).', //Incase you are wondering who Dr. Rajasekhar is http://en.wikipedia.org/wiki/Dr._Rajasekhar_(actor)
);
 
$exotel_sid = "student272"; // Your Exotel SID - Get it from here: http://my.exotel.in/Exotel/settings/site#api-settings
$exotel_token = "e0095220b5f8e7607a04bcf364437e594a19f5ed"; // Your exotel token - Get it from here: http://my.exotel.in/Exotel/settings/site#api-settings
 
$url = "https://".$exotel_sid.":".$exotel_token."@twilix.exotel.in/v1/Accounts/".$exotel_sid."/Sms/send";
 
$ch = curl_init();
curl_setopt($ch, CURLOPT_VERBOSE, 1);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FAILONERROR, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
 
$http_result = curl_exec($ch);
$error = curl_error($ch);
$http_code = curl_getinfo($ch ,CURLINFO_HTTP_CODE);
 
curl_close($ch);
 
//print "Re






	$sql = "delete  from user_info where account_no=".$_SESSION['acc'];
    mysqli_query($conn,$sql);
   echo '<script type="text/javascript"> alert("has been deleted successfully.."); window.location = "requested_account.php" </script>';
    //header('location: requested_account.php');
}


?>