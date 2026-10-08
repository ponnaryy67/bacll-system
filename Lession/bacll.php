<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$result = null;

function getGrade($percentage) {
    if ($percentage >= 90) return ["grade" => "A", "khmer" => "និទ្ទេស A (ល្អប្រសើរ)", "color" => "#28a745"];
    if ($percentage >= 80) return ["grade" => "B", "khmer" => "និទ្ទេស B (ល្អណាស់)", "color" => "#17a2b8"];
    if ($percentage >= 70) return ["grade" => "C", "khmer" => "និទ្ទេស C (ល្អ)", "color" => "#007bff"];
    if ($percentage >= 60) return ["grade" => "D", "khmer" => "និទ្ទេស D (បង្គួរ)", "color" => "#ffc107"];
    if ($percentage >= 50) return ["grade" => "E", "khmer" => "និទ្ទេស E (មធ្យម)", "color" => "#fd7e14"];
    return ["grade" => "F", "khmer" => "និទ្ទេស F (ធ្លាក់)", "color" => "#dc3545"];
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['calculate'])) {
    $studentName = trim($_POST['student_name']);
    $phone = trim($_POST['phone']);

   
    $subjects = [
        "Khmer"     => (float)$_POST['khmer'],
        "Math"      => (float)$_POST['math'],
        "English"   => (float)$_POST['english'],
        "History"   => (float)$_POST['history'],
        "Physics"   => (float)$_POST['physics'],
        "Chemistry" => (float)$_POST['chemistry'],
        "Biology"   => (float)$_POST['biology']
    ];

    $totalScore = array_sum($subjects);
    $maxScore = 700; // 7 subjects * 100 max points each
    $percentage = ($totalScore / $maxScore) * 100;
    $overallGrade = getGrade($percentage);

    $result = [
        "name" => $studentName,
        "phone" => $phone,
        "subjects" => $subjects,
        "total" => $totalScore,
        "maxScore" => $maxScore,
        "percentage" => $percentage,
        "overallGrade" => $overallGrade
    ];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BacII Student Grade Management</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        body {
            background-color: #eef2f5;
            padding: 40px 20px;
            margin: 0;
        }
        .main-card {
            background: #ffffff;
            max-width: 800px;
            margin: 0 auto;
            padding: 35px 40px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }
        .title {
            color: #e57373;
            text-align: center;
            font-size: 28px;
            font-weight: bold;
            margin-top: 0;
            margin-bottom: 25px;
        }
        .section-title {
            font-size: 16px;
            font-weight: bold;
            color: #222;
            margin-bottom: 15px;
            padding-bottom: 5px;
        }
        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px 20px;
            margin-bottom: 25px;
        }
        .form-group {
            display: flex;
            flex-direction: column;
        }
        .form-group label {
            font-size: 13px;
            font-weight: bold;
            color: #222;
            margin-bottom: 6px;
        }
        .form-group input {
            padding: 10px 12px;
            border: 1px solid #dcdcdc;
            border-radius: 6px;
            font-size: 14px;
            outline: none;
            color: #555;
            background-color: #fff;
        }
        .form-group input:focus {
            border-color: #e57373;
        }
        
        /* Table Layout */
        .subjects-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }
        .subjects-table th {
            background-color: #f8f9fa;
            text-align: left;
            padding: 12px 15px;
            font-size: 13px;
            font-weight: bold;
            color: #222;
            border-top: 1px solid #eee;
            border-bottom: 1px solid #eee;
        }
        .subjects-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
            font-size: 14px;
            color: #333;
        }
        .subjects-table input {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #dcdcdc;
            border-radius: 6px;
            font-size: 14px;
            outline: none;
        }

        .btn-calculate {
            width: 100%;
            background-color: #f07878;
            color: white;
            border: none;
            padding: 14px;
            border-radius: 6px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.2s;
        }
        .btn-calculate:hover {
            background-color: #e06666;
        }

        /* Result Output Section */
        .result-box {
            margin-top: 35px;
            padding-top: 25px;
            border-top: 2px dashed #ddd;
        }
        .result-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #fdf2f2;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .grade-badge {
            padding: 6px 16px;
            border-radius: 20px;
            color: white;
            font-weight: bold;
            font-size: 15px;
        }
    </style>
</head>
<body>

    <div class="main-card">
        <h1 class="title">BacII Student Grade Management</h1>

        <form method="POST">
            <!-- Student Information -->
            <div class="section-title">Student Information</div>
            <div class="grid-2">
                <div class="form-group">
                    <label>Student Name</label>
                    <input type="text" name="student_name" placeholder="Enter student name" required>
                </div>
                <div class="form-group">
                    <label>ID</label>
                    <input type="text" name="phone" placeholder="Enter your id " required>
                </div>
            </div>

            <!-- Subject Scores Table -->
            <div class="section-title">Enter Subject Scores</div>
            <table class="subjects-table">
                <thead>
                    <tr>
                        <th style="width: 50%;">Subject</th>
                        <th style="width: 50%;">Score Obtained</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Khmer</td>
                        <td><input type="number" step="0.1" name="khmer" min="0" max="100" placeholder="0" required></td>
                    </tr>
                    <tr>
                        <td>Math</td>
                        <td><input type="number" step="0.1" name="math" min="0" max="100" placeholder="0" required></td>
                    </tr>
                    <tr>
                        <td>English</td>
                        <td><input type="number" step="0.1" name="english" min="0" max="100" placeholder="0" required></td>
                    </tr>
                    <tr>
                        <td>History</td>
                        <td><input type="number" step="0.1" name="history" min="0" max="100" placeholder="0" required></td>
                    </tr>
                    <tr>
                        <td>Physics</td>
                        <td><input type="number" step="0.1" name="physics" min="0" max="100" placeholder="0" required></td>
                    </tr>
                    <tr>
                        <td>Chemistry</td>
                        <td><input type="number" step="0.1" name="chemistry" min="0" max="100" placeholder="0" required></td>
                    </tr>
                    <tr>
                        <td>Biology</td>
                        <td><input type="number" step="0.1" name="biology" min="0" max="100" placeholder="0" required></td>
                    </tr>
                </tbody>
            </table>

            <button type="submit" name="calculate" class="btn-calculate">Calculate Grade</button>
        </form>

        <!-- Display Result After Submit -->
        <?php if ($result): ?>
            <div class="result-box">
                <div class="section-title">Student BacII Result</div>
                
                <div class="result-header">
                    <div>
                        <strong style="font-size: 18px; color: #222;"><?php echo htmlspecialchars($result['name']); ?></strong>
                        <div style="font-size: 13px; color: #666; margin-top: 4px;">ID: <?php echo htmlspecialchars($result['id']); ?></div>
                    </div>
                    <div>
                        <span class="grade-badge" style="background-color: <?php echo $result['overallGrade']['color']; ?>;">
                            <?php echo $result['overallGrade']['khmer']; ?>
                        </span>
                    </div>
                </div>

                <table class="subjects-table">
                    <thead>
                        <tr>
                            <th>Subject</th>
                            <th style="text-align: right;">Score</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($result['subjects'] as $subject => $score): ?>
                            <tr>
                                <td><?php echo $subject; ?></td>
                                <td style="text-align: right; font-weight: bold;"><?php echo $score; ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <tr style="background-color: #fafafa;">
                            <td><strong>Total Score</strong></td>
                            <td style="text-align: right; font-weight: bold; color: #e57373; font-size: 16px;"><?php echo $result['total']; ?> / <?php echo $result['maxScore']; ?></td>
                        </tr>
                        <tr style="background-color: #fafafa;">
                            <td><strong>Percentage</strong></td>
                            <td style="text-align: right; font-weight: bold; font-size: 16px;"><?php echo number_format($result['percentage'], 2); ?>%</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>

    </div>

</body>
</html>


