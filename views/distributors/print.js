! function($) {

    // Get View ID
    var vw_id = $("#view_id").val();


    //Fetch Distributor table data for view
    $.ajax({
        url: "../../apis/apis_n/api.php",
        type: "post",
        data: { 'req': '5', 'param': '13', 'data': vw_id },
        dataType: "json",
        success: function(result) {
            $("#part_ref").html(result.ref);
            $("#part1_body").html(result.t1);
            $("#part2_body").html(result.t2);
            $("#part3_body").html(result.t3);
            $("#part4_head").html(result.t4h);
            $("#part4_body").html(result.t4b);
            $("#part5_head").html(result.t5h);
            $("#part5_body").html(result.t5b);
            $("#part6_body").html(result.t6);
            $("#part7_textarea").html(result.t7);
            $('#img').html(result.image);

            $('#areas_dem').val(result.area_dem);
            $('#routes').val(result.routes);

            $.ajax({
                url: "../../apis/apis_n/api.php",
                type: "post",
                data: { 'req': '6', 'param': '20' },
                dataType: "json",
                success: function(result) {
                    $("#rsm_view").html(result.rsm);
                    $("#asm_view").html(result.asm);
                    $("#fpr_view").html(result.fpr);
                }
            });

            var area = $('#areas_dem').val();
            $.ajax({
                url: "../../apis/apis_n/api.php",
                type: "post",
                data: { 'req': '3', 'param': '21', 'data': area },
                dataType: "json",
                success: function(result) {
                    $("#area_dem").html(result.a);
                }
            });

            var route = $('#routes').val();
            $.ajax({
                url: "../../apis/apis_n/api.php",
                type: "post",
                data: { 'req': '7', 'param': '22', 'data': route },
                dataType: "json",
                success: function(result) {
                    $("#route").html(result.r);
                }
            });

            window.print();
        }
    });


}(window.jQuery);