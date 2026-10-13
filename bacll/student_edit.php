<?php
session_start();
require_once 'db.php';

$id = $_GET['id'] ?? 1;
$student = ['name' => '', 'email' => '', 'track' => 'Science Class Track'];

// ស្វែងរកទិន្នន័យសិស្សចាស់ដើម្បីយកមកបង្ហាញក្នុង Form
if ($conn) {
    $stmt = $conn->prepare("SELECT * FROM students WHERE id = ?");
    if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $student = $row;
        }
        $stmt->close();
    }
} else {
    if (isset($_SESSION['demo_students'])) {
        foreach ($_SESSION['demo_students'] as $s) {
            if ($s['id'] == $id) {
                $student = $s;
                break;
            }
        }
    }
}

// ពេលចុច Update ទិន្នន័យ
if (isset($_POST['update'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $track = $_POST['track'];

    if ($conn) {
        $stmt = $conn->prepare("UPDATE students SET name = ?, email = ?, track = ? WHERE id = ?");
        if ($stmt) {
            $stmt->bind_param("sssi", $name, $email, $track, $id);
            $stmt->execute();
            $stmt->close();
        }
    } else {
        if (isset($_SESSION['demo_students'])) {
            foreach ($_SESSION['demo_students'] as &$s) {
                if ($s['id'] == $id) {
                    $s['name'] = $name;
                    $s['email'] = $email;
                    $s['track'] = $track;
                    break;
                }
            }
        }
    }

    echo '<script>window.location.href = "student_list.php";</script>';
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #f9fafb; display: flex; justify-content: center; align-items: center; height: 80vh; }
        .form-card { background: white; padding: 25px; border-radius: 8px; width: 320px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        h2 { margin-top: 0; color: #1f2937; text-align: center; }
        label { display: block; margin-top: 10px; font-weight: bold; color: #374151; }
        input, select { width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #d1d5db; border-radius: 4px; box-sizing: border-box; }
        button { background: #f59e0b; color: white; border: none; padding: 10px 15px; margin-top: 15px; width: 100%; border-radius: 4px; font-weight: bold; cursor: pointer; }
        button:hover { background: #d97706; }
    </style>
</head>
<body>
    <div class="form-card">
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
    </div>
</body>
</html>

