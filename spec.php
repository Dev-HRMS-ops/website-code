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
        <div class="container-fluid">
            <div class="row text-center p-0">
                <h2 class="fw-bold fs-1 py-3">SPECIAL EDUCATION CELL</h2>
                <img alt="secbanner" src="images/institutions/spec/secbanner.jpg" class="img-fluid p-0">
            </div>
        </div>
    </section>

    <!-- <section class="bg-clrd-sec">
        <div class="container py-3">
            <div class="row text-center mb-2">
                <h2 class="fw-bold fs-5 section-heading text-muted"><strong>Special Education Cell</strong></h2>
                <h2 class="fw-bold fs-5 section-heading text-muted">Phone: <strong>051-4212242</strong></h2>
                <h2 class="fw-bold fs-5 section-heading text-muted">Email: <strong>speccell.dte@gmail.com</strong></h2>
            </div>
        </div>
    </section> -->

    <section>
        <div class="container py-3">
            <div class="row text-center mb-2">
                <h2 class="fw-bold fs-1 text-muted"><strong>History</strong></h2>
                <p class="fs-4">Pakistan Army is playing a vital role in human resource development of the country by successfully running many educational institutions i.e., Federal Government Educational Institutions, Army Public Schools & Colleges, Military Cadet Colleges and Technical Training Institutes. Special Education Cell (SEC) is an initiative undertaken by Pak Army which was transferred to Federal Government Educational Institutions Directorate in February 2020 after functioning in Human Resource Directorate, GHQ for six years. Special Education institutions are currently situated in major cities like Rawalpindi, Karachi, Kharian, Gujranwala, Siakot, Multan, Peshawar and wah.</p>
                <p class="fs-4"><strong>Total Number of Institutions:</strong> 26</p>
                <p class="fs-4"><strong>Total Number of Students:</strong> 4057</p>
                <p class="fs-4"><strong>Total Number of Teaching Staff:</strong> 576</p>
                <p class="fs-4"><strong>Total Number of Non Teaching Staff:</strong> 406</p>
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

    <section class="py-5">
        <div class="container text-center">
            <h2 class="text-center fw-bold fs-1 section-heading">Gallery</h2>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 justify-content-center">

                <?php
                // Directories for both sets of images
                $specDir = 'images/spec/';
                $aseaDir = 'images/asea/';

                // Get all image files from both directories
                $specImages = glob($specDir . '*.{jpg,jpeg,png,gif,JPG,PNG,JPEG}', GLOB_BRACE);
                $aseaImages = glob($aseaDir . '*.{jpg,jpeg,png,gif,JPG,PNG,JPEG}', GLOB_BRACE);

                // Merge arrays: spec images first, then asea images
                $allImages = array_merge($specImages, $aseaImages);

                // Loop through each image and display it
                foreach ($allImages as $image) {
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


    <section class="bg-clrd-sec">
        <div class="container py-3">
            <div class="row text-center mb-2">
                <h3 style="color: #213E5B; font-size:38px">Special Education Magazines</h3>
                <p style="font-size: 22px;">Magazine Gifted Angels (both in English and Urdu) is uploaded. <a href="https://drive.google.com/drive/folders/168H_xun5hucenz8lkafxn1Ldf-haE2D0?usp=sharing" target="_blank">Click here</a></p>
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