<?php include('header.php'); ?>
<?php include('../registeredUserPages/config.php'); ?>
<?php include('../functions/catchErrors.php'); ?>

    <div class="row">
        <h3>Please register:</h3>
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
                <label class="control-label col-sm-2" for="firstName">First name:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter first name" required="true">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="lastName">Last name:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter last name" required="true">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="email">Email:</label>
                <div class="col-sm-6">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6">
                    <button type="submit" class="btn btn-default">Register</button>
                </div>
            </div>
        </form>
    </div>
<?php
if (isset($_POST['user'])) {
    $username = $_POST['user'];
    $password = $_POST['pass'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];

    checkConnectionDb();
    mysql_connect(DB_HOST, DB_USER, DB_PASS);
    mysql_select_db(DB_NAME);

    $registerSql =
        "INSERT INTO Users (Username,Password,FirstName,SecondName)
            VALUES ('".$username."', '".$password."', '".$firstName."', '".$lastName."')";
    $result = mysql_query($registerSql);
    $row = @mysql_fetch_assoc($result);
    checkForUniqueUsername();
    header('Location: ../registeredUserPages/login.php');
    die;
}
?>

    <ul><li><a href="../registeredUserPages/login.php">Go login</a></li></ul>

<?php include('footer.php') ?>