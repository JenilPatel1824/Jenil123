<?php
session_start();
if(!isset($_SESSION['account_no']))
header('location:index.php');

?>

<?php
require('database.php');
session_start();
$to = $_POST['to'];
$amt = $_POST['amt'];
$_SESSION['to'] = $to;
$query = 'SELECT first_name,last_name FROM user_info WHERE account_no = '.$to;
$result = mysqli_query($conn,$query);
$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
if($row['first_name'] == NULL){
  echo '<script>alert("Account does not exist! , Please check account no");</script>';
  header( "refresh:0.01;url=fund_transfer.php" );
}


?>
<html>
<head><title>Transaction History</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript">
  function transfer_arshit(){
        var pw = document.getElementById("pwd").value;
            var rpw = document.getElementById("rpwd").value;

            if((pwd == '') || (rpwd == '')){
              alert('All fields are required!');
              return false;
            }

            if(pw != rpw){
              alert('Password does not match!');
              return false;
            }
          }
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
<div style="position:absolute; width:100%; height:80%; ">
<div style="background-color:#a3939c; width:50%; position: relative;margin-left:25%; margin-top: 5% "><br />
<center><b><font size="6">Fund Transfer</font></b></center><br />
<form action="final_transfer.php?amount=<?php echo $amt; ?>" name="my" method="post">

<center><font size="4"><b style="margin-left:5%;">From Your Account No..</b></center><br /><center><?php echo $_SESSION['account_no']; ?></font></center><br />

<center><font size="4"><b style="margin-left:5%;">To Account number  </b></center><br /><center><?php echo $_POST['to']; ?></font></center> <br />
<center><font size="4"><b style="margin-left:5%;">Accountant name</b></center><br /><center><?php echo $row['first_name'].' '.$row['last_name']; ?></font></center><br />

<center><font size="4"><b style="margin-left:5%;">Amount :- </b><?php echo 'Rs. '.$_POST['amt']; ?></font><br /></center><br />
<center><input type="password" placeholder="Password" name="pwd" id="pwd" required /><br /><br />
<center><input type="password" placeholder="Retype-Password" name="rpwd" id="rpwd" required /><br /><br />
<center><button type="submit" name="transfer" class="btn btn-success" onclick ="return transfer_arshit()" >Transfer</button></center><br />
</form>
</div></div>
</body>
</html>
