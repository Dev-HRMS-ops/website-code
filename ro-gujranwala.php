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
                <h2 class="text-center fw-bold fs-1 section-heading">GUJRANWALA REGION</h2>
            </div>
        </div>
    </section>
    
    <section>
        <div class="container-fluid region ro-gujranwala">
            <!-- <div class="row">
                <img src="images/regionaloffices/Peshawar.jpg" alt="" class="img-fluid img-thumbnail">
            </div> -->
        </div>
    </section>
  
    <section class="bg-clrd-sec">
        <div class="container py-5">
            <div class="row">
                <p class="fs-4 text-indent">Gujranwala Region was established in 1990 prior to which FGEIs of the region were being looked after by Mangla Region. In addition to the FGEIs of Gujranwala Cantt, this region also looks after institutions located in Sialkot, Sargodha, Kirana, and Mona. There are 23 institutions serving under this region, including 2 colleges located at Gujranwala and Sialkot. The oldest institution of the region is FG Boys Public School Sialkot, established in 1957 and FG Girls Public School Sialkot, established in 1958. Currently, 338 faculty members are shouldering the educational responsibilities of 10050 students enrolled in these institutions.</p>

                <p class="fs-4">Phone #: 055-3830015</p>
            </div>
        </div>
    </section>

    <!-- image gallery -->

    <!-- <section class="py-5">
        <div class="container text-center">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 justify-content-center">
                <div class="col">
                    <div class="img-wrapper p-2 h-100">
                        <a href="images/regionaloffices/guj/2.jpg" data-fancybox="gallery">
                            <img src="images/regionaloffices/guj/2.jpg" alt="" class="img-fluid h-100 img-thumbnail">
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="img-wrapper p-2 h-100">
                        <a href="images/regionaloffices/guj/3.jpg" data-fancybox="gallery">
                            <img src="images/regionaloffices/guj/3.jpg" alt="" class="img-fluid h-100 img-thumbnail">
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="img-wrapper p-2 h-100">
                        <a href="images/regionaloffices/guj/4.jpg" data-fancybox="gallery">
                            <img src="images/regionaloffices/guj/4.jpg" alt="" class="img-fluid h-100 img-thumbnail">
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="img-wrapper p-2 h-100">
                        <a href="images/regionaloffices/guj/5.jpg" data-fancybox="gallery">
                            <img src="images/regionaloffices/guj/5.jpg" alt="" class="img-fluid h-100 img-thumbnail">
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="img-wrapper p-2 h-100">
                        <a href="images/regionaloffices/guj/6.jpg" data-fancybox="gallery">
                            <img src="images/regionaloffices/guj/6.jpg" alt="" class="img-fluid h-100 img-thumbnail">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

     <!-- image gallery -->


     <section class="py-5">
        <div class="container text-center">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 justify-content-center">

                <?php
                    // Directory where images are stored
                    $imageDir = 'images/regions/rog/';
                
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
                <h2 class="text-center fw-bold fs-2 section-heading py-3">Sports and Science Projects Competitions Gujranwala Region (2024)</h2>
            </div>

            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 justify-content-center">

                <?php
                    // Directory where images are stored
                    $imageDir = 'images/cca1/gwa/';
                
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
                <h2 class="text-center mb-4 fs-1 fw-bold">Development Projects at Gujranwala Region</h2>
                <div class="col col-md-8">
                    <div class="ratio ratio-16x9">
                    <iframe src="https://www.youtube.com/embed/rXxA-zIssns?si=sBp8YSr2P_SvH-wb"
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
