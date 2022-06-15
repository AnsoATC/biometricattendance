<?php
require 'connectDB.php';

if (isset($_POST['Add_dep'])) {
    $dep_name = $_POST['dep_name'];
    if (empty($dep_name)) {
        echo "Veuillez remplir tous les champs";
        exit();
    } else {
        $sql = "INSERT INTO departement (dep_name) VALUES (?)";
        $result = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($result, $sql)) {
            echo "SQL_Error";
            exit();
        } else {
            mysqli_stmt_bind_param($result, "s", $dep_name);
            mysqli_stmt_execute($result);
            echo 1;
            exit();
        }
    }
}elseif(isset($_POST['Edit_dep'])){
    $dep_name = $_POST['dep_name'];
    $dep_id = $_POST['dep_id'];
    if (empty($dep_name)) {
        echo "Veuillez remplir tous les champs";
        exit();
    } else {
        $sql = "UPDATE departement SET dep_name=? WHERE id=?";
        $result = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($result, $sql)) {
            echo "SQL_Error";
            exit();
        } else {
            mysqli_stmt_bind_param($result, "ss", $dep_name, $dep_id);
            mysqli_stmt_execute($result);
            echo 1;
            exit();
        }
    }
}
