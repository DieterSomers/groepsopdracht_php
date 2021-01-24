<?php
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

$public_access = true;
require_once "src/lib/autoload.php";

PrintHeaderRegister();

//get data
if ( count($old_post) > 0 )
{
    $data = [ 0 => [
        "pla_name" => $old_post['pla_name'],
        "pla_surname" => $old_post['pla_surname'],
        "pla_email" => $old_post['pla_email'],
        "pla_password" => $old_post['pla_password']
    ]
    ];
}
else $data = [ 0 => [ "pla_name" => "", "pla_surname" => "", "pla_email" => "", "pla_password" => "" ]];

//get template
$output = file_get_contents("src/html/register.html");

//add extra elements
$extra_elements['csrf_token'] = GenerateCSRF( "padel_register.php"  );

//merge
$output = MergeViewWithData( $output, $data );
$output = MergeViewWithExtraElements( $output, $extra_elements );
$output = MergeViewWithErrors( $output, $errors );
$output = RemoveEmptyErrorTags( $output, $data );

print $output;

PrintFooter();