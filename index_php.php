<?php include('../../controller/sessions.php'); ?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>AIR - <?php echo $get_title; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="../../assets/images/favicon.ico">

        <!-- Plugins css -->
        <link href="../../plugins/select2/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="../../plugins/huebee/huebee.min.css" rel="stylesheet" type="text/css" />
        <link href="../../plugins/timepicker/bootstrap-material-datetimepicker.css" rel="stylesheet">
        <link href="../../plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />

        <!-- App css -->
        <link href="../../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/css/metisMenu.min.css" rel="stylesheet" type="text/css" />
        <link href="../../plugins/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/css/app.min.css" rel="stylesheet" type="text/css" />

    </head>

    <body>

        
        <!-- start left-sidenav-->
        <?php include('../../include/left_sidebar.php') ?>
        <!--   end left-sidenav-->
        

        <div class="page-wrapper">
            <!-- Top Bar Start -->
            <?php include('../../include/top_bar.php'); ?>
            <!-- Top Bar End -->

            <!-- Page Content-->
            <div class="page-content">
                <div class="container-fluid">
                    <!-- Page-Title -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="page-title-box">
                                <div class="row">
                                    <div class="col">
                                        <h4 class="page-title">Regions</h4>
                                    </div><!--end col-->
                                    <div class="col-auto align-self-center">
                                        <a href="#" class="btn btn-sm btn-outline-primary" id="Dash_Date">
                                            <span class="day-name" id="Day_Name">Today:</span>&nbsp;
                                            <span class="" id="Select_date">Jan 11</span>
                                            <i data-feather="calendar" class="align-self-center icon-xs ms-1"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-outline-primary">
                                            <i data-feather="download" class="align-self-center icon-xs"></i>
                                        </a>
                                    </div><!--end col-->  
                                </div><!--end row-->                                                              
                            </div><!--end page-title-box-->
                        </div><!--end col-->
                    </div><!--end row-->
                    <!-- end page title end breadcrumb -->


                    <!-- ----------------------------------------------------------------------------------------------------- -->
                    <!-- ---------------------------------------------Table Start--------------------------------------------- -->
                    <!-- ----------------------------------------------------------------------------------------------------- -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                <tr>
                                    <th>Customer</th>
                                    <th>Email</th>
                                    <th>Contact No</th>
                                    <th class="text-end">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><img src="assets/images/users/user-3.jpg" alt="" class="rounded-circle thumb-xs me-1"> Aaron Poulin</td>
                                    <td>Aaron@example.com</td>
                                    <td>+21 21547896</td>
                                    <td class="text-end">                                                       
                                        <a href="#"><i class="las la-pen text-secondary font-16"></i></a>
                                        <a href="#"><i class="las la-trash-alt text-secondary font-16"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><img src="assets/images/users/user-4.jpg" alt="" class="rounded-circle thumb-xs me-1"> Richard Ali</td>
                                    <td>Richard@example.com</td>
                                    <td>+41 21547896</td>
                                   <td class="text-end">                                                       
                                        <a href="#"><i class="las la-pen text-secondary font-16"></i></a>
                                        <a href="#"><i class="las la-trash-alt text-secondary font-16"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><img src="assets/images/users/user-5.jpg" alt="" class="rounded-circle thumb-xs me-1"> Juan Clark</td>
                                    <td>Juan@example.com</td>
                                    <td>+65 21547896</td>
                                   <td class="text-end">                                                       
                                        <a href="#"><i class="las la-pen text-secondary font-16"></i></a>
                                        <a href="#"><i class="las la-trash-alt text-secondary font-16"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><img src="assets/images/users/user-6.jpg" alt="" class="rounded-circle thumb-xs me-1"> Albert Hull</td>
                                    <td>Albert@example.com</td>
                                    <td>+88 21547896</td>
                                   <td class="text-end">                                                       
                                        <a href="#"><i class="las la-pen text-secondary font-16"></i></a>
                                        <a href="#"><i class="las la-trash-alt text-secondary font-16"></i></a>
                                    </td>
                                </tr>
                                </tbody>
                            </table><!--end /table-->
                        </div><!--end /tableresponsive-->
                    </div>
                    <!-- ----------------------------------------------------------------------------------------------------- -->
                    <!-- ---------------------------------------------Table Start--------------------------------------------- -->
                    <!-- ----------------------------------------------------------------------------------------------------- -->


                </div><!-- container -->

                <?php include('../../include/footer.php') ?>
            </div>
            <!-- end page content -->
        </div>
        <!-- end page-wrapper -->

        


        <!-- jQuery  -->
        <script src="../../assets/js/jquery.min.js"></script>
        <script src="../../assets/js/bootstrap.bundle.min.js"></script>
        <script src="../../assets/js/metismenu.min.js"></script>
        <script src="../../assets/js/waves.js"></script>
        <script src="../../assets/js/feather.min.js"></script>
        <script src="../../assets/js/simplebar.min.js"></script>
        <script src="../../assets/js/moment.js"></script>
        <script src="../../plugins/daterangepicker/daterangepicker.js"></script>

        <!-- Plugins js -->
      
        <script src="../../plugins/select2/select2.min.js"></script>
        <script src="../../plugins/huebee/huebee.pkgd.min.js"></script>
        <script src="../../plugins/timepicker/bootstrap-material-datetimepicker.js"></script>
        <script src="../../plugins/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
        <script src="../../plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js"></script>

        <script src="../../assets/js/jquery.forms-advanced.js"></script>

        <!-- App js -->
        <script src="../../assets/js/app.js"></script>
        
    </body>

</html>