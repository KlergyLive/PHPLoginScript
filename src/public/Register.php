<?php
require '../config/database.php';
require '../utils/TokenManager.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!verifyCsrfToken($_POST['csrf_token'])) {
        die("Ungültiges CSRF-Token.");
    }

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirm_password']);

    if (empty($username) || empty($password) || empty($confirmPassword)) {
        echo "Alle Felder müssen ausgefüllt werden!";
        exit;
    }

    if (!preg_match('/^[a-zA-Z0-9_]{3,20}$/', $username)) {
        echo "Benutzername ungültig. Nur Buchstaben, Zahlen und Unterstriche erlaubt.";
        exit;
    }

    if (strlen($password) < 8) {
        echo "Passwort muss mindestens 8 Zeichen lang sein.";
        exit;
    }

    if ($password !== $confirmPassword) {
        echo "Passwörter stimmen nicht überein!";
        exit;
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->execute([$username, $hashedPassword]);
        echo "Registrierung erfolgreich! <a href='login.php'>Zum Login</a>";
    } catch (PDOException $e) {
        echo "Fehler bei der Registrierung: " . $e->getMessage();
    }
}

$csrfToken = generateCsrfToken();
?>

<form method="post">
    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken); ?>">
    <label>Benutzername:</label>
    <input type="text" name="username" required>
    <br>
    <label>Passwort:</label>
    <input type="password" name="password" required>
    <br>
    <label>Passwort bestätigen:</label>
    <input type="password" name="confirm_password" required>
    <br>
    <button type="submit">Registrieren</button>
</form>
