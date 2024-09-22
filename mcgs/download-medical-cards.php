<?php
include('includes/dbconnection.php');
session_start();
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required Meta Tags -->
    <!-- Page Title -->
    <title>Medical Card Generator System || Download Medical Card</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/logo/favicon.png" type="image/x-icon">

    <!-- CSS Files -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="assets/css/animate-3.7.0.css">
    <link rel="stylesheet" href="assets/css/font-awesome-4.7.0.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap-4.1.3.min.css">
    <link rel="stylesheet" href="assets/css/owl-carousel.min.css">
    <link rel="stylesheet" href="assets/css/jquery.datetimepicker.min.css">
    <link rel="stylesheet" href="assets/css/linearicons.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    
   <?php include_once('includes/header.php');?> 

<!-- Banner Area Starts -->
<section class="banner-area other-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>View Medical Card</h1>
                <a href="index.php">Home</a> <span>|</span> <a href="download-medical-cards.php">Medical Card</a>
            </div>
        </div>
    </div>
</section>
<!-- Banner Area End -->

<br>
<!-- Contact Form Starts -->
<section class="contact-form section-padding3">
    <div class="container">  
        <div class="agileits-title">
            <h3>View Medical Card Details</h3>
        </div>  
        <br>
        <div class="contact-agileinfo">
            <div class="col-lg-9">
                <form method="post">
                    <div class="g-recaptcha" data-sitekey="6LcnyEoqAAAAAL0O4wAOL8Y_sHGnj7zOlGfwFHxZ"></div>
                    <input id="searchdata" type="text" name="searchdata" placeholder="Search by Reference Number" class="single-input" required="true">
                    <button type="submit" name="search" class="template-btn" id="submit">Search</button>
                </form>
            </div>
            <div class="clearfix"></div>
            <div class="table-responsive">
                <?php
                $captcha = $_POST['g-recaptcha-response'];
                $secretKey = '6LcnyEoqAAAAAEz9aBfjOP6-Iltv8KtPZjViFOjy'; // Your secret key here

                // Verify the CAPTCHA
                $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secretKey}&response={$captcha}");
                $responseKeys = json_decode($response, true);

                // Check if verification was successful
                if (intval($responseKeys["success"]) !== 1) {
                    echo '<script>alert("CAPTCHA verification failed. Please try again.");</script>';
                } elseif (isset($_POST['search'])) { 
                    $sdata = $_POST['searchdata'];
                    ?>
                    <h4 align="center">Result against "<?php echo htmlentities($sdata); ?>" keyword</h4>
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>S.NO</th>
                                <th>Reference Number</th>
                                <th>Full Name</th>
                                <th>Contact Number</th>
                                <th>Email</th>
                                <th>Creation Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM tblmedicalcard WHERE RefNumber LIKE '%$sdata%' OR ContactNumber LIKE '%$sdata%'";
                            $query = $dbh->prepare($sql);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);

                            $cnt = 1;
                            if ($query->rowCount() > 0) {
                                foreach ($results as $row) {
                                    ?>
                                    <tr>
                                        <td><?php echo htmlentities($cnt); ?></td>
                                        <td><?php echo htmlentities($row->RefNumber); ?></td>
                                        <td><?php echo htmlentities($row->FullName); ?></td>
                                        <td><?php echo htmlentities($row->ContactNumber); ?></td>
                                        <td><?php echo htmlentities($row->Email); ?></td>
                                        <td><?php echo htmlentities($row->CreationDate); ?></td>
                                        <td><a href="view-card-detail.php?viewid=<?php echo htmlentities($row->ID); ?>" class="btn btn-primary">View</a></td>
                                    </tr>
                                    <?php 
                                    $cnt++;
                                }
                            } else { ?>
                                <tr>
                                    <td colspan="7">No record found against this search</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
<!-- Contact Form End -->

<!-- Footer Area Starts -->
<?php include_once('includes/footer.php');?>
<!-- Footer Area End -->

<!-- Javascript -->
<script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
<script src="assets/js/vendor/bootstrap-4.1.3.min.js"></script>
<script src="assets/js/vendor/wow.min.js"></script>
<script src="assets/js/vendor/owl-carousel.min.js"></script>
<script src="assets/js/vendor/jquery.datetimepicker.full.min.js"></script>
<script src="assets/js/vendor/jquery.nice-select.min.js"></script>
<script src="assets/js/vendor/superfish.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDpfS1oRGreGSBU5HHjMmQ3o5NLw7VdJ6I"></script>
<script src="assets/js/vendor/gmaps.min.js"></script>
<script src="assets/js/main.js"></script>

</body>
</html>
