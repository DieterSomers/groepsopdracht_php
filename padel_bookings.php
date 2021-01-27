<?php
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

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
                        "mat_cou_id" => $old_post['mat_cou_id'],
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
                $extra_elements['csrf_token'] = GenerateCSRF( "padel_bookings.php"  );
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

            <section>
                <h1>Your Upcoming Matches</h1>
                <?php
                //get data
                $data = GetData( 'select mat_id, mat_time, concat(pA1.pla_name, " ", pA1.pla_surname) as pA1, concat(pA2.pla_name, " ", pA2.pla_surname) as pA2, 
concat(pB1.pla_name, " ", pB1.pla_surname) as pB1, concat(pB2.pla_name, " ", pB2.pla_surname) as pB2, mat_set1_teaA, mat_set2_teaA, mat_set3_teaA, mat_set1_teaB, mat_set2_teaB, mat_set3_teaB, cou_name from matches
                inner join players pA1 on pA1.pla_id = mat_teaA_pla1_id
                inner join players pA2 on pA2.pla_id = mat_teaA_pla2_id
                inner join players pB1 on pB1.pla_id = mat_teaB_pla1_id
                inner join players pB2 on pB2.pla_id = mat_teaB_pla2_id
                inner join courts on cou_id = mat_cou_id
                where (mat_teaA_pla1_id = ' . $_SESSION["user"]["pla_id"] . ' ||
                mat_teaA_pla2_id = ' . $_SESSION["user"]["pla_id"] . ' ||
                mat_teaB_pla1_id = ' . $_SESSION["user"]["pla_id"] . ' ||
                mat_teaB_pla2_id = ' . $_SESSION["user"]["pla_id"] . ')
                and mat_time > CURRENT_TIMESTAMP
                order by mat_time asc' );

                //get template
                $template = file_get_contents("src/html/match.html");

                //merge
                $output = MergeViewWithData( $template, $data );
                print $output;
                ?>
            </section>
            <section>
                <h1>Your Played Matches</h1>
                <?php
                //get data
                $data = GetData( 'select mat_id, mat_time, concat(pA1.pla_name, " ", pA1.pla_surname) as pA1, concat(pA2.pla_name, " ", pA2.pla_surname) as pA2, 
concat(pB1.pla_name, " ", pB1.pla_surname) as pB1, concat(pB2.pla_name, " ", pB2.pla_surname) as pB2, mat_set1_teaA, mat_set2_teaA, mat_set3_teaA, mat_set1_teaB, mat_set2_teaB, mat_set3_teaB, cou_name from matches
                inner join players pA1 on pA1.pla_id = mat_teaA_pla1_id
                inner join players pA2 on pA2.pla_id = mat_teaA_pla2_id
                inner join players pB1 on pB1.pla_id = mat_teaB_pla1_id
                inner join players pB2 on pB2.pla_id = mat_teaB_pla2_id
                inner join courts on cou_id = mat_cou_id
                where (mat_teaA_pla1_id = ' . $_SESSION["user"]["pla_id"] . ' ||
                mat_teaA_pla2_id = ' . $_SESSION["user"]["pla_id"] . ' ||
                mat_teaB_pla1_id = ' . $_SESSION["user"]["pla_id"] . ' ||
                mat_teaB_pla2_id = ' . $_SESSION["user"]["pla_id"] . ')
                and mat_time < CURRENT_TIMESTAMP
                order by mat_time desc' );

                //get template
                $template = file_get_contents("src/html/match.html");

                //merge
                $output = MergeViewWithData( $template, $data );
                print $output;
                ?>
            </section>
        </div>
    </main>

<?php


PrintFooter();
?>