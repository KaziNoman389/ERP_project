! function($) {


    //*****************************************************************
    //*********************Fetch area Table****************************
    //*****************************************************************

    //Fetch Area table data 
    $.ajax({
        url: "../../apis/apis_n/api.php",
        type: "post",
        data: { 'req': '3', 'param': '4', 'get': 'body' },
        dataType: "json",
        success: function(result) {
            $("#area_table").html(result);
            $("#area_table1").html(result);
        }
    });


    //*****************************************************************
    //**********************Add area data****************************
    //*****************************************************************


    // region and depot dropdown lists --> for adding area
    $("#create_new").on('show.bs.modal', function(e) {
        // Get org_id from session
        var org_id = $("#org_id_add").data('value');

        $.ajax({
            url: "../../apis/apis_n/api.php",
            type: "post",
            data: { 'req': '2', 'param': '3', 'get': 'body', 'filter': 'org_id = ' + org_id },
            dataType: "json",
            success: function(result) {
                $("#region_list").html(result);
                $('#depot_list').html('<option value="default" disabled>Select Depot</option>');

                // Dynamic dependable depot dropdown list with respect to region
                $("#region_list").on("change", function() {
                    var region_id = $(this).val();
                    $.ajax({
                        url: "../../apis/apis_n/api.php",
                        type: "POST",
                        dataType: "json",
                        data: { 'req': '1', 'param': '6', 'data': region_id },
                        success: function(response) {
                            $("#depot_list").attr("required", true);
                            $("#depot_list").html(response);
                        }
                    });
                });
            }
        });
    });

    // add area --> form submit on save --> inserting to database & fetch results on table
    $('#add_area_form').submit(function(event) {
        event.preventDefault();
        $.ajax({
            data: $(this).serialize(),
            url: "../../controller/process_area_data.php", //php page URL where we post this data to save in database
            type: 'POST',
            success: function(result_1) {
                $.ajax({
                    url: "../../apis/apis_n/api.php",
                    type: "post",
                    data: { 'req': '3', 'param': '4', 'get': 'body' },
                    dataType: "json",
                    success: function(result) {
                        if (result_1 == 'true') {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Area has been saved',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $("#area_table").html(result);
                            $("#add_area_form")[0].reset();
                            $("#create_new").modal('hide');
                        } else {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: 'Something Went Wrong. Please Try Again',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $("#area_table").html(result);
                            // $("#add_area_form")[0].reset();
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

        $("#area_table tr td:nth-child(" + search_area_category + ")").each(function() {
            $(this).parent().toggle($(this).text().toLowerCase().indexOf(search_input) > -1)
        });
    });


    //*****************************************************************
    //**********************Edit areas Data**************************
    //*****************************************************************

    //Fetch attributes on click edit buttons
    $("#area_table").on('click', '#btn_edit', function(e) {
        var a_data = $(this).attr('data-id');
        $("#edit_id").val(a_data);

        var dep_id = $(this).attr('match-id');
        $("#depot_id").val(dep_id);

        var org_id = $(this).attr('match-org-id');
        $("#org_id").val(org_id);

        $("#modal_edit").modal('show');
    });

    //Get id's of the attributes
    $("#modal_edit").on('show.bs.modal', function(event) {
        // Get area ID
        var a_id = $("#edit_id").val();

        // Get depot ID (match-id)
        var d_id = $("#depot_id").val();

        //Get org_id (match-org-id)
        var org_id = $("#org_id").val();

        $.ajax({
            url: "../../apis/apis_n/api.php",
            type: "post",
            data: { 'req': '3', 'param': '5', 'data': a_id },
            dataType: "json",
            success: function(result) {
                $("#edit_code").val(result['code']);
                $("#edit_name").val(result['name']);
                $("#edit_defination").val(result['definition']);

                $("#edit_status > [value=" + result['is_active'] + "]").attr("selected", "true");
                $("#edit_status").trigger("change");

                // GET region id from area table
                var r_id = result['region_id'];
                $.ajax({
                    url: "../../apis/apis_n/api.php",
                    type: "post",
                    data: { 'req': '2', 'param': '3', 'match': r_id, 'filter': 'org_id = ' + org_id },
                    dataType: "json",
                    success: function(result) {
                        $("#edit_region_list").html(result);
                        // $('#edit_depot_list').html('<option value="" disabled>Select Depot</option>');

                        //using depot ID to find depot list for area table (matching region id from depot table) --> to show depot list in edit area modal
                        $.ajax({
                            url: "../../apis/apis_n/api.php",
                            type: "POST",
                            dataType: "json",
                            data: { 'req': '1', 'param': '3', 'match': d_id, 'filter': 'region = ' + r_id },
                            success: function(result) {
                                $("#edit_depot_list").html(result);
                            }
                        });

                        // Dynamic dependable depot dropdown list with respect to region
                        $("#edit_region_list").on("change", function() {
                            var region_id = $(this).val();
                            $.ajax({
                                url: "../../apis/apis_n/api.php",
                                type: "POST",
                                dataType: "json",
                                data: { 'req': '1', 'param': '3', 'filter': 'region = ' + region_id },
                                success: function(result) {
                                    $("#edit_depot_list").html(result);
                                }
                            });
                        });
                    }
                });
            }
        });
    });

    // edit area form submit on save --> updating the database & fetch results on table
    $('#edit_area_form').submit(function(event) {
        event.preventDefault();
        $.ajax({
            data: $(this).serialize(),
            url: "../../controller/process_area_data.php", //php page URL where we post this data to save in database
            type: 'POST',
            success: function(result_1) {
                $.ajax({
                    url: "../../apis/apis_n/api.php",
                    type: "post",
                    data: { 'req': '3', 'param': '4', 'get': 'body' },
                    dataType: "json",
                    success: function(result) {
                        if (result_1 == 'true') {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Area has been edited',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $("#area_table").html(result);
                            $("#edit_area_form")[0].reset();
                            $('#modal_edit').modal('hide');
                        } else {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: 'Something Went Wrong. Please Try Again',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $("#area_table").html(result);
                            // $("#edit_area_form")[0].reset();
                        }

                    }
                });
            }
        });
    });


}(window.jQuery);