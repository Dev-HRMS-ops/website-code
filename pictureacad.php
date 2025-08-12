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
                <h2 class="text-center fw-bold fs-1 section-heading">Academic Activities</h2>
            </div>
        </div>
    </section>
    

    <!-- image gallery -->

    <section class="py-5">
        <div class="container text-center">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 justify-content-center">

                <?php
                    // Directory where images are stored
                    $imageDir = 'images/media/gallery/acad/';
                
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

    <!-- <section class="py-5">
        <div class="container text-center">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 justify-content-center">
                <div class="col">
                    <div class="img-wrapper p-2 h-100">
                        <a href="images/media/gallery/acad/1.jpg" data-fancybox="gallery">
                            <img src="images/media/gallery/acad/1.jpg" alt="" class="img-fluid h-100 img-thumbnail">
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="img-wrapper p-2 h-100">
                        <a href="images/media/gallery/acad/2.jpg" data-fancybox="gallery">
                            <img src="images/media/gallery/acad/2.jpg" alt="" class="img-fluid h-100 img-thumbnail">
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="img-wrapper p-2 h-100">
                        <a href="images/media/gallery/acad/4.jpg" data-fancybox="gallery">
                            <img src="images/media/gallery/acad/4.jpg" alt="" class="img-fluid h-100 img-thumbnail">
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="img-wrapper p-2 h-100">
                        <a href="images/media/gallery/acad/167.jpg" data-fancybox="gallery">
                            <img src="images/media/gallery/acad/167.jpg" alt="" class="img-fluid h-100 img-thumbnail">
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="img-wrapper p-2 h-100">
                        <a href="images/media/gallery/acad/168.jpg" data-fancybox="gallery">
                            <img src="images/media/gallery/acad/168.jpg" alt="" class="img-fluid h-100 img-thumbnail">
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="img-wrapper p-2 h-100">
                        <a href="images/media/gallery/acad/169.jpg" data-fancybox="gallery">
                            <img src="images/media/gallery/acad/169.jpg" alt="" class="img-fluid h-100 img-thumbnail">
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="img-wrapper p-2 h-100">
                        <a href="images/media/gallery/acad/170.jpg" data-fancybox="gallery">
                            <img src="images/media/gallery/acad/170.jpg" alt="" class="img-fluid h-100 img-thumbnail">
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="img-wrapper p-2 h-100">
                        <a href="images/media/gallery/acad/171.jpg" data-fancybox="gallery">
                            <img src="images/media/gallery/acad/171.jpg" alt="" class="img-fluid h-100 img-thumbnail">
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="img-wrapper p-2 h-100">
                        <a href="images/media/gallery/acad/172.jpg" data-fancybox="gallery">
                            <img src="images/media/gallery/acad/172.jpg" alt="" class="img-fluid h-100 img-thumbnail">
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="img-wrapper p-2 h-100">
                        <a href="images/media/gallery/acad/173.jpg" data-fancybox="gallery">
                            <img src="images/media/gallery/acad/173.jpg" alt="" class="img-fluid h-100 img-thumbnail">
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="img-wrapper p-2 h-100">
                        <a href="images/media/gallery/acad/174.jpg" data-fancybox="gallery">
                            <img src="images/media/gallery/acad/174.jpg" alt="" class="img-fluid h-100 img-thumbnail">
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="img-wrapper p-2 h-100">
                        <a href="images/media/gallery/acad/175.jpg" data-fancybox="gallery">
                            <img src="images/media/gallery/acad/175.jpg" alt="" class="img-fluid h-100 img-thumbnail">
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="img-wrapper p-2 h-100">
                        <a href="images/media/gallery/acad/176.jpg" data-fancybox="gallery">
                            <img src="images/media/gallery/acad/176.jpg" alt="" class="img-fluid h-100 img-thumbnail">
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="img-wrapper p-2 h-100">
                        <a href="images/media/gallery/acad/177.jpg" data-fancybox="gallery">
                            <img src="images/media/gallery/acad/177.jpg" alt="" class="img-fluid h-100 img-thumbnail">
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="img-wrapper p-2 h-100">
                        <a href="images/media/gallery/acad/178.jpg" data-fancybox="gallery">
                            <img src="images/media/gallery/acad/178.jpg" alt="" class="img-fluid h-100 img-thumbnail">
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="img-wrapper p-2 h-100">
                        <a href="images/media/gallery/acad/179.jpg" data-fancybox="gallery">
                            <img src="images/media/gallery/acad/179.jpg" alt="" class="img-fluid h-100 img-thumbnail">
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="img-wrapper p-2 h-100">
                        <a href="images/media/gallery/acad/180.jpg" data-fancybox="gallery">
                            <img src="images/media/gallery/acad/180.jpg" alt="" class="img-fluid h-100 img-thumbnail">
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="img-wrapper p-2 h-100">
                        <a href="images/media/gallery/acad/181.jpg" data-fancybox="gallery">
                            <img src="images/media/gallery/acad/181.jpg" alt="" class="img-fluid h-100 img-thumbnail">
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="img-wrapper p-2 h-100">
                        <a href="images/media/gallery/acad/182.jpg" data-fancybox="gallery">
                            <img src="images/media/gallery/acad/182.jpg" alt="" class="img-fluid h-100 img-thumbnail">
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="img-wrapper p-2 h-100">
                        <a href="images/media/gallery/acad/183.jpg" data-fancybox="gallery">
                            <img src="images/media/gallery/acad/183.jpg" alt="" class="img-fluid h-100 img-thumbnail">
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="img-wrapper p-2 h-100">
                        <a href="images/media/gallery/acad/184.jpg" data-fancybox="gallery">
                            <img src="images/media/gallery/acad/184.jpg" alt="" class="img-fluid h-100 img-thumbnail">
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="img-wrapper p-2 h-100">
                        <a href="images/media/gallery/acad/185.jpg" data-fancybox="gallery">
                            <img src="images/media/gallery/acad/185.jpg" alt="" class="img-fluid h-100 img-thumbnail">
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="img-wrapper p-2 h-100">
                        <a href="images/media/gallery/acad/186.jpg" data-fancybox="gallery">
                            <img src="images/media/gallery/acad/186.jpg" alt="" class="img-fluid h-100 img-thumbnail">
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="img-wrapper p-2 h-100">
                        <a href="images/media/gallery/acad/187.jpg" data-fancybox="gallery">
                            <img src="images/media/gallery/acad/187.jpg" alt="" class="img-fluid h-100 img-thumbnail">
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="img-wrapper p-2 h-100">
                        <a href="images/media/gallery/acad/188.jpg" data-fancybox="gallery">
                            <img src="images/media/gallery/acad/188.jpg" alt="" class="img-fluid h-100 img-thumbnail">
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="img-wrapper p-2 h-100">
                        <a href="images/media/gallery/acad/189.jpg" data-fancybox="gallery">
                            <img src="images/media/gallery/acad/189.jpg" alt="" class="img-fluid h-100 img-thumbnail">
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="img-wrapper p-2 h-100">
                        <a href="images/media/gallery/acad/190.jpg" data-fancybox="gallery">
                            <img src="images/media/gallery/acad/190.jpg" alt="" class="img-fluid h-100 img-thumbnail">
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="img-wrapper p-2 h-100">
                        <a href="images/media/gallery/acad/191.jpg" data-fancybox="gallery">
                            <img src="images/media/gallery/acad/191.jpg" alt="" class="img-fluid h-100 img-thumbnail">
                        </a>
                    </div>
                </div>
                <div class="col">
                    <div class="img-wrapper p-2 h-100">
                        <a href="images/media/gallery/acad/192.jpg" data-fancybox="gallery">
                            <img src="images/media/gallery/acad/192.jpg" alt="" class="img-fluid h-100 img-thumbnail">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section> -->


    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <script src="js/gallery.js"></script>

    <!-- ==============================================
    ** Footer **
    =================================================== -->
    <?php require_once "newfooter.php" ?> 

</body>

</html>
