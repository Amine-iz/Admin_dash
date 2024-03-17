<?php include_once('template/header.php') ?>
<?php include_once('template/side_bar.php') ?>

<main class="content px-3 py-4">
    <div class="container-fluid">
        <div class="mb-3">
            <h3 class="fw-bold fs-4 mb-3">Admin Dashboard</h3>
            <div class="row">
                <?php
                include "./config/db_conn.php";
                $sql = "SELECT COUNT(*) AS total_rows FROM membre";
                $result = mysqli_query($conn, $sql);

                $row = mysqli_fetch_assoc($result); // Fetch the count value
                $totalRows = $row['total_rows']; // Access the count value
                ?>
                <div class="col-12 col-md-4 ">
                    <div class="card border-0">
                        <div class="card-body py-4">
                            <h4 class="mb-2 fw-bold">
                                Memebers
                            </h4>
                            <p class="mb-2 fw-bold">
                                Total: <?php echo $totalRows; ?>
                            </p>
                        </div>
                    </div>
                </div>


                <?php
                include "./config/db_conn.php";
                $sql = "SELECT COUNT(*) AS total_rows FROM game";
                $result = mysqli_query($conn, $sql);

                $row = mysqli_fetch_assoc($result); // Fetch the count value
                $totalRows = $row['total_rows']; // Access the count value
                ?>
                <div class="col-12 col-md-4 ">
                    <div class="card  border-0">
                        <div class="card-body py-4">
                            <h4 class="mb-2 fw-bold">
                                Games
                            </h4>
                            <p class="mb-2 fw-bold">
                                Total: <?php echo $totalRows; ?>
                            </p>
                        </div>
                    </div>
                </div>


                <?php
                include "./config/db_conn.php";
                $sql = "SELECT COUNT(*) AS total_rows FROM event";
                $result = mysqli_query($conn, $sql);

                $row = mysqli_fetch_assoc($result); // Fetch the count value
                $totalRows = $row['total_rows']; // Access the count value
                ?>
                <div class="col-12 col-md-4 ">
                    <div class="card border-0">
                        <div class="card-body py-4">
                            <h4 class="mb-2 fw-bold">
                                Events
                            </h4>
                            <p class="mb-2 fw-bold">
                                Total: <?php echo $totalRows; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>


            <!-- container -->
            <div class="container mt-5">
                <div class="row">
                    <div class="col-md-4 clickable">
                        <button type="button" class="btn btn-dark btn-lg mb-3 btn-custom" onclick="window.location='membre.php';">
                            <i class="lni lni-users"></i> Gestion des membres
                        </button>
                    </div>
                    <div class="col-md-4 clickable">
                        <button type="button" class="btn btn-dark btn-lg mb-3 btn-custom" onclick="window.location='game.php';">
                            <i class="lni lni-game"></i> Gestion des jeux
                        </button>
                    </div>
                    <div class="col-md-4 clickable">
                        <button type="button" class="btn btn-dark btn-lg mb-3 btn-custom" onclick="window.location='event.php';">
                            <i class="lni lni-agenda"></i> Gestion des événements
                        </button>
                    </div>
                </div>
            </div>



        </div>
    </div>
</main>
<?php include_once('template/footer.php') ?>