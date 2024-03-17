<?php
include '../../config/db_conn.php';
$id = $_GET['id'];
if (isset($_POST['submit'])) {
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $date = $_POST['date'];


    $sql = "UPDATE `event` SET `titre`='$titre',
    `description`='$description', `date`='$date' WHERE id=$id";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location: ../../event.php?msg=Data Updated successfully");
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
        $sql = "SELECT * FROM `event` where id = $id Limit 1";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        ?>
        <div class="container">
            <div class="text-center mb-4">
                <h3>Edit Events Information</h3>
                <p class="text-muted">Click update after changing any information</p>
            </div>

            <div class="container d-flex justify-content-center">
                <form action="" method="post" style="width: 50vw; min-width:300px">
                    <div class="mb-3">
                        <div class="col">
                            <label class="form-label">titre :</label>
                            <input type="text" class="form-control" name="titre" value="<?php echo $row['titre'] ?>">
                        </div>

                        <div class="col">
                            <label class="form-label">Description :</label>
                            <textarea type="text" class="form-control" name="description"><?php echo $row['description'] ?></textarea>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">date :</label>
                        <input type="date" class="form-control" name="date" value="<?php echo $row['date'] ?>">
                    </div>

                    <div>
                        <button type="submit" class="btn btn-success" name="submit">Save</button>
                        <a href="../../event.php" class="btn btn-danger">Cancel</a>
                    </div>
                </form>
            </div>
        </div>

    </div>
</main>