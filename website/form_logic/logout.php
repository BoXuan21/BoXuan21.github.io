<?php

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION['user_id'])) {
    session_destroy();
    echo "<script>location.href='../index.php'</script>";
    exit();
}
