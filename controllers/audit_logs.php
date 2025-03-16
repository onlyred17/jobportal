<?php
include '../include/db_conn.php';

$sql = "SELECT * FROM audit_log ORDER BY created_at DESC";
$result = $conn->query($sql);

$audit_logs = [];
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $audit_logs[] = $row;
}
?>
