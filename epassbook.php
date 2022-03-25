<?php
session_start();
if(!isset($_SESSION['account_no']))
header('location:index.php');

?>

<?php
require("database.php");
session_start();
$sql = "select * from user_info where account_no=".$_SESSION['account_no'] ;
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
$epass = "select * from transaction where account_no=".$_SESSION['account_no'] ;
$res = mysqli_query($conn,$epass);
$sq = "select * from manager_info where branch='".$row['branch']."'";
$resul = mysqli_query($conn,$sq);
$ro = mysqli_fetch_array($resul,MYSQLI_ASSOC);
$first_name = $row['first_name'];



$last_name = $row['last_name'];


$middle_name = $row['middle_name'];


$address = $row['address'];



$mobile_no = $row['mobile_no'];


$name = $first_name.' '.$middle_name.' '.$last_name ;
$account_no = $_SESSION['account_no'];
?>




<html>
<head><title>epassbook</title>
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
      <a class="navbar-brand" href="operations_customer.php">Operations</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="epassbook.php">ePassbook</a></li>
            <li><a href="fund_transfer.php">Fund Transfer</a></li>
      <li><a href="profile.php">Profile</a></li>
      <li><a href="debit_card.php">Debit Card</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
              <li><a href="#">Balance Rs.<?php echo $_SESSION['balance']; ?></a></li>

      <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span>Log out</a></li>
      </ul>
  </div>
</nav>
<div style="position:absolute; width:100%; height:80%; ">
<div style="background-color:#a3939c; width:60%; padding:3%; margin-bottom: 2%; padding-left:6%; position: relative;margin-left:25%; margin-top: 5% "><br />
<center><font size="7"><b> e-Passbook</b></font></center><br><br>
<form>
<table align="center" width="100%" style=" border-collapse: separate;
    border-spacing: 10px 20px;">
<tr style="padding-bottom: 1em;">
<td width="15%" height="10%"><b>Customer Name</b></td>
<td width="35%" height="10%">:&nbsp&nbsp<?php echo $name;?></td>
<td width="15%" height="10%"><b>Account No</b></td>
<td width="35%" height="10%">:&nbsp&nbsp <?php echo $account_no;?></td>
</tr>

<tr style="padding-bottom: 1em;">
<td width="15%" height="10%"><b>Branch</b></td>
<td width="35%" height="10%">:&nbsp&nbsp<?php echo $row['branch'];?></td>
<td width="15%" height="10%"><b>Branch Managre</b></td>
<td width="35%" height="10%">:&nbsp&nbsp<?php echo $ro['fname'].' '.$ro['lname'];?></td>
</tr>

<tr style="padding-bottom: 1em;">
<td width="15%"><b>Account Type</b></td>
<td width="35%">:&nbsp&nbsp<?php echo $row['account_type'];?></td>
<td width="15%"><b>Branch Code</b></td>
<td width="35%">:&nbsp&nbsp<?php echo $ro['branch_ifsc'];?></td>
</tr>

<tr style="padding-bottom: 1em;">
<td width="15%"><b>Address</b></td>
<td width="35%">:&nbsp&nbsp <?php echo $row['address'];?></td>
<td width="15%"><b>Contact No</b></td>
<td width="35%">:&nbsp&nbsp <?php echo $mobile_no;?></td>
</tr>

<tr style="padding-bottom: 1em;">
<td width="15%"><b>Email</b></td>
<td width="35%">:&nbsp&nbsp <?php echo $row['email'];?></td>
<td width="15%"><b>Date of Issue</b></td>
<td width="35%">&nbsp&nbsp<?php echo $row['create_date'].'|'.$row['create_time']; ?></td>
</tr>
</table>
</form>
<br /><br />
<center><b><font size="5">Transaction History</b></center><br /><br />
<form>
<table align="center" width="100%"  style=" border-collapse: separate;
    border-spacing: 10px 20px;">
<tr>
<td width="30%"><b>Date</b></td>
<td width="30%"><b>Time</b></td>
<td width="30%"><b>Merchant</b></td>
<td width="30%"><b>Credit/Debit</b></td>
<td width="30%"><b>Amount</b></td>
<td width="30%"><b>Balance</b></td>
</tr>
<?php 
while($pass = mysqli_fetch_array($res,MYSQLI_ASSOC)){
  if($pass['type']==0){
    $t = '<font color="red">Debited</font>';
  }
  if($pass['type'] == 1){
    $t = '<font color="green">Credited</font>';
  }
echo '<tr><td>'.$pass['date'].'</td><td>'.$pass['time'].'</td><td>'.$pass['merchant_name'].'</td><td>'.$t.'</td><td>'.$pass['ammount'].'</td><td>'.$pass['balance'].'</td></tr>';

}

?>
</table>
</form>
<div style="position:absolute; margin-left:77%;"><button class="btn btn-success" onclick="printed()">Print</button></div><br>
</div></div>
</body>
</html>

<script type="text/javascript">
  function printed(){
    window.print();
  }
</script>
