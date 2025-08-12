<?php
// admin_slides.php
ob_start();
session_start();
require_once 'db.php';
if (!isset($_SESSION['admin_user'])) {
    header('Location: admin_login.php');
    exit;
}

// CSRF
if (empty($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(32));
$csrf = $_SESSION['csrf'];

// Handle Delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $img = $pdo->query("SELECT image FROM sliders WHERE id=$id")->fetchColumn();
    if ($img && file_exists($img)) unlink($img);
    $pdo->prepare("DELETE FROM sliders WHERE id=?")->execute([$id]);
    header('Location: admin_slides.php');
    exit;
}

// Handle Add/Edit
$edit = null;
if (isset($_GET['edit'])) {
    $edit = $pdo->prepare("SELECT * FROM sliders WHERE id=?");
    $edit->execute([(int)$_GET['edit']]);
    $edit = $edit->fetch();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_slide'])) {
    if (!hash_equals($csrf, $_POST['csrf'] ?? '')) die('CSRF Token Mismatch');

    $id    = $_POST['id'] ?? null;
    $page  = trim($_POST['page']);
    $cap   = trim($_POST['caption'] ?? '');
    $link  = trim($_POST['link'] ?? '');
    $order = (int)$_POST['display_order'];
    $active = isset($_POST['active']) ? 1 : 0;

    // Image upload
    $imgPath = $edit['image'] ?? '';
    if (!empty($_FILES['image']['name'])) {
        $tmp = $_FILES['image']['tmp_name'];
        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) die('Invalid file type');
        $fn  = uniqid('slide_') . ".$ext";
        move_uploaded_file($tmp, "images/slider/$fn");
        if ($imgPath && file_exists($imgPath)) unlink($imgPath);
        $imgPath = "images/slider/$fn";
    } elseif (!$id) {
        die('Image required for new slide');
    }

    if ($id) {
        $pdo->prepare("
            UPDATE sliders SET page=?, image=?, caption=?, link=?, display_order=?, active=?
            WHERE id=?
        ")->execute([$page, $imgPath, $cap, $link, $order, $active, $id]);
    } else {
        $pdo->prepare("
            INSERT INTO sliders (page, image, caption, link, display_order, active)
            VALUES (?, ?, ?, ?, ?, ?)
        ")->execute([$page, $imgPath, $cap, $link, $order, $active]);
    }
    header('Location: admin_slides.php');
    exit;
}

// Fetch all slides
$slides = $pdo->query("SELECT * FROM sliders ORDER BY page, display_order")->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Manage Sliders</title>
    <link rel="stylesheet" href="css/fgeiwsstyle.css">
</head>
<body>
<?php require 'testheader2.php'; ?>
<div class="container py-4">
    <div class="row">
            <a href="admin_portal.php" class="btn btn-secondary mb-3">Admin</a>
        </div>
    <h2>Slider Manager</h2>
    <table class="table table-bordered mb-4">
        <thead>
            <tr>
                <th>Page</th>
                <th>Preview</th>
                <th>Caption</th>
                <th>Order</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($slides as $s): ?>
                <tr>
                    <td><?= htmlspecialchars($s['page']) ?></td>
                    <td><img src="<?= htmlspecialchars($s['image']) ?>" style="height:30px;"></td>
                    <td><?= htmlspecialchars($s['caption']) ?></td>
                    <td><?= $s['display_order'] ?></td>
                    <td><?= $s['active'] ? 'Yes' : 'No' ?></td>
                    <td>
                        <a href="?edit=<?= $s['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="?delete=<?= $s['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete slide?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php $e = $edit ?? []; ?>
    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="csrf" value="<?= $csrf ?>">
        <?php if ($edit): ?><input type="hidden" name="id" value="<?= $e['id'] ?>"><?php endif; ?>

        <div class="row g-3">
            <div class="col-md-3">
                <label class="form-label">Page Slug</label>
                <input type="text" name="page" class="form-control"
                    value="<?= htmlspecialchars($e['page'] ?? '') ?>"
                    placeholder="e.g. index, schools-n, category-schools-2, dr-zohra">
                <small class="text-muted">Use the filename without `.php` (e.g. `index`, `schools-n`, `dr-zohra`, `category-schools-2`)</small>
            </div>
            <div class="col-md-3">
                <label class="form-label">Caption</label>
                <input name="caption" class="form-control" value="<?= htmlspecialchars($e['caption'] ?? '') ?>">
            </div>
            <div class="col-md-3">
                <label class="form-label">Link (optional)</label>
                <input name="link" type="url" class="form-control" value="<?= htmlspecialchars($e['link'] ?? '') ?>">
            </div>
            <div class="col-md-2">
                <label class="form-label">Order</label>
                <input name="display_order" type="number" class="form-control" value="<?= $e['display_order'] ?? 0 ?>" required>
            </div>
            <div class="col-md-1 form-check align-self-end">
                <input name="active" type="checkbox" class="form-check-input" <?= empty($e['active']) || $e['active'] ? 'checked' : '' ?>>
                <label class="form-check-label">Active</label>
            </div>
        </div>

        <div class="mt-3">
            <label class="form-label">Image <?= $edit ? '(leave blank to keep current)' : '' ?></label>
            <input name="image" type="file" class="form-control" <?= $edit ? '' : 'required' ?>>
        </div>

        <button name="save_slide" class="btn btn-primary mt-3">
            <?= $edit ? 'Update Slide' : 'Add Slide' ?>
        </button>
    </form>
</div>
<?php require 'newfooter.php'; ?>
</body>
</html>