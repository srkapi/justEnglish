<?php

session_start();
//validamos si se ha hecho o no el inicio de sesion correctamente
//si no se ha hecho la sesion nos regresará a login.php
if(!isset($_SESSION['usuario'])) 
{
  header('Location: login.php'); 
  exit();
}


include 'index.php';

?>

<div class="row" ng-app>
  <div class="col-lg-6" id="newUserRow">
		<div class="panel panel-default" >
			<div class="panel-heading">
			New User
			</div>
			<div class="panel-body">
				<div class="row" id="NewUser">
					 <div class="form-group">
					 	<form action="userSucess.php" method="post" id="newUser" name="newUser"> 
					 		<table>
					 			<tr>
					 				<td><label>Name: </label></td>
					 				<td><input  type="text"  name="name" id="name"required></td>
					 			</tr>
					 			<tr>
					 				<td><label>Last Name: </label></td>
					 				<td><input type="text"  name="lastName" id="lastName"  required></td>
					 			</tr>
					 			<tr>
					 				<td><label>Telefono: </label></td>
					 				<td><input type="text"  name="phone" id="phone" required></td>
					 			</tr>
					 			<tr>
					 				<td><label>Dni: </label></td>
					 				<td><input type="text"  name="dni" id="dni"  required></td>
					 			</tr>
					 			<tr>
					 				<td><label>email: </label></td>
					 				<td><input type="email"  name="email" id="email"  required></td>
					 			</tr>
					 			<tr>
					 				<td><label>Pass: </label></td>
					 				<td><input type="password"  name="pass" id="pass" required ></td>
					 			</tr>
					 			<tr>
									<td>
										<input type="hidden"  name="userID" id="userID" value="false">
								 		<button type="submit" class="btn btn-success" id="buttonUpate"  >Add</button>
									</td>
								</tr>
                        	</table>       
								
                        </form>    
                             
					 </div>
				</div>
			</div>


 		</div>
	</div>
</div>






 <style type="text/css">
 	#NewUser
 	{
	    margin-top: 4em;
	    margin-left: 5em;
	}

	#newUserRow{
		 margin-top: 4em;
	    margin-left: 5em;
	}
 	


 </style>

</body>
</html>

<?php
function altaUser($conn)
{
	$name=$_POST["name"];
	$apellido=$_POST["lastName"]; 
	$pass=$_POST["pass"]; 
	$userID=$_POST["user"]; 
	$email=$_POST["email"]; 
	$phone=$_POST["phone"];
	$dni=$_POST["dni"];
	$sql = "INSERT INTO user (name,apellido,pass,userID,email,telefono)
		VALUES ('$name','$apellido','$pass','$userID','$email','$phone')";
	if ($conn->query($sql) === TRUE) {
		header('Location: userSucess.php');
	} else{
		echo "fatal error";
	}
	mysql_close();
}
?>