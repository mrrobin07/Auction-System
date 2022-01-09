<?php
require('top_inc.php');
require('connection_inc.php');
require('function_inc.php');

$msg = '';
$bowl_hand_add = '';


if (isset($_GET['id']) && $_GET['id'] != '') {
    $id = get_safe_value($conn, $_GET['id']);
    $sql = mysqli_query($conn, "SELECT * FROM bowl WHERE id = '$id'");

    $check = mysqli_num_rows($sql);
    if ($check > 0) {
        $rows = mysqli_fetch_assoc($sql);
        $bowl_hand_add = $rows['bowl_hand'];
    } else {
        header('location:bowl.php');
        die();
    }
}


if (isset($_POST['submit'])) {
    $bowl_hand = get_safe_value($conn, $_POST['bowl_hand']);

    //check category already exist or not
    $query = "SELECT * FROM bowl WHERE bowl_hand = '$bowl_hand'";
    $res = mysqli_query($conn, $query);
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $getData = mysqli_fetch_assoc($res);
            if ($id == $getData['id']) {
                $update_sql = " UPDATE bowl SET bowl_hand = '$bowl_hand' WHERE id = '$id' ";
                mysqli_query($conn, $update_sql);
                header('location:bowl.php');
                die();
            } else {
                $msg = "role already exist";
            }
        } else {
            $msg = "role already exist";
        }
    } else {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $update_sql = " UPDATE bowl SET bowl_hand = '$bowl_hand' WHERE id = '$id' ";
            mysqli_query($conn, $update_sql);
        } else {
            $sql = mysqli_query($conn, "INSERT INTO bowl (bowl_hand, status) VALUES ('$bowl_hand', '1')");
        }
        header('location:bowl.php');
        die();
    }
}



?>

<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><strong>Bowl-Hand Form</strong></div>

                    <form method="post">
                        <div class="card-body card-block">
                            <div class="form-group"><label for="role" class=" form-control-label">Bowl-Hand</label>
                                <input type="text" name="bowl_hand" id="company" placeholder="Enter your categories name" class="form-control" required value="<?php echo $bowl_hand_add ?>">
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