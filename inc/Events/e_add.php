<?php
include '../../config/db_conn.php';

if (isset($_POST['submit'])) {
    $titre = $_POST['titre'];
    $description = $_POST['description'];

    $date =  $_POST['date'];
    $timestamp = strtotime($date);
    $dateForDatabase = date('Y-m-d', $timestamp);

    $sql = "INSERT INTO `event`(`id`, `titre`, `description`, `date`) VALUES 
   (NULL, '$titre' ,'$description','$date')";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location: ../../event.php?msg=New record created successfully");
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
                <h3>Add New Event</h3>
                <p class="text-muted">Complete the form below to add a new event</p>
            </div>

            <div class="container d-flex justify-content-center">
                <form action="" method="post" style="width: 50vw; min-width:300px">
                    <div class="mb-3">
                        <input type="text" class="form-control" name="titre" placeholder="titre">
                    </div>
                    <div class="mb-3">
                        <textarea type="text" class="form-control" name="description" placeholder="Description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">date :</label>
                        <input type="date" class="form-control" name="date" placeholder="image">
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