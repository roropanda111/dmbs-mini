<?php
session_start();
$logged_in = $_SESSION["loggedin"];
require_once 'dbconfig.php';
if(isset($_GET['delete_id']))
	{
		
		// it will delete an actual record from db
		$stmt_delete = $DB_con->prepare('DELETE FROM stocks WHERE pid =:id');
		$stmt_delete->bindParam(':id',$_GET['delete_id']);
		$stmt_delete->execute();
		
		header("Location:view_stock.php");
	}
	
	if(isset($_GET['delete_all']))
	{
		$stmt_delete = $DB_con->prepare('DELETE FROM stocks WHERE sid =:id');		
		$stmt_delete->bindParam(':id',$logged_in);
		$stmt_delete->execute();		
		header("Location:view_stock.php");
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
							<a href="quantity.php">Qauntity</a>
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
							<table>
							<tr>
								<td><h1>Quantity Details</h1></td>	
								
								<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
								<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
								<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
								<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
								<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
								<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                                <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                                <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                                
                               

								<td><a href="?delete_all=all" style="color:red;" title="click for delete this product" onclick="return confirm('sure to delete ?')"></a></td>
								</tr>
								</table>
							<table class="table1">
							<tr>
							<th>PID</th>
							<th>Name</th>							
							<th>Type</th>
							<th>Man_Date</th>
							<th>Exp_Date</th>
							<th>Quantity</th>							
							<th>Cost</th>							
							</tr>
							<?php
							$stmt = $DB_con->prepare("SELECT * FROM stocks where quantity < 10 ");
							$stmt->execute();	
							if($stmt->rowCount() > 0) {
								while($row=$stmt->fetch(PDO::FETCH_ASSOC))		{
								if($row['sid']==$logged_in) {
								$edit = "a=".$row['pid']."&b=".$row['pname']."&c=".$row['ptype']."&d=".$row['mdate']."&e=".$row['edate']."&f=".$row['quantity']."&g=".$row['cost'];
							?>
								<tr>
									<td><?php echo $row['pid']; ?></td>								
									<td><?php echo $row['pname']; ?></td>																							
									<td><?php echo $row['ptype']; ?> </td>
									<td><?php echo $row['mdate']; ?> </td>
									<td><?php echo $row['edate']; ?> </td>									
									<td><?php echo $row['quantity']; ?> </td>
									<td><?php echo $row['cost']; ?> </td>									
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