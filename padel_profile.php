<?php
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

require_once "src/lib/autoload.php";

PrintHeader();
?>

<main>
    <div class="container">

        <?php

print "<h2>Dit is de profile page</h2>";

       // if ( ! is_numeric( $_GET['pla_id']) ) die("Ongeldig argument " . $_GET['pla_id'] . " opgegeven");

       // $rows = GetData( "select * from players where pla_id=" . $_GET['pla_id'] );

        //get template
        $template = file_get_contents("src/html/profile.html");

        //merge
       // foreach ( $rows as $row )
        //{
          //  $output = $template;

           // foreach( array_keys($row) as $field )
            //{
              //  $output = str_replace( "@$field@", $row["$field"], $output );
            //}
            //print $output;
        //}

        ?>

    </div>
</main>

<?php
PrintFooter();
?>