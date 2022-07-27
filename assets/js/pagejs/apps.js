! function($) {

    //*****************************************************************
    //*********************Fetch area Table****************************
    //*****************************************************************

    //Fetch Area table data 
    $.ajax({
        url: "../../apis/apis_n/api.php",
        type: "post",
        data: { 'req': '12', 'param': '43', 'get': 'body' },
        dataType: "json",
        success: function(result) {
            $("#apps_table").html(result);
        }
    });


    //*****************************************************************
    //*********************** Add Apps data****************************
    //*****************************************************************

    // add apps --> form submit on save --> inserting to database & fetch results on table
    $('#add_apps_form').submit(function(event) {
        event.preventDefault();
        $.ajax({
            data: $(this).serialize(),
            url: "../../controller/process_apps_data.php", //php page URL where we post this data to save in database
            type: 'POST',
            success: function(result_1) {
                $.ajax({
                    url: "../../apis/apis_n/api.php",
                    type: "post",
                    data: { 'req': '12', 'param': '43', 'get': 'body' },
                    dataType: "json",
                    success: function(result) {
                        if (result_1 == 'true') {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Apps has been saved',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $("#apps_table").html(result);
                            $("#add_apps_form")[0].reset();
                            $("#create_new").modal('hide');
                        } else {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: 'Something Went Wrong. Please Try Again',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    }
                });
            }
        });
    });


    //*****************************************************************
    //********************* Add function data *************************
    //*****************************************************************


    //Fetch attributes on click function add button
    $('#apps_table').on('click', '#btn_add_func', function() {
        var func_data = $(this).attr('func-id');
        $("#add_func_id").val(func_data);

        $("#modal_function").modal('show');
    });

    //Get id's of the attributes
    $('#modal_function').on('shown.bs.modal', function() {
        // Get function ID
        var f_id = $("#add_func_id").val();

        //Function List
        $.ajax({
            url: "../../apis/apis_n/api.php",
            type: "post",
            data: { 'req': '13', 'param': '45', 'get': 'body' },
            dataType: "json",
            success: function(result) {
                $("#add_func").html(result);
            }
        });
    });

    // add apps function form submit on save --> inserting into the database
    $('#add_apps_function_form').submit(function(event) {
        event.preventDefault();

        $.ajax({
            data: $(this).serialize(),
            url: "../../controller/process_apps_data.php", //php page URL where we post this data to save in database
            type: 'POST',
            success: function(result_1) {
                $.ajax({
                    url: "../../apis/apis_n/api.php",
                    type: "post",
                    data: { 'req': '12', 'param': '43', 'get': 'body' },
                    dataType: "json",
                    success: function(result) {
                        if (result_1 == 'true') {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Function has been saved',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $("#add_apps_function_form select").empty();
                            $("#modal_function").modal('hide');
                        } else {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: 'Something Went Wrong. Please Try Again',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    }
                });
            }
        });
    });


    //*****************************************************************
    //********************* Add employees data *************************
    //*****************************************************************

    //Fetch attributes on click function add button
    $('#apps_table').on('click', '#btn_add_emp', function(e) {
        var emp_data = $(this).attr('emp-id');
        $("#curr_id").val(emp_data);

        $("#modal_emp").modal('show');
    });

    //Get id's of the attributes
    $('#modal_emp').on('shown.bs.modal', function() {
        // Employee list
        $.ajax({
            url: "../../apis/apis_n/api.php",
            type: "post",
            data: { 'req': '6', 'param': '46', 'get': 'body' },
            dataType: "json",
            success: function(result) {
                $("#add_emp_list").html(result);

                // JUST TO CHECK ID
                // employee changing from list
                $("#add_emp_list").on('change', function() {
                    var emp_id = $(this).val();
                    //get current emp id 
                    $("#add_emp_id").val(emp_id);
                });
            }
        });

        // App list 
        $.ajax({
            url: "../../apis/apis_n/api.php",
            type: "post",
            data: { 'req': '12', 'param': '47', 'get': 'body' },
            dataType: "json",
            success: function(result_2) {
                $("#add_apps_list").html(result_2);

                // app changing from list
                $("#add_apps_list").on('change', function() {
                    var app_id = $(this).val();
                    //get current app id 
                    $("#add_app_id").val(app_id);

                    //Function List (Dynamic dependable function dropdown list with respect to paticular app id)
                    $.ajax({
                        url: "../../apis/apis_n/api.php",
                        type: "post",
                        data: { 'req': '13', 'param': '48', 'data': app_id },
                        dataType: "json",
                        success: function(result_3) {
                            $("#add_func_list").html(result_3);

                            // JUST TO CHECK ID
                            // Function changing from list
                            $("#add_func_list").on('change', function() {
                                var f_id = $(this).val();
                                //get current emp id 
                                $("#add_fn_id").val(f_id);
                            });
                        }
                    });
                });
            }
        });
    });

    // add apps function form submit on save --> inserting into the database
    $('#add_apps_emp_form').submit(function(event) {
        event.preventDefault();

        $.ajax({
            data: $(this).serialize(),
            url: "../../controller/process_apps_data.php", //php page URL where we post this data to save in database
            type: 'POST',
            success: function(result_1) {
                $.ajax({
                    url: "../../apis/apis_n/api.php",
                    type: "post",
                    data: { 'req': '12', 'param': '43', 'get': 'body' },
                    dataType: "json",
                    success: function(result) {
                        if (result_1 == 'true') {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Permissions has been saved',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $("#add_apps_emp_form select").empty();
                            $("#modal_emp").modal('hide');
                        } else {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: 'Something Went Wrong. Please Try Again',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    }
                });
            }
        });
    });


    //*****************************************************************
    //**********************Search From Table**************************
    //*****************************************************************

    // Search Area Table
    $("#search_input").on("keyup", function() {
        var search_input = $(this).val().toLowerCase();
        var search_area_category_value = $('#search_area_category').val();
        var search_area_category = parseInt(search_area_category_value) + 1;

        $("#apps_table tr td:nth-child(" + search_area_category + ")").each(function() {
            $(this).parent().toggle($(this).text().toLowerCase().indexOf(search_input) > -1)
        });
    });


    //*****************************************************************
    //**********************Edit Apps Data**************************
    //*****************************************************************

    //Fetch attributes on click edit buttons
    $("#apps_table").on('click', '#btn_edit', function(e) {
        var a_data = $(this).attr('data-id');
        $("#edit_id").val(a_data);

        $("#modal_edit").modal('show');
    });

    //Get id's of the attributes
    $("#modal_edit").on('shown.bs.modal', function(event) {
        // Get area ID
        var e_id = $("#edit_id").val();

        $.ajax({
            url: "../../apis/apis_n/api.php",
            type: "post",
            data: { 'req': '12', 'param': '44', 'filter': 'id = ' + e_id },
            dataType: "json",
            success: function(result) {
                $("#edit_name").val(result['name']);
                $("#edit_d_name").val(result['display_name']);
                $("#edit_link").val(result['link']);
                $("#edit_status").val(result['is_active']);
            }
        });
    });

    // edit area form submit on save --> updating the database & fetch results on table
    $('#edit_apps_form').submit(function(event) {
        event.preventDefault();
        $.ajax({
            data: $(this).serialize(),
            url: "../../controller/process_apps_data.php", //php page URL where we post this data to save in database
            type: 'POST',
            success: function(result_1) {
                $.ajax({
                    url: "../../apis/apis_n/api.php",
                    type: "post",
                    data: { 'req': '12', 'param': '43', 'get': 'body' },
                    dataType: "json",
                    success: function(result) {
                        if (result_1 == 'true') {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Apps has been edited',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $("#apps_table").html(result);
                            $("#edit_apps_form")[0].reset();
                            $('#modal_edit').modal('hide');
                        } else {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: 'Something Went Wrong. Please Try Again',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    }
                });
            }
        });
    });


}(window.jQuery);