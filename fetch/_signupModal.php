<!-- Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="fetch/_handleSignup.php" method="post">
                    <div class="form-group">
                        <b><label for="username">Username</label></b>
                        <input class="form-control" id="username" name="username" placeholder="Choose a unique Username"
                            type="text" required minlength="3" maxlength="11">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <b><label for="firstName">Nombre:</label></b>
                            <input type="text" class="form-control" id="firstName" name="firstName"
                                placeholder="Nombre required">
                        </div>
                        <div class="form-group col-md-6">
                            <b><label for="lastName">Apellido:</label></b>
                            <input type="text" class="form-control" id="lastName" name="lastName"
                                placeholder="Apellido" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <b><label for="email">Email:</label></b>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Ingrese un correo"
                            required>
                    </div>
                    <div class="form-group">
                        <b><label for="phone">Celular:</label></b>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon">+64</span>
                            </div>
                            <input type="tel" class="form-control" id="phone" name="phone"
                                placeholder="Ingrese un número de Celular" required  maxlength="9">
                        </div>
                    </div>
                    <div class="text-left my-2">
                        <b><label for="password">Contraseña:</label></b>
                        <input class="form-control" id="password" name="password" placeholder="Ingrese contraseña"
                            type="password" required data-toggle="password" minlength="4" maxlength="21">
                    </div>
                    <div class="text-left my-2">
                        <b><label for="password1">Repita nuevamente su contraseña:</label></b>
                        <input class="form-control" id="cpassword" name="cpassword" placeholder="Repita contraseña"
                            type="password" required data-toggle="password" minlength="4" maxlength="21">
                    </div>
                    <button type="submit" class="btn btn-success">Crear cuenta  </button>
                </form>
            </div>
        </div>
    </div>
</div>