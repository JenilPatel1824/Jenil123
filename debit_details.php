<?php
session_start();
if(!isset($_SESSION['manager_mobile']))
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
<?php
session_start();
require("database.php");
$_SESSION['allow'] = $_GET['id'];
$sql = "select * from user_info where account_no=".$_GET['id'];
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
$first_name = $row['first_name'];


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

 <form name="my" action="approve_debit.php" method="POST">
<!--<table align="left" width="70%"  style="margin-top:-130px;">
	<tr>
		<td width="20%"> class </td>
		<td width="80%"> : <?php echo $row['first_class'].' '.$row['middle_class'].' '.$row['last_class']; ?></td>
	</tr>
	<tr>
		<td> Address</td>
		<td>:<textarea style="border:0; background-color:white; resize:none;"  value="<?php echo $row['address']; ?>" disabled></textarea>
	</tr>

</table>-->
<div style="position:absolute; width:100%; height:100%; ">
<div style="background-color:#a3939c; width:60%; position: relative;margin-left:22%; margin-bottom: 5%; margin-top:5%; padding:3%;"><br />
<center><h2 style="margin-top:-3%;">Account Number :- <?php echo $_SESSION['allow']; ?></h2></center><br />
<div style="position:absolute; margin-left:68%; margin-top:16%;"><img src="uploads/<?php echo $row['image']; ?>" height="90%" width="90%" /></div>
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
<td><a style="text-decoration:none;" href="download.php?file=<?php echo $dow_sign; ?>">Click here</a></td>
</tr>
<tr>
<td><b>Address :-</b></td>
<td><?php echo $row['address']; ?></td>
</tr>
<tr>
<td><b>Id proof :- </b></td>
<td><?php echo $row['id_proof'];?><i style="margin-left:7%;"><a style="text-decoration:none;" href="download.php?file=<?php echo $dow_id; ?>">Click here</a></td>
</tr>
<tr>
<td><b>Address proof :- </b></td>
<td><?php echo $row['add_proof'];?><i style="margin-left:7%;"><a href="download.php?file=<?php echo $dow_add; ?>">Click here</a></td>
</tr>
<tr>
<td><b>Type of Account :_ </b></td>
<td><?php echo $row['account_type'];?></td>
</tr>
<tr>
<td><b>SMS srevice :- </b></td>
<td>Yes
</tr></table><br />
<center><button type="submit" class="btn btn-success" name="allow" value="Allow" />Approve</button>
<button type="submit" name="deny" class="btn btn-danger" value="Deny" />Reject</button></center>

</form>

</div></div>


</body>
</html>


<style type="text/css">
	.class{
		border:0; 
		background-color:white;
		resize:none;
	}

</style>


