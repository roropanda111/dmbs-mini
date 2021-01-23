<?php
require_once 'dbconfig.php';

$a = "";
$b = "";	
$c = "";
$d = "";
if(isset($_GET['a']))	{
		
		$a = $_GET['a'];
		$b = $_GET['b'];
		$c = $_GET['c'];
		$d = $_GET['d'];
		
	}

	if(isset($_POST['edit'])) {
	$a = $_POST['id'];
	$b = $_POST['name'];	
	$c = $_POST['address'];
	$d = $_POST['pincode'];
	
	
	if($a=="") {
		$errMSG = "Please Enter Valid ShopID";
	}
	else if($b=="") {
		$errMSG = "Please Enter Valid Shop Name";
	}
	else if($c=="") {
		$errMSG = "Please Enter Valid Address";
	}
	else if($d=="") {
		$errMSG = "Please Enter Valid pincode";
	}
	else {	
		$sql1 = "UPDATE shop SET name = '".$b."',address='".$c."',pincode='".$d."' WHERE id='".$a."'"; 
		
		$stmt = $DB_con->prepare($sql1);
			
			
			if($stmt->execute())
			{
				//$errMSG = "Given Shop Details Are Updated Successfully";				
				$errMSG = "<script>alert('Given Shop Details Are Updated Successfully')</script>";				
				header("refresh:3;view_shop.php"); 
			}
			else
			{
				$errMSG = "Unable To Edit Shop Details";
				header("refresh:3;edit_shop.php"); 
			}
			
		
	}
	}
	
	if(isset($_POST['clear'])) {
		header("Location: edit_shop.php"); /* Redirect browser */
		exit();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Add Shop Details</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
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
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                         <b>Online Medicine</b>
						</font> </td>
					</tr>
					</table>
				</div>
				<div id="navigation">
					<ul>
					
						<li>
							<a href="admin_home.php">Home </a>
						</li>
							
						<li class="dropdown">
							<a href="#">Shop </a>
							<div class="dropdown-content">
							<a href="add_shop.php">Add Shop</a>							
							<a href="view_shop.php">View</a>
							</div>
						</li>
						
												
						<li>
							<a href="index.html">Logout</a>
						</li>
					</ul>
				</div>
			</div>
			<div id="contents">		
					

						<div class="body height=100px; width=100px;">
							<h1 style="margin-left: 110px">Update Shop Details</h1>
							<form method="post" style="float: left;	color: #5a4535;	height:280px; width: 400px;border: 1px solid #5a4535;padding: 19px 19px 6px;margin-left: 110px;">
								
									<?php
									if(isset($errMSG)){
											?>
											<div class="alert alert-danger">
												<span class="glyphicon glyphicon-info-sign"></span> <strong><?php echo $errMSG; ?></strong>
											</div>
											<?php
									}
									?> 
								
								<table style="border-collapse: collapse;margin-left:60px">
																		
										<tr style="height: 50px;">											
											<td>ID :</td>
											<td><input type="text" readonly value="<?php echo $a;?>" name="id" class="txtfield"></td>
										</tr> 		
										
										<tr style="height: 50px;">											
											<td>Name:</td>
											<td><input type="text" value="<?php echo $b;?>" name="name" class="txtfield"></td>
										</tr> 
										
										<tr style="height: 50px;">											
											<td>Address:</td>
											<td><input type="text" value="<?php echo $c;?>" name="address" class="txtfield"></td>
										</tr> 
										<tr style="height: 50px;">											
											<td>pincode:</td>
											<td><input type="text" value="<?php echo $d;?>" name="pincode" class="txtfield"></td>
										</tr>
										<tr style="height: 50px;">
											
											<td colspan=2>
												<br/>
											<input type="submit" name="edit" value="Edit" style="background: url(images/bg-navigation.png) no-repeat;height: 36px;width: 120px;border: 0;padding: 0;margin: 0;color:white;"> &nbsp;&nbsp;
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