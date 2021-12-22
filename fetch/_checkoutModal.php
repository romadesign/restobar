<!-- Modal -->
<div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Realizar Pedidó</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="fetch/_manageCart.php" method="post">
                    <div class="form-group">
                        <b><label for="address">Dirección:</label></b>
                        <input class="form-control" id="address" name="address" placeholder="Calle .." type="text"
                            required minlength="3" maxlength="500">
                    </div>
                    <div class="form-group">
                        <b><label for="address1">Alguna referencia:</label></b>
                        <input class="form-control" id="address1" name="address1" placeholder="Estamós cerca al Metro"
                            type="text">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6 mb-0">
                            <b><label for="phone">Celular:</label></b>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon">+64</span>
                                </div>
                                <input type="tel" class="form-control" id="phone" name="phone" placeholder="xxxxxxxxxx"
                                    required maxlength="9">
                            </div>
                        </div>
                        <div class="form-group col-md-6 mb-0">
                            <b><label for="zipcode">Código postal de tú localidad:</label></b>
                            <input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="xxxxxx"
                                required maxlength="6">
                        </div>
                    </div>
                    <div class="form-group">
                        <b><label for="password">Escribe tu contraseña:</label></b>
                        <input class="form-control" id="password" name="password" placeholder="Ingresa tu contraseña para validar el pedido"
                            type="password" required minlength="4" maxlength="21" data-toggle="password">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <input type="hidden" name="amount" value="<?php echo $totalPrice ?>">
                        <button type="submit" name="checkout" class="btn btn-success">Enviar datos</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>