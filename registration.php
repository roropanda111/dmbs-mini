<?php
require_once 'dbconfig.php';
$sname = "NIL";

function validate_mobile($mobile)
{
    return preg_match('/^[0-9]{10}+$/', $mobile);
}

	$name 	= "";	
	$cno = "";
	$mail = "";
	$addr = "";
	$un = "";
	$pwd = "";
	$role= "";

	if(isset($_POST['register'])) {
	
	$name 	= $_POST['name'];
	
	$cno = $_POST['contact'];
	$mail = $_POST['mailid'];
	$addr = $_POST['address'];	
	$un = $_POST['un'];
	$pwd = $_POST['pwd'];
	$role = $_POST['role'];
	
	if($name=="") {
		$errMSG = "Please Enter Valid Name";
	}
	else if($sname=="") {
		$errMSG = "Please Enter Valid Shop Name";
	}	
	else if($cno=="") {
		$errMSG = "Please Enter Valid Contact Number";
	}
	else if($mail=="") {
		$errMSG = "Please Enter Valid Mail ID";
	}
	else if($addr=="") {
		$errMSG = "Please Enter Valid Address";
	}	
	
	else if($un=="") {
		$errMSG = "Please Enter Valid User Name";
	}
	else if($pwd=="") {
		$errMSG = "Please Enter Valid Password";
	}	

	else {
		
		$cno_valid = validate_mobile($cno);
		if($cno_valid==0) {
			$errMSG = "Please Enter Valid Mobile Number";
		}
		else if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
		  $errMSG = "Please Enter Valid Mail ID";
		} 
		else {
		 	
			$existance = "NO";		
			$stmt1 = $DB_con->prepare('SELECT * FROM users');
			$stmt1->execute();			
			while($row1=$stmt1->fetch(PDO::FETCH_ASSOC))		{
			if($un==$row1['userid']) {
			$existance = "YES";
			}			
			}		
		
			if($existance == "YES") {
			$errMSG = "Given User ID Is Already Taken By Another One Person";
			header("refresh:3;registration.php"); 
			}
			else {
		
		
		
			$stmt = $DB_con->prepare('INSERT INTO users(name ,contact ,mail ,address ,userid ,password ,role) VALUES(:a, :c, :d, :e, :f, :g, :h)');
			$stmt->bindParam(':a',$name);			
			$stmt->bindParam(':c',$cno);	
			$stmt->bindParam(':d',$mail);
			$stmt->bindParam(':e',$addr);
			$stmt->bindParam(':f',$un);	
			$stmt->bindParam(':g',$pwd);
			$stmt->bindParam(':h',$role);
			
			
			if($stmt->execute())
			{
				$errMSG = "Registration Successful";								
				header("refresh:3;login.php"); 
			}
			else
			{
				$errMSG = "Registration Failes";				
				header("refresh:3;registration.php"); 
			}
		}			
		 
		 
		}
		
	}
	}
	
	if(isset($_POST['clear'])) {
		header("Location: registration.php"); /* Redirect browser */
		exit();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Registration Form</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">

	
	<script>
	function myFunction() {
		   var role = document.getElementById("role").value;
           var trid = document.getElementById("sname_row");
           
		   //alert(role);
               if (role == "shopowner") {
                   trid.style.display = 'block';
               }
               else {
                   trid.style.display = 'none';
               }
          
       }
	</script>
	</head>
<body >
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

						<li >
							<a href="login.php">Login</a>
						</li>
						
						<li class="selected">
							<a href="registration.php">Registration</a>
						</li>
					</ul>
				</div>
			</div>
							
<div id="contents">
						<div style="margin-left:50px;margin-right:50px;background-image: url('images/brown.PNG');height:600px;padding-top:5px;">
							<h1 style="margin-left:120px;color:white;">Register Here</h1>
							<form method="post"  style="float: left;color: #5a4535;	height:450px; width: 400px;border: 1px solid #ffffff;padding: 19px 19px 6px;margin-left: 120px;">
								
									<?php
									if(isset($errMSG)){
											?>
											
											<script> alert('<?php echo $errMSG; ?>');</script>
											<div class="alert alert-danger" style="color:yellow;">
												<span class="glyphicon glyphicon-info-sign"></span> <strong><?php echo $errMSG; ?></strong>
											</div>
											<?php
									}
									?> 
								
								<table style="border-collapse: collapse;margin-left:60px;color:white;font-size:18px">
												
										<tr style="height: 50px;">
											<td>Role</td>
											<td>: 
												<select style="height:20px;width: 170px;" name="role" id="role">														  
														  <option value="shopowner">Shop Owner</option>
														  <option value="customer">Customer</option>														  
												</select>
											</td>
										</tr> 		

										<tr style="height: 50px;">											
											<td>Name</td>
											<td>: <input type="text" value="<?php if($name!=null) {echo $name;}  ?>" name="name" class="txtfield"></td>
										</tr> 
									

										
										<tr style="height: 50px;">											
											<td>Contact No</td>
											<td>: <input type="text" value="<?php if($cno!=null) {echo $cno;}  ?>" name="contact" class="txtfield"></td>
										</tr> 
										

										<tr style="height: 50px;">											
											<td>Mail ID</td>
											<td>: <input type="text" value="<?php if($mail!=null) {echo $mail;}  ?>" name="mailid" class="txtfield"></td>
										</tr> 
										
										<tr style="height: 50px;">											
											<td>Address</td>
											<td>: <input type="text" value="<?php if($addr!=null) {echo $addr;}  ?>" name="address" class="txtfield"></td>
										</tr> 										
										
		
										<tr style="height: 50px;">											
											<td>User ID</td>
											<td>: <input type="text" value="<?php if($un!=null) {echo $un;}  ?>" name="un" class="txtfield"></td>
										</tr> 
										
										<tr style="height: 50px;">
											<td>Password</td>
											<td>: <input type="password" value="<?php if($pwd!=null) {echo $pwd;}  ?>" name="pwd" class="txtfield"></td>
										</tr> 
										

										
										<tr style="height: 50px;">
											
											<td colspan=2>
												<br/><br/>
											<input type="submit" name="register" value="Register" style="background: url(images/blue.PNG) no-repeat;height: 36px;width: 120px;border: 0;padding: 0;margin: 0;color:white;"> &nbsp;&nbsp;
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