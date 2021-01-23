<?php
require_once 'dbconfig.php';
session_start();
$logged_in = $_SESSION["loggedin"];

	if(isset($_GET['a']))	{		
		$a = $_GET['a'];
		$b = $_GET['b'];
		$c = $_GET['c'];
		$d = $_GET['d'];
		$e = $_GET['e'];
		$f = $_GET['f'];
		$g = $_GET['g'];
		
	}

	if(isset($_POST['edit'])) {	
		
		$pid = $_POST['pid'];
		$pname = $_POST['pname']; 
		$ptype = $_POST['ptype'];
		$mdate = $_POST['mdate'];
		$edate = $_POST['edate'];
		$qty   = $_POST['qty'];
		$cost  = $_POST['cost'];
		
		
		if($pname=="") {
			$errMSG = "Please Enter Valid Product Name";
		}
		else if($ptype=="") {
			$errMSG = "Please Enter Valid Product Type";
		}
		else if($mdate=="") {
			$errMSG = "Please Enter Valid Manufacturing Date";
		}
		else if($edate=="") {
			$errMSG = "Please Enter Valid Expiry Date";
		}
		else if($qty=="") {
			$errMSG = "Please Enter Valid Quantity";
		}
		else if($cost=="") {
			$errMSG = "Please Enter Valid Cost";
		}
		else {	
		$sql1 = "UPDATE stocks SET pname = '".$pname."',ptype='".$ptype."',mdate='".$mdate."',edate='".$edate."',quantity='".$qty."',cost='".$cost."' WHERE pid='".$pid."'"; 
		
		$stmt = $DB_con->prepare($sql1);
			
			
			if($stmt->execute())
			{
				$errMSG = "Given Stock Details Are Updated Successfully";				
				header("refresh:3;view_stock.php"); 
			}
			else
			{
				$errMSG = "Unable To Edit Stock Details";
				header("refresh:3;edit_stock.php");
			}
			
		
	}
	}
	
	if(isset($_POST['clear'])) {
		header("Location: view_stock.php"); /* Redirect browser */
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
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
							</div>
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
					

						<div class="body">
							<h1 style="margin-left: 150px">Update Stock Details</h1>
							<form method="post" style="float: left;	color: #5a4535;	height: 430px; width: 400px;border: 1px solid #5a4535;padding: 19px 19px 6px;margin-left: 150px;">
								
									<?php
									if(isset($errMSG)){
											?>
											<script> alert('<?php echo $errMSG; ?>');</script>
											
											<?php
									}
									?> 
								
								<table style="border-collapse: collapse;margin-left:60px">
																		
										<tr style="height: 50px;">											
											<td>Product ID :</td>
											<td><input type="text" readonly value="<?php echo $a;?>" name="pid" class="txtfield"></td>
										</tr> 		
										
										<tr style="height: 50px;">											
											<td>Product Name:</td>
											<td><input type="text" value="<?php echo $b;?>" name="pname" class="txtfield"></td>
										</tr> 
										
										<tr style="height: 50px;">											
											<td>Product Type:</td>
											<td><input type="text" value="<?php echo $c;?>" name="ptype" class="txtfield"></td>
										</tr> 
										
										<tr style="height: 50px;">											
											<td>ManuFacture Date:</td>
											<td><input type="date" value="<?php echo $d;?>" name="mdate" class="txtfield" style="width:165px;"></td>
										</tr> 
										
										<tr style="height: 50px;">											
											<td>Expiry Date:</td>
											<td><input type="text" value="<?php echo $e;?>" name="edate" class="txtfield" style="width:165px;"></td>											
										</tr> 										
										
										<tr style="height: 50px;">											
											<td>Quantity:</td>
											<td><input type="text" value="<?php echo $f;?>" name="qty" class="txtfield"></td>
										</tr> 
										
										<tr style="height: 50px;">											
											<td>Cost:</td>
											<td><input type="text" value="<?php echo $g;?>" name="cost" class="txtfield"></td>
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