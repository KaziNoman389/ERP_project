! function($) {

    //*****************************************************************
    //*********************Fetch area Table**************************
    //*****************************************************************

    //Fetch Territory table data 
    $.ajax({
        url: "../../apis/apis_n/api.php",
        type: "post",
        data: { 'req': '4', 'param': '7', 'get': 'body' },
        dataType: "json",
        success: function(result) {
            $("#territories_table").html(result);
            $("#territories_table1").html(result);
        }
    });


    //*****************************************************************
    //**********************Add territory data******************************
    //****************************************************************

    // region, depot and area dropdown lists --> for adding area
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

                //Dynamic dependable dropdown depots list with respect to a paticular region
                $("#region_list").on("change", function() {
                    //GET this region ID
                    var region_id = $(this).val();

                    $.ajax({
                        url: "../../apis/apis_n/api.php",
                        type: "POST",
                        dataType: "json",
                        data: { 'req': '1', 'param': '6', 'data': region_id },
                        success: function(response) {
                            $("#depot_list").html(response);

                            // Dynamic dependable dropdown areas list with respect to paticular depot
                            $("#depot_list").on("change", function() {
                                var depot_id = $(this).val();
                                $.ajax({
                                    url: "../../apis/apis_n/api.php",
                                    type: "POST",
                                    dataType: "json",
                                    data: { 'req': '3', 'param': '9', 'data': depot_id },
                                    success: function(response) {
                                        $("#area_list").html(response);
                                    }
                                });
                            });
                        }
                    });
                });
            }
        });
    });

    // add territory --> form submit on save --> inserting to database & fetch results on table
    $('#add_territories_form').submit(function(event) {
        event.preventDefault();
        $.ajax({
            data: $(this).serialize(),
            url: "../../controller/process_territories_data.php", //php page URL where we post this data to save in database
            type: 'POST',
            success: function(result_1) {
                $.ajax({
                    url: "../../apis/apis_n/api.php",
                    type: "post",
                    data: { 'req': '4', 'param': '7', 'get': 'body' },
                    dataType: "json",
                    success: function(result) {
                        if (result_1 == 'true') {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Territory has been saved',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $("#territories_table").html(result);
                            $("#add_territories_form")[0].reset();
                            $("#create_new").modal('hide');
                        } else {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: 'Something Went Wrong. Please Try Again',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $("#territories_table").html(result);
                            // $("#add_territories_form")[0].reset();
                        }
                    }
                });
            }
        });
    });


    //*****************************************************************
    //**********************Search From Table**************************
    //*****************************************************************

    // Search Territory Table
    $("#search_input").on("keyup", function() {
        var search_input = $(this).val().toLowerCase();
        var search_territory_category_value = $('#search_territories').val();
        var search_territory_category = parseInt(search_territory_category_value) + 1;

        $("#territories_table tr td:nth-child(" + search_territory_category + ")").each(function() {
            $(this).parent().toggle($(this).text().toLowerCase().indexOf(search_input) > -1)
        });
    });


    //*****************************************************************
    //**********************Edit territory Data****************************
    //*****************************************************************

    //Fetch attributes on click edit buttons
    $("#territories_table").on('click', '#btn_edit', function(e) {
        var t_data = $(this).attr('data-id');
        $("#edit_id").val(t_data);

        var area_id = $(this).attr('a-id');
        $("#area_id").val(area_id);

        var org_id = $(this).attr('match-org-id');
        $("#org_id").val(org_id);

        $("#modal_edit").modal('show');
    });

    //Get id's of the attributes
    $("#modal_edit").on('show.bs.modal', function(event) {
        // Get Territory ID
        var t_id = $("#edit_id").val();

        // Get area ID
        var a_id = $("#area_id").val();

        //Get org_id (match-org-id)
        var org_id = $("#org_id").val();

        $.ajax({
            url: "../../apis/apis_n/api.php",
            type: "post",
            data: { 'req': '4', 'param': '8', 'data': t_id },
            dataType: "json",
            success: function(result) {
                $("#edit_code").val(result['code']);
                $("#edit_name").val(result['name']);
                $("#edit_defination").val(result['definition']);

                $("#edit_status > [value=" + result['is_active'] + "]").attr("selected", "true");
                $("#edit_status").trigger("change");

                // GET region id from territories table(using sub queries)
                var r_id = result['region_id'];

                // GET depot id from territories table(using sub queries)
                var d_id = result['depot_id'];

                //using region ID to find region list --> to show region list in edit territories modal
                $.ajax({
                    url: "../../apis/apis_n/api.php",
                    type: "post",
                    data: { 'req': '2', 'param': '3', 'match': r_id, 'filter': 'org_id = ' + org_id },
                    dataType: "json",
                    success: function(result_1) {
                        $("#edit_region_list").html(result_1);

                        //using region ID to find depot list --> to show depot list in edit territories modal
                        $.ajax({
                            url: "../../apis/apis_n/api.php",
                            type: "POST",
                            dataType: "json",
                            data: { 'req': '1', 'param': '3', 'match': d_id, 'filter': 'region = ' + r_id },
                            success: function(result_2) {
                                $("#edit_depot_list").html(result_2);

                                //using depot ID to find area list --> to show area list in edit territories modal
                                $.ajax({
                                    url: "../../apis/apis_n/api.php",
                                    type: "POST",
                                    dataType: "json",
                                    data: { 'req': '3', 'param': '3', 'match': a_id, 'filter': 'depot = ' + d_id },
                                    success: function(result_3) {
                                        $("#edit_area_list").html(result_3);
                                    }
                                });
                            }
                        });

                        // Dynamic dependable depot dropdown list with respect to paticular region
                        $("#edit_region_list").on("change", function() {

                            var region_id = $(this).val();
                            $.ajax({
                                url: "../../apis/apis_n/api.php",
                                type: "POST",
                                dataType: "json",
                                data: { 'req': '1', 'param': '3', 'filter': 'region = ' + region_id },
                                success: function(result) {
                                    $("#edit_depot_list").html(result);

                                    // Dynamic dependable dropdown areas list with respect to paticular depot
                                    $("#edit_depot_list").on("change", function() {

                                        var depot_id = $(this).val();
                                        $.ajax({
                                            url: "../../apis/apis_n/api.php",
                                            type: "POST",
                                            dataType: "json",
                                            data: { 'req': '3', 'param': '3', 'filter': 'depot = ' + depot_id },
                                            success: function(response) {
                                                $("#edit_area_list").html(response);
                                            }
                                        });
                                    });
                                }

                            });
                        });
                    }
                });
            }
        });
    });

    // edit territory form submit on save --> updating the database & fetch results on table
    $('#edit_territories_form').submit(function(event) {
        event.preventDefault();
        $.ajax({
            data: $(this).serialize(),
            url: "../../controller/process_territories_data.php", //php page URL where we post this data to save in database
            type: 'POST',
            success: function(result_1) {
                $.ajax({
                    url: "../../apis/apis_n/api.php",
                    type: "post",
                    data: { 'req': '4', 'param': '7', 'get': 'body' },
                    dataType: "json",
                    success: function(result) {
                        if (result_1 == 'true') {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Teritory has been edited',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $("#territories_table").html(result);
                            $("#edit_territories_form")[0].reset();
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