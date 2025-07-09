<?php
session_start();
include 'db.php';
include 'header.php';

$name = $email = $message = "";
$errors = [];
$success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Sanitize inputs
  $name = trim($_POST['name']);
  $email = trim($_POST['email']);
  $message = trim($_POST['message']);

  // Validate inputs
  if (empty($name)) {
    $errors[] = "Name is required.";
  }
  if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Valid email is required.";
  }
  if (empty($message)) {
    $errors[] = "Message cannot be empty.";
  }

  if (empty($errors)) {
    // Insert into database
    $stmt = $pdo->prepare("INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)");
    $stmt->execute([$name, $email, $message]);

    $success = true;

    // Clear form data
    $name = $email = $message = "";
  }
}
?>

<div class="container py-5">
  <h2 class="mb-4 text-center">Contact Us</h2>

  <?php if ($success): ?>
    <div class="alert alert-success">
      Thank you for your message. We will get back to you shortly.
    </div>
  <?php elseif (!empty($errors)): ?>
    <div class="alert alert-danger">
      <ul class="mb-0">
        <?php foreach ($errors as $error)
          echo "<li>" . htmlspecialchars($error) . "</li>"; ?>
      </ul>
    </div>
  <?php endif; ?>

  <form method="post" action="contactus.php" class="mx-auto" style="max-width:600px;">
    <div class="mb-3">
      <label for="name" class="form-label fw-semibold">Name</label>
      <input type="text" name="name" id="name" class="form-control" value="<?= htmlspecialchars($name) ?>" required>
    </div>

    <div class="mb-3">
      <label for="email" class="form-label fw-semibold">Email</label>
      <input type="email" name="email" id="email" class="form-control" value="<?= htmlspecialchars($email) ?>" required>
    </div>

    <div class="mb-3">
      <label for="message" class="form-label fw-semibold">Message</label>
      <textarea name="message" id="message" rows="5" class="form-control"
        required><?= htmlspecialchars($message) ?></textarea>
    </div>

    <button type="submit" class="btn btn-primary w-100">Send Message</button>
  </form>
</div>

<?php include 'footer.php'; ?>