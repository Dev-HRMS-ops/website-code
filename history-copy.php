<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Federal Government Educational Institutions</title>
    <meta name="description" content="Welcome to Federal Government Educational Institutions , also known as FGEI. Explore educational programs, initiatives, and information about our institutions.">

    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">

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
                <h1 class="fw-bold fs-1 section-heading text-muted">History</h1>
            </div>
        </div>
    </section>


    <section class="py-5">
    <div class="container p-0 bg-black">
        <div class="dashboard-header pt-5 pb-3 mb-3 text-center">
            <div class="position-absolute top-0 start-0 pt-2 ps-2">
                <img src="images/fgeis1.png" alt="Education Logo" class="img-fluid">
            </div>
            <span class="position-absolute top-50 start-50 translate-middle fs-1 fw-bold">
                DASHBOARD
            </span>
            <div class="position-absolute top-0 end-0 pt-2 pe-2">
                <img src="images/fgeis1.png" alt="Right Icon" class="img-fluid">
            </div>
        </div>
        
        <div class="row px-3">
            <!-- Regional Office Section -->
            <div class="col-md-3">
                <div class="dashboard-section">
                    <div class="section-title text-white fs-3 fw-bold mb-2 text-center">
                        Regional Office
                    </div>
                    <div class="data-box">
                        <div class="data-value">12</div>
                        <div class="map-container">
                            <img src="/api/placeholder/400/200" alt="Regional Map" class="img-fluid">
                        </div>
                    </div>
                    <div class="total-box">Total</div>
                </div>
            </div>
            
            <!-- Institutions Section -->
            <div class="col-md-3">
                <div class="dashboard-section">
                    <div class="section-title text-white fs-3 fw-bold mb-2 text-center">
                        Instns
                    </div>
                    <div class="data-box">
                        <div class="data-label">Schools</div>
                        <div class="data-value">311</div>
                    </div>
                    <div class="data-box">
                        <div class="data-label">Colleges</div>
                        <div class="data-value">50</div>
                    </div>
                    <div class="data-box gray">
                        <div class="data-label">Spec Edn</div>
                        <div class="data-value">26</div>
                    </div>
                    <div class="total-value">387</div>
                </div>
            </div>
            
            <!-- Employees Section -->
            <div class="col-md-3">
                <div class="dashboard-section">
                    <div class="section-title text-white fs-3 fw-bold mb-2 text-center">
                        Employees
                    </div>
                    <div class="data-box">
                        <div class="data-label">Perm</div>
                        <div class="data-value">12,699</div>
                    </div>
                    <div class="data-box">
                        <div class="data-label">Hon</div>
                        <div class="data-value">1083</div>
                    </div>
                    <div class="data-box gray">
                        <div class="data-value">969</div>
                    </div>
                    <div class="total-value">14,491</div>
                </div>
            </div>
            
            <!-- Students Section -->
            <div class="col-md-3">
                <div class="dashboard-section">
                    <div class="section-title text-white fs-3 fw-bold mb-2 text-center">
                        Students
                    </div>
                    <div class="data-box">
                        <div class="data-value">1,91,824</div>
                    </div>
                    <div class="data-box gray">
                        <div class="data-value">3628</div>
                    </div>
                    <div class="total-value">1,95,452</div>
                </div>
            </div>
        </div>
        
        <!-- Faculty Profile Table -->
        <div class="faculty-profile">FACULTY PROFILE</div>
        <table class="faculty-table">
            <thead>
                <tr>
                    <th>PhD</th>
                    <th>MS/ MPhil</th>
                    <th>MA/ MSc / BS</th>
                    <th>BA/ BSc</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>143</td>
                    <td>1022</td>
                    <td>7337</td>
                    <td>1041</td>
                    <td class="total">9543</td>
                </tr>
            </tbody>
        </table>
    </div>
        <div class="container py-5">
            <div class="row">
                <img alt="DG FGEIs"  src="images/initiatives/history.png" class="img-fluid">
            </div>
        </div>
    </section>

    <!-- ==============================================
    ** Footer **
    =================================================== -->
    <?php require_once "newfooter.php" ?> 
    
</body>

</html>
