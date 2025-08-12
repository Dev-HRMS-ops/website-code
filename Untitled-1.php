<?php
require_once 'db.php';

$type   = ($_GET['type'] === 'colleges') ? 1 : 0;      // 1=college, 0=school
$cat_id = isset($_GET['cat_id']) ? (int)$_GET['cat_id'] : 0;

// Determine the heading
if ($cat_id > 0) {
    // Fetch category name
    $stmt = $pdo->prepare("SELECT name FROM school_categories WHERE id = ? AND is_for_? = 1");
    $stmt->execute([$cat_id, $type ? 'college' : 'school']);
    $catName = $stmt->fetchColumn() ?: 'Category';
} else {
    $catName = $type ? 'All Colleges' : 'All Schools';
}

// Fetch regions that have institutions of this type & (if cat_id>0) in this category
if ($cat_id > 0) {
    $stmt = $pdo->prepare("
      SELECT DISTINCT r.id, r.name
        FROM regions r
        JOIN institutions i   ON i.region_id = r.id
        JOIN institution_categories ic ON ic.institution_id = i.id
       WHERE i.is_college = ?
         AND ic.category_id = ?
       ORDER BY r.name
    ");
    $stmt->execute([$type, $cat_id]);
} else {
    // All of this type, no category filter
    $stmt = $pdo->prepare("
      SELECT DISTINCT r.id, r.name
        FROM regions r
        JOIN institutions i ON i.region_id = r.id
       WHERE i.is_college = ?
       ORDER BY r.name
    ");
    $stmt->execute([$type]);
}
$regions = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?= htmlspecialchars($catName) ?></title>
  <link rel="stylesheet" href="css/fgeiwsstyle.css">
</head>
<body>
  <?php require_once "testheader2.php"; ?>

  <section class="py-4">
    <div class="container">
      <h2 class="text-center fw-bold fs-2 mb-4"><?= htmlspecialchars($catName) ?></h2>

      <?php if (empty($regions)): ?>
        <p class="text-center text-muted">No institutions found.</p>
      <?php endif; ?>

      <?php foreach ($regions as $r): ?>
        <h4 class="mt-4 text-center fw-bold fs-4 mb-4">
          <?= htmlspecialchars($r['name']) ?> Region
        </h4>
        <div class="row row-cols-1 row-cols-md-2 gy-3">
          <?php
          // Build inner query based on whether cat_id>0
          if ($cat_id > 0) {
              $inner = $pdo->prepare("
                SELECT i.*
                  FROM institutions i
                  JOIN institution_categories ic ON ic.institution_id = i.id
                 WHERE i.is_college = ? 
                   AND ic.category_id = ? 
                   AND i.region_id = ?
                 ORDER BY i.name
              ");
              $inner->execute([$type, $cat_id, $r['id']]);
          } else {
              $inner = $pdo->prepare("
                SELECT i.*
                  FROM institutions i
                 WHERE i.is_college = ? 
                   AND i.region_id = ?
                 ORDER BY i.name
              ");
              $inner->execute([$type, $r['id']]);
          }
          while ($inst = $inner->fetch()):
          ?>
            <div class="col">
              <div class="card h-100 shadow-sm">
                <?php if ($inst['image']): ?>
                  <img src="<?= htmlspecialchars($inst['image']) ?>"
                       class="card-img-top"
                       style="height:340px;object-fit:cover;"
                       alt="<?= htmlspecialchars($inst['name']) ?>">
                <?php endif; ?>
                <div class="card-body">
                  <h4 class="card-title fw-bold"><?= htmlspecialchars($inst['name']) ?></h4>
                  <?php if ($inst['phone']): ?>
                    <p class="mb-1 fs-5"><strong>Phone:</strong> <?= htmlspecialchars($inst['phone']) ?></p>
                  <?php endif; ?>
                  <?php if ($inst['email']): ?>
                    <p class="mb-1 fs-5"><strong>Email:</strong> <?= htmlspecialchars($inst['email']) ?></p>
                  <?php endif; ?>
                  <?php if ($inst['teacher_strength']): ?>
                    <p class="mb-1 fs-5"><strong>Teachers:</strong> <?= $inst['teacher_strength'] ?></p>
                  <?php endif; ?>
                  <?php if ($inst['student_strength']): ?>
                    <p class="mb-1 fs-5"><strong>Students:</strong> <?= $inst['student_strength'] ?></p>
                  <?php endif; ?>
                  <?php if ($inst['shift']): ?>
                    <p class="mb-1 fs-5"><strong>Shift:</strong> <?= htmlspecialchars(ucfirst($inst['shift'])) ?></p>
                  <?php endif; ?>
                  <?php if ($inst['city']): ?>
                    <p class="mb-1 fs-5"><strong>City:</strong> <?= htmlspecialchars($inst['city']) ?></p>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          <?php endwhile; ?>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

  <?php require_once "newfooter.php"; ?>
</body>
</html>
