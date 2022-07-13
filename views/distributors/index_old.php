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
                                            name="search_input" id="search_input" placeholder="Search Distributor">
                                        <select name="search_distributor" id="search_select">
                                            <option value="">
                                                -- Choose category --
                                            </option>
                                            <option value="1">Code</option>
                                            <option value="2">Name</option>
                                            <option value="3">Address</option>
                                            <option value="4">Regions</option>
                                            <option value="5">Depots</option>
                                            <option value="6">Areas</option>
                                            <option value="7">Territories</option>
                                            <option value="8">Status</option>
                                            <option value="9">Approve</option>
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
                        <div class="table-responsive fixed-thead">
                            <table class="table table-bordered table-striped mb-0 printArea">
                                <thead style="border: 1px solid #eaf0f9;background: #ebebeb; line-height: 0.8;">
                                    <tr>
                                        <th>#</th>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Regions</th>
                                        <th>Depots</th>
                                        <th>Areas</th>
                                        <th>Territories</th>
                                        <th>Status</th>
                                        <th>Approve</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="distribution_table">
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
    <!-- ********************************* Add Form *********************************** -->
    <!-- ****************************************************************************** -->


    <div class="modal fade bd-example-modal-lg" id="create_new" aria-labelledby="myLargeModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title m-0" id="myLargeModalLabel">Create distributors</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!--end modal-header-->
                <div class="modal-body">
                    <form id="add_distributors_form" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Distributors Code</label>
                                    <input type="text" class="form-control" id="add_code" name="add_code"
                                        placeholder="Add Distributors Code" maxlength="10" required>
                                </div>
                                <div class="col-md-6">
                                    <label>Distributors Name</label>
                                    <input type="text" class="form-control" id="add_name" name="add_name"
                                        placeholder="Add Distributors Name" maxlength="100" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mt-3">
                                    <label>Distributors Address</label>
                                    <textarea type="text" class="form-control" id="add_address" name="add_address"
                                        placeholder="Add Distributors Address" required></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mt-3">
                                    <label>Owner Name</label>
                                    <input type="text" class="form-control" id="add_o_name" name="add_o_name"
                                        placeholder="Add Owner Name" maxlength="100" required>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <label>Owner Mobile</label>
                                    <input type="text" class="form-control" id="add_o_mobile" name="add_o_mobile"
                                        placeholder="Add Owner Mobile" maxlength="100" required>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <label>Owner Phone</label>
                                    <input type="text" class="form-control" id="add_o_phone" name="add_o_phone"
                                        placeholder="Add Owner Phone" maxlength="10" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mt-3">
                                    <label>Owner Address</label>
                                    <textarea type="text" class="form-control" id="add_o_address" name="add_o_address"
                                        placeholder="Add Owner Address" required></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mt-3">
                                    <label>Trade License Number</label>
                                    <input type="text" class="form-control" id="add_tl_num" name="add_tl_num"
                                        placeholder="Add Trade License Number" maxlength="100" required>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label>Trade License Image</label>
                                    <!-- Select file to upload: -->
                                    <div>
                                        <input type="file" class="form-control" id="add_image1" name="add_image1"
                                            accept=".jpg,.jpeg,.png"
                                            onchange="document.getElementById('add_view_img1').src = window.URL.createObjectURL(this.files[0])"
                                            required />
                                        <div class="add_tl_image"> </div>
                                        <img id="add_view_img1" alt="Trade License  Image" width="80" height="100" />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 mt-3">
                                    <label>Rental Deed (Image)</label>
                                    <!-- Select file to upload: -->
                                    <div>
                                        <input type="file" class="form-control" id="add_rental_deed"
                                            name="add_rental_deed" accept=".jpg,.jpeg,.png"
                                            onchange="document.getElementById('add_view_rd').src = window.URL.createObjectURL(this.files[0])"
                                            required />
                                        <div class="add_rd_image"> </div>
                                        <img id="add_view_rd" alt="Rental Deed Image" width="80" height="100" />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mt-3">
                                    <label>Agreement Number</label>
                                    <input type="text" class="form-control" id="add_agree_num" name="add_agree_num"
                                        placeholder="Add Agreement Number" maxlength="10" required>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label>Agreement Image</label>
                                    <!-- Select file to upload: -->
                                    <div>
                                        <input type="file" class="form-control" id="add_image2" name="add_image2"
                                            accept=".jpg,.jpeg,.png"
                                            onchange="document.getElementById('add_view_img2').src = window.URL.createObjectURL(this.files[0])"
                                            required />
                                        <div class="add_ag_image"> </div>
                                        <img id="add_view_img2" alt="Aggrement Image" width="80" height="100" />
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6 mt-3">
                                    <label>Rating</label>
                                    <input type="text" class="form-control" id="add_rating" name="add_rating"
                                        placeholder="Add Rating" maxlength="10" required>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="add_distri_type">Distributors type</label>
                                    <select class="form-control select2 custom-select js-example-basic-single"
                                        style="width: 100%; height:36px;" id="add_distri_type" name="add_distri_type"
                                        required>
                                        <option value="#" disabled>-- Select --</option>
                                        <option value="MT">MT</option>
                                        <option value="REG">REG</option>
                                        <option value="EV">EV</option>
                                        <option value="ONLN">ONLN</option>
                                        <option value="PRLR">PRLR</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Region dropdown -->
                                <div class="col-md-3 mt-3">
                                    <input type="hidden" id="org_id_add" name="org_id_add"
                                        data-value="<?php echo $org_id;?>" />
                                    <label for="region">Region</label>
                                    <select class="form-control select2 custom-select js-example-basic-single"
                                        style="width: 100%; height:36px;" id="region_list" name="region_list" required>

                                    </select>
                                </div>

                                <!-- Depot dropdown -->
                                <div class="col-md-3 mt-3">
                                    <label for="region_list">Depot</label>
                                    <select class="form-control select2 custom-select js-example-basic-single"
                                        style="width: 100%; height:36px;" id="depot_list" name="depot_list" required>

                                    </select>
                                </div>

                                <!-- Area dropdown -->
                                <div class="col-md-3 mt-3">
                                    <label for="depot_list">Area</label>
                                    <select class="form-control select2 custom-select js-example-basic-single"
                                        style="width: 100%; height:36px;" id="area_list" name="area_list" required>

                                    </select>
                                </div>
                                <!-- Territory dropdown -->
                                <div class="col-md-3 mt-3">
                                    <label for="area_list">Territory</label>
                                    <select class="form-control select2 custom-select js-example-basic-single"
                                        style="width: 100%; height:36px;" id="add_territory_list"
                                        name="add_territory_list" required>

                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mt-3">
                                    <label>Status</label>
                                    <select name="add_status" id="add_status" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">In Active</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label>Approve</label>
                                    <select name="add_is_approve" id="add_is_approve" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">In Active</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12  mt-3">
                                    <input type="text" name="oper" value="add" hidden />
                                    <button type="submit" class="btn btn-primary btn-square btn-outline-dashed"
                                        id="add_distributors">Save</button>
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
    <!-- ********************************* Edit Form *********************************** -->
    <!-- ****************************************************************************** -->

    <div class="modal fade bd-example-modal-lg" id="modal_edit" aria-labelledby="myLargeModalLabel3" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title m-0" id="myLargeModalLabel3">Edit distributors</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!--end modal-header-->
                <div class="modal-body">
                    <form id="edit_distributors_form" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Distributors Code</label>
                                    <input type="text" id="edit_id" name="edit_id" hidden>
                                    <input type="text" class="form-control" id="edit_code" name="edit_code">
                                </div>
                                <div class="col-md-6">
                                    <label>Distributors Name</label>
                                    <input type="text" class="form-control" id="edit_name" name="edit_name">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mt-3">
                                    <label>Distributors Address</label>
                                    <textarea type="text" class="form-control" id="edit_address"
                                        name="edit_address"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mt-3">
                                    <label>Owner Name</label>
                                    <input type="text" class="form-control" id="edit_o_name" name="edit_o_name">
                                </div>
                                <div class="col-md-4 mt-3">
                                    <label>Owner Mobile</label>
                                    <input type="text" class="form-control" id="edit_o_mobile" name="edit_o_mobile">
                                </div>
                                <div class="col-md-4 mt-3">
                                    <label>Owner Phone</label>
                                    <input type="text" class="form-control" id="edit_o_phone" name="edit_o_phone">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mt-3">
                                    <label>Owner Address</label>
                                    <textarea type="text" class="form-control" id="edit_o_address"
                                        name="edit_o_address"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mt-3">
                                    <label>Trade License Number</label>
                                    <input type="text" class="form-control" id="edit_tl_num" name="edit_tl_num">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label>Trade License Image</label>
                                    <input type="file" class="form-control" id="edit_image1" name="edit_image1"
                                        accept=".jpg,.jpeg,.png"
                                        onchange="document.getElementById('edit_view_img1').src = window.URL.createObjectURL(this.files[0])">
                                    <div class="edit_tl_image"> </div>
                                    <img id="edit_view_img1" alt="Trade License Image" width="80" height="100" />
                                    <input type="text" id="old_image1" name="old_image1" hidden>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mt-3">
                                    <label>Rental Deed (Image)</label>
                                    <!-- Select file to upload: -->
                                    <div>
                                        <input type="file" class="form-control" id="edit_rental_deed"
                                            name="edit_rental_deed" accept=".jpg,.jpeg,.png"
                                            onchange="document.getElementById('edit_view_rd').src = window.URL.createObjectURL(this.files[0])">
                                        <div class="edit_rd_image"> </div>
                                        <img id="edit_view_rd" alt="Rental Deed Image" width="80" height="100" />
                                        <input type="text" id="old_image3" name="old_image3" hidden>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mt-3">
                                    <label>Agreement Number</label>
                                    <input type="text" class="form-control" id="edit_agree_num" name="edit_agree_num">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label>Agreement Image</label>
                                    <input type="file" class="form-control" id="edit_image2" name="edit_image2"
                                        accept=".jpg,.jpeg,.png"
                                        onchange="document.getElementById('edit_view_img2').src = window.URL.createObjectURL(this.files[0])">
                                    <div class="edit_ag_image"> </div>
                                    <img id="edit_view_img2" alt="Agreement Image" width="80" height="100" />
                                    <input type="text" id="old_image2" name="old_image2" hidden>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mt-3">
                                    <label>Rating</label>
                                    <input type="text" class="form-control" id="edit_rating" name="edit_rating">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="edit_distri_type">Distributors type</label>
                                    <select class="form-control select2 custom-select js-example-basic-single"
                                        style="width: 100%; height:36px;" id="edit_distri_type" name="edit_distri_type">
                                        <option value="#" disabled>-- Select --</option>
                                        <option value="MT">MT</option>
                                        <option value="REG">REG</option>
                                        <option value="EV">EV</option>
                                        <option value="ONLN">ONLN</option>
                                        <option value="PRLR">PRLR</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Region dropdown -->
                                <div class="col-md-3 mt-3">
                                    <input type="text" id="org_id" name="org_id" hidden>
                                    <label for="region">Region</label>
                                    <select class="form-control select2 custom-select js-example-basic-single"
                                        style="width: 100%; height:36px;" id="edit_region_list" name="edit_region_list">

                                    </select>
                                </div>

                                <!-- Depot dropdown -->
                                <div class="col-md-3 mt-3">
                                    <input type="text" id="depot_id" name="depot_id" hidden>
                                    <label for="region">Depot</label>
                                    <select class="form-control select2 custom-select js-example-basic-single"
                                        style="width: 100%; height:36px;" id="edit_depot_list" name="edit_depot_list">

                                    </select>
                                </div>

                                <!-- Area dropdown -->
                                <div class="col-md-3 mt-3">
                                    <input type="text" id="area_id" name="area_id" hidden>
                                    <label for="region">Area</label>
                                    <select class="form-control select2 custom-select js-example-basic-single"
                                        style="width: 100%; height:36px;" id="edit_area_list" name="edit_area_list">

                                    </select>
                                </div>

                                <!-- Territory dropdown -->
                                <div class="col-md-3 mt-3">
                                    <label for="area_list">Territory</label>
                                    <input type="text" id="territory_id" name="territory_id" hidden>
                                    <select class="form-control select2 custom-select js-example-basic-single"
                                        style="width: 100%; height:36px;" id="edit_territory_list"
                                        name="edit_territory_list">

                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6  mt-3">
                                    <label>Status</label>
                                    <select name="edit_status" id="edit_status" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">In Active</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label>Approve</label>
                                    <select name="edit_is_approve" id="edit_is_approve" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">In Active</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12  mt-3">
                                    <input type="text" name="oper" value="edit" hidden />
                                    <button type="submit" class="btn btn-primary btn-square btn-outline-dashed"
                                        id="edit_distributors">Save</button>
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
    <script src="../../assets/js/pagejs/distributors.js"></script>

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

.add_tl_image,
.add_ag_image,
.add_rd_image,
.edit_tl_image,
.edit_ag_image,
.edit_rd_image {
    color: #ff0000;
    text-transform: capitalize;
    font-size: bold;
}
</style>


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