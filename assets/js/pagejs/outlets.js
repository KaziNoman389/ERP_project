! function($) {

    //*****************************************************************
    //*********************Fetch Outlets Table**************************
    //*****************************************************************

    $.ajax({
        url: "../../apis/apis_n/api.php",
        type: "post",
        data: { 'req': '8', 'param': '25', 'get': 'body' },
        dataType: "json",
        success: function(result) {
            $("#outlets_table").html(result);
        }
    });


    //********************************************************************
    //*********************View Distributors data**************************
    //********************************************************************


    //Fetch attributes on click view button
    $("#outlets_table").on('click', '#btn_view', function(e) {
        var ds_data = $(this).attr('data-id');
        $("#view_id").val(ds_data);
        $("#modal_view").modal('show');
    });

    //Get id's of the attributes
    $("#modal_view").on('show.bs.modal', function(event) {
        // Get View ID
        var vw_id = $("#view_id").val();

        $("#print_div").html('<a class="btn btn-sm btn-outline-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom" title = "Print" target = "_blank" href="print?view_id=' + vw_id + '" ><i class = "align-self-center fa fa-print icon-xs"></i></a >');

        //Fetch outlets table data for view
        $.ajax({
            url: "../../apis/apis_n/api.php",
            type: "post",
            data: { 'req': '8', 'param': '30', 'data': vw_id },
            dataType: "json",
            success: function(result) {
                $("#part1_body").html(result.t1);

                $('#view_distri').val(result.ds);
                $('#view_route').val(result.rs);

                //distributor data
                var distributors = $('#view_distri').val();
                $.ajax({
                    url: "../../apis/apis_n/api.php",
                    type: "post",
                    data: { 'req': '5', 'param': '29', 'data': distributors },
                    dataType: "json",
                    success: function(result) {
                        $("#distri").html(result.d);
                    }
                });

                //route data
                var route = $('#view_route').val();
                $.ajax({
                    url: "../../apis/apis_n/api.php",
                    type: "post",
                    data: { 'req': '7', 'param': '22', 'data': route },
                    dataType: "json",
                    success: function(result) {
                        $("#route").html(result.r);
                    }
                });

            }
        });
    });


    //*****************************************************************
    //**********************Add Outlets data****************************
    //*****************************************************************

    $("#create_new").on('show.bs.modal', function(e) {
        // multiselect distributors from select2
        $.ajax({
            url: "../../apis/apis_n/api.php",
            type: "post",
            data: { 'req': '5', 'param': '27' },
            dataType: "json",
            success: function(result) {
                $("#add_distributors").html(result);
            }
        });

        // multiselect routes from select2
        $.ajax({
            url: "../../apis/apis_n/api.php",
            type: "post",
            data: { 'req': '7', 'param': '17' },
            dataType: "json",
            success: function(result) {
                $("#add_routes").html(result);
            }
        });
    });

    $('#add_outlets_form').submit(function(event) {
        event.preventDefault();
        $.ajax({
            data: $(this).serialize(),
            url: "../../controller/process_outlets_data.php", //php page URL where we post this data to save in database
            type: 'POST',
            success: function(result_1) {
                $.ajax({
                    url: "../../apis/apis_n/api.php",
                    type: "post",
                    data: { 'req': '8', 'param': '25', 'get': 'body' },
                    dataType: "json",
                    success: function(result) {
                        if (result_1 == 'true') {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Outlets has been saved',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $("#outlets_table").html(result);
                            $("#create_new").modal('hide');
                            $("#add_routes_form")[0].reset();
                        } else {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: 'Something Went Wrong. Please Try Again',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $("#outlets_table").html(result);
                        }
                    }
                });
            }
        });
    });


    //*****************************************************************
    //**********************Search From Table**************************
    //*****************************************************************

    // Search Depot Table
    $("#search_input").on("keyup", function() {
        var search_input = $(this).val().toLowerCase();
        var search_category_value = $('#search_category').val();
        var search_category = parseInt(search_category_value) + 1;

        $("#outlets_table tr td:nth-child(" + search_category + ")").each(function() {
            $(this).parent().toggle($(this).text().toLowerCase().indexOf(search_input) > -1)
        });
    });


    //*****************************************************************
    //**********************Edit Outlets Data**************************
    //*****************************************************************

    $("#outlets_table").on('click', '#btn_edit', function(e) {
        var did = $(this).attr('data-id');
        $("#edit_id").val(did);
        $("#modal_edit").modal('show');
    });

    $("#modal_edit").on('show.bs.modal', function(event) {
        // Get outlet ID
        var did = $("#edit_id").val();

        // multiselect areas from select2
        $.ajax({
            url: "../../apis/apis_n/api.php",
            type: "post",
            data: { 'req': '8', 'param': '31', 'data': did },
            dataType: "json",
            success: function(result) {
                $("#edit_distributors").html(result);
            }
        });

        // multiselect routes from select2
        $.ajax({
            url: "../../apis/apis_n/api.php",
            type: "post",
            data: { 'req': '8', 'param': '32', 'data': did },
            dataType: "json",
            success: function(result) {
                $("#edit_routes").html(result);
            }
        });

        // Outlets Details Fetch From Database
        $.ajax({
            url: "../../apis/apis_n/api.php",
            type: "post",
            data: { 'req': '8', 'param': '26', 'data': did },
            dataType: "json",
            success: function(result) {
                $('#edit_name').val(result['name']);
                $("#edit_owner_name").val(result['owner_name']);
                $("#edit_address").val(result['address']);

                $('#edit_owner_contact_1').val(result['owner_contact_1']);
                $("#edit_owner_contact_2").val(result['owner_contact_2']);

                $("#edit_business_contact_1").val(result['business_contact_1']);
                $('#edit_business_contact_2').val(result['business_contact_2']);

                $("#edit_approved > [value=" + result['is_approved'] + "]").attr("selected", "true");
                $("#edit_approved").trigger("change");

                $("#edit_status").val(result['is_active']);

                // $("#edit_status > [value=" + result['is_active'] + "]").attr("selected", "true");
                // $("#edit_status").trigger("change");
            }
        });
    });

    // *************************************************************************************************
    $('#edit_outlets_form').submit(function(event) {
        event.preventDefault();
        $.ajax({
            data: $(this).serialize(),
            url: "../../controller/process_outlets_data.php", //php page URL where we post this data to save in database
            type: 'POST',
            success: function(result_1) {
                $.ajax({
                    url: "../../apis/apis_n/api.php",
                    type: "post",
                    data: { 'req': '8', 'param': '25', 'get': 'body' },
                    dataType: "json",
                    success: function(result) {
                        if (result_1 == 'true') {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Outlets has been edited',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $("#outlets_table").html(result);
                            $("#edit_outlets_form")[0].reset();
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