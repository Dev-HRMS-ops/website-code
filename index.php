<?php

// 1) Start session (if you need it)
session_start();

// 2) Load your PDO connection
require_once  'db.php';   // defines $pdo

// 3) Fetch Initiatives
$initiativesStmt = $pdo->query("
    SELECT id, title, titleimage, description, link
      FROM initiatives
     ORDER BY sequenceno
");
$initiatives = $initiativesStmt->fetchAll(PDO::FETCH_ASSOC);

// 4) Fetch News (most recent first)
$newsStmt = $pdo->query("
    SELECT *
      FROM news
     ORDER BY News_Id DESC
");
$News = $newsStmt->fetchAll(PDO::FETCH_ASSOC);

// 5) Fetch Achievements (most recent first)
$achvStmt = $pdo->query("
    SELECT *
      FROM achievements
     ORDER BY id DESC
");
$achievements = $achvStmt->fetchAll(PDO::FETCH_ASSOC);

// 6) Fetch single Visitors row
$userCountsStmt = $pdo->prepare("
    SELECT *
      FROM visitors
     WHERE id = :id
");
$userCountsStmt->execute([':id' => 1]);
$UserCounts = $userCountsStmt->fetch(PDO::FETCH_ASSOC);

// Now $initiatives, $News, $achievements (arrays) and $UserCounts (single row) are ready to use

// Fetch all school categories only (for dynamic Schools tab)
$stmt = $pdo->prepare("
    SELECT id, name
    FROM school_categories
    WHERE is_for_school = 1
");
$stmt->execute();
$schoolCategories = $stmt->fetchAll();

// Fetch all college categories only (for dynamic Colleges tab)
$stmt = $pdo->prepare("
    SELECT id, name
    FROM school_categories
    WHERE is_for_college = 1
");
$stmt->execute();
$collegeCategories = $stmt->fetchAll();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>Federal Government Educational Institutions</title>
    <meta name="description" content="Welcome to Federal Government Educational Institutions (C/G), also known as FGEI-(C/G). Explore educational programs, initiatives, and information about our institutions.">

    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.14.0/themes/base/jquery-ui.min.css" integrity="sha512-F8mgNaoH6SSws+tuDTveIu+hx6JkVcuLqTQ/S/KJaHJjGc8eUxIrBawMnasq2FDlfo7FYsD8buQXVwD+0upbcA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/> -->
    <link rel="stylesheet" href="css/jquery.flipster.css">
    <link rel="stylesheet" href="css/jquery.flipster.nav.css">

</head>

<body>

    <!-- ==============================================
    ** Header **
    =================================================== -->
    <?php require_once "testheader1.php" ?>

    <!-- DG's Message section -->
    <section id="dg-msg" class="bg-clrd-sec">
        <div class="container-fluid text-dark p-md-5 py-5">
            <div class="row align-items-center">
                <div class="col-sm-5 col-md-4 col-lg-3 align-self-center text-center">

                    <div class="row justify-content-center mb-2">
                        <!--<div class="col-auto"></div>-->
                        <img src="images/dgfgei.jpg" class="rounded-circle dgimg" />
                    </div>

                    <img src="images/2 stars.png" id="star" width="25%" height="25%" class="img-fluid">
                    <h5>Maj Gen Qaisar Suleman</h5>
                    <h5>Director General</h5>

                </div>

                <div class="col-sm-7 col-md-8 col-lg-9">
                    <div class="row text-center mb-2">
                        <h2 class="fw-bold fs-1">DG's Message</h2>
                    </div>
                    <p class="fs-5 text-indent">On behalf of the staff and students of Federal Government Educational
                        Institutions, I, the Director
                        General FGEI, zealously welcome you to our website. For the last many years, Federal Government
                        Educational Institutions have carved a distinctive niche in the education system of the country by
                        the tutelage and dissemination of valuable knowledge to hundreds of thousands of students. Being
                        mindful of the fact that education is the corner stone for the development and progress of our
                        country, our institutions are contributing by imparting quality education to a large segment of the
                        society....<a href="dg-message.php" class="text-decoration-none fs-6 carousel-btn d-inline-block">Read more</a><a href="mailto:complaint@fgei.gov.pk" class="d-inline-block text-decoration-none fs-6 carousel-btn ms-3 d-inline-block"><i class="bi bi-envelope-at-fill pe-2"></i>DG's Inbox</a></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Academia section -->
    <section>
        <div class="container py-5">
            <div class="row text-center row-cols-1 row-cols-md-3 g-4">

                <div class="col">
                    <a href="academic-calendar.php" class="text-decoration-none">
                        <div class="card h-100  mx-auto p-2 shadow">
                            <img src="images/academics.jpg" class="card-img-top card-img-top-ht border border-0 border-bottom border-dark-subtle pb-3" alt="ACADEMICS">
                            <div class="card-body">
                                <h5 class="card-title">ACADEMICS</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="eligibility-criteria.php" class="text-decoration-none">
                        <div class="card h-100  mx-auto p-2 shadow">
                            <img src="images/admission.png" class="card-img-top card-img-top-ht border border-0 border-bottom border-dark-subtle pb-3" alt="ADMISSIONS">
                            <div class="card-body">
                                <h5 class="card-title">ADMISSIONS</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="jobs.php" class="text-decoration-none" target="_blank">
                        <d class="card h-100  mx-auto p-2 shadow">
                            <img src="images/career1.png" class="card-img-top card-img-top-ht border border-0 border-bottom border-dark-subtle pb-3" alt="CAREERS">
                            <div class="card-body">
                                <h5 class="card-title">CAREERS</h5>
                            </div>
                        </d iv>
                    </a>
                </div>

            </div>
        </div>
    </section>

    <!-- News vision mission section -->

    <section class="bg-clrd-sec">
        <div class="container-fluid text-dark p-5">
            <div class="row align-items-center gx-5">
                <div class="col-md-3 align-self-center text-center border border-dark pe-0">
                    <div class="pe-3 overflow-auto" style="max-height: 360px;">
                        <h3 class="video-block">Latest News</h3>
                        
                        <ul class="widget-timeline pb-3 list-unstyled text-start">
                            <?php foreach ($News as $nw) { ?>
                                <li class="timeline-items timeline-icon-primary mb-3">
                                    <h5 class="mb-1" style="color: #FF9600;">
                                        <?= $nw["NewsTitle"] ?>
                                    </h5>
                                    <div>
                                        <h6 class="mb-0"><?= $nw['NewsDescription'] ?></h6>
                                    </div>
                                </li>
                                <?php } ?>
                            </ul>
                        </div>
                </div>

                <div class="col-md-6">
                    <div class="row text-center mb-2">
                        <h2 class="fw-bold fs-1">Mission</h2>
                    </div>
                    <p class="fs-5 text-indent">To equip the wards of Armed Forces
                        personnel as well as of civilians residing in cantonments/ garrisons throughout the country to be creative, dynamic
                        and useful members of society by providing an unparalleled and healthy educational environment,
                        rendering them an opportunity to get purposeful and quality education and fostering their skills so
                        that they may play an effective role in the progress of the country.</p>
                    <div class="row text-center mb-2">
                        <h2 class="fw-bold fs-1">Vision</h2>
                    </div>
                    <p class="fs-5 text-indent">Our vision is to forge strong, positive
                        connections with students so they can achieve independence, build confidence, and gain academic knowledge and to transform the FGEI's network into a matchless educational system of the country.</p>

                </div>

                <div class="col-md-3 align-self-center text-center border border-dark">

                    <h3 class="video-block">Achievements</h3>

                    <marquee behavior="scroll" onmouseover="this.stop();" onmouseout="this.start();" scrollamount="4" direction="up" height='360'>
                        <ul class="widget-timeline mb-0">
                            <?php
                            foreach ($achievements as $ach) {
                            ?>
                                <li class="timeline-items timeline-icon-primary">
                                    <h5 style="color: #FF9600;">
                                        <?= $ach["Title"] ?>
                                    </h5>
                                    <div>
                                        <h6> <?= $ach['Description'] ?> </h6>
                                    </div>
                                </li><br>
                            <?php
                            }
                            ?><br>
                        </ul>
                    </marquee>
                </div>
            </div>
        </div>
    </section>

    <!-- Regions Schools colleges section -->

    <section>
        <section id="desktop-version" class="p-5 d-none d-lg-block">
            <div id="index" class="container">
                <div class="row">
                    <div class="col-3">
                        <div class="d-flex align-items-start">
                            <div class="nav nav-tabs flex-column me-3" id="nav-tab" role="tablist" aria-orientation="vertical">
                                <a class="nav-link fs-2 fw-medium mb-1 active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Regional Offices</a>
                                <a class="nav-link fs-2 fw-medium mb-1" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Schools</a>
                                <a class="nav-link fs-2 fw-medium mb-1" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Colleges</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="tab-content h-100" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                                <!-- <h2 class="text-center my-3 fw-bold display-4">Regional Offices</h2> -->
                                <div class="row">
                                    <div class="col-md-4 mb-3 d-flex align-content-stretch"><a href="ro-peshawar.php" class="btn btn-institute px-2 py-3 fs-4 text-wrap fw-medium">peshawer Region</a></div>
                                    <div class="col-md-4 mb-3 d-flex align-content-stretch"><a href="ro-fazaia.php" class="btn btn-institute px-2 py-3 fs-4 text-wrap fw-medium">fazaia Region</a></div>
                                    <div class="col-md-4 mb-3 d-flex align-content-stretch"><a href="ro-wah.php" class="btn btn-institute px-2 py-3 fs-4 text-wrap fw-medium">wah Region</a></div>
                                    <div class="col-md-4 mb-3 d-flex align-content-stretch"><a href="ro-rawalpindi.php" class="btn btn-institute px-2 py-3 fs-4 text-wrap fw-medium">Rawalpindi Region</a></div>
                                    <div class="col-md-4 mb-3 d-flex align-content-stretch"><a href="ro-chaklala.php" class="btn btn-institute px-2 py-3 fs-4 text-wrap fw-medium">Chaklala Region</a></div>
                                    <div class="col-md-4 mb-3 d-flex align-content-stretch"><a href="ro-kharian.php" class="btn btn-institute px-2 py-3 fs-4 text-wrap fw-medium">Kharian Region</a></div>
                                    <div class="col-md-4 mb-3 d-flex align-content-stretch"><a href="ro-gujranwala.php" class="btn btn-institute px-2 py-3 fs-4 text-wrap fw-medium">Gujranwala Region</a></div>
                                    <div class="col-md-4 mb-3 d-flex align-content-stretch"><a href="ro-lahore.php" class="btn btn-institute px-2 py-3 fs-4 text-wrap fw-medium">Lahore Region</a></div>
                                    <div class="col-md-4 mb-3 d-flex align-content-stretch"><a href="ro-multan.php" class="btn btn-institute px-2 py-3 fs-4 text-wrap fw-medium">Multan Region</a></div>
                                    <div class="col-md-4 mb-3 d-flex align-content-stretch"><a href="ro-bahawalpur.php" class="btn btn-institute px-2 py-3 fs-4 text-wrap fw-medium">Bahawalpur Region</a></div>
                                    <div class="col-md-4 mb-3 d-flex align-content-stretch"><a href="ro-quetta.php" class="btn btn-institute px-2 py-3 fs-4 text-wrap fw-medium">Quetta Region</a></div>
                                    <div class="col-md-4 mb-3 d-flex align-content-stretch"><a href="ro-karachi.php" class="btn btn-institute px-2 py-3 fs-4 text-wrap fw-medium">Karachi Region</a></div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
                                <!-- <h2 class="text-center my-3 fw-bold display-4">Schools</h2> -->
                                <div class="row">
                                    
                                    <!-- Category Tiles -->
                                    <?php foreach ($schoolCategories as $cat): ?>
                                        <div class="col-md-4 mb-3 d-flex align-content-stretch">
                                            <a href="category.php?type=schools&cat_id=<?= urlencode($cat['id']) ?>" class="btn btn-institute px-2 py-3 fs-4 text-wrap fw-medium" aria-label="View <?= htmlspecialchars($cat['name']) ?> schools">
                                                <?= htmlspecialchars($cat['name']) ?>
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab" tabindex="0">
                                <!-- <h2 class="text-center my-3 fw-bold display-4">Colleges</h2> -->
                                <div class="row">
                                    
                                    <!-- Category Tiles -->
                                    <?php foreach ($collegeCategories as $cat): ?>
                                        <div class="col-md-4 mb-3 d-flex align-content-stretch">
                                            <a href="category.php?type=colleges&cat_id=<?= urlencode($cat['id']) ?>" class="btn btn-institute px-2 py-3 fs-4 text-wrap fw-medium" aria-label="View <?= htmlspecialchars($cat['name']) ?> colleges">
                                                <?= htmlspecialchars($cat['name']) ?>
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="mobile-version" class="p-5 d-block d-lg-none">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div id="accordion">
                            <h3 class="text-center fs-2 fw-medium mb-1">Regional Offices</h3>
                            <div class="px-2">
                                <div class="row g-0">
                                    <div class="col-12 mb-3"><a href="ro-peshawar.php" class="btn btn-institute px-1 fs-4 text-wrap fw-medium">peshawer Region</a></div>
                                    <div class="col-12 mb-3"><a href="ro-fazaia.php" class="btn btn-institute px-1 fs-4 text-wrap fw-medium">fazaia Region</a></div>
                                    <div class="col-12 mb-3"><a href="ro-wah.php" class="btn btn-institute px-1 fs-4 text-wrap fw-medium">wah Region</a></div>
                                    <div class="col-12 mb-3"><a href="ro-rawalpindi.php" class="btn btn-institute px-1 fs-4 text-wrap fw-medium">Rawalpindi Region</a></div>
                                    <div class="col-12 mb-3"><a href="ro-chaklala.php" class="btn btn-institute px-1 fs-4 text-wrap fw-medium">Chaklala Region</a></div>
                                    <div class="col-12 mb-3"><a href="ro-kharian.php" class="btn btn-institute px-1 fs-4 text-wrap fw-medium">Kharian Region</a></div>
                                    <div class="col-12 mb-3"><a href="ro-gujranwala.php" class="btn btn-institute px-1 fs-4 text-wrap fw-medium">Gujranwala Region</a></div>
                                    <div class="col-12 mb-3"><a href="ro-lahore.php" class="btn btn-institute px-1 fs-4 text-wrap fw-medium">Lahore Region</a></div>
                                    <div class="col-12 mb-3"><a href="ro-multan.php" class="btn btn-institute px-1 fs-4 text-wrap fw-medium">Multan Region</a></div>
                                    <div class="col-12 mb-3"><a href="ro-bahawalpur.php" class="btn btn-institute px-1 fs-4 text-wrap fw-medium">Bahawalpur Region</a></div>
                                    <div class="col-12 mb-3"><a href="ro-quetta.php" class="btn btn-institute px-1 fs-4 text-wrap fw-medium">Quetta Region</a></div>
                                    <div class="col-12 mb-3"><a href="ro-karachi.php" class="btn btn-institute px-1 fs-4 text-wrap fw-medium">Karachi Region</a></div>
                                </div>
                            </div>
                            <h3 class="text-center fs-2 fw-medium mb-1">Schools</h3>
                            <div class="px-2">
                                <div class="row g-0">
                                    <div class="col-12 mb-3"><a href="priprimary.php" class="btn btn-institute px-1 fs-4 text-wrap fw-medium">Pre Primary Schools</a></div>
                                    <div class="col-12 mb-3"><a href="primary.php" class="btn btn-institute px-1 fs-4 text-wrap fw-medium">Primary Schools (I–V)</a></div>
                                    <div class="col-12 mb-3"><a href="middle2.php" class="btn btn-institute px-1 fs-4 text-wrap fw-medium">Middle Schools (I–VIII)</a></div>
                                    <div class="col-12 mb-3"><a href="middle.php" class="btn btn-institute px-1 fs-4 text-wrap fw-medium">Middle Schools (VI–VIII)</a></div>
                                    <div class="col-12 mb-3"><a href="high2.php" class="btn btn-institute px-1 fs-4 text-wrap fw-medium">High Schools (I–X)</a></div>
                                    <div class="col-12 mb-3"><a href="high1.php" class="btn btn-institute px-1 fs-4 text-wrap fw-medium">High Schools (VI–X)</a></div>
                                    <div class="col-12 mb-3"><a href="high3.php" class="btn btn-institute px-1 fs-4 text-wrap fw-medium">Higher Secondary Schools (I–XII)</a></div>
                                </div>
                            </div>
                            <h3 class="text-center fs-2 fw-medium mb-1">Colleges</h3>
                            <div class="px-2">
                                <div class="row g-0">
                                    <div class="col-12 mb-3"><a href="intermediate.php" class="btn btn-institute px-1 fs-4 text-wrap fw-medium">Intermediate Colleges</a></div>
                                    <div class="col-12 mb-3"><a href="bachelors.php" class="btn btn-institute px-1 fs-4 text-wrap fw-medium">Degree Colleges</a></div>
                                    <div class="col-12 mb-3"><a href="masters.php" class="btn btn-institute px-1 fs-4 text-wrap fw-medium">Post Graduate Colleges</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>

    <!-- image gallery -->

    <section class="bg-clrd-sec py-5">

        <div id="my-flipster" class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <ul class="">

                        <?php
                        // Directory where images are stored
                        $imageDir = 'images/index-gallery/';

                        // Get all image files from the directory
                        $images = glob($imageDir . '*.{jpg,jpeg,png,gif,JPG,PNG,JPEG}', GLOB_BRACE);

                        // Loop through each image and display it
                        foreach ($images as $image) {
                            // Get the image name and URL
                            $imageURL = $image;
                            $imageName = basename($image);

                            // Display each image in an anchor tag for Fancybox
                            echo '
                                <li>
                                    
                                        <a href="' . $imageURL . '" data-fancybox="gallery" data-caption="' . $imageName . '">
                                            <img src="' . $imageURL . '" alt="' . $imageName . '"  class="img-fluid img-carsl img-thumbnail">
                                        </a> 
                                    
                                </li>';
                        }
                        ?>

                    </ul>
                </div>
            </div>

            <a href="#" class="flipto-prev"><i class='bi bi-caret-left-fill'></i></a>
            <a href="#" class="flipto-next"><i class='bi bi-caret-right-fill'></i></a>
        </div>

    </section>

    <!-- counter section -->

    <div class="counter text-center py-5">
        <div class="container">
            <div class="row g-3 justify-content-center">
                <div class="col-lg-3 col-md-6 col-9">
                    <div class="single-number d-flex justify-content-evenly m-1 p-3 border border-dark rounded-3 border-2">
                        <div class="icon-area align-self-center">
                            <img src="images/counter/visitor.png" class="img-fluid" alt="">
                        </div>
                        <div class="align-self-center">
                            <span id="counter1" class="digit-box d-block fw-bold fs-1">

                                <?php
                                if (isset($UserCounts['visitors'])) {
                                    echo htmlspecialchars($UserCounts['visitors']);
                                } else {
                                    echo '0';
                                }
                                ?>
                            </span>
                            <span class="databox  d-block fw-bold fs-2">Visitors</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-9">
                    <div class="single-number d-flex justify-content-evenly m-1 p-3 border border-dark rounded-3 border-2">
                        <div class="icon-area align-self-center">
                            <img src="images/counter/students.png" class="img-fluid" alt="">
                        </div>
                        <div class="align-self-center">
                            <span id="counter2" class="digit-box d-block fw-bold fs-1" data-val="197293">197293</span>
                            <span class="databox  d-block fw-bold fs-2">Students</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-9">
                    <div class="single-number d-flex justify-content-evenly m-1 p-3 border border-dark rounded-3 border-2">
                        <div class="icon-area align-self-center">
                            <img src="images/counter/school.png" class="img-fluid" alt="">
                        </div>
                        <div class="align-self-center">
                            <span id="counter3" class="digit-box d-block fw-bold fs-1" data-val="311">311</span>
                            <span class="databox  d-block fw-bold fs-2">Schools</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-9">
                    <div class="single-number d-flex justify-content-evenly m-1 p-3 border border-dark rounded-3 border-2">
                        <div class="icon-area align-self-center">
                            <img src="images/counter/college.png" class="img-fluid" alt="">
                        </div>
                        <div class="align-self-center">
                            <span id="counter4" class="digit-box d-block fw-bold fs-1" data-val="49">49</span>
                            <span class="databox  d-block fw-bold fs-2">Colleges</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FGEI Dte intro -->

    <section class="bg-clrd-sec">
        <div class="container py-5 text-center">
            <div class="row">
                <div class="col">
                    <h3 class="fw-bold fs-2">FGEI (C/G) DTE</h3>
                    <p class="fs-5 text-indent">Federal Government Educational Institutions Directorate (Cantonments/ Garrisons) is one of the directorates of the IGT&E’s Branch that is headed by the Director General of FGEI(C/G). The administrative structure of the directorate has been changed adding three Brigadiers in total of 12 subordinating Regional Offices to uplift the administrative standard of the overall organization, and to make it the most productive institutions of Pakistan. These Regional offices are located at Peshawar, Wah, Rawalpindi, Chaklala, Kharian, Lahore, Multan, Bahawalpur, Gujranwala, Karachi, Fazaia and Quetta (Regional Offices Gujranwala, Bahawalpur, Chaklala & Fazaia are working on ad-hoc basis).

                    </p>
                </div>
            </div>
        </div>
    </section>


    <!-- IT Projects container -->
    <section>
        <div class="container py-5 my-3">

            <div class="row text-center">
                <div id="projects-slider" class="owl-carousel">
                    <div class="item mx-3">
                        <div class="card h-100 p-3">
                            <div class="box front">
                                <img src="images/initiatives/E-Office_logo.png" alt="" class="card-img-top card-img-top-ht pb-2 border border-0 border-bottom border-dark-subtle">
                                <div class="card-body">
                                    <h5 class="card-title">E-Office</h5>
                                </div>
                            </div>
                            <div class="box back">
                                <i class="bi bi-quote"></i>
                                <p>
                                    E-Office is a digital solution that replaces manual file and document handling with an elec sys. To enable seamless comm and collaboration across cty’s wide scattered nature of FGEIs, E-Office was conceived in Mar 2023. The aim is to implement a paperless envmt for quick access to docus, timely disposal of cases with enhanced info sharing across secs/ brs and with ROs
                                </p>
                                <a href="eoffice.php" class="btn carousel-btn">Visit our Page</a>
                            </div>
                        </div>
                    </div>

                    <div class="item mx-3">
                        <div class="card h-100 p-3">
                            <div class="box front">
                                <img src="images/initiatives/hrms1.png" alt="" class="card-img-top card-img-top-ht pb-2 border border-0 border-bottom border-dark-subtle">
                                <div class="card-body">
                                    <h5 class="card-title">HRMS</h5>
                                </div>
                            </div>
                            <div class="box back">
                                <i class="bi bi-quote"></i>
                                <p>
                                    To manage the affairs of over 25000 HR (incl serving, retd, honorary and TVF) and almost 200,000 students, FGEI Dte has taken initiative towards dev of an efficient digitized sys with enhanced data accuracy and improved op efficiency.
                                </p>
                                <a href="https://hrms.fgei.gov.pk/" class="btn carousel-btn" target="_blank">Visit our Page</a>
                            </div>
                        </div>
                    </div>

                    <div class="item mx-3">
                        <div class="card h-100 p-3">
                            <div class="box front">
                                <img src="images/initiatives/Internship-Copy.png" alt="" class="card-img-top card-img-top-ht pb-2 border border-0 border-bottom border-dark-subtle">
                                <div class="card-body">
                                    <h5 class="card-title">Internship</h5>
                                </div>
                            </div>
                            <div class="box back">
                                <i class="bi bi-quote"></i>
                                <p>
                                    The sys is a digital platform designed to streamline the process for internees appls and ensure transparency.
                                </p>
                                <a href="internship/index.php" class="btn carousel-btn" target="_blank">Visit our Page</a>
                            </div>
                        </div>
                    </div>

                    <div class="item mx-3">
                        <div class="card h-100 p-3">
                            <div class="box front">
                                <img src="images/initiatives/induction1-Copy.png" alt="" class="card-img-top card-img-top-ht pb-2 border border-0 border-bottom border-dark-subtle">
                                <div class="card-body">
                                    <h5 class="card-title">Induction</h5>
                                </div>
                            </div>
                            <div class="box back">
                                <i class="bi bi-quote"></i>
                                <p>
                                    Induction is a permanent feature of FGEI. induction sys has been dev by FGEI Dte to auto and streamline the hiring process starting from advt till final interview and is in use.
                                </p>
                                <a href="jobs.php" class="btn carousel-btn" target="_blank">Visit our Page</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section class="bg-clrd-sec">
        <div class="container py-5">
            <div class="row justify-content-center">
                <h2 class="text-center fw-bold fs-1 pb-3">Sir Syed School and College of Special Education, Rawalpindi</h2>
                <p class="fs-4 text-indent">Sir Syed School and College of Special Education, Rawalpindi Established in 1955, stands as one of Pakistan's premier institution for around 600 students with disabilities It provides a comprehensive range of programs, from Nursery to a Bachelor of Fine Arts in Graphic Design, fostering an exclusive environment for boys and girls who are hard-of-hearing or speech-impaired. In Year 2024, the institution underwent major uplift, development and renovation initiatives led by the FGEI Directorate. This effort entirely revitalised the campus, enhancing its all academic and specialised facilities and establishing an Endowment Fund. A captivating short video illuminating these remarkable efforts has been prepared by ISPR and is being shared to showcase the Pakistan Army's contributions to society and dedication to the welfare of the people.</p>
                <div class="col col-md-8">
                    <div class="ratio ratio-16x9">
                        <iframe src="https://www.youtube.com/embed/Qi6Q8a7NFIo?si=bbnvIaApd0T645si"
                            title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- video gallery -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <h2 class="text-center mb-3 fs-1 fw-bold">Development Projects at FGEIs</h2>
                <div class="col col-md-8">
                    <div class="ratio ratio-16x9">
                        <iframe src="https://www.youtube.com/embed/dQptbAH6A_E?si=gU11KlRifCkkiEM2"
                            title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <a href="videogallery.php" class="text-center mt-2 btn carousel-btn w-auto">View More</a>
            </div>
        </div>
    </section>


    <!-- video gallery youtube-->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <!-- <h2 class="text-center mb-3 fs-1 fw-bold">Video Gallery</h2> -->
                <div class="col-md-4">
                    <div class="ratio ratio-16x9">
                        <iframe src="https://www.youtube.com/embed/KwL37eIDegU?si=ai8vLf-rAovh4uGn"
                            title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="ratio ratio-16x9">
                        <iframe src="https://www.youtube.com/embed/g3mvWgQrIuQ?si=SQoJEXyUZXK6WUed"
                            title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="ratio ratio-16x9">
                        <iframe src="https://www.youtube.com/embed/RJBRRqdr8Ls?si=2tDD7-IdpKAqexgr"
                            title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content shadow rounded">
                <div class="modal-header bg-primary text-white rounded-top">
                    <h5 class="modal-title" id="modalTitle">Vacancies Announced in FGEI (C/G) for Teaching and Non-Teaching Staff</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="pt-3">Applications are invited from Pakistani nationals for permanent posts of teaching and non-teaching staff in Federal Government Educational Institutions (Cantonments/Garrisons). Eligible candidates who fulfill the required qualifications, age, and quota criteria may apply according to the given instructions.</p>
                    <p class="pt-3 fw-bold fs-6">Last date to apply is: 23 SEPTEMBER 2025</p>
                    <!-- <a href="https://induction.fgei.gov.pk/" target="_blank" class="btn btn-outline-primary rounded-pill px-4"><i class="bi bi-box-arrow-in-right me-2"></i>Check Result</a> -->
                    <a href="https://drive.google.com/file/d/1-3-P8F-udI2zcDxf7nByFiMY6_2QAklr/view" target="_blank" class="btn btn-outline-success rounded-pill px-4">Advertisement</a>
                    <a href="https://induction.fgei.gov.pk/" target="_blank" class="btn btn-outline-primary rounded-pill px-4">Apply Here</a>
                    <!-- <a href="interview.php" class="btn btn-outline-primary rounded-pill px-4">Interview Schedule</a> -->
                </div>
                <div class="modal-footer bg-light rounded-bottom">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- News Modal -->
    <div class="modal fade" id="admissionModal" tabindex="-1" aria-labelledby="admissionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg"> <!-- modal-lg makes it wider -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="admissionModalLabel">Admission Notice</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img src="images/sssec-adm.jpeg" alt="Admission-Notice" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.14.0/jquery-ui.min.js" integrity="sha512-MlEyuwT6VkRXExjj8CdBKNgd+e2H+aYZOCUaCrt9KRk6MlZDOs91V1yK22rwm8aCIsb5Ec1euL8f0g58RKT/Pg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script> -->

    <script src="js/jquery.flipster.min.js"></script>
    <!-- <script src="js/imgswipper.js"></script> -->
    <script src="js/flipster-slider.js"></script>
    <script src="js/custom.js"></script>



    <script>
        $(function() {
            $("#accordion").accordion({
                collapsible: true,
                active: false,
                heightStyle: "content"
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var myModal = new bootstrap.Modal(document.getElementById('infoModal'));
            myModal.show();
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            if (window.innerWidth <= 992) {
                const dgMsgSection = document.getElementById("dg-msg");
                const stickyHeader = document.getElementById("mainNav");

                if (dgMsgSection && stickyHeader) {
                    setTimeout(() => {
                        const headerHeight = stickyHeader.offsetHeight;
                        const targetScrollTop = dgMsgSection.getBoundingClientRect().top + window.pageYOffset - headerHeight;

                        const duration = 1800; // in milliseconds
                        const start = window.pageYOffset;
                        const distance = targetScrollTop - start;
                        let startTime = null;

                        function linearScroll(timestamp) {
                            if (!startTime) startTime = timestamp;
                            const timeElapsed = timestamp - startTime;
                            const progress = Math.min(timeElapsed / duration, 1); // progress from 0 to 1 linearly

                            window.scrollTo(0, start + distance * progress);

                            if (timeElapsed < duration) {
                                requestAnimationFrame(linearScroll);
                            }
                        }

                        requestAnimationFrame(linearScroll);
                    }, 500); // Delay 1 second before scroll starts
                }
            }
        });
    </script>

    <!-- ==============================================
    ** Footer **
    =================================================== -->
    <?php require_once "newfooter.php" ?>

</body>

</html>