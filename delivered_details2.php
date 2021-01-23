<?php
session_start();
$logged_in = $_SESSION["loggedin"];
require_once 'dbconfig.php';
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Delivered Data</title>
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
					<td><font style="color:yellow;font-size:50px;font-family: Comic Sans MS, cursive, sans-serif;">
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
								<td><h1>Delivered Details</h1></td>	
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
							<th>oid</th>
							<th>sid</th>							
							<th>pid</th>
							<th>pname</th>
							<th>quantity</th>
							<th>cost</th>
							<th>total</th>
							<th>zip</th>
							<th>date</th>
							
							
							</tr>

							<?php
							if (isset($_POST['date'])) {
								$d=$_POST['date'];
								$stmt = $DB_con->prepare("SELECT * FROM Orders where  sid='$logged_in' and date='$d' ");
							}
							else
							{
								$stmt = $DB_con->prepare("SELECT * FROM Orders where  sid='$logged_in'");
							}
							$stmt->execute();	
							if($stmt->rowCount() > 0)
							 {
								while($row=$stmt->fetch(PDO::FETCH_ASSOC))		
								{
									extract($row);
									if($row['sid']==$logged_in)
								?>
								    <tr>
									<td><?php echo $row['oid']; ?></td>			
									<td><?php echo $row['sid']; ?></td>
									<td><?php echo $row['pid']; ?></td>				
									<td><?php echo $row['pname']; ?> </td>
									<td><?php echo $row['quantity']; ?> </td>
									<td><?php echo $row['cost']; ?></td>
									<td><?php echo $row['total']; ?></td>
									<td><?php echo $row['zip']; ?></td>
									<td><?php echo $row['date']; ?></td>
								</tr>
								<?php 
								} 
							}
							else
							{
								echo "<script>alert('No Records Found');</script>";
								header("refresh:0;Delivered_Details1.php");
							}
							?>

							
							
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</body>
</html>