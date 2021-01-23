<?php
session_start();
$logged_in = $_SESSION["loggedin"];
require_once 'dbconfig.php';
/*
if (isset($_POST['pname'])) 
{
	$pname=$_POST['pname'];
	$stmt1 = $DB_con->prepare("SELECT quantity FROM stocks WHERE pname='$pname' and sid='$logged_in'");
	$stmt=$stmt1->execute();
	$row=$stmt1->fetch(PDO::FETCH_ASSOC);

	echo "<script>alert('Quantity ".$row['quantity']."');</script>";
}

if(isset($_POST['clear'])) {
		header("Location: delivered.php");  //Redirect browser 
		exit();
	}
	*/

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Delivered Details</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<style>

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #1E8449  ;
	/*background: url(../images/bg-navigation.png) no-repeat;*/
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

/*
.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;	
}
*/
.dropdown-content a:hover {background-color: #f1f1f1;}

.dropdown:hover .dropdown-content {
    display: block;
}

</style>
<script>
	  		$( function() {
	   			$( "#mnpdate" ).datepicker({
	   				maxDate: 0
	   			});
	  		});

</script>

	</head>
<body>
	<div id="background">
		<div id="page">
			<div id="header">
				<div id="logo">
<table>
<tr>
<td> <a href="index.html"><img src="images/101.JPG" alt="LOGO" height="112" width="128"></a> </td>
<td><font style="color:yellow;font-size:60px;font-family: Comic Sans MS, cursive, sans-serif;">
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<b>Online Medicine</b>
	</font> </td>
</tr>
</table>
				</div>
				<div id="navigation">
<ul>

	<li>
		<a href="shopowner_home.php">Home </a>
	</li>
	
	<li class="dropdown">
		<a href="#">Stock </a>
		<div class="dropdown-content">
		<a href="add_stock.php">Add Stock</a>		
		<a href="view_stock.php">View</a>
		<a href="quantity.php">Qauntity</a>
		<a href="min_stock.php">Min stock</a>

		</div>
	</li>

	<li>
		<a href="view_orders.php">View Orders</a>
	</li>
	<li class="dropdown">
		<a href="#">Report </a>
		<div class="dropdown-content">
		<a href="delivered.php">Delivered</a>
		<a href="delivered_details.php">Delivered_Details</a>
		<a href="tobedelivered.php">To be Delivered </a>
		<a href="tobedelivered_details.php">To Be Delivered_Details</a>
		</div>
	</li>	
	

	
	
	
	<li>
		<a href="index.html">Logout</a>
	</li>
</ul>
				</div>
			</div>
			<div id="contents">		


	<div style=" margin-bottom:100px;margin-left:50px;margin-right:50px;background-image: url('newimages/bg_st2.jpg'); background-size: cover;height:300px;padding-top:5px;">
		<h1 style="margin-left: 150px">Delivered Details</h1>
<form method="post" style="float: left;	color: #5a4535;	height:140px;width: 400px;border: 1px solid #5a4535;padding: 19px 19px 6px;margin-left: 150px;" action="datereport.php">

	<table style="border-collapse: collapse;margin-left:60px">
	    
	   
				
<tr style="height: 50px;">			
<td>Delivered_Date:</td>
<td>
	<input type="text" value="yyyy-mm-dd" name="mdate" class="txtfield" style="width:165px;" id="mnpdate"></td>
</tr>
	
<tr style="height: 50px;">
	
	<td colspan=2>
<br/>
	<input type="submit" name="Find Details" value="Find Details" style="background: url(images/bg-navigation.png) no-repeat;height: 36px;width: 120px;border: 0;padding: 0;margin: 0;color:white;"> &nbsp;&nbsp;
	<input type="submit" name="clear" value="Clear" style="background: url(images/bg-navigation.png) no-repeat;height: 36px;width: 120px;border: 0;padding: 0;margin: 0;color:white;">
	</td>
	
</tr>
	
</table>
		</form>

	</div>

				
			</div>
		</div>

	</div>
</body>
</html>