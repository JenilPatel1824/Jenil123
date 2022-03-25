<?php
session_start();
if(!isset($_SESSION['account_no']))
header('location:index.php');

?>

<?php
session_start();
require('database.php');
$query = 'SELECT balance FROM user_info WHERE account_no = '.$_SESSION["account_no"];
$result = mysqli_query($conn,$query);
$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
?>
<html>
<head><title>Transaction History</title>
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
<div style="background-color:#a3939c; width:50%; position: relative;margin-left:25%; margin-top: 5% "><br />
<center><b><font size="6">Fund Transfer</font></b></center><br />
<form action="fund_confirm.php" method="post">
<center>From Account Number</center><br /><center><?php echo $_SESSION['account_no']; ?></center><br />
<center><input type="text" name="to" placeholder="To Account Number" id="to" required></center><br />
<center><input type="text" name="reto" placeholder="Retype Account Number" id="reto" required></center><br />
<center><input type="text" name="amt" id="amt" placeholder="Ammount" required></center><br />
<center><button type="submit" class="btn btn-success" onclick="return validate()" >Proceed</button></center><br />
</form>
</body>
</html>
<script>
  function validate(){
    var to = document.getElementById("to").value;
    var reto = document.getElementById("reto").value;
    var amt = document.getElementById("amt").value;
    if(to == '' || reto == '' || amt == ''){
      alert('All field are required!');
      return false;
    }
    else if(to != reto){
      alert('Account number Does not match!');
      return false;
    }
    else{
      var balance = "<?php echo $row['balance']; ?>";
      if(balance < amt){
      alert("Unsufficient balance! your balance is Rs " + balance);
      return false;
    }
      } 
    }
  

</script>