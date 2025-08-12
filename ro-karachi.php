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
                <h2 class="text-center fw-bold fs-1 section-heading">KARACHI REGION</h2>
            </div>
        </div>
    </section>
    
    <section>
        <div class="container-fluid region ro-karachi">
            <!-- <div class="row">
                <img src="images/regionaloffices/Peshawar.jpg" alt="" class="img-fluid img-thumbnail">
            </div> -->
        </div>
    </section>
  
    <section class="bg-clrd-sec">
        <div class="container py-5">
            <div class="row">
                <p class="fs-4 text-indent">Regional Office Karachi was established in 1975 and its area of responsibility is spread over entire Sindh Province. The Regional Office manages 22 schools and 3 colleges. The oldest school of the region, FG Girls High School Hyderabad was established in 1935, whereas FG Degree College Hyderabad, the oldest college, came into existence in 1969. The famous FG Public School Karachi, another historic and quality institution, was established in 1958. Other than Karachi, the institutions are located at Hyderabad, Malir, Manora, Badin, and Pano Aqil.</p>

                <p class="fs-4">Phone #: 021-99202131</p>
            </div>
        </div>
    </section>


     <!-- image gallery -->


     <section class="py-5">
        <div class="container text-center">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 justify-content-center">

                <?php
                    // Directory where images are stored
                    $imageDir = 'images/regions/rok/';
                
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
                <h2 class="text-center mb-4 fs-1 fw-bold">Development Projects at Karachi Region</h2>
                <div class="col col-md-8">
                    <div class="ratio ratio-16x9">
                        <iframe src="https://www.youtube.com/embed/-jFMItomjBk?si=pm-KBfsSMhW3NQhZ"
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
