<?php include 'header.php'; ?>

<!-- Hero Section -->
<section class="hero text-white text-center d-flex align-items-center justify-content-center bg-dark"
  style="height: 90vh; background: url('images/banner.jpeg') center/cover no-repeat;"
  aria-label="Welcome hero section with café introduction and call to action">
  <div class="container">
    <h1 class="display-3 fw-bold">Welcome to Russo Brew</h1>
    <p class="lead">The ultimate university café experience — handcrafted coffee, cozy ambiance, and great deals!</p>
    <a href="menu.php" class="btn btn-primary btn-lg mt-3">Explore Our Menu</a>
  </div>
</section>

<!-- About Section -->
<section class="py-5 bg-light">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-6">
        <img src="images/insiderusso.jpg" alt="Inside Russo Brew" class="img-fluid rounded shadow" />
      </div>
      <div class="col-md-6">
        <h2>More Than Just Coffee</h2>
        <p class="lead">Russo Brew is your go-to campus café where comfort meets caffeine. Whether you're studying,
          meeting friends, or relaxing between lectures, our space is designed for students by students.</p>
        <p>Open daily from 7am – 7pm | Free Wi-Fi | Student Discounts</p>
      </div>
    </div>
  </div>
</section>

<!-- Featured Deals -->
<section class="py-5">
  <div class="container text-center">
    <h2 class="mb-4">Today’s Specials</h2>
    <div class="row g-4">
      <div class="col-md-4">
        <div class="card h-100 shadow">
          <img src="images/deal1.webp" class="card-img-top" alt="Espresso and Croissant" />
          <div class="card-body">
            <h5 class="card-title">Espresso + Croissant</h5>
            <p class="card-text">A bold shot and a warm pastry for just $4.99.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card h-100 shadow">
          <img src="images/icedmocha.jpg" class="card-img-top" alt="Iced Mocha Deal" />
          <div class="card-body">
            <h5 class="card-title">Iced Mocha Monday</h5>
            <p class="card-text">Cool down with a $3 Iced Mocha – every Monday!</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card h-100 shadow">
          <img src="images/chaimufin.jpg" class="card-img-top" alt="Chai Latte Combo" />
          <div class="card-body">
            <h5 class="card-title">Chai + Muffin</h5>
            <p class="card-text">Only $5.50 for a warm spiced chai and muffin combo.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="offers py-5 bg-light text-center">
  <div class="container">
    <h2 class="mb-4">Special Offers</h2>
    <div class="row g-4">

      <!-- Offer 1 -->
      <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0">
          <div class="card-body">
            <h5 class="card-title">Refer a Friend</h5>
            <p class="card-text">Refer your friends and get exclusive offers every time they make a purchase!</p>
          </div>
        </div>
      </div>

      <!-- Offer 2 -->
      <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0">
          <div class="card-body">
            <h5 class="card-title">Bring Your Cup</h5>
            <p class="card-text">Help the environment and save! Bring your own cup and get coffee at a discounted price.
            </p>
          </div>
        </div>
      </div>

      <!-- Offer 3 -->
      <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0">
          <div class="card-body">
            <h5 class="card-title">Morning Coffee Deal</h5>
            <p class="card-text">Get any coffee for just $3 between 6 AM and 10 AM. Start your day right!</p>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>


<!-- Reviews Section -->
<section class="bg-dark text-white py-5">
  <div class="container text-center">
    <h2 class="mb-4">Loved by Students</h2>
    <div class="row g-4">
      <div class="col-md-4">
        <blockquote class="blockquote">
          <p>"Always fresh coffee and friendly faces. Best place to chill before class!"</p>
          <footer class="blockquote-footer text-white">Sarah • Nursing</footer>
        </blockquote>
      </div>
      <div class="col-md-4">
        <blockquote class="blockquote">
          <p>"Affordable and delicious. Their mocha is my go-to!"</p>
          <footer class="blockquote-footer text-white">David • Engineering</footer>
        </blockquote>
      </div>
      <div class="col-md-4">
        <blockquote class="blockquote">
          <p>"The vibe is so cozy. I love working on group assignments here."</p>
          <footer class="blockquote-footer text-white">Leah • Psychology</footer>
        </blockquote>
      </div>
    </div>
  </div>
</section>

<!-- Newsletter Subscription -->
<section class="py-5 bg-light">
  <div class="container text-center">
    <h2>Stay in the Loop</h2>
    <p class="mb-4">Get weekly deals, event invites, and exclusive offers right in your inbox!</p>
    <form class="row justify-content-center" action="subscribe.php" method="POST" novalidate>
      <div class="col-md-4">
        <input type="email" name="email" class="form-control mb-2" placeholder="Enter your email" required
          aria-label="Email address" />
      </div>
      <div class="col-auto">
        <button type="submit" class="btn btn-primary">Subscribe</button>
      </div>
    </form>
  </div>
</section>

<?php include 'footer.php'; ?>