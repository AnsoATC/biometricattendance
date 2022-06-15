<?php
require '../connectDB.php';
$sql = "SELECT dev.device_name, COUNT(*) AS 'nbr' FROM devices AS dev, users AS u WHERE dev.device_uid=u.device_uid GROUP BY dev.device_uid";
$result = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($result, $sql)) {
    echo '<p>SQL Error</p>';
} else {
    mysqli_stmt_execute($result);
    $resultl = mysqli_stmt_get_result($result);
    $data = array();
    while ($row = mysqli_fetch_assoc($resultl)) {
        $data += [$row['device_name'] => $row['nbr']];
    }
    echo json_encode($data);
}
?>