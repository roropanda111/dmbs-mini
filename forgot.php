<?php
require_once 'dbconfig.php';
	if(isset($_POST['login'])) {
	
	$un = $_POST['un'];
	$pwd = $_POST['pwd'];
	$role = $_POST['role'];
	
	if($un=="") {
		$errMSG = "Please Enter Valid User Name";
	}
	else if($pwd=="") {
		$errMSG = "Please Enter Valid Password";
	}	
	else if($un=="" && $pwd=="") {
		$errMSG = "Please Enter Valid User Name & Password";
	}
	else {
		if($un=="admin") {
			$errMSG = "You Can't Change Password Of Admin";
			
		}		
		else {
		$sql1 = "UPDATE users SET password = '".$pwd."' WHERE userid='".$un."'"; 		
		$stmt = $DB_con->prepare($sql1);			
			
			if($stmt->execute())
			{
				$errMSG = "Password Changed Successfully";				
				header("refresh:3;login.php");
			}
			else
			{
				$errMSG = "Unable To Change Password";
			}
		
	           header("refresh:3;login.php"); 
		}
	}
	}
	
	if(isset($_POST['clear'])) {
		header("Location: login.php"); /* Redirect browser */
		exit();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Login Form</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
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
					<td><font style="color:yellow;font-size:60px;font-family: Comic Sans MS, cursive, sans-serif;">
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                         <b>Online Medicine</b>
						</font> </td>
					</tr>
					</table>
				</div>
				<div id="navigation">
					<ul>
						<li>
							<a href="index.html">Home</a>
						</li>

						<li class="selected">
							<a href="login.php">Login</a>
						</li>
					</ul>
				</div>
			</div>
							
<div id="contents">
						<div style="margin-left:50px;margin-right:50px;background-image: url('newimages/logo3.JPG');height:400px;padding-top:40px;">
							<h1 style="margin-left: 300px">Change Password</h1>
							<form method="post"  style="float: left;color: #5a4535;	height:240px; width: 400px;border: 1px solid #5a4535;padding: 19px 19px 6px;margin-left: 300px;">
								
									<?php
									if(isset($errMSG)){
											?>
											<script> alert('<?php echo $errMSG; ?>');</script>
											<?php
									}
									?> 
								
								<table style="border-collapse: collapse;margin-left:60px">
																		
										<tr style="height: 50px;">
											
											<td>User Name:</td>
											<td><input type="text" value="" name="un" class="txtfield"></td>
										</tr> 
										
										<tr style="height: 50px;">
											<td>New Password:</td>
											<td><input type="password" value="" name="pwd" class="txtfield"></td>
										</tr> 

											 
											
										<tr style="height: 50px;">
											<td>Role:</td>
											<td>
												<select style="height:20px;width: 170px;" name="role">
														  <option value="admin">Admin</option>
														  <option value="shopowner">Shop Owner</option>
														  <option value="customer">Customer</option>														  
												</select>
											</td>
										</tr> 
										
																	
										
										<tr style="height: 50px;">
											
											<td colspan=2>
												<br/>
											<input type="submit" name="login" value="Change Password" style="background: url(images/bg-navigation.png) no-repeat;height: 36px;width: 120px;border: 0;padding: 0;margin: 0;color:white;"> &nbsp;&nbsp;
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