<?php include_once('templates/header.php') ?>
<?php require 'fetch/_dbconnect.php';?>
<?php require 'fetch/_nav.php' ?>
<?php 
if($loggedin)
{?>
<div class="container">
<br><br><br>
    <div class="table-title">
        <div class="row">
            <div class="col-sm-6">
                <h2>Detalles del <b>pedido</b></h2>
            </div>
            <div class="col-sm-6 text-end">
                <a href="" class="btn btn-primary">
                <i class="fas fa-spinner"></i>
                  <span>Actualizar
                        lista</span></a>
                <a href="#" onclick="window.print()" class="btn btn-info">
                <i class="fas fa-print"></i>
                    <span>Imprimir</span></a>
            </div>
        </div>
    </div>

    <div class="table-wrapper" id="empty">
        <table class="table table-striped table-hover text-center">
            <thead>
                <tr>
                    <th>Order Id</th>
                    <th>Dirección</th>
                    <th>Celular</th>
                    <th>Monto</th>
                    <th>Modo de pago</th>
                    <th>Fecha de pedido</th>
                    <th>Estado</th>
                    <th>Items</th>
                </tr>
            </thead>
            <tbody>
                <?php
                      $sql = "SELECT * FROM `orders` WHERE `userId`= $userId";
                      $result = mysqli_query($conn, $sql);
                      $counter = 0;
                      while($row = mysqli_fetch_assoc($result)){
                          $orderId = $row['orderId'];
                          $address = $row['address'];
                          $zipCode = $row['zipCode'];
                          $phoneNo = $row['phoneNo'];
                          $amount = $row['amount'];
                          $orderDate = $row['orderDate'];
                          $paymentMode = $row['paymentMode'];
                          if($paymentMode == 0) {
                              $paymentMode = "Cash on Delivery";
                          }
                          else {
                              $paymentMode = "Online";
                          }
                          $orderStatus = $row['orderStatus'];
                          
                          $counter++; ?>

                <tr>
                    <td><?php echo $orderId ?></td>
                    <td><?php echo substr($address, 0, 20) ?>...</td>
                    <td><?php echo $phoneNo ?></td>
                    <td><?php echo $amount  ?> €</td>
                    <td><?php echo $paymentMode ?></td>
                    <td><?php echo $orderDate ?></td>
                    <td>
                        <a href="#" data-toggle="modal" data-bs-toggle="modal"
                            data-bs-target="#orderStatus<?php echo $orderId ?>" class="view">
                            <i class="fas fa-info-circle"></i>
                        </a>
                    </td>
                    <td>
                        <a href="#" data-toggle="modal" data-bs-toggle="modal"
                            data-bs-target="#orderItem<?php echo $orderId ?>" class="view" title="View Details">
                            <i class="far fa-list-alt"></i>
                        </a>
                    </td>
                </tr>
                <?php }
                    if($counter==0) {?>
                    <script> document.getElementById("empty").innerHTML = `
                      <div class="col-md-12 my-5">
                        <div class="card">
                          <div class="card-body cart">
                            <div class="col-sm-12 empty-cart-cls text-center">
                              <img src="https://i.imgur.com/dCdflKN.png" width="130" height="130" class="img-fluid mb-4 mr-3">
                              <h3><strong>You have not ordered any items.</strong></h3>
                              <h4>Por favor ordene para hacerme feliz :)</h4> 
                              <a href="index.php" class="btn btn-primary cart-btn-transform m-3" data-abc="true">seguir comprando</a>
                            </div>
                          </div>
                        </div>
                      </div>`;
                    </script> 
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php }
else { ?>
<div class="container" style="min-height : 610px;">
    <div class="alert alert-info my-3">
        <font style="font-size:22px">
            <center>Verifique su pedido. Necesitas <strong>
                    <a class="alert-link" type="button" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
                </strong></center>
        </font>
    </div>
</div>
<?php } ?>


<!-- Optional JavaScript -->

<?php 
include ('fetch/_orderItemModal.php');
include ('fetch/_orderStatusModal.php');
include_once('templates/footer.php') 
?>