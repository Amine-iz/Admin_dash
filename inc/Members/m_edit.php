<?php
include '../../config/db_conn.php';
$id = $_GET['id'];
if (isset($_POST['submit'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];
    $status = $_POST['status'];
    $date_naissance = $_POST['date_naissance'];

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
            $sql = "UPDATE `membre` SET `first_name`='$first_name', `last_name`='$last_name', `email`='$email', `mdp`='$mdp', `image`='$image', `status`='$status', `date_naissance`='$date_naissance' WHERE id=$id";
            
            // Execute the query
            $result = mysqli_query($conn, $sql);

            // Check if the update was successful
            if ($result) {
                // Redirect to the desired page
                header("Location: ../../membre.php?msg=Data Updated successfully");
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
        $sql = "UPDATE `membre` SET `first_name`='$first_name', `last_name`='$last_name', `email`='$email', `mdp`='$mdp', `status`='$status', `date_naissance`='$date_naissance' WHERE id=$id";

        // Execute the query
        $result = mysqli_query($conn, $sql);

        // Check if the update was successful
        if ($result) {
            // Redirect to the desired page
            header("Location: ../../membre.php?msg=Data Updated successfully");
            exit();
        } else {
            // Error in executing the query
            echo "Failed: " . mysqli_error($conn);
        }
    }
}

// Fetch the member details from the database for editing
$id = $_GET['id'];
$sql = "SELECT * FROM `membre` where id = $id Limit 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

<?php include('../../template/header.php') ?>
<main class="content px-3 py-4">
    <div class="container-fluid">
        <div class="container">
            <div class="text-center mb-4">
                <h3>Edit User Information</h3>
                <p class="text-muted">Click update after changing any information</p>
            </div>

            <div class="container d-flex justify-content-center">
                <form action="" method="post" style="width: 50vw; min-width:300px" enctype="multipart/form-data">
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">First Name :</label>
                            <input type="text" class="form-control" name="first_name" value="<?php echo $row['first_name'] ?>">
                        </div>

                        <div class="col">
                            <label class="form-label">Last Name :</label>
                            <input type="text" class="form-control" name="last_name" value="<?php echo $row['last_name'] ?>">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email :</label>
                        <input type="email" class="form-control" name="email" value="<?php echo $row['email'] ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password :</label>
                        <input type="password" class="form-control" name="mdp" value="<?php echo $row['mdp'] ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Image :</label>
                        <input type="file" class="form-control" name="image">
                        <!-- Display the current image -->
                        <img src="../../uploads/<?php echo $row['image'] ?>" alt="Current Image" style="max-width: 200px; margin-top: 10px;">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Date of Birth :</label>
                        <input type="date" class="form-control" name="date_naissance" value="<?php echo $row['date_naissance'] ?>">
                    </div>

                    <div class="form-group mb-3">
                        <label>Status : </label> &nbsp;
                        <input type="radio" class="form-check-input" name="status" id="Membre" value="Membre" <?php echo ($row['status'] == 'Membre') ? "checked" : ""; ?>>
                        <label for="Membre" class="form-input-label">Membre</label>
                        &nbsp;
                        <input type="radio" class="form-check-input" name="status" id="Admin" value="Admin" <?php echo ($row['status'] == 'Admin') ? "checked" : ""; ?>>
                        <label for="Admin" class="form-input-label">Admin</label>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-success" name="submit">Save</button>
                        <a href="../../membre.php" class="btn btn-danger">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
