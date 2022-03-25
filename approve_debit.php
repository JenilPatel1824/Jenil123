<?php
require('database.php');
session_start();
if(isset($_POST['allow'])){
$acc = $_SESSION['allow'];


date_default_timezone_set('Asia/Kolkata');
$year = date("y") + 5;
$month = date("m");
$upto = $month.'/'.$year;
$date = date("Y-m-d");
$mydate = getdate(date("U"));
$time = "$mydate[hours]:$mydate[minutes]:$mydate[seconds]";


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

$query = 'SELECT * FROM request WHERE account_no='.$acc;
$result = mysqli_query($conn,$query);
$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
$typ = $row['card_type'];
$update = 'insert into debit_card values ("'.$acc.'","'.$card_no.'","'.$cvv_no.'","'.$row['holder_name'].'","'.$upto.'","'.$row['card_type'].'")';
mysqli_query($conn,$update);
$up = 'update user_info set debit = 1 where account_no = '.$acc;
mysqli_query($conn,$up);
$delete = 'delete from request where account_no = '.$acc;
mysqli_query($conn,$delete);
date_default_timezone_set('Asia/Kolkata');
$year = date("y") + 5;
$month = date("m");
$upto = $month.'/'.$year;
$date = date("Y-m-d");
$mydate = getdate(date("U"));
$time = "$mydate[hours]:$mydate[minutes]:$mydate[seconds]";
$query = 'SELECT balance FROM user_info WHERE account_no = '.$acc;
$result = mysqli_query($conn,$query);
$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
$debit = $row['balance'];
$amt = 275;
$debit = $debit - 275;
$query = 'insert into transaction values ("'.$acc.'","'.$time.'","'.$date.'",0,"'.$amt.'"," Debit Card ('.$typ.') issued for this account_no  '.$acc.'","'.$debit.'")';
mysqli_query($conn,$query);
$query = 'update user_info set balance = '.$debit.' WHERE account_no = '.$acc;
mysqli_query($conn,$query);
echo '<script>alert("Debitcard Approved Successfully!.");</script>';
header('refresh:0.1;url=request_debit.php');
}

if(isset($_POST['deny'])){
$delete = 'delete from request where account_no = '.$acc;
mysqli_query($conn,$delete);
echo '<script>alert("Debitcard Declined Successfully!.");</script>';
header('refresh:0.1;url=request_debit.php');

}

?>