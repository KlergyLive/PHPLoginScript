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

    if (empty($username) || empty($password)) {
        echo "Alle Felder müssen ausgefüllt werden!";
        exit;
    }

    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            session_regenerate_id(true);
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            echo "Login erfolgreich! <a href='dashboard.php'>Zum Dashboard</a>";
        } else {
            echo "Ungültiger Benutzername oder Passwort!";
        }
    } catch (PDOException $e) {
        echo "Fehler beim Login: " . $e->getMessage();
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
    <button type="submit">Login</button>
</form>
