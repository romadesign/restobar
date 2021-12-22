<?php 
    $itemModalSql = "SELECT * FROM `orders` WHERE `userId`= $userId";
    $itemModalResult = mysqli_query($conn, $itemModalSql);
    while($itemModalRow = mysqli_fetch_assoc($itemModalResult)){
        $orderid = $itemModalRow['orderId'];
?>

<!-- Modal -->
<div class="modal fade" id="orderItem<?php echo $orderid; ?>" tabindex="-1" role="dialog"
    aria-labelledby="orderItem<?php echo $orderid; ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderItem<?php echo $orderid; ?>">Tú pedido</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="container">
                    <div class="row">
                        <!-- Shopping cart table -->
                        <div class="table-responsive">
                            <table class="table text">
                                <thead>
                                    <tr>
                                        <th scope="col" class="border-0 bg-light">
                                            <div class="px-3">Item</div>
                                        </th>
                                        <th scope="col" class="border-0 bg-light">
                                            <div class="text-center">Cantidad</div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $mysql = "SELECT * FROM `orderitems` WHERE orderId = $orderid";
                                    $myresult = mysqli_query($conn, $mysql);
                                    while($myrow = mysqli_fetch_assoc($myresult)){
                                        $menuId = $myrow['menuId'];
                                        $itemQuantity = $myrow['itemQuantity'];
                                        
                                        $itemsql = "SELECT * FROM `menu` WHERE menuId = $menuId";
                                        $itemresult = mysqli_query($conn, $itemsql);
                                        $itemrow = mysqli_fetch_assoc($itemresult);
                                        $menuName = $itemrow['menuName'];
                                        $menuPrice = $itemrow['menuPrice'];
                                        $menuDesc = $itemrow['menuDesc'];
                                        $menuCategorieId = $itemrow['menuCategorieId']; ?>
                                    <tr>
                                        <th scope="row">
                                            <div class="p-2">
                                                <img src="img/menu-'.$menuId.'.jpg" alt="" width="70"
                                                    class="img-fluid rounded shadow-sm">
                                                <div class="ml-3 d-inline-block align-middle">
                                                    <h5 class="mb-0"> <a href="#"
                                                            class="text-dark d-inline-block align-middle"><?php echo $menuName ?></a>
                                                    </h5><span
                                                        class="text-muted font-weight-normal font-italic d-block"><?php echo $menuPrice ?> €</span>
                                                </div>
                                            </div>
                                        </th>
                                        <td class="align-middle text-center"><strong><?php echo $itemQuantity ?> Und.</strong></td>
                                    </tr>
                                    <?php  }?>
                                </tbody>
                            </table>
                        </div>
                        <!-- End -->
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php
    }
?>