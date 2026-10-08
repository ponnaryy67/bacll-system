<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electricity Bill Calculator</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        body {
            background-color: #f4f7f6;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .container {
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #666;
            font-weight: 600;
        }
        .form-group input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
            outline: none;
            transition: border-color 0.2s;
        }
        .form-group input:focus {
            border-color: #007bff;
        }
        button {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            border: none;
            color: white;
            font-size: 16px;
            font-weight: bold;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        button:hover {
            background-color: #0056b3;
        }
        .result-card {
            margin-top: 25px;
            padding: 15px;
            background-color: #eef6ff;
            border-left: 4px solid #007bff;
            border-radius: 6px;
        }
        .result-card h3 {
            margin-top: 0;
            color: #007bff;
            font-size: 18px;
            border-bottom: 1px solid #d0e3ff;
            padding-bottom: 8px;
        }
        .result-item {
            margin: 8px 0;
            color: #444;
            font-size: 15px;
        }
        .result-item.total {
            font-weight: bold;
            color: #d9534f;
            font-size: 16px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Electricity Calculator</h2>

    <form method="POST" action="">
        <div class="form-group">
            <label>Customer Name</label>
            <input type="text" name="name" placeholder="Enter name" required>
        </div>
        
        <div class="form-group">
            <label>Customer Location</label>
            <input type="text" name="location" placeholder="Enter location" required>
        </div>
        
        <div class="form-group">
            <label>Consumption (kWh)</label>
            <input type="number" name="kwh" placeholder="Enter total kWh" min="0" step="any" required>
        </div>
        
        <button type="submit" name="submit">Calculate Total</button> 
    </form>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name     = htmlspecialchars($_POST['name']);
            $location = htmlspecialchars($_POST['location']);
            $kwh      = (float)$_POST['kwh'];

            $price = 0;

            if ($kwh >= 200) {
                $price = 730;
            } else if ($kwh >= 50) {
                $price = 680;
            } else if ($kwh >= 30) {
                $price = 650;
            }

            $Total = $kwh * $price;

            echo '
            <div class="result-card">
                <h3>Customer Payment</h3>
                <div class="result-item"><strong>Name:</strong> ' . $name . '</div>
                <div class="result-item"><strong>Location:</strong> ' . $location . '</div>
                <div class="result-item"><strong>Usage:</strong> ' . $kwh . ' kWh</div>
                <div class="result-item"><strong>Rate:</strong> ' . $price . ' ៛/kWh</div>
                <div class="result-item total"><strong>Total:</strong> ' . number_format($Total) . ' ៛</div>
            </div>
            ';
        }
    ?>
</div>

</body>
</html>


