<?php include('../../controller/sessions.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <!-- static title data -->
    <title>AIR - <?php echo $get_title; ?></title>

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

    <!-- start page-wrapper -->
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
                                        <input autocomplete="off" type="text" class="form-control search"
                                            name="search_input" id="search_input"
                                            placeholder="Search Distributor Target">
                                        <select name="search_distributor" id="search_select">
                                            <option value="">
                                                -- Choose category --
                                            </option>
                                            <option value="1">Name</option>
                                            <option value="2">Effective From</option>
                                            <option value="3">Effective till</option>
                                            <option value="4">Status</option>
                                        </select>
                                    </div>
                                </div>
                                <!--end col-->

                                <div class="col-md-5 text-end mt-1">
                                    <!-- print button -->
                                    <a class="btn btn-sm btn-outline-primary printButton " data-bs-toggle="tooltip"
                                        data-bs-placement="bottom" title="Print"><i
                                            class="align-self-center fa fa-print icon-xs"></i></a>

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
                        <!--end Page-Title-->
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->


                <!-- ----------------------------------------------------------------------------------------------------- -->
                <!-- ---------------------------------------------Table Start--------------------------------------------- -->
                <!-- ----------------------------------------------------------------------------------------------------- -->
                <div class="card border-0">
                    <div class="card-body p-1">
                        <div class="table-responsive fixed-thead">
                            <table class="table table-bordered table-striped mb-0 printArea">
                                <thead style="border: 1px solid #eaf0f9;background: #ebebeb; line-height: 0.8;">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Effective From</th>
                                        <th>Effective till</th>
                                        <th>Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="distribution_target_table">

                                </tbody>
                            </table>
                            <!--end /table-->
                        </div>
                        <!--end /tableresponsive-->
                    </div>
                </div>

                <!-- ----------------------------------------------------------------------------------------------------- -->
                <!-- ---------------------------------------------Table End--------------------------------------------- -->
                <!-- ----------------------------------------------------------------------------------------------------- -->

            </div><!-- container -->

            <?php include('../../include/footer.php') ?>
        </div>
        <!-- end page content -->
    </div>
    <!-- end page-wrapper -->


    <!-- ****************************************************************************** -->
    <!-- ********************************* View Form ********************************** -->
    <!-- ****************************************************************************** -->

    <div class="modal fade bd-example-modal-lg" id="modal_view" aria-labelledby="myLargeModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title m-0" id="myLargeModalLabel">View Distributors Target</h6>
                    <!-- print button -->
                    <div id="print_div" class="ms-2"></div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!--end modal-header-->
                <div class="modal-body">

                    <form id="view_distributors_target_form" method="POST">
                        <div class="card">
                            <div class="card-body">
                                <input type="text" id="view_id" name="view_id" hidden>
                                <div class="fixed-thead" style="overflow-x: hidden;">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="card border-0">
                                                <div class="card-body p-1">
                                                    <div class="table-responsive" tabindex="0" class="focusable"
                                                        style="overflow-x: hidden;">
                                                        <input type="text" name="t_id" id="t_id" hidden />

                                                        <div class="row">
                                                            <!-- Region dropdown -->
                                                            <div class="col-md-3 mb-2">
                                                                <input type="hidden" id="org_id_add" name="org_id_add"
                                                                    data-value="<?php echo $org_id;?>" />
                                                                <label for="region">Region</label>
                                                                <select
                                                                    class="form-control select2 custom-select js-example-basic-single"
                                                                    style="width: 100%; height:36px;" id="region_list"
                                                                    name="region_list" required>

                                                                </select>
                                                            </div>

                                                            <!-- Depot dropdown -->
                                                            <div class="col-md-3 mb-2">
                                                                <label for="region_list">Depot</label>
                                                                <select
                                                                    class="form-control select2 custom-select js-example-basic-single"
                                                                    style="width: 100%; height:36px;" id="depot_list"
                                                                    name="depot_list" required>

                                                                </select>
                                                            </div>

                                                            <!-- Area dropdown -->
                                                            <div class="col-md-3 mb-2">
                                                                <label for="depot_list">Area</label>
                                                                <select
                                                                    class="form-control select2 custom-select js-example-basic-single"
                                                                    style="width: 100%; height:36px;" id="area_list"
                                                                    name="area_list" required>

                                                                </select>
                                                            </div>

                                                            <!-- Territory dropdown -->
                                                            <div class="col-md-3 mb-2">
                                                                <label for="area_list">Territory</label>
                                                                <select
                                                                    class="form-control select2 custom-select js-example-basic-single"
                                                                    style="width: 100%; height:36px;"
                                                                    id="territory_list" name="territory_list" required>

                                                                </select>
                                                            </div>
                                                        </div>

                                                        <table class="table table-striped table-bordered mb-0">
                                                            <thead
                                                                style="border: 1px solid #eaf0f9;background: #ebebeb; line-height:0.8;">
                                                                <tr>
                                                                    <th style="width: 5%;">#</th>
                                                                    <th style="width: 20%;">Distributors</th>
                                                                    <th style="width: 15%;">Region</th>
                                                                    <th style="width: 15%;">Depot</th>
                                                                    <th style="width: 15%;">Area</th>
                                                                    <th style="width: 15%;">Territory</th>
                                                                    <th class="text-center" style="width: 15%;">Target
                                                                        Amount
                                                                    </th>
                                                                </tr>
                                                            </thead>

                                                            <tbody id="distribution_target_view_table">

                                                            </tbody>
                                                        </table>
                                                        <!--end /table-->
                                                    </div>
                                                    <!--end /tableresponsive-->
                                                </div>
                                            </div>
                                        </div>
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
        </div>
        <!--end modal-content-->
    </div>
    <!--end modal-dialog-->
    </div>


    <!-- ****************************************************************************** -->
    <!-- ********************************* Add Form *********************************** -->
    <!-- ****************************************************************************** -->

    <div class="modal fade bd-example-modal-lg" id="create_new" aria-labelledby="myLargeModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title m-0" id="myLargeModalLabel">Create Distributors Target</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!--end modal-header-->
                <div class="modal-body">
                    <form id="add_distributors_target_form" method="POST">

                        <div class="card border-0">
                            <div class="card-body">
                                <div class="table-responsive fixed-thead" style="overflow-x: hidden;">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="row">
                                                <div class="col-md-12 mt-3">
                                                    <label for="add_name" class="p-0">
                                                        <h6 class="mt-2">Name :</h6>
                                                    </label>
                                                    <input type="text" class="form-control" name="add_name"
                                                        id="add_name" placeholder="Enter Distributor Target Name"
                                                        required />
                                                </div>
                                            </div>

                                            <!-- start & closing approval date -->
                                            <div class="row">
                                                <div class="col-md-6 mt-3">
                                                    <label for="add_eff_from" class="p-0">
                                                        <h6 class="mt-2">Effective From Date :</h6>
                                                    </label>
                                                    <input type="text" class="form-control" name="add_eff_from"
                                                        id="add_eff_from" placeholder="Enter Effective From Date"
                                                        style="height: 30px!important;" onfocus="(this.type='date')"
                                                        onblur="if(this.value==''){this.type='text'}" required
                                                        data-date-format="DD MMMM YYYY" />
                                                </div>
                                                <div class="col-md-6 mt-3 pe-0">
                                                    <label for="add_eff_till" class="p-0">
                                                        <h6 class="mt-2">Effective Till Date :</h6>
                                                    </label>
                                                    <input type="text" class="form-control" name="add_eff_till"
                                                        id="add_eff_till" placeholder="Enter Effective till Date"
                                                        style="height: 30px!important;" onfocus="(this.type='date')"
                                                        onblur="if(this.value==''){this.type='text'}" required
                                                        data-date-format="DD MMMM YYYY" />
                                                </div>
                                            </div>

                                            <!-- is_active part -->
                                            <div class="row">
                                                <div class="col-md-6 mt-3">
                                                    <label for="add_status" class="p-0">
                                                        <h6 class="mt-2">Status :</h6>
                                                    </label>
                                                    <select name="add_status" id="add_status" class="form-control"
                                                        style="height: 30px!important;">
                                                        <option value="1">Active</option>
                                                        <option value="0">In Active</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- save button -->
                                            <div class="row">
                                                <div class="col-md-12 mt-3">
                                                    <input type="text" name="oper" value="add" hidden>
                                                    <button type="submit"
                                                        class="btn btn-primary btn-square btn-outline-dashed"
                                                        id="add_distributor_target">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end /table responsive-->
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

    <div class="modal fade bd-example-modal-lg" id="modal_edit" aria-labelledby="myLargeModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title m-0" id="myLargeModalLabel">Edit Distributors Target</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!--end modal-header-->
                <div class="modal-body">

                    <form id="edit_distributors_target_form" method="POST">
                        <div class="card border-0">
                            <div class="card-body">
                                <div class="table-responsive fixed-thead" style="overflow-x: hidden;">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <input type="text" name="edit_id" id="edit_id" hidden />
                                            <div class="row">
                                                <div class="col-md-12 mt-3">
                                                    <label for="edit_name" class="p-0">
                                                        <h6 class="mt-2">Name :</h6>
                                                    </label>
                                                    <input type="text" class="form-control" name="edit_name"
                                                        id="edit_name" />
                                                </div>
                                            </div>

                                            <!-- start & closing approval date -->
                                            <div class="row">
                                                <div class="col-md-6 mt-3">
                                                    <label for="edit_eff_from" class="p-0">
                                                        <h6 class="mt-2">Effective From Date :</h6>
                                                    </label>
                                                    <input type="text" class="form-control" name="edit_eff_from"
                                                        id="edit_eff_from" placeholder="Edit Effective From Date"
                                                        style="height: 30px!important;" onfocus="(this.type='date')"
                                                        onblur="if(this.value==''){this.type='text'}" required
                                                        data-date-format="DD MMMM YYYY" />
                                                </div>
                                                <div class="col-md-6 mt-3 pe-0">
                                                    <label for="edit_eff_till" class="p-0">
                                                        <h6 class="mt-2">Effective Till Date :</h6>
                                                    </label>
                                                    <input type="text" class="form-control" name="edit_eff_till"
                                                        id="edit_eff_till" placeholder="Edit Effective till Date"
                                                        style="height: 30px!important;" onfocus="(this.type='date')"
                                                        onblur="if(this.value==''){this.type='text'}" required
                                                        data-date-format="DD MMMM YYYY" />
                                                </div>
                                            </div>

                                            <!-- is_active part -->
                                            <div class="row">
                                                <div class="col-md-6 mt-3">
                                                    <label for="edit_status" class="p-0">
                                                        <h6 class="mt-2">Status :</h6>
                                                    </label>
                                                    <select name="edit_status" id="edit_status" class="form-control"
                                                        style="height: 30px!important;">
                                                        <option value="1">Active</option>
                                                        <option value="0">In Active</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- save button -->
                                            <div class="row">
                                                <div class="col-md-12 mt-3">
                                                    <input type="text" name="oper" value="edit" hidden />
                                                    <button type="submit"
                                                        class="btn btn-primary btn-square btn-outline-dashed"
                                                        id="edit_distributor_target">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end /table responsive-->
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



    <!-- jQuery  -->
    <script src="../../assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
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
    <script src="../../assets/js/pagejs/distributors_target.js"></script>

</body>

</html>

<style>
hr {
    color: #000000;
}

.fixed-thead thead th {
    background: #f4f5f7;
}

td {
    height: 0;
    font-size: 11px;
    padding: 0px 4px !important;
}

td p {
    margin-bottom: 0px !important;
    font-size: 11px;
    color: #000000;
    /* text-align: end; */
    text-transform: capitalize;
}

table {
    width: 100%;
}

#p1 td p,
#p2 td p,
#p3 td p,
#p4 td p,
#p5 td p,
#p6 td p {
    text-decoration: none;
    color: black;
    font-size: 11px;
}

#part1_body td,
#part2_body td,
#part3_body td,
#part4_body td,
#part5_body td,
#part6_body td {
    text-decoration: none;
    color: black;
    font-size: 9px;
}

.t_parts p {
    text-decoration: none;
    color: black;
    font-size: 9px;
    /* text-align: center; */
}

#last_text p {
    font-size: 9px;
    margin: 0px;
    color: #000000;
}

#last_text h6 {
    font-size: 10px;
    margin: 0px;
    font-weight: 800;
}

#sign #sp {
    margin-top: 40px;
    margin-bottom: 0px;
    color: #000000;
}

#sign p {
    margin-left: 55px;
    color: #000000;
}

td,
tr,
th {
    border: 1px solid #f1f5fa;
    border-collapse: collapse;
    font-size: 9px !important;
    color: #000000;
}

textarea {
    border: 1px solid #f1f5fa;
    text-decoration: none;
    color: black;
    font-size: 9px;
}

tbody input {
    height: 15px;
}

h4 {
    margin-top: 0px;
    margin-bottom: 5px;
}

.h {
    text-align: center;
}

h3,
h6 {
    text-decoration: none;
    color: black;
    margin-top: 5px;
    margin-bottom: 0px;
}

p {
    text-decoration: none;
    color: black;
    margin-bottom: 0px;
}

input {
    border: 1px solid #e3ebf6;
}

#heading {
    font-size: 11px !important;
    margin-top: 5px !important;
}

.form-control,
.view {
    text-transform: capitalize;
}

#error_message_add,
#error_message_add1,
#error_message_add2,
#error_message_add3,
#error_message_edit,
#error_message_edit1,
#error_message_edit2,
#error_message_edit3 {
    color: red;
}

.edit_label,
.add_label {
    color: #000000;
}

.view_label {
    font-size: 11px !important;
    margin-left: 5px;
    color: #000000;
}

#add_ref,
#edit_ref {
    width: 21%;
    height: 18px;
    display: inline-block;
    text-transform: capitalize;
}

.modal {
    z-index: 1050 !important;
}

.modal-content .modal-body p,
.modal-content h4 {
    color: #000000;
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 28px !important;
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 25px !important;
}

.select2-container--default .select2-selection--single {
    height: 28.25px !important;
}

#select2-edit_region_list-container,
#select2-edit_depot_list-container,
#select2-edit_area_list-container,
#select2-edit_territory_list-container,
#select2-edit_distri_list-container {
    font-size: 11px;
}
</style>

<!-- js for select2 -->
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