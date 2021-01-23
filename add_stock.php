<?php
session_start();
$logged_in = $_SESSION["loggedin"];
require_once 'dbconfig.php';

	$pid  = "";	
	$pname = "";	
	$ptype= "";	
	$qty = "";	
	
	$mdate= "";	
	$edate= "";	
	$cost= "";	
	
	if(isset($_POST['add'])) {

	$pid   = $_POST['pid'];	
	$pname = $_POST['pname'];	 
	$ptype = $_POST['ptype'];	
	$qty   = $_POST['qty'];
	$sid=$logged_in;
	$mdate = $_POST['mdate']; 
	$edate= $_POST['edate']; 
	$cost= $_POST['cost']; 
		
	if($pid=="") {
		$errMSG = "Please Enter Valid Medicine id";
	}
	else if($pname=="") {
		$errMSG = "Please Enter Valid Medicine name";
	}
	else if($ptype=="") {
		$errMSG = "Please Enter Valid Medicine Type";
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
		
		    $tstocks = 0;
		    $same_product_available = "no";
		    $same_product_available_qty = 0;

			$stmt1 = $DB_con->prepare('SELECT * FROM stocks');
			$stmt1->execute();			
			while($row1=$stmt1->fetch(PDO::FETCH_ASSOC))		{
				if($row1['pid']==$pid) {
				$tstocks++;					
				}		
				if($row1['pname']==$pname) {
						$same_product_available = "yes";
						$same_product_available_qty = $row1['quantity'];
					}			
			}
		
			if($same_product_available=="no") {

			$stmt = $DB_con->prepare('INSERT INTO stocks(pid,sid,pname,ptype,mdate,edate,quantity,cost) VALUES(:a, :b, :c, :d, :e, :f, :g, :h)');
			$stmt->bindParam(':a',$pid);
			$stmt->bindParam(':b',$sid);
			$stmt->bindParam(':c',$pname);
			$stmt->bindParam(':d',$ptype);
			$stmt->bindParam(':e',$mdate);
			$stmt->bindParam(':f',$edate);	
			$stmt->bindParam(':g',$qty);
			$stmt->bindParam(':h',$cost);						
			
				if($stmt->execute()) 				{								
					echo "<script> alert('Given Stock Details Are Added Successfully')</script>";
					header("refresh:3;view_stock.php"); 
				}
				else {					
					echo "<script>alert('Unable To Add Stock Details')</script>";
					header("refresh:3;add_stock.php"); 
				}
			}
			else {

					$nqty = $same_product_available_qty + $qty;

					$sql1 = "UPDATE stocks SET quantity = '".$nqty."' WHERE pname='".$pname."'"; 		
					$stmt = $DB_con->prepare($sql1);			
			
					if($stmt->execute())		{
						echo "<script> alert('Given Stock Details Are Updated Successfully')</script>";
						header("refresh:3;view_stock.php");
					}
					else {
						echo "<script> alert('Unable To Update Stock Details')</script>";
					}


							}		
	}
	}
	
	if(isset($_POST['clear'])) {
		header("Location: add_stock.php"); /* Redirect browser */
		exit();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Add Stock Details</title>
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

	   			$( "#expdate" ).datepicker({
	   				minDate: 0
	   			});

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
							<a href="shopowner_home.php">Home</a>
						</li>
						
						<li class="dropdown">
							<a href="#">Stock </a>
							<div class="dropdown-content">
							<a href="add_stock.php">Add Stock</a>							
							<a href="view_stock.php">View</a>
							<a href="view_qty.php">Qauntity</a>
							<a href="mi_stock.php">Min stock</a>

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
					

						<div style=" margin-bottom:100px;margin-left:50px;margin-right:50px;background-image: url('newimages/bg_st2.jpg'); background-size: cover;height:580px;padding-top:5px;">
							<h1 style="margin-left: 150px">Add Stock Details</h1>
							<form method="post" style="float: left;	color: #5a4535;	height:430px;width: 400px;border: 1px solid #5a4535;padding: 19px 19px 6px;margin-left: 150px;">
								
									<?php
									if(isset($errMSG)){
											?>
											
											<script> alert('<?php echo $errMSG; ?>');</script>
											
									<?php
									}
									?> 
								<table style="border-collapse: collapse;margin-left:60px">
									    
									     <tr style="height: 50px;">											
											<td>Product Id:</td>
											<td><input type="text" value="<?php if($pid!=null) {echo $pid;}?>" name="pid" class="txtfield"></td>
										</tr> 
																		
										<tr style="height: 50px;">											
											<td>Product Name:</td>
											<td><input type="text" value="<?php if($pname!=null) {echo $pname;} ?>" name="pname" class="txtfield"></td>
										</tr> 
																												
										<tr style="height: 50px;">											
											<td>Product Type:</td>
											<td>
											
												<select style="height:20px;width: 170px;" name="ptype">
															<option value="">-Select-</option>
															<option value="tablet">Tablet</option>
															<option value="injection">Injection</option>
															<option value="syrup">Syrup</option>														  
												</select>
												
											</td>	
											
										</tr> 
										
										<tr style="height: 50px;">											
											<td>ManuFacture Date:</td>
											<td><input type="text" value="mm-dd-yyyy" <?php if($mdate!=null) {echo $mdate;} ?> name="mdate" class="txtfield" style="width:165px;" id="mnpdate"></td>
										</tr> 
										
										<tr style="height: 50px;">											
											<td>Expiry Date:</td>
											<td><input type="text" value="mm-dd-yyyy" name="edate" class="txtfield" style="width:165px;" id="expdate"></td>											
										</tr> 										
										
										<tr style="height: 50px;">											
											<td>Quantity:</td>
											<td><input type="text" value="<?php if($qty!=null) {echo $qty;} ?>" name="qty" class="txtfield"></td>
										</tr> 
										
										<tr style="height: 50px;">											
											<td>Cost:</td>
											<td><input type="text" value="<?php if($cost!=null) {echo $cost;} ?>" name="cost" class="txtfield"></td>
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