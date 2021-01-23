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
		if($un=="admin" && $pwd=="admin" && $role=="admin" ) {
			header("Location: admin_home.php"); /* Redirect browser */
			exit();
		}		
		else {
		$existance = "NO";
				$stmt1 = $DB_con->prepare('SELECT * FROM users');
				$stmt1->execute();	
				
					while($row1=$stmt1->fetch(PDO::FETCH_ASSOC))		{
					if($un==$row1['userid'] && $pwd==$row1['password'] && $role==$row1['role']) {
					$existance = "YES";
						session_start();
						$_SESSION["loggedin"] = $un;
					}			
					}
					if($existance == "YES") {
						if($role=="shopowner") {
							header("Location: shopowner_home.php"); /* Redirect browser */
							exit();
						}
						else {
							header("Location: customer_home.php"); /* Redirect browser */
							exit();
						}
					}
					else {
						$errMSG = "Invalid User Credentials";
						
					}
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
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
						<div style="margin-left:50px;margin-right:60px;background-image: url('newimages/logo3.JPG');height:400px;padding-top:25px;">
							<h1 style="margin-left: 300px">Sign In</h1>
							<form method="post"  style="float: left;color: #5a4535;	height: 230px; width: 400px;border: 1px solid #5a4535;padding: 19px 19px 6px;margin-left: 300px;">
								
									<?php
									if(isset($errMSG)){
											?>
											<script> alert('<?php echo $errMSG; ?>');</script>
											<?php
									}
									?> 
								
								<table style="border-collapse: collapse;margin-left:60px">
																		
										<tr style="height:5px;">
											<td>User Name:</td>
											<td><input type="text" value="" name="un" class="txtfield"></td>
										</tr> 
										
										<tr style="height:70px;">
											<td>Password:</td>
											<td><input type="password" value="" name="pwd" class="txtfield"></td>
										</tr> 
										
										<tr style="height:20px;">
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
                                            <br/><br/>
											<input type="submit" name="login" value="Log in" style="background: url(images/brown.PNG) no-repeat;height: 36px;width: 120px;border: 0;padding: 0;margin: 0;color:white;"> &nbsp;&nbsp;
											<input type="submit" name="clear" value="Clear" style="background: url(images/brown.PNG) no-repeat;height: 36px;width: 120px;border: 0;padding: 0;margin: 0;color:white;">
											</td>
											
										</tr>
										<br/>
						                  <tr style="height:5px;">
											
											<td><a href="registration.php"><b>Create an Account</b></a></td>
											<td>&nbsp;&nbsp;&nbsp;<b>|</b>&nbsp;&nbsp;&nbsp;<a href="forgot.php"><b>Forgot Password..?</b></a></td>
											
										</tr>
										
										

									
								</table>
							</form>
               
						</div>
						</div>
		
		</div>

	</div>
</body>
</html>