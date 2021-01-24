<?php
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

$public_access = true;
require_once "./src/lib/autoload.php";

PrintHeaderLogin();


//toon messages als er zijn
//foreach ( $msgs as $msg )
//{
  //  print '<div class="alert alert-success" role="alert">' . $msg . '</div>';
//}

//get data
//$data = [ 0 => [ "usr_email" => "", "usr_password" => "" ]];

//get template
$output = file_get_contents("./src/html/login.html");

//add extra elements
//$extra_elements['csrf_token'] = GenerateCSRF( "login.php"  );

//merge
//$output = MergeViewWithData( $output, $data );
//$output = MergeViewWithExtraElements( $output, $extra_elements );
//$output = MergeViewWithErrors( $output, $errors );
//$output = RemoveEmptyErrorTags( $output, $data );

print $output;


PrintFooterLogin();
PrintHeader();
?>

<main>
    <div class="container">
        <section>
            <h1>Log hier in</h1>
            <h2>Vul hieronder je gegevens in</h2>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt
                dolore quas pariatur accusamus impedit tempore inventore aliquid
                quia et sequi at, qui, laborum commodi tempora minima nobis.
                Cupiditate a, sit modi aperiam minima temporibus possimus reiciendis
                quos vero dolorum ipsam sint delectus odit magni asperiores. Itaque
                repellat eaque eius perspiciatis asperiores quis magni atque ab
                mollitia quos, odit, ad delectus velit, in voluptatem aspernatur!
                Reiciendis delectus pariatur et dolor alias hic magnam, nisi facilis
                dicta nulla, eius nihil maxime, aspernatur quod! Nobis asperiores
                minus exercitationem numquam ut eius quis earum incidunt, doloremque
                quibusdam temporibus aut libero porro? Unde, earum voluptatibus.
            </p>
        </section>
        <section>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse eius
                molestiae amet numquam cupiditate nihil rerum libero illo, nobis
                expedita odit eaque ducimus laudantium dignissimos, error et
                pariatur exercitationem excepturi repudiandae illum! Modi quod
                voluptatem temporibus sint corrupti quis corporis.
            </p>
        </section>
        <section>
            <h1>Best Players</h1>
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
                limit 3" );

            //get template
            $template = file_get_contents("src/html/top_players.html");

            //merge
            $output = MergeViewWithData( $template, $data );
            print $output;
            ?>
        </section>
        <section>
            <h1>Last Match</h1>
            <?php
            //get data
            $data = GetData( "select mat_time, pA1.pla_name as pA1, pA2.pla_name as pA2, pB1.pla_name as pB1, pB2.pla_name as pB2, mat_set1_teaA, mat_set2_teaA, mat_set3_teaA, mat_set1_teaB, mat_set2_teaB, mat_set3_teaB from matches
                inner join players pA1 on pA1.pla_id = mat_teaA_pla1_id
                inner join players pA2 on pA2.pla_id = mat_teaA_pla2_id
                inner join players pB1 on pB1.pla_id = mat_teaB_pla1_id
                inner join players pB2 on pB2.pla_id = mat_teaB_pla2_id
                order by mat_time desc
                limit 1" );

            //get template
            $template = file_get_contents("src/html/match.html");

            //merge
            $output = MergeViewWithData( $template, $data );
            print $output;
            ?>
        </section>
        <section>
            <h1>My bookings</h1>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Perspiciatis alias, id aliquid qui cupiditate reiciendis vero labore
                laudantium a beatae consequuntur repellat cum asperiores itaque!
                Asperiores obcaecati similique earum voluptate reiciendis iste iure
                quia, eos quisquam rerum adipisci, magni iusto vero tempore! Libero
                sint distinctio debitis veritatis obcaecati! Autem, nemo.
            </p>
        </section>
    </div>
</main>

<?php
PrintFooter();
?>