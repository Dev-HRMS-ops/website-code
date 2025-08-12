<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Federal Government Educational Institutions</title>
    <meta name="description" content="Welcome to Federal Government Educational Institutions (C/G), also known as FGEI-(C/G). Explore educational programs, initiatives, and information about our institutions.">

    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">

    <!-- fancybox css -->
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
        <div class="container py-3">
            <div class="row">
                <h2 class="text-center fw-bold fs-1 section-heading">FAZAIA REGION</h2>
            </div>
        </div>
    </section>

    <section>
        <div class="container-fluid region ro-fazaia">
            <!-- <div class="row">
                <img src="images/regionaloffices/Fazaia.jpg" alt="" class="img-fluid img-thumbnail">
            </div> -->
        </div>
    </section>

    <section class="bg-clrd-sec">
        <div class="container py-5">
            <div class="row">
                <p class="fs-4 text-indent">Fazaia Regional Office, the youngest region of the FGEI system, was established in 2007 at Peshawar. A chain of 13 FG Fazaia Schools (05 HSSC level and 08 SSC level) was developed with a view of facilitating the low paid employees of Pakistan Air Force (PAF) and 7461 students are enrolled who are tutored by 401 faculty members. FG Fazaia Schools are located all over the country at PAF Bases of Peshawar, Rawalpindi, Islamabad, Lahore, Kalabagh (Abbottabad), Mianwali, Sargodha, Shorkot, Sakesar (Khushab), and Karachi. FG Fazaia Public School (2nd Shift) E-9 Islamabad is the only institution of the FGEIs system located in the Capital Territory. Most of the Fazaia Schools are operative in the evening shift, utilizing buildings of the PAF Schools and Colleges. Only three schools (Badaber, Kalabagh and Sakesar) function as morning shift schools and have their own buildings. FG Fazaia Public School Sakesar was upgraded to Higher Secondary Level in 2010 whereas FG FPHSS (2nd Shift) Shaheen Camp Peshawar, FG FPHSS (2nd Shift) Nur Khan Rawalpindi, FG FPHSS (2nd Shift) Lahore and FG FPHSS (2nd Shift) Faisal Karachi have been upgraded to HSSC level in 2022. Another distinctive feature of the Fazaia Region is that it teaches Single National Curriculum (SNC) in its institutions, like other FG Schools. FG Fazaia Region is the first one who introduced Biometric and face recognition system in FGEI for the attendance of employees. The Chief of Air Staff has initiated the “Shaheen Foundation Scholarship Scheme” for FG Fazaia students to provide financial assistance to the low paid employees of PAF.</p>

                <p class="fs-4">Phone #: 091-9212009</p>
            </div>
        </div>
    </section>

    <!-- image gallery -->


    <section class="py-5">
        <div class="container text-center">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 justify-content-center">

                <?php
                // Directory where images are stored
                $imageDir = 'images/regions/rof/';

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
                <h2 class="text-center mb-4 fs-1 fw-bold">Development Projects at Fazaia Region</h2>
                <div class="col col-md-8">
                    <div class="ratio ratio-16x9">
                        <iframe src="https://www.youtube.com/embed/rCIJh0K4S10?si=BbEiRJC1l8r5Ai5b"
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