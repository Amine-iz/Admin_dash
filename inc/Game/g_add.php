<?php
include '../../config/db_conn.php';

if (isset($_POST['submit'])) {
    $label = $_POST['label'];
    $description = $_POST['description'];
    
    // Vérifier si un fichier a été téléchargé
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // Chemin de destination du fichier
        $target_dir = "../../uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);

        // Déplacer le fichier téléchargé vers le répertoire de destination
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Succès : récupérer le nom du fichier pour l'insérer dans la base de données
            $image = basename($_FILES["image"]["name"]);

            // Date de création du jeu
            $date_created = date("d/m/Y");

            // Requête d'insertion avec le nom du fichier image
            $sql = "INSERT INTO `game`(`id`, `label`, `description`, `image`, `date_created`) VALUES (NULL, '$label' ,'$description','$image','$date_created')";

            $result = mysqli_query($conn, $sql);
            if ($result) {
                header("Location: ../../game.php?msg=New record created successfully");
                exit();
            } else {
                echo "failed: " . mysqli_error($conn);
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "No file uploaded or an error occurred.";
    }
}
?>

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
                <form action="" method="post" style="width: 50vw; min-width:300px" enctype=multipart/form-data>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="label" placeholder="Label">
                    </div>
                    <div class="mb-3">
                        <textarea type="text" class="form-control" name="description" placeholder="Description"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Image :</label>
                        <input type="file" class="form-control" name="image" placeholder="image">
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
