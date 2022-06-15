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
                        <h1 class="h3 mb-0 text-gray-800">Liste des départements</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">organisation</a></li>
                                <li class="breadcrumb-item active" aria-current="page">départements</li>
                            </ol>
                        </nav>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Liste des départements disponibles</h6>
                            <div>
                                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target=".editModal" data-mode="add"><i class="fas fa-plus fa-sm text-white-50"></i> Ajouter</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive" id="departementData">
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
    <div class="modal editModal fade bd-example-modal-lg" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="editModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajouter un département</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-fw fa-window-close"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="mx-auto" id="dep_edit_form" enctype="multipart/form-data" novalidate>
                        <div class="form-group row">
                            <label for="dep_name" class="col-sm-3 col-form-label">Nom du département</label>
                            <div class="col-sm-9">
                                <input type="text" name="dep_name" id="dep_name" class="form-control" placeholder="Entez le nom du département" required>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                    <a class="btn btn-primary edit_departement">Valider</a>
                </div>
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

    <script src="js/departement.js"></script>

</body>

</html>