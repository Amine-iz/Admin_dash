<?php include_once('./template/header.php') ?>
<?php include('./template/side_bar.php') ?>

<main class="content px-3 py-4">
    <div class="container-fluid">
        <div class="container">
            <?php
            if (isset($_GET['msg'])) :
                $msg = $_GET['msg'];
                echo '
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        ' . $msg . '
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
            endif;
            ?>
            <div class="row mb-3">
                <h1 class="col">Club Membres</h1>
                <a href="./inc/Members/add_membre.php" class="btn btn-dark mb-3 col">Add New</a>
            </div>

            <!-- <?php include('button_add.php') ?> -->

            <table class="table table-hover text-center">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Email</th>
                        <!-- <th scope="col">pswd</th> -->
                        <th scope="col">image</th>
                        <th scope="col">Status</th>
                        <th scope="col">Date naissance</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "./config/db_conn.php";
                    $sql = "SELECT * FROM `membre`";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <th> <?php echo $row['id'] ?></th>
                            <th> <?php echo $row['first_name'] ?></th>
                            <th> <?php echo $row['last_name'] ?></th>
                            <th> <?php echo $row['email'] ?></th>
                            <!-- <th> <?php //echo $row['mdp'] 
                                        ?></th> -->
                             <!-- Afficher l'image -->
                             <td><img src="./uploads/<?php echo $row['image'] ?>" alt="Image" style="max-width: 100px;"></td>

                            <th> <?php echo $row['status'] ?></th>
                            <th> <?php echo $row['date_naissance'] ?></th>

                            <td>
                                <a href="./inc/Members/m_edit.php?id=<?php echo $row['id'] ?>" class="link-dark">
                                    <i class="fa-solid fa-pen-to-square fs-5 me-3"></i>
                                </a>
                                <a href="./inc/Members/m_delete.php?id=<?php echo $row['id'] ?>" class="link-dark">
                                    <i class="fa-solid fa-trash fs-5 me-3"></i>
                                </a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<?php include_once('./template/footer.php') ?>