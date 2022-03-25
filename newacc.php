<?php
session_start();
$_SESSION['refresh_check'] = 0;
$_SESSION['refresh_check_1'] = 0;
$_SESSION['correct_otp'] = 0;
$_SESSION['otp_check'] = 3;
require('database.php');
$query = 'SELECT * FROM branch';
$result = mysqli_query($conn,$query);

?>


<html>
<head>
<script language="JavaScript">
<!--

function enable_text(status)
{
status=!status;	
	document.f1.holder.disabled = status;
	document.f1.type_debit.disabled = status; 
}
//-->
</script>
<title>New Account</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<img src="picture/bos.png" height="100%" width="100%" style="opacity:0.1; position:absolute;" />


<body  onload=enable_text(false);>
<div style="position:absolute; width:100%; height:100%; ">
<div style="background-color:#a3939c; width:40%; position: relative;margin-left:30%; margin-top: 5% "><br />
<center><br /><font size="5"><b>Welcome to Bank Of Surat</center></b></font></center><br />

<center><br /><font size="6"><b>Account Opening Form</center></b></font></center><br /><br />
<form name="f1" action="mobile.php" method="POST" onsubmit="return ValidationEvent()" enctype="multipart/form-data">

<center><input type="text" name="fname" id="fname" placeholder="First name" required></center><br />
<center><input type="text" name="mname" id="mname" placeholder="Middle name" required></center><br />
<center><input type="text" name="lname" id="lname" placeholder="Last name" required></center><br />	


<center><input type="password" name="psw" placeholder="Password" id="psw" required></center><br />

<center><input type="password" name="rpsw" placeholder="Retype-Password" id="rpsw" required></center><br />  


<center>Image</center><br /><center><input style="margin-left:9%;" type="file" name="img" id="img" accept="image/*" required></center><br />


<center><input type="date" name="dob" placeholder="Date Of Birth (YYYY-MM-DD)" id="dob" required></center><br />


<center><input type="email" name="mail" id="mail" placeholder="Email" required></center><br />


<center><input type="number" name="contact" placeholder="Mobile No" id="contact" required></center><br />


<center><select name="branch" id="branch" required>
	<option value="">--Select Branch--</option>
	<?php 
	while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
	$name = $row['branch_name'];
	echo '<option value="'.$name.'">'.$name.'</option>';

	}

	?>

</select></center><br />


<center><input type="text" name="bcode" id="bcode" placeholder="IFSC Code (In  7 digit)" required></center><br />
<center>Sign</center><br /><center><input type="file" name="sign" style="margin-left:9%;" placeholder="Signature" id="sign" accept="image/*" required></center><br />


<center>Address</center><br /><center><textarea name="add" id="address" placeholder="Address here...." required></textarea></center><br />


<center><select name="id_proof" id="id_proof" required>
	<option value="">--Select ID--</option>
	<option value="Adhar Card">Adhar Card</option>
	<option value="Driving licence">Driving licence</option>
	<option value="Voter ID">Voter ID</option>
	<option value="Passport">Passport</option>
</select></center><br />
	<center><input type="file" name="idproof" style="margin-left:9%;" required></center><br />



<center><select name="add_proof" id="add_proof" required>
	<option value="">--Select Address--</option>
	<option value="Adahar Card">Adhar Card</option>
	<option value="Electricity Bill">Electricity Bill</option>
	<option value="Voter IDr">Voter ID</option>
	<option value="Passport">Passport</option>
	<option value="Ration Card">Ration Card</option>
</select></center><br />

	<center><input type="file" name="addproof" style="margin-left:9%;" required></center><br />

<center>Type of Account</center><br />
<center><input type="radio" name="top" value="current" checked="checked" >Current<input type="radio" name="top" value="savings" >Savings</center><br />

 

<center><input type="checkbox" value="on" name="debit" onclick="enable_text(this.checked)"  )">Debit Card&nbsp&nbsp&nbsp<input type="checkbox" value="on" name="mobile" checked disabled>SMS Service&nbsp&nbsp&nbsp<input type="checkbox" value="on" name="net" checked disabled>Net Banking</center><br />


<center><input type="text" placeholder="Card Holder Name (For Debit Card)" name="holder" required></center><br />



<center><select name="type_debit" required>
	<option value="">--Select Card Type--</option>
	<option value="mestro">Mestro</option>
	<option value="rupay">Rupay</option>
	<option value="master">Master</option>
	<option value="visa">Visa</option></select></center><br />

<div style="margin-left:40%; margin-top:4%;">
<input type="hidden" 
           name="salt"
           id="salt"
           value="8qadr4xnCPW275BaNpYX">
<input type="submit" name="submit" value="Submit" class="btn btn-success" onClick="return validateForm('8qadr4xnCPW275BaNpYX','38');" /><br /><br />
</form>
 </div></div>
</body>
</html>


<script src="md5.js"></script>
<script>
    function encryptPwd1(strPwd, strSalt, strit) {


        var strNewSalt = new String(strSalt);
        if (strPwd == "" || strSalt == "")
        {
            return null;
        }

        var strEncPwd;
        var strPwdHash = calcMD5(strPwd);

        var strMerged = strNewSalt + strPwdHash;
        var strMerged1 = calcMD5(strMerged);
        return strMerged1;

    }
    function validateForm(strSalt, strit) {

    	var fname = document.getElementById("fname").value;

        var strEncPwd = new String(encryptPwd1(document.getElementById("password").value, strSalt, strit));
        document.getElementById("password").value = strEncPwd;
        document.login.submit();
        return true;
    }

function ValidationEvent() {
var psw = document.getElementById("psw").value;
var rpsw = document.getElementById("rpsw").value;
var contact = document.getElementById("contact").value;
if( psw != rpsw){
	alert("password does not match");
	return false;
}
else if(psw.length < 6){
	alert("Password must be at least 6 digit long!");
	return false;
}
else if(contact.length != 10){
	alert("The Contact No. must be at least 10 digit long!");
	return false;
}
else {
	return true;
}
}








</script>


