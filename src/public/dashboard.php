<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

echo "Willkommen, " . htmlspecialchars($_SESSION['username']) . "! <a href='logout.php'>Abmelden</a>";
?>
