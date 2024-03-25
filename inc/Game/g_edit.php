<?php
include '../../config/db_conn.php';

$id = $_GET['id'];

if (isset($_POST['submit'])) {
    $label = $_POST['label'];
    $description = $_POST['description'];

    // Check if a file is uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // File uploaded successfully, process it
        $target_dir = "../../uploads/"; // Destination directory
        $target_file = $target_dir . basename($_FILES["image"]["name"]); // Path to the uploaded file
        
        // Move the uploaded file to the destination directory
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // File upload successful, proceed with database update
            $image = basename($_FILES["image"]["name"]); // File name to store in the database

            // SQL query to update data in the database
            $sql = "UPDATE `game` SET `label`='$label', `description`='$description', `image`='$image' WHERE id=$id";

            // Execute the query
            $result = mysqli_query($conn, $sql);

            // Check if the update was successful
            if ($result) {
                // Redirect to the desired page
                header("Location: ../../game.php?msg=Data Updated successfully");
                exit();
            } else {
                // Error in executing the query
                echo "Failed: " . mysqli_error($conn);
            }
        } else {
            // Error in moving the uploaded file
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        // No file uploaded or an error occurred, proceed with updating other fields except the image
        $sql = "UPDATE `game` SET `label`='$label', `description`='$description' WHERE id=$id";

        // Execute the query
        $result = mysqli_query($conn, $sql);

        // Check if the update was successful
        if ($result) {
            // Redirect to the desired page
            header("Location: ../../game.php?msg=Data Updated successfully");
            exit();
        } else {
            // Error in executing the query
            echo "Failed: " . mysqli_error($conn);
        }
    }
}

// Fetch the game details from the database for editing
$sql = "SELECT * FROM `game` WHERE id = $id LIMIT 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

<?php include('../../template/header.php') ?>
<main class="content px-3 py-4">
    <div class="container-fluid">
        <div class="container">
            <div class="text-center mb-4">
                <h3>Edit Game Information</h3>
                <p class="text-muted">Click update after changing any information</p>
            </div>

            <div class="container d-flex justify-content-center">
                <form action="" method="post" style="width: 50vw; min-width:300px" enctype="multipart/form-data">
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
                        <input type="file" class="form-control" name="image">
                        <!-- Display the current image -->
                        <img src="../../uploads/<?php echo $row['image'] ?>" alt="Current Image" style="max-width: 200px; margin-top: 10px;">
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
