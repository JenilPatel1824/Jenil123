<?php
session_start();
if(!isset($_SESSION['admin']))
header('location:index.php');

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
<div class="container">
<div class="embed-responsive embed-responsive-16by9" style="position:relative;">
<center><img class="img-responsive" src="picture/bos.png" fixed/></center></div><br />
<center><div class="embed-responsive-item" style="margin-top:-14%; margin-left: 40%; position:absolute;"><font size="5" color="green">ADMIN Section</font></div></center>
</div>

</body>
</html>