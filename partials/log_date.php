<?php
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
    $_SESSION['searchQuery'] .= " AND u.fingerprint_id='".$Finger_sel."'";
}
?>