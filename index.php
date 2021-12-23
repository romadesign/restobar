<?php include './db/dbconnect.php';?>
<?php require('fetch/_nav.php');?>
<?php include_once('templates/header.php') ?>

<!-- Category container starts here -->
<div class="container my-3 mb-5">
    <br><br><br>
    <div class="col-lg-2 text-center bg-lightmy-3"
        style="margin:auto;border-top: 2px groove black;border-bottom: 2px groove black;">
        <h2 class="text-center">Menú</h2>
    </div>
    <br>
    <div class="row">
    
        <!-- Fetch all the categories and use a loop to iterate through categories -->
        <?php 
        getCategorie()
      ?>
    </div>
</div>

<?php include_once('templates/footer.php') ?>