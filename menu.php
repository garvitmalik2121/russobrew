<?php include 'includes/header.php'; ?>
<div class="container mt-5">
  <h2 class="mb-4">Our Menu</h2>
  <div class="row">
    <?php
    include 'includes/db.php';
    $sql = "SELECT * FROM menu";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
      echo '<div class="col-md-4"><div class="card mb-4">';
      echo '<div class="card-body"><h5 class="card-title">' . $row["name"] . '</h5>';
      echo '<p class="card-text">' . $row["description"] . '</p>';
      echo '<p class="card-text"><strong>$' . $row["price"] . '</strong></p></div></div></div>';
    }
    $conn->close();
    ?>
  </div>
</div>
<?php include 'includes/footer.php'; ?>
