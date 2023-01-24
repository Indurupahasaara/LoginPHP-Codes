<HtML>
<Body>
<?php 

 // Inialize session
	session_start();

// Check, if user is already login, then jump to secured page
	if(isset($_SESSION['txtun'])) 
	{
        header('Location: admin.php');
	}
// username and password sent from Form 
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
 	// Include database connection settings
	$con=mysqli_connect("localhost","root","");
	if(!$con)
	{
		die('Could Not Connect:'.mysqli_connect_error());
	}
	mysqli_select_db($con,"VTA");

// Retrieve username and password from database according to user's input
	$login=mysqli_query($con,"SELECT * FROM Login 
	WHERE(uname='".$_POST['txtun']."') 
		and (password ='".$_POST['txtpw']."')");
	
	$row=mysqli_fetch_array($login);
// Check username and password match
	if($row>1) 
	{
        // Set username session variable
        $_SESSION['username'] = $_POST['txtun'];
        // Jump to secured page
		$type=$row['userType'];
		// if user_type ==”Admin”
		if($type=="Admin")
			header('Location: Admin.php');
		else
			header('Location: user.php');
	}

//If login user name or password is invalid
	else { 
	$error="Your Login Name or Password is invalid";
 ?>
	
<font color="#FF0000"><?php
 echo $error;?></font><?php
 }
}
?>

<hr>
   <form name="login" id="login" action="" method="post" >
        <span class="BodyTxtBd">User Login</span> <br>
<table width="100%" class="BodyTxtNm">
          
            <td>User Name</td>
            <td><input name="txtun" type="text" ></td>
          </tr>
                 
          <tr> 
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>Password</td>
            <td><input name="txtpw" type="password" ></td>
          </tr>
        <tr> 
            <td>&nbsp;</td>
            <td>&nbsp;</td>
  </tr>
          <tr><td>&nbsp;</td>
          <td><input type="submit" name="submit" value="SignIN"/></td></tr>
          </table>
         </form> 
        <br />
  
</body>
</html>
