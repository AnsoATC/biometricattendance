<?php
$dep_sel = $_POST['dep_sel'];
require '../connectDB.php';
$sql = "SELECT * FROM devices WHERE dep_id=? ORDER BY device_name ASC";
$result = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($result, $sql)) {
    echo '<p>SQL Error</p>';
} else {
    mysqli_stmt_bind_param($result, "s", $dep_sel);
    mysqli_stmt_execute($result);
    $resultl = mysqli_stmt_get_result($result);
    while ($row = mysqli_fetch_assoc($resultl)) {
?>
        <option value="<?php echo $row['device_uid']; ?>"><?php echo $row['device_name']; ?></option>
<?php
    }
}
?>