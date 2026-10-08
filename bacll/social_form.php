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
    <title>Social Class Track Form</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f6f9; padding: 40px; display: flex; justify-content: center; }
        .form-card { background: white; padding: 30px; border-radius: 8px; width: 400px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .form-card h2 { color: #d97706; margin-top: 0; text-align: center; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], input[type="number"] { width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        .btn-submit { background: #d97706; color: white; border: none; padding: 10px; width: 100%; border-radius: 4px; font-weight: bold; cursor: pointer; }
        .btn-submit:hover { background: #b45309; }
        .btn-back { display: block; text-align: center; margin-top: 15px; color: #6b7280; text-decoration: none; }
    </style>
</head>
<body>

    <div class="form-card">
        <h2>Social Class Track Form</h2>
        <form action="student_add.php" method="POST">
            <input type="hidden" name="track" value="Social Class Track">
            
            <div class="form-group">
                <label>Student Name (ឈ្មោះសិស្ស):</label>
                <input type="text" name="name" required placeholder="Enter student name">
            </div>

            <div class="form-group">
                <label>Khmer (អក្សរសាស្ត្រខ្មែរ):</label>
                <input type="number" step="0.01" name="khmer" placeholder="0 - 100">
            </div>

            <div class="form-group">
                <label>History  (ប្រវត្តិវិទ្យា):</label>
                <input type="number" step="0.01" name="history" placeholder="0 - 100">
            </div>

            <div class="form-group">
                <label>Geography (ភូមិវិទ្យា):</label>
                <input type="number" step="0.01" name="geography" placeholder="0 - 100">
            </div>

            <div class="form-group">
                <label>Civics (ពលរដ្ឋវិទ្យា):</label>
                <input type="number" step="0.01" name="civics" placeholder="0 - 100">
            </div>

             <div class="form-group">
                <label>Earth (ផែនដីវិទ្យា):</label>
                <input type="number" step="0.01" name="civics" placeholder="0 - 100">
            </div>

             <div class="form-group">
                <label>Ethics (សីលធម៍វិទ្យា):</label>
                <input type="number" step="0.01" name="civics" placeholder="0 - 100">
            </div>

             <div class="form-group">
                <label>English (អង់គ្លេសវិទ្យា):</label>
                <input type="number" step="0.01" name="civics" placeholder="0 - 100">
            </div>

            <button type="submit" class="btn-submit">Calculate / Save Data</button>
            <a href="dashboard.php" class="btn-back">← Back to Dashboard</a>
        </form>
    </div>

</body>
</html>


