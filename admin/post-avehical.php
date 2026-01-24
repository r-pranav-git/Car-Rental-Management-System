<?php
session_start();
error_reporting(E_ALL); // Set error reporting to show all errors

include 'C:\wamp64\www\vehicle\database.php'; // Adjust path as per your setup

if(strlen($_SESSION['alogin']) == 0) {   
    header('location:index.php');
    exit; // Ensure to exit after redirection
}

$msg = ""; // Initialize message variable
$error = ""; // Initialize error variable

if(isset($_POST['submit'])) {
    $vehicletitle = $_POST['vehicletitle'];
    $brand = $_POST['brandname'];
    $pricePerDay = $_POST['price_per_day'];
    $vimage1 = $_FILES["img1"]["name"];
    $vimage1_tmp = $_FILES["img1"]["tmp_name"];

    // Upload image to directory
    $upload_path = "images_2/";

    // Ensure the directory exists or create it if necessary
    if (!file_exists($upload_path)) {
        mkdir($upload_path, 0777, true); // Create directory recursively
    }

    // Move uploaded file to the specified directory
    if (move_uploaded_file($vimage1_tmp, $upload_path . $vimage1)) {
        // Image uploaded successfully
        $image_url = $upload_path . $vimage1;  // Store the complete path in database
        $stmt = $conn->prepare("INSERT INTO cars (car_name, brand_id, price_per_day, image_url) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("siss", $vehicletitle, $brand, $pricePerDay, $image_url);

        if ($stmt->execute()) {
            $msg = "Vehicle posted successfully";
        } else {
            $error = "Error inserting data. Please try again.";
        }
    } else {
        $error = "Error uploading image. Please try again.";
    }
}

// Fetch brands for select dropdown
$sql = "SELECT id, BrandName FROM tblbrands";
$result = $conn->query($sql);

// Check if query was successful
if($result === false) {
    $error = "Error fetching brands: " . $conn->error;
} else {
    $brands = array();
    while ($row = $result->fetch_assoc()) {
        $brands[] = $row;
    }
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
    <meta name="theme-color" content="#3e454c">
    
    <title>Car Rental Portal | Admin Post Vehicle</title>

    <!-- Font awesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Sandstone Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Admin Stye -->
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
        .succWrap{
            padding: 10px;
            margin: 0 0 20px 0;
            background: #fff;
            border-left: 4px solid #5cb85c;
            -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
            box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
        }
    </style>

</head>
<body>
    <?php include('includes/header.php');?>
    <div class="ts-main-content">
        <?php include('includes/leftbar.php');?>
        <div class="content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="page-title">Post A Vehicle</h2>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Basic Info</div>
                                    <?php if(!empty($error)) { ?>
                                        <div class="errorWrap"><strong>ERROR</strong>: <?php echo htmlentities($error); ?> </div>
                                    <?php } else if(!empty($msg)) { ?>
                                        <div class="succWrap"><strong>SUCCESS</strong>: <?php echo htmlentities($msg); ?> </div>
                                    <?php } ?>
                                    <div class="panel-body">
                                        <form method="post" class="form-horizontal" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Vehicle Title<span style="color:red">*</span></label>
                                                <div class="col-sm-4">
                                                    <input type="text" name="vehicletitle" class="form-control" required>
                                                </div>
                                                <label class="col-sm-2 control-label">Select Brand<span style="color:red">*</span></label>
                                                <div class="col-sm-4">
                                                    <select class="form-control" name="brandname" required>
                                                        <option value=""> Select </option>
                                                        <?php 
                                                        foreach($brands as $brand) {
                                                        ?>
                                                        <option value="<?php echo htmlentities($brand['id']); ?>"><?php echo htmlentities($brand['BrandName']); ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Price per Day<span style="color:red">*</span></label>
                                                <div class="col-sm-4">
                                                    <input type="number" name="price_per_day" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="hr-dashed"></div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Image 1<span style="color:red">*</span></label>
                                                <div class="col-sm-4">
                                                    <input type="file" name="img1" required>
                                                </div>
                                            </div>
                                            <div class="hr-dashed"></div>
                                            <div class="form-group">
                                                <div class="col-sm-8 col-sm-offset-2">
                                                    <button class="btn btn-default" type="reset">Cancel</button>
                                                    <button class="btn btn-primary" name="submit" type="submit">Save changes</button>
                                                </div>
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
    </div>

    <!-- Loading Scripts -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
