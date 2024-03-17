<?php
include '../../config/db_conn.php';
$id = $_GET['id'];
$sql = "DELETE FROM `event` WHERE id = $id";
$result = mysqli_query($conn, $sql);
if($result):
    header("Location: ../../event.php?msg=Record Deleted Successfully");
else:
    echo "Failed: ". mysqli_error($conn);
endif;
?>