<?php
session_start();
if(isset($_POST['resend'])){
$otp = $_SESSION['pin'];
$post_data = array(
    // 'From' doesn't matter; For transactional, this will be replaced with your SenderId;
    // For promotional, this will be ignored by the SMS gateway
   
    'From'   => '7048132133',
    'To'    => $_SESSION['to'],
    'Body'  => 'Your One Tine Password is '.$otp.'. Do not share with any one. by Bank of Surat', //Incase you are wondering who Dr. Rajasekhar is http://en.wikipedia.org/wiki/Dr._Rajasekhar_(actor)
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
 echo "<script>alert('resend successfully!');</script>";
header('refresh:0.01;url=mobile.php');

}

?>

<?php
session_start();
require('database.php');

$te = $_SESSION['otp_check'];
$td = $_POST['otp'];
$_SESSION['refresh_check_1'] = 0;
if($td == 111)

{

 $_SESSION['correct_otp'] = 1;

require('database.php');


 $first_name = $_SESSION['first_name'];
  $middle_name = $_SESSION['middle_name'];
  $last_name = $_SESSION['last_name'];
  $psw=$_SESSION['psw'];
  $tm = $_SESSION['tm']; 
  $rpsw = $_SESSION['rpsw'];
   $dob = $_SESSION['dob'];
  $email = $_SESSION['email']; 
  $contact = $_SESSION['contact'];
  $address = $_SESSION['address'];
  $id_proof = $_SESSION['id_proof'];
   $add_proof =$_SESSION['add_proof'];
  $type_acc = $_SESSION['type_acc'];
   $br = $_SESSION['branch'];
  $code = $_SESSION['bcode'];
  //$type_debit = $_SESSION['type_debit'];
  if(isset($_SESSION['type_debit']))
      $type_debit = $_SESSION['type_debit'];

  $status = 1;
  $balance = 1000;
  $debit = $_SESSION['debit'];
  $mobile = 1;
  $type = $_SESSION['type'];
 // $ima = $_FILES["img"]["tmp_name"];
//$img_path = addslashes(file_get_contents($ima));
 $img_name = $_SESSION['img_name'];
  $img_tmp = $_SESSION['img_tmp'];
 $img_path = 'profileimage'.$last_name.$tm.$img_name;
 copy('uploads_tmp/'.$img_path,'uploads/'.$img_path);
  $sign_name =$_SESSION['sign_name'];
  $sign_tmp = $_SESSION['sign_tmp'];
  $sign_path = 'signutare'.$last_name.$tm.$sign_name;
  copy('uploads_tmp/'.$sign_path,'uploads/'.$sign_path);
  $id_proof_file_name = $_SESSION['id_proof_file_name'];
  $id_proof_file_tmp = $_SESSION['id_proof_file_tmp'];
  $id_path = 'idproof'.$last_name.$tm.$id_proof_file_name;
  copy('uploads_tmp/'.$id_path,'uploads/'.$id_path);
  $add_proof_file_name_name = $_SESSION['add_proof_file_name_name'];
  $add_proof_file_name_tmp = $_SESSION['add_proof_file_name_tmp'];
  $add_path = 'addresspath'.$last_name.$tm.$add_proof_file_name_name;
  copy('uploads_tmp/'.$add_path,'uploads/'.$add_path);

  if(isset($_SESSION['holder'])){
  $holder = $_SESSION['holder'];
}

 
date_default_timezone_set('Asia/Kolkata');
$year = date("y") + 5;
$month = date("m");
$upto = $month.'/'.$year;
$date = date("Y-m-d");
$mydate = getdate(date("U"));
$time = "$mydate[hours]:$mydate[minutes]:$mydate[seconds]";


up_acc :
$temp = 0;
$result = rand(1,9);
for($i = 0; $i < 11; $i++) {
        $result .= mt_rand(0, 9);
     }

$account_noo = $result;
$_SESSION['account_no'] = $account_noo;
$sql = 'select account_no from user_info';
$result = mysqli_query($conn,$sql);
while ($row = mysqli_fetch_array($result)){
  if($row['account_no'] == $account_noo)
    $temp=1;
}
if($temp == 1)
goto up_acc ;

up_card :
$temp = 0;
$result = rand(1,9);
for($i = 0; $i <15; $i++) {
        $result .= mt_rand(0, 9);
     }

$card_no = $result;
$sql = 'select card_no from debit_card';
$result = mysqli_query($conn,$sql);
while ($row = mysqli_fetch_array($result)){
  if($row['card_no']==$card_no)
    $temp=1;
}
if($temp == 1)
goto up_card ;

up_cvv :
$temp = 0;
$result = rand(1,9);
for($i = 0; $i <2; $i++) {
        $result .= mt_rand(0, 9);
     }

$cvv_no = $result;
$sql = 'select cvv_code from debit_card';
$result = mysqli_query($conn,$sql);
while ($row = mysqli_fetch_array($result)){
  if($row['cvv_code']==$cvv_no)
    $temp=1;
}
if($temp == 1)
goto up_cvv ;


//echo $img_path.'<br>';
//echo $id_path.'<br>';
//echo $add_path.'<br>';
//echo $sign_path;

//echo $account_noo;


$sql="insert into user_info(first_name,middle_name,last_name,mobile_no,email,dob,create_date,address,status,password,image,account_no,create_time,balance,account_type,debit,sms_service,id_proof,add_proof,id_file,add_file,sign_file,branch,branch_ifsc) values( '".$first_name."','".$middle_name."','".$last_name."','".$contact."','".$email."','".$dob."','".$date."','".$address."','".$status."','".$psw."','".$img_path."','".$account_noo."','".$time."','".$balance."','".$type."','".$debit."','".$mobile."','".$id_proof."','".$add_proof."','".$id_path."','".$add_path."','".$sign_path."','".$br."','".$code."')";
 mysqli_query($conn,$sql);
if($debit ==1){
$sql = "insert into debit_card(account_no,card_no,cvv_code,card_type,valid_upto,card_holder) values ('".$account_noo."','".$card_no."','".$cvv_no."','".$type_debit."','".$upto."','".$holder."')";
mysqli_query($conn,$sql);
}
echo '<script>alert("Mobile number verified. Your account will be activated within 15 days!.Account number will send by sms. thank you.");</script>';
session_unset(); 
session_destroy();
header('refresh:0.01;url=index.php');



}

else{

if($_SESSION['otp_check'] == 0){
echo '<script>alert("Sorry! , try again leter.");</script>';
header('refresh:0.1;url=index.php');
}
if(($_SESSION['otp_check'] < 3) && ($_SESSION['otp_check'] > 0)){
echo '<script>alert("You have '.$_SESSION['otp_check'].'try left!"); </script>';
header('refresh:0.1;url=mobile.php');
}
}

?>
<script type="text/javascript">
  
  //document.write('dddd');
  //document.write(ren);
  var otp_check = <?php echo $te; ?>;
  //document.write(otp_check);
    var otp = <?php echo $td; ?>;
    //document.write(otp);
    if(otp != $_SESSION['pin']){
         if(otp_check == 0){
        alert('Sorry , try again letter!');
        window.location = "delete_user_info.php";
         }
    else if(otp_check < 3){
        alert('You have '+otp_check+'try left');
        window.location = "mobile.php";
      }
    }
</script>


