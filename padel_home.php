<?php
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

//$public_access = true;
require_once "src/lib/autoload.php";
PrintHeader();
//print "<main class='container'><h2>Dit is de home page</h2></main>";
$id = $_SESSION["user"]["pla_id"];
?>

<main>
    <div class="container">

        <section>
            <h1>Player stats</h1>
            <div class="playerstats">
                <article>
                <?php

                //get data
                $data = GetData( "select count(mat_id) as stats from matches
                    where '$id' = mat_teaA_pla1_id || '$id' = mat_teaA_pla2_id || '$id' = mat_teaB_pla1_id || '$id' = mat_teaB_pla2_id;" );

                //get template
                $template = file_get_contents("src/html/player_stats.html");

                //merge
                $output = MergeViewWithData( $template, $data );
                print $output;
                ?>
                    <span>Games you played</span>
                </article>
                <article>
                    <?php
                    //get data
                    $data = GetData( "select count(mat_id) as stats from matches
                        where (case
                        when '$id' = mat_teaA_pla1_id || '$id' = mat_teaA_pla2_id
                        then (mat_set1_teaA > mat_set1_teaB && mat_set2_teaA > mat_set2_teaB)
                                || (mat_set1_teaA > mat_set1_teaB && mat_set3_teaA > mat_set3_teaB)
                                || (mat_set2_teaA > mat_set2_teaB && mat_set3_teaA > mat_set3_teaB)
                        when '$id' = mat_teaB_pla1_id || '$id' = mat_teaB_pla2_id
                        then (mat_set1_teaA < mat_set1_teaB && mat_set2_teaA < mat_set2_teaB)
                                || (mat_set1_teaA < mat_set1_teaB && mat_set3_teaA < mat_set3_teaB)
                                || (mat_set2_teaA < mat_set2_teaB && mat_set3_teaA < mat_set3_teaB)
                        end);" );

                    //get template
                    $template = file_get_contents("src/html/player_stats.html");

                    //merge
                    $output = MergeViewWithData( $template, $data );
                    print $output;
                    ?>
                    <span>Your wins</span>
                </article>
                <article>
                    <?php
                    //get data
                    $data = GetData( "select count(mat_id) as stats from matches" );

                    //get template
                    $template = file_get_contents("src/html/player_stats.html");

                    //merge
                    $output = MergeViewWithData( $template, $data );
                    print $output;
                    ?>
                    <span>Total games alltime</span>
                </article>
                <article>
                    <?php
                    //get data
                    $data = GetData( "SELECT (COALESCE(SUM(mat_set1_teaA) + SUM(mat_set1_teaB) + SUM(mat_set2_teaA) + SUM(mat_set2_teaB) 
                        + SUM(mat_set3_teaA) + SUM(mat_set3_teaB),0)) as stats FROM matches
                        where '$id' = mat_teaA_pla1_id || '$id' = mat_teaA_pla2_id || 
                        '$id' = mat_teaB_pla1_id || '$id' = mat_teaB_pla2_id;" );

                    //get template
                    $template = file_get_contents("src/html/player_stats.html");

                    //merge
                    $output = MergeViewWithData( $template, $data );
                    print $output;
                    ?>
                    <span>Total sets you played</span>
                </article>
                <article>
                    <?php
                    //get data
                    $data = GetData( "SELECT (SUM(mat_set1_teaA) + SUM(mat_set1_teaB) + SUM(mat_set2_teaA) + SUM(mat_set2_teaB)
                        + SUM(mat_set3_teaA) + SUM(mat_set3_teaB)) as stats FROM matches");

                    //get template
                    $template = file_get_contents("src/html/player_stats.html");

                    //merge
                    $output = MergeViewWithData( $template, $data );
                    print $output;
                    ?>
                    <span>Total sets alltime</span>
                </article>
            </div>
        </section>

        <section>
            <h1>Best players</h1>
            <div class="top_players">
            <?php
            //get data
            $data = GetData( "select pla_name, pla_surname, pla_img_path, lvl_description, count(mat_id) as matches_won from matches
                inner join players
                inner join player_level on pla_lvl_id = lvl_id
                where (case
                when pla_id = mat_teaA_pla1_id || pla_id = mat_teaA_pla2_id
                then (mat_set1_teaA > mat_set1_teaB && mat_set2_teaA > mat_set2_teaB)
                        || (mat_set1_teaA > mat_set1_teaB && mat_set3_teaA > mat_set3_teaB)
                        || (mat_set2_teaA > mat_set2_teaB && mat_set3_teaA > mat_set3_teaB)
                when pla_id = mat_teaB_pla1_id || pla_id = mat_teaB_pla2_id
                then (mat_set1_teaA < mat_set1_teaB && mat_set2_teaA < mat_set2_teaB)
                        || (mat_set1_teaA < mat_set1_teaB && mat_set3_teaA < mat_set3_teaB)
                        || (mat_set2_teaA < mat_set2_teaB && mat_set3_teaA < mat_set3_teaB)
                end)
                group by pla_name
                order by matches_won desc
                limit 5" );

            //get template
            $template = file_get_contents("src/html/top_players.html");

            //merge
            $output = MergeViewWithData( $template, $data );
            print $output;
            ?>
            </div>
        </section>
        <section>
            <h1>Your last match</h1>
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
                order by mat_time desc
                limit 1' );

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
