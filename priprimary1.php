<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Federal Government Educational Institutions</title>
    <meta name="description" content="Welcome to Federal Government Educational Institutions , also known as FGEI. Explore educational programs, initiatives, and information about our institutions.">

    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">

    <!-- fancybox css for image gallery -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />

    <!-- custom css -->
    <link rel="stylesheet" href="css/fgeiwsstyle.css">

</head>

<body>

    <!-- ==============================================
    ** Header **
    =================================================== -->
    <?php require_once "testheader2.php" ?>

    <section>
        <div class="container py-5">
            <div class="row">
                <img alt="DG FGEIs" src="images/initiatives/priprimary.png" class="img-fluid">
            </div>
        </div>
    </section>


    <section class="bg-clrd-sec">
        <div class="container py-3">
            <div class="row text-center mb-2">
                <h2 class="fw-bold fs-5 section-heading text-muted"><strong>Pre-Primary Schools</strong></h2>
                <h2 class="fw-bold fs-5 section-heading text-muted">Email: <strong>exam@gmail.com</strong></h2>
            </div>
        </div>
    </section>


    <section class="py-3">
        <div>
            <div class="row">
                <h2 class="text-center fw-bold fs-1 section-heading">Highlights</h2>
            </div>
        </div>
    </section>


    <!-- video gallery local -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <!-- <h2 class="text-center mb-3 fs-1 fw-bold">Highlights</h2> -->
                <div class="col-md-4">
                    <div class="ratio ratio-16x9">
                        <video loop muted controls>
                            <source src="videos/prep-1.mp4" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="ratio ratio-16x9">
                        <video loop muted controls>
                            <source src="videos/prep-2.mp4" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="ratio ratio-16x9">
                        <video loop muted controls>
                            <source src="videos/prep-3.mp4" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- image gallery -->


    <section class="py-5 bg-clrd-sec">
        <div class="container text-center">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 justify-content-center">

                <?php
                // Directory where images are stored
                $imageDir = 'images/preprimary/';

                // Get all image files from the directory
                $images = glob($imageDir . '*.{jpg,jpeg,png,gif,JPG,PNG,JPEG}', GLOB_BRACE);

                // Loop through each image and display it
                foreach ($images as $image) {
                    // Get the image name and URL
                    $imageURL = $image;
                    $imageName = basename($image);

                    // Display each image in an anchor tag for Fancybox
                    echo '
                        <div class="col">
                            <div class="img-wrapper p-2 h-100">
                                <a href="' . $imageURL . '" data-fancybox="gallery" data-caption="' . $imageName . '">
                                    <img src="' . $imageURL . '" alt="' . $imageName . '"   class="img-fluid h-100 img-thumbnail">
                                </a> 
                            </div>
                        </div>';
                }
                ?>

            </div>
        </div>
    </section>



    <section class="">
        <div class="container py-3">
            <div class="row text-center mb-2">
                <h3>Pre Primary Schools</h3>
                <p style="font-size: 22px;">To view Pre-Primary Schools <a href="https://fgei.gov.pk/category.php?type=schools&cat_id=1">Click here</a></p>
            </div>
        </div>
    </section>



    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <script src="js/gallery.js"></script>


    <!-- ==============================================
    ** Footer **
    =================================================== -->
    <?php require_once "newfooter.php" ?>

</body>

</html>