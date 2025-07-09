<?php
session_start();
include 'db.php';
include 'header.php';

$errors = [];
$success = false;
$orderId = null;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['checkout'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $method = trim($_POST['method']);
    $pickup = isset($_POST['pickup']) ? trim($_POST['pickup']) : null;
    $delivery_option = isset($_POST['delivery_option']) ? trim($_POST['delivery_option']) : null;
    $delivery_time = ($delivery_option == 'scheduled') ? trim($_POST['delivery_time']) : ($delivery_option == 'asap' ? 'ASAP' : null);
    $payment = trim($_POST['payment']);

    if (empty($name))
        $errors[] = "Name is required.";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        $errors[] = "Valid email required.";
    if (empty($method))
        $errors[] = "Select pickup or delivery.";
    if ($method == 'pickup' && empty($pickup))
        $errors[] = "Pickup time is required.";
    if ($method == 'delivery' && empty($delivery_option))
        $errors[] = "Select delivery time preference.";
    if ($method == 'delivery' && $delivery_option == 'scheduled' && empty($delivery_time))
        $errors[] = "Enter delivery time.";
    if (empty($payment))
        $errors[] = "Payment method is required.";
    if (empty($_SESSION['cart']))
        $errors[] = "Cart is empty.";

    if (empty($errors)) {
        $items = [];
        $total = 0;

        foreach ($_SESSION['cart'] as $item => $details) {
            $line = "$item x{$details['quantity']} @ \${$details['price']}";
            $items[] = $line;
            $total += $details['quantity'] * $details['price'];
        }

        $itemString = implode(", ", $items);
        $timeValue = $method == 'pickup' ? $pickup : ($delivery_option == 'asap' ? 'ASAP Delivery' : $delivery_time);

        $stmt = $pdo->prepare("INSERT INTO orders (customer_name, customer_email, pickup_time, payment_method, items, total_price, status)
                               VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$name, $email, $timeValue, $payment, $itemString, $total, 'Pending']);
        $orderId = $pdo->lastInsertId();

        unset($_SESSION['cart']);
        $success = true;
    }
}
?>

<div class="container py-5">
    <h2 class="mb-4">Checkout</h2>

    <?php if ($success): ?>
        <div class="alert alert-success">
            ✅ Thank you! Your order (ID: <?= $orderId ?>) has been placed and is currently <strong>Pending</strong>.
        </div>
    <?php elseif (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $e)
                    echo "<li>$e</li>"; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if (!$success): ?>
        <form method="post" class="mb-4">
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control" value="<?= $_POST['name'] ?? '' ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" value="<?= $_POST['email'] ?? '' ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Order Type</label>
                <select name="method" class="form-select" id="method-select" required>
                    <option value="">-- Choose --</option>
                    <option value="pickup" <?= ($_POST['method'] ?? '') == 'pickup' ? 'selected' : '' ?>>Pickup</option>
                    <option value="delivery" <?= ($_POST['method'] ?? '') == 'delivery' ? 'selected' : '' ?>>Delivery</option>
                </select>
            </div>

            <div class="mb-3 d-none" id="pickup-time">
                <label class="form-label">Pickup Time</label>
                <input type="time" name="pickup" class="form-control" value="<?= $_POST['pickup'] ?? '' ?>">
            </div>

            <div class="mb-3 d-none" id="delivery-options">
                <label class="form-label">Delivery Option</label>
                <select name="delivery_option" class="form-select" id="delivery-select">
                    <option value="">-- Choose --</option>
                    <option value="asap" <?= ($_POST['delivery_option'] ?? '') == 'asap' ? 'selected' : '' ?>>ASAP</option>
                    <option value="scheduled" <?= ($_POST['delivery_option'] ?? '') == 'scheduled' ? 'selected' : '' ?>>
                        Schedule for Later</option>
                </select>
            </div>

            <div class="mb-3 d-none" id="delivery-time">
                <label class="form-label">Scheduled Delivery Time</label>
                <input type="time" name="delivery_time" class="form-control" value="<?= $_POST['delivery_time'] ?? '' ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Payment Method</label>
                <select name="payment" class="form-select" required>
                    <option value="">-- Select Payment Option --</option>
                    <option value="Cash" <?= (($_POST['payment'] ?? '') == 'Cash') ? 'selected' : '' ?>>Cash</option>
                    <option value="Card" <?= (($_POST['payment'] ?? '') == 'Card') ? 'selected' : '' ?>>Card</option>
                    <option value="Online" <?= (($_POST['payment'] ?? '') == 'Online') ? 'selected' : '' ?>>Online</option>
                </select>
            </div>

            <?php if (!empty($_SESSION['cart'])): ?>
                <h5>Your Cart:</h5>
                <ul class="list-group mb-3">
                    <?php
                    $grandTotal = 0;
                    foreach ($_SESSION['cart'] as $item => $details):
                        $itemTotal = $details['price'] * $details['quantity'];
                        $grandTotal += $itemTotal;
                        ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?= htmlspecialchars($item) ?> × <?= $details['quantity'] ?>
                            <span>$<?= number_format($itemTotal, 2) ?></span>
                        </li>
                    <?php endforeach; ?>
                    <li class="list-group-item d-flex justify-content-between fw-bold">
                        Total
                        <span>$<?= number_format($grandTotal, 2) ?></span>
                    </li>
                </ul>
            <?php endif; ?>

            <button type="submit" name="checkout" class="btn btn-success">Place Order</button>
        </form>

        <script>
            const methodSelect = document.getElementById('method-select');
            const pickupDiv = document.getElementById('pickup-time');
            const deliveryDiv = document.getElementById('delivery-options');
            const deliveryTimeDiv = document.getElementById('delivery-time');
            const deliverySelect = document.getElementById('delivery-select');

            function updateFormDisplay() {
                const method = methodSelect.value;
                pickupDiv.classList.add('d-none');
                deliveryDiv.classList.add('d-none');
                deliveryTimeDiv.classList.add('d-none');

                if (method === 'pickup') {
                    pickupDiv.classList.remove('d-none');
                } else if (method === 'delivery') {
                    deliveryDiv.classList.remove('d-none');
                    if (deliverySelect.value === 'scheduled') {
                        deliveryTimeDiv.classList.remove('d-none');
                    }
                }
            }

            methodSelect.addEventListener('change', updateFormDisplay);
            deliverySelect.addEventListener('change', updateFormDisplay);

            document.addEventListener('DOMContentLoaded', updateFormDisplay);
        </script>

    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>