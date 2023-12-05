<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Stylesheet -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- Fontawesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Document</title>
</head>
<body>
<nav class="navbar navbar-expand navbar-dark bg-dark" style="margin-bottom: 80px;">
        <div class="container">
            <a href="dashboard.php" class="navbar-brand">
                <h1 class="h3">The Company</h1>
            </a>
            <div class="navbar-nav">
                <span class="navbar-text"><?= $_SESSION['fullname'] ?></span>
                <form action="../actions/action-logout.php" method="post" class="d-flex ms-2">
                    <button type="submit" class="text-danger bg-transparent border-0">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <main class="row justify-content-center gx-0">
      <div class="col-4 text-center">
         <i class ="fa-solid fa-triangle-exclamation text-warning display-4 d-block mb-2"></i>
         <h2 class="text danger mb-5">DELETE ACCOUNT</h2>

          <p class="fw-bold">Are you sure you want to delete your account?</p>

          <div class="row">
            <div class="col">
              <a href="dashboard.php" class="btn btb-secondary w-100">Cancel</a>
            </div>
            <div class="col">
              <form action="../action/action-delete-user.pho" method="post">
                <button type ="submit" class="btn_btn-outline-danger w-100">Delete</button>
              </form>
            </div>
          </div>
      </div>
</main>
</body>
</html>