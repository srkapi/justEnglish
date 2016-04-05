<?php
session_start();
//validamos si se ha hecho o no el inicio de sesion correctamente
//si no se ha hecho la sesion nos regresará a login.php
if(!isset($_SESSION['usuario'])) 
{
  header('Location: login.php'); 
  exit();
}

$db = Database::getInstance();
$conn = $db->getConnection(); 

include 'index.php';

?>

 <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            List User
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Last Name</th>
                                            <th>Phone</th>
                                            <th>Continue</th>
                                            <th>Delete</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                          <?php
                                                
                                            $result = "SELECT * from user";
                                           // $x=$conn->query($result);
                                            
                                         foreach ($conn->query($result) as $row) {
                                                echo '<tr>';
                                                echo '<td>'. $row['name'] . '</td>';
                                                echo '<td>'. $row['lastName'] . '</td>';
                                                echo '<td>'. $row['telefono'] . '</td>';
                                                echo '<td><button class="glyphicon glyphicon-trash" onclick="deleteUser('.$row['iduser'].','.'\''.$row['name'].'\''.')"/></td>';
                                                echo '<td><button class="glyphicon glyphicon-pencil" onclick="updateUser('.$row['iduser'].','.'\''.$row['name'].'\''.','.'\''.$row['apellido'].'\''.','.'\''.$row['user'].'\''.')"ng-click="edit=!edit"></td>';
                                                echo '</tr>';
                                            }
                                     
                                         ?>
                                         
                                    </tbody>
                                </table>
                            </div>

                   </div>
                </div>
              </div>
 </div>
</div>