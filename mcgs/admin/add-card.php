<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

require 'vendor/autoload.php'; // Import the QR code library

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;

if (strlen($_SESSION['mgsaid'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_POST['submit'])) {

        // Fetch form data
        $fname = $_POST['fullname'];
        $cnum = $_POST['cnumber'];
        $email = $_POST['email'];
        $bloodgrp = $_POST['bloodgrp'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $address = $_POST['address'];
        $medcond = $_POST['medcond'];
        $idate = $_POST['idate'];
        $validdate = $_POST['validdate'];

        // Generate unique reference number for medical card
        $refnum = mt_rand(100000000, 999999999);

        // Handle profile image upload
        $propic = $_FILES["propic"]["name"];
        $extension = substr($propic, strlen($propic) - 4, strlen($propic));
        $allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");
        if (!in_array($extension, $allowed_extensions)) {
            echo "<script>alert('Profile picture has an invalid format. Only jpg / jpeg / png / gif formats allowed');</script>";
        } else {
            // Save profile image
            $propic = md5($propic) . time() . $extension;
            move_uploaded_file($_FILES["propic"]["tmp_name"], "images/" . $propic);

            // Insert data into database
            $sql = "INSERT INTO tblmedicalcard(RefNumber, FullName, ProfileImage, ContactNumber, Email, BloodGroup, Age, Gender, Address, MedicalCond, IssuedDate, ValidDate) 
                    VALUES (:refnum, :fname, :propic, :cnum, :email, :bloodgrp, :age, :gender, :address, :medcond, :idate, :validdate)";
            $query = $dbh->prepare($sql);
            $query->bindParam(':refnum', $refnum, PDO::PARAM_STR);
            $query->bindParam(':fname', $fname, PDO::PARAM_STR);
            $query->bindParam(':cnum', $cnum, PDO::PARAM_STR);
            $query->bindParam(':email', $email, PDO::PARAM_STR);
            $query->bindParam(':bloodgrp', $bloodgrp, PDO::PARAM_STR);
            $query->bindParam(':age', $age, PDO::PARAM_STR);
            $query->bindParam(':gender', $gender, PDO::PARAM_STR);
            $query->bindParam(':address', $address, PDO::PARAM_STR);
            $query->bindParam(':medcond', $medcond, PDO::PARAM_STR);
            $query->bindParam(':idate', $idate, PDO::PARAM_STR);
            $query->bindParam(':validdate', $validdate, PDO::PARAM_STR);
            $query->bindParam(':propic', $propic, PDO::PARAM_STR);

            $query->execute();
            $LastInsertId = $dbh->lastInsertId();

            if ($LastInsertId > 0) {
                // Generate QR code with medical card details
                $qrData = "Name: $fname\nContact: $cnum\nBlood Group: $bloodgrp\nAge: $age\nGender: $gender\nMedical Conditions: $medcond";
                $qrCode = Builder::create()
                    ->writer(new PngWriter())
                    ->writerOptions([])
                    ->data($qrData)
                    ->encoding(new Encoding('UTF-8'))
                    ->errorCorrectionLevel(new ErrorCorrectionLevelLow())
                    ->size(300)
                    ->margin(10)
                    ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
                    ->labelText('Medical Card')
                    ->labelAlignment(new LabelAlignmentCenter())
                    ->build();

                // Save QR code as PNG
                $qrCodePath = "images/qrcodes/qr_" . $refnum . ".png";
                $qrCode->saveToFile($qrCodePath);

                echo '<script>alert("Medical card details and QR code have been added successfully.")</script>';
                echo "<script>window.location.href ='add-card.php'</script>";
            } else {
                echo '<script>alert("Something went wrong. Please try again.")</script>';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Medical Card Generator System | Add Medical Card</title>
    <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/plugins/pace/pace-theme-big-counter.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link href="assets/css/main-style.css" rel="stylesheet" />
</head>
<body>
    <div id="wrapper">
        <!-- Navbar -->
        <?php include_once('includes/header.php');?>
        <!-- Sidebar -->
        <?php include_once('includes/sidebar.php');?>
        
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add Medical Card</h1>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form method="post" enctype="multipart/form-data"> 
                                        <div class="form-group">
                                            <label for="fullname">Full Name</label>
                                            <input type="text" name="fullname" class="form-control" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="propic">Profile Image</label>
                                            <input type="file" name="propic" class="form-control" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="cnumber">Contact Number</label>
                                            <input type="text" name="cnumber" class="form-control" required maxlength="10" pattern="[0-9]+">
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Email Address</label>
                                            <input type="email" name="email" class="form-control" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="bloodgrp">Blood Group</label>
                                            <input type="text" name="bloodgrp" class="form-control" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="age">Age</label>
                                            <input type="text" name="age" class="form-control" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="gender">Gender</label>
                                            <select name="gender" class="form-control" required>
                                                <option value="">Select Gender</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Transgender">Transgender</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <textarea name="address" class="form-control" required></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="medcond">Medical Conditions (if any)</label>
                                            <textarea name="medcond" class="form-control"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="idate">Issued Date</label>
                                            <input type="date" name="idate" class="form-control" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="validdate">Valid Upto</label>
                                            <input type="date" name="validdate" class="form-control" required>
                                        </div>

                                        <div class="form-group text-center">
                                            <button type="submit" class="btn btn-primary" name="submit">Add</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="assets/plugins/jquery-1.10.2.js"></script>
    <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="assets/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="assets/plugins/pace/pace.js"></script>
    <script src="assets/scripts/siminta.js"></script>
</body>
</html>
