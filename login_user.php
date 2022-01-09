<?php

require("connection_inc.php");
require("function_inc.php");

$email = get_safe_value($conn, $_POST['email']);
$pass = get_safe_value($conn, $_POST['pass']);

$res = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email' and password = '$pass'");
$check_user = mysqli_num_rows($res);

if ($check_user > 0) {

    $row = mysqli_fetch_assoc($res);

    $_SESSION['USER_LOGIN'] = 'yes';
    $_SESSION['USER_ID'] = $row['id'];
    $_SESSION['USER_NAME'] = $row['name'];

    echo "ok";
} else {
    echo "no";
    // $added_on = date("Y-m-d h:i:s");
    // mysqli_query($conn, "INSERT INTO user (name, email, mobile, password, added_on) VALUES ('$name','$email','$mobile','$pass','$added_on')");
}
