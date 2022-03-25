<?php
session_start();
if(!isset($_SESSION['admin']))
header('location:index.php');

?>

<?php
require('database.php');
$query = 'SELECT * FROM branch WHERE branch_manager_id = 0';
$result = mysqli_query($conn,$query);


?>
<?php
if(isset($_POST['app'])){
$mo = $_POST['contact'];
$querym = 'SELECT email FROM manager_info WHERE mobile_no = '.$mo;
$resultm = mysqli_query($conn,$querym);
$rom=mysqli_fetch_array($resultm,MYSQLI_ASSOC);
$query = 'SELECT ifsc FROM branch WHERE branch_name = "'.$_POST["branch"].'"';
$result = mysqli_query($conn,$query);
$ro=mysqli_fetch_array($result,MYSQLI_ASSOC);
$ifsc = $ro['ifsc'];
if($ifsc != $_POST['bcode']){
	echo '<script>alert("Branch and IFSC code does not match! , Please check ifsc codeformat.");</script>';
	header( "refresh:0.1;url=manager_profile.php" );
}
else if($rom['email'] != ''){
	echo '<script>alert("Mobile number already registered!");</script>';
	header( "refresh:0.1;url=manager_profile.php" );
}
else{
	$tm = rand(1111111,9999999);
	$fname = $_POST['fname'];
	$mname = $_POST['mname'];
	$lname = $_POST['lname'];
	$img_name = $_FILES['img']['name'];
	$img_tmp = $_FILES['img']['tmp_name'];
	$img_path ='profileimage'.$fname.$tm.$img_name;
	move_uploaded_file($img_tmp,'uploads/profileimage'.$tm.$img_path);
	// $ima = $_FILES["img"]["tmp_name"];
//$img_path = addslashes(file_get_contents($ima));
	$dob = $_POST['dob'];
	$email = $_POST['email'];
	$contact = $_POST['contact'];
	$sign_name = $_FILES['sign']['name'];
	$sign_tmp = $_FILES['sign']['tmp_name'];
	$sign_path = $fname.$tm.'sign_path'.$sign_name;
	move_uploaded_file($sign_tmp,'uploads/Signature'.$tm.$sign_path);
	$add = $_POST['add'];
	$id_proof_name = $_POST['id_proof_name'];
	$id_proof_file_name = $_FILES['id_proof_file']['name'];
	$id_proof_file_tmp = $_FILES['id_proof_file']['tmp_name'];
	$id_path = $fname.$tm.'id_path'.$id_proof_file_name;
	move_uploaded_file($id_proof_file_tmp,'uploads/id_proof_file'.$tm.$id_path);
	$add_proof_name = $_POST['add_proof_name'];
	$add_proof_file_name_name = $_FILES['add_proof_file']['name'];
	$add_proof_file_name_tmp = $_FILES['add_proof_file']['tmp_name'];
	$add_path = $fname.$tm.'add_path'.$add_proof_file_name_name;
	move_uploaded_file($add_proof_file_name_tmp,'uploads/address_proof_file'.$tm.$add_path);
	$branch = $_POST['branch'];
	$ifsc = $_POST['bcode'];
	$password = $_POST['pwd'];
$query = 'insert into manager_info (branch,address,mobile_no,email,password,fname,mname,lname,image,signature,id_proof_file,address_proof_file,dob,id_proof_name,address_proof_name,branch_ifsc) values ("'.$branch.'","'.$add.'","'.$contact.'","'.$email.'","'.$password.'","'.$fname.'","'.$mname.'","'.$lname.'","'.$img_path.'","'.$sign_path.'","'.$id_path.'","'.$add_path.'","'.$dob.'","'.$id_proof_name.'","'.$add_proof_name.'","'.$ifsc.'")';
$q = 'update branch set branch_manager_id=1 where ifsc = '.$ifsc;
if((mysqli_query($conn,$query)) && (mysqli_query($conn,$q))){
		echo '<script>alert("Successfully branch manager appointed!");</script>';

}

}


}

?>

<html>
<head><title>New Account</title>
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
<div style="position:absolute; width:100%; height:100%; ">
<div style="background-color:#a3939c; width:40%; position: relative;margin-left:30%; margin-top: 5% "><br />
<center><font size="6"><b>Appoint Manager</center></b></font></center><br /><br /><br/>
<form method="post" action="manager_profile.php" enctype="multipart/form-data">
<center><input type="text" name="fname" placeholder="First name" required></center><br />
<center><input type="text" name="mname" placeholder="Middle name" required></center><br />
<center><input type="text" name="lname" placeholder="Last name" required></td></center><br />


<center>Image</center><center><br /><input type="file" name="img" accept="image/*" style="margin-left:10%;" required></center></br >
<center><input type="date" name="dob" placeholder="Date of Birth (YYYY-MM-DD)" required></center></br />

<center><input type="email" name="email" placeholder="Email" required></center><br />

<center><input type="text" name="contact" id="contact" placeholder="Mobile No" required></center></br />

<center>Signature</center><br />
<center><input type="file" name="sign" style="margin-left:10%;" accept="image/*" required></center><br />
<center><textarea name="add" placeholder="Address here...." required></textarea></center><br />

<center><select name="id_proof_name" required>
	<option value="">--Select ID--</option>
	<option value="Adhar Card">Adhar Card</option>
	<option value="Driving licence">Driving licence</option>
	<option value="Voter ID">Voter ID</option>
	<option value="Passport">Passport</option></select><br />
	<br /><center><input type="file" name="id_proof_file" style="margin-left:10%;" required></center>
</center><br />
<center><select name="add_proof_name" required>
	<option value="">--Select Address--</option>
	<option value="Adhar Card">Adhar Card</option>
	<option value="Electricity Bill">Electricity Bill</option>
	<option value="Voter ID">Voter ID</option>
	<option value="Passport">Passport</option>
	<option value="Ration Card">Ration Card</option></select><br />
	<br /><center><input type="file" name="add_proof_file" style="margin-left:10%;" required></center>
</center><br />
<center><select name="branch" id="branch" required>
	<option value="">--Select Branch--</option>
	<?php 
	while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
	$name = $row['branch_name'];
	$id = $row['branch_manager_id'];
	if($id == 0)
	echo '<option value="'.$name.'">'.$name.'</option>';

	}

	?>
</select></center><br />
<center><input type="password" name="pwd" id="pwd" placeholder="Password" required></center><br />

<center><input type="password" name="r_pwd" id="r_pwd" placeholder="Retype-Password" required></center><br />
<center><input type="text" name="bcode" id="bcode" placeholder="IFSC Code (In  7 digit)" required></center><br />
<center><input type="text" name="r_bcode" id="r_bcode" placeholder="Retype-IFSC Code (In 7 digit)" required></center><br /><br />

<center><button type="submit" name="app" class="btn btn-success" onsubmit ="return validate()">Appoint Manager</button></center><br />
</form>
</div>
</div>
</body>
</html>
<script type="text/javascript">
	
	function validate(){
		var x = document.getElementById("bcode");
		var y = document.getElementById("r_bcode");
		var p = document.getElementById("pwd");
				var contact = document.getElementById("contact");

		var rp = document.getElementById("r_pwd");

		if(p != rp){
			alert('Password Does not match!');
			return false;
		}
		else
		{
			var len = p.length;
			if(len<6){
				alert('Password must be atleast 6 character!');
			return false;
			}

		}
		if(x != y){
			alert('IFSC Does not match!');
			return false;
		}

			if(contact.length != 10){
					alert('Enter Valid Contact no!');
			return false;

			}

	}
</script>