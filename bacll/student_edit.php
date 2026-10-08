<?php
session_start();
require_once 'db.php';

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM students WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$student = $stmt->get_result()->fetch_assoc();

if (isset($_POST['update'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $track = $_POST['track'];

    $stmt = $conn->prepare("UPDATE students SET name = ?, email = ?, track = ? WHERE id = ?");
    $stmt->bind_param("sssi", $name, $email, $track, $id);
    $stmt->execute();

    header("Location: student_list.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        form { width: 300px; }
        input, select { width: 100%; padding: 8px; margin: 8px 0; }
        button { background: #f59e0b; color: white; border: none; padding: 10px 15px; cursor: pointer; }
    </style>
</head>
<body>
    <h2>Edit Student Information</h2>
    <form method="POST">
        <label>Name:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($student['name']); ?>" required>
        
        <label>Email:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($student['email']); ?>" required>
        
        <label>Track:</label>
        <select name="track">
            <option value="Science Class Track" <?= $student['track'] == 'Science Class Track' ? 'selected' : ''; ?>>Science Class Track</option>
            <option value="Social Class Track" <?= $student['track'] == 'Social Class Track' ? 'selected' : ''; ?>>Social Class Track</option>
        </select>
        
        <button type="submit" name="update">Update Student</button>
    </form>
</body>
</html>


