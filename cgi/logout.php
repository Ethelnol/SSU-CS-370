<?php
    session_start();
    session_destroy();
    $timeout = isset($_GET['timeout']) ? '?timeout=1' : '';
    header("Location: index.php" . $timeout);
    return;
?>
