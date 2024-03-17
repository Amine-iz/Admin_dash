<?php
include '../../config/db_conn.php';

if (isset($_POST['submit'])) {
    $label = $_POST['label'];
    $description = $_POST['description'];
    $image = $_POST['image'];
    
    $date_created = date("d/m/Y");

    $sql = "INSERT INTO `game`(`id`, `label`, `description`, 
   `image`, `date_created`) VALUES 
   (NULL, '$label' ,'$description','$image','$date_created')";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location: ../../game.php?msg=New record created successfully");
        exit();
    } else {
        echo "failed: " . mysqli_error($conn);
    }
}
?>
<?php include('../../template/header.php') ?>
<main class="content px-3 py-4">
    <div class="container-fluid">
        <div class="container px-3 py-4">
            <div class="text-center mb-4">
                <h3>Add New Game</h3>
                <p class="text-muted">Complete the form below to add a new game</p>
            </div>

            <div class="container d-flex justify-content-center">
                <form action="" method="post" style="width: 50vw; min-width:300px">
                    <div class="mb-3">
                        <input type="text" class="form-control" name="label" placeholder="Label">
                    </div>
                    <div class="mb-3">
                        <textarea type="text" class="form-control" name="description" placeholder="Description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Image :</label>
                        <input type="text" class="form-control" name="image" placeholder="image">
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