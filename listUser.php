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

$conn = mysqli_connect($servername, $username, $password, $dbname);


$actualizar=$_POST["actualizar"];
if($actualizar != null && $actualizar!="false"){
    $id=$_POST["id"];
    update($conn,$id);
}

include 'index.php';

?>

 <div class="row" ng-app>
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            List User
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Last Name</th>
                                            <th>Phone</th>
                                            <th>Continue</th>
                                            <th>Pay</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                     <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Last Name</th>
                                            <th>Phone</th>
                                            <th>Continue</th>
                                            <th>Pay</th>
                                            <th>Edit</th>
                                        </tr>
                                    </tfoot>
                                    

                                    <tbody>
                                          <?php
                                            $result = "SELECT * from user ";
                                            foreach ($conn->query($result) as $row) {
                                                echo '<tr>';
                                                echo '<td>'. $row['name'] . '</td>';
                                                echo '<td>'. $row['lastName'] . '</td>';
                                                echo '<td>'. $row['telefono'] . '</td>';

                                                if($row['activo']){
                                                    echo '<td><button type="button" class="btn btn-success btn-circle"><i class="fa fa-check"></i>
                                                    </button></td>';
                                                }else{
                                                    echo '<td><button type="button" class="btn btn-warning btn-circle"><i class="fa fa-times"></i>
                                                    </button></td>';
                                                }
                                                if($row['pay']){
                                                    echo '<td><button type="button" class="btn btn-success btn-circle"><i class="fa fa-check"></i>
                                                    </button></td>';
                                                }else{
                                                    echo '<td><button type="button" class="btn btn-warning btn-circle"><i class="fa fa-times"></i>
                                                    </button></td>';
                                                }
                                                 echo '<td><button class="glyphicon glyphicon-pencil"
                                                  onclick="updateUser('.'\''.$row['pay'].'\''.','.'\''.$row['activo'].'\''.','.$row['iduser'].')" ng-click="edit=!edit"/></td>';
                                                echo '</tr>';
                                            }
                                     
                                         ?>
                                         
                                    </tbody>
                                </table>
                            </div>

                            <div ng-show="edit">
                             <div class="col-lg-3">
                                <div class="panel panel-yellow">
                                    <div class="panel-heading">
                                        Edit User
                                    </div>
                                    <div class="panel-body">

                                          <form id="edit" name="editUser" action="listUser.php" method="post">
                                                <p>
                                                Activo:  <select id="activo" name="activo">
                                                              <option value="1">Yes</option>
                                                              <option value="0">No</option>
                                                              
                                                            </select> 
                                                <br />
                                                 <p>
                                                Pay:  <select id="pay" name="pay">
                                                              <option value="1">Yes</option>
                                                              <option value="0">No</option>
                                                              
                                                            </select> 
                                                <br />
                                                <input type="hidden" name="id">
                                                <input type="hidden" name="actualizar" value="true">
                                                <button type="submit" class="btn btn-success" id="buttonUpate" ng-click="edit=!edit" >Update</button>
                                           </form>
                                       
                                    </div>
                                    <div class="panel-footer">
                                        Update User
                                    </div>
                                </div>
                         </div>
                     <div ng-hide="edit"></div>

                   </div>
                </div>
              </div>
 </div>
</div>

<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
 <script  src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.7/angular.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
    $('#dataTables').DataTable();
} );

function updateUser(pay,activo,id){
        document.forms[0].elements[0].placeholder=activo;
        document.forms[0].elements[1].placeholder=pay;
        document.forms[0].id.value=id;
        
        document.forms[0].actualizar.value="true";//actualiza
    }

</script>

<style type="text/css">


#buttonUpate{
    margin-top: 2em;
    margin-left: 2em;
}


</style>

</body>
</html>

<?php



function update($conn, $id){
        $pay=$_POST["pay"];
        $activo=$_POST["activo"]; 
        
        $sql="UPDATE user SET activo='$activo', pay='$pay' WHERE iduser='$id' ";
        
        $conn->query($sql);
        
}
  mysql_close();


?>