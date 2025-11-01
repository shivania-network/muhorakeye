<?php
// src/registration.php
// Simple registration form (POST to same file)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require __DIR__ . '/db.php'; // db connection
    $firstname = $_POST['firstname'] ?? '';
    $lastname  = $_POST['lastname'] ?? '';
    $gender    = $_POST['gender'] ?? '';
    $email     = $_POST['email'] ?? '';
    $password  = $_POST['password'] ?? '';

    if ($email && $password) {
        // hash password
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO tbl_users (user_firstname, user_lastname, user_gender, user_email, user_password) VALUES (?, ?, ?, ?, ?)");
        if ($stmt->execute([$firstname, $lastname, $gender, $email, $hash])) {
            $msg = "Registration successful. You can <a href='login.php'>login</a>.";
        } else {
            $msg = "Registration failed.";
        }
    } else {
        $msg = "Please fill email and password.";
    }
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Register - ShareRide</title></head>
<body>
  <h1>Register</h1>
  <?php if (!empty($msg)) echo "<p>$msg</p>"; ?>
  <form method="post">
    <label>First name: <input name="firstname" /></label><br/>
    <label>Last name: <input name="lastname" /></label><br/>
    <label>Gender: <input name="gender" /></label><br/>
    <label>Email: <input name="email" type="email" required/></label><br/>
    <label>Password: <input name="password" type="password" required/></label><br/>
    <button type="submit">Register</button>
  </form>
  <p><a href="index.php">Back</a></p>
</body>
</html>
