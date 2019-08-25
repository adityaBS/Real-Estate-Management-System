<?php
$sess1 = session_id();
if ($sess1 == '') session_start();
if((!isset($_SESSION['username'])))
	{
	echo '<script language="javascript">confirm("Please Login/Register to buy any Estate")</script>';
	echo '<script language="javascript">window.location = "http://localhost/login_success.php"</script>';
	}
else
{
$host="localhost"; // Host name
$username="root"; // mysqli username
$password=""; // mysqli password
$db_name="realestate"; // Database name
$eid=$_POST['Eid'];
$buy=$_POST['Buy'];

// Connect to server and select database.
$connect=mysqli_connect("$host","$username","$password","$db_name")or die("cannot connect");
 
$sql="SELECT S.AdId FROM sell S, placed_for P WHERE P.Eids=$eid AND S.AdId=P.AdId";
$result = mysqli_query($connect,$sql) or die(mysqli_error($connect));
$row=mysqli_fetch_array($result);
$Ad=$row['AdId'];
$Uid=$_SESSION['userid'];
$check="SELECT * FROM Buy B WHERE B.Uids=$Uid AND B.AdId=$Ad";
$check1=mysqli_query($connect,$check);
$count=mysqli_num_rows($check1);
if($count==0){
$sql1="INSERT INTO Buy(AdId, Uids)VALUES('$Ad', '$Uid')";
$result1 = mysqli_query($connect,$sql1) or die(mysqli_error($connect));
if($result1){
	echo "Your Contact Information Has Been Sent To The Owner Of This Advertisement. He Will Contact You Soon";
	echo "<BR>";
	echo "<a href='login_success.php'>Back to main page</a>";
}
else {
	echo "ERROR";
}
}
else{
	echo '<script language="javascript">confirm("You have already applied for this estate the owner have your information he will contact you soon")</script>';
	echo '<script language="javascript">window.location = "http://localhost/login_success.php"</script>';
}
}	
?>