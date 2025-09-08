<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/fgeiwsstyle.css">
</head>

<body>

    <div>
        <!-- First Row: Navbar with seven items -->
        <div class="header2-topbar container-fluid">
            <div class="row align-items-center">

                <nav class="navbar navbar-expand-xl navbar-light">
                    <div class="container-fluid">
                        <!-- <a class="navbar-brand" href="#">Brand</a> -->
                        <a class="navbar-brand" href="index.php">
                            <img src="images/fgeis1.png" alt="FGEI" class="nav-logo">
                            <h4 class="main-heading d-none d-lg-inline-block align-text-top">Federal Government Educational Institutions</h4>
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="offcanvas offcanvas-end  w-100" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                            <div class="offcanvas-header text-white">
                                <!--<h5 class="offcanvas-title" id="offcanvasNavbarLabel">Offcanvas Navbar</h5>-->
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                                    <li class="nav-item">
                                        <a class="nav-link text-uppercase border-end" href="index.php">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-uppercase border-end" href="https://hrms.fgei.gov.pk/" target="_blank">HRMS Portal</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-uppercase border-end" href="https://sis.fgei.gov.pk/" target="_blank">SIS Portal</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-uppercase border-end" href="https://sms.fgei.gov.pk/" target="_blank">SMS Portal</a>
                                    </li>
                                    <li class="nav-item">
                                        <!-- <a class="nav-link text-uppercase border-end" href="eoffice.php">E-office</a> -->
                                        <a class="nav-link text-uppercase border-end" href='https://fgei.gov.pk/eoffice' target="_blank">E-office</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link text-uppercase border-end" href="downloads.php">downloads</a>
                                    </li>

                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle text-uppercase" href="#" id="navbarDropdown7" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            About Us
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-topbar" aria-labelledby="navbarDropdown7">
                                            <li><a class="dropdown-item text-capitalize" href="alumni.php">Alumni</a></li>
                                            <li><a class="dropdown-item text-capitalize" href="role-and-responsiblities.php">Functions/Roles and Responsibility</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>

        <!-- Third Row: Navbar with seven items each having three dropdown items -->

        <div class="header2-bottom-nav container-fluid p-0">
            <div class="row justify-content-start justify-content-lg-center mx-0">
                <div class="col-auto">
                    <nav class="navbar navbar-expand-xl navbar-light">
                        <div class="container-fluid">
                            <div class="center-toggler d-flex justify-content-center">
                                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar2" aria-controls="offcanvasNavbar2">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                            </div>
                            <div class="offcanvas offcanvas-start  w-100" tabindex="-1" id="offcanvasNavbar2" aria-labelledby="offcanvasNavbarLabel2">
                                <div class="offcanvas-header">
                                    <!--<h5 class="offcanvas-title" id="offcanvasNavbarLabel2">Offcanvas Navbar</h5>-->
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body">
                                    <ul class="navbar-nav">

                                        <li class="nav-item">
                                            <a class="nav-link fs-5" href="history.php">Dashboard</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link fs-5" href="organogram.php">Organogram</a>
                                        </li>

                                        <!-- <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle text-capitalize fs-5" href="#" id="navbarDropdown1" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    FGEI
                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown1">
                                                    <li><a class="dropdown-item text-capitalize fs-5" href="history.php">Dashboard</a></li>
                                                    <li><a class="dropdown-item text-capitalize fs-5" href="organogram.php">Organogram</a></li>
                                                </ul>
                                            </li> -->

                                        <!-- Repeat the dropdown structure for remaining items -->
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle text-capitalize fs-5" href="#" id="navbarDropdown3" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                Regional Offices
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown3">
                                                <li><a class="dropdown-item text-capitalize fs-5" href="ro-peshawar.php">Peshawar</a></li>
                                                <li><a class="dropdown-item text-capitalize fs-5" href="ro-fazaia.php">Fazaia</a></li>
                                                <li><a class="dropdown-item text-capitalize fs-5" href="ro-wah.php">Wah</a></li>
                                                <li><a class="dropdown-item text-capitalize fs-5" href="ro-rawalpindi.php">Rawalpindi</a></li>
                                                <li><a class="dropdown-item text-capitalize fs-5" href="ro-chaklala.php">Chaklala</a></li>
                                                <li><a class="dropdown-item text-capitalize fs-5" href="ro-kharian.php">Kharian</a></li>
                                                <li><a class="dropdown-item text-capitalize fs-5" href="ro-gujranwala.php">Gujranawala</a></li>
                                                <li><a class="dropdown-item text-capitalize fs-5" href="ro-lahore.php">Lahore</a></li>
                                                <li><a class="dropdown-item text-capitalize fs-5" href="ro-multan.php">Multan</a></li>
                                                <li><a class="dropdown-item text-capitalize fs-5" href="ro-bahawalpur.php">Bahawalpur</a></li>
                                                <li><a class="dropdown-item text-capitalize fs-5" href="ro-quetta.php">Quetta</a></li>
                                                <li><a class="dropdown-item text-capitalize fs-5" href="ro-karachi.php">Karachi</a></li>

                                            </ul>
                                        </li>

                                        <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle text-capitalize fs-5" id="navbarDropdown6" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    HR Corner
                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown6">
                                                    <li><a class="dropdown-item text-capitalize fs-5" href="nts.php">Non Teaching Staff</a></li>
                                                    <li><a class="dropdown-item text-capitalize fs-5" href="cmmgmt.php">HR Management</a></li>
                                                    <li><a class="dropdown-item text-capitalize fs-5" href="legal.php">Legal</a></li>
                                                    <!-- <li><a class="dropdown-item text-capitalize fs-5" href="downloads.php">Downloads</a></li> -->
                                                </ul>
                                            </li>

                                            <li class="nav-item"><a class="fs-5 text-capitalize nav-link" href="jobs.php" target="_blank">Career Opportunities</a></li>

                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle text-capitalize fs-5" href="#" id="navbarDropdown5" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                Initiatives
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown5">
                                                <li><a class="dropdown-item text-capitalize fs-5" href="fims.php">IT Initiatives</a></li>
                                                <li><a class="dropdown-item text-capitalize fs-5" href="internship/index.php" target="_blank">Internship</a></li>
                                                <li><a class="dropdown-item text-capitalize fs-5" href="eoffice.php">E-Office</a></li>
                                                <li><a class="dropdown-item text-capitalize fs-5" href="priprimary1.php">Pre Primary</a></li>
                                                <li><a class="dropdown-item text-capitalize fs-5" href="spec.php">Special Education Cell (SEC)</a></li>
                                                <!-- <li><a class="dropdown-item text-capitalize fs-5" href="dr-zohra-training-center.php">Zohra Institute of Education Development (ZIED)</a></li> -->
                                                <!-- <li><a class="dropdown-item text-capitalize fs-5" href="#">Jinnah Institute of Inclusive Education (JIIE)</a></li> -->

                                                <!-- <li><a class="dropdown-item text-capitalize fs-5" href="#">Community Service</a></li> -->
                                                <li><a class="dropdown-item text-capitalize fs-5" href="https://nup.edu.pk/" target="_blank">National University of Pakistan (NUP)</a></li>
                                                <li><a class="dropdown-item text-capitalize fs-5" href="https://fijmr.com/" target="_blank">FGEI International Journal of Multidisciplinary Research (FIJMR)</a></li>
                                                <!-- <li><a class="dropdown-item text-capitalize fs-5" href="#">Steam & Blended Learning Project</a></li> -->

                                            </ul>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link fs-5" href="dr-zohra-training-center.php">ZIED</a>
                                        </li>
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle text-capitalize fs-5" id="navbarDropdown4" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                Academics
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown4">
                                                <li><a class="dropdown-item text-capitalize fs-5" href="sa-wing.php">School Affairs Wing</a></li>
                                                <li><a class="dropdown-item text-capitalize fs-5" href="schools.php">Schools</a></li>
                                                <li><a class="dropdown-item text-capitalize fs-5" href="colleges.php">Colleges</a></li>
                                                <li><a class="dropdown-item text-capitalize fs-5" href="scheme-of-studies.php">Scheme of Work</a></li>
                                                <li><a class="dropdown-item text-capitalize fs-5" href="academic-calendar.php">Academic Calendar</a></li>
                                                <li><a class="dropdown-item text-capitalize fs-5" href="examinations.php">Examinations</a></li>
                                            </ul>
                                        </li>

                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle text-capitalize fs-5" id="navbarDropdown7" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                Policies
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown7">
                                                <!-- <li><a class="dropdown-item text-capitalize fs-5" href="rec-rules.php">Recruitment Rules</a></li> -->
                                                <li><a class="dropdown-item text-capitalize fs-5" href="code-of-conduct.php">Code of Conduct</a></li>
                                                <li><a class="dropdown-item text-capitalize fs-5" href="uniform_guidelines.php">Uniform Guidelines</a></li>
                                                <li><a class="dropdown-item text-capitalize fs-5" href="school-houses.php">School Houses</a></li>
                                                <li><a class="dropdown-item text-capitalize fs-5" href="policyguidelines.php">CPD Policy Guidelines</a></li>
                                                <li><a class="dropdown-item text-capitalize fs-5" href="policyguidelines-exams.php">Exams Policy Guidelines</a></li>
                                                <li><a class="dropdown-item text-capitalize fs-5" href="eligibility-criteria.php">Admissions</a></li>
                                            </ul>
                                        </li>

                                        <!-- <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle text-capitalize fs-5" id="navbarDropdown7" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Events
                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown7">
                                                    <li><a class="dropdown-item text-capitalize fs-5" href="picturegallery.php">Gallery</a></li>
                                                </ul>
                                            </li> -->

                                        <!--<li class="nav-item">-->
                                        <!--    <a class="nav-link fs-5" href="picturegallery.php">Gallery</a>-->
                                        <!--</li>-->

                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle text-capitalize fs-5" id="navbarDropdown7" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                Gallery
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown7">
                                                <li><a class="dropdown-item text-capitalize fs-5" href="picturegallery.php">Picture Gallery</a></li>
                                                <li><a class="dropdown-item text-capitalize fs-5" href="videogallery.php">Video Gallery</a></li>
                                            </ul>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>




    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>