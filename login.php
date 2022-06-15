<?php
session_start();
if (isset($_SESSION['Admin-name'])) {
  header("location: index.php");
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

    <title>Dashboard - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/login.css">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0 slideInDown animated">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6 form">
                                <div class="p-5">
                                    <?php  
                                            if (isset($_GET['error'])) {
                                                if ($_GET['error'] == "invalidEmail") {
                                                    echo '<div class="alert alert-danger">
                                                            This E-mail is invalid!!
                                                        </div>';
                                                }
                                                elseif ($_GET['error'] == "sqlerror") {
                                                    echo '<div class="alert alert-danger">
                                                            There a database error!!
                                                        </div>';
                                                }
                                                elseif ($_GET['error'] == "wrongpassword") {
                                                    echo '<div class="alert alert-danger">
                                                            Wrong password!!
                                                        </div>';
                                                }
                                                elseif ($_GET['error'] == "nouser") {
                                                    echo '<div class="alert alert-danger">
                                                            This E-mail does not exist!!
                                                        </div>';
                                                }
                                            }
                                            if (isset($_GET['reset'])) {
                                                if ($_GET['reset'] == "success") {
                                                    echo '<div class="alert alert-success">
                                                            Check your E-mail!
                                                        </div>';
                                                }
                                            }
                                            if (isset($_GET['account'])) {
                                                if ($_GET['account'] == "activated") {
                                                    echo '<div class="alert alert-success">
                                                            Please Login
                                                        </div>';
                                                }
                                            }
                                            if (isset($_GET['active'])) {
                                                if ($_GET['active'] == "success") {
                                                    echo '<div class="alert alert-success">
                                                            The activation like has been sent!
                                                        </div>';
                                                }
                                            }
                                    ?>
                                    <div class="text-center slideInDown animated">
                                        <h1 class="h4 text-gray-900 mb-4">Connectez-vous</h1>
                                    </div>
                                    <div class="text-center slideInDown animated" id="reset">
                                        <h1 class="h4 text-gray-900 mb-4">Mot de passe oublié ?</h1>
                                    </div>
                                    <div class="alert1"></div>
                                    <div class="login-form">
                                        <form class="user" action="ac_login.php" method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <input type="email" name="email" class="form-control form-control-user"
                                                    id="exampleInputEmail" aria-describedby="emailHelp"
                                                    placeholder="Enter Email Address..." required>
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="pwd" class="form-control form-control-user"
                                                    id="exampleInputPassword" placeholder="Password" required>
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox small">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck">
                                                    <label class="custom-control-label" for="customCheck">Se rappeler de moi</label>
                                                </div>
                                            </div>
                                            <button class="btn btn-primary btn-user btn-block" type="submit" name="login" id="login">Se connecter</button>
                                        </form>
                                        <hr>
                                        <div class="text-center message">
                                            <a class="small" href="#">Mot de passe oublié ?</a>
                                        </div>
                                    </div>
                                    <div class="reset-form">
                                        <form class="user" action="ac_login.php" method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <input type="email" name="email" class="form-control form-control-user"
                                                    id="exampleInputEmail" aria-describedby="emailHelp"
                                                    placeholder="Enter Email Address..." required>
                                            </div>
                                            <button class="btn btn-primary btn-user btn-block" type="submit" name="reset_pass">Changer le mot de passe</button>
                                        </form>
                                        <hr>
                                        <div class="text-center message">
                                            <a class="small" href="#">Vous avez déjà un compte? Connexion!</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
    <script>
        $(window).on("load resize ", function() {
            var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
            $('.tbl-header').css({'padding-right':scrollWidth});
        }).resize();
    </script>
    <script type="text/javascript">
        loginForm = document.getElementsByClassName("login-form");
        resetForm = document.getElementsByClassName("reset-form");
        $(document).ready(function(){
            $(document).on('click', '.message', function(){
                // $('.reset-form').css('display','block');
                // $('.login-form').css('display','none');
                $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
                $('h1').animate({height: "toggle", opacity: "toggle"}, "slow");
            });
        });
    </script>

</body>

</html>