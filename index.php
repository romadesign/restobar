<?php include_once ('templates/header.php')?>
<?php include('db/dbconnect.php')?>
<?php require ('fetch/_nav.php') ?>

<div class="container">
    <div class="row">
        <?php 
          $sql = "SELECT * FROM `categories`"; 
          $result = mysqli_query($conn, $sql);
          while($row = mysqli_fetch_assoc($result)){ 
          $id = $row['categorieId'];
          $categorie = $row['categorieName'];
          $desc = $row['categorieDesc']?>
        <div class="col-xs-3 col-sm-3 col-md-3">
            <div class="card">
                <img class="image_menu"
                    src="data:image/png;base64,<?php echo base64_encode(file_get_contents($row['categorieImage'])) ?>">
                <div class="card-body">
                    <h5 class="card-title"><a
                            href="viewPizzaList.php?catid=<?php echo $id ?>"><?php echo  $categorie  ?></a></h5>
                    <p class="card-text"><?php echo substr($desc, 0, 30) ?></p>
                    <a href="viewPizzaList.php?catid=<?php echo $id ?>" class="btn btn-primary">View All</a>
                </div>
            </div>
        </div>
        <?php }
            ?>
    </div>
</div>
</div>
</div>

<?php include_once 'templates/footer.php';?>