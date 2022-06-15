<?php
require '../connectDB.php';
$sql = "SELECT * FROM departement ORDER BY dep_name ASC";
$result = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($result, $sql)) {
    echo '<p class="error">SQL Error</p>';
} else {
    mysqli_stmt_execute($result);
    $resultl = mysqli_stmt_get_result($result);
    while ($row = mysqli_fetch_assoc($resultl)) {
?>
        <option value="<?php echo $row['id']; ?>"><?php echo $row['dep_name']; ?></option>
<?php
    }
}
?>