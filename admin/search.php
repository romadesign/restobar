<?php require('./fetch/fetch.php') ?>
<?php require('./db/dbconnect.php') ?>


<div class="container">
	<div class="row">
		<div class="col-md-4">
            <?php 
                $busqueda = strtolower($_REQUEST['busqueda']);
                if(isset($_GET[$busqueda])){
                    header('Location: index.php?page=menuManage');
                }
            ?>
            <form action="<?php echo createPizza() ?>" method="post" enctype="multipart/form-data">
				<div class="card mb-3">
					<div class="card-header">
						Create New Item
					</div>
					<div class="card-body">
						<div class="form-group">
							<input type="text" class="form-control" name="pizzaName" placeholder="Name:" required>
						</div>
						<div class="form-group">
							<textarea cols="30" rows="3" class="form-control" name="pizzaDesc" placeholder="Description:" required></textarea>
						</div>
						<div class="form-group">
							<input type="number" class="form-control" name="pizzaPrice" Placeholder="Price:" required min="1">
						</div>
						<div class="form-group">
							<label class="control-label">Category: </label>
							<select name="pizzaCategorieId" id="pizzaCategorieId" class="custom-select browser-default" required>
								<option hidden disabled selected value>Select category</option>
								<?php
								$catsql = "SELECT * FROM `categories`";
								$catresult = mysqli_query($conn, $catsql);
								while ($row = mysqli_fetch_assoc($catresult)) {
									$catId = $row['categorieId'];
									$catName = $row['categorieName'];
									echo '<option value="' . $catId . '">' . $catName . '</option>';
								}
								?>
							</select>
						</div>
						<div class="form-group">
							<label for="image" class="control-label">Image</label>
							<input type="file" name="pizzaImage" id="pizzaImage" accept=".jpg" class="form-control" required style="border:none;">
							<small id="Info" class="form-text text-muted mx-3">Please .jpg file upload.</small>
						</div>
					</div>
					<button type="submit" name="createItem" class="btn btn-sm btn-primary button_menu_create"> Create </button>
				</div>
			</form>
        </div>
		<div class="col-md-8 content-principal">
			<table class="table">
				<thead>
				<tr>
					<th scope="col">Title</th>
					<th scope="col">Detail</th>
					<th scope="col">Price</th>
					<th scope="col">Cate.</th>
					<th scope="col">Img</th>
					<th scope="col" class="text-center">Option</th>
				</tr>
				</thead>
				<tbody>
					<?php
					include('./db/dbconnect.php');
					// $sql = "SELECT * FROM `pizza`";
					$sql = "SELECT * FROM `pizza`   
							WHERE (
								pizzaName LIKE '%$busqueda%' OR
								pizzaDesc LIKE '%$busqueda%'
							)";
                    $result = $conn->query($sql);
					while($row=$result->fetch_assoc()){ ?>
						<tr>
							<th scope="row" class="details_menu"><?php echo $row['pizzaName'] ?></th>
							<th scope="row" class="details_menu"><?php echo $row['pizzaDesc'] ?></th>
							<th scope="row" class="text-center"><?php echo $row['pizzaPrice'] ?></th>
							<th scope="row" class="text-center"><?php echo $row['pizzaCategorieId'] ?></th>
							<th scope="row" class="bgc">
								<img class="image_menu" src="data:image/png;base64,<?php echo base64_encode(file_get_contents($row['pizzaImage'])) ?>">
							</th>
							<th scope="row" class="text-center">
								<div class="row text-rigth ml-3">
									<div class="ml-3">
											<a href="menuManageUpdate.php?id=<?php echo $row['pizzaId'] ?>"><i class="fas fa-edit"></i></a>
									</div>
									<form action="fetch/fetch.php" method="POST" class="ml-3">
										<button name="removeItem" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
										<input type="hidden" name="pizzaId" value="<?php echo $row['pizzaId'] ?>">
									</form>
								</div>
							</th>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

