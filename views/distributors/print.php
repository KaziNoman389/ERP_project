<?php
    $view_id = $_GET['view_id'];
?>

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

</head>

<body>
    <div class="container-fluid" id="print_view">
        <div class="ref mt-5 mb-1" id="part_ref">

        </div>
        <div class="card">
            <div class="card-body">
                <input type="text" id="view_id" name="view_id" value="<?php echo $view_id?>" hidden>
                <div class="fixed-thead" style="overflow-x: hidden;">
                    <div class="container-fluid">
                        <!-- table part 1 -->
                        <div class="row">
                            <div class="col-5">
                                <h4 class="h">Savoy Ice Cream</h4>
                                <h4 class="h">Factory Limited</h4>
                                <h6 class="h" style="text-decoration: underline;">Pre-Assessment form
                                    for
                                    Distrributorship
                                </h6>
                                <h6 class="h">(Including Market Survey Report)</h6>
                            </div>
                            <div class="col-5">
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
    <script src="print.js"></script>
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
    color: #000000;
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

.edit_label,
.add_label,
.ref {
    color: #000000;
}

.view_label {
    font-size: 11px !important;
    margin-left: 5px;
}

#add_ref,
#edit_ref {
    width: 21%;
    height: 18px;
    display: inline-block;
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

@media print {
    @page {
        margin: 0;
    }
}
</style>