<?php require('./fetch/_fetchUser.php') ?>
<?php include_once('./templates/header.php') ?>

<div class="container">
    <div class="row">
        <div><a href="index.php?page=userManage"> <- Atras</a></div>
        <?php echo updateUser(); ?>

    </div>
</div>

<?php include_once('./templates/footer.php') ?>