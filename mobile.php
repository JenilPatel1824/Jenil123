  <?php
 session_start();
 require("database.php");
if($_SESSION['correct_otp'] ==1)
  header('location: newacc.php');
?>
<?php
session_start();
if(isset($_POST['submit'])){
$m= 5;
require('database.php');
$query = 'SELECT ifsc FROM branch WHERE branch_name = "'.$_POST["branch"].'"';
$result = mysqli_query($conn,$query);
$ro=mysqli_fetch_array($result,MYSQLI_ASSOC);
$ifsc = $ro['ifsc'];
if($ifsc != $_POST['bcode']){
  $m =1;
  echo '<script>alert("Branch and IFSC code does not match! , Please check ifsc codeformat.");</script>';
  header( "refresh:0.1;url=newacc.php" );
  }

  $query = 'SELECT account_no FROM user_info WHERE mobile_no = '.$_POST["contact"];
$result = mysqli_query($conn,$query);
$ro=mysqli_fetch_array($result,MYSQLI_ASSOC);
if($ro['account_no'] != ''){
  $m =1;
echo '<script>alert("Mobile number already registered! , Please check mobile number.");</script>';
  header( "refresh:0.1;url=newacc.php" );
}
}

  ?>


<?php
//send otp

session_start();
if((isset($_POST['submit'])) && ($m == 5)){
 $otp = rand(1111,9999);
$_SESSION['pin'] = $otp;
    $to = $_POST['contact'];
$_SESSION['to'] = $to;
$post_data = array(
    // 'From' doesn't matter; For transactional, this will be replaced with your SenderId;
    // For promotional, this will be ignored by the SMS gateway
   
    'From'   => '7048132133',
    'To'    => $_SESSION['to'],
    'Body'  => 'Your number verification code is '.$otp.'valid in next 20 minutes! thank you. by Bank of Surat(BOS).', //Incase you are wondering who Dr. Rajasekhar is http://en.wikipedia.org/wiki/Dr._Rajasekhar_(actor)
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

}

?>





  <?php
session_start();
$_SESSION['otp_check'] = $_SESSION['otp_check'] - 1 ;
  ?>



<!DOCTYPE html>
<html>
<head>
  <title>Verification</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div style="position:absolute; width:100%; height:100%; ">
<div style="background-color:#a3939c; width:40%; position: relative;margin-left:32%; margin-top: 14% "><br />
<center class="text text-danger"><h4>Please do not refresh this page</h4></center><br /><br />
<center>Insert OTP </center><br />
<form action="tempi.php" method="post">
  <center><input type="text" name="otp"></center><br><br />
  <center><input type="submit" name="submit" class="btn btn-success" value="SubMit"><input style="margin-left:3%;" type="submit" name='resend' class="btn btn-warning" value="Resend OTP"></center><br />
</form>
</div>
</div>
</body>
</html>

<script type="text/javascript">
  
  
  

</script>





<?php
if(isset($_POST['submit'])){
require('database.php');

//if($_SESSION['refresh_check_1'] == 1)
 // header('location: newacc.php');
//$_SESSION['refresh_check_1'] = 1;
//{
 $_SESSION['first_name'] = $_POST['fname' ];
   $_SESSION['middle_name'] = $_POST['mname'];
  $_SESSION['last_name'] = $_POST['lname'];
  $_SESSION['psw'] = $_POST['psw'];
  $_SESSION['tm'] = rand(000000000,999999999);
  $tm = $_SESSION['tm'];
  $_SESSION['rpsw'] = $_POST['rpsw'];
  $_SESSION['dob'] =$_POST['dob'];
  $_SESSION['email'] =  $_POST['mail'];
  $_SESSION['contact'] = $_POST['contact'];
  $_SESSION['address'] = $_POST['add'];
  $_SESSION['id_proof'] = $_POST['id_proof'];
  $_SESSION['add_proof'] = $_POST['add_proof'];
  $_SESSION['type_acc'] = $_POST['top'];
  $_SESSION['branch'] = $_POST['branch'];
  $_SESSION['bcode'] = $_POST['bcode'];
  if(isset($_POST['type_debit']))
  $_SESSION['type_debit'] = $_POST['type_debit'];
  //$_SESSION['type'] = $_POST['top'];
 // $ima = $_FILES["img"]["tmp_name"];
//$img_path = addslashes(file_get_contents($ima));
 $_SESSION['img_name'] = $_FILES['img']['name'];
 $_SESSION['img_tmp'] = $_FILES['img']['tmp_name'];
 //$img_path = 'profileimage'.$first_name.$tm.$img_name;
 //move_uploaded_file($img_tmp,'uploads/'.$img_path);
  $_SESSION['sign_name'] = $_FILES['sign']['name'];
  $_SESSION['sign_tmp'] = $_FILES['sign']['tmp_name'];
  //$sign_path = 'signutare'.$first_name.$tm.$sign_name;
 /// move_uploaded_file($sign_tmp,'uploads/'.$sign_path);
  $_SESSION['id_proof_file_name'] = $_FILES['idproof']['name'];
  $_SESSION['id_proof_file_tmp'] = $_FILES['idproof']['tmp_name'];
  //$id_path = 'idproof'.$first_name.$tm.$id_proof_file_name;
  //move_uploaded_file($id_proof_file_tmp,'uploads/'.$id_path);
  $_SESSION['add_proof_file_name_name'] = $_FILES['addproof']['name'];
  $_SESSION['add_proof_file_name_tmp'] = $_FILES['addproof']['tmp_name'];
   $img_name = $_SESSION['img_name'];
  $img_tmp = $_SESSION['img_tmp'];
 $img_path = 'profileimage'.$_POST['lname'].$tm.$img_name;
 move_uploaded_file($img_tmp,'uploads_tmp/'.$img_path);
  $sign_name =$_SESSION['sign_name'];
  $sign_tmp = $_SESSION['sign_tmp'];
  $sign_path = 'signutare'.$_POST['lname'].$tm.$sign_name;
  move_uploaded_file($sign_tmp,'uploads_tmp/'.$sign_path);
  $id_proof_file_name = $_SESSION['id_proof_file_name'];
  $id_proof_file_tmp = $_SESSION['id_proof_file_tmp'];
  $id_path = 'idproof'.$_POST['lname'].$tm.$id_proof_file_name;
  move_uploaded_file($id_proof_file_tmp,'uploads_tmp/'.$id_path);
  $add_proof_file_name_name = $_SESSION['add_proof_file_name_name'];
  $add_proof_file_name_tmp = $_SESSION['add_proof_file_name_tmp'];
  $add_path = 'addresspath'.$_POST['lname'].$tm.$add_proof_file_name_name;
  move_uploaded_file($add_proof_file_name_tmp,'uploads_tmp/'.$add_path);
  if(isset($_POST['holder'])){
  $holder = $_POST['holder'];
  $_SESSION['holder'] = $holder;
}
$_SESSION['debit'] = 0;
  if(isset($_POST['debit'])){

  $debit = 1 ;
  $_SESSION['debit'] =  1;
}


/*echo $dob;
if($psw != $rpsw){
  $_SESSION["idErr"] = 1 ;
    header('location:newacc.php');
}

if (!function_exists('randi')) {
    // ... proceed to declare your function

function randi($length) {
   $result = '';

    for($i = 0; $i < $length; $i++) {
        $result .= mt_rand(0, 9);
      }
      return $result;
    }
}
*/



//echo $img_path.'<br>';
//echo $id_path.'<br>';
//echo $add_path.'<br>';
//echo $sign_path;

//echo $account_noo;


//$sql="insert into user_info(first_name,middle_name,last_name,mobile_no,email,dob,create_date,address,status,password,image,account_no,create_time,balance,account_type,debit,sms_service,id_proof,add_proof,id_file,add_file,sign_file,branch,branch_ifsc) values( '".$first_name."','".$middle_name."','".$last_name."','".$contact."','".$email."','".$dob."','".$date."','".$address."','".$status."','".$psw."','".$img_path."','".$account_noo."','".$time."','".$balance."','".$type."','".$debit."','".$mobile."','".$id_proof."','".$add_proof."','".$id_path."','".$add_path."','".$sign_path."','".$_POST['branch']."','".$_POST['bcode']."')";
 //mysqli_query($conn,$sql);
//if($debit ==1){
//$sql = "insert into debit_card(account_no,card_no,cvv_code,card_type,valid_upto,card_holder) values ('".$account_noo."','".$card_no."','".$cvv_no."','".$type_debit."','".$upto."','".$holder."')";
//mysqli_query($conn,$sql);
//}
//$_SESSION['refresh_check'] = 1;

//}
}
?>