<?php
require('database.php');


  if ($handle = opendir('uploads_tmp/')) {

    while (false !== ($entry = readdir($handle))) {
              unlink('uploads_tmp/'.$entry);

 }
    closedir($handle);


}


?>
<html>
<head>
<title>
	Welcome to Bank of surat
</title>
<style type="text/css">
	.footer {
    clear: both;
    position: relative;
    z-index: 10;
    height: 3em;
    margin-top: -3em;
}
</style>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body bgcolor="#a3939c">
	<center><br /><h1>Bank Of Surat</h1></center>

	<img src="picture/bank.jpeg" height="60%" width="40%" align="left" style="margin-top:3%; margin-left:3%;" />

	<div style="position:absolute; width:80%; height:80%; ">
<div style="width:30%; position: relative;margin-left:70%; margin-top:-3%; padding:4%;"><br />

<br /><center><h2 style="align-right:10%;">Log In</h2></center>
<form name="form" method="post" action="login.php">
<center><h3>Username: </h3><input  type="text" name="uname" id="unsme" required /></center>
<center><h3>Password: </h3><input  type="password" name="pwd" id="pwd" required /></center><br />
<center><button type="submit" class="btn btn-success" name="login">Log In</button></center>
</form><br />
<center><a style="text-decoration:none; color:#430c04;" href="newacc.php">Apply for new Account</a></center></div></div>

<footer class="footer">
<br/><br /><br />LEGAL TERMS AND CONDITIONS
PLEASE READ THESE LEGAL TERMS AND CONDITIONS CAREFULLY. BY ACCESSING THE WORLD WIDE WEB INTERNET SITE OF COMMERCIAL BANK, YOU AGREE TO BE BOUND BY THE LEGAL TERMS AND CONDITIONS SET FORTH BELOW. IF YOU DO NOT AGREE TO THESE LEGAL TERMS AND CONDITIONS, PLEASE DO NOT ACCESS THIS SITE.</footer>
</body>
</html>