<?php require('fetch/_fetchcategory.php') ?>
<div class="container">
	<div class="row content_menuManage">
		<div class="col-lg-4">
			<!-- Create Item -->
			<form action="<?php echo createCategory()?>" method="post" enctype="multipart/form-data">
				<div class="card mb-3">
					<div class="card-header">
						Create New Categorie
					</div>
					<div class="card-body">
						<div class="form-group">
							<input type="text" class="form-control" name="categorieName" placeholder="Name:" required>
						</div>
						<div class="form-group">
							<textarea cols="30" rows="3" class="form-control" name="categorieDesc" placeholder="Description:" required></textarea>
						</div>
						<div class="form-group">
							<label for="image" class="control-label">Image</label>
							<input type="file" name="categorieImage" id="categorieImage" accept=".jpg" class="form-control" required style="border:none;">
							<small id="Info" class="form-text text-muted mx-3">Please .jpg file upload.</small>
						</div>
					</div>
					<button type="submit" name="createCategorie" class="btn btn-sm btn-primary button_menu_create"> Create </button>
				</div>
			</form>
		</div>
		<div class="col-md-8 content-principal">
			<table class="table">
				<thead>
					<tr>
						<th scope="col">Title</th>
						<th scope="col">Detail</th>
						<th scope="col">Img</th>
						<th scope="col" class="text-center">Option</th>
					</tr>
				</thead>
				<tbody>
					<?php
					include('./db/dbconnect.php');
					$sql = "SELECT * FROM `categories`";
					// $sql = "SELECT * FROM `categories`   
					// 		WHERE (
					// 			categorieName LIKE '%%' OR
					// 			categorieDesc LIKE '%%'
					// 		)";
					$result = mysqli_query($conn, $sql);

					$no_of_products = $result->num_rows;
					$no_of_products_per_page = 5;

					$no_of_pages = ceil($no_of_products / $no_of_products_per_page);

					$pages = 1;

					if (isset($_GET["pagm-nation"])) {
						$pages = $_GET["pagm-nation"];
					}
					$start_limit = ((int)$pages - (int)1) * $no_of_products_per_page;

					$sql = "SELECT * FROM categories where categorieId > $start_limit LIMIT  $no_of_products_per_page";

					// SELECT * FROM `menu` WHERE (
					// 		menuName LIKE '%queso%' OR
					// 		menuDesc LIKE '%queso%') ORDER BY 1 LIMIT  5

					$sel_query = mysqli_query($conn, $sql)  or die(mysqli_error($conn));

					while ($row = mysqli_fetch_array($sel_query, MYSQLI_ASSOC)) { ?>
						<tr>
							<th scope="row" class="details_menu"><?php echo $row['categorieName'] ?></th>
							<th scope="row" class="details_menu"><?php echo $row['categorieDesc'] ?></th>
							<th scope="row" class="bgc">
								<img class="image_menu" src="data:image/png;base64,<?php echo base64_encode(file_get_contents($row['categorieImage'])) ?>">
							</th>
							<th scope="row" class="text-center">
								<div class="row text-rigth ml-3">
									<div class="ml-3">
											<a href="categorieManageUpdate.php?id=<?php echo $row['categorieId'] ?>"><i class="fas fa-edit"></i></a>
									</div>
									<form action="fetch/_fetchcategory.php" method="POST" class="ml-3">
										<button name="remove" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
										<input type="hidden" name="categorieId" value="<?php echo $row['categorieId'] ?>">
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
							$namePage = basename($_SERVER["PHP_SELF"]);
							if ($pages == $i) {
								echo "
								<li class='page-item active'>
									<a href='$namePage?page=categoryManage&pagm-nation={$i}' class='page-link'>{$i}</a>
								</li>
							";
							} else {
								echo "
								<li>
									<a href='$namePage?page=categoryManage&pagm-nation={$i}' class='page-link'>{$i}</a>
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