<?php
session_start();
if(!isset($_SESSION['account_no']))
header('location:index.php');

?>

<?php
require('database.php');
session_start();
$pwd = $_POST['pwd'];
$amt = $_GET['amount'];
$query = 'SELECT password,mobile_no FROM user_info WHERE account_no = '.$_SESSION['account_no'];
$result = mysqli_query($conn,$query);
$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
$mobiles = $row['mobile_no'];
if($row['password'] != $pwd){
$m =1;
echo '<script>alert("Password Incorrect! , Transaction failed!");</script>';
header('refresh:0.01;url=operations_customer.php');

}
if($m != 1){
$query = 'SELECT balance FROM user_info WHERE account_no = '.$_SESSION['account_no'];
$result = mysqli_query($conn,$query);
$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
$debit = $row['balance'];
$debit = $debit - $amt ;
$query = 'SELECT balance,mobile_no FROM user_info WHERE account_no = '.$_SESSION['to'];
$result = mysqli_query($conn,$query);
$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
$mobiles_to = $row['mobile_no'];
$credit = $row['balance'];
$credit = $credit + $amt;
$query = 'update user_info set balance = '.$debit.' WHERE account_no = '.$_SESSION['account_no'];
mysqli_query($conn,$query);
$query = 'update user_info set balance = '.$credit.' WHERE account_no = '.$_SESSION['to'];
mysqli_query($conn,$query);
date_default_timezone_set('Asia/Kolkata');
$year = date("y") + 5;
$month = date("m");
$upto = $month.'/'.$year;
$date = date("Y-m-d");
$mydate = getdate(date("U"));
$time = "$mydate[hours]:$mydate[minutes]:$mydate[seconds]";
$query = 'insert into transaction values ("'.$_SESSION['account_no'].'","'.$time.'","'.$date.'",0,"'.$amt.'"," Transfer money to account_no '.$_SESSION['to'].'","'.$debit.'")';
mysqli_query($conn,$query);
$query = 'insert into transaction values ("'.$_SESSION['to'].'","'.$time.'","'.$date.'",1,"'.$amt.'"," Received money from account_no '.$_SESSION['account_no'].'","'.$credit.'")';
mysqli_query($conn,$query);

//send message

session_start();
 //$otp = rand(1111,9999);
//$_SESSION['pin'] = $otp;
   // $to = $_POST['contact'];
$post_data = array(
    // 'From' doesn't matter; For transactional, this will be replaced with your SenderId;
    // For promotional, this will be ignored by the SMS gateway
   
    'From'   => '7048132133',
    'To'    => $mobiles,
    'Body'  => 'Debited ammount of Rs. '.$amt.'from your account. thank you. by Bank of Surat(BOS).', //Incase you are wondering who Dr. Rajasekhar is http://en.wikipedia.org/wiki/Dr._Rajasekhar_(actor)
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
$post_data = array(
    // 'From' doesn't matter; For transactional, this will be replaced with your SenderId;
    // For promotional, this will be ignored by the SMS gateway
   
    'From'   => '7048132133',
    'To'    => $mobiles_to,
    'Body'  => 'Credited ammount of Rs. '.$amt.'to your account. thank you. by Bank of Surat(BOS).', //Incase you are wondering who Dr. Rajasekhar is http://en.wikipedia.org/wiki/Dr._Rajasekhar_(actor)
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
 
/




echo '<script>alert("Transfer Successful!");</script>';
header('refresh:0.01;url=operations_customer.php');
}
?>