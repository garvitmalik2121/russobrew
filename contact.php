<?php include 'includes/header.php'; ?>
<div class="container mt-5">
  <h2>Contact Us</h2>
  <form method="post" action="contact_submit.php">
    <div class="mb-3">
      <label class="form-label">Name</label>
      <input type="text" class="form-control" name="name" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Email</label>
      <input type="email" class="form-control" name="email" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Message</label>
      <textarea class="form-control" name="message" rows="4" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
<?php include 'includes/footer.php'; ?>
