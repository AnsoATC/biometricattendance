<?php  
session_start();
?>
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>Numéro de série</th>
            <th>Nom</th>
            <th>Département</th>
            <th>Dispositif</th>
            <th>ID d'emprunt</th>
            <th>Date</th>
            <th>Time in</th>
            <th>Time out</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Numéro de série</th>
            <th>Nom</th>
            <th>Département</th>
            <th>Dispositif</th>
            <th>ID d'emprunt</th>
            <th>Date</th>
            <th>Time in</th>
            <th>Time out</th>
        </tr>
    </tfoot>
    <tbody>
        <?php
        //Connect to database
        require '../connectDB.php';
        $searchQuery = " ";
        $Start_date = " ";
        $End_date = " ";
        $Start_time = " ";
        $End_time = " ";
        $Dep_sel = " ";
        $Dev_uid = " ";
        $Finger_sel = " ";

        if (isset($_POST['log_date'])) {            
            include 'log_date.php';
        }

        if ($_POST['select_date'] == 1) {
            $Start_date = date("Y-m-d");
            $_SESSION['searchQuery'] = "checkindate='" . $Start_date . "'";
        }
        // echo $_SESSION['searchQuery'];
        // $sql = "SELECT * FROM users_logs WHERE checkindate=? AND pic_date BETWEEN ? AND ? ORDER BY id ASC";
        $and = $_SESSION['searchQuery'] != '' ? 'AND' : '';
        $sql = "SELECT ul.id, u.serialnumber, u.username, dep.dep_name, dev.device_name, ul.fingerprint_id, ul.checkindate, ul.timein, ul.timeout
        FROM users_logs AS ul, users AS u, devices AS dev, departement AS dep
        WHERE " . $_SESSION['searchQuery'] . $and . 
        " ul.device_uid=u.device_uid AND ul.fingerprint_id=u.fingerprint_id AND ul.device_uid=dev.device_uid AND dev.dep_id=dep.id
        ORDER BY ul.id DESC";

        $result = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($result, $sql)) {
            echo '<p class="text-danger text-center">SQL Error</p>';
        } else {
            mysqli_stmt_execute($result);
            $resultl = mysqli_stmt_get_result($result);
            if (mysqli_num_rows($resultl) > 0) {
                while ($row = mysqli_fetch_assoc($resultl)) {
        ?>
                    <tr>
                        <td><?php echo $row['serialnumber']; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['dep_name']; ?></td>
                        <td><?php echo $row['device_name']; ?></td>
                        <td><?php echo $row['fingerprint_id']; ?></td>
                        <td><?php echo $row['checkindate']; ?></td>
                        <td><?php echo $row['timein']; ?></td>
                        <td><?php echo $row['timeout']; ?></td>
                    </tr>
        <?php
                }
            }
        }
        // echo $sql;
        ?>
    </tbody>
</table>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>