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

                <div id="toast" class="toast toast-danger" data-autohide="false">
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
                        <h1 class="h3 mb-0 text-gray-800">Enrollement</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">utilisateurs</a></li>
                                <li class="breadcrumb-item active" aria-current="page">enrollement</li>
                            </ol>
                        </nav>
                    </div>

                    <!-- Content Row -->
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Ajouter un nouvel utilisateur</h6>
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                            </div>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <form class="mx-auto" id="user_add_form" enctype="multipart/form-data" novalidate>
                                <div class="form-group row">
                                    <label for="dep_sel" class="col-sm-3 col-form-label">Département</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="dep_sel" id="dep_sel" aria-placeholder="Sélectionner un département" required>
                                            <option value="">Sélectionez un département</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="dev_sel" class="col-sm-3 col-form-label">Appareil</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="dev_sel" id="dev_sel" aria-placeholder="Sélectionner un département" required>
                                            <option value="">Sélectionez un dispositif</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="fingerid" class="col-sm-3 col-form-label">Identifiant d'emprunte</label>
                                    <div class="col-sm-9">
                                        <input type="number" min="1" max="127" class="form-control" name="fingerid" id="fingerid" placeholder="Entez un nombre compris entre 1 et 127" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-3 col-form-label">Nom et prénoms</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Entez le nom complet de l'utilisateur" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-3 col-form-label">Adresse email</label>
                                    <div class="col-sm-9">
                                        <input type="email" name="email" id="email" class="form-control" placeholder="Entez l'adresse mail de l'utilisateur" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="number" class="col-sm-3 col-form-label">Numéro de série</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="number" id="number" class="form-control" placeholder="Entrez le numéro de série" required>
                                    </div>
                                </div>
                                <fieldset class="form-group">
                                    <div class="row">
                                        <legend class="col-form-label col-sm-3 pt-0">Sex</legend>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-sm-3 col-xs-4 form-check">
                                                    <input class="form-check-input gender" type="radio" name="gender" id="gridRadios1" value="Male" checked>
                                                    <label class="form-check-label" for="gridRadios1">
                                                        Masculin (M)
                                                    </label>
                                                </div>
                                                <div class="col-sm-3 col-xs-4 form-check">
                                                    <input class="form-check-input gender" type="radio" name="gender" id="gridRadios2" value="Female">
                                                    <label class="form-check-label" for="gridRadios2">
                                                        Féminin (F)
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="form-group row d-flex flex-row align-items-center">
                                    <div class="col-sm-10 ">
                                        <button type="submit" name="user_add" class="btn btn-primary">Valider</button>
                                    </div>
                                </div>
                            </form>
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

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <script src="js/enrollement.js"></script>

</body>

</html>