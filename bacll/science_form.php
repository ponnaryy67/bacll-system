<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Science Class Track Form</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f6f9; padding: 40px; display: flex; justify-content: center; }
        .form-card { background: white; padding: 30px; border-radius: 8px; width: 400px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .form-card h2 { color: #2563eb; margin-top: 0; text-align: center; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], input[type="number"] { width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        .btn-submit { background: #2563eb; color: white; border: none; padding: 10px; width: 100%; border-radius: 4px; font-weight: bold; cursor: pointer; }
        .btn-back { display: block; text-align: center; margin-top: 15px; color: #6b7280; text-decoration: none; }
    </style>
</head>
<body>

    <div class="form-card">
        <h2>Science Class Track Form</h2>
        <form action="student_add.php" method="POST">
            <input type="hidden" name="track" value="Science Class Track">
            
            <div class="form-group">
                <label>Student Name (ឈ្មោះសិស្ស):</label>
                <input type="text" name="name" required placeholder="Enter student name">
            </div>

            <div class="form-group">
                <label>Math Score (គណិតវិទ្យា):</label>
                <input type="number" step="0.01" name="math" placeholder="0 - 100">
            </div>

            <div class="form-group">
                <label>Biology Score (ជីវវិទ្យា):</label>
                <input type="number" step="0.01" name="biology" placeholder="0 - 100">
            </div>

            <div class="form-group">
                <label>Chemistry Score (គីមីវិទ្យា):</label>
                <input type="number" step="0.01" name="chemistry" placeholder="0 - 100">
            </div>

            <div class="form-group">
                <label>Physics Score (រូបវិទ្យា):</label>
                <input type="number" step="0.01" name="physics" placeholder="0 - 100">
            </div>

             <div class="form-group">
                <label>Khmer (ខ្មែរវិទ្យា):</label>
                <input type="number" step="0.01" name="khmer" placeholder="0 - 100">
            </div>

             <div class="form-group">
                <label>History (ប្រវត្តិវិទ្យា):</label>
                <input type="number" step="0.01" name="history" placeholder="0 - 100">
            </div>

             <div class="form-group">
                <label>English (អង់គ្លេសវិទ្យា):</label>
                <input type="number" step="0.01" name="english" placeholder="0 - 100">
            </div>

            <button type="submit" class="btn-submit">Calculate / Save Data</button>
            <a href="dashboard.php" class="btn-back">← Back to Dashboard</a>
        </form>
    </div>

</body>
</html>



