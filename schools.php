<?php
// schools-n.php
ob_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'db.php';


// 1) Fetch all school categories with institution counts
$stmt = $pdo->prepare("
  SELECT 
    sc.id, 
    sc.name, 
    COUNT(ic.institution_id) AS cnt
  FROM school_categories sc
  LEFT JOIN institution_categories ic 
    ON ic.category_id = sc.id
  LEFT JOIN institutions i
    ON i.id = ic.institution_id AND i.is_college = 0
  WHERE sc.is_for_school = 1
  GROUP BY sc.id, sc.name
");
$stmt->execute();
$categories = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>FGEI Schools</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Welcome to Federal Government Educational Institutions , also known as FGEI. Explore educational programs, initiatives, and information about our institutions.">
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/fgeiwsstyle.css">

    <style>
        
    </style>
</head>

<body class="bg-light">
    <?php require_once "testheader2.php"; ?>

    <!-- Hero Slider (if slides exist for this page) -->
    <?php require 'heroslider.php'; ?>
    
    <!-- Schools Grid -->
    <section class="py-5">
        <div class="container">
            <h1 class="text-center fw-bold fs-1 section-heading text-muted mb-4">FGEI Schools</h1>
            <p class="fs-4 text-center mb-5">
                FG Schools range from Primary through Higher Secondary. Click a category below:
            </p>

            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 gy-4">
                <!-- All Schools -->
                <div class="col">
                    <a href="category.php?type=schools" class="text-decoration-none text-dark" aria-label="View all schools">
                        <div class="text-center border border-4 border-clg-img p-3 rounded-3 d-flex flex-column h-100">
                            <img src="images/institutions/school-icon.png" class="img-fluid mx-auto" loading="lazy" alt="All Schools">
                            <h4 class="mt-3">All Schools</h4>
                        </div>
                    </a>
                </div>

                <!-- Category Tiles -->
                <?php foreach ($categories as $cat): ?>
                    <div class="col">
                        <a href="category.php?type=schools&cat_id=<?= urlencode($cat['id']) ?>" class="text-decoration-none text-dark" aria-label="View <?= htmlspecialchars($cat['name']) ?> schools">
                            <div class="text-center border border-4 border-clg-img p-3 rounded-3 d-flex flex-column h-100">
                                <img src="images/institutions/school-icon.png" class="img-fluid mx-auto" loading="lazy" alt="<?= htmlspecialchars($cat['name']) ?> Icon">
                                <h4 class="mt-3">
                                    <?= htmlspecialchars($cat['name']) ?>
                                    <span class="badge bg-secondary"><?= $cat['cnt'] ?></span>
                                </h4>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php require_once "newfooter.php"; ?>

</body>

</html>