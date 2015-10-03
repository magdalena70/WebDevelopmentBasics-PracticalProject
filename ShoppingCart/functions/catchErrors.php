<?php
function checkConnectionDb(){
    $link = @mysql_connect(DB_HOST, DB_USER, DB_PASS);
    //$link = @mysqli( DB_HOST, DB_USER, DB_PASS, DB_NAME );
    if (!is_resource($link)) {
        echo "<div class='error'>
                <h4>Connexion impossible!</h4>
                <p>The server is not responding (or the local server's socket is not correctly configured).</p>
            </div>";
        die;
    }
    return true;
}

function checkForUniqueUsername(){
    $link = mysql_connect(DB_HOST, DB_USER, DB_PASS);
    $errorCode = mysql_errno($link);
    if($errorCode == 1062) {
        echo "<div class='error'>
                    <h4>User with that name already exists!</h4>
                    <p>" . mysql_errno($link) . ": " . mysql_error($link) . "</p>
                </div>";
        die;
    }
    return true;
}
