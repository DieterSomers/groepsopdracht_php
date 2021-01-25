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

        $data = GetData( "select * from players where pla_id=" . $_SESSION["user"]["pla_id"] );
        $row = $data[0]; //there's only 1 row in data

        //add extra elements
        $extra_elements['csrf_token'] = GenerateCSRF( "padel_profile.php"  );
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