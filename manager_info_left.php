<?php
require('database.php');
$query = 'SELECT fname,lname,mobile_no FROM manager_info';
$result = mysqli_query($conn,$query);
echo '<center><h3>Select Manager</h3></center>';
echo '<center><h3>---------</h3></center>';
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
echo '<center><a href="manager_info_right.php?id='.$row['mobile_no'].'" target="info">'.$row['fname'].' '.$row['lname'].'</a></center><br />';
}

?>