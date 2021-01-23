<?php
require_once 'dbconfig.php';

	if(isset($_POST['add'])) {
	$pid = $_POST['pid'];
	$pn = $_POST['pn'];
	$pc = $_POST['pc'];
	$pq = $_POST['pq'];
	
	if($pid=="" || !is_numeric ($pid)) {
		$errMSG = "Please Enter Valid Product ID";
	}
	else if($pn=="") {
		$errMSG = "Please Enter Valid Product Name";
	}
	else if($pc=="" || !is_numeric ($pc)) {
		$errMSG = "Please Enter Valid Product Cost";
	}	
	else if($pq=="" || !is_numeric ($pq)) {
		$errMSG = "Please Enter Valid Quantity Value";
	}
	else {
		$stmt = $DB_con->prepare('INSERT INTO products(pid,pname,pcost,pqty) VALUES(:a, :b, :c, :d)');
			$stmt->bindParam(':a',$pid);
			$stmt->bindParam(':b',$pn);
			$stmt->bindParam(':c',$pc);
			$stmt->bindParam(':d',$pq);		
			
			if($stmt->execute())
			{
				$errMSG = "Your Product Details Are Added To Stock";
				header("refresh:3;product_add.php"); 
			}
			else
			{
				$errMSG = "Unable To Add Product Details";
			}
	}
	}
	
	if(isset($_POST['clear'])) {
		header("Location: product_add.php"); /* Redirect browser */
		exit();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Admin Home</title>
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
html { overflow-y: hidden; }
</style>
	
	</head>
<body>
	<div id="background" >
		<div id="page">
			<div id="header">
				<div id="logo">
					<table>
					<tr>
					<td> <a href="index.html"><img src="images/101.JPG" alt="LOGO" height="112" width="128"></a> </td>
					<td><font style="color:yellow;font-size:60px;font-family: Comic Sans MS, cursive, sans-serif;">
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                         <b>Online Medicine</b>
						</font> </td>
					</tr>
					</table>
				</div>			
				
				
				<div id="navigation">
					<ul >
					
						<li class="selected">
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
					

						<div  style="background:white;margin-left:5px;margin-right:5px; height:450px;">
							<br/
							<h1 style="margin-left:20px; color:green; height:100">Admin Roles & Responsibility</h1>
								<ul>
									<li>
										<h4>Adding Shop Details</h4>
										
										
										Shop Details Such As Shop ID, Address Will be Added Into Shop Database. 	
										
									</li>
									
									<li>
										<h4>View Shop Details</h4>
										
										
										Viewing Existing Shop Details	
										
									</li>
									
									<li>
										<h4>Edit Details</h4>
										
										
										Updating shop details when changes required
										
									</li>
									

									
									<br>

								</ul>

						</div>
					
				
			</div>
		</div>

	</div>
</body>
</html>