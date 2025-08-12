<?php
// dashboard.php
ob_start();

// Secure error handling for production
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/logs/error.log');
error_reporting(E_ALL);

// Constants for institution types
define('INST_TYPE_SCHOOL', 0);
define('INST_TYPE_COLLEGE', 1);

// Queries class for SQL organization
class Queries
{
    public static function getRegionSummary()
    {
        return "
            SELECT 
                r.id,
                r.name AS region,
                COUNT(i.id) AS total,
                SUM(CASE WHEN i.is_college = :school THEN 1 ELSE 0 END) AS schools,
                SUM(CASE WHEN i.is_college = :college THEN 1 ELSE 0 END) AS colleges
            FROM regions r
            LEFT JOIN institutions i ON i.region_id = r.id
            GROUP BY r.id, r.name
        ";
    }

    public static function getAllInstitutions()
    {
        return "
            SELECT 
                i.*,
                r.name AS region,
                GROUP_CONCAT(c.name SEPARATOR ', ') AS categories
            FROM institutions i
            JOIN regions r ON r.id = i.region_id
            JOIN institution_categories ic ON ic.institution_id = i.id
            JOIN school_categories c ON c.id = ic.category_id
            GROUP BY i.id
            ORDER BY i.inst_code
        ";
    }

    public static function getRegions()
    {
        return "SELECT id, name FROM regions ORDER BY name";
    }
}

// Include database connection
try {
    if (!file_exists('db.php')) {
        throw new Exception('Database configuration file not found.');
    }
    require_once 'db.php'; // Assumes $pdo is defined
} catch (Exception $e) {
    error_log($e->getMessage());
    echo "<div class='alert alert-danger'>System error. Please contact support.</div>";
    exit;
}

// Fetch data
try {
    // 1) Fetch regions for filter dropdown
    $stmt = $pdo->prepare(Queries::getRegions());
    $stmt->execute();
    $regions = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // 2) Fetch summary per region
    $stmt = $pdo->prepare(Queries::getRegionSummary());
    $stmt->execute([
        ':school' => INST_TYPE_SCHOOL,
        ':college' => INST_TYPE_COLLEGE
    ]);
    $summary = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // 3) Compute overall totals
    $overall = ['total' => 0, 'schools' => 0, 'colleges' => 0];
    foreach ($summary as $row) {
        $overall['total'] += $row['total'];
        $overall['schools'] += $row['schools'];
        $overall['colleges'] += $row['colleges'];
    }

    // 4) Fetch full institution list
    $stmt = $pdo->prepare(Queries::getAllInstitutions());
    $stmt->execute();
    $allInst = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log($e->getMessage());
    echo "<div class='alert alert-danger'>Unable to fetch data. Please try again later.</div>";
    exit;
}

// End output buffering
ob_end_flush();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Institution Data Entry Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/fgeiwsstyle.css">
    <style>
        /* Summary cards */
        .summary-card {
            transition: transform .2s;
        }

        .summary-card:hover {
            transform: translateY(-5px);
        }

        /* Thumbnail */
        .inst-thumb {
            width: 100px;
            height: 70px;
            object-fit: cover;
            margin-right: 12px;
            float: left;
            border-radius: 4px;
            border: 1px solid #ddd;
        }

        .inst-info {
            overflow: hidden;
        }

        /* Filter styling */
        .filter-container {
            max-width: 300px;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container py-4">
        <h1 class="mb-4 text-center">Institutions Data Update Summary</h1>

        <!-- Summary Cards -->
        <section class="row mb-4" aria-label="Overall summary">
            <div class="col-12">
                <div class="card summary-card shadow-sm border-primary" role="region" aria-label="Overall institution statistics">
                    <div class="card-body text-center d-flex justify-content-around">
                        <p class="mb-1"><strong>Total:</strong> <?= htmlspecialchars($overall['total']) ?></p>
                        <p class="mb-1 text-success"><strong>Schools:</strong> <?= htmlspecialchars($overall['schools']) ?></p>
                        <p class="mb-0 text-primary"><strong>Colleges:</strong> <?= htmlspecialchars($overall['colleges']) ?></p>
                    </div>
                </div>
            </div>
        </section>
        <div class="row g-3 mb-5">
            <?php foreach ($summary as $row): ?>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card summary-card shadow-sm" role="region" aria-label="<?= htmlspecialchars($row['region']) ?> statistics">
                        <div class="card-body text-center">
                            <h5 class="card-title"><?= htmlspecialchars($row['region']) ?></h5>
                            <p class="mb-1"><strong>Total:</strong> <?= htmlspecialchars($row['total']) ?></p>
                            <p class="mb-1 text-success"><strong>Schools:</strong> <?= htmlspecialchars($row['schools']) ?></p>
                            <p class="mb-0 text-primary"><strong>Colleges:</strong> <?= htmlspecialchars($row['colleges']) ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Region Filter and Institution Table -->
        <div class="card">
            <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                <strong>All Institutions</strong>
                <div class="filter-container">
                    <label for="regionFilter" class="form-label visually-hidden">Filter by Region</label>
                    <select id="regionFilter" class="form-select form-select-sm" aria-label="Filter institutions by region">
                        <option value="">All Regions</option>
                        <?php foreach ($regions as $region): ?>
                            <option value="<?= htmlspecialchars($region['name']) ?>"><?= htmlspecialchars($region['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="card-body p-0">
                <table id="institutionTable" class="display table table-hover mb-0" style="width:100%">
                    <thead class="table-light">
                        <tr>
                            <th>Sr. no</th>
                            <th>Institution</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $sr = 1;
                        foreach ($allInst as $i): ?>
                            <tr data-region="<?= htmlspecialchars($i['region']) ?>">
                                <td><?= $sr++ ?></td>
                                <td>
                                    <?php
                                    $image = !empty($i['image']) ? filter_var($i['image'], FILTER_SANITIZE_URL) : 'images/placeholder.jpg';
                                    ?>
                                    <img src="<?= htmlspecialchars($image) ?>" alt="<?= htmlspecialchars($i['name']) ?>" class="inst-thumb" loading="lazy">
                                    <div class="inst-info">
                                        <strong><?= htmlspecialchars($i['inst_code']) ?></strong><br>
                                        <?= htmlspecialchars($i['name']) ?><br>
                                        <small class="text-muted">
                                            <?= htmlspecialchars($i['region']) ?> — <?= htmlspecialchars($i['city']) ?>
                                        </small>
                                    </div>
                                </td>
                                <td>
                                    <div><strong>Type:</strong> <?= $i['is_college'] ? 'College' : 'School' ?></div>
                                    <div><strong>Category:</strong> <?= htmlspecialchars($i['categories']) ?></div>
                                    <div><strong>Shift:</strong> <?= htmlspecialchars(ucfirst($i['shift'])) ?></div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- jQuery & DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            const table = $('#institutionTable').DataTable({
                pageLength: 25,
                lengthMenu: [
                    [10, 25, 50],
                    [10, 25, 50]
                ],
                columnDefs: [{
                    orderable: false,
                    targets: 0
                }],
                // For scalability, consider server-side processing:
                // serverSide: true,
                // ajax: 'ajax_institutions.php'
            });

            // Region filter
            $('#regionFilter').on('change', function() {
                const region = $(this).val();
                table.column(1).search(region, true, false).draw();
            });
        });
    </script>
</body>

</html>