! function($) {

    // Get View ID
    var vw_id = $("#view_id").val();

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

                    //route data
                    var route = $('#view_route').val();
                    $.ajax({
                        url: "../../apis/apis_n/api.php",
                        type: "post",
                        data: { 'req': '7', 'param': '22', 'data': route },
                        dataType: "json",
                        success: function(result) {
                            $("#route").html(result.r);
                            window.print();
                        }
                    });
                }
            });
        }
    });

}(window.jQuery);