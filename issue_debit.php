<?php
require('database.php');
session_start();
$m =0;
$name = $_POST['holder'];
$type = $_POST['type_debit'];
$query = 'SELECT balance FROM user_info WHERE account_no = '.$_SESSION['account_no'];
$result = mysqli_query($conn,$query);
$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
$debit = $row['balance'];
if($debit < 275){
	$m =3;
	echo '<script>alert("You have not sufficient balance! (Debitcard charge is Rs.275)");</script>';
		header('refresh:0.01;url=profile.php');

}
if($m ==0){
date_default_timezone_set('Asia/Kolkata');
$year = date("y") + 5;
$month = date("m");
$upto = $month.'/'.$year;
$date = date("Y-m-d");
$mydate = getdate(date("U"));
$time = "$mydate[hours]:$mydate[minutes]:$mydate[seconds]";
$query = 'insert into request values ("'.$_SESSION["account_no"].'","'.$name.'","'.$type.'","'.$date.'","'.$time.'")';
if(mysqli_query($conn,$query))
{
	echo '<script>alert("Request sent Successfully!");</script>';
	header('refresh:0.01;url=profile.php');
}

}

?>