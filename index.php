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

                <?php
                if (isset($_GET['login'])) {
                    if ($_GET['login'] == "success") {
                        echo '<div class="toast toast-info" data-autohide="false">
                                <div class="toast-header">
                                    <strong class="mr-auto text-primary">Bienvenu ' . $_SESSION['Admin-name'] . ' !<br/>Vous êtes connecté avec succès</strong>
                                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
                                </div>
                                <div class="progress"></div>
                            </div>';
                    }
                }
                ?>

                <!-- Begin Page Content -->
                <div class="container-fluid" style="position: relative;">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Accueil</li>
                            </ol>
                        </nav>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Départements</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                require 'connectDB.php';
                                                $sql = "SELECT COUNT(*) AS 'nbr' FROM departement";
                                                $result = mysqli_stmt_init($conn);
                                                if (!mysqli_stmt_prepare($result, $sql)) {
                                                    echo '<p>SQL Error</p>';
                                                } else {
                                                    mysqli_stmt_execute($result);
                                                    $resultl = mysqli_stmt_get_result($result);
                                                    if ($row = mysqli_fetch_assoc($resultl)) {
                                                        echo $row['nbr'];
                                                    } else {
                                                        echo 0;
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-sitemap fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Dispositifs (digital)
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                require 'connectDB.php';
                                                $sql = "SELECT COUNT(*) AS 'nbr' FROM devices";
                                                $result = mysqli_stmt_init($conn);
                                                if (!mysqli_stmt_prepare($result, $sql)) {
                                                    echo '<p>SQL Error</p>';
                                                } else {
                                                    mysqli_stmt_execute($result);
                                                    $resultl = mysqli_stmt_get_result($result);
                                                    if ($row = mysqli_fetch_assoc($resultl)) {
                                                        echo $row['nbr'];
                                                    } else {
                                                        echo 0;
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-desktop fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Utilisateurs (Enrollés)
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                        <?php
                                                        require 'connectDB.php';
                                                        $sql = "SELECT COUNT(*) AS 'nbr' FROM users WHERE add_fingerid=1";
                                                        $result = mysqli_stmt_init($conn);
                                                        if (!mysqli_stmt_prepare($result, $sql)) {
                                                            echo '<p>SQL Error</p>';
                                                        } else {
                                                            mysqli_stmt_execute($result);
                                                            $resultl = mysqli_stmt_get_result($result);
                                                            if ($row = mysqli_fetch_assoc($resultl)) {
                                                                echo $row['nbr'];
                                                            } else {
                                                                echo 0;
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar" style="width:
                                                                    <?php
                                                                    require 'connectDB.php';
                                                                    $sql = "SELECT COUNT(*) AS 'nbr' FROM users GROUP BY add_fingerid
                                                                        ";
                                                                    $result = mysqli_stmt_init($conn);
                                                                    if (!mysqli_stmt_prepare($result, $sql)) {
                                                                        echo '<p>SQL Error</p>';
                                                                    } else {
                                                                        mysqli_stmt_execute($result);
                                                                        $resultl = mysqli_stmt_get_result($result);
                                                                        $values = array();
                                                                        while ($row = mysqli_fetch_assoc($resultl)) {
                                                                            array_push($values, $row['nbr']);
                                                                        }
                                                                        echo ($values[1] / ($values[0] + $values[1]) * 100) . '%';
                                                                    }
                                                                    ?>
                                                        " aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Activités (aujourd'hui)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php
                                                require 'connectDB.php';
                                                $sql = "SELECT COUNT(*) AS 'nbr' FROM users_logs WHERE checkindate=date('Y-m-d')";
                                                $result = mysqli_stmt_init($conn);
                                                if (!mysqli_stmt_prepare($result, $sql)) {
                                                    echo '<p>SQL Error</p>';
                                                } else {
                                                    mysqli_stmt_execute($result);
                                                    $resultl = mysqli_stmt_get_result($result);
                                                    if ($row = mysqli_fetch_assoc($resultl)) {
                                                        echo $row['nbr'];
                                                    } else {
                                                        echo 0;
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-chart-line fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Dispositifs par département</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="devicesByDepartementChart"></canvas>
                                    </div>
                                    <div id="devicesByDepartementLegende" class="mt-4 text-center small">
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

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>

    <!-- Custom toast -->
    <script src="js/toast.js"></script>

    <script src="js/index.js"></script>

</body>

</html>