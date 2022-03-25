<?php
session_start();
if(!isset($_SESSION['account_no']))
header('location:index.php');

?>

<?php
require('database.php');
session_start();
$query = 'SELECT debit FROM user_info WHERE account_no = '.$_SESSION["account_no"];
$result = mysqli_query($conn,$query);
$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
if($row['debit']==0){
	echo '<script>alert("Currently not available . Please apply for debitcard!. If you already applied then your debitcard is on way");</script>';
	header('refresh:0.0;operations_customer.php');
}

$query = 'SELECT * FROM debit_card WHERE account_no = '.$_SESSION["account_no"];
$result = mysqli_query($conn,$query);
$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
$str = $row['card_no'];
$no = preg_replace('~^.{4}|.{4}(?!$)~', '$0 ', $str);
mysqli_close($con);

?>

<html>
<head>
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


</body>
<div class="container">
<div class="embed-responsive embed-responsive-16by9" style="position:relative;">
<img class="img-responsive" src="picture/debit.png" fixed/>
<div class="embed-responsive-item" style="margin-top:17%; margin-left:6%; position:absolute;"><font size="6"><?php echo $no; ?></font></div>
<div class="embed-responsive-item" style="margin-top:22%; margin-left:22%; position:absolute;"><font  color="white" size="1">VALID</font></div>
<div class="embed-responsive-item" style="margin-top:23%; margin-left:22%; position:absolute;"><font color="white" size="1">UPTO</font></div>
<div class="embed-responsive-item" style="margin-top:22%; margin-left:26%; position:absolute;"><font color="white" size="3"><?php echo $row['valid_upto']; ?></font></div>
<div class="embed-responsive-item" style="margin-top:22.5%; margin-left:3%; position:absolute; text-transform: uppercase;"><font color="white" size="2"><?php echo $row['card_holder']; ?></font></div>
<div class="embed-responsive-item" style="margin-top:21.5%; margin-left:31%; position:absolute;"><img class="img-responsive" src="<?php echo 'picture/'.$row['card_type'].'.png'; ?>" height="3%" width="6%" fixed/></div>
<div class="embed-responsive-item" style="margin-top:6%; margin-left:15%; position:absolute;  font-family: 'Times New Roman', Times, serif"><font color="white" size="5">BANK OF SURAT</font></div>
<div class="embed-responsive-item" style="margin-top:3%; margin-left:2%; position:absolute;"><img class="img-responsive" src="picture/bos.png" height="10%" width="12%" fixed/></div>

</div>



</div>
</div>
</div>

<div class="container">

<div class="embed-responsive embed-responsive-16by9" style="position:relative; align-top:1%;">
<img class="img-responsive" src="picture/cvv.png" style="border-radius:11px;" fixed/>
<div class="embed-responsive-item" style="margin-top:8.43%; margin-left:19.2%; position:absolute;"><font color="red" size="2"><?php echo $row['cvv_code']; ?></font></div></div>

</html>