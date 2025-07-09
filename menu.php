<?php
session_start();

// Add or update cart quantity logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $item = $_POST['item'];
  $price = $_POST['price'];
  $action = $_POST['action'] ?? 'add';

  if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
  }

  if ($action === 'add') {
    if (isset($_SESSION['cart'][$item])) {
      $_SESSION['cart'][$item]['quantity'] += 1;
    } else {
      $_SESSION['cart'][$item] = ['price' => $price, 'quantity' => 1];
    }
  } elseif ($action === 'increase') {
    $_SESSION['cart'][$item]['quantity'] += 1;
  } elseif ($action === 'decrease') {
    $_SESSION['cart'][$item]['quantity'] -= 1;
    if ($_SESSION['cart'][$item]['quantity'] <= 0) {
      unset($_SESSION['cart'][$item]);
    }
  }

  header("Location: menu.php");
  exit();
}

include 'header.php';

$cartCount = isset($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'], 'quantity')) : 0;
?>

<section class="menu py-5 bg-light">
  <div class="container">
    <h1 class="text-center mb-4">Russo Brew – Inclusive & Healthy Menu</h1>
    <p class="text-center mb-5">Designed for a small café space at JCUB / Sarina Russo<br>All options available in
      takeaway eco-packs</p>

    <!-- Light Meals & Snacks -->
    <h3 class="mt-4 mb-3">Light Meals & Snacks</h3>
    <div class="row row-cols-1 row-cols-md-3 g-4">

      <?php
      $menuItems = [
        ["Avocado Toast", "Smashed avocado, lemon, gluten-free toast", "Vegan, GF", "7.50", "avocado_toast.jpg"],
        ["Halal Chicken Wrap", "Grilled halal chicken, lettuce, cucumber, yoghurt dressing", "Halal", "8.00", "chicken_wrap.jpg"],
        ["Tofu Salad Box", "Tofu, edamame, mixed greens, sesame dressing", "Vegan, GF", "8.50", "tofu_salad.jpg"],
        ["Falafel Pocket", "Falafel, tahini, tomato, lettuce in pita", "Vegan, Halal-friendly", "7.00", "falafel_pocket.jpg"],
        ["Fruit & Yogurt Parfait", "Low-fat yogurt, granola, berries (dairy-free available)", "GF, Vegetarian", "6.50", "fruit_parfait.jpg"],
        ["Hummus & Crackers", "Creamy hummus with rice crackers", "Vegan, GF", "5.00", "hummus_crackers.jpg"],
        ["Mixed Nuts & Seeds Cup", "Lightly roasted – no added salt", "Vegan, Kosher, Halal, GF", "4.50", "nuts_seeds.jpg"],
        ["Energy Bliss Balls", "Dates, coconut, oats, chia", "Vegan, GF", "3.50", "energy_balls.jpg"],
        ["Gluten-Free Banana Muffin", "Made with almond flour, banana", "GF, Vegetarian", "4.00", "banana_muffin.jpg"],
        ["Seasonal Fruit Cup", "Fresh cut fruit, served chilled", "Vegan, GF, Kosher, Halal", "4.50", "fruit_cup.jpg"]
      ];

      foreach ($menuItems as $item) {
        $name = $item[0];
        $desc = $item[1];
        $labels = $item[2];
        $price = $item[3];
        $img = $item[4];
        $quantity = $_SESSION['cart'][$name]['quantity'] ?? 0;
        ?>
        <div class="col">
          <div class="card h-100 shadow-sm">
            <img src="images/menu/<?= htmlspecialchars($img) ?>" class="card-img-top"
              alt="<?= htmlspecialchars($name) ?>">
            <div class="card-body">
              <h5 class="card-title"><?= htmlspecialchars($name) ?></h5>
              <p class="card-text"><?= htmlspecialchars($desc) ?></p>
              <p><small class="text-muted"><?= htmlspecialchars($labels) ?></small></p>
              <p class="fw-bold">$<?= htmlspecialchars($price) ?></p>

              <?php if ($quantity > 0): ?>
                <div class="d-flex justify-content-between align-items-center">
                  <form method="post" class="d-inline">
                    <input type="hidden" name="item" value="<?= htmlspecialchars($name) ?>">
                    <input type="hidden" name="price" value="<?= htmlspecialchars($price) ?>">
                    <input type="hidden" name="action" value="decrease">
                    <button type="submit" class="btn btn-sm btn-outline-danger">-</button>
                  </form>

                  <span class="px-2 fw-bold"><?= $quantity ?></span>

                  <form method="post" class="d-inline">
                    <input type="hidden" name="item" value="<?= htmlspecialchars($name) ?>">
                    <input type="hidden" name="price" value="<?= htmlspecialchars($price) ?>">
                    <input type="hidden" name="action" value="increase">
                    <button type="submit" class="btn btn-sm btn-outline-success">+</button>
                  </form>
                </div>
              <?php else: ?>
                <form method="post">
                  <input type="hidden" name="item" value="<?= htmlspecialchars($name) ?>">
                  <input type="hidden" name="price" value="<?= htmlspecialchars($price) ?>">
                  <input type="hidden" name="action" value="add">
                  <button type="submit" class="btn btn-sm btn-primary w-100">Add to Cart</button>
                </form>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php } ?>

    </div>
  </div>
</section>

<?php include 'footer.php'; ?>