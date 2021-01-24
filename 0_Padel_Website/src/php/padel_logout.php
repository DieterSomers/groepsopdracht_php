<?php
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

require_once '../lib/autoload.php';

unset($_SESSION['user']);
session_destroy();
session_regenerate_id('user');
header("Location: ../../index.php?logout=true");