<?php
session_start();
$logged_in = $_SESSION["loggedin"];
require_once 'dbconfig.php';

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
				<div class="box">
					<div>
						<div class="body">
							<table>
							<tr>
								<td><h1>Your Order</h1></td>	
								<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
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
							<th>Medicine Name</th>							
							<th>Quantity</th>													
							<th>Status</th>
							<th>Cost</th>							
							<th>Total</th>
							<th>Delivery Date</th>
							</tr>
							<?php
							$stmt = $DB_con->prepare('SELECT * FROM orders');
							$stmt->execute();	
							if($stmt->rowCount() > 0) {
								while($row=$stmt->fetch(PDO::FETCH_ASSOC))		{
								if($row['cid']==$logged_in) {
									
									if($row['sid']!=null) { $status = "Confirmed"; } else { $status = "Pending"; }
										
								
							?>
								<tr>
									<td><?php echo $row['oid']; ?></td>								
									<td><?php echo $row['pname']; ?></td>								
									<td><?php echo $row['quantity']; ?> </td>
									<td><?php echo $status; ?> </td>
									<td><?php echo $row['cost']; ?> </td>									
									<td><?php echo $row['total']; ?> </td>									
									<td><?php if ($row['date']!=null) echo $row['date']; else echo "Not Delivered"; ?>
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