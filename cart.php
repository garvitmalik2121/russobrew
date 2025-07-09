<?php
session_start();
include 'header.php';
?>

<div class="container py-5">
    <h2>Your Cart</h2>
    <?php if (empty($_SESSION['cart'])): ?>
        <p>Your cart is empty.</p>
    <?php else: ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $grandTotal = 0;
                foreach ($_SESSION['cart'] as $name => $item):
                    $itemTotal = $item['price'] * $item['quantity'];
                    $grandTotal += $itemTotal;
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($name) ?></td>
                        <td>$<?= number_format($item['price'], 2) ?></td>
                        <td><?= $item['quantity'] ?></td>
                        <td>$<?= number_format($itemTotal, 2) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-end fw-bold">Grand Total:</td>
                    <td><strong>$<?= number_format($grandTotal, 2) ?></strong></td>
                </tr>
            </tfoot>
        </table>
        <a href="checkout.php" class="btn btn-success">Proceed to Checkout</a>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>