<?php
$sess1 = session_id();
if ($sess1 == '') session_start();

	if((!isset($_SESSION['username'])))
	{
		header("location:login_success.php");
		exit();
	}
	else
	{?>
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
});
</script>
<script>
function ValidateContactForm()
{
    var price = document.estate_input.price;
    var area = document.estate_input.area;
    var city = document.estate_input.city;

    if (price.value == "")
    {
        window.alert("Please enter price for your estate.");
        price.focus();
        return false;
    }
	
	if (area.value == "")
    {
        window.alert("Please enter area of your estate.");
        area.focus();
        return false;
    }
	if (city.value == "")
    {
        window.alert("Please enter city in which the estate is located.");
        city.focus();
        return false;
    }
    return true;
}
</script>
</head>
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
<body>
<form method="post" name="estate_input" action="estate_input.php" onsubmit="return ValidateContactForm();" enctype="multipart/form-data">
	<div id="radio">
		<input type="radio" id="radio1" name="radio" checked="checked" value="sale" /><label for="radio1">For Sale</label>
		<input type="radio" id="radio2" name="radio" value="rent" /><label for="radio2">For Rent</label>
	</div>
	<div class="estateinfo">
	
	Price (in Rs.) :<input type="text" name="price"><br>
	Area (in square meters) :<input type="text" name="area"><br><br>
	Rooms:<select name="room">
	<option value="1">1</option>
	<option value="2">2</option>
	<option value="3">3</option>
	<option value="4">4</option>
	<option value="5">5</option>
	</select>
	Bathrooms:<select name="bathroom">
	<option value="1">1</option>
	<option value="2">2</option>
	<option value="3">3</option>
	<option value="4">4</option>
	</select>
	Surface:<select name="surface">
	<option value="tile">Tile</option>
	<option value="wooden">Wooden</option>
	<option value="marbel">Marbels</option>
	<option value="carpet">Carpet</option>
	</select><br><br>
	<label for="file">Image:</label>
	<input type="file" name="file" id="file"><br>
	Title:  <input type="text" name="title">
	Estate Type :<select name="etype">
	<option value="house">House</option>
	<option value="office">Office</option>
	</select><br>
	Additional Info:<br> <TEXTAREA NAME="additional">
	</TEXTAREA>
	<fieldset>
	<legend>Location:</legend>
	House:  <input type="text" name="house">
	City:    <input type="text" name="city"><br><br>
	Street:   <input type="text" name="street">
	Zip:  <input type="text" name="zip"><br>
	</fieldset>
	<input type="submit" value="Send">
	<input type="reset" value="Reset">
	</div>
	<div id="footer_text">
		Site Developed by: <a href="mailto:aditya.mallik2017@vitstudent.ac.in">aditya.mallik2017@vitstudent.ac.in</a>
	</div>
</form>
</body>
</html>
<?php
}?>