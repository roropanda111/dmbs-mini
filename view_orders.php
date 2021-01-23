<?php
session_start();
$logged_in = $_SESSION["loggedin"];
require_once 'dbconfig.php';
if(isset($_GET['mid']))	
{	
	$oid = $_GET['mid'];
	$opname = $_GET['mname'];
	$oqty = $_GET['mqty'];
	$cid=$_GET['cid'];
	$available = 10;
	$total = 10;

	$stmt1 = $DB_con->prepare('SELECT * FROM stocks');
	$stmt1->execute();	
	while($row1=$stmt1->fetch(PDO::FETCH_ASSOC))		{
		if($row1['pname']==$opname) {
			$icost = $row1['cost'];		
			$pid = $row1['pid'];
			$available = $row1['quantity'];	

		}
	}

if($available>=$oqty && isset($pid)) 
{
	$cost = $icost;
	$total = $oqty*$cost;
	
	$date=date("m/d/Y");
	$sql="INSERT INTO shop_status(sid,order_no, cid, quantity,date) VALUES ('$logged_in','$oid','$cid','$oqty','$date')";
	
	$s=$DB_con->prepare($sql);
	$s->execute();
	$sql1 = "UPDATE orders SET sid = '".$logged_in."',pid='".$pid."',cost='".$cost."',total='".$total."' , date='".$date."' WHERE oid='".$oid."'"; 		
		$stmt = $DB_con->prepare($sql1);			
			
			if($stmt->execute())
			{
				$errMSG = "Order Accepted Successfully";				
				
				$available = $available-$oqty; 

					$sql2 = "UPDATE stocks SET quantity = '".$available."' WHERE pname='".$opname."'"; 		
					$stmt2 = $DB_con->prepare($sql2);
					$stmt2->execute();

			}
			else
			{
				$errMSG = "Unable To Confirm";
			}
		}
		else {

			$errMSG = "Stock Not Available";
			echo $errMSG;
		} 
		
	}	
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Stock List</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
<style>
.table1 td, th {
    border: 1px solid black;
}

.table1 {
    border-collapse: collapse;
    width: 100%;
}

.table1 th {
	background: lightgrey;
	color: maroon;
    height: 50px;
	text-align: center;
}
.table1 td {  
	height: 30px;
	text-align: center;
}
</style>

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
					<td><font style="color:yellow;font-size:60px;font-family: Comic Sans MS, cursive, sans-serif;">
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
							<a href="quantity.php">Quantity</a>
							<a href="min_stock.php">min stock</a>
							
							</div>
						</li>

						<li>
							<a href="view_orders.php">View Orders </a>
						</li>
						<li class="dropdown">
							<a href="#">Report </a>
							<div class="dropdown-content">
						
							<a href="Delivered_Details1.php">Delivered_Details1</a>			
							<a href="Delivered_Details2.php">Delivered_Details2</a>
							
							</div>
						</li>	
							 
						<li>
							<a href="index.html">Logout</a>
						</li>
					</ul>
				</div>
			</div>
			<div id="contents">
				<div class="box">
					<div>
						<div class="body">

							<?php
									if(isset($errMSG)){
											?>
											<script> alert('<?php echo $errMSG; ?>');</script>
											<?php
									}
									?> 
							<table>
							<tr>
								<td><h1>Customer Order Details</h1></td>	
								<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
								<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
								<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
								<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
								<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
								<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
								<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
								<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
															
								</tr>
								</table>
							<table class="table1">
							<tr>
							<th>Order ID</th>
							<th>Customer ID</th>
							<th>Medicine</th>							
							<th>Quantity</th>																
							<th>Area</th>	
							<th>Address</th>
							<th>Contact</th>	
							<th>Confirm</th>
							</tr>
							<?php
							$stmt = $DB_con->prepare("SELECT pincode FROM shop where id='$logged_in' ");
							$stmt->execute();
							$row=$stmt->fetch(PDO::FETCH_ASSOC);
							//echo "<script>alert($row)</script>";
							$pincode=$row['pincode'];
							$stmt = $DB_con->prepare("SELECT * FROM orders where zip='$pincode'");
							$stmt->execute();	
							if($stmt->rowCount() > 0) {
								while($row=$stmt->fetch(PDO::FETCH_ASSOC))		{
								if($row['sid']==null) {


										$stmt1 = $DB_con->prepare('SELECT * FROM users');
										$stmt1->execute();					
										while($row1=$stmt1->fetch(PDO::FETCH_ASSOC))		{
										if($row['cid']==$row1['userid'] ) {
												$caddress = $row1['address'];
												$ccno = $row1['contact'];
										}
										}

								
							?>
								<tr>
									<td><?php echo $row['oid']; ?></td>								
									<td><?php echo $row['cid']; ?></td>																							
									<td><?php echo $row['pname']; ?> </td>
									<td><?php echo $row['quantity']; ?> </td>	
									<td><?php echo $row['zip']; ?> </td>	
									<td><?php echo $caddress;?> </td>
									<td><?php echo $ccno;?> </td>
												 


									<td>									
									<a href="?mqty=<?php echo $row['quantity'];?>&mname=<?php echo $row['pname'];?>&mid=<?php echo $row['oid']; ?> &cid=<?php echo $row['cid']; ?>" style="color:red;" title="click if you have this product" onclick="return confirm('sure to accept ?')"> Accept</a>
									</td>
								</tr>
								<?php }} } ?>
							
							
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</body>
</html>