<?php

require("connection_inc.php");
require("function_inc.php");

$name = get_safe_value($conn, $_POST['name']);
$email = get_safe_value($conn, $_POST['email']);
$mobile = get_safe_value($conn, $_POST['mobile']);
$pass = get_safe_value($conn, $_POST['pass']);

$check_user = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'"));

if ($check_user > 0) {
    echo "present";
} else {
    $added_on = date("Y-m-d h:i:s");
    mysqli_query($conn, "INSERT INTO user (name, email, mobile, password, added_on) VALUES ('$name','$email','$mobile','$pass','$added_on')");
}
