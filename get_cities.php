<?php
// get_cities.php
ob_start();
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

require_once 'db.php';

// 1) Read inputs
$type     = (isset($_GET['type']) && $_GET['type'] === 'colleges') ? 1 : 0;
$cat_id   = isset($_GET['cat_id']) ? (int)$_GET['cat_id'] : 0;
$regionId = isset($_GET['region_id']) ? (int)$_GET['region_id'] : 0;

// 2) Build SQL to fetch distinct cities
$params = [$type, $regionId];
if ($cat_id > 0) {
    // If category filter is active, join the mapping table
    $sql = "
      SELECT DISTINCT i.city
        FROM institutions i
        JOIN institution_categories ic ON ic.institution_id = i.id
       WHERE i.is_college = ?
         AND ic.category_id = ?
         AND i.region_id = ?
         AND i.city <> ''
       ORDER BY i.city
    ";
    $params = [$type, $cat_id, $regionId];
} else {
    $sql = "
      SELECT DISTINCT i.city
        FROM institutions i
       WHERE i.is_college = ?
         AND i.region_id = ?
         AND i.city <> ''
       ORDER BY i.city
    ";
}

// 3) Execute and return JSON
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$cities = $stmt->fetchAll(PDO::FETCH_COLUMN);

// 4) Output JSON array of strings
header('Content-Type: application/json');
echo json_encode($cities);
