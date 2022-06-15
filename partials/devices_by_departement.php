<?php
require '../connectDB.php';
$sql = "SELECT dep.dep_name, COUNT(*) AS 'nbr' FROM devices AS dev, departement AS dep WHERE dev.dep_id=dep.id GROUP BY dep.id";
$result = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($result, $sql)) {
    echo '<p>SQL Error</p>';
} else {
    mysqli_stmt_execute($result);
    $resultl = mysqli_stmt_get_result($result);
    $data = array();
    while ($row = mysqli_fetch_assoc($resultl)) {
        $data += [$row['dep_name'] => $row['nbr']];
    }
    echo json_encode($data);
}
?>