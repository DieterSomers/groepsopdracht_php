<?php
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

require_once "src/lib/autoload.php";

PrintHeader();
?>

<main>
    <div class="container">

        <?php

        $data = GetData( "select * from players inner join player_level on pla_lvl_id = lvl_id where pla_id=" . $_SESSION["user"]["pla_id"] );
        $row = $data[0]; //there's only 1 row in data

        //add extra elements
        $extra_elements['csrf_token'] = GenerateCSRF( "padel_profile.php"  );
        $extra_elements['datalist_levels'] = MakeDatalist('pla_level', 'select lvl_id, lvl_description from player_level');

        //get template
        $output = file_get_contents("src/html/profile_form.html");

        //merge
        $output = MergeViewWithData( $output, $data );
        $output = MergeViewWithExtraElements( $output, $extra_elements );
        $output = MergeViewWithErrors( $output, $errors );
        $output = RemoveEmptyErrorTags( $output, $data );

        print $output;

        ?>

    </div>
</main>

<?php
PrintFooter();
?>