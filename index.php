<?php
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

$public_access = true;
require_once "src/lib/autoload.php";

PrintStart();

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
$extra_elements['csrf_token'] = GenerateCSRF( "index.php"  );

//merge
//$output = MergeViewWithData( $output, $data );
$output = MergeViewWithExtraElements( $output, $extra_elements );
//$output = MergeViewWithErrors( $output, $errors );
//$output = RemoveEmptyErrorTags( $output, $data );

print $output;


PrintFooterLogin();
?>

