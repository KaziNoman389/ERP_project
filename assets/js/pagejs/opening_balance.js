! function($) {

    //*****************************************************************
    //*****************Fetch Opening Balance Table*********************
    //*****************************************************************

    //Fetch opening balance table data for view
    $.ajax({
        url: "../../apis/apis_n/api.php",
        type: "post",
        data: { 'req': '9', 'param': '33', 'get': 'body' },
        dataType: "json",
        success: function(result) {
            $("#opening_balance_table").html(result);
        }
    });


    //*****************************************************************
    //**********************Search From Table**************************
    //*****************************************************************

    // Search Depot Table
    $("#search_input").on("keyup", function() {
        var search_input = $(this).val().toLowerCase();
        var search_category_value = $('#search_category').val();
        var search_category = parseInt(search_category_value) + 1;

        $("#opening_balance_table tr td:nth-child(" + search_category + ")").each(function() {
            $(this).parent().toggle($(this).text().toLowerCase().indexOf(search_input) > -1)
        });
    });


    //*****************************************************************
    //******************Edit Opening Balance Data**********************
    //*****************************************************************

    // $("#opening_balance_table").on('focus', '#edit_balance', function(e) {
    //     var ob_data = $(this).attr('data-id');
    //     $("#edit_id").val(ob_data);
    // });


    $("#opening_balance_table").on('keydown', 'input', function(e) {
        $("#opening_balance_table").on('focus', '#edit_balance', function(e) {
            var ob_data = $(this).attr('data-id');
            $("#edit_id").val(ob_data);
        });
    });

    $("#opening_balance_table").on('change', '#edit_balance', function() {
        // Get outlet ID
        var eid = $("#edit_id").val();
        // alert(eid);

        var edit_balance = $(this).val();

        $.ajax({
            type: "POST",
            url: "../../controller/process_opening_balance_data.php",
            data: { edit_id: eid, edit_balance: edit_balance },
            dataType: "text", // If you expect a json as a response
            success: function(result_1) {
                $.ajax({
                    url: "../../apis/apis_n/api.php",
                    type: "post",
                    data: { 'req': '9', 'param': '33', 'get': 'body' },
                    dataType: "json",
                    success: function(result) {
                        // if (result_1 == 'true') {
                        //     Swal.fire({
                        //         position: 'top-end',
                        //         icon: 'success',
                        //         title: 'Opening Balance has been edited',
                        //         showConfirmButton: false,
                        //         timer: 1000
                        //     })
                        $("#opening_balance_table").html(result);
                        // } else {
                        //     Swal.fire({
                        //         position: 'top-end',
                        //         icon: 'error',
                        //         title: 'Something Went Wrong. Please Try Again',
                        //         showConfirmButton: false,
                        //         timer: 1000
                        //     })
                        // }
                    }
                });
            }

        });
    });


}(window.jQuery);