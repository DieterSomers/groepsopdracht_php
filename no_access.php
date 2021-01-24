<?php
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

$public_access = true;
require_once "src/lib/autoload.php";
PrintHeaderNoAccess();
        print "<main class='container noaccess'><div><img src='images/404.png' alt=''><h2>Oei u hebt naast de bal geslagen en hebt helaas geen toegang! U kan wel <a href=index.php>inloggen</a> Of <a href=padel_register.php>registreren</a></h2></div></main>";
PrintFooter();
        ?>
