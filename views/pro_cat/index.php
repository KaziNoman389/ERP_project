<?php include('../../controller/sessions.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <!-- static title data -->
    <title>AIR - <?php echo $get_title; ?> </title>



    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="../../assets/images/favicon.ico">

    <!-- Plugins css -->
    <link href="../../plugins/select2/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="../../plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
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
                        <div class="page-title-box pb-1">
                            <div class="row">
                                <div class="col-md-3">
                                    <h4 class="page-title"><?php echo $get_title; ?></h4>
                                </div>
                                <!--end col-->
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <button class="btn btn-secondary" type="button" id="button-addon1"><i
                                                class="fas fa-search"></i></button>
                                        <input autocomplete="off" type="text" class="form-control search" name="search"
                                            id="search_input" placeholder="Search Product Categories">
                                        <select name="search_category" id="search_select">
                                            <option value="">
                                                -- Choose category --
                                            </option>
                                            <option value="1">Name</option>
                                            <option value="2">Category</option>
                                            <option value="3">Status</option>
                                        </select>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-md-5 text-end mt-1">
                                    <!-- print button -->
                                    <!-- <a class="btn btn-sm btn-outline-primary printButton" data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="Print">
                                        <i class="align-self-center fa fa-print icon-xs"></i></a> -->

                                    <!-- add new modal -->
                                    <a data-bs-toggle="modal" data-bs-target="#create_new" href="#"
                                        class="btn btn-sm btn-outline-primary" data-toggle="tooltip"
                                        data-placement="left" title="Create New">
                                        <i class="align-self-center fa fa-plus icon-xs"></i>
                                    </a>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                        <!--end page-title-box-->
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
                <!-- end page title end breadcrumb -->


                <!-- ----------------------------------------------------------------------------------------------------- -->
                <!-- ---------------------------------------------Table Start--------------------------------------------- -->
                <!-- ----------------------------------------------------------------------------------------------------- -->
                <div class="card border-0">
                    <div class="card-body p-1">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered mb-0">
                                <thead style="border: 1px solid #eaf0f9;background: #ebebeb; line-height:0.8;">
                                    <tr>
                                        <th style="width: 3%;">#</th>
                                        <th style="width: 47%;">Name</th>
                                        <th style="width: 35%;">Category</th>
                                        <th style="width: 10%;">Status</th>
                                        <th class="text-center" style="width: 5%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="product_categories_table">

                                </tbody>
                            </table>
                            <!--end /table-->
                        </div>
                        <!--end /tableresponsive-->
                    </div>
                </div>

                <!-- --------------------------------------------------------------------------------------------------- -->
                <!-- ---------------------------------------------Table End--------------------------------------------- -->
                <!-- --------------------------------------------------------------------------------------------------- -->


            </div><!-- container -->

            <?php include('../../include/footer.php') ?>
        </div>
        <!-- end page content -->
    </div>
    <!-- end page-wrapper -->


    <!-- ****************************************************************************** -->
    <!-- ********************************* Add Form *********************************** -->
    <!-- ****************************************************************************** -->

    <div class="modal fade bd-example-modal-lg" id="create_new" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title m-0" id="myLargeModalLabel">Create Product Categories</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!--end modal-header-->
                <div class="modal-body">
                    <form id="add_product_categories_form" method="POST">
                        <div class="card-body">
                            <div class="row">
                                <div class="row">
                                    <!-- Product Name dropdown -->
                                    <div class="col-md-6 mb-3">
                                        <h6>Name</h6>
                                        <input class="form-control" type="text" name="add_name" id="add_name" />
                                    </div>

                                    <!-- Main Product Category dropdown -->
                                    <div class="col-md-6 mb-3">
                                        <label for="add_sub_of_list">
                                            <h6>Main Category</h6>
                                        </label>

                                        <input type="text" name="m_cat_id" id="m_cat_id" hidden />
                                        <select class="form-control select2 custom-select js-example-basic-single"
                                            style="width: 100%; height:36px;" name="add_sub_of_list"
                                            id="add_sub_of_list">
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- status dropdown -->
                                    <div class="col-md-6 mt-3">
                                        <label>Status</label>
                                        <select name="add_status" id="add_status" class="form-control">
                                            <option value="1">Active</option>
                                            <option value="0">In Active</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12  mt-3">
                                        <input type="text" name="oper" value="add" hidden />
                                        <button type="submit"
                                            class="btn btn-primary btn-square btn-outline-dashed">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!--end modal-body-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-soft-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                </div>
                <!--end modal-footer-->
            </div>
            <!--end modal-content-->
        </div>
        <!--end modal-dialog-->
    </div>



    <!-- ****************************************************************************** -->
    <!-- ********************************* Edit Form ********************************** -->
    <!-- ****************************************************************************** -->

    <div class="modal fade bd-example-modal-lg" id="modal_edit" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title m-0" id="myLargeModalLabel">Edit Product Categories</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!--end modal-header-->
                <div class="modal-body">
                    <form id="edit_product_categories_form" method="POST">
                        <div class="card-body">
                            <div class="row">
                                <div class="row">
                                    <input type="text" name="edit_id" id="edit_id" hidden />

                                    <!-- Product Name dropdown -->
                                    <div class="col-md-6 mb-3">
                                        <h6>Name</h6>
                                        <input class="form-control" type="text" name="edit_name" id="edit_name" />
                                    </div>

                                    <!-- Main Product Category dropdown -->
                                    <div class="col-md-6 mb-3">
                                        <label for="edit_sub_of_list">
                                            <h6>Main Category</h6>
                                        </label>

                                        <input type="text" name="edit_m_cat_id" id="edit_m_cat_id" hidden />
                                        <select class="form-control select2 custom-select js-example-basic-single"
                                            style="width: 100%; height:36px;" name="edit_sub_of_list"
                                            id="edit_sub_of_list">
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- status dropdown -->
                                    <div class="col-md-6 mt-3">
                                        <label>Status</label>
                                        <select name="edit_status" id="edit_status" class="form-control">
                                            <option value="1">Active</option>
                                            <option value="0">In Active</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12  mt-3">
                                        <input type="text" name="oper" value="edit" hidden />
                                        <button type="submit"
                                            class="btn btn-primary btn-square btn-outline-dashed">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-soft-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

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
    <!-- <script src="../../plugins/huebee/huebee.pkgd.min.js"></script> -->
    <script src="../../plugins/timepicker/bootstrap-material-datetimepicker.js"></script>
    <script src="../../plugins/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
    <script src="../../plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js"></script>

    <!-- <script src="../../assets/js/jquery.forms-advanced.js"></script> -->

    <!-- App js -->
    <script src="../../assets/js/app.js"></script>
    <script src="../../plugins/sweet-alert2/sweetalert2.min.js"></script>
    <script src="../../assets/js/pagejs/product_categories.js"></script>

</body>

</html>


<style>
td {
    height: 24px;
    font-size: 12px;
    padding: 0px 4px !important;
}

td p {
    margin-bottom: 0px !important;
    font-size: 11px;
    color: #000000;
}

.modal {
    z-index: 1050 !important;
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 31px !important;
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 32px !important;
}

.select2-container--default .select2-selection--single {
    height: 33.5px !important;
}

.select2-selection__rendered,
.select2-selection__choice {
    font-size: 11px;
}
</style>

<!-- Js for Select2 -->
<script>
$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>


<!-- Js for tooltip -->
<script>
$(document).ready(function() {
    $('[data-bs-toggle="tooltip"]').tooltip();
    $('[data-toggle="tooltip"]').tooltip();
});
</script>