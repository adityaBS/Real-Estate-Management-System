<?php
$sess = session_id();
if ($sess == '') session_start();
if(!empty($_SESSION['member_username'])){
 header("location: login_success.php");}
$host="localhost"; // Host name
$username="root"; // mysqli username
$password=""; // mysqli password
$db_name="realestate"; // Database name
$tbl_name="users"; // Table name

// Connect to server and select databse.
$connect=mysqli_connect("$host", "$username", "$password","$db_name")or die("cannot connect");

// username and password sent from form
$myusername=$_POST['username'];
$mypassword=$_POST['pwd'];

// To protect mysqli injection (more detail about mysqli injection)
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysqli_real_escape_string($connect,$myusername);
$mypassword = mysqli_real_escape_string($connect,$mypassword);
$mypassword=md5($mypassword);
$sql="SELECT * FROM users U, email E WHERE U.Uids=E.Uids AND E.Emailids='$myusername' and U.Password='$mypassword'";
$result=mysqli_query($connect,$sql);

// mysqli_num_row is counting table row
$count=mysqli_num_rows($result);
// If result matched $myusername and $mypassword, table row must be 1 row

if($count==1){


$_SESSION['username'] = $_POST['username'];
$_SESSION['password'] = $_POST['pwd'];
header("location:login_success.php");
}
else {
echo '<script language="javascript">confirm("Wrong Username or Password")</script>';
echo '<script language="javascript">window.location = "http://localhost/login_success.php"</script>';
}
?>