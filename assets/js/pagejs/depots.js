! function($) {


    //*****************************************************************
    //*********************Fetch Depot Table**************************
    //*****************************************************************

    //Fetch depot table data 
    $.ajax({
        url: "../../apis/apis_n/api.php",
        type: "post",
        data: { 'req': '1', 'param': '1', 'get': 'body' },
        dataType: "json",
        success: function(result) {
            $("#depot_table").html(result);
            $("#depot_table1").html(result);
        }
    });


    //*****************************************************************
    //**********************Add Depot data****************************
    //*****************************************************************

    // region dropdown lists --> for adding area
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
            }
        });
    });

    // add depot --> form submit on save --> inserting to database & fetch results on table
    $('#add_depot_form').submit(function(event) {
        event.preventDefault();
        $.ajax({
            data: $(this).serialize(),
            url: "../../controller/process_depot_data.php", //php page URL where we post this data to save in database
            type: 'POST',
            success: function(result_1) {
                $.ajax({
                    url: "../../apis/apis_n/api.php",
                    type: "post",
                    data: { 'req': '1', 'param': '1', 'get': 'body' },
                    dataType: "json",
                    success: function(result) {
                        if (result_1 == 'true') {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Depot has been saved',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $("#depot_table").html(result);
                            $("#add_depot_form")[0].reset();
                            $("#create_new").modal('hide');
                        } else {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: 'Something Went Wrong. Please Try Again',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $("#depot_table").html(result);
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

        $("#depot_table tr td:nth-child(" + search_category + ")").each(function() {
            $(this).parent().toggle($(this).text().toLowerCase().indexOf(search_input) > -1)
        });
    });

    //*****************************************************************
    //**********************Edit Depots Data**************************
    //*****************************************************************

    //Fetch attributes on click edit buttons
    $("#depot_table").on('click', '#btn_edit', function(e) {
        var did = $(this).attr('data-id');
        $("#edit_id").val(did);
        var org_id = $(this).attr('match-org-id');
        $("#org_id").val(org_id);

        $("#modal_edit").modal('show');
    });

    //Get id's of the attributes
    $("#modal_edit").on('show.bs.modal', function(event) {
        // Get Depot ID
        var d_id = $("#edit_id").val();

        // Get org_id 
        var org_id = $("#org_id").val();

        $.ajax({
            url: "../../apis/apis_n/api.php",
            type: "post",
            data: { 'req': '1', 'param': '2', 'data': d_id },
            dataType: "json",
            success: function(result) {
                $("#edit_code").val(result['code']);
                $("#edit_name").val(result['name']);
                $("#edit_defination").val(result['definition']);
                $("#edit_address").val(result['address']);

                $("#edit_status > [value=" + result['is_active'] + "]").attr("selected", "true");
                $("#edit_status").trigger("change");

                // GET region id from depot table --> to show region name in depot table
                var r_id = result['region'];
                $.ajax({
                    url: "../../apis/apis_n/api.php",
                    type: "post",
                    data: { 'req': '2', 'param': '3', 'match': r_id, 'filter': 'org_id = ' + org_id },
                    dataType: "json",
                    success: function(result) {
                        $("#edit_region_list").html(result);
                    }
                });
            }
        });
    });

    // edit depot form submit on save --> updating the database & fetch results on table
    $('#edit_depot_form').submit(function(event) {
        event.preventDefault();
        $.ajax({
            data: $(this).serialize(),
            url: "../../controller/process_depot_data.php", //php page URL where we post this data to save in database
            type: 'POST',
            success: function(result_1) {
                $.ajax({
                    url: "../../apis/apis_n/api.php",
                    type: "post",
                    data: { 'req': '1', 'param': '1', 'get': 'body' },
                    dataType: "json",
                    success: function(result) {
                        if (result_1 == 'true') {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Depot has been edited',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $("#depot_table").html(result);
                            $("#edit_depot_form")[0].reset();
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