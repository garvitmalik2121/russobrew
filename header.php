<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Russo Brew</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

  <!-- Bootstrap Icons (Optional) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

  <!-- Custom CSS -->
  <link href="/css/style.css" rel="stylesheet" />
</head>

<body>

  <!-- Navigation Bar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm py-3 sticky-top">
    <div class="container">
      <!-- Logo & Brand -->
      <a class="navbar-brand d-flex align-items-center" href="./index.php">
        <img src="images/logo.jpeg" width=" 50" height="50" class="me-2 rounded-circle" />
        <span class="fw-bold fs-4">Russo Brew</span>
      </a>

      <!-- Toggler for Mobile -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
        aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Navbar Links -->
      <div class="collapse navbar-collapse" id="mainNavbar">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link fw-semibold" href="./index.php"><i class="bi bi-house-door-fill me-1"></i>Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fw-semibold" href="./menu.php"><i class="bi bi-cup-hot me-1"></i>Menu</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fw-semibold" href="./contact.php"><i class="bi bi-envelope-fill me-1"></i>Contact</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fw-semibold" href="./about.php"><i class="bi bi-person-lines-fill me-1"></i>About Us</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>