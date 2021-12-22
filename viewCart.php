<?php include_once('templates/header.php') ?>
<?php include 'fetch/_dbconnect.php';?>
<?php require 'fetch/_nav.php' ?>
<?php
if($loggedin){
?>

<div class="container" id="cont">
    <div class="row">
        <div class="alert alert-info mb-0" style="width: -webkit-fill-available;">
            <strong>Info!</strong> El pago en línea está actualmente deshabilitado, así que elija contra reembolso.
        </div>
        <div class="col-lg-12 text-center border rounded bg-light my-3">
            <h1>Mí pedido</h1>
        </div>
        <div class="col-lg-8">
            <div class="card wish-list mb-3">
                <table class="table text-center">
                    <thead class="thead-light">
                        <tr>
                            <th class="viewCartNro" scope="col">No.</th>
                            <th scope="col">Plato</th>
                            <th scope="col">Price Und</th>
                            <th scope="col">Cant.</th>
                            <th scope="col">Price Total</th>
                            <th scope="col">
                                <form action="fetch/_manageCart.php" method="POST">
                                    <button name="removeAllItem" class="btn btn-sm btn-outline-danger">Eliminar
                                        todo</button>
                                    <input type="hidden" name="userId"
                                        value="<?php $userId = $_SESSION['userId']; echo $userId ?>">
                                </form>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                $sql = "SELECT * FROM viewcart WHERE userId= $userId";
                                $result = mysqli_query($conn, $sql);
                                $counter = 0;
                                $totalPrice = 0;
                                while($row = mysqli_fetch_assoc($result)){
                                    $menuId = $row['menuId'];
                                    $Quantity = $row['itemQuantity'];
                                    $mysql = "SELECT * FROM menu WHERE menuId = $menuId";
                                    $myresult = mysqli_query($conn, $mysql);
                                    $myrow = mysqli_fetch_assoc($myresult);
                                    $menuName = $myrow['menuName'];
                                    $menuPrice = $myrow['menuPrice'];
                                    $total = $menuPrice * $Quantity;
                                    $counter++;
                                    $totalPrice = $totalPrice + $total; ?>

                        <tr>
                            <td class="viewCartNro"><?php echo $counter  ?></td>
                            <td><?php echo $menuName ?></td>
                            <td><?php echo $menuPrice ?></td>
                            <td>
                                <form id="frm<?php echo $menuId ?>">
                                    <input type="hidden" name="menuId" value="<?php echo $menuId  ?>">
                                    <input type="number" name="quantity" value="<?php echo $Quantity ?>"
                                        class="text-center" onchange="updateCart(<?php echo $menuId ?>)"
                                        onkeyup="return false" style="width:60px" min=1 oninput="check(this)"
                                        onClick="this.select();">
                                </form>
                            </td>
                            <td><?php echo $total ?></td>
                            <td>
                                <form action="fetch/_manageCart.php" method="POST">
                                    <button name="removeItem" class="btn btn-sm btn-outline-danger">Retirar</button>
                                    <input type="hidden" name="itemId" value="<?php echo $menuId ?>">
                                </form>
                            </td>
                        </tr>
                        <?php }
                                if( $counter == 0 ) {?>
                        <script>
                        document.getElementById("cont").innerHTML = `
                                         <div class="col-md-12 my-5">
                                            <div class="card">
                                              <div class="card-body cart">
                                                <div class="col-sm-12 empty-cart-cls text-center">
                                                  <img src="https://i.imgur.com/dCdflKN.png" width="130" height="130" class="img-fluid mb-4 mr-3">
                                                  <h3><strong>Tu carrito esta vacío</strong></h3>
                                                  <h4>Agrega algo para hacerme feliz :)</h4>
                                                  <a href="index.php" class="btn btn-primary cart-btn-transform m-3" data-abc="true">seguir comprando</a>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        `;
                        </script>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card wish-list mb-3">
                <div class="pt-4 border bg-light rounded p-3">
                    <h5 class="mb-3 text-uppercase font-weight-bold text-center">RESUMEN DE PEDIDO</h5>
                    <ul class="list-group list-group-flush">
                        <li
                            class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0 bg-light">
                            Precio total<span><?php echo $totalPrice ?> €</span></li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0 bg-light">
                            Transporte<span>0 €</span></li>
                        <li
                            class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3 bg-light">
                            <div>
                                <strong>La cantidad total de</strong>
                                <strong>
                                    <p class="mb-0">(incluidos impuestos y cargos)</p>
                                </strong>
                            </div>
                            <span><strong><?php echo $totalPrice ?> €</strong></span>
                        </li>
                    </ul>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1"
                            checked>
                        <label class="form-check-label" for="flexRadioDefault1">
                            Contra reembolso
                        </label>
                    </div>
                    <!-- <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault1" id="flexRadioDefault1"
                            disabled>
                        <label class="form-check-label" for="flexRadioDefault1">
                            Online Payment
                        </label>
                    </div><br> -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#checkoutModal">
                        Realizar Pedido
                    </button>
                </div>
            </div>
            <!-- <div class="mb-3">
                <div class="pt-4">
                    <a class="dark-grey-text d-flex justify-content-between"
                        style="text-decoration: none; color: #050607;" data-toggle="collapse" href="#collapseExample"
                        aria-expanded="false" aria-controls="collapseExample">
                        Add a discount code (optional)
                        <span><i class="fas fa-chevron-down pt-1"></i></span>
                    </a>
                    <div class="collapse" id="collapseExample">
                        <div class="mt-3">
                            <div class="md-form md-outline mb-0">
                                <input type="text" id="discount-code" class="form-control font-weight-light"
                                    placeholder="Enter discount code">
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</div>

<?php
    }
    else {
        echo '<div class="container" style="min-height : 610px;">
        <div class="alert alert-info my-3">
            <font style="font-size:22px"><center>Necesitas iniciar sessión para ingresar a tu carrito de compra <strong><a type="button" class="" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a></strong></center></font>
        </div></div>';
    }
    ?>
<?php require 'fetch/_checkoutModal.php'; ?>
<?php require 'fetch/_footer.php' ?>

<!-- Jquery -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<?php require 'templates/footer.php' ?>

<script>
function check(input) {
    if (input.value <= 0) {
        input.value = 1;
    }
}

function updateCart(id) {
    $.ajax({
        url: 'fetch/_manageCart.php',
        type: 'POST',
        data: $("#frm" + id).serialize(),
        success: function(res) {
            location.reload();
        }
    })
}
</script>