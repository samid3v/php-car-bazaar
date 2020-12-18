<?php


$connect=mysqli_connect('localhost','root','','car_bazaar');

function escape($escape)
{

    global $connect;

    return mysqli_real_escape_string($connect, $escape);
}

function dbquery($dbquery)
{

    global $connect;

    return mysqli_query($connect, $dbquery);
}

function dbcheck($result)
{

    global $connect;

    if (!$result) {

        die("Database Failed").mysqli_error($connect);
    }
}

function fetch_data($data)
{

    return mysqli_fetch_array($data);
}

function row_count($result)
{

    return mysqli_num_rows($result);

}

?>