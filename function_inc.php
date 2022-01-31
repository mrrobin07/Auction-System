<?php

function pr($arr)
{
    echo '<pre>';
    print_r($arr);
}

function prx($arr)
{
    echo '<pre>';
    print_r($arr);
    die();
}

function get_product($conn, $limit, $cat_id)
{

    $sql = "SELECT * FROM players WHERE action = 1";

    if ($cat_id != '') {
        $sql .= " and categories_id = $cat_id";
    }

    if ($limit != "") {
        $sql .= " limit $limit";
    }
    $res = mysqli_query($conn, $sql);
    $data = array();
    while ($row = mysqli_fetch_assoc($res)) {
        $data[] = $row;
    }
    return $data;
}

function get_safe_value($conn, $str)
{
    if ($str != '') {
        $str = trim($str);
        return mysqli_real_escape_string($conn, $str);
    }
}
