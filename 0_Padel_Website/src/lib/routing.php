<?php

function GoToNoAccess()
{
    global $app_root;

    header("Location: " . $app_root . "/lib/no_access.php");
    exit;
}

function GoHome()
{
    global $app_root;

    header("Location: " . $app_root . "/padel_home.php");
    exit;
}
