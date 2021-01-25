<?php
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

$public_access = true;
require_once "src/lib/autoload.php";
PrintHeader();
?>

    <main>
        <div class="container">

            <section>
                <h1>Book A Match</h1>
                <?php
                if ( count($old_post) > 0 )
                {
                    $data = [ 0 => [
                        "mat_time" => $old_post['mat_time'],
                        "mat_cou_id" => $old_post['cou_name'],
                        "mat_teaA_pla1_id" => $old_post['mat_teaA_pla1_id'],
                        "mat_teaA_pla2_id" => $old_post['mat_teaA_pla2_id'],
                        "mat_teaB_pla1_id" => $old_post['mat_teaB_pla1_id'],
                        "mat_teaB_pla2_id" => $old_post['mat_teaB_pla2_id']
                    ]
                    ];
                }
                else $data = [ 0 => [ "mat_time" => "", "mat_cou_id" => "", "mat_teaA_pla1_id" => "", "mat_teaA_pla2_id" => "", "mat_teaB_pla1_id" => "", "mat_teaB_pla2_id" => "" ]];


                //get template
                $output = file_get_contents("src/html/match_form.html");

                //add extra elements
                $extra_elements['csrf_token'] = GenerateCSRF( "padel_match_form.php"  );
                $extra_elements['datalist_courts'] = MakeDatalist( "cou_name", "select cou_id, cou_name from courts" );
                $extra_elements['datalist_players'] = MakeDatalist( "pla_name", "select pla_id, concat(pla_name, ' ', pla_surname) from players" );

                //merge
                $output = MergeViewWithData( $output, $data );
                $output = MergeViewWithExtraElements( $output, $extra_elements );
                $output = MergeViewWithErrors( $output, $errors );
                $output = RemoveEmptyErrorTags( $output, $data );

                print $output;
                ?>
            </section>

        </div>
    </main>

<?php


PrintFooter();
?>