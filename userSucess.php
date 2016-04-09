<?php

$servername = "localhost";
$username = "root";
$password = "alberto";
$dbname = "just";

session_start();
//validamos si se ha hecho o no el inicio de sesion correctamente
//si no se ha hecho la sesion nos regresará a login.php
if(!isset($_SESSION['usuario'])) 
{
  header('Location: login.php'); 
  exit();
}

$name=$_POST["name"];
$apellido=$_POST["lastName"]; 
$pass=$_POST["pass"]; 
//$userID=$_POST["user"]; 
$email=$_POST["email"]; 
$phone=$_POST["phone"];
$dni=$_POST["dni"];

$conn = mysqli_connect($servername, $username, $password, $dbname);



$sql = "INSERT INTO user (name,lastName,pass,email,telefono)
	VALUES ('$name','$apellido','$pass','$email','$phone')";

$conn->query($sql);



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
					 	todo va bien
					 	s
					 </div>
					 	<button type="submit" class="btn btn-success" id="buttonUpate"  onclick="validar()">Add</button>
									</td>
				</div>
			</div>


 		</div>
	</div>
</div>



<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
 <script  src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.7/angular.min.js"></script>
<script type="text/javascript" src="https://cdn.firebase.com/js/client/1.1.1/firebase.js"></script>
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery-serialize-object/2.0.0/jquery.serialize-object.compiled.js"></script>
<script type="text/javascript" src="http://cdn.jsdelivr.net/jquery.validation/1.14.0/jquery.validate.min.js"></script>
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/path.js/0.8.4/path.min.js"></script>

<script type="text/javascript">
		
function validar(){
	var ref = new Firebase("https://pruebajsut.firebaseio.com/");
	ref.createUser({
		email:"<?php echo $email; ?>",
		password:"<?php echo $pass; ?>"
		}, function(error, userData) {
		if (error) {
			switch (error.code) {
			case "EMAIL_TAKEN":
				console.log("The new user account cannot be created because the email is already in use.");
			break;
			case "INVALID_EMAIL":
				console.log("The specified email is not a valid email.");
			break;
			default:
				console.log("Error creating user:", error);
			}
		} else {
			console.log("Successfully created user account with uid:", userData.uid);
		}
	});

}
       
    
</script>



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

