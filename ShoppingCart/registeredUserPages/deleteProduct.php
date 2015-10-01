<?php include('profileHeader.php'); ?>
<?php include('config.php'); ?>
<?php include('../functions/catchErrors.php'); ?>

<?php
if (isset($_SESSION['user'])) :
    ?>

    <div class="row">
        <h2>Do you want to remove this product:</h2>
        <p>Name: <?= $_GET['productName'] ?></p>
        <p>Price: <?= $_GET['productPrice'] ?></p>
        <p>Quantity: <?= $_GET['quantity'] ?></p>
    </div>

    <form method="post" class="form-horizontal" role="form">
        <div class="form-group">
            <div class="col-sm-6">
                <button type="submit"name="deleteProduct" class="btn btn-default">
                    Delete <span class="glyphicon glyphicon-trash"></span>
                </button>
            </div>
        </div>
    </form>

    <?php
    if (isset($_POST['deleteProduct'])) :
        checkConnectionDb();
        mysql_connect(DB_HOST, DB_USER, DB_PASS);
        mysql_select_db(DB_NAME);

        $deleteSql = "DELETE FROM Products WHERE Id = '" . $_GET['productId'] . "'";
        $result = mysql_query($deleteSql);
        header("Location: main.php?user=" . $_SESSION['user']);
        die;
    endif;
    include('../allUsersPages/footer.php');

else :
    header('Location: ./startPage.php');
    die;
endif;
?>