<?php
//Connect to database
require 'connectDB.php';

error_reporting(E_ERROR | E_PARSE);

$output = '';

if (isset($_POST["To_Excel"])) {

    $searchQuery = " ";
    $Start_date = " ";
    $End_date = " ";
    $Start_time = " ";
    $End_time = " ";
    $Dep_sel = " ";
    $Dev_uid = " ";
    $Finger_sel = " ";

    //Start date filter
    if ($_POST['date_sel_start'] != "") {
        $Start_date = $_POST['date_sel_start'];
        $_SESSION['searchQuery'] = "ul.checkindate='" . $Start_date . "'";
    } else {
        $Start_date = date("Y-m-d");
        $_SESSION['searchQuery'] = "ul.checkindate='" . date("Y-m-d") . "'";
    }
    //End date filter
    if ($_POST['date_sel_end'] != "") {
        $End_date = $_POST['date_sel_end'];
        $_SESSION['searchQuery'] = "ul.checkindate BETWEEN '" . $Start_date . "' AND '" . $End_date . "'";
    }
    //Time-In filter
    if ($_POST['time_sel'] == "Time_in") {
        //Start time filter
        if ($_POST['time_sel_start'] != "" && $_POST['time_sel_end'] == "") {
            $Start_time = $_POST['time_sel_start'];
            $_SESSION['searchQuery'] .= " AND ul.timein='" . $Start_time . "'";
        } elseif ($_POST['time_sel_start'] != "" && $_POST['time_sel_end'] != "") {
            $Start_time = $_POST['time_sel_start'];
        }
        //End time filter
        if ($_POST['time_sel_end'] != "") {
            $End_time = $_POST['time_sel_end'];
            $_SESSION['searchQuery'] .= " AND ul.timein BETWEEN '" . $Start_time . "' AND '" . $End_time . "'";
        }
    }
    //Time-out filter
    if ($_POST['time_sel'] == "Time_out") {
        //Start time filter
        if ($_POST['time_sel_start'] != "" && $_POST['time_sel_end'] == "") {
            $Start_time = $_POST['time_sel_start'];
            $_SESSION['searchQuery'] .= " AND ul.timeout='" . $Start_time . "'";
        } elseif ($_POST['time_sel_start'] != "" && $_POST['time_sel_end'] != "") {
            $Start_time = $_POST['time_sel_start'];
        }
        //End time filter
        if ($_POST['time_sel_end'] != "") {
            $End_time = $_POST['time_sel_end'];
            $_SESSION['searchQuery'] .= " AND ul.timeout BETWEEN '" . $Start_time . "' AND '" . $End_time . "'";
        }
    }
    //Department filter
    if ($_POST['dep_sel'] != 0) {
        $Dep_sel = $_POST['dep_sel'];
        $_SESSION['searchQuery'] .= " AND dep.id='" . $Dep_sel . "'";
    }
    //Device filter
    if ($_POST['dev_uid'] != 0) {
        $Dev_uid = $_POST['dev_uid'];
        $_SESSION['searchQuery'] .= " AND dev.dev_uid='" . $Dev_uid . "'";
    }
    //Fingerprint filter
    if ($_POST['fing_sel'] != 0) {
        $Finger_sel = $_POST['fing_sel'];
        $_SESSION['searchQuery'] .= " AND u.fingerprint_id='" . $Finger_sel . "'";
    }

    $and = $_SESSION['searchQuery'] != '' ? 'AND' : '';
    $sql = "SELECT ul.id, u.serialnumber, u.username, dep.dep_name, dev.device_name, ul.fingerprint_id, ul.checkindate, ul.timein, ul.timeout
        FROM users_logs AS ul, users AS u, devices AS dev, departement AS dep
        WHERE " . $_SESSION['searchQuery'] . $and .
        " ul.device_uid=u.device_uid AND ul.fingerprint_id=u.fingerprint_id AND ul.device_uid=dev.device_uid AND dev.dep_id=dep.id
        ORDER BY ul.id DESC";

    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        $i = 0;
        $output .= '
                  <table class="table" bordered="1">  
                    <tr>
                        <th>No</th>
                        <th>Numéro de série</th>
                        <th>Nom</th>
                        <th>Département</th>
                        <th>Dispositif</th>
                        <th>ID d\'emprunt</th>
                        <th>Date</th>
                        <th>Time in</th>
                        <th>Time out</th>
                    </tr>';
        while ($row = $result->fetch_assoc()) {
            $i++;
            $output .= '
                        <tr>
                            <td> ' . $i . '</td> 
                            <td> ' . $row['serialnumber'] . '</td>
                            <td> ' . $row['username'] . '</td>
                            <td> ' . $row['dep_name'] . '</td>
                            <td> ' . $row['device_name'] . '</td>
                            <td> ' . $row['fingerprint_id'] . '</td>
                            <td> ' . $row['checkindate'] . '</td>
                            <td> ' . $row['timein'] . '</td>
                            <td> ' . $row['timeout'] . '</td>
                        </tr>';
        }
        $output .= '</table>';
        header('Content-Type: application/xls');
        header('Content-Disposition: attachment; filename=User_Log' . $Start_date . '.xls');

        echo $output;
        exit();
    } else {
        header("location: users_logs.php");
        exit();
    }
}
