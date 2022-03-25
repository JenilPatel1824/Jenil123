<?php
session_start();
if(!isset($_SESSION['admin']))
header('location:index.php');

?>
<?php
	require('database.php');
if(isset($_GET['id'])){
	$id = $_GET['id'];
$query = 'SELECT * FROM manager_info where mobile_no ='.$id;
$result = mysqli_query($conn,$query);
$row=mysqli_fetch_array($result,MYSQLI_ASSOC);

}


?>
<?php
if ($handle = opendir('uploads/')) {
    while (false !== ($entry = readdir($handle))) {
   // echo $signn = $row['signature']."<br />";
     //  echo $iddd = $row['id_proof_file']."<br />";
       //echo $addd = $row['address_proof_file'];
        if ($entry == $row['signature']) {
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
          if ($entry == $row['id_proof_file']) {
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
          if ($entry == $row['address_proof_file']) {
            $dow_add = $entry;
            //echo $dow_add;
        }
    }
    closedir($handle);
}


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



<div style="position:absolute; width:100%; height:100%; ">
<div style="background-color:#a3939c; width:60%; position: relative;margin-left:26%; margin-top:1%; padding:4%;"><br />
<div style="position:absolute; margin-left:69%; margin-top: -8%; ">
<img src="uploads/<?php $row['image']; ?>" height="100%" width="80%" />
</div>
<table width="100%" style=" border-collapse: separate;
    border-spacing: 10px 20px;">
<tr>
<td><font size="4"><b style="margin-left:5%;">Name :- </b></td><td><?php echo $row['fname'].' '.$row['mname'].' '.$row['lname']; ?></td></font></tr>
<tr><td><font size="4"><b style="margin-left:5%;">Date of Birth :- </b></td><td><?php echo $row['dob']; ?></td></font></tr>

<tr><td><font size="4"><b style="margin-left:5%;">Email :- </b></td><td><?php echo $row['email']; ?></i></font></td></tr>
<tr><td><font size="4"><b style="margin-left:5%;">Mobile no :-  </b></td><td><?php echo $row['mobile_no']; ?></i></font></td></tr>
<tr><td><font size="4"><b style="margin-left:5%;">Signature :- </b></td><td><a style="text-decoration:none;" href="download.php?file=<?php echo $dow_sign; ?>">Click here</a></font></td></tr>
<tr><td><font size="4"><b style="margin-left:5%;">Id Proof :- </b></td><td><?php echo $row['id_proof_name']; ?>
<i style="margin-left:3%;"><a style="text-decoration:none;"  href="download.php?file=<?php echo $dow_id; ?>">Click here</a></i></font></td></tr>
<tr><td><font size="4"><b style="margin-left:5%;">Address Proof :- </b></td><td><?php echo $row['address_proof_name']; ?>
<i style="margin-left:7%;"><a style="text-decoration:none;"  href="download.php?file=<?php echo $dow_add; ?>" >Click here</a></td></tr></i></font></td></tr>

<tr><td><font size="4"><b style="margin-left:5%;"> Branch :- </b></td><td><?php echo $row['branch']; ?></td></font><br /><br /></tr>
<tr><td><font size="4"><b style="margin-left:5%;">Branch IFSC Code :- </b></td><td><?php echo $row['branch_ifsc']; ?></i></font></tr>

</table>
</div>
</div>
</body>
</html>