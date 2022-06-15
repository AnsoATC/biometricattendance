<?php  
session_start();
//Connect to database
require 'connectDB.php';

//Add user Fingerprint
if (isset($_POST['Add_fingerID'])) {

    $fingerid = $_POST['fingerid'];
    $dev_uid = $_POST['dev_uid'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $gender = $_POST['gender'];

    if ($fingerid == 0) {
        echo "Entrez un ID d'empreinte digitale !";
        exit();
    }
    if ($dev_uid == 0) {
        echo "Sélectionnez le département de l'utilisateur !";
        exit();
    }
    if(empty($name) || empty($email) || empty($number) || empty($gender)){
        echo "Veuillez remplir tous les champs";
        exit();
    }
    else{
        if ($fingerid > 0 && $fingerid < 128) {
            $sql = "SELECT * FROM devices WHERE device_uid=?";
            $result = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($result, $sql)) {
                echo "SQL_Error";
                exit();
            }
            else{
                mysqli_stmt_bind_param($result, "i", $dev_uid);
                mysqli_stmt_execute($result);
                $resultl = mysqli_stmt_get_result($result);
                if ($row = mysqli_fetch_assoc($resultl)) {
                    $dev_uid = $row['device_uid'];
                }
            }
            $sql = "SELECT fingerprint_id FROM users WHERE fingerprint_id=? AND device_uid=?";
            $result = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($result, $sql)) {
              echo "SQL_Error";
              exit();
            }
            else{
                mysqli_stmt_bind_param($result, "is", $fingerid, $dev_uid);
                mysqli_stmt_execute($result);
                $resultl = mysqli_stmt_get_result($result);
                if (!$row = mysqli_fetch_assoc($resultl)) {

                    $sql = "SELECT add_fingerid FROM users WHERE add_fingerid=1 AND device_uid=?";
                    $result = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($result, $sql)) {
                      echo "SQL_Error";
                      exit();
                    }
                    else{
                        mysqli_stmt_bind_param($result, "s", $dev_uid);
                        mysqli_stmt_execute($result);
                        $resultl = mysqli_stmt_get_result($result);
                        if (!$row = mysqli_fetch_assoc($resultl)) {
                            //check if there any selected user
                            $sql="UPDATE users SET fingerprint_select=0 WHERE fingerprint_select=1 AND device_uid=?";
                            $result = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($result, $sql)) {
                              echo "SQL_Error";
                              exit();
                            }
                            else{
                                mysqli_stmt_bind_param($result, "s", $dev_uid);
                                mysqli_stmt_execute($result);
                                $sql = "INSERT INTO users ( username, serialnumber, gender, email, fingerprint_id, fingerprint_select, user_date, device_uid, del_fingerid , add_fingerid, add_by) VALUES (?, ?, ?, ?, ?, 1, CURDATE(), ?, 0, 1, ?)";
                                $result = mysqli_stmt_init($conn);
                                if (!mysqli_stmt_prepare($result, $sql)) {
                                  echo "SQL_Error";
                                  exit();
                                }
                                else{
                                    mysqli_stmt_bind_param($result, "ssssiss", $name, $number, $gender, $email, $fingerid, $dev_uid, $_SESSION['Admin-id']);
                                    mysqli_stmt_execute($result);
                                    echo 1;
                                    exit();
                                }

                            }
                        }
                        else{
                            echo "You can't add more than one ID each time";
                        }
                    }   
                }
                else{
                    echo "This ID is already exist! Delete it from the scanner";
                    exit();
                }
            }
        }
        else{
            echo "The Fingerprint ID must be between 1 & 127";
            exit();
        }
    }
}
//Add user
if (isset($_POST['Add'])) {
   
    $Uname = $_POST['name'];
    $Number = $_POST['number'];
    // $Email= $_POST['email'];
    $dev_uid = $_POST['dev_uid'];
    $finger_id = $_POST['finger_id'];
    
    //check if there any selected user
    $sql = "SELECT * FROM users WHERE fingerprint_id=? AND device_uid=?";
    $result = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($result, $sql)) {
      echo "SQL_Error";
      exit();
    }
    else{
        mysqli_stmt_bind_param($result, "is", $finger_id, $dev_uid);
        mysqli_stmt_execute($result);
        $resultl = mysqli_stmt_get_result($result);
        if ($row = mysqli_fetch_assoc($resultl)) {

            if ($row['username'] == "None") {

                if (!empty($Uname) && !empty($Number)) {
                    if (!empty($_POST['gender'])) {
                        $Gender = $_POST['gender'];
                        //check if there any user had already the Serial Number
                        $sql = "SELECT serialnumber FROM users WHERE serialnumber=? AND device_uid=?";
                        $result = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($result, $sql)) {
                            echo "SQL_Error";
                            exit();
                        }
                        else{
                            mysqli_stmt_bind_param($result, "ds", $Number, $dev_uid);
                            mysqli_stmt_execute($result);
                            $resultl = mysqli_stmt_get_result($result);
                            if (!$row = mysqli_fetch_assoc($resultl)) {
                                
                                $sql="UPDATE users SET username=?, serialnumber=?, gender=?, user_date=CURDATE() WHERE fingerprint_select=1 AND device_uid=?";
                                $result = mysqli_stmt_init($conn);
                                if (!mysqli_stmt_prepare($result, $sql)) {
                                    echo "SQL_Error_select_Fingerprint";
                                    exit();
                                }
                                else{
                                    mysqli_stmt_bind_param($result, "sdss", $Uname, $Number, $Gender, $dev_uid );
                                    mysqli_stmt_execute($result);
                                    $sql="UPDATE users SET fingerprint_select=0 WHERE device_uid=?";
                                    $result = mysqli_stmt_init($conn);
                                    if (!mysqli_stmt_prepare($result, $sql)) {
                                        echo "SQL_Error_select_Fingerprint";
                                        exit();
                                    }
                                    else{
                                        mysqli_stmt_bind_param($result, "s", $dev_uid );
                                        mysqli_stmt_execute($result);
                                    }
                                    echo 1;
                                    exit();
                                }
                            }
                            else {
                                echo "The serial number is already taken!";
                                exit();
                            }
                        }
                    }
                    else{
                        echo "Gender empty!";
                        exit();
                    }
                }
                else{
                    echo "Empty Fields";
                    exit();
                }
            }
            else{
                echo "This Fingerprint is already added";
                exit();
            }    
        }
        else {
            echo "There's no selected Fingerprint!";
            exit();
        }
    }
}
// Update an existance user 
if (isset($_POST['Update'])) {

    $id = $_POST['id'];
    $Uname = $_POST['name'];
    $Number = $_POST['number'];
    $Email= $_POST['email'];
    $dev_uid = $_POST['dev_uid'];
    $finger_id = $_POST['finger_id'];

    if (!empty($_POST['gender'])) {
        $Gender= $_POST['gender'];
        //check if there any selected user
        $sql = "SELECT * FROM users WHERE id=?";
        $result = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($result, $sql)) {
          echo "SQL_Error";
          exit();
        }
        else{
            mysqli_stmt_bind_param($result, "s", $id);
            mysqli_stmt_execute($result);
            $resultl = mysqli_stmt_get_result($result);
            if ($row = mysqli_fetch_assoc($resultl)) {

                if ($row['add_fingerid'] == 1) {
                    echo "Tout d'abord, vous devez ajouter l'utilisateur !";
                    exit();
                }
                else{
                    if (empty($Uname) || empty($Number) || empty($Email)) {
                        echo "Remplissez tous les champs";
                        exit();
                    }
                    else{
                        //check if there any user had already the Serial Number
                        $sql = "SELECT serialnumber FROM users WHERE serialnumber=? AND id!=?";
                        $result = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($result, $sql)) {
                            echo "SQL_Error";
                            exit();
                        }
                        else{
                            mysqli_stmt_bind_param($result, "ds", $Number, $id);
                            mysqli_stmt_execute($result);
                            $resultl = mysqli_stmt_get_result($result);
                            if (!$row = mysqli_fetch_assoc($resultl)) {                 
                                if (!empty($Uname)) {

                                    $sql="UPDATE users SET username=?, serialnumber=?, email=?, gender=? WHERE id=?";
                                    $result = mysqli_stmt_init($conn);
                                    if (!mysqli_stmt_prepare($result, $sql)) {
                                        echo "SQL_Error_select_Fingerprint";
                                        exit();
                                    }
                                    else{
                                        mysqli_stmt_bind_param($result, "sdsss", $Uname, $Number, $email, $Gender, $id );
                                        mysqli_stmt_execute($result);
                                        $sql="UPDATE users SET fingerprint_select=0 WHERE device_uid=?";
                                        $result = mysqli_stmt_init($conn);
                                        if (!mysqli_stmt_prepare($result, $sql)) {
                                            echo "SQL_Error_select_Fingerprint";
                                            exit();
                                        }
                                        else{
                                            mysqli_stmt_bind_param($result, "s", $dev_uid );
                                            mysqli_stmt_execute($result);
                                        }
                                        echo 1;
                                        exit();
                                    }
                                }
                            }
                            else {
                                echo "The serial number is already taken!";
                                exit();
                            }
                        }
                    }
                }    
            }
            else {
                echo "There's no selected User to update!";
                exit();
            }
        }
    }
    else{
        echo "Gender empty!";
        exit();
    }
}
// select fingerprint 
if (isset($_GET['select'])) {

    $finger_id = $_GET['finger_id'];
    $dev_uid = $_GET['dev_uid'];

    $sql="UPDATE users SET fingerprint_select=0 WHERE device_uid=?";
    $result = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($result, $sql)) {
        echo "SQL_Error_Select";
        exit();
    }
    else{
        mysqli_stmt_bind_param($result, "s", $dev_uid);
        mysqli_stmt_execute($result);

        $sql="UPDATE users SET fingerprint_select=1 WHERE fingerprint_id=? AND device_uid=?";
        $result = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($result, $sql)) {
            echo "SQL_Error_select_Fingerprint";
            exit();
        }
        else{
            mysqli_stmt_bind_param($result, "is", $finger_id, $dev_uid);
            mysqli_stmt_execute($result);

            // echo "User Fingerprint selected";
            // exit();
            header('Content-Type: application/json');
            $data = array();
            $sqls = "SELECT * FROM users WHERE fingerprint_id=? AND device_uid=?";
            $results = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($results, $sqls)) {
                echo "SQL_Error";
                exit();
            }
            else{
                mysqli_stmt_bind_param($results, "is", $finger_id, $dev_uid);
                mysqli_stmt_execute($results);
                $resultls = mysqli_stmt_get_result($results); 
                if ($rows = mysqli_fetch_assoc($resultls)) {
                    foreach ($resultls as $rows) {
                        $data[] = $rows;
                    }
                }
            }
            $result->close();
            $conn->close();
            print json_encode($data);
        }
    }
}
// delete user 
if (isset($_POST['delete'])) {

    $finger_id = $_POST['finger_id'];
    $dev_uid = $_POST['dev_uid'];

    if ($finger_id == 0) {
        echo "There no selected user to remove";
        exit();
    } else {
        $sql="UPDATE users SET del_fingerid=1 WHERE fingerprint_id=? AND device_uid=?";
        $result = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($result, $sql)) {
            echo "SQL_Error_delete";
            exit();
        }
        else{
            mysqli_stmt_bind_param($result, "is", $finger_id, $dev_uid);
            mysqli_stmt_execute($result);
            echo 1;
            exit();
        }
    }
}
?>
