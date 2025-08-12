<?php
// category.php
ob_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'db.php';

// 1) Read basics
$type   = (isset($_GET['type']) && $_GET['type'] === 'colleges') ? 1 : 0;
$cat_id = isset($_GET['cat_id']) ? (int)$_GET['cat_id'] : 0;

// 2) Read filter inputs
$q_name   = trim($_GET['q_name']   ?? '');
$q_region = (int)($_GET['q_region'] ?? 0);
$q_city   = trim($_GET['q_city']   ?? '');

// 3) Determine heading ($catName)
$col = $type ? 'is_for_college' : 'is_for_school';
if ($cat_id > 0) {
  $stmt = $pdo->prepare("
      SELECT name 
        FROM school_categories 
       WHERE id = ? 
         AND {$col} = 1
    ");
  $stmt->execute([$cat_id]);
  $catName = $stmt->fetchColumn() ?: 'Category';
} else {
  $catName = $type ? 'All Colleges' : 'All Schools';
}

// 4) Fetch all regions (for region dropdown & grouping)
$regions = $pdo->query("SELECT id, name FROM regions")->fetchAll();

// 5) Fetch distinct cities, making sure placeholders = params
// ----------------------------------------------------------
$cityParams = [];
$citySql    = "SELECT DISTINCT i.city
                 FROM institutions i ";

// If filtering by category, join institution_categories
if ($cat_id > 0) {
  $citySql    .= " JOIN institution_categories ic ON ic.institution_id = i.id ";
}

// Start WHERE clause
$citySql    .= " WHERE i.is_college = ?";
$cityParams[] = $type;

// Category filter
if ($cat_id > 0) {
  $citySql    .= " AND ic.category_id = ?";
  $cityParams[] = $cat_id;
}

// Region filter
if ($q_region > 0) {
  $citySql    .= " AND i.region_id = ?";
  $cityParams[] = $q_region;
}

// Only non-empty cities
$citySql    .= " AND i.city <> '' 
                   ORDER BY i.city";

$cityStmt = $pdo->prepare($citySql);
$cityStmt->execute($cityParams);
$cities = $cityStmt->fetchAll(PDO::FETCH_COLUMN);

// 6) Build the region list with all filters applied
// --------------------------------------------------
$regParams = [];
$regSql    = "
  SELECT DISTINCT r.id, r.name
    FROM regions r
    JOIN institutions i ON i.region_id = r.id ";

// If filtering by category, join institution_categories
if ($cat_id > 0) {
  $regSql    .= " JOIN institution_categories ic ON ic.institution_id = i.id ";
}

// Base WHERE: filter by type
$regSql    .= " WHERE i.is_college = ?";
$regParams[] = $type;

// Category filter
if ($cat_id > 0) {
  $regSql    .= " AND ic.category_id = ?";
  $regParams[] = $cat_id;
}
// Name filter
if ($q_name !== '') {
  $regSql    .= " AND i.name LIKE ?";
  $regParams[] = "%{$q_name}%";
}
// Region filter
if ($q_region > 0) {
  $regSql    .= " AND r.id = ?";
  $regParams[] = $q_region;
}
// City filter
if ($q_city !== '') {
  $regSql    .= " AND i.city = ?";
  $regParams[] = $q_city;
}

$regSql    .= " ORDER BY r.id";

$regionStmt = $pdo->prepare($regSql);
$regionStmt->execute($regParams);
$regionsWithInst = $regionStmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($catName) ?></title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="description" content="Welcome to Federal Government Educational Institutions , also known as FGEI. Explore educational programs, initiatives, and information about our institutions.">
  <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">

  <link rel="stylesheet" href="css/fgeiwsstyle.css">
</head>

<body>
  <?php require_once "testheader2.php"; ?>

  <section class="py-4">
    <div class="container">
      <h2 class="text-center fw-bold fs-2 mb-4"><?= htmlspecialchars($catName) ?></h2>

      <!-- Filter Form -->
      <form method="get" class="row g-3 mb-4">
        <input type="hidden" name="type" value="<?= $type ? 'colleges' : 'schools' ?>">
        <input type="hidden" name="cat_id" value="<?= $cat_id ?>">

        <!-- Name filter -->
        <div class="col-md-4">
          <label for="q_name" class="form-label">Name contains</label>
          <input type="text" id="q_name" name="q_name"
            value="<?= htmlspecialchars($q_name) ?>"
            class="form-control" placeholder="Search name…">
        </div>

        <!-- Region filter -->
        <div class="col-md-3">
          <label for="q_region" class="form-label">Region</label>
          <select id="q_region" name="q_region" class="form-select">
            <option value="0">All Regions</option>
            <?php foreach ($regions as $r): ?>
              <option value="<?= $r['id'] ?>"
                <?= $r['id'] === $q_region ? 'selected' : '' ?>>
                <?= htmlspecialchars($r['name']) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <!-- City filter (populated server-side initially) -->
        <div class="col-md-3">
          <label for="q_city" class="form-label">City</label>
          <select id="q_city" name="q_city" class="form-select">
            <option value="">All Cities</option>
            <?php foreach ($cities as $city): ?>
              <option value="<?= htmlspecialchars($city) ?>"
                <?= $city === $q_city ? 'selected' : '' ?>>
                <?= htmlspecialchars($city) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <!-- Submit button -->
        <div class="col-md-2 d-flex align-items-end">
          <button type="submit" class="btn btn-primary w-100">Filter</button>
        </div>
      </form>

      <?php if (empty($regionsWithInst)): ?>
        <p class="text-center text-muted">No institutions found.</p>
      <?php endif; ?>

      <!-- Institutions grouped by region -->
      <?php foreach ($regionsWithInst as $r): ?>
        <h4 class="mt-4 text-center fw-bold fs-4 mb-4">
          <?= htmlspecialchars($r['name']) ?> Region
        </h4>
        <div class="row row-cols-1 row-cols-md-2 gy-3">
          <?php
          // Inner query: fetch institutions for this region
          $instParams = [];
          $instSql    = "SELECT i.* FROM institutions i ";

          if ($cat_id > 0) {
            $instSql    .= " JOIN institution_categories ic ON ic.institution_id = i.id ";
          }
          $instSql    .= " WHERE i.is_college = ?";
          $instParams[] = $type;

          if ($cat_id > 0) {
            $instSql    .= " AND ic.category_id = ?";
            $instParams[] = $cat_id;
          }

          $instSql    .= " AND i.region_id = ?";
          $instParams[] = $r['id'];

          if ($q_name !== '') {
            $instSql    .= " AND i.name LIKE ?";
            $instParams[] = "%{$q_name}%";
          }
          if ($q_city !== '') {
            $instSql    .= " AND i.city = ?";
            $instParams[] = $q_city;
          }

          $instSql   .= " ORDER BY i.inst_code";

          $instStmt  = $pdo->prepare($instSql);
          $instStmt->execute($instParams);

          while ($inst = $instStmt->fetch()):
          ?>
            <div class="col">
              <div class="card h-100 shadow-sm">
                <?php if ($inst['image']): ?>
                  <img src="<?= htmlspecialchars($inst['image']) ?>"
                    class="card-img-top"
                    style="height:320px;object-fit:fill;"
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

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script>
    // When Region changes, reload City dropdown via AJAX
    document.getElementById('q_region').addEventListener('change', function() {
      var regionId = this.value;
      var type = '<?= $type ? 'colleges' : 'schools' ?>';
      var catId = '<?= $cat_id ?>';

      if (!regionId) {
        // If “All Regions” is selected, reset City to just “All Cities”
        document.getElementById('q_city').innerHTML = '<option value="">All Cities</option>';
        return;
      }

      // Otherwise fetch matching cities
      var xhr = new XMLHttpRequest();
      xhr.open('GET', 'get_cities.php?type=' +
        encodeURIComponent(type) +
        '&cat_id=' + encodeURIComponent(catId) +
        '&region_id=' + encodeURIComponent(regionId),
        true);
      xhr.onload = function() {
        if (xhr.status === 200) {
          var data = JSON.parse(xhr.responseText);
          var options = '<option value="">All Cities</option>';
          data.forEach(function(city) {
            options += '<option value="' + city + '">' + city + '</option>';
          });
          document.getElementById('q_city').innerHTML = options;
        }
      };
      xhr.send();
    });
  </script>

</body>

</html>