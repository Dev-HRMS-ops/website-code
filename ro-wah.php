<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Federal Government Educational Institutions</title>
    <meta name="description" content="Welcome to Federal Government Educational Institutions (C/G), also known as FGEI-(C/G). Explore educational programs, initiatives, and information about our institutions.">
        
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">
    
    <!-- fancybox css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"/>

    <!-- custom css -->
    <link rel="stylesheet" href="css/fgeiwsstyle.css"> 
    
</head>

<body>

    <!-- ==============================================
    ** Header **
    =================================================== -->
    <?php require_once "testheader2.php" ?>

    <section>
        <div class="container py-3">
            <div class="row">
                <h2 class="text-center fw-bold fs-1 section-heading">WAH REGION</h2>
            </div>
        </div>
    </section>
    
    <section>
        <div class="container-fluid region ro-wah">
            <!-- <div class="row">
                <img src="images/regionaloffices/Peshawar.jpg" alt="" class="img-fluid img-thumbnail">
            </div> -->
        </div>
    </section>
  
    <section class="bg-clrd-sec">
        <div class="container py-5">
            <div class="row">
                <p class="fs-4 text-indent">Having a 100% literacy rate, Wah is an exceptionally developed part of the country, thus very rightly termed as "An Island of Excellence". Regional Office Wah was established in 1984 to manage the functioning of FG Institutions of Wah, Taxila, Kamra and Havelian. It is the second largest region, comprising of 4 colleges (including a Postgraduate College) and 42 schools with 1400 faculty members and over 33000 students. The oldest institution is FG Model Public School Wah which was established in 1951 whereas FG Postgraduate College for Women Wah is the first college established in 1956. Wah Region can also boast of having the only “Teachers' Training Centre” of FG system, which is equipped with State-of-the-Art Infrastructure including language laboratory, computer laboratory, conference room and an excellent library.</p>

                <p class="fs-4">Phone #: 905522153-58</p>
            </div>
        </div>
    </section>

     <!-- image gallery -->

    <!-- <section class="py-5">
        <div class="container text-center">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 justify-content-center">
                <div class="col">
                    <div class="img-wrapper p-2 h-100">
                        <a href="images/institutions/wah/activities/1.png" data-fancybox="gallery">
                            <img src="images/institutions/wah/activities/1.png" alt="" class="img-fluid h-100 img-thumbnail">
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="img-wrapper p-2 h-100">
                        <a href="images/institutions/wah/activities/2.png" data-fancybox="gallery">
                            <img src="images/institutions/wah/activities/2.png" alt="" class="img-fluid h-100 img-thumbnail">
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="img-wrapper p-2 h-100">
                        <a href="images/institutions/wah/activities/3.png" data-fancybox="gallery">
                            <img src="images/institutions/wah/activities/3.png" alt="" class="img-fluid h-100 img-thumbnail">
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="img-wrapper p-2 h-100">
                        <a href="images/institutions/wah/activities/4.png" data-fancybox="gallery">
                            <img src="images/institutions/wah/activities/4.png" alt="" class="img-fluid h-100 img-thumbnail">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

    <section class="py-5">
        <div class="container text-center">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 justify-content-center">

                <?php
                    // Directory where images are stored
                    $imageDir = 'images/regions/row/';
                
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
            <div class="row">
                <h2 class="text-center fw-bold fs-2 section-heading py-3">Co-curricular Activities at Wah Region (2024)</h2>
            </div>

            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 justify-content-center">

                <?php
                    // Directory where images are stored
                    $imageDir = 'images/cca1/wah/';
                
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
      
    <!-- video gallery -->
    <section class="bg-clrd-sec py-5">
        <div class="container">
            <div class="row justify-content-center">
                <h2 class="text-center mb-4 fs-1 fw-bold">Development Projects at Wah Region</h2>
                <div class="col col-md-8">
                    <div class="ratio ratio-16x9">
                        <iframe src="https://www.youtube.com/embed/dQptbAH6A_E?si=gU11KlRifCkkiEM2"
                            title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                    </div>
                </div>
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
