<?php
session_start();
$logged_in = $_SESSION["loggedin"];

require_once 'dbconfig.php';

$pname = ""; 
	$ptype = "";	
	$qty   = "";
	$zip = "";

		function validate_zip($zip)
{
    return preg_match('/^[0-9]{6}+$/', $zip);
}

	if(isset($_POST['add'])) {
		
	$pname = $_POST['pname']; 
	$ptype = $_POST['ptype'];	
	$qty   = $_POST['qty'];
	$zip   = $_POST['zip'];
	
	$zip_valid = validate_zip($zip);
		if($zip_valid==0) {
			$errMSG = "Please Enter Valid Area Code (Zip Code)";
		}	
	else if($pname=="") {
		$errMSG = "Please Enter Valid Product Name";
	}
	else if($ptype=="") {
		$errMSG = "Please Enter Valid Product Type";
	}
	
	else if($qty=="") {
		$errMSG = "Please Enter Valid Quantity";
	}

	else if($zip=="") {
		$errMSG = "Please Enter Valid Area Code";
	}
	
	else {
		
		    $torders = 1;
			$stmt1 = $DB_con->prepare('SELECT * FROM orders');
			$stmt1->execute();			
			while($row1=$stmt1->fetch(PDO::FETCH_ASSOC))		{
				$torders++;	
			}
		
			$sid = null;
			$pid = null;
			$cost = 0;
			$tot = 0;
			$stmt = $DB_con->prepare('INSERT INTO orders(oid,sid,cid,pid,pname,quantity,cost,total,zip) VALUES(:a, :b, :c, :d, :e, :f, :g, :h, :i)');
			$stmt->bindParam(':a',$torders);
			$stmt->bindParam(':b',$sid);			//shop ID
			$stmt->bindParam(':c',$logged_in);		//customer_id
			$stmt->bindParam(':d',$pid);				//product ID
			$stmt->bindParam(':e',$pname);
			$stmt->bindParam(':f',$qty);	
			$stmt->bindParam(':g',$cost);
			$stmt->bindParam(':h',$tot);
			$stmt->bindParam(':i',$zip);
						
			
			if($stmt->execute())
			{								
				echo "<script>alert('Your Request For Medicine Will Be Intimated To Medical Shops')</script>";
				header("refresh:3;order_status.php"); 
			}
			else
			{
				
				echo "<script>alert('Unable To Send Your Request')</script>";
				header("refresh:3;order.php"); 
			}
		
	}
	}
	
	if(isset($_POST['clear'])) {
		header("Location: order.php"); /* Redirect browser */
		exit();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Add Stock Details</title>
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
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                         <b>Online Medicine</b>
						</font> </td>
					</tr>
					</table>
				</div>
				<div id="navigation">
					<ul>
					<li class="selected">
							<a href="customer_home.php">Home </a>
						</li>
						
						
						<li class="dropdown">
							<a href="order.php">Order </a>							
						</li>
														
						
						<li class="dropdown">
							<a href="order_status.php">Status </a>							
						</li>							
						
						
						<li>
							<a href="index.html">Logout</a>
						</li>
					</ul>
				</div>
			</div>
			<div id="contents">		
					

						<div style=" margin-bottom:100px;margin-left:50px;margin-right:50px;background-image: url('newimages/bg_st2.jpg'); background-size: cover;height:440px;padding-top:5px;">
							<h1 style="margin-left: 150px">Order Details</h1>
							<form method="post" style="float: left;	color: #5a4535;	height:280px;width: 400px;border: 1px solid #5a4535;padding: 19px 19px 6px;margin-left: 150px;">
								
									<?php
									if(isset($errMSG)){
											?>
											
											<script> alert('<?php echo $errMSG; ?>');</script>
											
									<?php
									}
									?> 
									
	
	
	
								
								<table style="border-collapse: collapse;margin-left:60px">

									<tr style="height: 50px;">											
											<td>Area Code:</td>
											<td><select name="zip" required style="height:20px;width: 170px;">
												<option value="">--select--</option>
												<?php
												$stmt1 = $DB_con->prepare('SELECT distinct pincode FROM shop');
												$stmt=$stmt1->execute();
												while($row=$stmt1->fetch(PDO::FETCH_ASSOC))
												{
													echo "<option value=".$row['pincode'].">".$row['pincode']."</option>";
												}
												?>
											</select></td>
										</tr> 
										

																		
										<tr style="height: 50px;">											
											<td>Product Name:</td>
											<td><input type="text" value="<?php if($pname!=null) {echo $pname;} ?>" name="pname" class="txtfield"></td>
										</tr> 
																												
										<tr style="height: 50px;">											
											<td>Product Type:</td>
											<td>
											<select style="height:20px;width: 170px;" name="ptype">
														  <option value="">--select--</option>
														  <option value="tablet">Tablet</option>
														  <option value="injection">Injection</option>
														  <option value="syrup">Syrup</option>														  
												</select>
												
												</td>
											
											
										</tr> 
									
									
										
										<tr style="height: 50px;">											
											<td>Quantity:</td>
											<td><input type="text" value="<?php if($qty!=null) {echo $qty;} ?>" name="qty" class="txtfield"></td>
										</tr> 
										

										
										<tr style="height: 50px;">
											
											<td colspan=2>
												<br/>
											<input type="submit" name="add" value="Order" style="background: url(images/blue.PNG) no-repeat;height: 36px;width: 120px;border: 0;padding: 0;margin: 0;color:white;"> &nbsp;&nbsp;
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