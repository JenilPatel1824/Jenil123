<?php
session_start();
if(!isset($_SESSION['account_no']))
header('location:index.php');

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
  <script language="JavaScript">
<!--

function enable_text(status)
{
status=!status; 
  document.my.holder.disabled = status;
  var t = document.getElementById('button').style.visibility;
  if(t == 'hidden')
  document.getElementById('button').style.visibility = 'visible';
else
  document.getElementById('button').style.visibility = 'hidden';

  document.my.type_debit.disabled = status; 
}
//-->
</script>
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

<?php
session_start();
require("database.php");
$sql = "select * from user_info where account_no=".$_SESSION['account_no'];
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
$first_name = $row['first_name'];


$sql_1 = "select * from debit_card where account_no=".$_SESSION['account_no'];
$result_1 = mysqli_query($conn,$sql_1);
$row_1 = mysqli_fetch_array($result_1,MYSQLI_ASSOC);

 ?>
 <?php
if ($handle = opendir('uploads/')) {
    while (false !== ($entry = readdir($handle))) {
   // echo $signn = $row['signature']."<br />";
     //  echo $iddd = $row['id_proof_file']."<br />";
       //echo $addd = $row['address_proof_file'];
        if ($entry == $row['sign_file']) {
          $dow_sign = $entry;
          //echo $dow_sign;
        }
    }
    closedir($handle);
}

if ($handle = opendir('uploads/')) {
    while (false !== ($entry = readdir($handle))) {
   // echo $signn = $row['signature']."<br />";
     //  echo $iddd = $row['id_proof_file']."<br />";
       //echo $addd = $row['address_proof_file'];
          if ($entry == $row['id_file']) {
            $dow_id = $entry;
            //echo $dow_id;
        }
    }
    closedir($handle);
}


if ($handle = opendir('uploads/')) {
    while (false !== ($entry = readdir($handle))) {
   // echo $signn = $row['signature']."<br />";
     //  echo $iddd = $row['id_proof_file']."<br />";
       //echo $addd = $row['address_proof_file'];
          if ($entry == $row['add_file']) {
            $dow_add = $entry;
            //echo $dow_add;
        }
    }
    closedir($handle);
}


?>

 <form name="my" action="issue_debit.php" method="POST">
<!--<table align="left" width="70%"  style="margin-top:-130px;">
	<tr>
		<td width="20%"> class </td>
		<td width="80%"> : <?php echo $row['first_class'].' '.$row['middle_class'].' '.$row['last_class']; ?></td>
	</tr>
	<tr>
		<td> Address</td>
		<td><textarea style="border:0; background-color:white; resize:none;"  value="<?php echo $row['address']; ?>" disabled></textarea>
	</tr>

</table>-->
<div style="position:absolute; width:100%; height:80%; ">
<div style="background-color:#a3939c; width:60%; padding:3%; margin-bottom: 2%; padding-left:6%; position: relative;margin-left:25%; margin-top: 5% "><br />
<div style="position:absolute; margin-left:65%; margin-top:10%;"><img src="uploads/<?php echo $row['image']; ?>" height="90%" width="90%" /></div>
<center><font size="4"><b>Account Number :- </b><?php echo $_SESSION['account_no']; ?><b style="margin-left:9%;">Account Balance Rs. <?php echo $row['balance']; ?></b></font></center>
<table align="center" width="100%" style=" border-collapse: separate;
    border-spacing: 10px 20px;">

<tr>
<td><b>Name :- </b></td>
<td><?php echo $row['first_name'].' '.$row['middle_name'].' '.$row['last_name']; ?></td>
</tr>


<td><b>Date of Birth :- </b></td>
<td><?php echo $row['create_date'];?></td>
</tr>
<tr>
<td><b>Email :- </b></td>
<td><?php echo $row['email'];?></td>
</tr>
<tr>
<td><b>Contact No :- </b></td>
<td><?php echo $row['mobile_no'];?></td>
</tr>
<tr>
<td><b>Signature :- </b></td>
<td><a href="download.php?file=<?php echo $dow_sign; ?>" style="text-decoration:none;" >Click here</a></td>
</tr>
<tr>
<td><b>Address :- </b></td>
<td><?php echo $row['address']; ?></td>
</tr>
<tr>
<td><b>Id proof :- </b></td>
<td><?php echo $row['id_proof'];?><a style="text-decoration:none;" href="download.php?file=<?php echo $dow_id; ?>"><i style="margin-left:2%;">Click here</i></a></td>
</tr>
<tr>
<td><b>Address proof :- </b></td>
<td><?php echo $row['add_proof'];?><a style="text-decoration:none;" href="download.php?file=<?php echo $dow_add; ?>"><i style="margin-left:2%;">Click here</a></td>
</tr>
<tr>
<td><b>Type of Account :- </b></td>
<td><?php echo $row['account_type'];?></td>
</tr>
<tr>
<td><b>Requested Debit card :- </b></td>
<td>
<?php
if($row['debit'] == 1){
  echo 'Yes';

}
else{
$query = 'SELECT card_type FROM request WHERE account_no = '.$_SESSION["account_no"];
$result = mysqli_query($conn,$query);
$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
  if($row['card_type'] == '')
  echo '<input type="checkbox" value="on" name="debit" onclick="enable_text(this.checked)"  )" />';
  else
  echo '<font color="red">Already requested</font>';
}
?>
</tr><tr>
<td><b>SMS srevice :- </b></td>
<td>Yes


</tr>

<tr>
<td><b>Debit Card Holder Name :- </b></td>
<td><input type="text" class="class" placeholder="Enter Cardholder Name " name="holder" style="background-color:#a3939c;" value="<?php if($row['debit'] ==1 ) echo $row_1['card_holder']; ?>" required disabled ></td>
</tr>
<tr>
<td><b>Type of Debit Card :- </b></td>
<td>
<?php
if($row['debit'] == 1){
  echo $row_1['card_type'].'</td>';
}
else
{
echo '<select name="type_debit" style="background-color:#a3939c; border:0px;" required disabled>';
  echo '<option value="">--Select Debitcard--</option>';
  echo '<option value="mestro">Mestro</option>';
  echo '<option value="rupay">Rupay</option>';
  echo '<option value="master">Master</option>';
  echo '<option value="visa">Visa</option></select></td>';
}
?>

</tr>

</table>
<center><input type="submit" name="apply" class="btn btn-success" id="button" value="Apply" style="visibility:hidden;" /></center></div></div>
</form>




</body>
</html>


<style type="text/css">
	.class{
		border:0; 
		background-color:white;
		resize:none;
	}

</style>



