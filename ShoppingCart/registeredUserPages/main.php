<?php include('profileHeader.php'); ?>
<?php include('config.php'); ?>

    <div class="row">
        <?php
        if (isset($_SESSION['user'])) :
            ?>
            <p>Hello, <?= $_SESSION['userFirstName']." ".$_SESSION['userLastName']; ?>!</p>
            <?php
            mysql_connect(DB_HOST, DB_USER, DB_PASS);
            mysql_select_db(DB_NAME);
            include('searchProductByName.php');
            include('categories.php');
        else :
            header('Location: ./startPage.php');
            die;
        endif;
        ?>

    </div>

<?php include('../allUsersPages/footer.php'); ?>