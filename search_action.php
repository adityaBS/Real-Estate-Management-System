f<?php
$sess1 = session_id();
if ($sess1 == '') session_start();

$host="localhost"; // Host name
$username="root"; // mysqli username
$password=""; // mysqli password
$db_name="realestate"; // Database name
$tbl_name="users"; // Table name

// Connect to server and select database.
$connect=mysqli_connect("$host", "$username", "$password","$db_name")or die("cannot connect");
// Get values from form
$type=$_POST['radio'];
$min_price=$_POST['min'];
$max_price=$_POST['max'];
$rooms=$_POST['rooms'];
$bathrooms=$_POST['bathrooms'];
$area=$_POST['area'];
$location=$_POST['location'];
$surface=$_POST['surface'];
$text=$_POST['search'];

if($location && $text){
$sql="SELECT E.* , U.Idata, L.City, S.Uids  FROM estate AS E LEFT JOIN upload AS U ON U.Eids=E.Eids LEFT JOIN placed_for AS P ON P.Eids=E.Eids LEFT JOIN sell AS S ON S.AdId=P.AdId LEFT JOIN location AS L ON L.Eids=E.Eids WHERE S.AdType='$type' AND L.City='$location' AND E.Surface='$surface' AND E.Room>='$rooms' AND E.Bathroom>='$bathrooms' AND E.Area>='$area' AND E.Etype='$text' AND E.Price<='$max_price' AND E.Price>='$min_price' ORDER BY E.Price ASC";
}
else if($location && !$text){
$sql="SELECT E.* , U.Idata, L.City, S.Uids  FROM estate AS E LEFT JOIN upload AS U ON U.Eids=E.Eids LEFT JOIN placed_for AS P ON P.Eids=E.Eids LEFT JOIN sell AS S ON S.AdId=P.AdId LEFT JOIN location AS L ON L.Eids=E.Eids WHERE S.AdType='$type' AND L.City='$location' AND E.Surface='$surface' AND E.Room>='$rooms' AND E.Bathroom>='$bathrooms' AND E.Area>='$area' AND E.Price<='$max_price' AND E.Price>='$min_price' ORDER BY E.Price ASC";
}
else if($text && !$location){
$sql="SELECT E.* , U.Idata, L.City, S.Uids  FROM estate AS E LEFT JOIN upload AS U ON U.Eids=E.Eids LEFT JOIN placed_for AS P ON P.Eids=E.Eids LEFT JOIN sell AS S ON S.AdId=P.AdId LEFT JOIN location AS L ON L.Eids=E.Eids WHERE S.AdType='$type' AND E.Surface='$surface' AND E.Room>='$rooms' AND E.Bathroom>='$bathrooms' AND E.Area>='$area' AND E.Etype='$text' AND E.Price<='$max_price' AND E.Price>='$min_price' ORDER BY E.Price ASC";
}
else{
$sql="SELECT E.* , U.Idata, L.City, S.Uids  FROM estate AS E LEFT JOIN upload AS U ON U.Eids=E.Eids LEFT JOIN placed_for AS P ON P.Eids=E.Eids LEFT JOIN sell AS S ON S.AdId=P.AdId LEFT JOIN location AS L ON L.Eids=E.Eids WHERE S.AdType='$type' AND E.Surface='$surface' AND E.Room>='$rooms' AND E.Bathroom>='$bathrooms' AND E.Area>='$area' AND E.Price<='$max_price' AND E.Price>='$min_price' ORDER BY E.Price ASC";
}
$result = mysqli_query($connect,$sql) or die(mysqli_error());
$count=mysqli_num_rows($result);

if($count==0){
echo '<script language="javascript">confirm("Sorry no estate match your specification try reducing some constraints")</script>';
echo '<script language="javascript">window.location = "http://localhost/login_success.php"</script>';
}
else{

?>
<html>
<head><script src="sorttable.js"></script></head>
	<body>
		<table border="1" cellspacing="1" cellpadding="5" id="search_result" class="sortable">
		<tr>
		<th class="sorttable_nosort">Image</th>
		<th>Price</th>
		<th>Rooms</th>
		<th>Bathrooms</th>
		<th>Area(sq meter)</th>
		<th>Location</th>
		<th>Surface</th>
		<th>Type</th>
		<th class="sorttable_nosort">Apply</th>
		</tr>
<?php
While($row=mysqli_fetch_array($result)){

?>	
		<tr>
		<td><img src="upload/<?php echo $row['Idata'] ?>" alt="Image" width="80" height="80"></td>
		<td><?php echo $row['Price'] ?></td>
		<td><?php echo $row['Room'] ?></td>
		<td><?php echo $row['Bathroom'] ?></td>
		<td><?php echo $row['Area'] ?></td>
		<td><?php echo $row['City'] ?></td>
		<td><?php echo $row['Surface'] ?></td>
		<td><?php echo $row['Etype'] ?></td>
		<?php
		if((isset($_SESSION['username']))){
			if($_SESSION['userid']!=$row['Uids']){
			?>
			<td>
			<form  method="post" action="buy.php" name="buyer">
			<input type="submit" value="BUY" name="Buy">
			<input type="hidden" name="Eid" value="<?php echo $row['Eids'] ?>">
			</form>
		
			</td>
			<?php
			}
			else
			{
			?>
			<td>
			You'r Owner
			</td>
			<?php
			}
		}
		else
		{
		?>
		<td>
		Login to buy
		</td>
		<?php
		}
		?>
		</tr>
		

<?php
};
?>
		</table>
	</body>
</html>
<?php
}

 if((!isset($_SESSION['username'])))
	{
	?>
		<!doctype html>
		<html lang="en">
		<head>
		<title>Real Estate</title>
		<link href="project1.css" rel="stylesheet" type="text/css" />
		<div class="header"><img border="0" src="logo.jpg" alt="Real Estate Management" width="500" height="100"></div>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
		<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
		<link rel="stylesheet" href="/resources/demos/style.css" />
		<script>
		$(function() {
		$( "#dialog" ).dialog({
		autoOpen: false,
		show: {
		effect: "blind",
		duration: 1000
		},
		hide: {
		effect: "explode",
		duration: 1000
		}
		});
		$( "#opener" ).click(function() {
		$( "#dialog" ).dialog( "open" );
		});
		});
		</script>
		</head>
		<body>
		<div id="dialog" title="SIGN IN">
		<p>
		<form  method="post" action="check_login.php" name="ContactForm">
		Username:<br> <input type="text" name="username"><br>
		Password:<br> <input type="password" name="pwd"><br>
		<input type="submit" value="Login" name="Submit">
		</form>
		</p>
		</div>
		<button id="opener"  class="signin">Sign In</button>
		<form>
		<button class="signup" type="submit" formaction="http://localhost/Sign_up.html">Register</button>
</form>
<form class="search1">
		<button type="submit" formaction="http://localhost/login_success.php">Search Advertisements</button>
		</form>
		</body>
		</html>
	<?php
	}
	
	else
	{
	?>
		<!doctype html>
		<html>
		<head>
		<title>Real Estate</title>
		<link href="project1.css" rel="stylesheet" type="text/css" />
		<div class="header"><img border="0" src="logo.jpg" alt="Real Estate Management" width="500" height="100"></div>
		</head>
		<body>
		<div class="welcome">
<p>
Welcome <?php echo $_SESSION['name']." ".$_SESSION['lname']; ?><br>
Email Id: <?php echo $_SESSION['email']?> <br>
Contact No: <?php echo $_SESSION['mobile']?> 
</P>
<form>
<button type="submit" formaction="http://localhost/logout.php">LOG OUT</button>
</form>
</div>
<form class="search1">
		<button type="submit" formaction="http://localhost/login_success.php">Search Advertisements</button>
</form>
<form class="create">
		<button type="submit" formaction="http://localhost/Estate_info.php">Create Advertisements</button>
		</form>
		
	<div id="footer_text">
		Site Developed by: <a href="mailto:rachitra.sahani2017@vitstudent.ac.in">rachitra.sahani2017@vitstudent.ac.in</a>
	</div>
		</body>
		</html>
		
	<?php
	}
?>