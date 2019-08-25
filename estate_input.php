<?php
$sess1 = session_id();
if ($sess1 == '') session_start();

$host="localhost"; // Host name
$username="root"; // mysqli username
$password=""; // mysqli password
$db_name="realestate"; // Database name
$tbl_name="estate"; // Table name
$tbl_name1="location";
$tbl_name2="sell";
$tbl_name3="placed_for";
$tbl_name4="upload";

// Connect to server and select database.
$connect=mysqli_connect("$host", "$username", "$password","$db_name")or die("cannot connect");


		$uid=$_SESSION['userid'];

// Get values from form
$radio=$_POST['radio'];
$etype=$_POST['etype'];
$price=$_POST['price'];
$area=$_POST['area'];
$room=$_POST['room'];
$bathroom=$_POST['bathroom'];
$surface=$_POST['surface'];
$additional=$_POST['additional'];
$street=$_POST['street'];
$city=$_POST['city'];
$house=$_POST['house'];
$zip=$_POST['zip'];
$title=$_POST['title'];
$allowedExts = array("gif", "GIF", "jpeg", "JPEG", "jpg", "JPG", "png", "PNG");
$file1 = $_FILES['file']['name']; 
$image_info = explode(".", $file1); 
$extension = end($image_info);
$filename=$_FILES["file"]["name"];

// Insert data into mysqli
$sql="INSERT INTO $tbl_name(Area, Price, Etype, Surface, Room, Bathroom, Additional)VALUES('$area', '$price',  '$etype', '$surface', '$room', '$bathroom' ,'$additional')";
$sql1="INSERT INTO $tbl_name1(Street, House, Zip, City, Eids)VALUES('$street', '$house',  '$zip', '$city', (SELECT Eids FROM estate WHERE estate.Eids=(SELECT max(Eids) FROM estate)))";
$sql2="INSERT INTO $tbl_name2(AdType, Uids)VALUES('$radio', '$uid')";
$sql3="INSERT INTO $tbl_name3(AdId, Eids)VALUES((SELECT AdId FROM sell WHERE sell.AdId=(SELECT max(AdId) FROM sell)), (SELECT Eids FROM estate WHERE estate.Eids=(SELECT max(Eids) FROM estate)))";
$sql4="INSERT INTO $tbl_name4(Idata, Ititle, Eids)VALUES('$filename', '$title', (SELECT Eids FROM estate WHERE estate.Eids=(SELECT max(Eids) FROM estate)))";
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/png"))
&& ($_FILES["file"]["size"] < 2000000)
&& in_array($extension, $allowedExts))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    }
  else
    {
    if (file_exists("upload/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
		move_uploaded_file($_FILES["file"]["tmp_name"],
		"upload/" . $_FILES["file"]["name"]);
		$result=mysqli_query($connect,$sql);
		$result1=mysqli_query($connect,$sql1);
		$result2=mysqli_query($connect,$sql2);
		$result3=mysqli_query($connect,$sql3);
		$result4=mysqli_query($connect,$sql4);

		// if successfully insert data into database, displays message "Successful".
		if($result && $result1 && $result2 && $result3 && $result4){
		echo "Successful";
		echo "<BR>";
		echo "<a href='login_success.php'>Back to main page</a>";
		}
		else {
			echo "ERROR";
		}
      }
    }
  }
else
  {
  echo "Invalid file";
  }
?>

<?php
// close connection
mysqli_close($connect);
?>
