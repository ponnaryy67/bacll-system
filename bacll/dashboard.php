<?php
session_start();
require_once 'db.php';

$error = '';

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // ឆែកមើលថាតើ Database បានតភ្ជាប់រួចរាល់ឬអត់
    if ($conn) {
        $stmt = $conn->prepare("SELECT id, username, password, created_at FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($user = $result->fetch_assoc()) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['joined_at'] = $user['created_at'];
                echo '<script>window.location.href = "dashboard.php";</script>';
                exit();
            }
        }
        $error = "Username ឬ Password មិនត្រឹមត្រូវទេ!";
    } else {
        // ករណីគ្មាន Database (ពេលอยู่លើ Render) ត្រូវកំណត់ user_id និង joined_at ទុកជា Demo ផង
        $_SESSION['user_id'] = 1;
        $_SESSION['username'] = !empty($username) ? $username : 'Demo User';
        $_SESSION['joined_at'] = date('Y-m-d');
        
        echo '<script>window.location.href = "dashboard.php";</script>';
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Login - BaC System</title>
    <style>
        body { font-family: Arial, sans-serif; background: #e9ecef; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .login-box { background: #ffc0cb; padding: 40px; border-radius: 6px; text-align: center; width: 350px; }
        .login-box h1 { margin-top: 0; font-size: 28px; }
        .login-box p { font-size: 18px; font-weight: bold; margin-bottom: 25px; }
        input { width: 90%; padding: 10px; margin: 6px 0; border: 1px solid #ccc; border-radius: 4px; text-align: center; font-style: italic; font-size: 16px; }
        .btn-group { margin-top: 15px; }
        .btn-group button { padding: 8px 22px; font-size: 16px; border: 1px solid #888; background: #e1e1e1; cursor: pointer; border-radius: 3px; margin: 0 4px; }
    </style>
</head>
<body>
    <div class="login-box">
        <h1>Form Login</h1>
        <p>Enter Username and Password</p>
        <?php if($error) echo "<p style='color:red;'>$error</p>"; ?>
        <form method="POST" action="">
            <input type="text" name="username" placeholder="username" required><br>
            <input type="password" name="password" placeholder="password" required><br>
            <div class="btn-group">
                <button type="submit" name="login">Login</button>
                <a href="register.php"><button type="button">Register</button></a>
            </div>
        </form>
    </div>
</body>
</html>
