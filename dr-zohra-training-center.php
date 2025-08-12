<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Federal Government Educational Institutions</title>
    <meta name="description" content="Welcome to Federal Government Educational Institutions (C/G), also known as FGEI-(C/G). Explore educational programs, initiatives, and information about our institutions.">

    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">

    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- custom css -->
    <link rel="stylesheet" href="css/fgeiwsstyle.css">

</head>

<body>

    <!-- ==============================================
    ** Header **
    =================================================== -->
    <?php require_once "testheader2.php" ?>


    <div class="slider-wraper owl-carousel owl-theme" id="hero-slider">
        <div class="slide1 min-vh-80 bg-cover">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                    </div>
                </div>
            </div>
        </div>
        <div class="slide2 min-vh-80 bg-cover d-flex align-items-end">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="text-center text-white fw-bold Display-4 pb-5">Prof Aziz Ali Najam</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="slide3 min-vh-80 bg-cover">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                    </div>
                </div>
            </div>
        </div>
        <div class="slide4 min-vh-80 bg-cover d-flex align-items-end">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="text-center text-white fw-bold Display-4 pb-5">Brig Shahid Yaqub Abbasi Dir (SA) Addressing the Participants of Trg</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="slide5 min-vh-80 bg-cover d-flex align-items-end">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="text-center text-white fw-bold Display-4 pb-5">Inauguration Ceremony of National University of Pakistan (NUP)</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section>
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-12 mb-4">
                    <div class="card h-100 shadow-sm">
                        <img src="images/institutions/zied/1.jpeg" class="card-img-top" alt="Computer Lab">
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6 mb-4">
                    <div class="card h-100 shadow-sm">
                        <img src="images/institutions/zied/1.1.jpeg" class="card-img-top" alt="Main Hall">
                    </div>
                </div>

                <div class="col-md-6 mb-4">
                    <div class="card h-100 shadow-sm">
                        <img src="images/institutions/zied/1.2.jpg" class="card-img-top" alt="Computer Lab">
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Facilities Section -->
    <section class="py-4 bg-light">
        <div class="container">
            <div class="row text-center mb-4">
                <div class="col">
                    <h2 class="fw-bold section-heading">Facilities</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <img src="images/institutions/zied/main-hall.jpg" class="card-img-top" alt="Main Hall">
                        <div class="card-body text-center">
                            <h4 class="card-title">Main Hall</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <img src="images/institutions/zied/library.jpg" class="card-img-top" alt="Library">
                        <div class="card-body text-center">
                            <h4 class="card-title">Library</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <img src="images/institutions/zied/computer-lab.jpg" class="card-img-top" alt="Computer Lab">
                        <div class="card-body text-center">
                            <h4 class="card-title">Computer Lab</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Resource Persons Section -->
    <?php
    // Include the database connection file
    require_once 'db.php';

    // Query resource persons from the database ordered by name.
    $stmt = $pdo->query("SELECT * FROM resource_persons ORDER BY name ASC");
    $resourcePersons = $stmt->fetchAll();
    ?>

    <section class="py-4">
        <div class="container">
            <div class="row text-center mb-4">
                <div class="col">
                    <h2 class="fw-bold section-heading">Resource Persons</h2>
                </div>
            </div>

            <div class="owl-carousel owl-theme" id="resource-persons">
                <?php foreach ($resourcePersons as $person): ?>
                    <div class="item">
                        <div class="col">
                            <div class="card mx-auto p-2 shadow-sm team h-100 d-flex flex-column">
                                <?php if (!empty($person['picture'])): ?>
                                    <img
                                        src="<?php echo htmlspecialchars($person['picture']); ?>"
                                        alt="<?php echo htmlspecialchars($person['name']); ?>"
                                        class="card-img-top object-fit-cover"
                                        style="height: 250px;">
                                <?php else: ?>
                                    <img
                                        src="path/to/default-image.jpg"
                                        alt="Default Image"
                                        class="card-img-top object-fit-cover"
                                        style="height: 250px;">
                                <?php endif; ?>
                                <div class="card-body text-center mt-auto d-flex flex-column justify-content-between">
                                    <h5 class="card-title mb-1"><?php echo htmlspecialchars($person['name']); ?></h5>
                                    <p class="card-text small text-muted mb-1">
                                        <?php echo htmlspecialchars($person['designation']); ?>
                                    </p>
                                    <p class="card-text small text-muted mb-0">
                                        <?php echo htmlspecialchars($person['organization']); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Optional Caption -->
            <div class="text-center mt-3">
                <p class="text-muted">
                    Our team of expert resource persons brings diverse expertise to educational development.
                </p>
            </div>
        </div>
    </section>

    <!-- ==============================================
    ** Trainings Section - Dynamic by Year **
    =================================================== -->

    <?php
    require_once 'db.php';

    // Fetch distinct training years in descending order.
    $yearStmt = $pdo->query("SELECT DISTINCT training_year FROM trainings ORDER BY training_year DESC");
    $years = $yearStmt->fetchAll(PDO::FETCH_COLUMN);

    foreach ($years as $year) {
        $displaySr = 1;
        echo "<section id='trainings-$year'>";
        echo "  <div class='container-fluid py-3'>";
        echo "      <h2 class='text-center mb-4 text-muted fw-bold'>Trainings Conducted in $year</h2>";
        echo "      <div class='table-responsive'>";
        echo "      <table class='table table-bordered text-center align-middle' style='table-layout: fixed; width: 100%;'>";
        echo "        <colgroup>
                  <col style='width: 5%;'>   <!-- Sr. No -->
                  <col style='width: 63%;'>   <!-- Course Title -->
                  <col style='width: 12%;'>   <!-- Dates -->
                  <col style='width: 10%;'>   <!-- Post Trg Report -->
                  <col style='width: 10%;'>   <!-- Gallery -->
                </colgroup>";
        echo "          <thead class='table-success'>";
        echo "              <tr>
                            <th class='fs-5'>Sr. No</th>
                            <th class='fs-5'>Course Title</th>
                            <th class='fs-5'>Dates</th>
                            <th class='fs-5'>Post Trg Report</th>
                            <th class='fs-5'>Gallery</th>
                          </tr>";
        echo "          </thead>";
        echo "          <tbody>";

        $stmt = $pdo->prepare("SELECT * FROM trainings WHERE training_year = ? ORDER BY sr_no DESC");
        $stmt->execute([$year]);
        $trainings = $stmt->fetchAll();

        if (count($trainings) > 0) {
            foreach ($trainings as $training) {
                
                // Split the stored dates (e.g. "2025-01-15 - 2025-01-18")
                $parts = explode(' - ', $training['training_dates']);
                $formatted = [];

                foreach ($parts as $p) {
                    $dt = DateTime::createFromFormat('Y-m-d', trim($p));
                    // Fallback: if parsing fails, keep original
                    $formatted[] = $dt ? $dt->format('d-m-Y') : trim($p);
                }

                // Join with " to "
                $displayDates = implode(' to ', $formatted);

                echo "<tr>
                        <td class='fs-6'>" . $displaySr++ . "</td>
                        <td class='fs-6'>" . htmlspecialchars($training['course_title']) . "</td>
                        <td class='fs-6'>" . htmlspecialchars($displayDates) . "</td>
                        <td class='fs-6'>
                          <a href='" . htmlspecialchars($training['post_report_link']) . "'
                             class='btn btn-outline-success btn-sm w-100' target='_blank'>
                             View Report
                          </a>
                        </td>
                        <td class='fs-6'>
                          <a href='" . htmlspecialchars($training['gallery_link']) . "'
                             class='btn btn-outline-primary btn-sm w-100' target='_blank'>
                             View Gallery
                          </a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5' class='fs-6'>No Training data available for $year.</td></tr>";
        }

        echo "          </tbody>";
        echo "      </table>";
        echo "  </div>";
        echo "  </div>";
        echo "</section>";
    }
    ?>

    <!-- jQuery (required for Owl Carousel) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Owl Carousel JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function() {
            $("#hero-slider").owlCarousel({
                loop: true,
                items: 1,
                dots: false,
                autoplay: true,
                smartSpeed: 1600
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#resource-persons").owlCarousel({
                loop: true,

                dots: false,
                autoplay: true,
                autoplayTimeout: 3000,
                responsive: {
                    0: {
                        items: 1
                    },
                    576: {
                        items: 2
                    },
                    768: {
                        items: 3
                    },
                    992: {
                        items: 4
                    },
                    1200: {
                        items: 5
                    }
                }
            });
        });
    </script>

    <!-- ==============================================
    ** Footer **
    =================================================== -->
    <?php require_once "newfooter.php" ?>

</body>

</html>