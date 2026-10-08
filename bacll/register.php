<?php
session_start();
require_once 'db.php';

$message = '';

if (isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $raw_password = $_POST['password'];

    if (empty($username) || empty($raw_password)) {
        $message = "សូមបញ្ចូល Username និង Password!";
    } else {
        // 1. Check if the username already exists
        $check_stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $check_stmt->bind_param("s", $username);
        $check_stmt->execute();
        $check_stmt->store_result();

        if ($check_stmt->num_rows > 0) {
            $message = "Username នេះមានរួចហើយ!";
        } else {
            // 2. Hash password and insert user
            $password = password_hash($raw_password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $password);

            if ($stmt->execute()) {
                $stmt->close();
                $check_stmt->close();
                header("Location: login.php");
                exit();
            } else {
                $message = "មានបញ្ហាក្នុងការចុះឈ្មោះ! សូមព្យាយាមម្តងទៀត។";
            }
            $stmt->close();
        }
        $check_stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <title>Register - BaC System</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f0f2f5; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .card { background: #ffc0cb; padding: 30px; border-radius: 8px; text-align: center; width: 320px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        input { width: 90%; padding: 10px; margin: 8px 0; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { padding: 10px 20px; margin: 5px; border: 1px solid #ccc; border-radius: 4px; background: #fff; cursor: pointer; }
    </style>
</head>
<body>
    <div class="card">
        <h2>Form Register</h2>
        <p>Enter Username and Password</p>
        <?php if(!empty($message)): ?>
            <p style="color: red;"><?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <input type="text" name="username" placeholder="username" required><br>
            <input type="password" name="password" placeholder="password" required><br>
            <button type="submit" name="register">Register</button>
            <a href="login.php"><button type="button">Back to Login</button></a>
        </form>
    </div>
</body>
</html>



