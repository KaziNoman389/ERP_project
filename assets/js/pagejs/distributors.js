! function($) {

    //*****************************************************************
    //*********************Fetch area Table**************************
    //*****************************************************************


    //Fetch Distributor table data 
    $.ajax({
        url: "../../apis/apis_n/api.php",
        type: "post",
        data: { 'req': '5', 'param': '10', 'get': 'body' },
        dataType: "json",
        success: function(result) {
            $("#distribution_table").html(result);
        }
    });


    //********************************************************************
    //*********************View Distributors data**************************
    //********************************************************************


    //Fetch attributes on click view button
    $("#distribution_table").on('click', '#btn_view', function(e) {
        var ds_data = $(this).attr('data-id');
        $("#view_id").val(ds_data);
        $("#modal_view").modal('show');
    });

    //Get id's of the attributes
    $("#modal_view").on('show.bs.modal', function(event) {
        // Get View ID
        var vw_id = $("#view_id").val();

        $("#print_div").html('<a class="btn btn-sm btn-outline-secondary" data-bs-toggle="tooltip" data-bs-placement="bottom" title = "Print" target = "_blank" href="print?view_id=' + vw_id + '" ><i class = "align-self-center fa fa-print icon-xs"></i></a >');

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

            }
        });
    });


    //********************************************************************
    //*********************Add Distributors data**************************
    //********************************************************************

    //Error validation message while editing and uploading distributor(proprietor) image
    $("#add_o_image").change(function(event) {
        if (event.target.files[0].size > 512000) {
            $("#error_message_add").text("Image File too large, must be less than 500 KB.");
        } else {
            $("#error_message_add").text("");
        }
    });

    $("#add_agree_image").change(function(event) {
        if (event.target.files[0].size > 512000) {
            $("#error_message_add1").text("Image File too large, must be less than 500 KB.");
        } else {
            $("#error_message_add1").text("");
        }
    });

    $("#add_approval_image").change(function(event) {
        if (event.target.files[0].size > 512000) {
            $("#error_message_add2").text("Image File too large, must be less than 500 KB.");
        } else {
            $("#error_message_add2").text("");
        }
    });

    $("#add_tl_image").change(function(event) {
        if (event.target.files[0].size > 512000) {
            $("#error_message_add3").text("Image File too large, must be less than 500 KB.");
        } else {
            $("#error_message_add3").text("");
        }
    });
    ////// --------- end error validation --------- ///////


    // region, depot ,area & territory dropdown lists --> for distributor
    $("#create_new").on('show.bs.modal', function(e) {
        // Get org_id from session
        var org_id = $("#org_id_add").data('value');

        //Dynamic dropdown RSM / ASM / FPR employee list with respect to org_id
        $.ajax({
            url: "../../apis/apis_n/api.php",
            type: "POST",
            dataType: "json",
            data: { 'req': '6', 'param': '15', 'data': org_id },
            success: function(response) {
                $("#add_rsm_list").html(response);
                $("#add_asm_list").html(response);
                $("#add_fpr_list").html(response);
            }
        });

        // multiselect areas from select2
        $.ajax({
            url: "../../apis/apis_n/api.php",
            type: "post",
            data: { 'req': '3', 'param': '16' },
            dataType: "json",
            success: function(result) {
                $("#add_area_dem").html(result);
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

        //Dynamic dropdown depot / area / territory distributors list with respect to region list
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

                                        // Dynamic dependable dropdown territory list with respect to paticular area
                                        $("#area_list").on("change", function() {
                                            var area_id = $(this).val();
                                            $.ajax({
                                                url: "../../apis/apis_n/api.php",
                                                type: "POST",
                                                dataType: "json",
                                                data: { 'req': '4', 'param': '12', 'data': area_id },
                                                success: function(response) {
                                                    $("#add_territory_list").html(response);
                                                }
                                            });
                                        });

                                    }
                                });
                            });
                        }
                    });
                });
            }
        });
    });

    // //add form & image
    $("#add_distributors_form").on('submit', (function(e) {
        e.preventDefault();
        var form_data = new FormData(this);

        $.ajax({
            url: "../../controller/process_distributors_data.php", //php page URL where we post this data to save in database
            type: "post",
            data: form_data,
            dataType: "json",
            processData: false,
            contentType: false,
            cache: false,
            success: function(result_1) {
                $.ajax({
                    url: "../../apis/apis_n/api.php",
                    type: "post",
                    data: { 'req': '5', 'param': '10', 'get': 'body' },
                    dataType: "json",
                    success: function(result) {
                            if (result_1 == true) {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Distributor has been saved',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                                $("#distribution_table").html(result);
                                $("#add_distributors_form")[0].reset();
                                $("#create_new").modal('hide');
                            } else {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'error',
                                    title: 'Something is wrong. Please try again !',
                                    showConfirmButton: false,
                                    timer: 7000
                                })
                                $("#distribution_table").html(result);
                            }
                        }
                        //Image File too large. <br> Image file size must be less than 500 KB.
                });
            }
        });
    }));



    //*****************************************************************
    //**********************Search From Table**************************
    //*****************************************************************


    // Search Distributor Table
    $("#search_input").on("keyup", function() {
        var search_input = $(this).val().toLowerCase();
        var search_territory_category_value = $('#search_distributor').val();
        var search_territory_category = parseInt(search_territory_category_value) + 1;

        $("#distribution_table tr td:nth-child(" + search_territory_category + ")").each(function() {
            $(this).parent().toggle($(this).text().toLowerCase().indexOf(search_input) > -1)
        });
    });



    //*****************************************************************
    //********************Edit Distributor Data************************
    //*****************************************************************

    //Start --> Error validation message while editing and uploading distributor(proprietor) image
    $("#edit_o_image").change(function(event) {
        if (event.target.files[0].size > 512000) {
            $("#error_message_edit").text("Image File too large, must be less than 500 KB.");
        } else {
            $("#error_message_edit").text("");
        }
    });

    $("#edit_agree_image").change(function(event) {
        if (event.target.files[0].size > 512000) {
            $("#error_message_edit1").text("Image File too large, must be less than 500 KB.");
        } else {
            $("#error_message_edit1").text("");
        }
    });

    $("#edit_approval_image").change(function(event) {
        if (event.target.files[0].size > 512000) {
            $("#error_message_edit2").text("Image File too large, must be less than 500 KB.");
        } else {
            $("#error_message_edit2").text("");
        }
    });

    $("#edit_tl_image").change(function(event) {
        if (event.target.files[0].size > 512000) {
            $("#error_message_edit3").text("Image File too large, must be less than 500 KB.");
        } else {
            $("#error_message_edit3").text("");
        }
    });
    //------------------------------End --------------------------------

    //Fetch id's attributes on click edit buttons
    $("#distribution_table").on('click', '#btn_edit', function(e) {
        var ds_data = $(this).attr('data-id');
        $("#edit_id").val(ds_data);

        var territory_id = $(this).attr('t-id');
        $("#territory_id").val(territory_id);

        var org_id = $(this).attr('match-org-id');
        $("#org_id_edit").val(org_id);

        $("#modal_edit").modal('show');
    });

    //Get id's of the attributes
    $("#modal_edit").on('show.bs.modal', function(event) {
        // Get Distributor ID
        var ds_id = $("#edit_id").val();

        // // Get Territory ID
        var t_id = $("#territory_id").val();

        // Get org_id (match-org-id)
        var org_id = $("#org_id_edit").val();

        // Dynamic dropdown RSM employee list with respect to org_id
        $.ajax({
            url: "../../apis/apis_n/api.php",
            type: "POST",
            dataType: "json",
            data: { 'req': '6', 'param': '14', 'data': org_id },
            success: function(result) {
                $("#edit_rsm_list").html(result);
                $("#edit_asm_list").html(result);
                $("#edit_fpr_list").html(result);
            }
        });

        // multiselect areas from select2
        $.ajax({
            url: "../../apis/apis_n/api.php",
            type: "post",
            data: { 'req': '3', 'param': '18', 'data': ds_id },
            dataType: "json",
            success: function(result) {
                $("#edit_area_dem").html(result);
            }
        });

        // multiselect routes from select2
        $.ajax({
            url: "../../apis/apis_n/api.php",
            type: "post",
            data: { 'req': '5', 'param': '19', 'data': ds_id },
            dataType: "json",
            success: function(result) {
                $("#edit_routes").html(result);
            }
        });

        // Distributors Details Fetch From Database
        $.ajax({
            url: "../../apis/apis_n/api.php",
            type: "post",
            data: { 'req': '5', 'param': '11', 'data': ds_id },
            dataType: "json",
            success: function(result) {

                $("#edit_code").val(result['code']);
                $("#edit_start_date").val(result['date']);

                $("#edit_region_list").val(result['region_name']);
                $("#edit_depot_list").val(result['depot_name']);
                $("#edit_area_list").val(result['area_name']);
                $("#edit_territory_list").val(result['territory_name']);

                $("#edit_distri_type").val(result['distri_type']);
                $("#edit_name").val(result['name']);
                $("#edit_address").val(result['address']);
                $("#edit_o_pre_address").val(result['o_pre_address']);
                $("#edit_o_name").val(result['o_name']);
                $("#edit_o_address").val(result['o_address']);
                $("#edit_o_nid").val(result['o_nid']);
                $("#edit_o_mobile").val(result['o_mobile']);

                $('#preview_img').attr('src', "../../assets/uploads/distributors/distributor_image/" + result['o_image']);
                $('#preview_edit_img1').attr('src', "../../assets/uploads/distributors/agreement_image/" + result['agree_image']);
                $('#preview_edit_img2').attr('src', "../../assets/uploads/distributors/approval_image/" + result['approval_image']);
                $('#preview_edit_img3').attr('src', "../../assets/uploads/distributors/trade_license_image/" + result['tl_image']);

                //Error validation message while editing and uploading distributor(proprietor) image
                $("#edit_o_image").change(function(event) {
                    if (event.target.files[0].size > 512000) {
                        $("#error_message").text("Image File too large, must be less than 500 KB.");
                    } else {
                        $("#error_message").text("");
                    }
                });

                $("#edit_cp_mobile").val(result['cp_mobile']);
                $("#edit_status").val(result['is_active']);
                $("#edit_is_approve").val(result['is_approve']);
                $("#edit_tl_number").val(result['tl_number']);
                $("#edit_tl_lastDate").val(result['tl_lastDate']);
                $("#edit_b_name_b_branch").val(result['b_name_b_branch']);
                $("#edit_b_account").val(result['b_account']);
                $("#edit_exist_bus_name1").val(result['exist_bus_name1']);
                $("#edit_exist_bus_name2").val(result['exist_bus_name2']);
                $("#edit_exist_start1").val(result['exist_start1']);
                $("#edit_exist_start2").val(result['exist_start2']);
                $("#edit_exist_van_puller").val(result['exist_van_puller']);
                $("#edit_exist_ice_van").val(result['exist_ice_van']);
                $("#edit_exist_gd_size").val(result['exist_gd_size']);
                $("#edit_rel_gge").val(result['rel_gge']);
                $("#edit_k_market").val(result['k_market']);
                $("#edit_ice_outlets").val(result['ice_outlets']);
                $("#edit_exist_avg_m_size").val(result['exist_avg_m_size']);

                $("#edit_ig_cont").val(result['ig_cont']);
                $("#edit_po_cont").val(result['po_cont']);
                $("#edit_lo_cont").val(result['lo_cont']);
                $("#edit_ka_cont").val(result['ka_cont']);
                $("#edit_bl_cont").val(result['bl_cont']);
                $("#edit_kw_cont").val(result['kw_cont']);
                $("#edit_others_cont").val(result['others_cont']);

                $("#edit_ig_comp").val(result['ig_comp']);
                $("#edit_po_comp").val(result['po_comp']);
                $("#edit_lo_comp").val(result['lo_comp']);
                $("#edit_ka_comp").val(result['ka_comp']);
                $("#edit_bl_comp").val(result['bl_comp']);
                $("#edit_kw_comp").val(result['kw_comp']);
                $("#edit_others_comp").val(result['others_comp']);


                $("#edit_m1_sales").val(result['m1_sales']);
                $("#edit_m2_sales").val(result['m2_sales']);
                $("#edit_m3_sales").val(result['m3_sales']);
                $("#edit_m4_sales").val(result['m4_sales']);
                $("#edit_m5_sales").val(result['m5_sales']);
                $("#edit_m6_sales").val(result['m6_sales']);
                $("#edit_m7_sales").val(result['m7_sales']);


                $("#edit_m1_inj").val(result['m1_inj']);
                $("#edit_m2_inj").val(result['m2_inj']);
                $("#edit_m3_inj").val(result['m3_inj']);
                $("#edit_m4_inj").val(result['m4_inj']);
                $("#edit_m5_inj").val(result['m5_inj']);
                $("#edit_m6_inj").val(result['m6_inj']);
                $("#edit_m7_inj").val(result['m7_inj']);

                $("#edit_total_inv").val(result['total_inv']);
                $("#edit_num_SDF").val(result['num_SDF']);
                $("#edit_val_SDF").val(result['val_SDF']);
                $("#edit_num_vans").val(result['num_vans']);
                $("#edit_val_vans").val(result['val_vans']);
                $("#edit_init_lifting").val(result['init_lifting']);
                $("#edit_gd_adv").val(result['gd_adv']);
                $("#edit_m_credit").val(result['m_credit']);
                $("#edit_run_capital").val(result['run_capital']);
                $("#edit_transac_type").val(result['transac_type']);
                $("#edit_rsm_recom").val(result['rsm_recom']);
                $("#edit_gm_recom").val(result['gm_recom']);

                $("#edit_rsm_list").val(result['rsm']);
                $("#edit_asm_list").val(result['asm']);
                $("#edit_fpr_list").val(result['fpr']);

                $("#edit_point_name").val(result['point_name']);
                $("#edit_appr_start_date").val(result['appr_start_date']);
                $("#edit_appr_close_date").val(result['appr_close_date']);

                $('#edit_ref').val(result['ref']);

                // GET region id from distributor table(using sub queries)
                var r_id = result['region_id'];

                // GET depot id from distributor table(using sub queries)
                var d_id = result['depot_id'];

                // GET depot id from distributor table(using sub queries)
                var a_id = result['area_id'];

                //using region ID to find region list --> to show region list in edit distributor modal
                $.ajax({
                    url: "../../apis/apis_n/api.php",
                    type: "post",
                    data: { 'req': '2', 'param': '3', 'match': r_id, 'filter': 'org_id = ' + org_id },
                    dataType: "json",
                    success: function(result_1) {
                        $("#edit_region_list").html(result_1);

                        //using region ID to find depot list --> to show depot list in edit distributor modal
                        $.ajax({
                            url: "../../apis/apis_n/api.php",
                            type: "POST",
                            dataType: "json",
                            data: { 'req': '1', 'param': '3', 'match': d_id, 'filter': 'region = ' + r_id },
                            success: function(result_2) {
                                $("#edit_depot_list").html(result_2);

                                //using depot ID to find area list --> to show area list in edit distributor modal
                                $.ajax({
                                    url: "../../apis/apis_n/api.php",
                                    type: "POST",
                                    dataType: "json",
                                    data: { 'req': '3', 'param': '3', 'match': a_id, 'filter': 'depot = ' + d_id },
                                    success: function(result_3) {
                                        $("#edit_area_list").html(result_3);

                                        //using depot ID to find territory list --> to show territory list in edit distributor modal
                                        $.ajax({
                                            url: "../../apis/apis_n/api.php",
                                            type: "POST",
                                            dataType: "json",
                                            data: { 'req': '4', 'param': '3', 'match': t_id, 'filter': 'area = ' + a_id },
                                            success: function(result_4) {
                                                $("#edit_territory_list").html(result_4);
                                            }
                                        });
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
                                            success: function(result) {
                                                $("#edit_area_list").html(result);

                                                // Dynamic dependable dropdown territory list with respect to paticular depot
                                                $("#edit_area_list").on("change", function() {

                                                    var area_id = $(this).val();
                                                    $.ajax({
                                                        url: "../../apis/apis_n/api.php",
                                                        type: "POST",
                                                        dataType: "json",
                                                        data: { 'req': '4', 'param': '3', 'filter': 'area = ' + area_id },
                                                        success: function(result) {
                                                            $("#edit_territory_list").html(result);
                                                        }
                                                    });
                                                });
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

    // edit distributor form submit on save --> updating the database & fetch results on table
    $('#edit_distributors_form').submit(function(event) {
        event.preventDefault();

        var form_data = new FormData(this);

        $.ajax({
            url: "../../controller/process_distributors_data.php", //php page URL where we post this data to save in database
            type: "POST",
            data: form_data,
            dataType: "json",
            processData: false,
            contentType: false,
            cache: false,
            success: function(result_1) {
                $.ajax({
                    url: "../../apis/apis_n/api.php",
                    type: "post",
                    data: { 'req': '5', 'param': '10', 'get': 'body' },
                    dataType: "json",
                    success: function(result) {
                        if (result_1 == true) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Distributor has been edited',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $("#distribution_table").html(result);
                            $("#edit_distributors_form")[0].reset();
                            $('#modal_edit').modal('hide');
                        } else {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: 'Image File too large. <br> Image file size must be less than 500 KB.',
                                // Something Went Wrong. Please Try Again
                                showConfirmButton: false,
                                timer: 7000
                            })
                        }
                    }
                });
            }
        });
    });


}(window.jQuery);