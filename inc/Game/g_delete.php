<?php
include '../../config/db_conn.php';
$id = $_GET['id'];
$sql = "DELETE FROM `game` WHERE id = $id";
$result = mysqli_query($conn, $sql);
if($result):
    header("Location: ../../game.php?msg=Record Deleted Successfully");
else:
    echo "Failed: ". mysqli_error($conn);
endif;
?>