<?php include('profileHeader.php'); ?>
<?php include('config.php'); ?>
<?php include('../functions/catchErrors.php'); ?>

    <div class="row">
        <h2>Please login:</h2>
        <form method="post" class="form-horizontal" role="form">
            <div class="form-group">
                <label class="control-label col-sm-2" for="username">Username:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="username" name="user" placeholder="Enter username" required="true">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="pass">Password:</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" id="pass"  name="pass" placeholder="Enter password" required="true">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6">
                    <button type="submit" class="btn btn-default">Login</button>
                </div>
            </div>
        </form>
    </div>

<?php
if (isset($_POST['user'])) {
    $username = $_POST['user'];
    $password = $_POST['pass'];
    checkConnectionDb();
    mysql_connect(DB_HOST, DB_USER, DB_PASS);
    mysql_select_db(DB_NAME);

    $hashPass = hash('SHA256', $password);

    $loginQuery = "SELECT * FROM Users WHERE Username='{$username}' AND Password='{$password}'";
    $result = mysql_query($loginQuery);
    $row = @mysql_fetch_assoc($result);
    if($row) {
        //session_start();
        $_SESSION['user'] = $username;
        $_SESSION['userId'] = $row['Id'];
        $_SESSION['userFirstName'] = $row['FirstName'];
        $_SESSION['userLastName'] = $row['SecondName'];
        if($row['Email'] != null){
            $_SESSION['userEmail'] = $row['Email'];
        }
        header('Location: main.php');
        die;
    } else {
       echo 'Invalid login.';
    }
}
?>

<ul><li><a href="../allUsersPages/register.php">Go register</a></li></ul>

<?php include('../allUsersPages/footer.php') ?>