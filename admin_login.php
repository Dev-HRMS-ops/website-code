<?php
// TURN ON BUFFERING & ERRORS
ob_start();
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

session_start();
require_once 'db.php';

// Redirect if already logged in
if (isset($_SESSION['admin_user'])) {
    header("Location: admin_portal.php");
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u = trim($_POST['username']);
    $p = $_POST['password'];
    $stmt = $pdo->prepare("SELECT * FROM admin_users WHERE username=?");
    $stmt->execute([$u]);
    $user = $stmt->fetch();
    if ($user && password_verify($p, $user['password'])) {
        $_SESSION['admin_user'] = $u;
        header("Location: admin_portal.php");
        exit;
    } else {
        $error = "Invalid credentials.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Federal Government Educational Institutions</title>
    <meta name="description" content="Welcome to Federal Government Educational Institutions (C/G), also known as FGEI-(C/G).">
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">
    <!-- custom css -->
    <link rel="stylesheet" href="css/fgeiwsstyle.css">
</head>
<body class="bg-light">
    <?php require_once "testheader2.php"; ?>
    <div class="container mt-5 d-flex justify-content-center align-items-center">
        <div class="card p-4 shadow" style="max-width:400px; width:100%;">
            <h4 class="card-title text-center mb-3">Admin Login</h4>
            <?php if ($error): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <form method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input id="username" name="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" name="password" type="password" class="form-control" required>
                </div>
                <button class="btn btn-primary w-100">Login</button>
            </form>
        </div>
    </div>
</body>
</html>
<?php ob_end_flush(); ?>
