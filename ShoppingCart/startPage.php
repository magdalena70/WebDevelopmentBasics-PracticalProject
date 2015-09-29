<?php include('allUsersPages/header.php'); ?>
<?php include('registeredUserPages/config.php'); ?>
<?php include('functions/catchErrors.php'); ?>
<?php
checkConnectionDb();
mysql_connect(DB_HOST, DB_USER, DB_PASS);
mysql_select_db(DB_NAME);
include('./registeredUserPages/currentPromotion.php')
?>

    <div class="container">
        <div class="row">
            <div class="list-group">
                <a href="./registeredUserPages/login.php" class="list-group-item">Login</a>
                <span> or </span>
                <a href="./allUsersPages/register.php" class="list-group-item">Register</a>
            </div>
        </div>
    </div>

<?php include('allUsersPages/footer.php'); ?>