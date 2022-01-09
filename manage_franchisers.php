<?php
require('top_inc.php');
require('connection_inc.php');
require('function_inc.php');

$msg = '';
$franchisers_add = '';

$image = '';
$image_required = 'required';


if (isset($_GET['id']) && $_GET['id'] != '') {
    $image_required = '';
    $id = get_safe_value($conn, $_GET['id']);
    $sql = mysqli_query($conn, "SELECT * FROM franchisers WHERE id = '$id'");

    $check = mysqli_num_rows($sql);
    if ($check > 0) {
        $rows = mysqli_fetch_assoc($sql);
        $bat_hand_add = $rows['franchisers_name'];
    } else {
        header('location:franchisers.php');
        die();
    }
}


if (isset($_POST['submit'])) {
    $franchisers_name = get_safe_value($conn, $_POST['franchisers_name']);

    //check category already exist or not
    $query = "SELECT * FROM franchisers WHERE franchisers_name = '$franchisers_name'";
    $res = mysqli_query($conn, $query);
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $getData = mysqli_fetch_assoc($res);
            if ($id == $getData['id']) {
                $update_sql = " UPDATE franchisers SET franchisers_name = '$franchisers_name' WHERE id = '$id' ";
                mysqli_query($conn, $update_sql);
                header('location:franchisers.php');
                die();
            } else {
                $msg = "franchisers already exist";
            }
        } else {
            $msg = "franchisers already exist";
        }
    } else {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $update_sql = " UPDATE franchisers SET franchisers_name = '$franchisers_name' WHERE id = '$id' ";
            mysqli_query($conn, $update_sql);
        } else {
            $sql = mysqli_query($conn, "INSERT INTO franchisers (franchisers_name, status) VALUES ('$franchisers_name', '1')");
        }
        header('location:franchisers.php');
        die();
    }
    if ($msg == '') {

        //for franchisers update
        if (isset($_GET['id']) && $_GET['id'] != '') {

            if ($_FILES['image']['name'] != '') {

                $image = rand(111111, 999999) . '_' . $_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'], '../media/franchisers/' . $image);

                $update_sql = " UPDATE franchisers SET franchisers_name = '$franchisers_name', image = '$image' WHERE id = '$id' ";
            } else {
                $update_sql = " UPDATE franchisers SET franchisers_name = '$franchisers_name' WHERE id = '$id' ";
            }
            mysqli_query($conn, $update_sql);
        }

        //for franchisers add
        else {
            $image = rand(111111, 999999) . '_' . $_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'], '../media/product/' . $image);
            $insert_query = "INSERT INTO franchisers (franchisers_name, image, status) VALUES ('$franchisers_name', '$image' , '1')";
            mysqli_query($conn, $insert_query);
        }
        header('location:franchisers.php');
        die();
    }
}




?>

<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><strong>Franchisers Form</strong></div>

                    <form method="post">
                        <div class="card-body card-block">
                            <div class="form-group"><label for="franchisers" class=" form-control-label">Franchisers</label>
                                <input type="text" name="franchisers_name" id="company" placeholder="Enter franchisers name" class="form-control" required value="<?php echo $franchisers_add ?>">
                            </div>
                            <div class="form-group"><label for="image" class=" form-control-label">Franchisers Image</label>
                                <input type="file" name="image" id="company" placeholder="Enter your Product Image" class="form-control" <?php echo $image_required ?> value="<?php echo $image ?>">
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