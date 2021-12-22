<?php include 'fetch/_dbconnect.php';
include 'fetch/_nav.php';
include ('templates/header.php'); ?>

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="row ">
        <div class="d-flex justify-content-between">
            <div class="col-lg-6">
                <h4 class="title">Contactar</h4>
            </div>
        </div>

        <?php
            $passSql = "SELECT * FROM users WHERE id='$userId'"; 
            $passResult = mysqli_query($conn, $passSql);
            $passRow=mysqli_fetch_assoc($passResult);
            $email = $passRow['email'];
            $phone = $passRow['phone'];
            ?>
        <form action="fetch/_manageContactUs.php" method="POST">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group mt-3">
                        <b><label for="email">Email:</label></b>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter Your Email"
                            required value="<?php echo $email ?>">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group mt-3">
                        <b><label for="phone">Celular</label></b>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon">+64</span>
                            </div>
                            <input type="tel" class="form-control" id="phone" name="phone"
                                aria-describedby="basic-addon" placeholder="Ingrese su número telefónico" required
                                value="<?php echo $phone ?>">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group mt-3">
                        <b><label for="orderId">Order Id:</label></b>
                        <input class="form-control" type="text" id="orderId" name="orderId" placeholder="Order Id"
                            value="0">
                        <small id="orderIdHelp" class="form-text text-muted">Si su problema no está relacionado
                            con el pedido(order id = 0).</small>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group mt-3">
                        <b><label for="password">Password:</label></b>
                        <input class="form-control" id="password" name="password" placeholder="Enter Password"
                            type="password" placeholder="Ingresa tu contraseña" required data-toggle="password">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group  mt-3">
                        <textarea class="form-control" id="message" name="message" rows="2" required minlength="6"
                            placeholder="Cómo podemos ayudarle ?"></textarea>
                    </div>
                </div>
                <?php if($loggedin){ ?>
                <div class="col-lg-12">
                    <button type="submit" class="btn btn-primary mt-3 mb-3 text-white border-0 py-2 px-3"><span>
                            Contactar <i class="ti-arrow-right"></i></span></button>
                    <button type="button" class="btn btn-success mt-3 mb-3 text-white border-0 py-2 px-3 mx-2"
                    data-bs-toggle="modal" data-bs-target="#history"><span> Respuestas <i
                                class="ti-arrow-right"></i></span></button>
                </div>
                <?php }else { ?>
                <div class="col-lg-12">
                    <button type="submit" class="btn btn-primary mt-3 text-white border-0 py-2 px-3" disabled><span>
                            Contactar <i class="ti-arrow-right"></i></span></button>
                    <small class="form-text text-muted">Primer inicio de sesión para contactar con
                        nosotros.</small>
                </div>
                <?php } ?>
            </div>
        </form>
    </div>
</div>

<!-- history Modal -->
<div class="modal fade" id="history" tabindex="-1" aria-labelledby="history" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="history">Sus mensajes enviados</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="bd">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Contact Id</th>
                            <th scope="col">Order Id</th>
                            <th scope="col">Message</th>
                            <th scope="col">datetime</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php 
                        $sql = "SELECT * FROM `contact` WHERE `userId`='$userId'"; 
                        $result = mysqli_query($conn, $sql);
                        $count = 0;
                        while($row=mysqli_fetch_assoc($result)) {
                            $contactId = $row['contactId'];
                            $orderId = $row['orderId'];
                            $message = $row['message'];
                            $datetime = $row['time'];
                            $count++;
                            echo '<tr>
                                    <td>' .$contactId. '</td>
                                    <td>' .$orderId. '</td>
                                    <td>' .$message. '</td>
                                    <td>' .$datetime. '</td>
                                  </tr>';
                        }                
                        if($count==0) {
                          ?><script>
                            document.getElementById("bd").innerHTML =
                                '<div class="my-1">you have not contacted us.</div>';
                            </script> <?php
                        }    
                      ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<?php include_once('templates/footer.php') ?>