! function($) {

    //*****************************************************************
    //******************** Fetch area Table ***************************
    //*****************************************************************

    //Fetch Distributor table data 
    $.ajax({
        url: "../../apis/apis_n/api.php",
        type: "post",
        data: { 'req': '10', 'param': '34', 'get': 'body' },
        dataType: "json",
        success: function(result) {
            $("#distribution_target_table").html(result);
        }
    });


    //********************************************************************
    //******************** View Distributors data ************************
    //********************************************************************

    //Fetch id's attributes on click edit buttons
    $("#distribution_target_table").on('click', '#btn_view', function(e) {
        var ds_data = $(this).attr('data-id');
        $("#view_id").val(ds_data);

        $("#modal_view").modal('show');
    });

    $('#modal_view').on('show.bs.modal', function(event) {
        //view id
        var v_id = $("#view_id").val();

        //Fetch Distributor table data 
        $.ajax({
            url: "../../apis/apis_n/api.php",
            type: "post",
            data: { 'req': '11', 'param': '37', 'data': v_id },
            dataType: "json",
            success: function(result) {
                $("#distribution_target_view_table").html(result);

                $("#distribution_target_view_table").on('focus', '#edit_amount', function(e) {
                    var ob_data = $(this).attr('data-id');
                    $("#t_id").val(ob_data);
                });

                $("#distribution_target_view_table").on('change', '#edit_amount', function() {
                    // Get edit ID
                    var eid = $("#t_id").val();

                    // Get current value
                    var edit_amount = $(this).val();

                    $.ajax({
                        type: "POST",
                        url: "../../controller/process_distributors_target_details_data.php",
                        data: { edit_id: eid, edit_amount: edit_amount },
                        dataType: "text",
                        success: function(result_1) {

                        }
                    });
                });
            }
        });

        //------------ Advanced Filtering Starts -------------//

        // Using region list from distributor_target_details database --> [ to show region list in view distributor target modal ]
        $.ajax({
            url: "../../apis/apis_n/api.php",
            type: "post",
            data: { 'req': '11', 'param': '38', 'get': 'body' },
            dataType: "json",
            success: function(result_1) {
                $("#region_list").html(result_1);

                // region changing from list
                $("#region_list").on('change', function() {
                    var r_id = $(this).val();

                    $.ajax({
                        type: "post",
                        url: "../../apis/apis_n/api.php",
                        data: { 'req': '11', 'param': '39', 'filter': 'target = ' + v_id + ' AND ' + 'region_id = ' + r_id },
                        dataType: "json",
                        success: function(result) {
                            $("#distribution_target_view_table").html(result);

                            // Dynamic dependable depot dropdown list with respect to paticular region
                            $.ajax({
                                url: "../../apis/apis_n/api.php",
                                type: "post",
                                data: { 'req': '11', 'param': '40', 'get': 'body' },
                                dataType: "json",
                                success: function(result_2) {
                                    $("#depot_list").html(result_2);

                                    // depot changing from list
                                    $("#depot_list").on('change', function() {
                                        var d_id = $(this).val();

                                        $.ajax({
                                            type: "post",
                                            url: "../../apis/apis_n/api.php",
                                            data: { 'req': '11', 'param': '39', 'filter': 'target = ' + v_id + ' AND ' + 'region_id = ' + r_id + ' AND ' + 'depot_id = ' + d_id },
                                            dataType: "json",
                                            success: function(result) {
                                                $("#distribution_target_view_table").html(result);

                                                // Dynamic dependable area dropdown list with respect to paticular depot
                                                $.ajax({
                                                    type: "post",
                                                    url: "../../apis/apis_n/api.php",
                                                    data: { 'req': '11', 'param': '41', 'get': 'body' },
                                                    dataType: "json",
                                                    success: function(result_3) {
                                                        $("#area_list").html(result_3);


                                                        // area changing from list
                                                        $("#area_list").on('change', function() {
                                                            var a_id = $(this).val();

                                                            $.ajax({
                                                                type: "post",
                                                                url: "../../apis/apis_n/api.php",
                                                                data: { 'req': '11', 'param': '39', 'filter': 'target = ' + v_id + ' AND ' + 'region_id = ' + r_id + ' AND ' + 'depot_id = ' + d_id + ' AND ' + 'area_id = ' + a_id },
                                                                dataType: "json",
                                                                success: function(result) {
                                                                    $("#distribution_target_view_table").html(result);

                                                                    // Dynamic dependable territory dropdown list with respect to paticular area
                                                                    $.ajax({
                                                                        type: "post",
                                                                        url: "../../apis/apis_n/api.php",
                                                                        data: { 'req': '11', 'param': '42', 'get': 'body' },
                                                                        dataType: "json",
                                                                        success: function(result_4) {
                                                                            $("#territory_list").html(result_4);

                                                                            // territory changing from list
                                                                            $("#territory_list").on('change', function() {
                                                                                var t_id = $(this).val();

                                                                                $.ajax({
                                                                                    type: "post",
                                                                                    url: "../../apis/apis_n/api.php",
                                                                                    data: { 'req': '11', 'param': '39', 'filter': 'target = ' + v_id + ' AND ' + 'region_id = ' + r_id + ' AND ' + 'depot_id = ' + d_id + ' AND ' + 'area_id = ' + a_id + ' AND ' + 'territory = ' + t_id },
                                                                                    dataType: "json",
                                                                                    success: function(result) {
                                                                                        $("#distribution_target_view_table").html(result);
                                                                                    }
                                                                                });
                                                                            });

                                                                        }
                                                                    });

                                                                }
                                                            });
                                                        });
                                                    }
                                                });

                                            }
                                        });
                                    });
                                }
                            });
                        }
                    });
                });
            }
        });

        //------------ Advanced Filtering Ends -------------//
    });


    //********************************************************************
    //******************** Add Distributors data *************************
    //********************************************************************

    // Add distributors_targe form submit on save --> updating the database & fetch results on table
    $("#add_distributors_target_form").on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            data: $(this).serialize(),
            url: "../../controller/process_distributors_target_data.php", //php page URL where we post this data to save in database
            type: "POST",
            success: function(result_1) {
                $.ajax({
                    url: "../../apis/apis_n/api.php",
                    type: "post",
                    data: { 'req': '10', 'param': '34', 'get': 'body' },
                    dataType: "json",
                    success: function(result) {
                        if (result_1 == 'true') {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Distributors Target has been saved',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $("#distribution_target_table").html(result);
                            $("#add_distributors_target_form")[0].reset();
                            $("#create_new").modal('hide');
                        } else {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: 'Something is wrong. Please try again !',
                                showConfirmButton: false,
                                timer: 7000
                            })
                            $("#distribution_target_table").html(result);
                        }
                    }
                });
            }
        });
    });


    //*****************************************************************
    //********************* Search From Table *************************
    //*****************************************************************


    // Search Distributor Table
    $("#search_input").on("keyup", function() {
        var search_input = $(this).val().toLowerCase();
        var search_territory_category_value = $('#search_distributor').val();
        var search_territory_category = parseInt(search_territory_category_value) + 1;

        $("#distribution_target_table tr td:nth-child(" + search_territory_category + ")").each(function() {
            $(this).parent().toggle($(this).text().toLowerCase().indexOf(search_input) > -1)
        });
    });


    //*****************************************************************
    //******************* Edit Distributor Data ***********************
    //*****************************************************************

    //Fetch id's attributes on click edit buttons
    $("#distribution_target_table").on('click', '#btn_edit', function(e) {
        var ds_data = $(this).attr('data-id');
        $("#edit_id").val(ds_data);

        $("#modal_edit").modal('show');
    });

    //Get id's of the attributes
    $("#modal_edit").on('show.bs.modal', function(event) {
        // Get Distributor ID
        var e_id = $("#edit_id").val();

        // Fetch Distributors_target from database on click edit button
        $.ajax({
            url: "../../apis/apis_n/api.php",
            type: "POST",
            dataType: "json",
            data: { 'req': '10', 'param': '35', 'filter': 'id = ' + e_id },
            success: function(result) {
                $("#edit_name").val(result['name']);
                $("#edit_eff_from").val(result['eff_from']);
                $("#edit_eff_till").val(result['eff_till']);
                $("#edit_status").val(result['is_active']);
            }
        });
    });

    // edit distributor form submit on save --> updating the database & fetch results on table
    $('#edit_distributors_target_form').submit(function(event) {
        event.preventDefault();

        $.ajax({
            url: "../../controller/process_distributors_target_data.php", //php page URL where we post this data to save in database
            type: "POST",
            data: $(this).serialize(),
            success: function(result_1) {
                $.ajax({
                    url: "../../apis/apis_n/api.php",
                    type: "post",
                    data: { 'req': '10', 'param': '34', 'get': 'body' },
                    dataType: "json",
                    success: function(result) {
                        if (result_1 == 'true') {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Distributor has been edited',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $("#distribution_target_table").html(result);
                            $("#edit_distributors_target_form")[0].reset();
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