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

    <!-- months -->
    <?php 
        for($i=0; $i<=6; $i++) {
            $next_six_months[] =date("M/y", strtotime( date( 'Y-m-01' )." +$i months"));
        }
    ?>
    <!-- end months -->

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
    <!-- ********************************* View Form ********************************** -->
    <!-- ****************************************************************************** -->

    <div class="modal fade bd-example-modal-lg" id="modal_view" aria-labelledby="myLargeModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title m-0" id="myLargeModalLabel">View distributors</h6>
                    <!-- print button -->
                    <div id="print_div" class="ms-2"></div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!--end modal-header-->
                <div class="modal-body">
                    <div id="print_view">
                        <div class="ref mb-3" id="part_ref">

                        </div>
                        <div class="card">
                            <div class="card-body">
                                <input type="text" id="view_id" name="view_id" hidden>
                                <div class="fixed-thead" style="overflow-x: hidden;">
                                    <div class="container-fluid">
                                        <!-- table part 1 -->
                                        <div class="row">
                                            <div class="col-4">
                                                <h4 class="h">Savoy Ice Cream</h4>
                                                <h4 class="h">Factory Limited</h4>
                                                <h6 class="h" style="text-decoration: underline;">Pre-Assessment form
                                                    for
                                                    Distrributorship
                                                </h6>
                                                <h6 class="h">(Including Market Survey Report)</h6>
                                            </div>
                                            <div class="col-6">
                                                <table class="t_parts" id="p1">
                                                    <tbody class="t_parts" id="part1_body">

                                                    </tbody>
                                                </table>
                                                <!--end /table-->
                                            </div>
                                            <div class="col-2">
                                                <div id="img">

                                                </div>
                                            </div>
                                        </div>

                                        <!-- table part 2 -->
                                        <div class="row">
                                            <div class="col">
                                                <h6 id="heading">Proposed Distributor's Information :</h6>
                                                <table class="t_parts" id="p2">
                                                    <tbody class="t_parts" id="part2_body">

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <!-- table part 3 -->
                                        <div class="row">
                                            <div class="col">
                                                <h6 id="heading">Market Information :</h6>
                                                <table class="t_parts" id="p3">
                                                    <input type="text" id="areas_dem" name="areas_dem" hidden>
                                                    <input type="text" id="routes" name="routes" hidden>
                                                    <tbody class="t_parts" id="part3_body">

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <!-- table part 4 -->
                                        <div class="row">
                                            <h6 id="heading">Competitors Intelligence : (Yearly)</h6>
                                            <div class="col">
                                                <table class="t_parts" id="p4">
                                                    <thead class="t_parts" id="part4_head">

                                                    </thead>
                                                    <tbody class="t_parts" id="part4_body">

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <!-- table part 5 -->
                                        <div class="row">
                                            <div class="col">
                                                <h6 id="heading">Expected Sales :</h6>

                                                <table class="t_parts" id="p5">
                                                    <thead class="t_parts" id="part5_head">

                                                    </thead>
                                                    <tbody class="t_parts" id="part5_body">

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <!-- table part 6 -->
                                        <div class="row">
                                            <div class="col">
                                                <h6 id="heading">Investment Information :</h6>

                                                <table class="t_parts" id="p6">
                                                    <tbody class="t_parts" id="part6_body">

                                                    </tbody>
                                                </table>
                                                <!--end /table-->
                                            </div>
                                        </div>

                                        <!-- text Area part -->
                                        <div id="part7_textarea" style="padding-left: 8px; padding-right: 8px;">

                                        </div>

                                        <!-- last text part  -->
                                        <div id="last_text">
                                            <p>N.B.: If any conspiracy is found by the audit team, the company reserves
                                                the
                                                right to amend, extend or cancel the deed or distributorship without any
                                                prior
                                                notice.</p>
                                            <h6>Attached Documents:</h6>
                                            <p>
                                                <i>1. Application for Distributorship or letter of Inhent 2. Photocopy
                                                    of
                                                    Trade
                                                    License, 3. Bank Statement (of last siox months), 4. Photocopy of
                                                    NID,
                                                    5. 2
                                                    Copies of PP size Photo of the Distributor, 6. Renewed NID of Owner
                                                    &
                                                    Nominee, 7. Certification letter of RSM, 8. Organization's BIN
                                                    Certificate
                                                    and E-Tin Certificate.
                                                </i>
                                            </p>
                                            <div id="sign">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <p>
                                                            <hr id="sp">
                                                        </p>
                                                        <p>Prepared by </p>
                                                    </div>
                                                    <div class="col-3">
                                                        <p>
                                                            <hr id="sp">
                                                        </p>
                                                        <p>Checked by </p>
                                                    </div>
                                                    <div class="col-3">
                                                        <p>
                                                            <hr id="sp">
                                                        </p>
                                                        <p>Recommended by </p>
                                                    </div>
                                                    <div class="col-3">
                                                        <p>
                                                            <hr id="sp">
                                                        </p>
                                                        <p>Approved by </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
    <!-- ********************************* Add Form *********************************** -->
    <!-- ****************************************************************************** -->

    <div class="modal fade bd-example-modal-lg" id="create_new" aria-labelledby="myLargeModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title m-0" id="myLargeModalLabel">Create distributors</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!--end modal-header-->
                <div class="modal-body">
                    <form id="add_distributors_form" method="POST" enctype="multipart/form-data">

                        <div class="card border-0">
                            <div class="card-body">
                                <div class="table-responsive fixed-thead" style="overflow-x: hidden;">
                                    <div class="container-fluid">
                                        <!-- table part 1 -->
                                        <div class="row">
                                            <div class="col-md-9 p-0">
                                                <div class="ref mb-3">
                                                    <label class="add_label" for="add_ref">Reference : </label>
                                                    <input type="text" class="form-control" id="add_ref"
                                                        name="add_ref" />
                                                </div>
                                                <table class="table table-bordered mb-0 part1">
                                                    <tbody id="">
                                                        <tr>
                                                            <td>
                                                                <p>B.P. Code :</p>
                                                            </td>
                                                            <td><input type="text" name="add_code" id="add_code"
                                                                    style="height: 18px!important; width:100%; border: 1px solid #e3ebf6;"
                                                                    required />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p>Date :</p>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control start_date"
                                                                    name="add_start_date" id="add_start_date"
                                                                    placeholder="Enter Date"
                                                                    style="height: 18px!important;"
                                                                    onfocus="(this.type='date')"
                                                                    onblur="if(this.value==''){this.type='text'}"
                                                                    data-date-format="DD MMMM YYYY" required />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p>Region :</p>
                                                            </td>
                                                            <td>
                                                                <!-- Region dropdown -->
                                                                <div class="col-md-12">
                                                                    <input type="hidden" id="org_id_add"
                                                                        name="org_id_add"
                                                                        data-value="<?php echo $org_id;?>" />
                                                                    <!-- <label for="region">Region</label> -->
                                                                    <select
                                                                        class="form-control select2 custom-select js-example-basic-single"
                                                                        style="width: 100%; height:36px;"
                                                                        id="region_list" name="region_list" required>

                                                                    </select>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p>Depot :</p>
                                                            </td>
                                                            <td>
                                                                <!-- Depot dropdown -->
                                                                <div class="col-md-12">
                                                                    <!-- <label for="region_list">Depot</label> -->
                                                                    <select
                                                                        class="form-control select2 custom-select js-example-basic-single"
                                                                        style="width: 100%; height:36px;"
                                                                        id="depot_list" name="depot_list" required>

                                                                    </select>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p>Area :</p>
                                                            </td>
                                                            <td>
                                                                <!-- Area dropdown -->
                                                                <div class="col-md-12">
                                                                    <!-- <label for="depot_list">Area</label> -->
                                                                    <select
                                                                        class="form-control select2 custom-select js-example-basic-single"
                                                                        style="width: 100%; height:36px;" id="area_list"
                                                                        name="area_list" required>

                                                                    </select>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p>territory :</p>
                                                            </td>
                                                            <td>
                                                                <!-- Territory dropdown -->
                                                                <div class="col-md-12">
                                                                    <!-- <label for="area_list">Territory</label> -->
                                                                    <select
                                                                        class="form-control select2 custom-select js-example-basic-single"
                                                                        style="width: 100%; height:36px;"
                                                                        id="add_territory_list"
                                                                        name="add_territory_list" required>

                                                                    </select>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p>RSM :</p>
                                                            </td>
                                                            <td>
                                                                <!-- RSM dropdown -->
                                                                <div class="col-md-12">
                                                                    <select
                                                                        class="form-control select2 custom-select js-example-basic-single"
                                                                        style="width: 100%; height:36px;"
                                                                        id="add_rsm_list" name="add_rsm_list" required>

                                                                    </select>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p>ASM / Sr. ASM :</p>
                                                            </td>
                                                            <td>
                                                                <!-- ASM dropdown -->
                                                                <div class="col-md-12">
                                                                    <select
                                                                        class="form-control select2 custom-select js-example-basic-single"
                                                                        style="width: 100%; height:36px;"
                                                                        id="add_asm_list" name="add_asm_list" required>

                                                                    </select>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p>FPR :</p>
                                                            </td>
                                                            <td>
                                                                <!-- FPR dropdown -->
                                                                <div class="col-md-12">
                                                                    <select
                                                                        class="form-control select2 custom-select js-example-basic-single"
                                                                        style="width: 100%; height:36px;"
                                                                        id="add_fpr_list" name="add_fpr_list" required>

                                                                    </select>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <!--end /table-->
                                            </div>
                                            <div class="col-md-3 p-0">
                                                <div class="container" style="width:80%; padding: 0px;">
                                                    <h6 style="margin-bottom: 15px;">Proprietor Image :</h6>
                                                    <input type="file" class="form-control" name="add_o_image"
                                                        id="add_o_image" accept=".png , .jpg , .jpeg"
                                                        onchange="document.getElementById('preview_add_img').src = window.URL.createObjectURL(this.files[0])"
                                                        required>
                                                    <div class="card" style="margin-bottom: 0px;">
                                                        <div class="card-body"
                                                            style="padding-top: 11px;padding-right: 6px;padding-bottom: 11px;padding-left: 6px;">
                                                            <img name="preview_add_img" id="preview_add_img"
                                                                style="width: 135px; height: 135px;  margin-left:35px;">
                                                        </div>
                                                    </div>
                                                    <p id="error_message_add"></p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- table part 2 -->
                                        <div class="row">
                                            <div class="col-md-12 p-0">
                                                <h6>Proposed Distributor's Information :</h6>
                                                <!-- <hr class="mt-0"> -->
                                                <table class="table table-bordered table-striped mb-0 part2">
                                                    <tbody id="">
                                                        <tr>
                                                            <td style="width: 2%">
                                                                <p>1</p>
                                                            </td>
                                                            <td style="width: 25%">
                                                                <p>Type of Distributorship :</p>
                                                            </td>
                                                            <td>
                                                                <select
                                                                    class="form-control select2 custom-select js-example-basic-single"
                                                                    style="width: 100%; height:36px;"
                                                                    id="add_distri_type" name="add_distri_type"
                                                                    required>
                                                                    <option value="" disabled>-- Select --
                                                                    </option>
                                                                    <option value="MT">MT</option>
                                                                    <option value="REG">REG</option>
                                                                    <option value="EV">EV</option>
                                                                    <option value="ONLN">ONLN</option>
                                                                    <option value="PRLR">PRLR</option>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p>2</p>
                                                            </td>
                                                            <td>
                                                                <p>Name of Distributor/Firm :</p>
                                                            </td>
                                                            <td>
                                                                <input class="form-control" type="text" name="add_name"
                                                                    id="add_name"
                                                                    style="height: 18px!important; width: 100%; border: 1px solid #e3ebf6;"
                                                                    required />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p>3</p>
                                                            </td>
                                                            <td>
                                                                <p>Proprietor Name :</p>
                                                            </td>
                                                            <td>
                                                                <input class="form-control" type="text"
                                                                    name="add_o_name" id="add_o_name"
                                                                    style="height: 18px!important;" required />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p>4</p>
                                                            </td>
                                                            <td>
                                                                <p>Proprietor Mobile Number :</p>
                                                            </td>
                                                            <td><input class="form-control" type="text"
                                                                    name="add_o_mobile" id="add_o_mobile"
                                                                    style="height: 18px!important;" required />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p>5</p>
                                                            </td>
                                                            <td>
                                                                <p>Contact Person & Mobile Number :</p>
                                                            </td>
                                                            <td><input class="form-control" type="text"
                                                                    name="add_cp_mobile" id="add_cp_mobile"
                                                                    style="height: 18px!important;" required />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p>6</p>
                                                            </td>
                                                            <td>
                                                                <p>Farm Address :</p>
                                                            </td>
                                                            <td><input class="form-control" type="text"
                                                                    name="add_address" id="add_address"
                                                                    style="height: 18px!important;" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p>7</p>
                                                            </td>
                                                            <td>
                                                                <p>Proprietor Permanent Address :</p>
                                                            </td>
                                                            <td>
                                                                <input class="form-control" type="text"
                                                                    name="add_o_address" id="add_o_address"
                                                                    style="height: 18px!important;" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p>8</p>
                                                            </td>
                                                            <td>
                                                                <p>Proprietor Present Address :</p>
                                                            </td>
                                                            <td><input class="form-control" type="text"
                                                                    name="add_o_pre_address" id="add_o_pre_address"
                                                                    style="height: 18px!important;" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p>9</p>
                                                            </td>
                                                            <td>
                                                                <p>Proprietor National ID Number :</p>
                                                            </td>
                                                            <td><input class="form-control" type="text" name="add_o_nid"
                                                                    id="add_o_nid" style="height: 18px!important;" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p>10</p>
                                                            </td>
                                                            <td>
                                                                <p>Trade License Number & last date :</p>
                                                            </td>
                                                            <td>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <input class="form-control" type="text"
                                                                            name="add_tl_number" id="add_tl_number"
                                                                            style="height: 18px!important;"
                                                                            placeholder="Enter Trade License Number" />
                                                                    </div>
                                                                    <div class="col">
                                                                        <input type="text" class="form-control"
                                                                            name="add_tl_lastDate" id="add_tl_lastDate"
                                                                            placeholder="Enter Last Date"
                                                                            style="height: 18px!important;"
                                                                            onfocus="(this.type='date')"
                                                                            onblur="if(this.value==''){this.type='text'}"
                                                                            data-date-format="DD MMMM YYYY">
                                                                    </div>
                                                                </div>


                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p>11</p>
                                                            </td>
                                                            <td>
                                                                <p>bank name & branch :</p>
                                                            </td>
                                                            <td><input class="form-control" type="text"
                                                                    name="add_b_name_b_branch" id="add_b_name_b_branch"
                                                                    style="height: 18px!important;" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p>12</p>
                                                            </td>
                                                            <td>
                                                                <p>bank account number :</p>
                                                            </td>
                                                            <td><input class="form-control" type="text"
                                                                    name="add_b_account" id="add_b_account"
                                                                    style="height: 18px!important;" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p>13</p>
                                                            </td>
                                                            <td>
                                                                <p>name of existing business :</p>
                                                            </td>
                                                            <td>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <input class="form-control" type="text"
                                                                            name="add_exist_bus_name1"
                                                                            id="add_exist_bus_name1"
                                                                            style="height: 18px!important;"
                                                                            placeholder="1" />
                                                                    </div>
                                                                    <div class="col">
                                                                        <input class="form-control" type="text"
                                                                            name="add_exist_bus_name2"
                                                                            id="add_exist_bus_name2"
                                                                            style="height: 18px!important;"
                                                                            placeholder="2" />
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p>14</p>
                                                            </td>
                                                            <td>
                                                                <p>existing business starting year :</p>
                                                            </td>
                                                            <td>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <input class="form-control" type="text"
                                                                            name="add_exist_start1"
                                                                            id="add_exist_start1"
                                                                            style="height: 18px!important;" />
                                                                    </div>
                                                                    <div class="col">
                                                                        <input class="form-control" type="text"
                                                                            name="add_exist_start2"
                                                                            id="add_exist_start2"
                                                                            style="height: 18px!important;" />
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p>15</p>
                                                            </td>
                                                            <td>
                                                                <p>no. of existing van puller & or DSR :</p>
                                                            </td>
                                                            <td><input class="form-control" type="text"
                                                                    name="add_exist_van_puller"
                                                                    id="add_exist_van_puller"
                                                                    style="height: 18px!important;" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p>16</p>
                                                            </td>
                                                            <td>
                                                                <p>Number of existing ice cream van :</p>
                                                            </td>
                                                            <td><input class="form-control" type="text"
                                                                    name="add_exist_ice_van" id="add_exist_ice_van"
                                                                    style="height: 18px!important;" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p>17</p>
                                                            </td>
                                                            <td>
                                                                <p>existing godown size (SQFT) :</p>
                                                            </td>
                                                            <td><input class="form-control" type="text"
                                                                    name="add_exist_gd_size" id="add_exist_gd_size"
                                                                    style="height: 18px!important;" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p>18</p>
                                                            </td>
                                                            <td>
                                                                <p>relation with golden group entity :</p>
                                                            </td>
                                                            <td><input class="form-control" type="text"
                                                                    name="add_rel_gge" id="add_rel_gge"
                                                                    style="height: 18px!important;" />
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <!-- table part 3 -->
                                        <div class="row">
                                            <div class="col-md-12 p-0">
                                                <h6>Market Information :</h6>
                                                <!-- <hr class="mt-0"> -->
                                                <table class="table table-bordered table-striped mb-0 part2">
                                                    <tbody id="">
                                                        <tr>
                                                            <td style="width: 2%">
                                                                <p>1</p>
                                                            </td>
                                                            <td style="width: 25%">
                                                                <p>Area Demarcation :</p>
                                                            </td>
                                                            <td>
                                                                <select
                                                                    class="form-control select2 custom-select js-example-basic-single"
                                                                    style="width: 100%; height:36px;" id="add_area_dem"
                                                                    name="add_area_dem[]" multiple="multiple">

                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p>2</p>
                                                            </td>
                                                            <td>
                                                                <p>Point Name :</p>
                                                            </td>
                                                            <td><input class="form-control" type="text"
                                                                    name="add_point_name" id="add_point_name"
                                                                    style="height: 18px!important;" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 2%">
                                                                <p>3</p>
                                                            </td>
                                                            <td style="width: 25%">
                                                                <p>Routes :</p>
                                                            </td>
                                                            <td>
                                                                <select
                                                                    class="form-control select2 custom-select js-example-basic-single"
                                                                    style="width: 100%; height:36px;" id="add_routes"
                                                                    name="add_routes[]" multiple="multiple">

                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p>4</p>
                                                            </td>
                                                            <td>
                                                                <p>Key Markets :</p>
                                                            </td>
                                                            <td>
                                                                <textarea class="form-control" id="add_k_market"
                                                                    name="add_k_market"
                                                                    placeholder="Enter your key markets here ..."></textarea>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p>5</p>
                                                            </td>
                                                            <td>
                                                                <p>Ice Cream selling outlets territory :</p>
                                                            </td>
                                                            <td><input class="form-control" type="text"
                                                                    name="add_ice_outlets" id="add_ice_outlets"
                                                                    style="height: 18px!important;" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p>6</p>
                                                            </td>
                                                            <td>
                                                                <p>Existing Avg market Size (Tk) : (yearly)</p>
                                                            </td>
                                                            <td><input class="form-control" name="add_exist_avg_m_size"
                                                                    id="add_exist_avg_m_size" type="text"
                                                                    style="height: 18px!important;" />
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <!-- table part 4 -->
                                        <div class="row">
                                            <h6 class="mt-2 p-0">Competitors Intelligence : (Yearly)</h6>
                                            <!-- <hr class="mt-0"> -->
                                            <div class="col-md-12 p-0">
                                                <table class="table table-bordered table-striped mb-0 part2">
                                                    <thead>
                                                        <th colspan="2"></th>
                                                        <th class="text-center">Igloo</th>
                                                        <th class="text-center">Polar</th>
                                                        <th class="text-center">Lovello</th>
                                                        <th class="text-center">Kazi</th>
                                                        <th class="text-center">Bloop</th>
                                                        <th class="text-center">Kwality</th>
                                                        <th class="text-center">Others</th>
                                                    </thead>

                                                    <tbody id="">
                                                        <tr>
                                                            <td style="width: 2%">
                                                                <p>1</p>
                                                            </td>
                                                            <td style="width: 25%">
                                                                <p>Existing Market Contribution (taka) :</p>
                                                            </td>
                                                            <td><input class="form-control" type="text"
                                                                    name="add_ig_cont" id="add_ig_cont"
                                                                    onkeyup="add_avg_market_size()"
                                                                    style="height: 18px!important;" /></td>
                                                            <td><input class="form-control" type="text"
                                                                    name="add_po_cont" id="add_po_cont"
                                                                    onkeyup="add_avg_market_size()"
                                                                    style="height: 18px!important;" /></td>
                                                            <td><input class="form-control" type="text"
                                                                    name="add_lo_cont" id="add_lo_cont"
                                                                    onkeyup="add_avg_market_size()"
                                                                    style="height: 18px!important;" /></td>
                                                            <td><input class="form-control" type="text"
                                                                    name="add_ka_cont" id="add_ka_cont"
                                                                    onkeyup="add_avg_market_size()"
                                                                    style="height: 18px!important;" /></td>
                                                            <td><input class="form-control" type="text"
                                                                    name="add_bl_cont" id="add_bl_cont"
                                                                    onkeyup="add_avg_market_size()"
                                                                    style="height: 18px!important;" /></td>
                                                            <td><input class="form-control" type="text"
                                                                    name="add_kw_cont" id="add_kw_cont"
                                                                    onkeyup="add_avg_market_size()"
                                                                    style="height: 18px!important;" /></td>
                                                            <td><input class="form-control" type="text"
                                                                    name="add_others_cont" id="add_others_cont"
                                                                    onkeyup="add_avg_market_size()"
                                                                    style="height: 18px!important;" /></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 2%">
                                                                <p>2</p>
                                                            </td>
                                                            <td style="width: 20%">
                                                                <p>D/F Quantity of the competitors :</p>
                                                            </td>
                                                            <td><input class="form-control" type="text"
                                                                    name="add_ig_comp" id="add_ig_comp"
                                                                    style="height: 18px!important;" /></td>
                                                            <td><input class="form-control" type="text"
                                                                    name="add_po_comp" id="add_po_comp"
                                                                    style="height: 18px!important;" /></td>
                                                            <td><input class="form-control" type="text"
                                                                    name="add_lo_comp" id="add_lo_comp"
                                                                    style="height: 18px!important;" /></td>
                                                            <td><input class="form-control" type="text"
                                                                    name="add_ka_comp" id="add_ka_comp"
                                                                    style="height: 18px!important;" /></td>
                                                            <td><input class="form-control" type="text"
                                                                    name="add_bl_comp" id="add_bl_comp"
                                                                    style="height: 18px!important;" /></td>
                                                            <td><input class="form-control" type="text"
                                                                    name="add_kw_comp" id="add_kw_comp"
                                                                    style="height: 18px!important;" /></td>
                                                            <td><input class="form-control" type="text"
                                                                    name="add_others_comp" id="add_others_comp"
                                                                    style="height: 18px!important;" /></td>

                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <!-- table part 5 -->
                                        <div class="row">
                                            <div class="col-md-12 p-0">
                                                <h6 class="p-0">Expected Sales :</h6>
                                                <!-- <hr class="mt-0"> -->
                                                <table class="table table-bordered table-striped mb-0 part2">
                                                    <thead>
                                                        <th colspan="2"></th>
                                                        <th class="text-center">
                                                            <?php echo $next_six_months[0]; ?></th>
                                                        <th class="text-center">
                                                            <?php echo $next_six_months[1]; ?></th>
                                                        <th class="text-center">
                                                            <?php echo $next_six_months[2]; ?></th>
                                                        <th class="text-center">
                                                            <?php echo $next_six_months[3]; ?></th>
                                                        <th class="text-center">
                                                            <?php echo $next_six_months[4]; ?></th>
                                                        <th class="text-center">
                                                            <?php echo $next_six_months[5]; ?></th>
                                                        <th class="text-center">
                                                            <?php echo $next_six_months[6]; ?></th>

                                                    </thead>

                                                    <tbody id="">
                                                        <tr>
                                                            <td style="width: 2%">
                                                                <p>1</p>
                                                            </td>
                                                            <td style="width: 25%">
                                                                <p>Expected Monthly sales (In Taka) :</p>
                                                            </td>
                                                            <td>
                                                                <input class="form-control" type="text"
                                                                    name="add_m1_sales" id="add_m1_sales"
                                                                    style="height: 18px!important;" />
                                                            </td>
                                                            <td><input class="form-control" type="text"
                                                                    name="add_m2_sales" id="add_m2_sales"
                                                                    style="height: 18px!important;" /></td>
                                                            <td><input class="form-control" type="text"
                                                                    name="add_m3_sales" id="add_m3_sales"
                                                                    style="height: 18px!important;" /></td>
                                                            <td><input class="form-control" type="text"
                                                                    name="add_m4_sales" id="add_m4_sales"
                                                                    style="height: 18px!important;" /></td>
                                                            <td><input class="form-control" type="text"
                                                                    name="add_m5_sales" id="add_m5_sales"
                                                                    style="height: 18px!important;" /></td>
                                                            <td><input class="form-control" type="text"
                                                                    name="add_m6_sales" id="add_m6_sales"
                                                                    style="height: 18px!important;" /></td>
                                                            <td><input class="form-control" type="text"
                                                                    name="add_m7_sales" id="add_m7_sales"
                                                                    style="height: 18px!important;" /></td>

                                                        </tr>
                                                        <tr>
                                                            <td style="width: 2%">
                                                                <p>2</p>
                                                            </td>
                                                            <td style="width: 25%">
                                                                <p>Expected Number of Freezers Injection :</p>
                                                            </td>

                                                            <td><input class="form-control" type="text"
                                                                    name="add_m1_inj" id="add_m1_inj"
                                                                    style="height: 18px!important;" /></td>
                                                            <td><input class="form-control" type="text"
                                                                    name="add_m2_inj" id="add_m2_inj"
                                                                    style="height: 18px!important;" /></td>
                                                            <td><input class="form-control" type="text"
                                                                    name="add_m3_inj" id="add_m3_inj"
                                                                    style="height: 18px!important;" /></td>
                                                            <td><input class="form-control" type="text"
                                                                    name="add_m4_inj" id="add_m4_inj"
                                                                    style="height: 18px!important;" /></td>
                                                            <td><input class="form-control" type="text"
                                                                    name="add_m5_inj" id="add_m5_inj"
                                                                    style="height: 18px!important;" /></td>
                                                            <td><input class="form-control" type="text"
                                                                    name="add_m6_inj" id="add_m6_inj"
                                                                    style="height: 18px!important;" /></td>
                                                            <td><input class="form-control" type="text"
                                                                    name="add_m7_inj" id="add_m7_inj"
                                                                    style="height: 18px!important;" /></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <!-- table part 6 -->
                                        <div class="row">
                                            <div class="col-md-12 p-0">
                                                <h6>Investment Information :</h6>
                                                <!-- <hr class="mt-0"> -->

                                                <table class="table table-bordered mb-0 part1">
                                                    <tbody id="">
                                                        <tr>
                                                            <td>
                                                                <p>Total Investment (Tk) :</p>
                                                            </td>
                                                            <td><input class="form-control" type="text"
                                                                    name="add_total_inv" id="add_total_inv"
                                                                    style="height: 18px!important;" />
                                                            </td>
                                                            <td>
                                                                <p>Initial Lifting (in Tk) :</p>
                                                            </td>
                                                            <td><input class="form-control" type="text"
                                                                    name="add_init_lifting" id="add_init_lifting"
                                                                    style="height: 18px!important;"
                                                                    onkeyup="add_sum()" />
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td>
                                                                <p>Number of SDFs :</p>
                                                            </td>
                                                            <td><input class="form-control" type="text"
                                                                    name="add_num_SDF" id="add_num_SDF"
                                                                    style="height: 18px!important;" />
                                                            </td>
                                                            <td>
                                                                <p>Godown Advance (Tk) :</p>
                                                            </td>
                                                            <td><input class="form-control" type="text"
                                                                    name="add_gd_adv" id="add_gd_adv"
                                                                    style="height: 18px!important;"
                                                                    onkeyup="add_sum()" />
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td>
                                                                <p>Value of SDFs (Tk) :</p>
                                                            </td>
                                                            <td><input class="form-control" type="text"
                                                                    name="add_val_SDF" id="add_val_SDF"
                                                                    style="height: 18px!important;"
                                                                    onkeyup="add_sum()" />
                                                            </td>
                                                            <td>
                                                                <p>Market Credit :</p>
                                                            </td>
                                                            <td><input class="form-control" type="text"
                                                                    name="add_m_credit" id="add_m_credit"
                                                                    style="height: 18px!important;"
                                                                    onkeyup="add_sum()" />
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td>
                                                                <p>Number of Van(s) :</p>
                                                            </td>
                                                            <td><input class="form-control" type="text"
                                                                    name="add_num_vans" id="add_num_vans"
                                                                    style="height: 18px!important;" />
                                                            </td>
                                                            <td>
                                                                <p>Running Capital :</p>
                                                            </td>
                                                            <td><input class="form-control" type="text"
                                                                    name="add_run_capital" id="add_run_capital"
                                                                    style="height: 18px!important;"
                                                                    onkeyup="add_sum()" />
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td>
                                                                <p>Value of Vans (Tk) :</p>
                                                            </td>
                                                            <td><input class="form-control" type="text"
                                                                    name="add_val_vans" id="add_val_vans"
                                                                    style="height: 18px!important;"
                                                                    onkeyup="add_sum()" />
                                                            </td>
                                                            <td>
                                                                <p>Type of Transaction :</p>
                                                            </td>
                                                            <td><input class="form-control" type="text"
                                                                    name="add_transac_type" id="add_transac_type"
                                                                    style="height: 18px!important;" />
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <!--end /table-->
                                            </div>
                                        </div>

                                        <!-- text Area part -->
                                        <div class=" row">
                                            <label for="textp1" class="p-0">
                                                <h6 class="mt-2">RSM's (or ASM in absence of RSM)
                                                    Recommendation:</h6>
                                            </label>
                                            <!-- <hr class="mt-0"> -->
                                            <textarea class="form-control" id="add_rsm_recom" name="add_rsm_recom"
                                                placeholder="Enter your recomendation here ..."
                                                spellcheck="true"></textarea>

                                            <label for="textp2" class="p-0">
                                                <h6 class="mt-2">GM/DGM/AGM's Recommendation:</h6>
                                            </label>
                                            <!-- <hr class="mt-0"> -->
                                            <textarea class="form-control" id="add_gm_recom" name="add_gm_recom"
                                                placeholder="Enter your recomendation here ..."
                                                spellcheck="true"></textarea>
                                        </div>

                                        <!-- Image part -->
                                        <div class="row mt-2">
                                            <div class="col-md-4 p-0">
                                                <div class="container"
                                                    style="width:80%; padding: 0px; margin-left:0px;">
                                                    <h6 style="margin-bottom: 15px; ">Agreement Image :</h6>
                                                    <input type="file" class="form-control" name="add_agree_image"
                                                        id="add_agree_image" accept=".png , .jpg , .jpeg"
                                                        onchange="document.getElementById('preview_add_img1').src = window.URL.createObjectURL(this.files[0])">
                                                    <div class="card" style="margin-bottom: 0px;">
                                                        <div class="card-body"
                                                            style="padding-top: 11px;padding-right: 6px;padding-bottom: 11px;padding-left: 6px;">
                                                            <img name="preview_add_img1" id="preview_add_img1"
                                                                style="width: 135px; height: 135px;  margin-left:35px;">
                                                        </div>
                                                    </div>
                                                    <p id="error_message_add1"></p>
                                                </div>
                                            </div>
                                            <div class="col-md-4 p-0">
                                                <div class="container" style="width:80%; padding: 0px;">
                                                    <h6 style="margin-bottom: 15px;">Approval Image :</h6>
                                                    <input type="file" class="form-control" name="add_approval_image"
                                                        id="add_approval_image" accept=".png , .jpg , .jpeg"
                                                        onchange="document.getElementById('preview_add_img2').src = window.URL.createObjectURL(this.files[0])">
                                                    <div class="card" style="margin-bottom: 0px;">
                                                        <div class="card-body"
                                                            style="padding-top: 11px;padding-right: 6px;padding-bottom: 11px;padding-left: 6px;">
                                                            <img name="preview_add_img2" id="preview_add_img2"
                                                                style="width: 135px; height: 135px;  margin-left:35px;">
                                                        </div>
                                                    </div>
                                                    <p id="error_message_add2"></p>
                                                </div>
                                            </div>
                                            <div class="col-md-4 p-0">
                                                <div class="container"
                                                    style="width:80%; padding: 0px; margin-right:0px;">
                                                    <h6 style="margin-bottom: 15px;">Trade License Image :</h6>
                                                    <input type="file" class="form-control" name="add_tl_image"
                                                        id="add_tl_image" accept=".png , .jpg , .jpeg"
                                                        onchange="document.getElementById('preview_add_img3').src = window.URL.createObjectURL(this.files[0])">
                                                    <div class="card" style="margin-bottom: 0px;">
                                                        <div class="card-body"
                                                            style="padding-top: 11px;padding-right: 6px;padding-bottom: 11px;padding-left: 6px;">
                                                            <img name="preview_add_img3" id="preview_add_img3"
                                                                style="width: 135px; height: 135px;  margin-left:35px;">
                                                        </div>
                                                    </div>
                                                    <p id="error_message_add3"></p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- is_active & is_approve part -->
                                        <div class="row">
                                            <div class="col-md-3 mt-3 ps-0">
                                                <label for="add_status" class="p-0">
                                                    <h6 class="mt-2">Status:</h6>
                                                </label>
                                                <select name="add_status" id="add_status" class="form-control"
                                                    style="height: 30px!important;">
                                                    <option value="1">Active</option>
                                                    <option value="0">In Active</option>
                                                    <option value="-1">Closed</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3 mt-3">
                                                <label for="add_is_approve" class="p-0">
                                                    <h6 class="mt-2">Approve:</h6>
                                                </label>
                                                <select name="add_is_approve" id="add_is_approve" class="form-control"
                                                    style="height: 30px!important;">
                                                    <option value="1">Yes</option>
                                                    <option value="0">No</option>
                                                </select>
                                            </div>

                                            <!-- start & closing approval date -->
                                            <div class="col-md-3 mt-3">
                                                <label for="add_appr_start_date" class="p-0">
                                                    <h6 class="mt-2">Approval Date:</h6>
                                                </label>
                                                <input type="text" class="form-control appr_start_date"
                                                    name="add_appr_start_date" id="add_appr_start_date"
                                                    placeholder="Enter Approval Start Date"
                                                    style="height: 30px!important;" onfocus="(this.type='date')"
                                                    onblur="if(this.value==''){this.type='text'}" required
                                                    data-date-format="DD MMMM YYYY" />
                                            </div>
                                            <div class="col-md-3 mt-3 pe-0">
                                                <label for="add_appr_close_date" class="p-0">
                                                    <h6 class="mt-2">Closing Date:</h6>
                                                </label>
                                                <input type="text" class="form-control appr_close_date"
                                                    name="add_appr_close_date" id="add_appr_close_date"
                                                    placeholder="Enter Approval Closing Date"
                                                    style="height: 30px!important;" onfocus="(this.type='date')"
                                                    onblur="if(this.value==''){this.type='text'}" required
                                                    data-date-format="DD MMMM YYYY" />
                                            </div>
                                        </div>

                                        <!-- save button -->
                                        <div class="row">
                                            <div class="col-md-12 ps-0 mt-3">
                                                <input type="text" name="oper" value="add" hidden />
                                                <button type="submit"
                                                    class="btn btn-primary btn-square btn-outline-dashed"
                                                    id="add_distributors">Save</button>
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
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title m-0" id="myLargeModalLabel">Edit distributors</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!--end modal-header-->
                <div class="modal-body">
                    <form id="edit_distributors_form" method="POST" enctype="multipart/form-data">
                        <div class="card border-0">
                            <div class="card-body">
                                <div class="table-responsive fixed-thead" style="overflow-x: hidden;">
                                    <div class="container-fluid">

                                        <!-- table part 1 -->
                                        <div class="row">
                                            <div class="col-md-9 p-0">
                                                <div class="ref mb-3">
                                                    <label class="edit_label" for="usr">Reference : </label>
                                                    <input type="text" id="edit_ref" name="edit_ref" />
                                                </div>
                                                <table class="table table-bordered mb-0 part1">
                                                    <tbody id="">
                                                        <tr>
                                                            <td>
                                                                <p>B.P. Code :</p>
                                                            </td>
                                                            <td>
                                                                <input type="text" id="edit_id" name="edit_id" hidden>
                                                                <input type="text" name="edit_code" id="edit_code"
                                                                    class="form-control" style=" height: 18px!important; width:100%; border:
                                                                    1px solid #e3ebf6;" required />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p>Date :</p>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control start_date"
                                                                    name="edit_start_date" id="edit_start_date"
                                                                    placeholder="Enter Date"
                                                                    style="height: 18px!important;"
                                                                    onfocus="(this.type='date')"
                                                                    onblur="if(this.value==''){this.type='text'}"
                                                                    required data-date-format="DD MMMM YYYY" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p>Region :</p>
                                                            </td>
                                                            <td>
                                                                <!-- Region dropdown -->
                                                                <div class="col-md-12">
                                                                    <input type="text" id="org_id_edit"
                                                                        name="org_id_edit"
                                                                        data-value="<?php echo $org_id;?>" hidden />
                                                                    <!-- <label for="region">Region</label> -->
                                                                    <select
                                                                        class="form-control select2 custom-select js-example-basic-single"
                                                                        style="width: 100%; height:36px;"
                                                                        id="edit_region_list" name="edit_region_list"
                                                                        required>

                                                                    </select>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p>Depot :</p>
                                                            </td>
                                                            <td>
                                                                <!-- Depot dropdown -->
                                                                <div class="col-md-12">
                                                                    <!-- <label for="region_list">Depot</label> -->
                                                                    <select
                                                                        class="form-control select2 custom-select js-example-basic-single"
                                                                        style="width: 100%; height:36px;"
                                                                        id="edit_depot_list" name="edit_depot_list"
                                                                        required>

                                                                    </select>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p>Area :</p>
                                                            </td>
                                                            <td>
                                                                <!-- Area dropdown -->
                                                                <div class="col-md-12">
                                                                    <!-- <label for="depot_list">Area</label> -->
                                                                    <select
                                                                        class="form-control select2 custom-select js-example-basic-single"
                                                                        style="width: 100%; height:36px;"
                                                                        id="edit_area_list" name="edit_area_list"
                                                                        required>

                                                                    </select>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p>territory :</p>
                                                            </td>
                                                            <td>
                                                                <input type="text" id="territory_id" name="territory_id"
                                                                    hidden>
                                                                <!-- Territory dropdown -->
                                                                <div class="col-md-12">
                                                                    <!-- <label for="area_list">Territory</label> -->
                                                                    <select
                                                                        class="form-control select2 custom-select js-example-basic-single"
                                                                        style="width: 100%; height:36px;"
                                                                        id="edit_territory_list"
                                                                        name="edit_territory_list" required>

                                                                    </select>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p>RSM :</p>
                                                            </td>
                                                            <td>
                                                                <!-- RSM dropdown -->
                                                                <div class="col-md-12">
                                                                    <select
                                                                        class="form-control select2 custom-select js-example-basic-single"
                                                                        style="width: 100%; height:36px;"
                                                                        id="edit_rsm_list" name="edit_rsm_list">

                                                                    </select>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p>ASM / Sr. ASM :</p>
                                                            </td>
                                                            <td>
                                                                <!-- ASM dropdown -->
                                                                <div class="col-md-12">
                                                                    <select
                                                                        class="form-control select2 custom-select js-example-basic-single"
                                                                        style="width: 100%; height:36px;"
                                                                        id="edit_asm_list" name="edit_asm_list">

                                                                    </select>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p>FPR :</p>
                                                            </td>
                                                            <td>
                                                                <!-- FPR dropdown -->
                                                                <div class="col-md-12">
                                                                    <select
                                                                        class="form-control select2 custom-select js-example-basic-single"
                                                                        style="width: 100%; height:36px;"
                                                                        id="edit_fpr_list" name="edit_fpr_list">

                                                                    </select>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <!--end /table-->
                                            </div>
                                            <div class="col-md-3 p-0">
                                                <div class="container" style="width:80%; padding: 0px;">
                                                    <h6 style="margin-bottom: 15px;">Proprietor Image :</h6>
                                                    <input type="file" class="form-control" name="edit_o_image"
                                                        id="edit_o_image" accept=".png , .jpg , .jpeg"
                                                        onchange="document.getElementById('preview_img').src = window.URL.createObjectURL(this.files[0])">
                                                    <div class="card" style="margin-bottom: 0px;">
                                                        <div class="card-body"
                                                            style="padding-top: 11px;padding-right: 6px;padding-bottom: 11px;padding-left: 6px;">
                                                            <img name="preview_img" id="preview_img"
                                                                style="width: 135px; height: 135px;  margin-left:35px;">
                                                        </div>
                                                    </div>
                                                    <p id="error_message_edit"></p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- table part 2 -->
                                        <div class="row">
                                            <div class="col-md-12 p-0">
                                                <h6>Proposed Distributor's Information :</h6>
                                                <!-- <hr class="mt-0"> -->
                                                <table class="table table-bordered table-striped mb-0 part2">
                                                    <tbody id="">
                                                        <tr>
                                                            <td style="width: 2%">
                                                                <p>1</p>
                                                            </td>
                                                            <td style="width: 25%">
                                                                <p>Type of Distributorship :</p>
                                                            </td>
                                                            <td>
                                                                <select
                                                                    class="form-control select2 custom-select js-example-basic-single"
                                                                    style="width: 100%; height:36px;"
                                                                    id="edit_distri_type" name="edit_distri_type"
                                                                    required>
                                                                    <option value="" disabled>-- Select --
                                                                    </option>
                                                                    <option value="MT">MT</option>
                                                                    <option value="REG">REG</option>
                                                                    <option value="EV">EV</option>
                                                                    <option value="ONLN">ONLN</option>
                                                                    <option value="PRLR">PRLR</option>
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p>2</p>
                                                            </td>
                                                            <td>
                                                                <p>Name of Distributor/Firm :</p>
                                                            </td>
                                                            <td>
                                                                <input type="text" name="edit_name" id="edit_name"
                                                                    class="form-control"
                                                                    style="height: 18px!important; width: 100%; border: 1px solid #e3ebf6;"
                                                                    required />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p>3</p>
                                                            </td>
                                                            <td>
                                                                <p>Proprietor Name :</p>
                                                            </td>
                                                            <td>
                                                                <input class="form-control" type="text"
                                                                    name="edit_o_name" id="edit_o_name"
                                                                    style="height: 18px!important;" required />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p>4</p>
                                                            </td>
                                                            <td>
                                                                <p>Proprietor Mobile Number :</p>
                                                            </td>
                                                            <td><input class="form-control" type="text"
                                                                    name="edit_o_mobile" id="edit_o_mobile"
                                                                    style="height: 18px!important;" required />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p>5</p>
                                                            </td>
                                                            <td>
                                                                <p>Contact Person & Mobile Number :</p>
                                                            </td>
                                                            <td><input class="form-control" type="text"
                                                                    name="edit_cp_mobile" id="edit_cp_mobile"
                                                                    style="height: 18px!important;" required />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p>6</p>
                                                            </td>
                                                            <td>
                                                                <p>Farm Address :</p>
                                                            </td>
                                                            <td><input class="form-control" type="text"
                                                                    name="edit_address" id="edit_address"
                                                                    style="height: 18px!important;" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p>7</p>
                                                            </td>
                                                            <td>
                                                                <p>Proprietor Permanent Address :</p>
                                                            </td>
                                                            <td>
                                                                <input class="form-control" type="text"
                                                                    name="edit_o_address" id="edit_o_address"
                                                                    style="height: 18px!important;" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p>8</p>
                                                            </td>
                                                            <td>
                                                                <p>Proprietor Present Address :</p>
                                                            </td>
                                                            <td><input class="form-control" type="text"
                                                                    name="edit_o_pre_address" id="edit_o_pre_address"
                                                                    style="height: 18px!important;" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p>9</p>
                                                            </td>
                                                            <td>
                                                                <p>Proprietor National ID Number :</p>
                                                            </td>
                                                            <td><input class="form-control" type="text"
                                                                    name="edit_o_nid" id="edit_o_nid"
                                                                    style="height: 18px!important;" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p>10</p>
                                                            </td>
                                                            <td>
                                                                <p>Trade License Number & last date :</p>
                                                            </td>
                                                            <td>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <input class="form-control" type="text"
                                                                            name="edit_tl_number" id="edit_tl_number"
                                                                            style="height: 18px!important;"
                                                                            placeholder="Enter Trade License Number" />
                                                                    </div>
                                                                    <div class="col">
                                                                        <input type="text" class="form-control"
                                                                            name="edit_tl_lastDate"
                                                                            id="edit_tl_lastDate"
                                                                            placeholder="Enter Last Date"
                                                                            style="height: 18px!important;"
                                                                            onfocus="(this.type='date')"
                                                                            onblur="if(this.value==''){this.type='text'}"
                                                                            data-date-format="DD MMMM YYYY">
                                                                    </div>
                                                                </div>


                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p>11</p>
                                                            </td>
                                                            <td>
                                                                <p>bank name & branch :</p>
                                                            </td>
                                                            <td><input class="form-control" type="text"
                                                                    name="edit_b_name_b_branch"
                                                                    id="edit_b_name_b_branch"
                                                                    style="height: 18px!important;" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p>12</p>
                                                            </td>
                                                            <td>
                                                                <p>bank account number :</p>
                                                            </td>
                                                            <td><input class="form-control" type="text"
                                                                    name="edit_b_account" id="edit_b_account"
                                                                    style="height: 18px!important;" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p>13</p>
                                                            </td>
                                                            <td>
                                                                <p>name of existing business :</p>
                                                            </td>
                                                            <td>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <input class="form-control" type="text"
                                                                            name="edit_exist_bus_name1"
                                                                            id="edit_exist_bus_name1"
                                                                            style="height: 18px!important;"
                                                                            placeholder="1" />
                                                                    </div>
                                                                    <div class="col">
                                                                        <input class="form-control" type="text"
                                                                            name="edit_exist_bus_name2"
                                                                            id="edit_exist_bus_name2"
                                                                            style="height: 18px!important;"
                                                                            placeholder="2" />
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p>14</p>
                                                            </td>
                                                            <td>
                                                                <p>existing business starting year :</p>
                                                            </td>
                                                            <td>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <input class="form-control" type="text"
                                                                            name="edit_exist_start1"
                                                                            id="edit_exist_start1"
                                                                            style="height: 18px!important;" />
                                                                    </div>
                                                                    <div class="col">
                                                                        <input class="form-control" type="text"
                                                                            name="edit_exist_start2"
                                                                            id="edit_exist_start2"
                                                                            style="height: 18px!important;" />
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p>15</p>
                                                            </td>
                                                            <td>
                                                                <p>no. of existing van puller & or DSR :</p>
                                                            </td>
                                                            <td><input class="form-control" type="text"
                                                                    name="edit_exist_van_puller"
                                                                    id="edit_exist_van_puller"
                                                                    style="height: 18px!important;" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p>16</p>
                                                            </td>
                                                            <td>
                                                                <p>Number of existing ice cream van :</p>
                                                            </td>
                                                            <td><input class="form-control" type="text"
                                                                    name="edit_exist_ice_van" id="edit_exist_ice_van"
                                                                    style="height: 18px!important;" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p>17</p>
                                                            </td>
                                                            <td>
                                                                <p>existing godown size (SQFT) :</p>
                                                            </td>
                                                            <td><input class="form-control" type="text"
                                                                    name="edit_exist_gd_size" id="edit_exist_gd_size"
                                                                    style="height: 18px!important;" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p>18</p>
                                                            </td>
                                                            <td>
                                                                <p>relation with golden group entity :</p>
                                                            </td>
                                                            <td><input class="form-control" type="text"
                                                                    name="edit_rel_gge" id="edit_rel_gge"
                                                                    style="height: 18px!important;" />
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <!-- table part 3 -->
                                        <div class="row">
                                            <div class="col-md-12 p-0">
                                                <h6>Market Information :</h6>
                                                <!-- <hr class="mt-0"> -->
                                                <table class="table table-bordered table-striped mb-0 part2">
                                                    <tbody id="">
                                                        <tr>
                                                            <td style="width: 2%">
                                                                <p>1</p>
                                                            </td>
                                                            <td style="width: 25%">
                                                                <p>Area Demarcation :</p>
                                                            </td>
                                                            <td>
                                                                <select
                                                                    class="form-control select2 custom-select js-example-basic-single"
                                                                    style="width: 100%; height:36px;" id="edit_area_dem"
                                                                    name="edit_area_dem[]" multiple="multiple">

                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p>2</p>
                                                            </td>
                                                            <td>
                                                                <p>Point Name :</p>
                                                            </td>
                                                            <td><input class="form-control" type="text"
                                                                    name="edit_point_name" id="edit_point_name"
                                                                    style="height: 18px!important;" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 2%">
                                                                <p>3</p>
                                                            </td>
                                                            <td style="width: 25%">
                                                                <p>Routes :</p>
                                                            </td>
                                                            <td>
                                                                <select
                                                                    class="form-control select2 custom-select js-example-basic-single"
                                                                    style="width: 100%; height:36px;" id="edit_routes"
                                                                    name="edit_routes[]" multiple="multiple">

                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p>4</p>
                                                            </td>
                                                            <td>
                                                                <p>Key Markets :</p>
                                                            </td>
                                                            <td>
                                                                <textarea class="form-control" id="edit_k_market"
                                                                    name="edit_k_market"
                                                                    placeholder="Enter your key markets here ..."></textarea>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p>5</p>
                                                            </td>
                                                            <td>
                                                                <p>Ice Cream selling outlets territory :</p>
                                                            </td>
                                                            <td><input class="form-control" type="text"
                                                                    name="edit_ice_outlets" id="edit_ice_outlets"
                                                                    style="height: 18px!important;" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <p>6</p>
                                                            </td>
                                                            <td>
                                                                <p>Existing Avg market Size (Tk) : (yearly)</p>
                                                            </td>
                                                            <td><input class="form-control" name="edit_exist_avg_m_size"
                                                                    id="edit_exist_avg_m_size" type="text"
                                                                    style="height: 18px!important;" />
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <!-- table part 4 -->
                                        <div class="row">
                                            <h6 class="mt-2 p-0">Competitors Intelligence : (Yearly)</h6>
                                            <!-- <hr class="mt-0"> -->
                                            <div class="col-md-12 p-0">
                                                <table class="table table-bordered table-striped mb-0 part2">
                                                    <thead>
                                                        <th colspan="2"></th>
                                                        <th class="text-center">Igloo</th>
                                                        <th class="text-center">Polar</th>
                                                        <th class="text-center">Lovello</th>
                                                        <th class="text-center">Kazi</th>
                                                        <th class="text-center">Bloop</th>
                                                        <th class="text-center">kwality</th>
                                                        <th class="text-center">others</th>
                                                    </thead>

                                                    <tbody id="">
                                                        <tr>
                                                            <td style="width: 2%">
                                                                <p>1</p>
                                                            </td>
                                                            <td style="width: 25%">
                                                                <p>Existing Market Contribution (taka) :</p>
                                                            </td>
                                                            <td><input class="form-control text-center" type="text"
                                                                    onkeyup="edit_avg_market_size()" name="edit_ig_cont"
                                                                    id="edit_ig_cont" style="height: 18px!important;" />
                                                            </td>
                                                            <td><input class="form-control text-center" type="text"
                                                                    onkeyup="edit_avg_market_size()" name="edit_po_cont"
                                                                    id="edit_po_cont" style="height: 18px!important;" />
                                                            </td>
                                                            <td><input class="form-control text-center" type="text"
                                                                    onkeyup="edit_avg_market_size()" name="edit_lo_cont"
                                                                    id="edit_lo_cont" style="height: 18px!important;" />
                                                            </td>
                                                            <td><input class="form-control text-center" type="text"
                                                                    onkeyup="edit_avg_market_size()" name="edit_ka_cont"
                                                                    id="edit_ka_cont" style="height: 18px!important;" />
                                                            </td>
                                                            <td><input class="form-control text-center" type="text"
                                                                    onkeyup="edit_avg_market_size()" name="edit_bl_cont"
                                                                    id="edit_bl_cont" style="height: 18px!important;" />
                                                            </td>
                                                            <td><input class="form-control text-center" type="text"
                                                                    onkeyup="edit_avg_market_size()" name="edit_kw_cont"
                                                                    id="edit_kw_cont" style="height: 18px!important;" />
                                                            </td>
                                                            <td><input class="form-control text-center" type="text"
                                                                    onkeyup="edit_avg_market_size()"
                                                                    name="edit_others_cont" id="edit_others_cont"
                                                                    style="height: 18px!important;" /></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 2%">
                                                                <p>2</p>
                                                            </td>
                                                            <td style="width: 20%">
                                                                <p>D/F Quantity of the competitors :</p>
                                                            </td>
                                                            <td><input class="form-control text-center" type="text"
                                                                    name="edit_ig_comp" id="edit_ig_comp"
                                                                    style="height: 18px!important;" /></td>
                                                            <td><input class="form-control text-center" type="text"
                                                                    name="edit_po_comp" id="edit_po_comp"
                                                                    style="height: 18px!important;" /></td>
                                                            <td><input class="form-control text-center" type="text"
                                                                    name="edit_lo_comp" id="edit_lo_comp"
                                                                    style="height: 18px!important;" /></td>
                                                            <td><input class="form-control text-center" type="text"
                                                                    name="edit_ka_comp" id="edit_ka_comp"
                                                                    style="height: 18px!important;" /></td>
                                                            <td><input class="form-control text-center" type="text"
                                                                    name="edit_bl_comp" id="edit_bl_comp"
                                                                    style="height: 18px!important;" /></td>
                                                            <td><input class="form-control text-center" type="text"
                                                                    name="edit_kw_comp" id="edit_kw_comp"
                                                                    style="height: 18px!important;" /></td>
                                                            <td><input class="form-control text-center" type="text"
                                                                    name="edit_others_comp" id="edit_others_comp"
                                                                    style="height: 18px!important;" /></td>

                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <!-- table part 5 -->
                                        <div class="row">
                                            <div class="col-md-12 p-0">
                                                <h6 class="p-0">Expected Sales :</h6>
                                                <!-- <hr class="mt-0"> -->
                                                <table class="table table-bordered table-striped mb-0 part2">
                                                    <thead>
                                                        <th colspan="2"></th>
                                                        <th class="text-center">
                                                            <?php echo $next_six_months[0]; ?></th>
                                                        <th class="text-center">
                                                            <?php echo $next_six_months[1]; ?></th>
                                                        <th class="text-center">
                                                            <?php echo $next_six_months[2]; ?></th>
                                                        <th class="text-center">
                                                            <?php echo $next_six_months[3]; ?></th>
                                                        <th class="text-center">
                                                            <?php echo $next_six_months[4]; ?></th>
                                                        <th class="text-center">
                                                            <?php echo $next_six_months[5]; ?></th>
                                                        <th class="text-center">
                                                            <?php echo $next_six_months[6]; ?></th>

                                                    </thead>

                                                    <tbody id="">
                                                        <tr>
                                                            <td style="width: 2%">
                                                                <p>1</p>
                                                            </td>
                                                            <td style="width: 25%">
                                                                <p>Expected Monthly sales (In Taka) :</p>
                                                            </td>
                                                            <td>
                                                                <input class="form-control text-center" type="text"
                                                                    name="edit_m1_sales" id="edit_m1_sales"
                                                                    style="height: 18px!important; " />
                                                            </td>
                                                            <td><input class="form-control text-center" type="text"
                                                                    name="edit_m2_sales" id="edit_m2_sales"
                                                                    style="height: 18px!important;" /></td>
                                                            <td><input class="form-control text-center" type="text"
                                                                    name="edit_m3_sales" id="edit_m3_sales"
                                                                    style="height: 18px!important;" /></td>
                                                            <td><input class="form-control text-center" type="text"
                                                                    name="edit_m4_sales" id="edit_m4_sales"
                                                                    style="height: 18px!important;" /></td>
                                                            <td><input class="form-control text-center" type="text"
                                                                    name="edit_m5_sales" id="edit_m5_sales"
                                                                    style="height: 18px!important;" /></td>
                                                            <td><input class="form-control text-center" type="text"
                                                                    name="edit_m6_sales" id="edit_m6_sales"
                                                                    style="height: 18px!important;" /></td>
                                                            <td><input class="form-control text-center" type="text"
                                                                    name="edit_m7_sales" id="edit_m7_sales"
                                                                    style="height: 18px!important;" /></td>

                                                        </tr>
                                                        <tr>
                                                            <td style="width: 2%">
                                                                <p>2</p>
                                                            </td>
                                                            <td style="width: 25%">
                                                                <p>Expected Number of Freezers Injection :</p>
                                                            </td>

                                                            <td><input class="form-control text-center text-center"
                                                                    type="text" name="edit_m1_inj" id="edit_m1_inj"
                                                                    style="height: 18px!important;" /></td>
                                                            <td><input class="form-control text-center" type="text"
                                                                    name="edit_m2_inj" id="edit_m2_inj"
                                                                    style="height: 18px!important;" /></td>
                                                            <td><input class="form-control text-center" type="text"
                                                                    name="edit_m3_inj" id="edit_m3_inj"
                                                                    style="height: 18px!important;" /></td>
                                                            <td><input class="form-control text-center" type="text"
                                                                    name="edit_m4_inj" id="edit_m4_inj"
                                                                    style="height: 18px!important;" /></td>
                                                            <td><input class="form-control text-center" type="text"
                                                                    name="edit_m5_inj" id="edit_m5_inj"
                                                                    style="height: 18px!important;" /></td>
                                                            <td><input class="form-control text-center" type="text"
                                                                    name="edit_m6_inj" id="edit_m6_inj"
                                                                    style="height: 18px!important;" /></td>
                                                            <td><input class="form-control text-center" type="text"
                                                                    name="edit_m7_inj" id="edit_m7_inj"
                                                                    style="height: 18px!important;" /></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <!-- table part 6 -->
                                        <div class="row">
                                            <div class="col-md-12 p-0">
                                                <h6>Investment Information :</h6>
                                                <!-- <hr class="mt-0"> -->

                                                <table class="table table-bordered mb-0 part1">
                                                    <tbody id="">
                                                        <tr>
                                                            <td>
                                                                <p>Total Investment (Tk) :</p>
                                                            </td>
                                                            <td><input class="form-control" type="text"
                                                                    name="edit_total_inv" id="edit_total_inv"
                                                                    style="height: 18px!important;" />
                                                            </td>
                                                            <td>
                                                                <p>Initial Lifting (in Tk) :</p>
                                                            </td>
                                                            <td><input class="form-control" type="text"
                                                                    name="edit_init_lifting" id="edit_init_lifting"
                                                                    style="height: 18px!important;"
                                                                    onkeyup="edit_sum()" />
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td>
                                                                <p>Number of SDFs :</p>
                                                            </td>
                                                            <td><input class="form-control" type="text"
                                                                    name="edit_num_SDF" id="edit_num_SDF"
                                                                    style="height: 18px!important;" />
                                                            </td>
                                                            <td>
                                                                <p>Godown Advance (Tk) :</p>
                                                            </td>
                                                            <td><input class="form-control" type="text"
                                                                    name="edit_gd_adv" id="edit_gd_adv"
                                                                    style="height: 18px!important;"
                                                                    onkeyup="edit_sum()" />
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td>
                                                                <p>Value of SDFs (Tk) :</p>
                                                            </td>
                                                            <td><input class="form-control" type="text"
                                                                    name="edit_val_SDF" id="edit_val_SDF"
                                                                    style="height: 18px!important;"
                                                                    onkeyup="edit_sum()" />
                                                            </td>
                                                            <td>
                                                                <p>Market Credit :</p>
                                                            </td>
                                                            <td><input class="form-control" type="text"
                                                                    name="edit_m_credit" id="edit_m_credit"
                                                                    style="height: 18px!important;"
                                                                    onkeyup="edit_sum()" />
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td>
                                                                <p>Number of Van(s) :</p>
                                                            </td>
                                                            <td><input class="form-control" type="text"
                                                                    name="edit_num_vans" id="edit_num_vans"
                                                                    style="height: 18px!important;" />
                                                            </td>
                                                            <td>
                                                                <p>Running Capital :</p>
                                                            </td>
                                                            <td><input class="form-control" type="text"
                                                                    name="edit_run_capital" id="edit_run_capital"
                                                                    style="height: 18px!important;"
                                                                    onkeyup="edit_sum()" />
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td>
                                                                <p>Value of Vans (Tk) :</p>
                                                            </td>
                                                            <td><input class="form-control" type="text"
                                                                    name="edit_val_vans" id="edit_val_vans"
                                                                    style="height: 18px!important;"
                                                                    onkeyup="edit_sum()" />
                                                            </td>
                                                            <td>
                                                                <p>Type of Transaction :</p>
                                                            </td>
                                                            <td><input class="form-control" type="text"
                                                                    name="edit_transac_type" id="edit_transac_type"
                                                                    style="height: 18px!important;" />
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <!--end /table-->
                                            </div>
                                        </div>

                                        <!-- text Area part -->
                                        <div class=" row">
                                            <label for="textp1" class="p-0">
                                                <h6 class="mt-2">RSM's (or ASM in absence of RSM)
                                                    Recommendation:</h6>
                                            </label>
                                            <!-- <hr class="mt-0"> -->
                                            <textarea class="form-control" id="edit_rsm_recom" name="edit_rsm_recom"
                                                placeholder="Enter your recomendation here ..."></textarea>

                                            <label for="textp2" class="p-0">
                                                <h6 class="mt-2">GM/DGM/AGM's Recommendation:</h6>
                                            </label>
                                            <!-- <hr class="mt-0"> -->
                                            <textarea class="form-control" id="edit_gm_recom" name="edit_gm_recom"
                                                placeholder="Enter your recomendation here ..."></textarea>
                                        </div>

                                        <!-- Image part -->
                                        <div class="row mt-2">
                                            <div class="col-md-4 p-0">
                                                <div class="container"
                                                    style="width:80%; padding: 0px; margin-left:0px;">
                                                    <h6 style="margin-bottom: 15px; ">Agreement Image :</h6>
                                                    <input type="file" class="form-control" name="edit_agree_image"
                                                        id="edit_agree_image" accept=".png , .jpg , .jpeg"
                                                        onchange="document.getElementById('preview_edit_img1').src = window.URL.createObjectURL(this.files[0])">
                                                    <div class="card" style="margin-bottom: 0px;">
                                                        <div class="card-body"
                                                            style="padding-top: 11px;padding-right: 6px;padding-bottom: 11px;padding-left: 6px;">
                                                            <img name="preview_edit_img1" id="preview_edit_img1"
                                                                style="width: 135px; height: 135px;  margin-left:35px;">
                                                        </div>
                                                    </div>
                                                    <p id="error_message_edit1"></p>
                                                </div>
                                            </div>
                                            <div class="col-md-4 p-0">
                                                <div class="container" style="width:80%; padding: 0px;">
                                                    <h6 style="margin-bottom: 15px;">Approval Image :</h6>
                                                    <input type="file" class="form-control" name="edit_approval_image"
                                                        id="edit_approval_image" accept=".png , .jpg , .jpeg"
                                                        onchange="document.getElementById('preview_edit_img2').src = window.URL.createObjectURL(this.files[0])">
                                                    <div class="card" style="margin-bottom: 0px;">
                                                        <div class="card-body"
                                                            style="padding-top: 11px;padding-right: 6px;padding-bottom: 11px;padding-left: 6px;">
                                                            <img name="preview_edit_img2" id="preview_edit_img2"
                                                                style="width: 135px; height: 135px;  margin-left:35px;">
                                                        </div>
                                                    </div>
                                                    <p id="error_message_edit2"></p>
                                                </div>
                                            </div>
                                            <div class="col-md-4 p-0">
                                                <div class="container"
                                                    style="width:80%; padding: 0px; margin-right:0px;">
                                                    <h6 style="margin-bottom: 15px;">Trade License Image :</h6>
                                                    <input type="file" class="form-control" name="edit_tl_image"
                                                        id="edit_tl_image" accept=".png , .jpg , .jpeg"
                                                        onchange="document.getElementById('preview_edit_img3').src = window.URL.createObjectURL(this.files[0])">
                                                    <div class="card" style="margin-bottom: 0px;">
                                                        <div class="card-body"
                                                            style="padding-top: 11px;padding-right: 6px;padding-bottom: 11px;padding-left: 6px;">
                                                            <img name="preview_edit_img3" id="preview_edit_img3"
                                                                style="width: 135px; height: 135px;  margin-left:35px;">
                                                        </div>
                                                    </div>
                                                    <p id="error_message_edit3"></p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- is_active & is_approve part -->
                                        <div class="row">
                                            <div class="col-md-3 mt-3 ps-0">
                                                <label for="edit_status" class="p-0">
                                                    <h6 class="mt-2">Status:</h6>
                                                </label>
                                                <select name="edit_status" id="edit_status" class="form-control"
                                                    style="height: 30px!important;">
                                                    <option value="1">Active</option>
                                                    <option value="0">In Active</option>
                                                    <option value="-1">Closed</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3 mt-3 pe-0">
                                                <label for="edit_is_approve" class="p-0">
                                                    <h6 class="mt-2">Approve:</h6>
                                                </label>
                                                <select name="edit_is_approve" id="edit_is_approve" class="form-control"
                                                    style="height: 30px!important;">
                                                    <option value="1">Yes</option>
                                                    <option value="0">No</option>
                                                </select>
                                            </div>

                                            <!-- start & closing approval date -->
                                            <div class="col-md-3 mt-3">
                                                <label for="edit_appr_start_date" class="p-0">
                                                    <h6 class="mt-2">Approval Date:</h6>
                                                </label>
                                                <input type="text" class="form-control appr_start_date"
                                                    name="edit_appr_start_date" id="edit_appr_start_date"
                                                    placeholder="Enter Approval Start Date"
                                                    style="height: 30px!important;" onfocus="(this.type='date')"
                                                    onblur="if(this.value==''){this.type='text'}"
                                                    data-date-format="DD MMMM YYYY" />
                                            </div>
                                            <div class="col-md-3 mt-3 pe-0">
                                                <label for="edit_appr_close_date" class="p-0">
                                                    <h6 class="mt-2">Closing Date:</h6>
                                                </label>
                                                <input type="text" class="form-control appr_close_date"
                                                    name="edit_appr_close_date" id="edit_appr_close_date"
                                                    placeholder="Enter Approval Closing Date"
                                                    style="height: 30px!important;" onfocus="(this.type='date')"
                                                    onblur="if(this.value==''){this.type='text'}"
                                                    data-date-format="DD MMMM YYYY" />
                                            </div>
                                        </div>

                                        <!-- save -->
                                        <div class="row">
                                            <div class="col-md-12 ps-0 mt-3">
                                                <input type="text" name="oper" value="edit" hidden />
                                                <button type="submit"
                                                    class="btn btn-primary btn-square btn-outline-dashed"
                                                    id="edit_distributors">Save</button>
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
    <script src="../../assets/js/pagejs/distributors.js"></script>

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
    font-size: 9px;
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
    line-height: 18px !important;
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 19px !important;
}

.select2-container--default .select2-selection--single {
    height: 20.5px !important;
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

<!-- js for add_modal adding total -->
<script>
function add_sum() {
    var add_val_SDF = $("#add_val_SDF").val();
    var add_val_vans = $("#add_val_vans").val();
    var add_init_lifting = $("#add_init_lifting").val();
    var add_gd_adv = $("#add_gd_adv").val();
    var add_m_credit = $("#add_m_credit").val();
    var add_run_capital = $("#add_run_capital").val();

    if (add_val_SDF === '') {
        add_val_SDF = 0;
    }
    if (add_val_vans === '') {
        add_val_vans = 0;
    }
    if (add_init_lifting === '') {
        add_init_lifting = 0;
    }
    if (add_gd_adv === '') {
        add_gd_adv = 0;
    }
    if (add_m_credit === '') {
        add_m_credit = 0;
    }
    if (add_run_capital === '') {
        add_run_capital = 0;
    }

    var total = parseFloat(add_val_SDF) + parseFloat(add_val_vans) + parseFloat(add_init_lifting) + parseFloat(
        add_gd_adv) + parseFloat(add_m_credit) + parseFloat(add_run_capital);
    $("#add_total_inv").val(total);
}
</script>

<!-- js for edit_modal adding/editing total investment -->
<script>
function edit_sum() {
    var edit_val_SDF = $("#edit_val_SDF").val();
    var edit_val_vans = $("#edit_val_vans").val();
    var edit_init_lifting = $("#edit_init_lifting").val();
    var edit_gd_adv = $("#edit_gd_adv").val();
    var edit_m_credit = $("#edit_m_credit").val();
    var edit_run_capital = $("#edit_run_capital").val();

    if (edit_val_SDF === '') {
        edit_val_SDF = 0;
    }
    if (edit_val_vans === '') {
        edit_val_vans = 0;
    }
    if (edit_init_lifting === '') {
        edit_init_lifting = 0;
    }
    if (edit_gd_adv === '') {
        edit_gd_adv = 0;
    }
    if (edit_m_credit === '') {
        edit_m_credit = 0;
    }
    if (edit_run_capital === '') {
        edit_run_capital = 0;
    }

    var total = parseFloat(edit_val_SDF) + parseFloat(edit_val_vans) + parseFloat(edit_init_lifting) + parseFloat(
        edit_gd_adv) + parseFloat(edit_m_credit) + parseFloat(edit_run_capital);
    $("#edit_total_inv").val(total);
}
</script>

<!-- js for add_modal adding/editing exisiting average market size(TK)/(yearly) -->
<script>
function add_avg_market_size() {
    var add_ig_cont = $("#add_ig_cont").val();
    var add_po_cont = $("#add_po_cont").val();
    var add_lo_cont = $("#add_lo_cont").val();
    var add_ka_cont = $("#add_ka_cont").val();
    var add_bl_cont = $("#add_bl_cont").val();
    var add_kw_cont = $("#add_kw_cont").val();
    var add_others_cont = $("#add_others_cont").val();

    if (add_ig_cont === '') {
        add_ig_cont = 0;
    }
    if (add_po_cont === '') {
        add_po_cont = 0;
    }
    if (add_lo_cont === '') {
        add_lo_cont = 0;
    }
    if (add_ka_cont === '') {
        add_ka_cont = 0;
    }
    if (add_bl_cont === '') {
        add_bl_cont = 0;
    }
    if (add_kw_cont === '') {
        add_kw_cont = 0;
    }
    if (add_others_cont === '') {
        add_others_cont = 0;
    }

    var total_size = parseFloat(add_ig_cont) + parseFloat(add_po_cont) + parseFloat(add_lo_cont) + parseFloat(
        add_ka_cont) + parseFloat(add_bl_cont) + parseFloat(add_kw_cont) + parseFloat(add_others_cont);
    $("#add_exist_avg_m_size").val(total_size);
}
</script>

<!-- js for edit_modal adding/editing exisiting average market size(TK)/(yearly) -->
<script>
function edit_avg_market_size() {
    var edit_ig_cont = $("#edit_ig_cont").val();
    var edit_po_cont = $("#edit_po_cont").val();
    var edit_lo_cont = $("#edit_lo_cont").val();
    var edit_ka_cont = $("#edit_ka_cont").val();
    var edit_bl_cont = $("#edit_bl_cont").val();
    var edit_kw_cont = $("#edit_kw_cont").val();
    var edit_others_cont = $("#edit_others_cont").val();

    if (edit_ig_cont === '') {
        edit_ig_cont = 0;
    }
    if (edit_po_cont === '') {
        edit_po_cont = 0;
    }
    if (edit_lo_cont === '') {
        edit_lo_cont = 0;
    }
    if (edit_ka_cont === '') {
        edit_ka_cont = 0;
    }
    if (edit_bl_cont === '') {
        edit_bl_cont = 0;
    }
    if (edit_kw_cont === '') {
        edit_kw_cont = 0;
    }
    if (edit_others_cont === '') {
        edit_others_cont = 0;
    }

    var total_size = parseFloat(edit_ig_cont) + parseFloat(edit_po_cont) + parseFloat(edit_lo_cont) + parseFloat(
        edit_ka_cont) + parseFloat(edit_bl_cont) + parseFloat(edit_kw_cont) + parseFloat(edit_others_cont);
    $("#edit_exist_avg_m_size").val(total_size);
}
</script>