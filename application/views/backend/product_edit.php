<div class="layout-content">
    <div class="layout-content-body">
        <?php
        foreach ($product_data as $row) {
            ?>
            <div class="row">
                <div style="left: 50%; transform: translateX(-50%);" class="col-md-12">
                    <form class="form-horizontal" action="<?= base_url() ?>index.php/Admin/stock/update"
                          enctype="multipart/form-data" id="product_add" method="post">
                        <div class="card">
                            <div class="card-header">
                                <div class="panel-control" style="float: left;">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a data-toggle="tab"
                                               href="#product_details"><?php echo translate('product_details'); ?></a>
                                        </li>
                                        <li>
                                            <a data-toggle="tab"
                                               href="#business_details"><?php echo translate('business_details'); ?></a>
                                        </li>
                                        <li>
                                            <a data-toggle="tab"
                                               href="#customer_choice_options"><?php echo translate('customer_choice_options'); ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="msg"></div>
                                <div class="tab-base">
                                    <!--Tabs Content-->
                                    <div class="tab-content">
                                        <div id="product_details" class="tab-pane fade active in">
                                            <form id="add_sub_cat" class="form form-horizontal" style="margin-top: 30px"
                                                  method="POST">
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label" style="width: 20%;"
                                                           for="name">Name</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                          <span class="input-group-addon">
                                                <span class="icon icon-th-large"></span>
                                          </span>
                                                            <input type="hidden" name="product_id"
                                                                   value="<?= $row['product_id']; ?>">
                                                            <input class="form-control" type="text" name="title"
                                                                   value="<?php echo $row['product_name']; ?>" id="name"
                                                                   placeholder="Name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="username" class="col-sm-3 control-label"
                                                           style="width: 20%;">Category</label>
                                                    <div class="col-sm-9">
                                                        <select id="demo-select2-1" class="form-control" name="category" onchange="get_cat(this.value)">
                                                            <option
                                                                value="<?php echo $row['cat_id']; ?>"><?php echo $row['cat_name']; ?></option>
                                                            <?php
                                                            if (count($category) > 0) {
                                                                for ($i = 0; $i < count($category); $i++) {
                                                                    ?>
                                                                    <option value="<?php echo $category[$i]['id'] ?>"><?php echo $category[$i]['name'] ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="username" class="col-sm-3 control-label"
                                                           style="width: 20%;" for="form-control-17">Sub
                                                        Category</label>
                                                    <div class="col-sm-9">

                                                        <select id="demo-select2-2" class="form-control"
                                                                name="sub_cat_id" onchange="get_brand(this.value)">
                                                            <option
                                                                value="<?php echo $row['sub_cat_id']; ?>"><?php echo $row['sub_cat']; ?></option>
                                                            <?php
                                                            if (count($sub_category) > 0) {
                                                                for ($i = 0; $i < count($sub_category); $i++) {
                                                                    ?>
                                                                    <option
                                                                        value="<?php echo $sub_category[$i]['id'] ?>"><?php echo $sub_category[$i]['name'] ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>

                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="username" class="col-sm-3 control-label"
                                                           style="width: 20%;" for="form-control-17">Brand</label>
                                                    <div class="col-sm-9">
                                                        <select id="demo-select2-3" class="form-control"
                                                                name="brand_id" onchange="get_brand(this.value)">
                                                            <option
                                                                value="<?php echo $row['brand_id']; ?>"><?php echo $row['brand_name']; ?></option>

                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="username" class="col-sm-3 control-label"
                                                           style="width: 20%;" for="form-control-17">Tags</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="tag" data-role="tagsinput"
                                                               placeholder="<?php echo translate('tags'); ?>"
                                                               value="<?php echo $row['tags']; ?>" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="username" class="col-sm-3 control-label"
                                                           style="width: 20%;" for="form-control-17">Description</label>
                                                    <div class="col-sm-9">
                                            <textarea rows="9" class="summernotes" data-height="200" cols="100"
                                                      name="description">
                                                 <?php echo $row['description']; ?>
                                            </textarea>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div id="business_details" class="tab-pane fade">
                                            <div class="form-group btm_border">
                                                <h4 class="text-thin text-center"><?php echo translate('business_details'); ?></h4>
                                            </div>
                                            <div class="form-group btm_border">
                                                <label class="col-sm-4 control-label"
                                                       for="demo-hor-6"><?php echo translate('sale_price'); ?></label>
                                                <div class="col-sm-4">
                                                    <input type="number" name="sale_price"
                                                           id="demo-hor-6" min='0'
                                                           step='.01'
                                                           placeholder="<?php echo translate('sale_price'); ?>"
                                                           value="<?php echo $row['sale_price']; ?>"
                                                           class="form-control required">
                                                </div>
                                                <!--<span class="btn">pkr / </span>  -->
                                                <span class="btn unit_set"></span>
                                            </div>

                                            <div class="form-group btm_border">
                                                <label class="col-sm-4 control-label"
                                                       for="demo-hor-7"><?php echo translate('purchase_price'); ?></label>
                                                <div class="col-sm-4">
                                                    <input type="number" name="purchase_price"
                                                           id="demo-hor-7" min='0' step='.01'
                                                           placeholder="<?php echo translate('purchase_price'); ?>"
                                                           class="form-control required"
                                                           value="<?php echo $row['purchase_price']; ?>">
                                                </div>
                                                <!--<span class="btn">pkr/ </span> -->
                                                <span class="btn unit_set"></span>
                                            </div>

                                            <div class="form-group btm_border">
                                                <label class="col-sm-4 control-label"
                                                       for="demo-hor-8"><?php echo translate('shipping_cost'); ?></label>
                                                <div class="col-sm-4">
                                                    <input type="number" name="shipping_cost"
                                                           id="demo-hor-8" min='0' step='.01'
                                                           value="<?php echo $row['shipping_cost']; ?>"
                                                           placeholder="<?php echo translate('shipping_cost'); ?>"
                                                           class="form-control">
                                                </div>
                                                <!--<span class="btn">pkr / </span> -->
                                                <span class="btn unit_set"></span>
                                            </div>

                                            <div class="form-group btm_border">
                                                <label class="col-sm-4 control-label"
                                                       for="demo-hor-9"><?php echo translate('product_tax'); ?></label>
                                                <div class="col-sm-4">
                                                    <input type="number" name="tax" id="demo-hor-9" min='0' step='.01'
                                                           placeholder="<?php echo translate('product_tax'); ?>"
                                                           value="<?php echo $row['tax']; ?>" class="form-control">
                                                </div>
                                                <div class="col-sm-1">
                                                    <select class="demo-chosen-select" name="tax_type">
                                                        <option
                                                            value="percent" <?php if ($row['tax_type'] == 'percent') {
                                                            echo 'selected';
                                                        } ?> >%
                                                        </option>
                                                        <option value="amount" <?php if ($row['tax_type'] == 'amount') {
                                                            echo 'selected';
                                                        } ?> >$
                                                        </option>
                                                    </select>
                                                </div>
                                                <span class="btn unit_set"></span>
                                            </div>

                                            <div class="form-group btm_border">
                                                <label class="col-sm-4 control-label"
                                                       for="demo-hor-10"><?php echo translate('product_discount'); ?></label>
                                                <div class="col-sm-4">
                                                    <input type="number" name="discount"
                                                           id="demo-hor-10" min='0' step='.01'
                                                           placeholder="<?php echo translate('product_discount'); ?>"
                                                           class="form-control" value="<?php echo $row['discount']; ?>">
                                                </div>
                                                <div class="col-sm-1">
                                                    <select class="demo-chosen-select" name="discount_type">
                                                        <option
                                                            value="percent" <?php if ($row['discount_type'] == 'percent') {
                                                            echo 'selected';
                                                        } ?> >%
                                                        </option>
                                                        <option
                                                            value="amount" <?php if ($row['discount_type'] == 'amount') {
                                                            echo 'selected';
                                                        } ?> >$
                                                        </option>
                                                    </select>
                                                </div>
                                                <span class="btn unit_set"></span>
                                            </div>
                                        </div>
                                        <div id="customer_choice_options" class="tab-pane fade">
                                            <div class="form-group btm_border">
                                                <h4 class="text-thin text-center"><?php echo translate('customer_choice_options'); ?></h4>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group btm_border">
                                                        <label class="col-sm-2 control-label"
                                                               for="demo-hor-14"><?php echo translate('color'); ?></label>
                                                        <div class="col-sm-6" id="more_colors">
                                                            <?php $color = $row['color'];
                                                            $sep_color = explode(",", $color);
                                                            //print_r($sep_color);
                                                            for ($i = 0; $i < count($sep_color); $i++) {
                                                                ?>
                                                                <div class="col-md-12" style="margin-bottom:8px;">
                                                                    <div class="col-md-10">
                                                                        <div class="input-group demo2">
                                                                            <input type="text"
                                                                                   value="<?php echo $sep_color[$i]; ?>"
                                                                                   name="color[]" class="form-control"/>
                                                                            <span
                                                                                class="input-group-addon"><i></i></span>
                                                                        </div>
                                                                    </div>
                                      <span class="col-md-2">
                                          <span
                                              class="remove_it_v rmc btn btn-danger btn-icon icon-lg icon icon-close"></span>
                                      </span>
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div id="more_color_btn"
                                                                 class="btn btn-primary btn-labeled fa fa-plus">
                                                                <?php echo translate('add_more_colors'); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group btm_border">
                                                        <label class="col-sm-2 control-label"
                                                               for="demo-hor-15"><?php echo translate('size'); ?></label>
                                                        <div class="col-sm-6" id="more_size">
                                                            <?php $size = $row['size'];
                                                            $sep_size = explode(",", $size);
                                                            //print_r($sep_color);
                                                            for ($i = 0; $i < count($sep_size); $i++) {
                                                                ?>
                                                                <div class="col-md-12" style="margin-bottom:8px;">
                                                                    <div class="col-md-10">
                                                                        <div class="input-group demo2">
                                                                            <input type="text"
                                                                                   value="<?php echo $sep_size[$i]; ?>"
                                                                                   name="size[]" class="form-control"/>
                                                                            <span
                                                                                class="input-group-addon"><i></i></span>
                                                                        </div>
                                                                    </div>
                                      <span class="col-md-2">
                                          <span
                                              class="remove_it_v rmc btn btn-danger btn-icon icon-lg icon icon-close"></span>
                                      </span>
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div id="more_size_btn"
                                                                 class="btn btn-primary btn-labeled fa fa-plus">
                                                                <?php echo translate('add_more_sizes'); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div id="more_additional_options"></div>
                                            <!--<div class="form-group btm_border">
                                        <label class="col-sm-4 control-label" for="demo-hor-inputpass"></label>
                                        <div class="col-sm-6">
                                            <h4 class="pull-left">
                                                <i><?php echo translate('if_you_need_more_choice_options_for_customers_of_this_product_,please_click_here.'); ?></i>
                                            </h4>
                                            <div id="more_option_btn" class="btn btn-info btn-labeled fa fa-plus pull-right">
                                                <?php echo translate('add_customer_input_options'); ?></div>
                                        </div>
                                    </div>   -->
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer">
                                <div class="col-xs-6 col-md-3">
                                    <button class="btn btn-primary"
                                            style="margin-left: 250px;padding: 6px 25px;!important;"
                                            type="submit">Upload Product
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        <?php } ?>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $("#product_add").on('submit', (function (e) {
            e.preventDefault();
            $("#msg").html('<div class="loading"></div>');
            var fd = new FormData(this);
            $.ajax({
                url: '<?php echo site_url("Admin/stock/update") ?>',
                data: fd,
                type: "POST",
                contentType: false,
                processData: false,
                cache: false,
                success: function (res) {
                    var res = $.parseJSON(res);
                    if (res.msg_type == 'success') {
                        toastr.success(res.message);
                        //$('#add_sub_cat')[0].reset();
                        $("#title").focus();
                        $(".loading").hide();
                        var delay = 1000;
                        var URL = "<?php echo site_url('Admin/all_products')?>";
                        setTimeout(function () {
                            window.location = URL;
                        }, delay);
                    } else {
                        $("#msg").html(res);
                        toastr.error(res.message);
                    }
                },
                error: function (xhr) {
                    $("#msg").html("Error: - " + xhr.status + " " + xhr.statusText);
                }
            });
        }));
    });

    function get_cat(id) {
        $('#sub').hide('slow');
        var fd = new FormData(this);
        $.ajax({
            url: '<?php echo site_url("Admin/sub_by_cat") ?>/' + id,
            data: fd,
            type: "POST",
            contentType: false,
            processData: false,
            cache: false,
            success: function (res) {
                $("#demo-select2-2").html(res);
            },
            error: function (xhr) {
                $("#msg").html("Error: - " + xhr.status + " " + xhr.statusText);
            }
        });
    }

    function get_brand(id) {
        $('#sub').hide('slow');
        var fd = new FormData(this);
        $.ajax({
            url: '<?php echo site_url("Admin/brand_by_sub") ?>/' + id,
            data: fd,
            type: "POST",
            contentType: false,
            processData: false,
            cache: false,
            success: function (res) {
                $("#demo-select2-3").html(res);
            },
            error: function (xhr) {
                $("#msg").html("Error: - " + xhr.status + " " + xhr.statusText);
            }
        });
    }
</script>
<script>
    function ajax_load(url, id, type) {
        var list = $('#' + id);
        $.ajax({
            url: url, // form action url
            cache: false,
            dataType: "html",
            beforeSend: function () {
                //list.fadeOut();
                if (type !== 'other') {
                    list.html(loading); // change submit button text
                }
            },
            success: function (data) {
                if (data !== '') {
                    list.html('');
                    list.html(data).fadeIn(); // fade in response data
                }
                if (type == 'first') {
                    $('#demo-table').bootstrapTable();
                    set_switchery();
                    $('#demo-table img').each(function () {
                        if ($(this).attr('src') !== '') {
                            if ($(this).data('im') !== 'fb') {
                                $(this).attr('src', $(this).attr('src') + '?random=' + new Date().getTime());
                            }
                        }
                    });
                } else if (type == 'form') {
                    //reloadStylesheets();
                    $('#demo-tp-textinput').timepicker({
                        minuteStep: 5,
                        showInputs: false,
                        disableFocus: true
                    });

                } else if (type == 'delete') {
                    ajax_load(base_url + 'index.php/' + user_type + '/' + module + '/' + list_cont_func, 'list', 'first');
                    other_delete();
                } else if (type == 'other') {
                    other();
                } else {

                }
            },
            error: function (e) {
                console.log(e)
            }
        });
    }


    window.preview = function (input) {
        if (input.files && input.files[0]) {
            $("#previewImg").html('');
            $(input.files).each(function () {
                var reader = new FileReader();
                reader.readAsDataURL(this);
                reader.onload = function (e) {
                    $("#previewImg").append("<div style='float:left;border:4px solid #303641;padding:5px;margin:5px;'><img height='80' src='" + e.target.result + "'></div>");
                }
            });
        }
    }

    function other_forms() {
    }

    function set_summer() {
        $('.summernotes').each(function () {
            var now = $(this);
            var h = now.data('height');
            var n = now.data('name');
            if (now.closest('div').find('.val').length == 0) {
                now.closest('div').append('<input type="hidden" class="val" name="' + n + '">');
            }
            now.summernote({
                height: h,
                onChange: function () {
                    now.closest('div').find('.val').val(now.code());
                }
            });
            now.closest('div').find('.val').val(now.code());
        });
    }

    function option_count(type) {
        var count = $('#option_count').val();
        if (type == 'add') {
            count++;
        }
        if (type == 'reduce') {
            count--;
        }
        $('#option_count').val(count);
    }

    function set_select() {
        $('.demo-chosen-select').chosen();
        $('.demo-cs-multiselect').chosen({width: '100%'});
    }

    $(document).ready(function () {
        set_select();
        set_summer();
        createColorpickers();
    });

    function other() {
        set_select();
        $('#sub').show('slow');
    }

    function get_brnd(id) {
        $('#brn').hide('slow');
        ajax_load(base_url + 'index.php/admin/product/brand_by_sub/' + id, 'brand', 'other');
        $('#brn').show('slow');
    }
    function get_sub_res(id) {
    }

    $(".unit").on('keyup', function () {
        $(".unit_set").html($(".unit").val());
    });

    function createColorpickers() {

        $('.demo2').colorpicker({
            format: 'rgba'
        });

    }

    $("#more_btn").click(function () {
        $("#more_additional_fields").append(''
            + '<div class="form-group">'
            + '    <div class="col-sm-4">'
            + '        <input type="text" name="ad_field_names[]" class="form-control required"  placeholder="<?php echo translate('field_name'); ?>">'
            + '    </div>'
            + '    <div class="col-sm-5">'
            + '        <textarea rows="9"  class="summernotes" data-height="100" data-name="ad_field_values[]"></textarea>'
            + '    </div>'
            + '    <div class="col-sm-2">'
            + '        <span class="remove_it_v rms btn btn-danger btn-icon btn-circle icon-lg fa fa-times" onclick="delete_row(this)"></span>'
            + '    </div>'
            + '</div>'
        );
        set_summer();
    });

    function next_tab() {
        $('.nav-tabs li.active').next().find('a').click();
    }
    function previous_tab() {
        $('.nav-tabs li.active').prev().find('a').click();
    }

    $("#more_option_btn").click(function () {
        option_count('add');
        var co = $('#option_count').val();
        $("#more_additional_options").append(''
            + '<div class="form-group" data-no="' + co + '">'
            + '    <div class="col-sm-4">'
            + '        <input type="text" name="op_title[]" class="form-control required"  placeholder="<?php echo translate('customer_input_title'); ?>">'
            + '    </div>'
            + '    <div class="col-sm-5">'
            + '        <select class="demo-chosen-select op_type required" name="op_type[]" >'
            + '            <option value="">(none)</option>'
            + '            <option value="text">Text Input</option>'
            + '            <option value="single_select">Dropdown Single Select</option>'
            + '            <option value="multi_select">Dropdown Multi Select</option>'
            + '            <option value="radio">Radio</option>'
            + '        </select>'
            + '        <div class="col-sm-12 options">'
            + '          <input type="hidden" name="op_set' + co + '[]" value="none" >'
            + '        </div>'
            + '    </div>'
            + '    <input type="hidden" name="op_no[]" value="' + co + '" >'
            + '    <div class="col-sm-2">'
            + '        <span class="remove_it_o rmo btn btn-danger btn-icon btn-circle icon-lg icon icon-close" onclick="delete_row(this)"></span>'
            + '    </div>'
            + '</div>'
        );
        set_select();
    });

    $("#more_additional_options").on('change', '.op_type', function () {
        var co = $(this).closest('.form-group').data('no');
        if ($(this).val() !== 'text' && $(this).val() !== '') {
            $(this).closest('div').find(".options").html(''
                + '    <div class="col-sm-12">'
                + '        <div class="col-sm-12 options margin-bottom-10"></div><br>'
                + '        <div class="btn btn-mint btn-labeled fa fa-plus pull-right add_op">'
                + '        <?php echo translate('add_options_for_choice');?></div>'
                + '    </div>'
            );
        } else if ($(this).val() == 'text' || $(this).val() == '') {
            $(this).closest('div').find(".options").html(''
                + '    <input type="hidden" name="op_set' + co + '[]" value="none" >'
            );
        }
    });

    $("#more_additional_options").on('click', '.add_op', function () {
        var co = $(this).closest('.form-group').data('no');
        $(this).closest('.col-sm-12').find(".options").append(''
            + '    <div>'
            + '        <div class="col-sm-10">'
            + '          <input type="text" name="op_set' + co + '[]" class="form-control required"  placeholder="<?php echo translate('option_name'); ?>">'
            + '        </div>'
            + '        <div class="col-sm-2">'
            + '          <span class="remove_it_n rmon btn btn-danger btn-icon btn-circle icon-sm fa fa-times" onclick="delete_row(this)"></span>'
            + '        </div>'
            + '    </div>'
        );
    });

    $('body').on('click', '.rmo', function () {
        $(this).parent().parent().remove();
    });

    $('body').on('click', '.rmon', function () {
        var co = $(this).closest('.form-group').data('no');
        $(this).parent().parent().remove();
        if ($(this).parent().parent().parent().html() == '') {
            $(this).parent().parent().parent().html(''
                + '   <input type="hidden" name="op_set' + co + '[]" value="none" >'
            );
        }
    });

    $('body').on('click', '.rms', function () {
        $(this).parent().parent().remove();
    });

    $("#more_color_btn").click(function () {
        $("#more_colors").append(''
            + '      <div class="col-md-12" style="margin-bottom:8px;">'
            + '          <div class="col-md-10">'
            + '              <div class="input-group demo2">'
            + '		     	   <input type="text" value="#ccc" name="color[]" class="form-control" />'
            + '		     	   <span class="input-group-addon"><i></i></span>'
            + '		        </div>'
            + '          </div>'
            + '          <span class="col-md-2">'
            + '              <span class="remove_it_v rmc btn btn-danger btn-icon icon-lg icon icon-close" ></span>'
            + '          </span>'
            + '      </div>'
        );
        createColorpickers();
    });


    $("#more_size_btn").click(function () {
        $("#more_size").append(''
            + '      <div class="col-md-12" style="margin-bottom:8px;">'
            + '          <div class="col-md-10">'
            + '              <div class="input-group demo2">'
            + '		     	   <input type="text" value="S" name="size[]" class="form-control" />'
            + '		     	   <span class="input-group-addon"><i></i></span>'
            + '		        </div>'
            + '          </div>'
            + '          <span class="col-md-2">'
            + '              <span class="remove_it_v rmc btn btn-danger btn-icon icon-lg icon icon-close" ></span>'
            + '          </span>'
            + '      </div>'
        );
        createColorpickers();
    });


    $('body').on('click', '.rmc', function () {
        $(this).parent().parent().remove();
    });

    $('.delete-div-wrap .close').on('click', function () {
        var pid = $(this).closest('.delete-div-wrap').find('img').data('id');
        var here = $(this);
        msg = 'Really want to delete this Image?';

        $.ajax({
            url: base_url + 'index.php/Admin/dlt_img/' + pid,
            cache: false,
            success: function (data) {
                toastr.success("Deleted Successfully");
                here.closest('.delete-div-wrap').remove();
            }
        });


    });


    $(document).ready(function () {
        $("form").submit(function (e) {
            event.preventDefault();
        });
    });
</script>