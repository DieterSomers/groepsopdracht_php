<?php
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

$public_access = true;
require_once "src/lib/autoload.php";

PrintStart();

//get data
if ( count($old_post) > 0 )
{
    $data = [ 0 => [
        "usr_voornaam" => $old_post['usr_voornaam'],
        "usr_naam" => $old_post['usr_naam'],
        "usr_email" => $old_post['usr_email'],
        "usr_password" => $old_post['usr_password']
    ]
    ];
}
else $data = [ 0 => [ "usr_voornaam" => "", "usr_naam" => "", "usr_email" => "", "usr_password" => "" ]];

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