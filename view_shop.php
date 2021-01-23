<?php
require_once 'dbconfig.php';
if(isset($_GET['delete_id']))
	{
		
		// it will delete an actual record from db
		$stmt_delete = $DB_con->prepare('DELETE FROM shop WHERE id =:id');
		$stmt_delete->bindParam(':id',$_GET['delete_id']);
		$stmt_delete->execute();
		
		header("Location:view_shop.php");
	}
	
	if(isset($_GET['delete_all']))
	{
		$stmt_delete = $DB_con->prepare('truncate table shop');		
		$stmt_delete->execute();		
		header("Location:view_shop.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Shop Details</title>
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
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
				<div class="box">
					<div>
						<div class="body">
							<table>
							<tr>
								<td><h1>Shop Details</h1></td>	
								
								<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
								<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
								<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
								<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
								<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
								<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
								<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
								<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
								<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>

								<td><a href="?delete_all=all" style="color:red;" title="click for delete this product" onclick="return confirm('sure to delete ?')">  
								Delete All</a></td>
								</tr>
								</table>
							<table class="table1">
							<tr>
							<th>Shop ID</th>
							<th>Name</th>							
							<th>Address</th>
							<th>Pincode</th>
							<th>Delete</th>
							</tr>
							<?php
							$stmt = $DB_con->prepare('SELECT * FROM shop');
							$stmt->execute();	
							if($stmt->rowCount() > 0) {
								while($row=$stmt->fetch(PDO::FETCH_ASSOC))		{
								extract($row);
								$edit = "a=".$row['id']."&b=".$row['name']."&c=".$row['address']."&d=".$row['pincode'];
							?>
								<tr>
									<td><?php echo $row['id']; ?></td>								
									<td><?php echo $row['name']; ?></td>
									<td><?php echo $row['address']; ?> </td>
									<td><?php echo $row['pincode']; ?> </td>
									<td>
									<a href="edit_shop.php?<?php echo $edit; ?>" style="color:green;" title="click for delete this product" onclick="return confirm('sure to edit ?')"> Edit</a> /
									<a href="?delete_id=<?php echo $row['id']; ?>" style="color:red;" title="click for delete this product" onclick="return confirm('sure to delete ?')"> Delete</a>
									</td>
								</tr>
							<?php } } ?>
							
							
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</body>
</html>