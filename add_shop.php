<?php
require_once 'dbconfig.php';

	$a = "";
	$b = "";	
	$d = "";
	$e = "";
	if(isset($_POST['add'])) {
	$a = $_POST['id'];
	$b = $_POST['name'];	
	$d = $_POST['address'];
	$e = $_POST['pincode'];
	
	if($a=="") {
		$errMSG = "Please Enter Valid ShopID";
	}
	else if($b=="") {
		$errMSG = "Please Enter Valid Shop Name";
	}
	else if($d=="") {
		$errMSG = "Please Enter Valid Address";
	}
	else if($e=="") {
		$errMSG = "Please Enter Valid pincode";
	}
	else {
		
		$existance = "NO";
		
		$stmt1 = $DB_con->prepare('SELECT * FROM shop');
		$stmt1->execute();	
		if($stmt1->rowCount() > 0) {
			while($row1=$stmt1->fetch(PDO::FETCH_ASSOC))		{
			if($a==$row1['id']) {
			$existance = "YES";
			}			
			}
		}
		
		if($existance == "YES") {
			echo "<script>alert('given shop ID is already present in database')</script>";
			header("refresh:3;add_shop.php");
		}
		else {
		
			$stmt = $DB_con->prepare('INSERT INTO shop(id,name,address,pincode) VALUES(:a, :b, :c ,:d)');
			$stmt->bindParam(':a',$a);
			$stmt->bindParam(':b',$b);
			$stmt->bindParam(':c',$d);
			$stmt->bindParam(':d',$e);

			
			if($stmt->execute())
			{
				//$errMSG = "Given Shop Details Are Added Successfully";				
				echo "<script>alert('Given Shop Details Are Added Successfully')</script>";
				header("refresh:3;view_shop.php"); 
			}
			else
			{
				//$errMSG = "Unable To Add Shop Details";
				echo "<script>alert('Unable To Add Shop Details')</script>";
				header("refresh:3;add_shop.php"); 
			}
		}
	}
	}
	
	if(isset($_POST['clear'])) {
		header("Location: add_shop.php"); /* Redirect browser */
		exit();
	}
?>

<!DOCTYPE html>
<html>
<head>
	
	<meta charset="UTF-8">
	<title>Add Staff Details</title>
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
	<style>
	html { overflow-y: hidden; }
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
						    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
					

						<div style="margin-left:50px;margin-right:50px;background-image: url('newimages/bg_st2.jpg'); background-size: cover;height:400px;padding-top:50px;">
							<h1 style="margin-left: 110px;padding-top:0px;">Add Shop Details</h1>
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
											<td>Shop Id:</td>
											<td><input type="text" value="<?php if($a!=null) {echo $a;} ?>" name="id" class="txtfield"></td>
										</tr> 		
										
										<tr style="height: 50px;">											
											<td>Name:</td>
											<td><input type="text" value="<?php if($b!=null) {echo $b;} ?>" name="name" class="txtfield"></td>
										</tr> 
										
										<tr style="height: 50px;">											
											<td>Address:</td>
											<td><input type="text" value="<?php if($d!=null) {echo $d;} ?>" name="address" class="txtfield"></td>
										</tr> 
										
										<tr style="height: 50px;">											
											<td>pincode</td>
											<td><input type="text" value="<?php if($d!=null) {echo $e;} ?>" name="pincode" class="txtfield"></td>
										</tr>
										
										<tr style="height: 50px;">
											
											<td colspan=2>
												<br/>
											<input type="submit" name="add" value="Add" style="background: url(images/blue.PNG) no-repeat;height: 36px;width: 120px;border: 0;padding: 0;margin: 0;color:white;"> &nbsp;&nbsp;
											<input type="submit" name="clear" value="Clear" style="background: url(images/blue.PNG) no-repeat;height: 36px;width: 120px;border: 0;padding: 0;margin: 0;color:white;">
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