<h1 style="margin-top:98px">Welcome back <b><?php echo $_SESSION['adminusername']; ?></b></h1>
<?php include("fetch/fetch.php") ;?>

<?php if(isset($_SESSION['message'])){ ?>
                <div class="alert alert-<?= $_SESSION['message_type']?> alert-dismissible fade show" role="alert">
                    <?= $_SESSION['message'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php session_unset(); } ?> 