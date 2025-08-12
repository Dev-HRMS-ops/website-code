<?php
ob_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once 'db.php';

// ─── Logout ──────────────────────────────────────────────────────────────────
if (isset($_GET['logout'])) {
    unset($_SESSION['admin_user']);
    session_destroy();
    header("Location: admin_login.php");
    exit;
}

// ─── Auth ────────────────────────────────────────────────────────────────────
if (empty($_SESSION['admin_user'])) {
    header("Location: admin_login.php");
    exit;
}

// ─── CSRF ────────────────────────────────────────────────────────────────────
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf = $_SESSION['csrf_token'];

// ─── Helpers ─────────────────────────────────────────────────────────────────
function deleteFile(string $path): void
{
    if ($path && file_exists($path)) unlink($path);
}

// ─── Load Regions & Categories ───────────────────────────────────────────────
$regions = $pdo->query("
    SELECT id, name
      FROM regions
")->fetchAll();

$catsAll = $pdo->query("
    SELECT id, name, is_for_school, is_for_college
      FROM school_categories
     
")->fetchAll();

// ─── Feedback Messages ───────────────────────────────────────────────────────
$msg    = $_GET['msg'] ?? '';
$alerts = [
    'added'    => ['success', 'Institution added successfully.'],
    'updated'  => ['success', 'Institution updated successfully.'],
    'deleted'  => ['warning', 'Institution deleted.'],
    'err_csrf' => ['danger', 'Invalid form submission (CSRF).'],
    'err_file' => ['danger', 'Invalid or too large image file.'],
];
$alert = $alerts[$msg] ?? null;

// ─── Handle Delete ───────────────────────────────────────────────────────────
if (isset($_GET['delete'])) {
    $delId = (int)$_GET['delete'];
    $img   = $pdo->prepare("SELECT image FROM institutions WHERE id=:id");
    $img->execute([':id' => $delId]);
    deleteFile($img->fetchColumn());
    $pdo->prepare("DELETE FROM institutions WHERE id=:id")
        ->execute([':id' => $delId]);
    header("Location: admin_portal.php?msg=deleted");
    exit;
}

// ─── Handle Add/Edit ─────────────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_inst'])) {
    // CSRF
    if (!hash_equals($csrf, $_POST['csrf_token'] ?? '')) {
        header("Location: admin_portal.php?msg=err_csrf");
        exit;
    }

    // Collect inputs
    $id            = $_POST['inst_id'] ?? null;
    $instCode      = trim($_POST['inst_code']        ?? '');
    $name          = trim($_POST['name']             ?? '');
    $phone         = trim($_POST['phone']            ?? '');
    $email         = trim($_POST['email']            ?? '');
    $teacherStr    = trim($_POST['teacher_strength'] ?? '');
    $studentStr    = trim($_POST['student_strength'] ?? '');
    $regionId      = (int)($_POST['region_id']       ?? 0);
    $isCollege     = isset($_POST['is_college']) ? 1 : 0;
    $shift         = $_POST['shift']  ?? '';
    $city          = trim($_POST['city']             ?? '');

    // If editing, fetch existing image
    $existingImage = null;
    if ($id) {
        $stmt = $pdo->prepare("SELECT image FROM institutions WHERE id=:id");
        $stmt->execute([':id' => $id]);
        $existingImage = $stmt->fetchColumn();
    }

    // Validation
    $errors = [];
    if ($instCode === '')    $errors[] = 'Institution Code is required.';
    if ($name === '')        $errors[] = 'Name is required.';
    if ($phone === '')       $errors[] = 'Phone is required.';
    if ($email === '')       $errors[] = 'Email is required.';
    if ($teacherStr === '' || !ctype_digit($teacherStr))
        $errors[] = 'Teacher strength must be a number.';
    if ($studentStr === '' || !ctype_digit($studentStr))
        $errors[] = 'Student strength must be a number.';
    if ($regionId <= 0)      $errors[] = 'Please select a Region.';
    if (!in_array($shift, ['morning', 'evening'], true))
        $errors[] = 'Please select a valid Shift.';
    if ($city === '')        $errors[] = 'City is required.';

    // Unique inst_code
    if ($instCode !== '') {
        $dup = $pdo->prepare("
            SELECT COUNT(*) FROM institutions
             WHERE inst_code=:code AND id!=:id
        ");
        $dup->execute([
            ':code' => $instCode,
            ':id'  => $id ? (int)$id : 0
        ]);
        if ($dup->fetchColumn() > 0) {
            $errors[] = "Institution Code “{$instCode}” is already in use.";
        }
    }

    // Category selection
    if ($isCollege) {
        if (empty($_POST['cat_id'])) {
            $errors[] = 'Please select a College category.';
        }
    } else {
        if (empty($_POST['cat_ids']) || !is_array($_POST['cat_ids'])) {
            $errors[] = 'Please check at least one School category.';
        }
    }

    // Image requirement
    if (empty($_FILES['image']['name']) && !$existingImage) {
        $errors[] = 'Please upload an Image (max 1 MB).';
    }

    // If errors, set alert
    if (!empty($errors)) {
        $alert = ['danger', implode('<br>', $errors)];
    } else {
        // Image upload
        $imagePath = '';
        if (!empty($_FILES['image']['name'])) {
            $info = getimagesize($_FILES['image']['tmp_name']);
            if (
                $_FILES['image']['size'] <= 1048576
                && $info
                && in_array($info['mime'], ['image/jpeg', 'image/png', 'image/gif'], true)
            ) {
                $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
                $uniq = uniqid('inst_', true) . ".$ext";
                $rStmt = $pdo->prepare("SELECT name FROM regions WHERE id=:rid");
                $rStmt->execute([':rid' => $regionId]);
                $rName = preg_replace('/[^A-Za-z0-9_]/', '_', $rStmt->fetchColumn());
                $folder = "images/institutions/{$rName}_region/";
                if (!is_dir($folder)) mkdir($folder, 0755, true);
                $dest = $folder . $uniq;
                move_uploaded_file($_FILES['image']['tmp_name'], $dest);
                if ($existingImage && file_exists($existingImage)) {
                    unlink($existingImage);
                }
                $imagePath = $dest;
            } else {
                header("Location: admin_portal.php?msg=err_file");
                exit;
            }
        }

        // Build INSERT or UPDATE
        if ($id) {
            $sql = "
                UPDATE institutions
                   SET inst_code=:code,
                       name=:name,
                       phone=:phone,
                       email=:email,
                       teacher_strength=:ts,
                       student_strength=:ss,
                       region_id=:region,
                       is_college=:isCollege,
                       image=:image,
                       shift=:shift,
                       city=:city
                 WHERE id=:id
            ";
            $params = [
                ':code' => $instCode,
                ':name' => $name,
                ':phone' => $phone,
                ':email' => $email,
                ':ts' => (int)$teacherStr,
                ':ss' => (int)$studentStr,
                ':region' => $regionId,
                ':isCollege' => $isCollege,
                ':image' => $imagePath ?: $existingImage,
                ':shift' => $shift,
                ':city' => $city,
                ':id' => $id
            ];
        } else {
            $sql = "
                INSERT INTO institutions
                  (inst_code,name,phone,email,teacher_strength,student_strength,
                   region_id,is_college,image,shift,city)
                VALUES
                  (:code,:name,:phone,:email,:ts,:ss,
                   :region,:isCollege,:image,:shift,:city)
            ";
            $params = [
                ':code' => $instCode,
                ':name' => $name,
                ':phone' => $phone,
                ':email' => $email,
                ':ts' => (int)$teacherStr,
                ':ss' => (int)$studentStr,
                ':region' => $regionId,
                ':isCollege' => $isCollege,
                ':image' => $imagePath,
                ':shift' => $shift,
                ':city' => $city
            ];
        }
        // Execute
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        $newId = $id ?: $pdo->lastInsertId();

        // Refresh categories
        $pdo->prepare("
            DELETE FROM institution_categories
             WHERE institution_id=:iid
        ")->execute([':iid' => $newId]);

        if ($isCollege) {
            $pdo->prepare("
                INSERT INTO institution_categories
                  (institution_id,category_id)
                VALUES
                  (:iid,:cid)
            ")->execute([
                ':iid' => $newId,
                ':cid' => (int)$_POST['cat_id']
            ]);
        } else {
            $vals = [];
            foreach ($_POST['cat_ids'] as $cid) {
                $vals[] = "({$newId}," . (int)$cid . ")";
            }
            $pdo->exec(
                "
                INSERT INTO institution_categories
                  (institution_id,category_id)
                VALUES " . implode(',', $vals)
            );
        }

        header("Location: admin_portal.php?msg=" . ($id ? 'updated' : 'added'));
        exit;
    }
}

// ─── Load for Edit ────────────────────────────────────────────────────────────
$edit = null;
$existingCats = [];
if (isset($_GET['edit'])) {
    $eid = (int)$_GET['edit'];
    $stmt = $pdo->prepare("SELECT * FROM institutions WHERE id=:id");
    $stmt->execute([':id' => $eid]);
    $edit = $stmt->fetch();
    $cstmt = $pdo->prepare("
        SELECT category_id
          FROM institution_categories
         WHERE institution_id=:id
    ");
    $cstmt->execute([':id' => $eid]);
    $existingCats = $cstmt->fetchAll(PDO::FETCH_COLUMN);
}
$isCollege = $edit['is_college'] ?? 0;

// ─── Filters ─────────────────────────────────────────────────────────────────
$q_name     = trim($_GET['q_name']     ?? '');
$q_type     = $_GET['q_type']         ?? '';
$q_region   = (int)($_GET['q_region'] ?? 0);
$q_category = (int)($_GET['q_category'] ?? 0);
$q_city     = trim($_GET['q_city']    ?? '');

// Fetch city list for region filter
$cityStmt = $pdo->prepare("
    SELECT DISTINCT city
      FROM institutions
     WHERE city<>''    
     ORDER BY city
");
$cityStmt->execute();
$cities = $cityStmt->fetchAll(PDO::FETCH_COLUMN);

// Build WHERE for listing
$where = [];
$params = [];
if ($q_name !== '') {
    $where[] = "i.name LIKE :name";
    $params[':name'] = "%{$q_name}%";
}
if ($q_type === '0' || $q_type === '1') {
    $where[] = "i.is_college=:type";
    $params[':type'] = $q_type;
}
if ($q_region) {
    $where[] = "i.region_id=:reg";
    $params[':reg'] = $q_region;
}
if ($q_city !== '') {
    $where[] = "i.city=:city";
    $params[':city'] = $q_city;
}
if ($q_category) {
    $where[] = "ic.category_id=:cat";
    $params[':cat'] = $q_category;
}
$whereSql = $where ? 'WHERE ' . implode(' AND ', $where) : '';

// ─── Fetch All for DataTables ────────────────────────────────────────────────
$dataSql = "
  SELECT i.*, r.name AS region,
         GROUP_CONCAT(c.name SEPARATOR ', ') AS cats
    FROM institutions i
    JOIN regions r               ON r.id=i.region_id
    JOIN institution_categories ic ON ic.institution_id=i.id
    JOIN school_categories c     ON c.id=ic.category_id
  {$whereSql}
 GROUP BY i.id
 ORDER BY i.inst_code
";
$stmt = $pdo->prepare($dataSql);
$stmt->execute($params);
$all = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Portal</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link href="css/fgeiwsstyle.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css" rel="stylesheet">
</head>

<body>
    <?php require 'testheader2.php'; ?>
    <div class="container py-4">
        <div class="d-flex justify-content-between">
            <h2>Admin Portal</h2>
            <a href="?logout=1" class="btn btn-outline-danger">Logout</a>
        </div>
        <?php if ($alert): ?>
            <div class="alert alert-<?= $alert[0] ?> mt-3"><?= $alert[1] ?></div>
        <?php endif; ?>

        <a href="admin_slides.php" class="btn btn-secondary mb-3">Manage Sliders</a>

        <!-- Add/Edit Form -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-success text-white"><?= $edit ? 'Edit' : 'Add New' ?> Institution</div>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data" novalidate>
                    <input type="hidden" name="csrf_token" value="<?= $csrf ?>">
                    <?php if ($edit): ?><input type="hidden" name="inst_id" value="<?= $edit['id'] ?>"><?php endif; ?>

                    <div class="row g-3">
                        <div class="col-md-2">
                            <label for="inst_code" class="form-label">Inst Code</label>
                            <input id="inst_code" name="inst_code" class="form-control" required
                                value="<?= htmlspecialchars($edit['inst_code'] ?? '') ?>">
                        </div>
                        <div class="col-md-4">
                            <label for="name" class="form-label">Name</label>
                            <input id="name" name="name" class="form-control" required
                                value="<?= htmlspecialchars($edit['name'] ?? '') ?>">
                        </div>
                        <div class="col-md-2">
                            <label for="phone" class="form-label">Phone</label>
                            <input id="phone" name="phone" class="form-control" required
                                value="<?= htmlspecialchars($edit['phone'] ?? '') ?>">
                        </div>
                        <div class="col-md-4">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" name="email" class="form-control" required
                                value="<?= htmlspecialchars($edit['email'] ?? '') ?>">
                        </div>
                        <div class="col-md-2">
                            <label for="teacher_strength" class="form-label">Teachers</label>
                            <input id="teacher_strength" name="teacher_strength" type="number" class="form-control" required
                                value="<?= htmlspecialchars($edit['teacher_strength'] ?? '') ?>">
                        </div>
                        <div class="col-md-2">
                            <label for="student_strength" class="form-label">Students</label>
                            <input id="student_strength" name="student_strength" type="number" class="form-control" required
                                value="<?= htmlspecialchars($edit['student_strength'] ?? '') ?>">
                        </div>
                        <div class="col-md-4">
                            <label for="region_id" class="form-label">Region</label>
                            <select id="region_id" name="region_id" class="form-select" required>
                                <option value="">Select region</option>
                                <?php foreach ($regions as $r): ?>
                                    <option value="<?= $r['id'] ?>" <?= ($edit['region_id'] ?? 0) == $r['id'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($r['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <div class="form-check">
                                <input id="is_college" name="is_college" type="checkbox" class="form-check-input"
                                    <?= $isCollege ? 'checked' : '' ?> aria-controls="schoolCats collegeCats">
                                <label for="is_college" class="form-check-label">Is College</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="image" class="form-label">Image (max 1 MB)</label>
                            <input id="image" name="image" type="file" class="form-control" accept="image/*">
                            <?php if (!empty($edit['image'])): ?>
                                <small class="text-muted">Current: <?= basename($edit['image']) ?></small>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-3">
                            <label for="shift" class="form-label">Shift</label>
                            <select id="shift" name="shift" class="form-select" required>
                                <option value="">Select shift</option>
                                <option value="morning" <?= ($edit['shift'] ?? '') === 'morning' ? 'selected' : '' ?>>Morning</option>
                                <option value="evening" <?= ($edit['shift'] ?? '') === 'evening' ? 'selected' : '' ?>>Evening</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="city" class="form-label">City</label>
                            <input id="city" name="city" class="form-control" required
                                value="<?= htmlspecialchars($edit['city'] ?? '') ?>">
                        </div>
                    </div>

                    <div class="mt-4">
                        <div id="schoolCats" class="<?= $isCollege ? 'd-none' : '' ?>">
                            <label class="form-label">School Categories</label><br>
                            <?php foreach ($catsAll as $cat): if ($cat['is_for_school']): ?>
                                    <div class="form-check form-check-inline">
                                        <input name="cat_ids[]" type="checkbox" class="form-check-input"
                                            value="<?= $cat['id'] ?>" <?= in_array($cat['id'], $existingCats) ? 'checked' : '' ?>>
                                        <label class="form-check-label"><?= htmlspecialchars($cat['name']) ?></label>
                                    </div>
                            <?php endif;
                            endforeach; ?>
                        </div>
                        <div id="collegeCats" class="<?= $isCollege ? '' : 'd-none' ?>">
                            <label class="form-label">College Category</label>
                            <select name="cat_id" class="form-select" required>
                                <option value="">Select</option>
                                <?php foreach ($catsAll as $cat): if ($cat['is_for_college']): ?>
                                        <option value="<?= $cat['id'] ?>" <?= in_array($cat['id'], $existingCats) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($cat['name']) ?>
                                        </option>
                                <?php endif;
                                endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <button name="save_inst" class="btn btn-primary mt-4">Save Institution</button>
                </form>
            </div>
        </div>

        <!-- Filter Form -->
        <form method="get" class="row g-2 mb-4 align-items-end">
            <div class="col-md-3">
                <label class="form-label">Name contains</label>
                <input name="q_name" class="form-control" value="<?= htmlspecialchars($q_name) ?>">
            </div>
            <div class="col-md-2">
                <label class="form-label">Type</label>
                <select name="q_type" class="form-select">
                    <option value="">Any</option>
                    <option value="0" <?= $q_type === '0' ? 'selected' : '' ?>>School</option>
                    <option value="1" <?= $q_type === '1' ? 'selected' : '' ?>>College</option>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">Region</label>
                <select name="q_region" class="form-select">
                    <option value="0">Any</option>
                    <?php foreach ($regions as $r): ?>
                        <option value="<?= $r['id'] ?>" <?= $r['id'] == $q_region ? 'selected' : '' ?>>
                            <?= htmlspecialchars($r['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">City</label>
                <select name="q_city" class="form-select">
                    <option value="">Any</option>
                    <?php foreach ($cities as $c): ?>
                        <option value="<?= htmlspecialchars($c) ?>" <?= $c === $q_city ? 'selected' : '' ?>>
                            <?= htmlspecialchars($c) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Category</label>
                <select name="q_category" class="form-select">
                    <option value="0">Any</option>
                    <?php foreach ($catsAll as $c): ?>
                        <option value="<?= $c['id'] ?>" <?= $c['id'] == $q_category ? 'selected' : '' ?>>
                            <?= htmlspecialchars($c['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
        </form>

        <!-- Institution List Table -->
        <table id="institutionTable" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Sr. no</th>
                    <th>Institution</th>
                    <th>Details</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $sr = 1;
                foreach ($all as $i): ?>
                    <tr>
                        <td><?= $sr++ ?></td>
                        <td>
                            <?php if ($i['image']): ?>
                                <img src="<?= htmlspecialchars($i['image']) ?>"
                                    style="width:100px;height:70px;object-fit:cover;float:left;margin-right:8px;">
                            <?php endif; ?>
                            <div style="overflow:hidden;">
                                <strong><?= htmlspecialchars($i['inst_code']) ?></strong><br>
                                <?= htmlspecialchars($i['name']) ?><br>
                                <small>
                                    <strong>Shift:</strong> <?= ucfirst($i['shift']) ?>
                                    <strong>City:</strong> <?= htmlspecialchars($i['city']) ?>
                                </small>
                            </div>
                        </td>
                        <td>
                            <div><strong>Type:</strong> <?= $i['is_college'] ? 'College' : 'School' ?></div>
                            <div><strong>Category:</strong> <?= htmlspecialchars($i['cats']) ?></div>
                            <div><strong>Region:</strong> <?= htmlspecialchars($i['region']) ?></div>
                        </td>
                        <td>
                            <a href="?edit=<?= $i['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="?delete=<?= $i['id'] ?>" class="btn btn-sm btn-danger"
                                onclick="return confirm('Delete this institution?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- JS Libraries -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script>
        // Toggle School/College categories
        document.getElementById('is_college').addEventListener('change', function() {
            document.getElementById('schoolCats')
                .classList.toggle('d-none', this.checked);
            document.getElementById('collegeCats')
                .classList.toggle('d-none', !this.checked);
        });

        // Initialize DataTable
        $(document).ready(function() {
            $('#institutionTable').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'csvHtml5',
                        text: 'Export CSV',
                        title: 'Institutions'
                    },
                    {
                        extend: 'excelHtml5',
                        text: 'Export Excel',
                        title: 'Institutions'
                    }
                ],
                columnDefs: [{
                    orderable: false,
                    targets: 3
                }]
            });
        });
    </script>
</body>

</html>
<?php ob_end_flush(); ?>