<?php
include '../../config/db_conn.php';
$id = $_GET['id'];
if (isset($_POST['submit'])) {
    $label = $_POST['label'];
    $description = $_POST['description'];
    $image = $_POST['image'];


    $sql = "UPDATE `game` SET `label`='$label',
    `description`='$description', `image`='$image' WHERE id=$id";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location: ../../game.php?msg=Data Updated successfully");
        exit();
    } else {
        echo "failed: " . mysqli_error($conn);
    }
}
?>
<?php include('../../template/header.php') ?>
<main class="content px-3 py-4">
    <div class="container-fluid">
        <?php
        $id = $_GET['id'];
        $sql = "SELECT * FROM `game` where id = $id Limit 1";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        ?>
        <div class="container">
            <div class="text-center mb-4">
                <h3>Edit User Information</h3>
                <p class="text-muted">Click update after changing any information</p>
            </div>

            <div class="container d-flex justify-content-center">
                <form action="" method="post" style="width: 50vw; min-width:300px">
                    <div class="mb-3">
                        <div class="col">
                            <label class="form-label">Label :</label>
                            <input type="text" class="form-control" name="label" value="<?php echo $row['label'] ?>">
                        </div>

                        <div class="col">
                            <label class="form-label">Description :</label>
                            <textarea type="text" class="form-control" name="description"><?php echo $row['description'] ?></textarea>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Image :</label>
                        <input type="text" class="form-control" name="image" value="<?php echo $row['image'] ?>">
                    </div>

                    <div>
                        <button type="submit" class="btn btn-success" name="submit">Save</button>
                        <a href="../../game.php" class="btn btn-danger">Cancel</a>
                    </div>
                </form>
            </div>
        </div>

    </div>
</main>