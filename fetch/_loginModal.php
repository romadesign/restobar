<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Iniciar Sessión</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="fetch/_handleLogin.php" method="post">
              <div class="text-left my-2">
                  <b><label for="username">Username</label></b>
                  <input class="form-control" id="loginusername" name="loginusername" placeholder="Enter Your Username" type="text" required>
              </div>
              <div class="text-left my-2">
                  <b><label for="password">Password</label></b>
                  <input class="form-control" id="loginpassword" name="loginpassword" placeholder="Enter Your Password" type="password" required data-toggle="password">
              </div>
              <button type="submit" class="btn btn-success">Ingresar</button>
            </form>
            <p class="mb-0 mt-1">¿No tienes una cuenta? <a href="#"  type="button" data-bs-toggle="modal" data-bs-target="#signupModal">Regístrate ahora</a>.</p>

      </div>
    </div>
  </div>
</div>
