<?php
session_start();
if(!isset($_SESSION['admin']))
header('location:index.php');

?>

<html>
<head><title>admin</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
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
<div style="background-color:#a3939c; width:50%; margin-left:25%; margin-top:6%; padding-bottom:5%;"><br />
<?php
require('database.php');
$query = 'SELECT * FROM manager_info';
$result = mysqli_query($conn,$query);
echo '<center><h3>Branch Manager</h3></center>';
echo '<center><h3>---------</h3></center>';
echo '<table align="center" width="100%">';
echo '<tr>';
echo '<td height="50"><center><font size="5">Manager Name</font></center></td>';
echo '<td height="50"><center><font size="5">Branch</font></center></td>';
echo '<td height="50"><center><font size="5">IFSC Code</font></center></td></tr>';
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
echo '<tr><td height="35"><center><a style="text-decoration:none; color:#5d635f;" href="manager_info_right.php?id='.$row['mobile_no'].'">'.$row['fname'].' '.$row['lname'].'</a></center></td>';
echo '<td height="35"><center><a style="text-decoration:none; color:black;" href="#">'.$row['branch'].'</a></center></td>';
echo '<td height="35"><center><a style="text-decoration:none; color:black;" href="#">'.$row['branch_ifsc'].'</a></center></td><tr/>';
}
?>
<br />
</table>
</div>
</html>