<?php
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

$public_access = true;
require_once "src/lib/autoload.php";
PrintHeader();
print "<main class='container'><h2>Dit is de bookings page</h2></main>";


//if (!is_numeric($_GET['img_id'])) die("Ongeldig argument " . $_GET['img_id'] . " opgegeven");

//get data
$data = GetData("select * from matches where mat_id=" . $_GET['mat_id']);
$row = $data[0]; //there's only 1 row in data

//add extra elements
$extra_elements['csrf_token'] = GenerateCSRF("padel_bookings.php.php");
$extra_elements['select_courts'] = MakeSelect($fkey = 'mat_cou_id',
    $value = $row['mat_cou_id'],
    $sql = "select cou_id, cou_name from courts");

var_dump(GetData($sql));
//get template
$output = file_get_contents("../html/match_form.html");

//merge
$output = MergeViewWithData($output, $data);
$output = MergeViewWithExtraElements($output, $extra_elements);
$output = MergeViewWithErrors($output, $errors);
$output = RemoveEmptyErrorTags($output, $data);

print $output;


PrintFooter();
?>