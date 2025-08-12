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

   
    <section class="bg-clrd-sec">
        <div class="container py-3">
            <div class="row text-center mb-2">
                <h1 class="fw-bold fs-1 section-heading text-muted">Zohra Institute of Educational Development (ZIED)</h1>
            </div>
        </div>
    </section>
    <section>
        <div class="container py-5">
            <div class="row">
                <img alt="DG FGEIs"  src="images/institutions/zied/zied.jpg" class="img-fluid">
            </div>
        </div>
    </section>


    <section class="bg-clrd-sec">
        <div class="container py-3">
            <div class="row text-center mb-2">
                <h2 class="fw-bold fs-5 section-heading text-muted"><strong>Zohra Institute of Educational Development (ZIED)</strong></h2>
                <h2 class="fw-bold fs-5 section-heading text-muted">Phone: <strong>051-4212242</strong></h2>
                <h2 class="fw-bold fs-5 section-heading text-muted">Email: <strong>fgtames.dte@gmail.com</strong></h2>
                <h2 class="fw-bold fs-5 section-heading text-muted">Institution Type: <strong>Training and Human Resource Development</strong></h2>
                <h2 class="fw-bold fs-5 section-heading text-muted">Total Trainings Held: <strong>967</strong></h2>
            </div>
        </div>
    </section>

    <!-- image Gallery -->


    <section class="py-5">
        <div class="container text-center">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 justify-content-center">

                <?php
                    // Directory where images are stored
                    $imageDir = 'images/zied/';
                
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



    <section class="bg-clrd-sec">
        <div class="container py-3">
            <div class="row text-center mb-2">
                <h2 class="fw-bold fs-5 section-heading text-muted"><strong>Trainings held at ZIED in 2024</strong></h2>
            </div>
        </div>
    </section>
    

    <section>
        <div class="container py-1">

            <table class="table table-bordered table-responsive text-center">
                <thead class="table-success">
                <tr>
                    <th class="fs-4">Sr. No</th>
                    <th class="fs-4">Training Title</th>
                    <th class="fs-4">Action</th>
                </tr>
                </thead>
                <tbody class="table-group-divider">
                <tr>
                    <td class="fs-4">1</td>
                    <td class="fs-4">Progressive Pathway for Coordinators (PPC)</td>
                    <td class="fs-4"><a href="pdf/13.pdf" target="_blank">Click Here</a></td>
                </tr>
                
                
                <tr>
                    <td class="fs-4">2</td>
                    <td class="fs-4">Emerging Trends in Edn for Youth</td>
                    <td class="fs-4"><a href="pdf/14.pdf" target="_blank">Click Here</a></td>
                </tr>

                <tr>
                    <td class="fs-4">3</td>
                    <td class="fs-4">Workshop on Elements Learning by NUST Team</td>
                    <td class="fs-4"><a href="pdf/15.pdf" target="_blank">Click Here</a></td>
                </tr>


                <tr>
                    <td class="fs-4">4</td>
                    <td class="fs-4">Svc Norms, Conduct & Personality Dev</td>
                    <td class="fs-4"><a href="pdf/16.pdf" target="_blank">Click Here</a></td>
                </tr>

                <tr>
                    <td class="fs-4">5</td>
                    <td class="fs-4">Leadership and Management Skills (LMS)</td>
                    <td class="fs-4"><a href="pdf/17.pdf" target="_blank">Click Here</a></td>
                </tr>


                <tr>
                    <td class="fs-4">6</td>
                    <td class="fs-4">Orientation Session on Inclusive Education</td>
                    <td class="fs-4"><a href="pdf/18.pdf" target="_blank">Click Here</a></td>
                </tr>


                <tr>
                    <td class="fs-4">7</td>
                    <td class="fs-4">SEED training for newly inducted teaching faculty</td>
                    <td class="fs-4"><a href="https://drive.google.com/drive/folders/1A636QFXugCu5G9sNigH9XuYeWZGNlD7r?usp=sharing" target="_blank">Click Here</a></td>
                </tr>


                <tr>
                    <td class="fs-4">8</td>
                    <td class="fs-4">Session on Nurturing an Entrepreneurial Mindset through ChatGPT</td>
                    <td class="fs-4"><a href="https://drive.google.com/drive/folders/1AUV7TMA8Vy-47XHImDYOocO2HVisQulX?usp=sharing" target="_blank">Click Here</a></td>
                </tr>


                <tr>
                    <td class="fs-4">9</td>
                    <td class="fs-4">Training on Scheme of Work</td>
                    <td class="fs-4"><a href="https://drive.google.com/drive/folders/1_6y0CZPys7H2EP2YZYD6Lo_0mUxr5Wse?usp=sharing" target="_blank">Click Here</a></td>
                </tr> 
                
                <tr>
                    <td class="fs-4">10</td>
                    <td class="fs-4">10th Central Level Training Session</td>
                    <td class="fs-4"><a href="https://drive.google.com/drive/folders/1wzBspEoLh2AMsqgMgV_KjZyB5SxwQDRo?usp=drive_link" target="_blank">Click Here</a></td>
                </tr> 
                
                <tr>
                    <td class="fs-4">11</td>
                    <td class="fs-4">11th Central Level Training Course</td>
                    <td class="fs-4"><a href="https://drive.google.com/drive/folders/1i6WDs6Eb1XvnjMW9WnQYwtmosB5zW5_Q?usp=sharing" target="_blank">Click Here</a></td>
                </tr> 
                
                <tr>
                    <td class="fs-4">12</td>
                    <td class="fs-4">12th Central Level Training Session</td>
                    <td class="fs-4"><a href="https://drive.google.com/drive/folders/1oNf5bZYl5o70kvsfKvBoE-44-wqF4J-Q?usp=sharing" target="_blank">Click Here</a></td>
                </tr> 
                <tr>
                    <td class="fs-4">13</td>
                    <td class="fs-4">13th Central Level Training Session</td>
                    <td class="fs-4"><a href="https://drive.google.com/drive/folders/1tcFqfOHGCM-rqjsGvtLrwKx30tcLu0A5?usp=sharing" target="_blank">Click Here</a></td>
                </tr> 
                
                </tbody>
            </table>
    </section>



    <section class="bg-clrd-sec">
        <div class="container py-3">
            <div class="row text-center mb-2">
                <h2 class="fw-bold fs-5 section-heading text-muted"><strong>Trainings held at ZIED in 2023</strong></h2>
            </div>
        </div>
    </section>
    

    <section>
        <div class="container py-1">

            <table class="table table-bordered table-responsive text-center">
                <thead class="table-success">
                <tr>
                    <th class="fs-4">Sr. No</th>
                    <th class="fs-4">Training Title</th>
                    <th class="fs-4">Action</th>
                </tr>
                </thead>
                <tbody class="table-group-divider">
                <tr>
                    <td class="fs-4">1</td>
                    <td class="fs-4">Course on Basic Computer Skills</td>
                    <td class="fs-4"><a href="pdf/1.pdf" target="_blank">Click Here</a></td>
                </tr>
                
                
                <tr>
                    <td class="fs-4">2</td>
                    <td class="fs-4">Cource on Writing Professional PERs</td>
                    <td class="fs-4"><a href="pdf/2.pdf" target="_blank">Click Here</a></td>
                </tr>

                <tr>
                    <td class="fs-4">3</td>
                    <td class="fs-4">Essential of School Management and Administration</td>
                    <td class="fs-4"><a href="pdf/3.pdf" target="_blank">Click Here</a></td>
                </tr>


                <tr>
                    <td class="fs-4">4</td>
                    <td class="fs-4">Session on Reading Skills</td>
                    <td class="fs-4"><a href="pdf/4.pdf" target="_blank">Click Here</a></td>
                </tr>

                <tr>
                    <td class="fs-4">5</td>
                    <td class="fs-4">Course on Inclusive Education</td>
                    <td class="fs-4"><a href="pdf/5.pdf" target="_blank">Click Here</a></td>
                </tr>


                <tr>
                    <td class="fs-4">6</td>
                    <td class="fs-4">Course on Scheme of Studies Class Pre-I to VIII</td>
                    <td class="fs-4"><a href="pdf/6.pdf" target="_blank">Click Here</a></td>
                </tr>


                <tr>
                    <td class="fs-4">7</td>
                    <td class="fs-4">Artificial Intelligence and its applications in Education</td>
                    <td class="fs-4"><a href="pdf/7.pdf" target="_blank">Click Here</a></td>
                </tr>


                <tr>
                    <td class="fs-4">8</td>
                    <td class="fs-4">Project Based Learning</td>
                    <td class="fs-4"><a href="pdf/8.pdf" target="_blank">Click Here</a></td>
                </tr>


                <tr>
                    <td class="fs-4">9</td>
                    <td class="fs-4">Development of Competencies and Fostering Growth</td>
                    <td class="fs-4"><a href="pdf/9.pdf" target="_blank">Click Here</a></td>
                </tr>


                <tr>
                    <td class="fs-4">10</td>
                    <td class="fs-4">Workshop on Development of Competencies & Fostering</td>
                    <td class="fs-4"><a href="pdf/10.pdf" target="_blank">Click Here</a></td>
                </tr>


                <tr>
                    <td class="fs-4">11</td>
                    <td class="fs-4">The Contact Session for Teaching Faculty</td>
                    <td class="fs-4"><a href="pdf/11.pdf" target="_blank">Click Here</a></td>
                </tr>


                <tr>
                    <td class="fs-4">12</td>
                    <td class="fs-4">Training for Capacity Building of Teachers</td>
                    <td class="fs-4"><a href="pdf/12.pdf" target="_blank">Click Here</a></td>
                </tr>



                
                </tbody>
            </table>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
        <script src="js/gallery.js"></script>
    

    <!-- ==============================================
    ** Footer **
    =================================================== -->
    <?php require_once "newfooter.php" ?> 

</body>

</html>
