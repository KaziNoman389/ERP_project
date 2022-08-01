! function($) {

    //*****************************************************************
    //*************** Fetch Product Category Table ********************
    //*****************************************************************

    //Fetch Area table data 
    $.ajax({
        url: "../../apis/apis_n/api.php",
        type: "post",
        data: { 'req': '15', 'param': '49', 'get': 'body' },
        dataType: "json",
        success: function(result) {
            $("#product_categories_table").html(result);
        }
    });
    
    //*****************************************************************
    //****************** Add Product Category data ********************
    //*****************************************************************

    $("#create_new").on('shown.bs.modal', function() {
        $.ajax({
            url: "../../apis/apis_n/api.php",
            type: "post",
            data: { 'req': '15', 'param': '50', 'get': 'body' },
            dataType: "json",
            success: function(result) {
                $("#add_sub_of_list").html(result);

                // JUST TO CHECK ID
                // Function changing from list
                $("#add_sub_of_list").on('change', function() {
                    var m_cat_id = $(this).val();
                    //get current emp id 
                    $("#m_cat_id").val(m_cat_id);
                });
            }
        });
    });

    // add apps --> form submit on save --> inserting to database & fetch results on table
    $('#add_product_categories_form').submit(function(event) {
        event.preventDefault();
        $.ajax({
            data: $(this).serialize(),
            url: "../../controller/process_product_categories_data.php", //php page URL where we post this data to save in database
            type: 'POST',
            success: function(result_1) {
                $.ajax({
                    url: "../../apis/apis_n/api.php",
                    type: "post",
                    data: { 'req': '15', 'param': '49', 'get': 'body' },
                    dataType: "json",
                    success: function(result) {
                        if (result_1 == 'true') {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Product Category has been saved',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $("#product_categories_table").html(result);
                            $("#add_product_categories_form")[0].reset();
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
    //********************* Search From Table *************************
    //*****************************************************************

    // Search Area Table
    $("#search_input").on("keyup", function() {
        var search_input = $(this).val().toLowerCase();
        var search_area_category_value = $('#search_area_category').val();
        var search_area_category = parseInt(search_area_category_value) + 1;

        $("#product_categories_table tr td:nth-child(" + search_area_category + ")").each(function() {
            $(this).parent().toggle($(this).text().toLowerCase().indexOf(search_input) > -1)
        });
    });

    //*****************************************************************
    //***************** Edit Product Category Data ********************
    //*****************************************************************

    //Fetch attributes on click edit buttons
    $("#product_categories_table").on('click', '#btn_edit', function(e) {
        var e_data = $(this).attr('data-id');
        $("#edit_id").val(e_data);

        $("#modal_edit").modal('show');
    });

    //Get id's of the attributes
    $("#modal_edit").on('shown.bs.modal', function(event) {
        // Get area ID
        var e_id = $("#edit_id").val();

        $.ajax({
            url: "../../apis/apis_n/api.php",
            type: "post",
            data: { 'req': '15', 'param': '52', 'data': e_id },
            dataType: "json",
            success: function(result) {
                $("#edit_name").val(result['name']);
                $("#edit_status").val(result['is_active']);
            }
        });

        $.ajax({
            url: "../../apis/apis_n/api.php",
            type: "post",
            data: { 'req': '15', 'param': '53', 'data': e_id },
            dataType: "json",
            success: function(result) {
                $("#edit_sub_of_list").html(result);

                // JUST TO CHECK ID
                // Function changing from list
                $("#edit_sub_of_list").on('change', function() {
                    var m_cat_id = $(this).val();
                    //get current emp id 
                    $("#edit_m_cat_id").val(m_cat_id);
                });
            }
        });

    });

    // edit area form submit on save --> updating the database & fetch results on table
    $('#edit_product_categories_form').submit(function(event) {
        event.preventDefault();
        $.ajax({
            data: $(this).serialize(),
            url: "../../controller/process_product_categories_data.php", //php page URL where we post this data to save in database
            type: 'POST',
            success: function(result_1) {
                $.ajax({
                    url: "../../apis/apis_n/api.php",
                    type: "post",
                    data: { 'req': '15', 'param': '49', 'get': 'body' },
                    dataType: "json",
                    success: function(result) {
                        if (result_1 == 'true') {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Product categories has been edited',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $("#product_categories_table").html(result);
                            $("#edit_product_categories_form")[0].reset();
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
                        // $("#edit_product_categories_form")[0].reset();
                    }
                });
            }
        });
    });

}(window.jQuery);