<?php require('./fetch/fetch.php') ?>
<?php include_once('./templates/header.php') ?>

<div class="container">
    <div class="row">
        <div><a href="index.php?page=menuManage"> <- Atras</a></div>
        <?php echo updatePizza(); ?>

    </div>
</div>

<?php include_once('./templates/footer.php') ?>