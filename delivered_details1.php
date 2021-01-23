<?php
session_start();
$logged_in = $_SESSION["loggedin"];
require_once 'dbconfig.php';
$a = "";
if(isset($_POST['Find_Delivered_Items'])) {
$a = $_POST['date'];
if($a=="") {
		$errMSG = "Please Enter Valid delivered_date";
		echo "<script>alert('Please Enter Valid delivered_date')</script>";
		
		}
		else
		{
			$existance = "NO";
		
		$stmt1 = $DB_con->prepare('SELECT * FROM Orders');
		$stmt1->execute();	
		if($stmt1->rowCount() > 0) {
			while($row1=$stmt1->fetch(PDO::FETCH_ASSOC))		{
			while($a==$row1['date']) {
			$existance = "YES";
			extract($row1);
		}
	}
}
else if($stmt1 ->rowCount()==0)
{
	echo "<script>alert('No data')</script>";
}
		}

	}

	if(isset($_POST['clear'])) {
		//header("Location: delivered_details1.php"); /* Redirect browser */
		exit();
	}?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Delivered_items_Details</title>
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
<td><font style="color:yellow;font-size:50px;font-family: Comic Sans MS, cursive, sans-serif;">
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
	
		<a href="Delivered_Details1.php">datewise_report</a>			
		<a href="Delivered_Details2.php">consolidated_report</a>
		
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



<form method="post" style="float: left;	color: #5a4535;	height:160px;width: 400px;border: 1px solid #5a4535;padding: 19px 19px 6px;margin-left: 150px;" action="delivered_details2.php">
			<?php
		
	?>
	<div class="alert alert-danger">
		<span class="glyphicon glyphicon-info-sign"></span> 
	</div>
	<?php
	?>


<table style="border-collapse: collapse;margin-left:60px">				
<tr style="height: 50px;">	
<td>Delivered_Date:</td>
<td><input type="text" value="mm-dd-yyyy" name="date" class="txtfield" style="width:165px;" id="mnpdate"></td>		

<tr style="height: 50px;">
	
	<td colspan=2>
<br/><br/>
	<input type="submit" name="Find_Delivered_Items" value="Find_Delivered_Items" style="background: url(images/blue.PNG) no-repeat;height: 36px;width: 150px;border: 0;padding: 0;margin: 0;color:white;"> &nbsp;&nbsp;
	<input type="clear" name="clear" value="Clear" style="background: url(images/blue.PNG) no-repeat;height: 36px;width: 120px;border: 0;padding: 0;margin: 0;color:white;">
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