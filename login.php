<?php
$t =0;
require('database.php');
$pwd = $_POST['pwd'];
$user = $_POST['uname'];
if(($user == 'admin') && ($pwd == 'admin')){
	session_start();
	$_SESSION['admin'] = 'admin';
	header('location:admin.php');
}
$query = 'SELECT mobile_no,password FROM manager_info';
$result = mysqli_query($conn,$query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
	if($row['mobile_no']==$user){
		$t =2;
		if($row['password']==$pwd){
			session_start();
			$_SESSION['manager_mobile'] = $user;
			header('location:login_manager.php');
		}
		else{
			echo '<script>alert("Password incorrect")</script>';
			header( "refresh:0.1;url=index.php" );
	}
		}
		}

		$query = 'SELECT account_no,password FROM user_info';
$result = mysqli_query($conn,$query);
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){

if($row['account_no']==$user){
	$t=1;
		if($row['password']==$pwd){
			session_start();
			$_SESSION['account_no'] = $user;
			header('location:operations_customer.php');
		}
		else{
			echo '<script>alert("Password incorrect")</script>';
			header( "refresh:0.1;url=index.php");
	}
		}

}
if($t==0){
echo '<script>alert("User does not exist!");</script>';
			header( "refresh:0.1;url=index.php");
}
?>1