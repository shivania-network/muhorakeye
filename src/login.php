<?php
// src/login.php
session_start();
require __DIR__ . '/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare("SELECT user_id, user_password, user_firstname FROM tbl_users WHERE user_email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['user_password'])) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['user_firstname'] = $user['user_firstname'];
        header("Location: dashboard.php");
        exit;
    } else {
        $msg = "Invalid credentials.";
    }
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Login - ShareRide</title></head>
<body>
  <h1>Login</h1>
  <?php if (!empty($msg)) echo "<p>$msg</p>"; ?>
  <form method="post">
    <label>Email: <input name="email" type="email" required/></label><br/>
    <label>Password: <input name="password" type="password" required/></label><br/>
    <button type="submit">Login</button>
  </form>
  <p><a href="index.php">Back</a></p>
</body>
</html>
