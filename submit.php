<?php

$host="localhost"; // Host name
$username="root"; // mysqli username
$password=""; // mysqli password
$db_name="realestate"; // Database name
$tbl_name="users"; // Table name
$tbl_name1="u_address";
$tbl_name2="contact";
$tbl_name3="email";

$connect=mysqli_connect("$host","$username","$password","$db_name") or die("cannot connect");

// Get values from form
$name=$_POST['firstname'];
$lastname=$_POST['lastname'];
$email=$_POST['email'];
$pwd=$_POST['pwd'];
$pwd=md5($pwd);
$gender=$_POST['gender'];
$contact=$_POST['contact'];
$street=$_POST['street'];
$city=$_POST['city'];
$house=$_POST['house'];
$zip=$_POST['zip'];

// Insert data into mysqli
$sql="INSERT INTO $tbl_name(F_name, L_name, Gender, Password)VALUES('$name', '$lastname',  '$gender', '$pwd')";
$sql1="INSERT INTO $tbl_name1(Street, House, Zip, City, Uids)VALUES('$street', '$house',  '$zip', '$city', (SELECT Uids FROM Users WHERE Users.uids=(SELECT max(uids) FROM Users)))";
$sql2="INSERT INTO $tbl_name2(Mobile, Uids)VALUES('$contact', (SELECT Uids FROM Users WHERE Users.uids=(SELECT max(uids) FROM Users)))";
$sql3="INSERT INTO $tbl_name3(Emailids, Uids)VALUES('$email', (SELECT Uids FROM Users WHERE Users.uids=(SELECT max(uids) FROM Users)))";
$result=mysqli_query($connect,$sql);
$result1=mysqli_query($connect,$sql1);
$result2=mysqli_query($connect,$sql2);
$result3=mysqli_query($connect,$sql3);

// if successfully insert data into database, displays message "Successful".
if($result && $result1 && $result2 && $result3){
echo "Successful";
echo "<BR>";
echo "<a href='login_success.php'>Back to main page</a>";
}

else {
echo "ERROR";
}
?>

<?php
// close connection
mysqli_close($connect);
?>
