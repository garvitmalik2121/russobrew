<?php
session_start();
include 'db.php';
include 'header.php';

$errors = [];
$success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['checkout'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $pickup = trim($_POST['pickup']);

    if (empty($name))
        $errors[] = "Name is required.";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        $errors[] = "Valid email required.";
    if (empty($pickup))
        $errors[] = "Pickup time is required.";

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

        $stmt = $pdo->prepare("INSERT INTO orders (customer_name, customer_email, pickup_time, items, total_price)
                           VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$name, $email, $pickup, $itemString, $total]);

        unset($_SESSION['cart']);
        $success = true;
    }
}
?>

<div class="container py-5">
    <h2 class="mb-4">Checkout</h2>

    <?php if ($success): ?>
        <div class="alert alert-success">
            ✅ Thank you! Your order has been placed and saved.
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
                <label class="form-label">Pickup Time</label>
                <input type="time" name="pickup" class="form-control" value="<?= $_POST['pickup'] ?? '' ?>" required>
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
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>