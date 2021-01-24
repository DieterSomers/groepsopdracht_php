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
                <?php

                $data = GetData( "select * from players where pla_id=" . $_SESSION["user"]["pla_id"] );
                $row = $data[0]; //there's only 1 row in data

                //add extra elements
                $extra_elements['csrf_token'] = GenerateCSRF( "padel_bookings.php"  );
                //get template
                $output = file_get_contents("src/html/booking.html");

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
                $data = GetData( 'select mat_time, concat(pA1.pla_name, " ", pA1.pla_surname) as pA1, concat(pA2.pla_name, " ", pA2.pla_surname) as pA2, 
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
                order by mat_time desc' );

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
                $data = GetData( 'select mat_time, concat(pA1.pla_name, " ", pA1.pla_surname) as pA1, concat(pA2.pla_name, " ", pA2.pla_surname) as pA2, 
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