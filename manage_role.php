<?php
require('top_inc.php');
require('connection_inc.php');
require('function_inc.php');

$msg = '';
$role_name_add = '';


if (isset($_GET['id']) && $_GET['id'] != '') {
    $id = get_safe_value($conn, $_GET['id']);
    $sql = mysqli_query($conn, "SELECT * FROM role WHERE id = '$id'");

    $check = mysqli_num_rows($sql);
    if ($check > 0) {
        $rows = mysqli_fetch_assoc($sql);
        $role_name_add = $rows['role_name'];
    } else {
        header('location:role.php');
        die();
    }
}


if (isset($_POST['submit'])) {
    $role_name = get_safe_value($conn, $_POST['role_name']);

    //check category already exist or not
    $query = "SELECT * FROM role WHERE role_name = '$role_name'";
    $res = mysqli_query($conn, $query);
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $getData = mysqli_fetch_assoc($res);
            if ($id == $getData['id']) {
                $update_sql = " UPDATE role SET role_name = '$role_name' WHERE id = '$id' ";
                mysqli_query($conn, $update_sql);
                header('location:role.php');
                die();
            } else {
                $msg = "role already exist";
            }
        } else {
            $msg = "role already exist";
        }
    } else {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $update_sql = " UPDATE role SET role_name = '$role_name' WHERE id = '$id' ";
            mysqli_query($conn, $update_sql);
        } else {
            $sql = mysqli_query($conn, "INSERT INTO role (role_name, status) VALUES ('$role_name', '1')");
        }
        header('location:role.php');
        die();
    }
}



?>

<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><strong>Role Form</strong></div>

                    <form method="post">
                        <div class="card-body card-block">
                            <div class="form-group"><label for="role" class=" form-control-label">Role</label>
                                <input type="text" name="role_name" id="company" placeholder="Enter your categories name" class="form-control" required value="<?php echo $role_name_add ?>">
                            </div>
                            <button name='submit' id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                <span id="payment-button-amount">Submit</span>
                            </button>
                        </div>
                    </form>

                    <div class="field_error" style="margin-left: 22px; margin-bottom : 20px">
                        <?php echo $msg ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?php
require('footer_inc.php');

?>