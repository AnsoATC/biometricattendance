<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>Numéro série</th>
            <th>Nom</th>
            <th>ID d'emprunt</th>
            <th>Département</th>
            <th>Dispositif</th>
            <th>Date d'ajout</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Numéro série</th>
            <th>Nom</th>
            <th>ID d'emprunt</th>
            <th>Département</th>
            <th>Dispositif</th>
            <th>Date d'ajout</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </tfoot>
    <tbody>
        <?php
            //Connect to database
            require '../connectDB.php';

            $sql = "SELECT u.id, u.username, u.serialnumber, u.gender, u.email, u.fingerprint_id, u.user_date, u.add_fingerid,
                    u.device_uid, dev.device_name, dep.dep_name
                    FROM users AS u, devices AS dev, departement AS dep 
                    WHERE u.device_uid=dev.device_uid AND dev.dep_id=dep.id AND u.del_fingerid=0 
                    ORDER BY u.id DESC";
            $result = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($result, $sql)) {
                echo '<p class="error">SQL Error</p>';
            } else {
                mysqli_stmt_execute($result);
                $resultl = mysqli_stmt_get_result($result);
                if (mysqli_num_rows($resultl) > 0) {
                    while ($row = mysqli_fetch_assoc($resultl)) {
            ?>
                        <tr>
                            <td><?php echo $row['serialnumber']; ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['fingerprint_id']; ?></td>
                            <td><?php echo $row['dep_name']; ?></td>
                            <td><?php echo $row['device_name']; ?></td>
                            <td><?php echo $row['user_date']; ?></td>
                            <td><?php echo ($row['add_fingerid'] == "0") ? "Added" : "Free" ?></td>
                            <td>
                                <div class="row">
                                    <div class="col-6">
                                        <button type="button" title="Supprimer" class="btn btn-danger btn-sm" data-toggle="modal" data-target=".deleteModal" data-finger_id="<?php echo $row['fingerprint_id']; ?>" data-device_uid="<?php echo $row['device_uid']; ?>">
                                            <i class="fas fa-fw fa-trash"></i>
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" title="Modifier" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".editModal" data-id="<?php echo $row['id']; ?>" data-device_uid="<?php echo $row['device_uid']; ?>" data-array="<?php echo($row['dep_name'].','.$row['device_name'].','.$row['fingerprint_id'].','.$row['username'].','.$row['email'].','.$row['serialnumber'].','.$row['gender'].','.$row['device_uid']); ?>"><i class="fas fa-fw fa-pencil-alt"></i></button>
                                    </div>
                                </div>
                            </td>
                        </tr>
            <?php
                }
            }
        }
        ?>
    </tbody>
</table>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>