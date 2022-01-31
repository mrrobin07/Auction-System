<?php
require('top_inc.php');
require('connection_inc.php');
require('function_inc.php');

//default value set
$categories_id = '';
$role_id = '';
$bat_id = '';
$bowl_id = '';
$player_name = '';
$price = '';
$image = '';

$msg = '';
$image_required = 'required';

if (isset($_GET['id']) && $_GET['id'] != '') {
    $image_required = '';
    $id = get_safe_value($conn, $_GET['id']);
    $sql = mysqli_query($conn, "SELECT * FROM players WHERE id = '$id'");

    $check = mysqli_num_rows($sql);
    if ($check > 0) {
        $rows = mysqli_fetch_assoc($sql);
        $categories_id = $rows['categories_id'];
        $role_id = $rows['role_id'];
        $bat_id = $rows['bat_id'];
        $bowl_id = $rows['bowl_id'];
        $player_name = $rows['player_name'];
        $price = $rows['price'];
    } else {
        header('location:players.php');
        die();
    }
}


if (isset($_POST['submit'])) {
    $categories_id = get_safe_value($conn, $_POST['categories_id']);
    $role_id = get_safe_value($conn, $_POST['role_id']);
    $bat_id = get_safe_value($conn, $_POST['bat_id']);
    $bowl_id = get_safe_value($conn, $_POST['bowl_id']);
    $player_name = get_safe_value($conn, $_POST['player_name']);
    $price = get_safe_value($conn, $_POST['price']);

    //check category already exist or not
    $query = "SELECT * FROM players WHERE player_name = '$player_name'";
    $res = mysqli_query($conn, $query);
    $check = mysqli_num_rows($res);
    if ($check > 0) {
        if (isset($_GET['id']) && $_GET['id'] != '') {
            $getData = mysqli_fetch_assoc($res);
            if ($id == $getData['id']) {
            } else {
                $msg = "player already exist";
            }
        } else {
            $msg = "player already exist";
        }
    }


    if ($msg == '') {

        //for Player update
        if (isset($_GET['id']) && $_GET['id'] != '') {

            if ($_FILES['image']['name'] != '') {
 
                $image = rand(111111, 999999) . '_' . $_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'], '../media/players/' . $image);

                $update_sql = " UPDATE players SET categories_id = '$categories_id', role_id = '$role_id', bat_id = '$bat_id', bowl_id = '$bowl_id', 
                            player_name = '$player_name', price = '$price', image = '$image' WHERE id = '$id' ";
            } else {
                $update_sql = " UPDATE players SET categories_id = '$categories_id', role_id = '$role_id', bat_id = '$bat_id', bowl_id = '$bowl_id', 
                player_name = '$player_name', price = '$price',  WHERE id = '$id' ";
            }
            mysqli_query($conn, $update_sql);
        }

        //for Player add
        else {
            $image = rand(111111, 999999) . '_' . $_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'], '../media/players/' . $image);
            $insert_query = "INSERT INTO players (categories_id, role_id, bat_id, bowl_id, player_name, price, image, action) VALUES ('$categories_id', '$role_id', '$bat_id', '$bowl_id', '$player_name', '$price' , '$image', '1')";
            mysqli_query($conn, $insert_query);
        }
        header('location:players.php');
        die();
    }
}

?>

<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><strong>Players Form</strong></div>

                    <form method="post" enctype="multipart/form-data">
                        <div class="card-body card-block">

                            <div class="form-group"><label for="categories" class=" form-control-label">Categories</label>
                                <select class=" form-control" name="categories_id">
                                    <option>Select Categoty</option>
                                    <?php
                                    $query = mysqli_query($conn, 'SELECT id, categories_name FROM categories');
                                    while ($row = mysqli_fetch_assoc($query)) {
                                        if ($row['id'] == $categories_id) {
                                            echo "<option selected value=" . $row['id'] . ">" . $row['categories_name'] . "</option>";
                                        } else {
                                            echo "<option value=" . $row['id'] . ">" . $row['categories_name'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group"><label for="role" class=" form-control-label">Role</label>
                                <select class=" form-control" name="role_id">
                                    <option>Select Role</option>
                                    <?php
                                    $query = mysqli_query($conn, 'SELECT id, role_name FROM role');
                                    while ($row = mysqli_fetch_assoc($query)) {
                                        if ($row['id'] == $role_id) {
                                            echo "<option selected value=" . $row['id'] . ">" . $row['role_name'] . "</option>";
                                        } else {
                                            echo "<option value=" . $row['id'] . ">" . $row['role_name'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group"><label for="bat" class=" form-control-label">Bat-Hand</label>
                                <select class=" form-control" name="bat_id">
                                    <option>Select Bat-Hand</option>
                                    <?php
                                    $query = mysqli_query($conn, 'SELECT id, bat_hand FROM bat');
                                    while ($row = mysqli_fetch_assoc($query)) {
                                        if ($row['id'] == $bat_id) {
                                            echo "<option selected value=" . $row['id'] . ">" . $row['bat_hand'] . "</option>";
                                        } else {
                                            echo "<option value=" . $row['id'] . ">" . $row['bat_hand'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group"><label for="bowl" class=" form-control-label">Bowl-Hand</label>
                                <select class=" form-control" name="bowl_id">
                                    <option>Select Bowl-Hand</option>
                                    <?php
                                    $query = mysqli_query($conn, 'SELECT id, bowl_hand FROM bowl');
                                    while ($row = mysqli_fetch_assoc($query)) {
                                        if ($row['id'] == $bowl_id) {
                                            echo "<option selected value=" . $row['id'] . ">" . $row['bowl_hand'] . "</option>";
                                        } else {
                                            echo "<option value=" . $row['id'] . ">" . $row['bowl_hand'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group"><label for="player_name" class=" form-control-label">Player name</label>
                                <input type="text" name="player_name" id="company" placeholder="Enter Player name" class="form-control" required value="<?php echo $player_name ?>">
                            </div>


                            <div class="form-group"><label for="price" class=" form-control-label">Player Price</label>
                                <input type="text" name="price" id="company" placeholder="Enter Player Price" class="form-control" required value="<?php echo $price ?>">
                            </div>

                            <div class="form-group"><label for="image" class=" form-control-label">Player Image</label>
                                <input type="file" name="image" id="company" placeholder="Enter your Player Image" class="form-control" <?php echo $image_required ?> value="<?php echo $image ?>">
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