<?php
include '../../config/db_conn.php';
$id = $_GET['id'];
if (isset($_POST['submit'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    //    $gender = $_POST["gender"];
    $mdp = $_POST['mdp'];
    $image = $_POST['image'];
    $status = $_POST['status'];
    $date_naissance = $_POST['date_naissance'];


    $sql = "UPDATE `membre` SET `first_name`='$first_name',
    `last_name`='$last_name',`email`='$email', `mdp`='$mdp', `image`='$image',
     `status`='$status', `date_naissance`='$date_naissance' WHERE id=$id";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location: ../../membre.php?msg=Data Updated successfully");
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
        $sql = "SELECT * FROM `membre` where id = $id Limit 1";
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
                        <input type="mdp" class="form-control" name="mdp" value="<?php echo $row['mdp'] ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Image :</label>
                        <input type="text" class="form-control" name="image" value="<?php echo $row['image'] ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">date naissance :</label>
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