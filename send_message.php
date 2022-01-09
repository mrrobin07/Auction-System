<?php

require("connection_inc.php");
require("function_inc.php");

$name = get_safe_value($conn, $_POST['name']);
$email = get_safe_value($conn, $_POST['email']);
$mobile = get_safe_value($conn, $_POST['mobile']);
$message = get_safe_value($conn, $_POST['message']);
$added_on = date('Y-m-d h:i:s');

$query = "INSERT INTO contact (name, email, phone, comment, added_on) VALUES ('$name', '$email', '$mobile', '$message','$added_on') ";
mysqli_query($conn, $query);

echo "Thank You";
