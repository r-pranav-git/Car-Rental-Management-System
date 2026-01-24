<?php
session_start();
include 'C:\wamp64\www\vehicle\database.php'; // Ensure the path is correct

// Redirect to login page if not logged in
if (strlen($_SESSION['alogin']) == 0) {	
    header('location:index.php');
    exit();
}
?>
<!doctype html>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Car Rental Portal | Admin Dashboard</title>
    <!-- CSS includes -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-social.css">
    <link rel="stylesheet" href="css/bootstrap-select.css">
    <link rel="stylesheet" href="css/fileinput.min.css">
    <link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .stat-panel {
            padding: 20px;
            text-align: center;
            background-color: #61BDF1 ;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .stat-panel-number {
            font-size: 36px;
            margin-bottom: 10px;
            
        }
        .stat-panel-title {
            font-size: 18px;
            text-transform: uppercase;
        }
        .block-anchor {
            display: block;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <div class="ts-main-content">
        <?php include 'includes/leftbar.php'; ?>
        <div class="content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="page-title">Dashboard</h2>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="panel panel-default">
                                    <div class="panel-body bk-primary text-light">
                                        <div class="stat-panel">
                                            <?php 
                                                // Count registered users
                                                $sql ="SELECT userid FROM register";
                                                $query = $conn->query($sql);
                                                $regusers = $query->num_rows;
                                            ?>
                                            <div class="stat-panel-number h1"><?php echo htmlentities($regusers); ?></div>
                                            <div class="stat-panel-title text-uppercase">Reg Users</div>
                                            
                                        </div>
                                    </div>
                                    <a href="reg-users.php" class="block-anchor panel-footer">Full Detail <i class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="panel panel-default">
                                    <div class="panel-body bk-success text-light">
                                        <div class="stat-panel">
                                            <?php 
                                                // Count listed vehicles
                                                $sql = "SELECT car_id FROM cars";
                                                $query = $conn->query($sql);
                                                $totalvehicles = $query->num_rows;
                                            ?>
                                            <div class="stat-panel-number h1"><?php echo htmlentities($totalvehicles); ?></div>
                                            <div class="stat-panel-title text-uppercase">Listed Vehicles</div>
                                        </div>
                                    </div>
                                    <a href="manage-vehicles.php" class="block-anchor panel-footer text-center">Full Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="panel panel-default">
                                    <div class="panel-body bk-info text-light">
                                        <div class="stat-panel">
                                            <?php 
                                                // Count bookings
                                                $sql = "SELECT id FROM bookings";
                                                $query = $conn->query($sql);
                                                $bookings = $query->num_rows;
                                            ?>
                                            <div class="stat-panel-number h1"><?php echo htmlentities($bookings); ?></div>
                                            <div class="stat-panel-title text-uppercase">Total Bookings</div>
                                        </div>
                                    </div>
                                    <a href="manage-bookings.php" class="block-anchor panel-footer text-center">Full Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                            <!-- Additional rows for other statistics and functionalities can be added here -->
                        </div>
                    </div>
                </div>

                <!-- Additional rows for other statistics and functionalities can be added here -->

            </div>
        </div>
    </div>

    <!-- JavaScript includes -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap-select.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>
    <script src="js/Chart.min.js"></script>
    <script src="js/fileinput.js"></script>
    <script src="js/chartData.js"></script>
    <script src="js/main.js"></script>

    <script>
        // Ensure the page is fully loaded before executing scripts
        $(document).ready(function() {
            // Toggle sidebar menu
            $('.ts-sidebar-menu .menu-item-has-children > a').on('click', function(e) {
                e.preventDefault();
                var $parent = $(this).closest('li');
                $parent.toggleClass('open');
                $parent.find('.sub-menu').slideToggle(200);
            });

            // Activate current menu item
            var currentUrl = window.location.href;
            $('.ts-sidebar-menu a').filter(function() {
                return this.href == currentUrl;
            }).parentsUntil('.ts-sidebar-menu', 'li').addClass('current').addClass('open'); // Ensure the current item's parents are also marked as open

            // Close sidebar on smaller screens when a link is clicked
            $('.ts-sidebar-menu a').on('click', function() {
                if ($(window).width() < 768) {
                    $('.ts-sidebar').removeClass('open');
                }
            });

            // Toggle sidebar on smaller screens
            $('.menu-toggle-btn').on('click', function() {
                $('.ts-sidebar').toggleClass('open');
            });
        });
    </script>

</body>
</html>
