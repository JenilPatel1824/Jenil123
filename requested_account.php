<?php
session_start();
if(!isset($_SESSION['manager_mobile']))
header('location:index.php');

?>

<?php
require("database.php");
session_start();
$sr_no = 0;
$i = 1;
$mobile = $_SESSION['manager_mobile'];
$sqlm = 'select branch_ifsc from manager_info where mobile_no = '.$mobile;
$resultm = mysqli_query($conn,$sqlm);
$rowm = mysqli_fetch_array($resultm);
$code = $rowm['branch_ifsc'];
$sql = 'select account_no from user_info where status = 0 and branch_ifsc = "'.$code.'"';
$result = mysqli_query($conn,$sql);
while ($row = mysqli_fetch_array($result)){
  $sr_no = $sr_no + 1;
}



$sql = 'select * from user_info where status=0 and branch_ifsc = "'.$code.'" order by create_date ASC';
$result = mysqli_query($conn,$sql);






?>




<!DOCTYPE html>
<html>
<head>
	<title></title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="login_manager.php">Manager Login</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="requested_account.php">New account</a></li>
      <li><a href="request_debit.php">Requested Debitcard</a></li>
      <li><a href="all_user.php">All user</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">

      <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Log Out</a></li>

      </ul>
  </div>
</nav>

<div style="position:absolute; width:100%; height:100%; ">
<div style="background-color:#a3939c; width:60%; position: relative;margin-left:26%; margin-top:5%; padding:3%;"><br />
<center><h2>New Account Verification Section</h2></center><br />
<table align="center" width="100%" border="0" style=" border-collapse: separate;
    border-spacing: 10px 20px;">
<tr>
    
	<td> <center>SR NO. </center></td>
	<td> <center> Name  </center> </td>
	<td width="30%"> <center> Account NO.  </center> </td>
	<td width="15%"> <center> Created Date  </center> </td>
	
</tr>
<?php

if($sr_no == 0){
	echo '<script>alert("You have no request for new account!");</script>';
  header('refresh:0.1;url=login_manager.php');
}
?>
	
		<?php  while ($row = mysqli_fetch_array($result)){
			echo '<tr><td height="35"><center>'.$i.'</center></td><td height="35"><center><a style="text-decoration:none;" href="requested_details.php?id='.$row['account_no'].'">'.$row['first_name'].' '.$row['middle_name'].' '.$row['last_name'].'</a><td height="35"><center>'.$row['account_no'].'</center></td><td height="35"><center>'.$row['create_date'].'</center></td></tr>';
			$i=$i+1;
			} ?>


	


</table>
</div></div>
</body>
</html>