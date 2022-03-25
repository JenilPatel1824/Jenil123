<?php
session_start();
if(!isset($_SESSION['admin']))
header('location:index.php');

?>
<?php
require('database.php');
if(isset($_POST['submit'])){
$t = 7;
$ifsc = $_POST['ifsc'];
$query = 'SELECT branch_name FROM branch where ifsc = "'.$ifsc.'"';
$result = mysqli_query($conn,$query);
$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
$queryb = 'SELECT ifsc FROM branch where branch_name = "'.$_POST['branch_name'].'"';
$resultb = mysqli_query($conn,$queryb);
$rowb=mysqli_fetch_array($resultb,MYSQLI_ASSOC);
if($row['branch_name'] != ''){
echo '<script>alert("IFSC already exist!");</script>';
$t = 1;
header('refresh:0.1;url=add_branch.php');
}
if($rowb['ifsc'] != ''){
  echo '<script>alert("Branch name already exist!");</script>';
$t = 1;
header('refresh:0.1;url=add_branch.php');
}

}

?>

<?php
require('database.php');
if(isset($_POST['submit'])){
  if($t == 7){
  $branch_name = $_POST['branch_name'];
  $branch_code = $_POST['ifsc'];
 $b_add =  $_POST['branch_address'];
$query = 'insert into branch values ("'.$branch_name.'","'.$branch_code.'","'.$b_add.'",0)';
if(mysqli_query($conn,$query)){
  echo '<script>alert("Branch Successfully Created!");</script>';
}
}
}
?>

<html>
<head><title>Admin</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript">
  
function valid(y){

    var ifsc = document.getElementById(y).value;
        var name = document.getElementById('name').value;
    var ad = document.getElementById('add').value;

    if(ifsc == '' || name == '' || ad == ""){
        alert("All fields are required");
      return false;
    }
    else if(ifsc.length != 7){
      alert("Enter 7 digit IFSC Code! Like 0003320");
      return false;
    }
}

</script>
</head>



<body>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="admin.php">Admin</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="add_branch.php">Add Branch</a></li>
      <li><a href="manager_profile.php">Apoint Manager</a></li>
      <li><a href="manager_info.php">Manager Info</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
                <li><a href="#">Admin :</a></li>

      <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Log Out</a></li>

      </ul>
  </div>
</nav>
<div style="position:absolute; width:100%; height:80%; ">
<div style="background-color:#a3939c; width:50%; position: relative;margin-left:25%; margin-top: 5% "><br />
<center><div class="embed-responsive-item" style="margin-top:5%; margin-left: 0%; "><font size="5" color="#244333">Create New Branch</font></div></center><br /><br />
<form name="branch" method="post" action="add_branch.php">
     <center><label>Name of Branch</label></center>
      <center><input type="text" name="branch_name" id="name" required></center>
    <br />
      <center><label>IFSC Code</label></center>
      <center><input type="text" name="ifsc" id="ifsc" required></center>
    <br />
      <center><label for="usr">Addresss</label></center>
      <center><input type="text" name="branch_address" id="add" required></center>
    <br />
  
<br /><br />
<center><button type="submit" name="submit" class="btn btn-success" onclick="return valid('ifsc')">Create</button></center><br /><br />
</form>
</div>
</div>
</body>
</html>
