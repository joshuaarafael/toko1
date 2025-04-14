<?php
session_start();

if (isset($_POST['action']) && $_POST['action'] == 'logout') {
    session_unset();
    session_destroy();
    echo json_encode(['status' => 'success', 'message' => 'Anda berhasil logout.']);
    exit;
}

header('Location: login.php');
exit;
?>
