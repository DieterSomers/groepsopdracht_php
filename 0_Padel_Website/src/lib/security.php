<?php
function GenerateCSRF( string $formname = "noformname" ): string
{
    $csrf_key = bin2hex( random_bytes(32) );
    $csrf = hash_hmac( 'sha256', 'GROEPSTAAK SECRET KEY ' . $formname, $csrf_key );

    //store CSRF token in SESSION
    $_SESSION['lastest_csrf'] = $csrf;

    return $csrf;
}