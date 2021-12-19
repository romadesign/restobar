<?php require('./fetch/_fetchUser.php') ?>
<div class="container">
    <div class="row content_menuManage">
		<div class="col-lg-4">
			<!-- Create Item -->
			<form action="<?php echo createUser() ?>" method="POST">
				<div class="card mb-3">
					<div class="card-header">
						Create New User
					</div>
					<div class="card-body">
						<div class="form-group">
                            <input class="form-control" id="username" name="username" placeholder="Elija un nombre de usuario único" type="text" required minlength="3" maxlength="11">
						</div>
						<div class="form-group">
                            <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Ingrese su nombre" required>
						</div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Ingrese su apellido" required>
						</div>
                        <div class="form-group">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Ingrese un correo" required>
						</div>
                        <div class="form-group row my-0">
                            <div class="form-group col-md-6 my-0">
                                <b><label for="phone">Celular:</label></b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon">+64</span>
                                    </div>
                                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Ingrese el número de teléfono" required  maxlength="9">
                                </div>
                            </div>
                            <div class="form-group col-md-6 my-0">
                                <b><label for="userType">Type:</label></b>
                                <select name="userType" id="userType" class="custom-select browser-default" required>
                                <option value="0">User</option>
                                <option value="1">Admin</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <b><label for="password">Contraseña:</label></b>
                            <input class="form-control" id="password" name="password" placeholder="Ingrese una contraseña" type="password" required data-toggle="password" minlength="4" maxlength="21">
                        </div>
                        <div class="form-group">
                            <b><label for="password1">Renter Contraseña:</label></b>
                            <input class="form-control" id="cpassword" name="cpassword" placeholder="Repita la conseña" type="password" required data-toggle="password" minlength="4" maxlength="21">
                        </div>
					</div>
					<button type="submit" name="createUser" class="btn btn-sm btn-primary button_menu_create"> Create </button>
				</div>
			</form>
		</div>
        <div class="col-md-8 content-principal">
			<table class="table">
				<thead>
					<tr>
						<th scope="col">Id</th>
						<th scope="col">Username</th>
						<th scope="col">Nmbre</th>
						<th scope="col">Email</th>
						<th scope="col">Celular</th>
						<th scope="col">Type</th>
						<th scope="col" class="text-center">Option</th>
					</tr>
				</thead>
				<tbody>
					<?php
					include('./db/dbconnect.php');
					$sql = "SELECT * FROM `users`";
					$result = mysqli_query($conn, $sql);

					$no_of_products = $result->num_rows;
					$no_of_products_per_page = 2;

					$no_of_pages = ceil($no_of_products / $no_of_products_per_page);

					$page = 1;

					if (isset($_GET["pagination"])) {
						$page = $_GET["pagination"];
					}
					$start_limit = ((int)$page - (int)1) * $no_of_products_per_page;

					$sql = "SELECT * FROM users where id > $start_limit LIMIT  $no_of_products_per_page";

					$sel_query = mysqli_query($conn, $sql)  or die(mysqli_error($conn));

					while ($row = mysqli_fetch_array($sel_query, MYSQLI_ASSOC)) { ?>
						<tr>
							<th scope="row" class="details_menu"><?php echo $row['id'] ?></th>
							<th scope="row" class="details_menu"><?php echo $row['username'] ?></th>
							<th scope="row" class="text-center">
                                <p><?php echo $row['firstName'] ?></p>
                                <p><?php echo $row['lastName'] ?></p>
                            </th>
                            <th scope="row" class="text-center"><?php echo $row['email'] ?></th>
                            <th scope="row" class="text-center"><?php echo $row['phone'] ?></th>
                            <th scope="row" class="text-center"><?php echo $row['userType'] ?></th>
							
							<th scope="row" class="text-center">
								<div class="row text-rigth ml-3">
									<div class="ml-3">
											<a href="userManageUpdate.php?id=<?php echo $row['id'] ?>"><i class="fas fa-edit"></i></a>
									</div>
									<form action="fetch/_fetchUser.php" method="POST" class="ml-3">
										<button name="removeUser" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
										<input type="hidden" name="id" value="<?php echo $row['id'] ?>">
									</form>
								</div>
							</th>
						</tr>
					<?php } ?>
				</tbody>
			</table>
			<div class="content_pagination">
				<!-- Pagination button -->
				<nav>
					<ul class="pagination">
						<li class="page-item"></li>
						<?php
						for ($i = 1; $i <= $no_of_pages; $i++) {
							$pageName = basename($_SERVER["PHP_SELF"]);
							if ($page == $i) {
								echo "
								<li class='page-item active'>
									<a href='$pageName?page=userManage&pagination={$i}' class='page-link'>{$i}</a>
								</li>
							";
							} else {
								echo "
								<li>
									<a href='$pageName?page=userManage&pagination={$i}' class='page-link'>{$i}</a>
								</li>
							";
							}
						} ?>
						<li class="page-item"></li>
					</ul>
				</nav>
			</div>
		</div>
	</div>
</div>