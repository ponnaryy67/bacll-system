<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $track = $_POST['track'];

    if (!empty($name) && !empty($email) && !empty($track)) {
        $stmt = $conn->prepare("INSERT INTO students (name, email, track) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $track);
        
        if ($stmt->execute()) {
            $stmt->close();
           
            header("Location: student_list.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Student</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #f9fafb; }
        .form-card { background: white; padding: 25px; border-radius: 8px; width: 320px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        h2 { margin-top: 0; color: #1f2937; }
        label { display: block; margin-top: 10px; font-weight: bold; color: #374151; }
        input, select { width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #d1d5db; border-radius: 4px; box-sizing: border-box; }
        button { background: #10b981; color: white; border: none; padding: 10px 15px; margin-top: 15px; width: 100%; border-radius: 4px; font-weight: bold; cursor: pointer; }
        button:hover { background: #059669; }
    </style>
</head>
<body>

    <div class="form-card">
        <h2>Add New Student</h2>
   
        <form action="student_add.php" method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required placeholder="Enter student name">
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required placeholder="Enter student email">
            
            <label for="track">Track:</label>
            <select id="track" name="track">
                <option value="Science Class Track">Science Class Track</option>
                <option value="Social Class Track">Social Class Track</option>
            </select>
            
            <button type="submit" name="save">Save Student</button>
        </form>
    </div>

</body>
</html>



