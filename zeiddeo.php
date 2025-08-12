<?php
ob_start();
session_start();
require_once 'db.php';

// Logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: zeiddeo.php");
    exit;
}

// Login handling
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    if (isset($_POST['login'])) {
        $username = trim($_POST['username']);
        $password = $_POST['password'];
        $stmt = $pdo->prepare("SELECT * FROM zied WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $username;
            header("Location: zeiddeo.php");
            exit;
        } else {
            $loginError = "Invalid username or password.";
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="en"><head><meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"></head>
    <body>
    <div class="container mt-5"><div class="row justify-content-center"><div class="col-md-4">
    <div class="card shadow">
        <div class="card-header text-center bg-primary text-white"><h3>Admin Login</h3></div>
        <div class="card-body">
        <?php if (isset($loginError)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($loginError) ?></div>
        <?php endif; ?>
        <form method="post" action="zeiddeo.php">
            <div class="mb-3"><label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required></div>
            <div class="mb-3"><label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required></div>
            <div class="d-grid">
                <input type="submit" name="login" value="Login" class="btn btn-primary">
            </div>
        </form>
        </div></div></div></div></div></body></html>
    <?php exit;
}

function deleteFile($filePath) {
    if (file_exists($filePath)) {
        unlink($filePath);
    }
}

$current_tab = $_GET['tab'] ?? 'trainings';

// ========== TRAININGS SUBMISSION ==========
if (isset($_POST['submit_training'])) {
    $sr_no = (int) $_POST['sr_no'];
    $course_title = trim($_POST['course_title']);
    $training_year = (int) $_POST['training_year'];
    $start_date = $_POST['training_start_date'];
    $end_date = $_POST['training_end_date'];
    $training_dates = $end_date ? "$start_date - $end_date" : $start_date;
    $post_report_link = trim($_POST['post_report_link']);
    $gallery_link = trim($_POST['gallery_link']);

    try {
        if (!empty($_POST['training_id'])) {
            $stmt = $pdo->prepare("UPDATE trainings SET sr_no=?, course_title=?, training_year=?, training_dates=?, post_report_link=?, gallery_link=? WHERE id=?");
            $stmt->execute([$sr_no, $course_title, $training_year, $training_dates, $post_report_link, $gallery_link, $_POST['training_id']]);
            $trainingMessage = "Training updated.";
        } else {
            $stmt = $pdo->prepare("INSERT INTO trainings (sr_no, course_title, training_year, training_dates, post_report_link, gallery_link) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$sr_no, $course_title, $training_year, $training_dates, $post_report_link, $gallery_link]);
            $trainingMessage = "Training added.";
        }
    } catch (PDOException $e) {
        if ($e->getCode() === '23000') {
            $trainingMessage = "Error: Serial number $sr_no already exists for year $training_year.";
        } else {
            throw $e;
        }
    }
}

// ========== TRAINING DELETE ==========
if (isset($_GET['action']) && $_GET['action'] === 'delete_training' && isset($_GET['id'])) {
    $stmt = $pdo->prepare("DELETE FROM trainings WHERE id=?");
    $stmt->execute([$_GET['id']]);
    header("Location: zeiddeo.php?tab=trainings");
    exit;
}

// ========== RESOURCE PERSONS SUBMISSION ==========
if (isset($_POST['submit_resource'])) {
    $name = trim($_POST['name']);
    $designation = trim($_POST['designation']);
    $organization = trim($_POST['organization']);

    $uploadDir = "images/institutions/zied/resource_persons/";
    $picturePath = '';
    if (!empty($_FILES['picture']['name'])) {
        $ext = strtolower(pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($ext, $allowed)) {
            $newName = uniqid("res_", true) . "." . $ext;
            $destination = $uploadDir . $newName;
            if (move_uploaded_file($_FILES['picture']['tmp_name'], $destination)) {
                $picturePath = $destination;
            }
        }
    }

    if (!empty($_POST['resource_id'])) {
        $id = $_POST['resource_id'];
        if ($picturePath) {
            $stmt = $pdo->prepare("SELECT picture FROM resource_persons WHERE id=?");
            $stmt->execute([$id]);
            deleteFile($stmt->fetchColumn());
        } else {
            $stmt = $pdo->prepare("SELECT picture FROM resource_persons WHERE id=?");
            $stmt->execute([$id]);
            $picturePath = $stmt->fetchColumn();
        }

        $stmt = $pdo->prepare("UPDATE resource_persons SET name=?, designation=?, organization=?, picture=? WHERE id=?");
        $stmt->execute([$name, $designation, $organization, $picturePath, $id]);
        $resourceMessage = "Updated successfully.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO resource_persons (name, designation, organization, picture) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $designation, $organization, $picturePath]);
        $resourceMessage = "Resource person added.";
    }
}

// ========== RESOURCE PERSON DELETE ==========
if (isset($_GET['action']) && $_GET['action'] === 'delete_resource' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT picture FROM resource_persons WHERE id=?");
    $stmt->execute([$id]);
    deleteFile($stmt->fetchColumn());
    $pdo->prepare("DELETE FROM resource_persons WHERE id=?")->execute([$id]);
    header("Location: zeiddeo.php?tab=resources");
    exit;
}
// ==================== EDIT FETCHING ====================
$editTraining = null;
$editResource = null;
if (isset($_GET['action']) && $_GET['action'] === 'edit_training' && isset($_GET['id'])) {
    $stmt = $pdo->prepare("SELECT * FROM trainings WHERE id=?");
    $stmt->execute([$_GET['id']]);
    $editTraining = $stmt->fetch(PDO::FETCH_ASSOC);
}
if (isset($_GET['action']) && $_GET['action'] === 'edit_resource' && isset($_GET['id'])) {
    $stmt = $pdo->prepare("SELECT * FROM resource_persons WHERE id=?");
    $stmt->execute([$_GET['id']]);
    $editResource = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>ZEID Admin Panel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container-fluid mt-4">
  <div class="card shadow">
    <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
      <div>
        <h5 class="mb-0">ZEID Admin Panel</h5>
        <small>Welcome, <?= htmlspecialchars($_SESSION['username']) ?></small>
      </div>
      <a href="zeiddeo.php?logout=true" class="btn btn-outline-light btn-sm">Logout</a>
    </div>
    <div class="card-body">
      <ul class="nav nav-tabs mb-4">
        <li class="nav-item">
          <a class="nav-link <?= $current_tab == 'trainings' ? 'active' : '' ?>" href="?tab=trainings">Trainings</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= $current_tab == 'resources' ? 'active' : '' ?>" href="?tab=resources">Resource Persons</a>
        </li>
      </ul>

      <?php if ($current_tab == 'trainings'): ?>
        <h5><?= $editTraining ? "Edit Training" : "Add New Training" ?></h5>
        <?php if (isset($trainingMessage)): ?>
          <div class="alert alert-info"><?= $trainingMessage ?></div>
        <?php endif; ?>

        <form method="post">
          <?php if ($editTraining): ?>
            <input type="hidden" name="training_id" value="<?= $editTraining['id'] ?>">
          <?php endif; ?>

          <div class="row g-3 mb-3">
            <div class="col-md-2">
              <label class="form-label">Sr. No</label>
              <input type="number" class="form-control" name="sr_no" required value="<?= htmlspecialchars($editTraining['sr_no'] ?? '') ?>">
            </div>
            <div class="col-md-5">
              <label class="form-label">Course Title</label>
              <input type="text" class="form-control" name="course_title" required value="<?= htmlspecialchars($editTraining['course_title'] ?? '') ?>">
            </div>
            <div class="col-md-2">
              <label class="form-label">Year</label>
              <input type="number" class="form-control" name="training_year" required value="<?= htmlspecialchars($editTraining['training_year'] ?? date('Y')) ?>">
            </div>
            <div class="col-md-3">
              <label class="form-label">Dates</label>
              <div class="d-flex gap-2">
                <?php
                $start = '';
                $end = '';
                if (isset($editTraining)) {
                  $parts = explode(' - ', $editTraining['training_dates']);
                  $start = $parts[0];
                  $end = $parts[1] ?? '';
                }
                ?>
                <input type="date" name="training_start_date" class="form-control" value="<?= $start ?>" required>
                <input type="date" name="training_end_date" class="form-control" value="<?= $end ?>">
              </div>
            </div>
          </div>

          <div class="row g-3 mb-3">
            <div class="col-md-6">
              <label class="form-label">Post Training Report Link</label>
              <input type="url" name="post_report_link" class="form-control" value="<?= htmlspecialchars($editTraining['post_report_link'] ?? '') ?>" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Gallery Link</label>
              <input type="url" name="gallery_link" class="form-control" value="<?= htmlspecialchars($editTraining['gallery_link'] ?? '') ?>" required>
            </div>
          </div>

          <div class="d-grid mb-4">
            <button type="submit" name="submit_training" class="btn btn-success">Save Training</button>
          </div>
        </form>

        <!-- TRAINING TABLE -->
        <hr />
        <h6>Existing Trainings</h6>
        <?php
        $years = $pdo->query("SELECT DISTINCT training_year FROM trainings ORDER BY training_year DESC")->fetchAll(PDO::FETCH_COLUMN);
        foreach ($years as $year):
          $stmt = $pdo->prepare("SELECT * FROM trainings WHERE training_year = ? ORDER BY sr_no DESC");
          $stmt->execute([$year]);
          $trainings = $stmt->fetchAll();
        ?>
        <div class="mt-4">
          <h6 class="text-muted text-center">Trainings in <?= $year ?></h6>
          <div class="table-responsive">
            <table class="table table-bordered align-middle text-center">
              <thead class="table-success">
                <tr>
                  <th>Sr. No</th>
                  <th>Title</th>
                  <th>Dates</th>
                  <th>Report</th>
                  <th>Gallery</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
              <?php if (count($trainings)):
                $displaySr = 1;
                foreach ($trainings as $tr): ?>
                <tr>
                  <td><?= $displaySr++ ?></td>
                  <td><?= htmlspecialchars($tr['course_title']) ?></td>
                  <td><?= htmlspecialchars(str_replace(' - ', ' to ', $tr['training_dates'])) ?></td>
                  <td><a href="<?= htmlspecialchars($tr['post_report_link']) ?>" target="_blank" class="btn btn-outline-success btn-sm">Report</a></td>
                  <td><a href="<?= htmlspecialchars($tr['gallery_link']) ?>" target="_blank" class="btn btn-outline-primary btn-sm">Gallery</a></td>
                  <td>
                    <a href="?tab=trainings&action=edit_training&id=<?= $tr['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="?tab=trainings&action=delete_training&id=<?= $tr['id'] ?>" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">Delete</a>
                  </td>
                </tr>
              <?php endforeach; else: ?>
                <tr><td colspan="6">No trainings found</td></tr>
              <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
        <?php endforeach; ?>
      <?php endif; ?>

      <!-- RESOURCE PERSONS -->
      <?php if ($current_tab === 'resources'): ?>
        <h5><?= $editResource ? 'Edit Resource' : 'Add New Resource' ?></h5>
        <?php if (isset($resourceMessage)): ?>
          <div class="alert alert-info"><?= $resourceMessage ?></div>
        <?php endif; ?>
        <form method="post" enctype="multipart/form-data" class="mb-4">
          <?php if ($editResource): ?>
            <input type="hidden" name="resource_id" value="<?= $editResource['id'] ?>">
          <?php endif; ?>
          <div class="row g-3">
            <div class="col-md-4">
              <label class="form-label">Name</label>
              <input type="text" name="name" class="form-control" required value="<?= $editResource['name'] ?? '' ?>">
            </div>
            <div class="col-md-4">
              <label class="form-label">Designation</label>
              <input type="text" name="designation" class="form-control" required value="<?= $editResource['designation'] ?? '' ?>">
            </div>
            <div class="col-md-4">
              <label class="form-label">Organization</label>
              <input type="text" name="organization" class="form-control" required value="<?= $editResource['organization'] ?? '' ?>">
            </div>
            <div class="col-md-6">
              <label class="form-label">Picture</label>
              <input type="file" name="picture" class="form-control" <?= $editResource ? '' : 'required' ?>>
              <?php if ($editResource && $editResource['picture']): ?>
                <small class="text-muted">Current: <?= basename($editResource['picture']) ?></small>
              <?php endif; ?>
            </div>
            <div class="col-md-6 align-self-end">
              <button type="submit" name="submit_resource" class="btn btn-success"><?= $editResource ? 'Update' : 'Add' ?> Resource</button>
            </div>
          </div>
        </form>

        <!-- RESOURCE TABLE -->
        <h6>Existing Resource Persons</h6>
        <table class="table table-bordered text-center align-middle">
          <thead class="table-success">
            <tr><th>Name</th><th>Designation</th><th>Organization</th><th>Picture</th><th>Actions</th></tr>
          </thead>
          <tbody>
          <?php
          $resources = $pdo->query("SELECT * FROM resource_persons ORDER BY name")->fetchAll();
          if ($resources): foreach ($resources as $r): ?>
            <tr>
              <td><?= htmlspecialchars($r['name']) ?></td>
              <td><?= htmlspecialchars($r['designation']) ?></td>
              <td><?= htmlspecialchars($r['organization']) ?></td>
              <td>
                <?php if ($r['picture']): ?>
                  <img src="<?= htmlspecialchars($r['picture']) ?>" style="max-height:60px;">
                <?php endif; ?>
              </td>
              <td>
                <a href="?tab=resources&action=edit_resource&id=<?= $r['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="?tab=resources&action=delete_resource&id=<?= $r['id'] ?>" onclick="return confirm('Delete this resource?')" class="btn btn-danger btn-sm">Delete</a>
              </td>
            </tr>
          <?php endforeach; else: ?>
            <tr><td colspan="5">No resource persons found.</td></tr>
          <?php endif; ?>
          </tbody>
        </table>
      <?php endif; ?>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
