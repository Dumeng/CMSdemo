<?php

function connectDB()
{
    require('dbcfg.php');
    $mysqli = new mysqli(HOST, USERNAME, PASSWORD, DBNAME);
    if ($mysqli->connect_error) {
        die('Connect Error (' . $mysqli->connect_errno . ') '
        . $mysqli->connect_error);
    }
    return $mysqli;
}
