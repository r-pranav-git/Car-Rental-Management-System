<?php
session_start();
error_reporting(E_ALL);
include 'C:\wamp64\www\vehicle\database.php'; // Adjust the path as per your file structure

// Redirect to login page if not logged in
if (empty($_SESSION['alogin'])) {    
    header('location:index.php');
    exit();
}

// Initialize variables
$error = '';
$msg = '';

// Establish database connection using $conn (assuming it's initialized correctly)
if (!isset($conn)) {
    die('Database connection is not established.');
}

// Delete record if 'del' parameter is set in the URL
if (isset($_GET['del'])) {
    $id = $_GET['del'];
    $sql = "DELETE FROM cars WHERE car_id=?";
    $query = $conn->prepare($sql);
    if (!$query) {
        die('Query preparation failed: ' . $conn->error);
    }
    $query->bind_param('s', $id);
    $query->execute();
    if ($query->affected_rows > 0) {
        $msg = "Record deleted successfully";
    } else {
        $error = "Failed to delete record";
    }
}

// Fetch data from cars table
$sql = "SELECT * FROM cars";
$result = $conn->query($sql);

?>
<!doctype html>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="theme-color" content="#3e454c">
    
    <title>Car Rental Portal | Admin Manage Cars</title>

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
        .errorWrap {
            padding: 10px;
            margin: 0 0 20px 0;
            background: #fff;
            border-left: 4px solid #dd3d36;
            -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
            box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
        }
        .succWrap {
            padding: 10px;
            margin: 0 0 20px 0;
            background: #fff;
            border-left: 4px solid #5cb85c;
            -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
            box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
        }
        .car-image {
            width: 100px; /* Adjust size as needed */
            height: auto; /* Maintain aspect ratio */
        }
    </style>
</head>
<body>
    <?php include('includes/header.php'); ?>

    <div class="ts-main-content">
        <?php include('includes/leftbar.php'); ?>
        <div class="content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="page-title">Registered Cars</h2>
                        <div class="panel panel-default">
                            <div class="panel-heading">Registered Cars List</div>
                            <div class="panel-body">
                                <?php if($error) { ?>
                                    <div class="errorWrap"><strong>ERROR</strong>: <?php echo htmlentities($error); ?></div>
                                <?php } else if($msg) { ?>
                                    <div class="succWrap"><strong>SUCCESS</strong>: <?php echo htmlentities($msg); ?></div>
                                <?php } ?>
                                <table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Car ID</th>
                                            <th>Car Name</th>
                                            <th>Price per Day</th>
                                            <th>Image</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $cnt = 1;
                                        while ($row = $result->fetch_assoc()) {
                                        ?>
                                            <tr>
                                                <td><?php echo htmlentities($cnt); ?></td>
                                                <td><?php echo htmlentities($row['car_id']); ?></td>
                                                <td><?php echo htmlentities($row['car_name']); ?></td>
                                                <td><?php echo htmlentities($row['price_per_day']); ?></td>
                                                <td>
												<img src="<?php echo '/vehicle/' . $row['image_url']; ?>" alt="Car Image" class="car-image">

                                                </td>
                                                <td>
                                                    <a href="?del=<?php echo htmlentities($row['car_id']); ?>" onclick="return confirm('Are you sure you want to delete?');"><i class="fa fa-close"></i></a>
                                                </td>
                                            </tr>
                                        <?php
                                            $cnt++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
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
</body>
</html>
