<?php
session_start();
if (!isset($_SESSION['Admin-name'])) {
    header("location: login.php");
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard - Attendance System </title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- Custom toast -->
    <link href="css/toast.css" rel="stylesheet">

    <link rel="stylesheet" href="css/users_logs.css">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php include 'partials/side_bar.php' ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php include 'partials/top_bar.php' ?>

                <div id="toast" class="toast toast-info" data-autohide="false">
                    <div class="toast-header">
                        <strong class="mr-auto" id="toast-content">Connecté avec succès</strong>
                        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
                    </div>
                    <div class="progress"></div>
                </div>

                <!-- Begin Page Content -->
                <div class="container-fluid" style="position: relative;">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Journaux quotidiens des utilisateurs</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">activités</a></li>
                                <li class="breadcrumb-item active" aria-current="page">historique</li>
                            </ol>
                        </nav>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Voici les journaux quotidiens des utilisateurs</h6>
                            <div>
                                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target=".filterModal">Filtre de journal/ Exporter vers Excel</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive" id="usersLogsData">
                                <div class="d-flex justify-content-center">
                                    <div class="spinner-border" role="status">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <?php include 'partials/footer_bottom.php' ?>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <?php include 'components/scroll_to_top.php' ?>

    <?php include 'components/logout_modal.php' ?>

    <!-- Modal -->
    <div class="modal fade filterModal bd-example-modal-lg" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="filterModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Filtrez votre journal utilisateur :</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-fw fa-window-close"></i></span>
                    </button>
                </div>
                <form method="POST" id="filter_form" action="Export_Excel.php" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-6 col-sm-6">
                                    <div class="card card-primary">
                                        <div class="card-header">Filtrer par date :</div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="date_sel_start">Sélectionnez à partir de cette date :</label>
                                                <input type="date" name="date_sel_start" class="form-control" id="date_sel_start">
                                            </div>
                                            <div class="form-group">
                                                <label for="date_sel_end">Jusqu'à cette date :</label>
                                                <input type="date" name="date_sel_end" class="form-control" id="date_sel_end">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            Filtrer par :
                                            <div class="time">
                                                <input type="radio" id="radio-one" name="time_sel" class="time_sel" value="Time_in" checked />
                                                <label for="radio-one">Arrivée</label>
                                                <input type="radio" id="radio-two" name="time_sel" class="time_sel" value="Time_out" />
                                                <label for="radio-two">Départ</label>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="time_sel_start">Sélectionnez à partir de cette heure :</label>
                                                <input type="time" name="time_sel_start" class="form-control" id="time_sel_start">
                                            </div>
                                            <div class="form-group">
                                                <label for="time_sel_end">Jusqu'à cette heure :</label>
                                                <input type="time" name="time_sel_end" class="form-control" id="time_sel_end">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dep_sel" class="col-form-label">Département</label>
                                        <div>
                                            <select class="form-control" name="dep_sel" id="dep_sel" aria-placeholder="Sélectionner un département" required>
                                                <option value="0">Tous les départements</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dev_sel" class="col-form-label">Appareil</label>
                                        <div>
                                            <select class="form-control" name="dev_sel" id="dev_sel" aria-placeholder="Sélectionner un département" required>
                                                <option value="0">Tous les appareils</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fing_sel" class="col-form-label">Filtrer par ID d'empreinte digitale :</label>
                                        <div>
                                            <select class="form-control" name="fing_sel" id="fing_sel" aria-placeholder="Sélectionner un département" required>
                                                <option value="0">Tous les utilisateurs</option>
                                                <?php
                                                require 'connectDB.php';
                                                $sql = "SELECT fingerprint_id FROM users WHERE add_fingerid=0 ORDER BY fingerprint_id ASC";
                                                $result = mysqli_stmt_init($conn);
                                                if (!mysqli_stmt_prepare($result, $sql)) {
                                                    echo '<p class="error">SQL Error</p>';
                                                } else {
                                                    mysqli_stmt_execute($result);
                                                    $resultl = mysqli_stmt_get_result($result);
                                                    while ($row = mysqli_fetch_assoc($resultl)) {
                                                ?>
                                                        <option value="<?php echo $row['fingerprint_id']; ?>"><?php echo $row['fingerprint_id']; ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="To_Excel">Exporter en excel :</label>
                                        <input type="submit" class="form-control btn btn-outline-success" name="To_Excel" value="Exporter" id="To_Excel">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                        <a class="btn btn-primary" name="user_log" id="user_log">Filtrer</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <script src="js/users_logs.js"></script>

</body>

</html>