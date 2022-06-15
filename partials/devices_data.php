<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>N.dispositif</th>
            <th>Département</th>
            <th>UID</th>
            <th>Mode</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>N.dispositif</th>
            <th>Département</th>
            <th>UID</th>
            <th>Mode</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
    </tfoot>
    <tbody>
        <?php
        require '../connectDB.php';
        $sql = "SELECT dev.id, dev.device_name, dev.dep_id, dep.dep_name, dev.device_uid, dev.device_date, dev.device_mode FROM devices AS dev, departement AS dep WHERE dev.dep_id=dep.id ORDER BY id DESC";
        $result = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($result, $sql)) {
            echo '<p class="error">SQL Error</p>';
        } else {
            mysqli_stmt_execute($result);
            $resultl = mysqli_stmt_get_result($result);
            echo '<form action="" method="POST" enctype="multipart/form-data">';
            while ($row = mysqli_fetch_assoc($resultl)) {

                $radio1 = ($row["device_mode"] == 0) ? "checked" : "";
                $radio2 = ($row["device_mode"] == 1) ? "checked" : "";

                $de_mode = '<div class="mode_select">
					      	<input type="radio" id="' . $row["id"] . '-one" name="' . $row["id"] . '" class="mode_sel" data-toggle="modal" data-target=".modeModal" data-id="' . $row["id"] . '" data-mode="0" value="0" ' . $radio1 . '/>
					                    <label for="' . $row["id"] . '-one">Enrollment</label>
		                    <input type="radio" id="' . $row["id"] . '-two" name="' . $row["id"] . '" class="mode_sel" data-toggle="modal" data-target=".modeModal" data-id="' . $row["id"] . '" data-mode="1" value="1" ' . $radio2 . '/>
					                    <label for="' . $row["id"] . '-two">Attendance</label>
					                    </div>';

                echo '<tr>
							        <td>' . $row["device_name"] . '</td>
							        <td>' . $row["dep_name"] . '</td>
							        <td><button type="button" class="dev_uid_up btn btn-sm btn-warning" id="del_' . $row["id"] . '" data-toggle="modal" data-target=".refreshModal" data-id="' . $row["id"] . '" title="Mettre à jours le token"><span class="fas fa-fw fa-sync"> </span></button>
							        	' . $row["device_uid"] . '
							        </td>
							        <td>' . $de_mode . '</td>
                                    <td>' . $row["device_date"] . '</td>
							        <td>
                                        <div class="text-center">
                                            <button type="button" title="Modifier" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".editModal" data-mode="edit" data-array="'.$row['id'].','.$row['dep_id'].','.$row['device_name'].'"><i class="fas fa-fw fa-pencil-alt"></i></button>
                                        </div>
								    </td>
							      </tr>';
            }
            echo '</form>';
        }
        ?>
    </tbody>
</table>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>