<?php
session_start();

// Add to cart logic
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_to_cart'])) {
  $item = $_POST['item'];
  $price = $_POST['price'];

  if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
  }

  if (isset($_SESSION['cart'][$item])) {
    $_SESSION['cart'][$item]['quantity'] += 1;
  } else {
    $_SESSION['cart'][$item] = ['price' => $price, 'quantity' => 1];
  }

  header("Location: menu.php");
  exit();
}

include 'header.php';
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
        ?>
        <div class="col">
          <div class="card h-100 shadow-sm">
            <img src="images/menu/<?= htmlspecialchars($img) ?>" class="card-img-top"
              alt="<?= htmlspecialchars($name) ?>">
            <div class="card-body">
              <h5 class="card-title"><?= htmlspecialchars($name) ?></h5>
              <p class="card-text"><?= htmlspecialchars($desc) ?></p>
              <p><small class="text-muted"><?= htmlspecialchars($labels) ?></small></p>
              <p class="fw-bold">\$<?= htmlspecialchars($price) ?></p>
              <form method="post">
                <input type="hidden" name="item" value="<?= htmlspecialchars($name) ?>">
                <input type="hidden" name="price" value="<?= htmlspecialchars($price) ?>">
                <button type="submit" name="add_to_cart" class="btn btn-sm btn-primary w-100">Add to Cart</button>
              </form>
            </div>
          </div>
        </div>
      <?php } ?>

    </div>
  </div>
</section>

<?php include 'footer.php'; ?>