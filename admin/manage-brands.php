<?php
session_start();
error_reporting(E_ALL); // Set error reporting to show all errors
include 'C:\wamp64\www\vehicle\database.php'; 

if(strlen($_SESSION['alogin']) == 0) {   
    header('location:index.php');
    exit; // Ensure to exit after redirection
}

$msg = ""; // Initialize message variable
$error = ""; // Initialize error variable

if(isset($_GET['del'])) {
    $id = $_GET['del'];
    $sql = "DELETE FROM tblbrands WHERE id = ?";
    $query = $conn->prepare($sql);
    $query->bind_param("i", $id);
    if($query->execute()) {
        $msg = "Brand deleted successfully";
    } else {
        $error = "Error deleting brand: " . $conn->error;
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
    
    <title>Car Rental Portal | Admin Manage Brands</title>

    <!-- Font awesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Sandstone Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Bootstrap Datatables -->
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
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
        .succWrap {
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

                        <h2 class="page-title">Manage Brands</h2>

                        <!-- Zero Configuration Table -->
                        <div class="panel panel-default">
                            <div class="panel-heading">Listed Brands</div>
                            <div class="panel-body">
                                <?php if($error) { ?>
                                    <div class="errorWrap"><strong>ERROR</strong>: <?php echo htmlentities($error ?? ''); ?></div>
                                <?php } else if($msg) { ?>
                                    <div class="succWrap"><strong>SUCCESS</strong>: <?php echo htmlentities($msg ?? ''); ?></div>
                                <?php } ?>
                                <table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Brand Name</th>
                                            <th>Creation Date</th>
                                            <th>Updation Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM tblbrands";
                                        $result = mysqli_query($conn, $sql);
                                        $cnt = 1;
                                        while($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <tr>
                                            <td><?php echo htmlentities($cnt); ?></td>
                                            <td><?php echo htmlentities($row['BrandName'] ?? ''); ?></td>
                                            <td><?php echo htmlentities($row['CreationDate'] ?? ''); ?></td>
                                            <td><?php echo htmlentities($row['UpdationDate'] ?? ''); ?></td>
                                            <td>
                                                <a href="edit-brand.php?id=<?php echo $row['id']; ?>"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                                                <a href="manage-brands.php?del=<?php echo $row['id']; ?>" onclick="return confirm('Do you want to delete');"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <?php $cnt++; } ?>
                                    </tbody>
                                </table>
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
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>
</body>

</html>
