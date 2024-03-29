<?php
include '../../config/db_conn.php';

if (isset($_POST['submit'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    // $gender = $_POST["gender"];
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
            // File upload successful, proceed with database insertion
            $image = basename($_FILES["image"]["name"]); // File name to store in the database

            // SQL query to insert data into the database
            $sql = "INSERT INTO `membre`(`id`, `first_name`, `last_name`, `email`, `mdp`, `image`, `status`, `date_naissance`) VALUES (NULL, '$first_name' ,'$last_name','$email','$mdp','$image', 'Membre' , '$date_naissance')";
            
            // Execute the query
            $result = mysqli_query($conn, $sql);

            // Check if the insertion was successful
            if ($result) {
                // Redirect to the desired page
                header("Location: ../../membre.php?msg=New record created successfully");
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
        // No file uploaded or an error occurred
        echo "No file uploaded or an error occurred.";
    }
}
?>

<?php include('../../template/header.php') ?>
<main class="content px-3 py-4">
    <div class="container-fluid">
    <div class="container px-3 py-4">
        <div class="text-center mb-4">
            <h3>Add New User</h3>
            <p class="text-muted">Complete the form below to add a new user</p>
        </div>

        <div class="container d-flex justify-content-center">
            <form action="" method="post" style="width: 50vw; min-width:300px"  enctype=multipart/form-data>
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">First Name :</label>
                        <input type="text" class="form-control" name="first_name" placeholder="Albert">
                    </div>

                    <div class="col">
                        <label class="form-label">Last Name :</label>
                        <input type="text" class="form-control" name="last_name" placeholder="Einstein">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email :</label>
                    <input type="email" class="form-control" name="email" placeholder="name@example.com">
                </div>

                <!-- <div class="form-group mb-3">
                    <label>Gender : </label> &nbsp;
                    <input type="radio" class="form-check-input" name="gender" id="male" value="male">
                    <label for="male" class="form-input-label">Male</label>
                    &nbsp;
                    <input type="radio" class="form-check-input" name="gender" id="female" value="female">
                    <label for="female" class="form-input-label">Female</label>
                </div> -->

                <div class="mb-3">
                    <label class="form-label">Password :</label>
                    <input type="password" class="form-control" name="mdp" placeholder="xxxxxx">
                </div>
                <div class="mb-3">
                    <label class="form-label">Image :</label>
                    <input type="file" class="form-control" name="image" placeholder="image">
                </div>
                <div class="mb-3">
                    <label class="form-label">date naissance :</label>
                    <input type="date" class="form-control" name="date_naissance" placeholder="date">
                </div>

                <div class="form-group mb-3">
                    <label>Status : </label> &nbsp;
                    <input type="radio" class="form-check-input" name="status" id="Membre" value="Membre">
                    <label for="Membre" class="form-input-label">Membre</label>
                    &nbsp;
                    <input type="radio" class="form-check-input" name="status" id="Admin" value="Admin">
                    <label for="Admin" class="form-input-label">Admin</label>
                    <!-- &nbsp;
                    <input type="radio" class="form-check-input" name="status" id="Sup_Admin" value="Sup_Admin">
                    <label for="Sup_Admin" class="form-input-label">Sup_Admin</label> -->
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