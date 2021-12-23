<?php 
session_start();
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  $loggedin= true;
  $userId = $_SESSION['userId'];
  $username = $_SESSION['username'];
}
else{
  $loggedin = false;
  $userId = 0;
}

$sql = "SELECT * FROM `sitedetail`";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$systemName = $row['systemName'];
?>

<?php 
include('templates/header.php');
include 'fetch/_loginModal.php';
include 'fetch/_signupModal.php';
include 'fetch/_fetch_general.php';
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <div class="d-flex">
            <a class="navbar-brand" href="index.php"><?php echo $systemName ?></a>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Categorías
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php echo getCategorieNav() ?>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="content_left">
            <!-- Cart contador -->
            <?php
                
                $countsql = "SELECT SUM(`itemQuantity`) FROM `viewcart` WHERE `userId`=$userId"; 
                $countresult = mysqli_query($conn, $countsql);
                $countrow = mysqli_fetch_assoc($countresult);      
                $count = $countrow['SUM(`itemQuantity`)'];
                if(!$count) {
                $count = 0; 
                } ?>
            <a href="viewCart.php">
                <button type="button" class="btn btn-ligth mx-2" title="Mí pedido">
                    <i class="fas fa-shopping-cart"></i>
                    <i class="bi bi-cart"><?php echo $count  ?></i>
                </button>
            </a>
            <?php 
              if($loggedin){
                //Message
                
                $sql = "SELECT * FROM `contactreply` WHERE `userId`='$userId'"; 
                $result = mysqli_query($conn, $sql);
                $count = 0;
                while($row=mysqli_fetch_assoc($result)) {
                    $count++;
                }
                echo `<script>document.getElementById("totalMessage").innerHTML = "' .$count. '";</script>`;
                if($count==0) { ?>
                <script> document.getElementById("messagebd").innerHTML =
                  '<div class="my-1">No has recibido ningún mensaje.</div>';
                </script> 
            <?php } ?>
            <!-- Message -->
            <div class="icon-badge-container d-flex">
                <a href="#" data-bs-toggle="modal" data-bs-target="#adminReply">
                    <i class="far fa-envelope icon-badge-icon"></i>
                <div class="icon-badge "><span id="totalMessage" class="fst-italic">0</span></a>
            </div>
            <!-- Message -->
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><?php echo $username ?></a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li class="nav-item">
                        <a class="nav-link" href="viewOrder.php"><i class="fas fa-tasks"></i>&nbsp; Pedidos</a>
                    </li>
                    <li>
                        <form action="fetch/_logout.php" method="POST">
                        <i class="fas fa-power-off"></i>&nbsp;<input type="submit" value="Salir">
                        </form>
                    </li>
                </ul>
            </div>
            <?php }else { ?>
            <button type="button" class="btn ml-3" data-bs-toggle="modal" data-bs-target="#loginModal"> Login</button>
            <div class="register">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#signupModal">Registrar</button>
            </div>
            <?php }
              ?>
        </div>
    </div>
</nav>


<!-- Message Modal -->
<div class="modal fade" id="adminReply" tabindex="-1" role="dialog" aria-labelledby="adminReply" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="adminReply">Respuesta del administrador</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="messagebd">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Contact Id</th>
                            <th scope="col">Mensaje</th>
                            <th scope="col">Fecha y hora</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                

                      $sql = "SELECT * FROM `contactreply` WHERE `userId`='$userId'"; 
                      $result = mysqli_query($conn, $sql);
                      $count = 0;
                      while($row=mysqli_fetch_assoc($result)) {
                          $contactId = $row['contactId'];
                          $message = $row['message'];
                          $datetime = $row['datetime'];
                          $count++;
                          echo '<tr>
                                  <td>' .$contactId. '</td>
                                  <td>' .$message. '</td>
                                  <td>' .$datetime. '</td>
                                  <td>
                                  <form action="fetch/_fetchContactGeneral.php" method="POST" class="ml-3">
                                    <button name="removeMessage" class="btn btn-sm btn-danger">
                                      <i class="fas fa-trash-alt"></i>
                                    </button>
                                    <input type="hidden" name="contactId" value="'. $contactId .'">
                                  </form>
                                  </td>
                                </tr>';
                      }
                      echo '<script>document.getElementById("totalMessage").innerHTML = "' .$count. '";</script>';
                      if($count==0) {
                        ?><script>
                          document.getElementById("messagebd").innerHTML =
                              '<div class="my-1">No has recibido ningún mensaje.</div>';
                          </script> 
                    <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
