<?php
// colleges-n.php
ob_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'db.php';

// 1) Fetch all college categories with institution counts
$stmt = $pdo->prepare("
  SELECT 
    sc.id, 
    sc.name, 
    COUNT(ic.institution_id) AS cnt
  FROM school_categories sc
  LEFT JOIN institution_categories ic 
    ON ic.category_id = sc.id
  LEFT JOIN institutions i
    ON i.id = ic.institution_id AND i.is_college = 1
  WHERE sc.is_for_college = 1
  GROUP BY sc.id, sc.name
  ORDER BY sc.name
");
$stmt->execute();
$categories = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>FGEI Colleges</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="Welcome to Federal Government Educational Institutions , also known as FGEI. Explore educational programs, initiatives, and information about our institutions.">
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">


    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/fgeiwsstyle.css">

<body class="bg-light">
    <?php require_once "testheader2.php"; ?>

    <!-- Hero Slider (if slides exist for this page) -->
    <?php require 'heroslider.php'; ?>
    
    <!-- Colleges Grid -->
    <section class="py-5">
        <div class="container">
            <h1 class="text-center fw-bold fs-1 section-heading text-muted mb-4">FGEI Colleges</h1>
            <p class="fs-4 text-center mb-5">
                There are three levels of FG Colleges. Click any to explore:
            </p>

            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 gy-4">
                <!-- All Colleges -->
                <div class="col">
                    <a href="category.php?type=colleges"
                        class="text-decoration-none text-dark"
                        aria-label="View all colleges">
                        <div class="text-center border border-4 border-clg-img p-3 rounded-3 d-flex flex-column h-100">
                            <img src="images/institutions/college-icon.png"
                                class="img-fluid mx-auto" loading="lazy"
                                alt="All Colleges">
                            <h4 class="mt-3">All Colleges</h4>
                        </div>
                    </a>
                </div>

                <!-- Individual College Categories -->
                <?php foreach ($categories as $cat):
                    $url = 'category.php?type=colleges&cat_id=' . urlencode($cat['id']);
                ?>
                    <div class="col">
                        <a href="<?= $url ?>"
                            class="text-decoration-none text-dark"
                            aria-label="View <?= htmlspecialchars($cat['name']) ?>">
                            <div class="text-center border border-4 border-clg-img p-3 rounded-3 d-flex flex-column h-100">
                                <?php
                                // You can map icons per category if desired:
                                $iconMap = [
                                    'Intermediate Colleges'  => 'images/institutions/college1.png',
                                    'Degree Colleges'        => 'images/institutions/graduation-cap.png',
                                    'Post-Graduate Colleges' => 'images/institutions/education.png'
                                ];
                                $icon = $iconMap[$cat['name']] ?? 'images/institutions/college-icon.png';
                                ?>
                                <img src="<?= htmlspecialchars($icon) ?>"
                                    class="img-fluid mx-auto" loading="lazy"
                                    alt="<?= htmlspecialchars($cat['name']) ?> Icon">
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