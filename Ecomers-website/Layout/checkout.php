<!-- <?php
// ការពារកុំឲ្យមាន session_start() ជាន់គ្នា
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ប្រសិនបើកន្ត្រកទទេ ឲ្យត្រឡប់ទៅទំព័រដើម
if (empty($_SESSION['cart'])) {
    header('Location: index.php');
    exit;
}

// គណនាតម្លៃសរុប
$subtotal = 0;
foreach ($_SESSION['cart'] as $item) {
    $qty = (int)($item['quantity'] ?? 1);
    $price = (float)($item['price'] ?? 0);
    $subtotal += ($price * $qty);
}
$shipping = 0.00;
$grandTotal = $subtotal + $shipping;
?>

<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <style>
        * { box-sizing: border-box; font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; }
        body { background-color: #f8fafc; color: #0f172a; margin: 0; padding: 0; }
        .checkout-wrapper { max-width: 1140px; margin: 40px auto; padding: 0 20px; }
        .checkout-header { margin-bottom: 30px; }
        .checkout-title { font-size: 32px; font-weight: 700; margin: 0 0 6px 0; color: #0f172a; }
        .checkout-subtitle { color: #64748b; font-size: 15px; margin: 0; }
        .checkout-grid { display: grid; grid-template-columns: 1fr 420px; gap: 32px; align-items: start; }
        
        .card { background: #ffffff; border-radius: 16px; padding: 28px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05); margin-bottom: 24px; border: 1px solid #f1f5f9; }
        .card-header { display: flex; align-items: center; gap: 12px; margin-bottom: 24px; }
        .card-icon { width: 36px; height: 36px; background: #f1f5f9; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px; color: #618281; }
        .card-title { font-size: 18px; font-weight: 700; margin: 0; color: #0f172a; }

        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        .form-group { margin-bottom: 18px; }
        .form-group.full-width { grid-column: span 2; }
        .form-group label { display: block; font-size: 13px; font-weight: 600; margin-bottom: 8px; color: #334155; }
        .form-group input, .form-group textarea { width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 10px; background: #ffffff; font-size: 14px; color: #0f172a; outline: none; }
        .form-group input:focus, .form-group textarea:focus { border-color: #618281; }

        .payment-list { display: flex; flex-direction: column; gap: 12px; }
        .payment-option { border: 1.5px solid #e2e8f0; padding: 16px; border-radius: 12px; display: flex; align-items: center; gap: 14px; cursor: pointer; }
        .payment-option.active { border-color: #618281; background: #f0fdf4; }
        .payment-option input[type="radio"] { accent-color: #618281; width: 18px; height: 18px; }

        .order-items { max-height: 320px; overflow-y: auto; padding-right: 4px; margin-bottom: 20px; }
        .summary-item { display: flex; align-items: center; gap: 14px; margin-bottom: 16px; padding-bottom: 16px; border-bottom: 1px solid #f1f5f9; }
        .summary-item img { width: 60px; height: 60px; border-radius: 10px; object-fit: cover; background: #f8fafc; }
        .summary-item-details { flex: 1; }
        .summary-item-name { font-size: 14px; font-weight: 600; color: #0f172a; margin-bottom: 4px; }
        .summary-item-meta { font-size: 12px; color: #64748b; }
        .summary-item-price { font-weight: 700; font-size: 14px; color: #0f172a; }

        .calc-row { display: flex; justify-content: space-between; font-size: 14px; color: #64748b; margin-bottom: 10px; }
        .calc-divider { border: none; border-top: 1px solid #e2e8f0; margin: 16px 0; }
        .calc-total { display: flex; justify-content: space-between; font-size: 20px; font-weight: 700; color: #0f172a; margin-bottom: 24px; }
        .calc-total span:last-child { color: #059669; }

        .btn-submit { width: 100%; padding: 16px; background: #618281; color: #ffffff; border: none; border-radius: 12px; font-size: 16px; font-weight: 700; cursor: pointer; }
        .btn-submit:hover { background: #4d6968; }

        @media (max-width: 900px) { .checkout-grid { grid-template-columns: 1fr; } .form-grid { grid-template-columns: 1fr; } .form-group.full-width { grid-column: span 1; } }
    </style>
</head>
<body>

    <!-- INCLUDE HEADER -->
    <!-- <?php include 'header.php'; ?>

    <div class="checkout-wrapper">
        <div class="checkout-header">
            <h1 class="checkout-title">Checkout</h1>
            <p class="checkout-subtitle">Please fill in your details to complete your order.</p>
        </div>

        <form action="process_order.php" method="POST">
            <div class="checkout-grid">
                
                <!-- LEFT COLUMN -->
                <div class="left-column">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-icon">👤</div>
                            <h2 class="card-title">Delivery Information</h2>
                        </div>
                        <div class="form-grid">
                            <div class="form-group full-width">
                                <label for="full_name">Full Name *</label>
                                <input type="text" id="full_name" name="full_name" placeholder="Enter your full name" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone Number *</label>
                                <input type="tel" id="phone" name="phone" placeholder="e.g. 012 345 678" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address (Optional)</label>
                                <input type="email" id="email" name="email" placeholder="name@example.com">
                            </div>
                            <div class="form-group full-width">
                                <label for="address">Delivery Address *</label>
                                <textarea id="address" name="address" rows="3" placeholder="Street address, House number, Khan/Sangkat..." required></textarea>
                            </div>
                            <div class="form-group full-width">
                                <label for="notes">Order Notes (Optional)</label>
                                <input type="text" id="notes" name="notes" placeholder="Notes about your order...">
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <div class="card-icon">💳</div>
                            <h2 class="card-title">Payment Method</h2>
                        </div>
                        <div class="payment-list">
                            <label class="payment-option active" id="option-cod">
                                <input type="radio" name="payment_method" value="cod" checked onclick="selectPayment('cod')">
                                <div>
                                    <div style="font-weight:600; font-size:14px;">Cash on Delivery (COD)</div>
                                    <div style="font-size:12px; color:#64748b;">Pay with cash when your items arrive.</div>
                                </div>
                            </label>
                            <label class="payment-option" id="option-bank">
                                <input type="radio" name="payment_method" value="bank" onclick="selectPayment('bank')">
                                <div>
                                    <div style="font-weight:600; font-size:14px;">Bank Transfer</div>
                                    <div style="font-size:12px; color:#64748b;">Transfer directly to our ABA or Wing account.</div>
                                </div>
                            </label>
                            <label class="payment-option" id="option-qr">
                                <input type="radio" name="payment_method" value="qr" onclick="selectPayment('qr')">
                                <div>
                                    <div style="font-weight:600; font-size:14px;">KHQR Payment</div>
                                    <div style="font-size:12px; color:#64748b;">Scan QR code using any Cambodian mobile banking app.</div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- RIGHT COLUMN -->
                <div class="right-column">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-icon">🛍️</div>
                            <h2 class="card-title">Order Summary</h2>
                        </div>

                        <div class="order-items">
                            <?php foreach ($_SESSION['cart'] as $item): 
                                $itemQty = max(1, (int)($item['quantity'] ?? 1));
                                $itemPrice = max(0, (float)($item['price'] ?? 0));
                                $itemSubtotal = $itemPrice * $itemQty;
                            ?>
                                <div class="summary-item">
                                    <img src="<?php echo htmlspecialchars($item['image'] ?? 'placeholder.jpg'); ?>" alt="Product">
                                    <div class="summary-item-details">
                                        <div class="summary-item-name"><?php echo htmlspecialchars($item['name'] ?? 'Product'); ?></div>
                                        <div class="summary-item-meta">Qty: <?php echo $itemQty; ?> × $<?php echo number_format($itemPrice, 2); ?></div>
                                    </div>
                                    <div class="summary-item-price">$<?php echo number_format($itemSubtotal, 2); ?></div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="calc-row">
                            <span>Subtotal</span>
                            <span>$<?php echo number_format($subtotal, 2); ?></span>
                        </div>
                        <div class="calc-row">
                            <span>Delivery Fee</span>
                            <span><?php echo $shipping > 0 ? '$' . number_format($shipping, 2) : 'Free'; ?></span>
                        </div>

                        <hr class="calc-divider">

                        <div class="calc-total">
                            <span>Total Amount</span>
                            <span>$<?php echo number_format($grandTotal, 2); ?></span>
                        </div>

                        <button type="submit" class="btn-submit">
                            Place Order ($<?php echo number_format($grandTotal, 2); ?>)
                        </button>
                    </div>
                </div>

            </div>
        </form>
    </div>

    <script>
        function selectPayment(type) {
            document.querySelectorAll('.payment-option').forEach(el => el.classList.remove('active'));
            if (type === 'cod') document.getElementById('option-cod').classList.add('active');
            if (type === 'bank') document.getElementById('option-bank').classList.add('active');
            if (type === 'qr') document.getElementById('option-qr').classList.add('active');
        }
    </script>
</body>
</html>

 --> -->
