<?php

// product
$products = [
    "Laptop" => 800,
    "Mouse"  => 25,
    "Keyboard" => 45,
    "Monitor" => 250,
    "Headphone" => 60
];

// Delevivery
$delivery_fees = [
    "Phnom Penh" => 2.00,
    "Province" => 4.00
];


// Initialize calculation variables

$order_processed = false;
$customer_name = "";
$phone = "";
$location = "";
$payment_method = "";
$quantities = [];
$subtotal = 0;
$discount = 0;
$delivery_fee = 0;
$final_amount = 0;


if($_SERVER["REQUEST_METHOD"] == "POST"){
    $customer_name = htmlspecialchars($_POST['customer_name'] ?? '');
    $phone         = htmlspecialchars($_POST['phone'] ?? '');
    $location      = $_POST['location'] ?? '';
    $payment_method = $_POST['payment_method'] ?? '';
    $quantities   = $_POST['quantities'] ?? [];

    // Calculate Subtotal
    foreach ($products as $item => $price){
        $qty = isset($quantities[$item]) ? max(0, intval($quantities[$item])) : 0;
        $subtotal += $price * $qty;

    }

    // Calculate Discount
    if ($subtotal >= 500){
        $discount = $subtotal * 0.10;
    }

    // Calculate Delivery Fee
    if (array_key_exists($location, $delivery_fees)){
        $delivery_fee = $delivery_fees[$location];
    }

    // Calculate Final Amount
    $final_amount = ($subtotal - $discount) + $delivery_fee;
    $order_processed = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Shopping Order Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 30px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
            color:lightcoral;
        }
        h2 {
            font-size: 18px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 8px;
            margin-top: 20px;
        }
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }
        .form-group {
            display: flex;
            flex-direction: column;
        }
        .form-group label {
            font-weight: bold;
            margin-bottom: 5px;
            font-size: 14px;
        }
        .form-group input, .form-group select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }
        th {
            background-color: #f8f8f8;
        }
        .qty-input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
        }
        .btn-submit {
            width: 100%;
            background-color:lightcoral;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
        }
        .btn-submit:hover {
            background-color: #555;
        }
        .invoice {
            margin-top: 30px;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 6px;
            border: 1px solid #e0e0e0;
        }
        .invoice-summary {
            margin-top: 15px;
            border-top: 2px dashed #ccc;
            padding-top: 10px;
        }
        .row-summary {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }
        .total {
            font-weight: bold;
            font-size: 18px;
            color: #d9534f;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Online Shopping Order Management System</h1>

    <form method="POST" action="">
        <h2>Customer Information</h2>
        <div class="form-grid">
            <div class="form-group">
                <label>Customer Name</label>
                <input type="text" name="customer_name" placeholder="Enter customer name" required>
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="phone" placeholder="Enter phone number" required>
            </div>
            <div class="form-group">
                <label>Delivery Location</label>
                <select name="location" required>
                    <option value="" disabled selected>Select location</option>
                    <option value="Phnom Penh">Phnom Penh ($2.00)</option>
                    <option value="Province">Province ($4.00)</option>
                </select>
            </div>
            <div class="form-group">
                <label>Payment Method</label>
                <select name="payment_method" required>
                    <option value="" disabled selected>Select payment</option>
                    <option value="ABA Pay">ABA Pay</option>
                    <option value="Cash on Delivery">Cash on Delivery</option>
                    <option value="Credit Card">Credit Card</option>
                </select>
            </div>
        </div>

        <h2>Select Products</h2>
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th style="width: 50%;">Quantity</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $name => $price): ?>
                <tr>
                    <td><?php echo $name; ?></td>
                    <td>$<?php echo number_format($price, 2); ?></td>
                    <td>
                        <input type="number" class="qty-input" name="quantities[<?php echo $name; ?>]" value="0" min="0">
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <button type="submit" class="btn-submit">Calculate Order</button>
    </form>

    <?php if ($order_processed): ?>
    <div class="invoice">
        <h2>Order Receipt</h2>
        <p><strong>Customer Name:</strong> <?php echo $customer_name; ?></p>
        <p><strong>Phone:</strong> <?php echo $phone; ?></p>
        <p><strong>Location:</strong> <?php echo $location; ?></p>
        <p><strong>Payment Method:</strong> <?php echo $payment_method; ?></p>

        <h3>Items Ordered</h3>
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $item => $price): ?>
                    <?php 
                    $qty = isset($quantities[$item]) ? intval($quantities[$item]) : 0;
                    if ($qty > 0): 
                    ?>
                    <tr>
                        <td><?php echo $item; ?></td>
                        <td><?php echo $qty; ?></td>
                        <td>$<?php echo number_format($price, 2); ?></td>
                        <td>$<?php echo number_format($price * $qty, 2); ?></td>
                    </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="invoice-summary">
            <div class="row-summary">
                <span>Subtotal:</span>
                <span>$<?php echo number_format($subtotal, 2); ?></span>
            </div>
            <div class="row-summary">
                <span>Discount:</span>
                <span>-$<?php echo number_format($discount, 2); ?></span>
            </div>
            <div class="row-summary">
                <span>Delivery Fee:</span>
                <span>+$<?php echo number_format($delivery_fee, 2); ?></span>
            </div>
            <div class="row-summary total">
                <span>Final Amount:</span>
                <span>$<?php echo number_format($final_amount, 2); ?></span>
            </div>
        </div>
    </div>
    <?php endif; ?>

</div>

</body>
</html>


