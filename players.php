<?php
require('top_inc.php');
require('connection_inc.php');
require('function_inc.php');

if (isset($_GET['type']) && $_GET['type'] != '') {
    $type = get_safe_value($conn, $_GET['type']);

    if ($type == 'status') {
        $operation = get_safe_value($conn, $_GET['operation']);
        $id = get_safe_value($conn, $_GET['id']);
        if ($operation == 'active') {
            $status = '1';
        } else {
            $status = '0';
        }
        $update_status_sql = "update players set status='$status' where id='$id'";
        mysqli_query($conn, $update_status_sql);
    }

    if ($type == 'delete') {
        $id = get_safe_value($conn, $_GET['id']);
        $delete_sql = "DELETE FROM players WHERE id = '$id'";
        mysqli_query($conn, $delete_sql);
    }
}

$sql = "SELECT players.*, categories.categories_name FROM players, categories WHERE players.categories_id = categories.id order by players.player_name desc";
$res = mysqli_query($conn, $sql);


?>

<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">player </h4>
                        <h4 class="add-categories">
                            <a href="manage_players.php">Add player</a>
                        </h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th class="serial">#</th>
                                        <th>ID</th>
                                        <th>Categories</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Price</th>
                                        <th>Status</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    while ($row = mysqli_fetch_assoc($res)) { ?>

                                        <tr>
                                            <td class="serial"><?php echo $i ?></td>
                                            <td><?php echo $row['categories_id'] ?></td>
                                            <td><?php echo $row['categories_name'] ?></td>
                                            <td><?php echo $row['player_name'] ?></td>
                                            <td><img src="../media/players/<?php echo $row['image'] ?>" alt="player"></td>
                                            <td><?php echo $row['price'] ?></td>
                                            <td>
                                                <?php
                                                if ($row['action'] == 1) {
                                                    echo "<span class='badge badge-complete'><a href='?type=status&operation=deactive&id= " . $row['id'] . "'> Active </a></span>&nbsp ";
                                                } else {
                                                    echo "<span class='badge badge-pending'><a href='?type=status&operation=active&id= " . $row['id'] . "'> Deactive </a></span>&nbsp";
                                                }

                                                echo "<span class='badge badge-edit'><a href='manage_players?id= " . $row['id'] . "'> Edit </a> </span> &nbsp";
                                                echo "<span class='badge badge-delete'><a href='?type=delete&id= " . $row['id'] . "'> Delete </a> </span> &nbsp";

                                                ?>
                                            </td>
                                        </tr>

                                    <?php $i++;
                                    } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php
require('footer_inc.php');
?>