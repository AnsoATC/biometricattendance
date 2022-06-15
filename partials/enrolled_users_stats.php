<?php
require '../connectDB.php';
$sql = "SELECT add_fingerid, COUNT(*) AS 'nbr' FROM users GROUP BY add_fingerid";
$result = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($result, $sql)) {
    echo '<p>SQL Error</p>';
} else {
    mysqli_stmt_execute($result);
    $resultl = mysqli_stmt_get_result($result);
    $data = array();
    while ($row = mysqli_fetch_assoc($resultl)) {
        $data += [$row['add_fingerid'] => $row['nbr']];
    }
    echo json_encode($data);
}
?>