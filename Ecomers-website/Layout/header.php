<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$cartCount = 0;
$totalPrice = 0;

if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $qty = (int)($item['quantity'] ?? 1);
        $price = (float)($item['price'] ?? 0);
        $cartCount += $qty;
        $totalPrice += ($price * $qty);
    }
}
?>

<!-- Import Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Grand+Hotel&family=Inter:wght@500;600;700&display=swap" rel="stylesheet">

<style>
    body {
        margin: 0;
        font-family: 'Inter', sans-serif;
        padding-top: 110px;
    }

    .main-header {
        background-color: #618281;
    padding: 10px 40px 14px 40px;
    color: white;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    z-index: 9999;
    box-sizing: border-box;
    }

    .header-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        max-width: 1400px;
        margin: 0 auto;
    }

    .logo-clothes {
        font-family: 'Grand Hotel', cursive;
        font-size: 52px;
        color: #ffffff;
        text-decoration: none;
        line-height: 1;
        letter-spacing: 0.5px;
    }

    .top-nav {
        display: flex;
        gap: 32px;
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .top-nav a {
        color: #ffffff;
        text-decoration: none;
        font-size: 16px;
        font-weight: 600;
    }

    .header-actions {
        display: flex;
        align-items: center;
        gap: 22px;
    }

    .search-wrapper {
        position: relative;
        display: flex;
        align-items: center;
    }

    .search-wrapper input {
        width: 230px;
        padding: 8px 18px 8px 38px;
        border-radius: 20px;
        border: none;
        outline: none;
        font-size: 15px;
        background-color: #ffffff;
        color: #334155;
    }

    .search-wrapper input::placeholder {
        color: #94a3b8;
    }

    .search-wrapper svg {
        position: absolute;
        left: 12px;
        width: 18px;
        height: 18px;
        color: #64748b;
    }

    .action-icon-btn {
        background: transparent;
        border: none;
        color: #ffffff;
        cursor: pointer;
        padding: 2px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    .cart-count-badge {
        position: absolute;
        top: -4px;
        right: -6px;
        background-color: #ef4444;
        color: #ffffff;
        font-size: 11px;
        font-weight: 700;
        border-radius: 50%;
        width: 18px;
        height: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .sub-nav-container {
        max-width: 1400px;
        margin: 6px auto 0 auto;
        display: flex;
        justify-content: center;
    }

    .sub-nav {
        display: flex;
        gap: 36px;
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .sub-nav a {
        color: #ffffff;
        text-decoration: none;
        font-size: 16px;
        font-weight: 600;
    }

    .cart-dropdown-box {
        display: none;
        position: absolute;
        right: 0;
        top: 135%;
        width: 350px;
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.2);
        padding: 18px;
        z-index: 99999;
        color: #0f172a;
    }

    .cart-dropdown-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 14px;
    }

    .cart-dropdown-title {
        font-size: 16px;
        font-weight: 700;
        margin: 0;
    }

    .close-cart-btn {
        background: none;
        border: none;
        font-size: 16px;
        color: #94a3b8;
        cursor: pointer;
    }

    .cart-items-wrapper {
        max-height: 260px;
        overflow-y: auto;
    }

    .cart-dropdown-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 8px 0;
        border-bottom: 1px solid #f1f5f9;
    }

    .cart-dropdown-item img {
        width: 48px;
        height: 48px;
        border-radius: 8px;
        object-fit: cover;
    }

    .cart-item-details {
        flex: 1;
    }

    .cart-item-name {
        font-size: 13px;
        font-weight: 600;
        color: #0f172a;
        margin-bottom: 2px;
    }

    .cart-item-qty {
        font-size: 12px;
        color: #64748b;
    }

    .cart-item-price-total {
        font-weight: 700;
        font-size: 13px;
    }

    .btn-checkout-submit {
        display: block;
        width: 100%;
        padding: 12px;
        background-color: #618281;
        color: #ffffff;
        text-align: center;
        text-decoration: none;
        border-radius: 10px;
        font-weight: 700;
        font-size: 14px;
        margin-top: 14px;
        box-sizing: border-box;
    }
</style>

<header class="main-header">
    <div class="header-top">
        <a href="index.php" class="logo-clothes">Clothes</a>

        <ul class="top-nav">
            <li><a href="index.php">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contact</a></li>
        </ul>

        <div class="header-actions">
            <div class="search-wrapper">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="text" placeholder="Search products...">
            </div>

            <button class="action-icon-btn" type="button">
                <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </button>

            <button class="action-icon-btn" type="button">
                <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                </svg>
            </button>

            <div style="position: relative;">
                <button class="action-icon-btn" id="cartBtn" type="button">
                    <svg width="25" height="25" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                    </svg>
                    <?php if ($cartCount > 0): ?>
                        <span class="cart-count-badge"><?php echo $cartCount; ?></span>
                    <?php endif; ?>
                </button>

                <div class="cart-dropdown-box" id="cartDropdown">
                    <div class="cart-dropdown-header">
                        <h3 class="cart-dropdown-title">កន្ត្រកទំនិញ</h3>
                        <button class="close-cart-btn" id="closeCartBtn">✕</button>
                    </div>

                    <div class="cart-items-wrapper">
                        <?php if (empty($_SESSION['cart'])): ?>
                            <p style="text-align: center; color: #94a3b8; font-size: 13px; padding: 15px 0;">គ្មានទំនិញក្នុងកន្ត្រកទេ</p>
                        <?php else: ?>
                            <?php foreach ($_SESSION['cart'] as $item): 
                                $itemQty = max(1, (int)($item['quantity'] ?? 1));
                                $itemPrice = max(0, (float)($item['price'] ?? 0));
                            ?>
                                <div class="cart-dropdown-item">
                                    <img src="<?php echo htmlspecialchars($item['image'] ?? 'placeholder.jpg'); ?>" alt="Product">
                                    <div class="cart-item-details">
                                        <div class="cart-item-name"><?php echo htmlspecialchars($item['name'] ?? 'Product'); ?></div>
                                        <div class="cart-item-qty">$<?php echo number_format($itemPrice, 2); ?> × <?php echo $itemQty; ?></div>
                                    </div>
                                    <div class="cart-item-price-total">$<?php echo number_format($itemPrice * $itemQty, 2); ?></div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <?php if (!empty($_SESSION['cart'])): ?>
                        <div style="border-top: 1px dashed #e2e8f0; padding-top: 10px; margin-top: 10px;">
                            <div style="display: flex; justify-content: space-between; font-weight: 700; font-size: 15px;">
                                <span>Total:</span>
                                <span style="color: #059669;">$<?php echo number_format($totalPrice, 2); ?></span>
                            </div>
                            <a href="checkout.php" class="btn-checkout-submit">ទូទាត់ប្រាក់ (Checkout)</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="sub-nav-container">
        <ul class="sub-nav">
            <li><a href="index.php?page=women">Women</a></li>
            <li><a href="index.php?page=men">Men</a></li>
            <li><a href="index.php?page=bags">Bags</a></li>
            <li><a href="index.php?page=shoes">Shoes</a></li>
            <li><a href="index.php?page=caps">Caps</a></li>
        </ul>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const cartBtn = document.getElementById('cartBtn');
        const closeCartBtn = document.getElementById('closeCartBtn');
        const cartDropdown = document.getElementById('cartDropdown');

        if (cartBtn && cartDropdown) {
            cartBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                cartDropdown.style.display = (cartDropdown.style.display === 'block') ? 'none' : 'block';
            });
        }

        if (closeCartBtn && cartDropdown) {
            closeCartBtn.addEventListener('click', () => {
                cartDropdown.style.display = 'none';
            });
        }

        document.addEventListener('click', (e) => {
            if (cartDropdown && !cartDropdown.contains(e.target) && !cartBtn.contains(e.target)) {
                cartDropdown.style.display = 'none';
            }
        });
    });
</script>



