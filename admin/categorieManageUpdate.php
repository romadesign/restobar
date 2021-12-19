<?php require('./fetch/_fetchcategory.php') ?>
<?php include_once('./templates/header.php') ?>

<div class="container">
    <div class="row">
        <div><a href="index.php?page=categoryManage"> <- Atras</a></div>
        <?php echo updateCategorie(); ?>

    </div>
</div>

<?php include_once('./templates/footer.php') ?>