<?php
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

$public_access = true;
require_once "src/lib/autoload.php";
PrintStart();
        print "<main class='container noaccess'><div><img src='images/404.png' alt=''>
                <h2>Seems that you missed the ball and have no access to this page!
                <br>Please <a href=index.php>log in</a> or <a href=padel_register.php>register</a></h2></div></main>";
PrintFooter();
        ?>
