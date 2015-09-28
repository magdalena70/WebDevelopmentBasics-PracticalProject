<?php include('profileHeader.php'); ?>
<?php include('config.php'); ?>

<?php
if (isset($_SESSION['user'])) :
?>

    <div class="row">
        <h2>Edit profile:</h2>
        <form method="post">
            First name: <input type="text" name="firstName" value="<?= $_SESSION['userFirstName']; ?>"/>
            <br />
            Last name: <input type="text" name="secondName" value="<?= $_SESSION['userLastName']; ?>"/>
            <br />

            <?php
            if(isset($_SESSION['userEmail'])):
                ?>

                    Email: <input type="email" name="email" value="<?= $_SESSION['userEmail']; ?>" />

                <?php
                else:
                    ?>

                    Email: <input type="email" name="email" value="null"/>

                    <?php
                endif;
                ?>

            <br />
            <input type="submit" value="Update" />
        </form>
    </div>

<?php
    if (isset($_POST['firstName'])){
        mysql_connect(DB_HOST, DB_USER, DB_PASS);
        mysql_select_db(DB_NAME);
        $updateSql = "UPDATE Users
              SET FirstName = '" . $_POST['firstName'] . "',
              SecondName = '". $_POST['secondName'] . "',
              Email = '" . $_POST['email'] . "'
              WHERE Username = '" . $_SESSION['user'] . "'";
        $result = mysql_query($updateSql);
        if($result) :
            $_SESSION['userFirstName'] = $_POST['firstName'];
            $_SESSION['userLastName'] = $_POST['secondName'];
            if($_POST['email'] != null){
                $_SESSION['userEmail'] = $_POST['email'];
            }
            header("Location: main.php?user=" . $_SESSION['user']);
            exit;
        endif;
    }

    if(!isset($_GET['user']) || $_GET['user'] != $_SESSION['user']):
        header("Location: main.php");
        exit;
    endif;
    include('../allUsersPages/footer.php');

else :
    header('Location: startPage.php');
    die;
endif;
?>