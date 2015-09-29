<?php include('profileHeader.php'); ?>
<?php include('config.php'); ?>
<?php include('../functions/catchErrors.php'); ?>

<?php
if (isset($_SESSION['user'])) :
?>

    <div class="row">
        <h2>Edit profile:</h2>
        <form method="post" class="form-horizontal" role="form">
            <div class="form-group">
                <label class="control-label col-sm-2" for="firstName">First name:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter firstName" value="<?= $_SESSION['userFirstName'] ?>" required="true">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="secondName">Last name:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="secondName" name="secondName" placeholder="Enter last name" value="<?= $_SESSION['userLastName'] ?>" required="true">
                </div>
            </div>

            <?php
            if(isset($_SESSION['userEmail'])):
                ?>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Email</label>
                    <div class="col-sm-6">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="<?= $_SESSION['userEmail'] ?>">
                    </div>
                </div>

                <?php
                else:
                    ?>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="email">Email</label>
                        <div class="col-sm-6">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="null">
                        </div>
                    </div>

                    <?php
                endif;
                ?>

            <div class="form-group">
                <div class="col-sm-6">
                    <button type="submit" class="btn btn-default">Update</button>
                </div>
            </div>
        </form>
    </div>

<?php
    if (isset($_POST['firstName'])){
        checkConnectionDb();
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