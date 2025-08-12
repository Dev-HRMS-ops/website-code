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
                <h2 class="text-center fw-bold fs-1 section-heading">QUETTA REGION</h2>
            </div>
        </div>
    </section>
    
    <section>
        <div class="container-fluid region ro-quetta">
            <!-- <div class="row">
                <img src="images/regionaloffices/Peshawar.jpg" alt="" class="img-fluid img-thumbnail">
            </div> -->
        </div>
    </section>
  
    <section class="bg-clrd-sec">
        <div class="container py-5">
            <div class="row">
                <p class="fs-4 text-indent">Federal Government Educational Institutions (Cantts/Garrison) Regional Office, Quetta was established in 1981. Area wise, this is the largest amongst all FGEIs regions. Quetta Region is comparatively less developed with a sparse population having multiethnic backgrounds. FGEI Quetta Region is looking after academic and administrative affairs of 14 schools and 2 colleges. Besides the wards of Armed Forces personnel, these institutions are imparting quality education, at nominal rates, to educationally deprived children of Balochistan. Approximately 263 teaching staff and 150 non-teaching staff are providing academic services to about 6,000 children studying in FGEIs across the region. Amongst 16 schools and 02 colleges, Quetta Region has 2 oldest institutions i.e. FG Chiltan Public Middle School (Estb in 1946) and FG Jinnah Public Middle School (Estb in 1947) in Quetta Cantt.</p>

                <p class="fs-4">Phone #: 081-9202874</p>
            </div>
        </div>
    </section>

     <!-- image gallery -->


     <section class="py-5">
        <div class="container text-center">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 justify-content-center">

                <?php
                    // Directory where images are stored
                    $imageDir = 'images/regions/roq/';
                
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
                <h2 class="text-center fw-bold fs-2 section-heading">Sports Activities Quetta Region (2024)</h2>
            </div>

            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 justify-content-center">

                <?php
                    // Directory where images are stored
                    $imageDir = 'images/cca1/qta/';
                
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
    
    <?php
// Load video IDs from the text file
$videoIDs = file('videos/regions/roq/videos.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
?>

<!-- Video gallery -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center gy-3">
                <?php foreach ($videoIDs as $videoID): ?>
                    <div class="col-md-4">
                        <div class="ratio ratio-16x9">
                            <iframe src="https://www.youtube.com/embed/<?= htmlspecialchars($videoID) ?>?si=dynamic"
                                    title="YouTube video player" frameborder="0" 
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                    allowfullscreen></iframe>
                        </div>
                    </div>
                <?php endforeach; ?>
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
