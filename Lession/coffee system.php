<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Shop Billing System</title>
    <style>
        :root {
            --bg-color: #f4f1ea;
            --card-bg: #ffffff;
            --primary: #4a2c2a;
            --primary-hover: #361f1e;
            --accent: #d97706;
            --text-main: #2d2d2d;
            --text-muted: #6b7280;
            --border: #e5e7eb;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-main);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            background-color: var(--card-bg);
            width: 100%;
            max-width: 450px;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        }

        h1 {
            color: var(--primary);
            font-size: 1.5rem;
            margin-bottom: 24px;
            text-align: center;
            font-weight: 700;
        }

        .form-group {
            margin-bottom: 16px;
        }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: 6px;
            font-size: 0.9rem;
        }

        input[type="number"] {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid var(--border);
            border-radius: 6px;
            font-size: 1rem;
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
        }

        input[type="number"]:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(217, 119, 6, 0.15);
        }

        button {
            width: 100%;
            background-color: var(--primary);
            color: white;
            border: none;
            padding: 12px;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 6px;
            cursor: pointer;
            margin-top: 10px;
            transition: background-color 0.2s;
        }

        button:hover {
            background-color: var(--primary-hover);
        }

        .summary-card {
            margin-top: 24px;
            padding-top: 20px;
            border-top: 2px dashed var(--border);
        }

        .summary-card h2 {
            font-size: 1.1rem;
            color: var(--primary);
            margin-bottom: 12px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 0.95rem;
            color: var(--text-muted);
        }

        .summary-row.total {
            color: var(--text-main);
            font-weight: 700;
            font-size: 1.1rem;
            margin-top: 12px;
            padding-top: 10px;
            border-top: 1px solid var(--border);
        }
    </style>
</head>
<body>

    <div class="container">
        <h1> Coffee Shop Billing</h1>

        <form method="post">
            <div class="form-group">
                <label for="coffee">Coffee ($2.50)</label>
                <input type="number" name="coffee">
            </div>
            
            <div class="form-group">
                <label for="sandwich">Sandwich ($4.00)</label>
                <input type="number" name="sandwich">
            </div>
            
            <div class="form-group">
                <label for="cake">Cake ($3.00)</label>
                <input type="number" name="cake" >
            </div>

            <div class="form-group">
                <label for="discount">Discount (%)</label>
                <input type="number" id="discount" name="discount" step="any" min="0" max="100" placeholder="0" value="<?= isset($_POST['discount']) ? htmlspecialchars($_POST['discount']) : '' ?>">
            </div>

            <button type="submit" name="calculate">Calculate Total</button>
        </form>

        <?php
        function calculateSubtotal($coffee, $sandwich, $cake){
            return ($coffee * 2.50) + ($sandwich * 4.00) + ($cake * 3.00);
        }

        function calculateDiscount($subtotal, $discountPercent){
            return $subtotal * ($discountPercent / 100);
        }

        function calculateFinalTotal($subtotal, $discount){
            return $subtotal - $discount;
        }

        if (isset($_POST['calculate'])) {
            $coffee = isset($_POST['coffee']) ? (int)$_POST['coffee'] : 0;
            $sandwich = isset($_POST['sandwich']) ? (int)$_POST['sandwich'] : 0;
            $cake = isset($_POST['cake']) ? (int)$_POST['cake'] : 0;
            // Fixed key name match: replaced 'discount_rate' with 'discount'
            $discountRate = isset($_POST['discount']) ? (float)$_POST['discount'] : 0;

            $subtotal = calculateSubtotal($coffee, $sandwich, $cake);
            $discount = calculateDiscount($subtotal, $discountRate);
            $finalTotal = calculateFinalTotal($subtotal, $discount);
        ?>

        <div class="summary-card">
            <h2>Order Summary</h2>
            <div class="summary-row"><span>Coffee</span><span><?= $coffee ?></span></div>
            <div class="summary-row"><span>Sandwich</span><span><?= $sandwich ?></span></div>
            <div class="summary-row"><span>Cake</span><span><?= $cake ?></span></div>
            <div class="summary-row" style="margin-top: 8px;"><span>Subtotal</span><span>$<?= number_format($subtotal, 2) ?></span></div>
            <div class="summary-row"><span>Discount (<?= $discountRate ?>%)</span><span>-$<?= number_format($discount, 2) ?></span></div>
            <div class="summary-row total"><span>Final Total</span><span>$<?= number_format($finalTotal, 2) ?></span></div>
        </div>

        <?php } ?>
    </div>

</body>
</html>




