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

function get_product($conn, $types, $limit, $cat_id, $product_id)
{

    $sql = "SELECT product.*, categories.categories_name FROM product, categories WHERE product.status = 1";

    if ($cat_id != '') {
        $sql .= " and product.categories_id = $cat_id";
    }

    if ($product_id != '') {
        $sql .= " and product.id = $product_id";
    }

    $sql .= " and product.categories_id = categories.id";


    if ($types == 'latest') {
        $sql .= " ORDER BY product.id desc";
    }

    if ($limit != '') {
        $sql .= " limit $limit ";
    }

    $res = mysqli_query($conn, $sql);

    $product = array();

    while ($row = mysqli_fetch_assoc($res)) {
        $product[] = $row;
    }

    return $product;
}

function get_safe_value($conn, $str)
{
    if ($str != '') {
        $str = trim($str);
        return mysqli_real_escape_string($conn, $str);
    }
}
