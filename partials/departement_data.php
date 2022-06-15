<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>Numéro</th>
            <th>Nom</th>
            <th>Date d'ajout</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Numéro</th>
            <th>Nom</th>
            <th>Date d'ajout</th>
            <th>Actions</th>
        </tr>
    </tfoot>
    <tbody>
        <?php
        //Connect to database
        require '../connectDB.php';

        $sql = "SELECT * FROM departement ORDER BY created_at";
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
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['dep_name']; ?></td>
                        <td><?php echo $row['created_at']; ?></td>
                        <td>
                            <div class="text-center">
                                <button type="button" title="Modifier" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".editModal" data-mode="edit" data-array="<?php echo $row['id'].','.$row['dep_name']; ?>"><i class="fas fa-fw fa-pencil-alt"></i></button>
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