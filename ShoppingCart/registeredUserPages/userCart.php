<?php include('profileHeader.php'); ?>
<?php include('config.php'); ?>
<?php include('../functions/catchErrors.php'); ?>

<?php
if (isset($_SESSION['user'])) :
    $subtotal = 0.00;
    ?>

    <div class="row">
        <h2>User shopping cart...<span class="glyphicon glyphicon-shopping-cart"></span></h2>
        <p>Product Name: <?= $_GET['productName'] ?></p>
        <p>Product Price: <?= $_GET['productPrice'] ?></p>
        <?php $subtotal = $subtotal + $_GET['productPrice'] ?>
        <p>Subtotal: <?= $subtotal ?></p>

        <?php
        $total = $subtotal;
        if(isset($_SESSION['discount'])) :
            $discount = $_SESSION['discount'];
            $total = ($total * $discount)/100;
            ?>

            <p>Discount: <?= $discount ?>%</p>
            <p>Total: <?= number_format((float)$total, 2, '.', ''); ?></p>

        <?php
        else:
            ?>

            $discount = 0.00;
            <p>Discount: $discount</p>
            <p>Total: <?= $subtotal ?></p>

            <?php
        endif;
            ?>

    </div>

<?php
    checkConnectionDb();
    mysql_connect(DB_HOST, DB_USER, DB_PASS);
    mysql_select_db(DB_NAME);

    $addShoppingCartSql =
        "INSERT INTO ShoppingCarts (UserId, Subtotal, Total, Discount, Purchaser_Id)
                VALUES ('".$_SESSION['userId']."', '".$subtotal."', '".$total."', '".$discount."', '".$_SESSION['userId']."')";
    $result = mysql_query($addShoppingCartSql);
    $row = @mysql_fetch_assoc($result);
    //header('Location: userCart.php?user=' . $_SESSION['user']);
    //die;


    include('../allUsersPages/footer.php');

else :
    header('Location: ./startPage.php');
    die;
endif;
?>