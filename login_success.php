<?php
$sess1 = session_id();
if ($sess1 == '') session_start();

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
<script>
$(function() {
$( "#radio" ).buttonset();
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
$( "#tabs" ).tabs({
collapsible: true
});
$( "#tabs" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
$( "#tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
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
<a href="forgotPassword.php">Forgot password?</a>
</form>
</p>
</div>
<button id="opener"  class="signin">Sign In</button>
<form>
<button class="signup" type="submit" formaction="http://localhost/Sign_up.html">Register</button>
</form>
<form id="search-form" method="post" name="input" action="search_action.php">
	<div id="radio">
		<input type="radio" id="radio1" name="radio" checked="checked" value="sale" /><label for="radio1">For Sale</label>
		<input type="radio" id="radio2" name="radio" value="rent" /><label for="radio2">For Rent</label>
	</div>
	<div class="rooms">
	Min:<select name="min">
	<option value="0">Rs 0</option>
	<option value="10000">Rs 10,000</option>
	<option value="20000">Rs 20,000</option>
	<option value="30000">Rs 30,000</option>
	<option value="40000">Rs 40,000</option>
	<option value="50000">Rs 50,000</option>
	<option value="100000">Rs 1,00,000</option>
	<option value="500000">Rs 5,00,000</option>
	<option value="1000000">Rs 10,00,000</option>
	</select>
	Max:<select name="max">
	<option value="2000000">Rs 20,00,000</option>
	<option value="10000">Rs 10,000</option>
	<option value="20000">Rs 20,000</option>
	<option value="30000">Rs 30,000</option>
	<option value="40000">Rs 40,000</option>
	<option value="50000">Rs 50,000</option>
	<option value="100000">Rs 1,00,000</option>
	<option value="500000">Rs 5,00,000</option>
	<option value="1000000">Rs 10,00,000</option>
	</select>
	Rooms:<select name="rooms">
	<option value="0">0</option>
	<option value="1">1</option>
	<option value="2">2</option>
	<option value="3">3</option>
	<option value="4">4</option>
	<option value="4">5</option>
	</select>
	Bathrooms:<select name="bathrooms">
	<option value="0">0</option>
	<option value="1">1</option>
	<option value="2">2</option>
	<option value="3">3</option>
	<option value="4">4</option>
	</select>
	</div>
	<div class="search">
		<input type="text" name="search" class="round">
		<input type="submit" value="Search" class="button">
    </div>
	<div id="tabs">
		<ul>
		<li><a href="#tabs-1">Advanced Search</a></li>
		</ul>
		<div id="tabs-1">
			Min Area:<select name="area">
			<option value="0"></option>
			<option value="1000">1000 sq meter</option>
			<option value="2000">2000 sq meter</option>
			<option value="5000">5000 sq meter</option>
			<option value="10000">10000 sq meter</option>
			</select><br>
			Location:<input type="text" name="location"><br>
			Surface:<select name="surface">
			<option value="tile">Tile</option>
			<option value="wooden">Wooden</option>
			<option value="marbel">Marbels</option>
			<option value="carpet">Carpet</option>
			</select>
		</div>
	</div>
	<div id="footer_text">
		Site Developed by: <a href="mailto:aditya.mallik2017@vitstudent.ac.in">aditya.mallik2017@vitstudent.ac.in</a>
	</div>
</form>
</body>
</html>
		
		
		<?php
	}
	else
	{
		$host="localhost"; // Host name
		$username="root"; // mysqli username
		$password=""; // mysqli password
		$db_name="realestate"; // Database name
		$tbl_name="users"; // Table name
		$name=$_SESSION['username'];
// Connect to server and select database.
		$connect=mysqli_connect("$host", "$username", "$password","$db_name")or die("cannot connect");
		$sql="SELECT * FROM users U, email E, contact C WHERE U.Uids=E.Uids AND C.Uids=U.Uids AND E.Emailids='$name'";
		$result=mysqli_query($connect,$sql);
		$result1=mysqli_fetch_array($result);
		$sql1="SELECT U.Uids FROM users U, email E WHERE U.Uids=E.Uids AND E.Emailids='$name'";
		$result2=mysqli_query($connect,$sql1);
		$result3=mysqli_fetch_array($result2);
		$_SESSION['userid'] = $result3[0];
		$_SESSION['name'] = $result1['F_name'];
		$_SESSION['lname']=$result1['L_name'];
		$_SESSION['email']=$result1['Emailids'];
		$_SESSION['mobile']=$result1['Mobile'];
		
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
$( "#radio" ).buttonset();

$( "#tabs" ).tabs({
collapsible: true
});
$( "#tabs" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
$( "#tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
});
</script>

</head>
<body>
<div class="welcome">
<p>
Welcome <?php echo $_SESSION['name']." ".$result1['L_name']; ?><br>
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
<?php 
$sql2="SELECT C.Mobile FROM contact C WHERE C.Uids IN (SELECT B.Uids FROM sell S, buy B WHERE S.Uids='$result3[0]' AND S.AdId=B.AdId)";
		$sql3="SELECT E.Emailids FROM email E WHERE E.Uids IN (SELECT B.Uids FROM sell S, buy B WHERE S.Uids='$result3[0]' AND S.AdId=B.AdId)";
		$mobile=mysqli_query($connect,$sql2) or die(mysqli_error($connect));
		$email=mysqli_query($connect,$sql3) or die(mysqli_error($connect));
		$count=mysqli_num_rows($email);
if($count>0){
?>
<div class=sidebar>
<p>
<b>Contact Information of people who are interested in buying your property:</b>
</p>
<table border="1" cellspacing="1" cellpadding="5" id="interest">
<tr>
<td>Mobile</td>
<td>Email Id</td>
</tr>
<?php
		While($mobile1=mysqli_fetch_array($mobile) AND $email1=mysqli_fetch_array($email)){
		?>
			<tr>
			<td><?php echo $mobile1['Mobile'] ?></td>
			<td><a href="mailto:<?php echo $email1['Emailids'] ?>"><?php echo $email1['Emailids'] ?></a></td>
			</tr>
		<?php	
		};
?>
</table>
</div>
<?php
}
?>

<form id="search-form" method="post" name="input" action="search_action.php">
	<div id="radio">
		<input type="radio" id="radio1" name="radio" checked="checked" value="sale" /><label for="radio1">For Sale</label>
		<input type="radio" id="radio2" name="radio" value="rent" /><label for="radio2">For Rent</label>
	</div>
	<div class="rooms">
	Min:<select name="min">
	<option value="0">Rs 0</option>
	<option value="10000">Rs 10,000</option>
	<option value="20000">Rs 20,000</option>
	<option value="30000">Rs 30,000</option>
	<option value="40000">Rs 40,000</option>
	<option value="50000">Rs 50,000</option>
	<option value="100000">Rs 1,00,000</option>
	<option value="500000">Rs 5,00,000</option>
	<option value="1000000">Rs 10,00,000</option>
	</select>
	Max:<select name="max">
	<option value="2000000">Rs 20,00,000</option>
	<option value="10000">Rs 10,000</option>
	<option value="20000">Rs 20,000</option>
	<option value="30000">Rs 30,000</option>
	<option value="40000">Rs 40,000</option>
	<option value="50000">Rs 50,000</option>
	<option value="100000">Rs 1,00,000</option>
	<option value="500000">Rs 5,00,000</option>
	<option value="1000000">Rs 10,00,000</option>
	</select>
	Rooms:<select name="rooms">
	<option value="0">0</option>
	<option value="1">1</option>
	<option value="2">2</option>
	<option value="3">3</option>
	<option value="4">4</option>
	<option value="4">5</option>
	</select>
	Bathrooms:<select name="bathrooms">
	<option value="0">0</option>
	<option value="1">1</option>
	<option value="2">2</option>
	<option value="3">3</option>
	<option value="4">4</option>
	</select>
	</div>
	<div class="search">
		<input type="text" name="search" class="round">
		<input type="submit" value="Search" class="button">
    </div>
	<div id="tabs">
		<ul>
		<li><a href="#tabs-1">Advanced Search</a></li>
		</ul>
		<div id="tabs-1">
			Min Area:<select name="area">
			<option value="0"></option>
			<option value="1000">1000 sq meter</option>
			<option value="2000">2000 sq meter</option>
			<option value="5000">5000 sq meter</option>
			<option value="10000">10000 sq meter</option>
			</select><br>
			Location:<input type="text" name="location"><br>
			Surface:<select name="surface">
			<option value="tile">Tile</option>
			<option value="wooden">Wooden</option>
			<option value="marbel">Marbels</option>
			<option value="carpet">Carpet</option>
			</select>
		</div>
	</div>
	<div id="footer_text">
		Site Developed by: <a href="mailto:sunny.agrawal2017@vitstudent.ac.in">sunny.agrawal2017@vitstudent.ac.in</a>
	</div>
</form>
</body>
</html>
		
		
		
		
		
		
				
		
		
		<?php
	}

?>