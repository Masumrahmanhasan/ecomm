
<div class="layout-content">
    <div class="layout-content-body">

        <div class="row gutter-xs">
            <div class="col-xs-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Manage Categories</strong>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="col-md-12" style="border-bottom: 1px solid #ebebeb;padding: 5px;">            
                                <a class="btn btn-primary btn-labeled fa fa-plus-circle add_pro_btn pull-right"
                                   href="<?= base_url(); ?>index.php/Admin/add_products">
                                    Create Product
                                </a>
                                <button class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn"
                                        style="display:none;"
                                        onclick="ajax_set_list();  proceed('to_add');"><?php echo translate('back_to_product_list'); ?>
                                </button>
                            </div>
                            <!-- LIST -->
                            <div class="tab-pane fade active in" id="list"
                                 style="border:1px solid #ebebeb; border-radius:4px;">

                            </div>
                        </div>
                        <table id="demo-datatables-fixedheader-2"
                               class="table table-bordered table-striped table-nowrap dataTable" cellspacing="0"
                               width="100%">
                            <thead>
                            <tr>
                                <th>ID#</th>
                                <th>Name</th>
                                <th>Current Quantity</th>
                                <th>Today's Deal</th>
                                <th>Publish</th>
                                <th>Featured</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php for ($i = 0; $i < count($product); $i++) { ?>
                                <tr>
                                    <td><?php echo $product[$i]['product_id'] ?></td>
                                    <td><?= $product[$i]['product_name'] ?></td>
                                    <td><?php echo $product[$i]['current_stock'] ?></td>
                                    <td>        <?php
                                        if ($product[$i]['deal'] == 'ok') { ?>
                                            <input id="deal_<?= $product[$i]['product_id']; ?>" class="sw3"
                                                   type="checkbox" data-id="<?= $product[$i]['product_id']; ?>"
                                                   checked/>
                                        <?php } else { ?>
                                            <input id="deal_<?= $product[$i]['product_id']; ?>" class="sw3"
                                                   type="checkbox"
                                                   data-id="<?= $product[$i]['product_id']; ?>"/>
                                        <?php }
                                        ?>
                                    </td>
                                    <td><?php if ($product[$i]['status'] == 'ok') { ?>
                                            <input id="pub_<?= $product[$i]['product_id'] ?>" class="sw1"
                                                   type="checkbox" data-id="<?= $product[$i]['product_id']; ?>"
                                                   checked/>
                                        <?php } else { ?>
                                            <input id="pub_<?= $product[$i]['product_id']; ?>" class="sw1"
                                                   type="checkbox" data-id="<?= $product[$i]['product_id']; ?>"/>
                                        <?php } ?></td>
                                    <td><?php if ($product[$i]['featured'] == 'ok') { ?>
                                            <input id="fet_<?= $product[$i]['product_id'] ?>" class="sw2"
                                                   type="checkbox" data-id="<?= $product[$i]['product_id']; ?>"
                                                   checked/>
                                        <?php } else { ?>
                                            <input id="fet_<?= $product[$i]['product_id']; ?>" class="sw2"
                                                   type="checkbox" data-id="<?= $product[$i]['product_id']; ?>"/>
                                        <?php } ?></td>
                                    <td align="center">

                                        <a href="#" onclick="showAjaxModal('<?php echo base_url();?>Admin/take_payments/<?=$product[$i]['product_id']?>')" class="btn btn-info btn-sm btn-labeled fa fa-location-arrow">
                                            <i class="entypo-bookmarks"></i>
                                           Add Stock
                                        </a>


                                        <a class="btn btn-info btn-sm btn-labeled fa fa-location-arrow" href="<?=base_url()?>Admin/stock/view/<?= $product[$i]['product_id'] ?>">view
                                        </a>
                                        <a href="#" onclick="showAjaxModal('<?php echo base_url();?>Admin/stock/add_discount/<?=$product[$i]['product_id']?>')" class="btn btn-danger btn-sm btn-labeled fa fa-location-arrow">
                                            <i class="entypo-bookmarks"></i>
                                            Discount
                                        </a>



                                        <a href="<?php echo base_url();?>Admin/stock/edit/<?=$product[$i]['product_id']?>"
                                           class="btn btn-success btn-sm btn-labeled fa fa-location-arrow">
                                            <i class="entypo-bookmarks"></i>
                                            Edit
                                        </a>
                                        <a onclick="delete_confirm('<?= $product[$i]['product_id']; ?>','really_want_to_delete_this?')"
                                           class="btn btn-danger btn-sm btn-labeled fa fa-trash" data-toggle="tooltip"
                                           data-original-title="Delete" data-container="body">
                                            delete
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="modal_ajax" tabindex="-1" role="dialog" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                        <span class="sr-only">Close</span>
                    </button>
                </div>
                    <div class="modal-body">


                    </div>
                <div class="modal-footer">


                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript"
        src="<?= base_url() ?>backend_assets/<?= $theme ?>/sweetalert/sweetalert2.all.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>backend_assets/<?= $theme ?>/sweetalert/core.js"></script>
<script>
    function validate(a) {
        var id = a.value;
        swal({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            animation: false,
            customClass: 'animated pulse',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: true,
            reverseButtons: true
        }).then(function (result) {
            if (result.value) {

                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url()?>Admin/del_category/',
                    data: {'id': id}
                }).then(function (res) {
                    $(a).closest('tr').remove();
                    swal('Deleted!', 'Category has been Deleted.', 'success');
                }, function (err) {
                    swal('Error', err.statusText, 'error');
                });


            } else if (result.dismiss === 'cancel') {
                swal(
                    'Cancelled',
                    'Your imaginary file is safe :)',
                    'error'
                )
            }
        })
    }


    function get_all_products() {

        $.ajax({
            url: "<?php echo base_url()?>Admin/list_data", // form action url
            type: 'POST', // form submit method get/post
            dataType: 'json', // request type html/json/xml
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response);
            },
            error: function (e) {
                console.log(e)
            }
        });
    }

    function stock() {

        $.ajax({
            url: "<?php echo base_url()?>Admin/get_stock", // form action url
            type: 'POST', // form submit method get/post
            dataType: 'json', // request type html/json/xml
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response);
            },
            error: function (e) {
                console.log(e)
            }
        });
    }

    $(".sw1").each(function () {
        document.getElementById('pub_' + $(this).data('id')), {
            color: 'rgb(100, 189, 99)',
            secondaryColor: '#cc2424',
            jackSecondaryColor: '#c8ff77'
        };
        var changeCheckbox = document.querySelector('#pub_' + $(this).data('id'));
        changeCheckbox.onchange = function () {
            //alert($(this).data('id'));
            ajax_load(base_url + 'index.php/Admin/statuses/product_publish_set/' + $(this).data('id') + '/' + changeCheckbox.checked, 'others');
            if (changeCheckbox.checked == true) {
                toastr.success('Product Published');
            } else {
                toastr.warning('Product Unpublished')
            }
            //alert(changeCheckbox.checked);
        };
    });

    $(".sw2").each(function () {
        document.getElementById('fet_' + $(this).data('id')), {
            color: 'rgb(100, 189, 99)',
            secondaryColor: '#cc2424',
            jackSecondaryColor: '#c8ff77'
        };
        var changeCheckbox = document.querySelector('#fet_' + $(this).data('id'));
        changeCheckbox.onchange = function () {
            //alert($(this).data('id'));
            ajax_load(base_url + 'index.php/Admin/statuses/product_featured_set/' + $(this).data('id') + '/' + changeCheckbox.checked, 'others');
            if (changeCheckbox.checked == true) {
                toastr.success('Product Featured');
            } else {
                toastr.warning('Product Unfeatured');
            }
            //alert(changeCheckbox.checked);
        };
    });

    $(".sw3").each(function () {
        document.getElementById('deal_' + $(this).data('id')), {
            color: 'rgb(100, 189, 99)',
            secondaryColor: '#cc2424',
            jackSecondaryColor: '#c8ff77'
        };
        var changeCheckbox = document.querySelector('#deal_' + $(this).data('id'));
        changeCheckbox.onchange = function () {
            //alert($(this).data('id'));
            ajax_load(base_url + 'index.php/Admin/statuses/product_deal_set/' + $(this).data('id') + '/' + changeCheckbox.checked, 'others');
            if (changeCheckbox.checked == true) {
                toastr.success('Product in Todays Deal');
            } else {
                toastr.warning('Product removed from Todays Deal');
            }
            //alert(changeCheckbox.checked);
        };
    });


    function ajax_load(url, type) {
        //var list = $('#'+id);
        $.ajax({
            url: url, // form action url
            cache: false,
            dataType: "html",
            beforeSend: function () {
                //list.fadeOut();
                if (type !== 'other') {
                    //list.html(loading);
                    //console.log("loader");//change submit button text
                }
            },
            success: function (data) {

                if (type == 'delete') {
                    ajax_load(base_url + 'index.php/Admin/statuses/' + list_cont_func, 'list', 'first');

                } else if (type == 'other') {

                } else {

                }
            },
            error: function (e) {
                console.log(e)
            }
        });
    }

    function ajax_set_full(type, title, noty, form_id, id) {
        alert('hi');
        //full_form(title,noty,form_id);
        ajax_load(base_url + 'index.php/' + user_type + '/' + module + '/' + type + '/' + id, 'list', 'form');
    }


    function ajax_modal(title, noty, form_id, id) {
        modal_form(title, noty, form_id);
        ajax_load(base_url + 'index.php/Admin/do_add/' + id, 'form', 'form');

    }
    function modal_form(title, noty, form_id) {
        bootbox.dialog({
            title: title,
            message: "<div id='form'></div>",
            buttons: {
                success: {
                    label: sv,
                    className: "btn-purple enterer",
                    callback: function () {
                        if (form_submit(form_id, noty) !== false) {
                            return false;
                        } else {
                            sound('form_submit_problem');
                            return false;
                        }
                    }
                },
                danger: {
                    label: cnl,
                    className: "btn-dark",
                    callback: function () {
                        $.activeitNoty({
                            type: 'danger',
                            icon: 'fa fa-minus',
                            message: 'Cancelled',
                            container: 'floating',
                            timer: 3000
                        });
                        sound('cancelled');
                    }
                }
            }
        });
        sound('modal_opened');
    }
</script>


<script type="text/javascript">
    function showAjaxModal(url)
    {
        // SHOWING AJAX PRELOADER IMAGE
        jQuery('#modal_ajax .modal-body').html('<div style="text-align:center;margin-top:200px;"><img src="img/loader.gif" /></div>');

        // LOADING THE AJAX MODAL
        jQuery('#modal_ajax').modal('show', {backdrop: 'true'});

        // SHOW AJAX RESPONSE ON REQUEST SUCCESS
        $.ajax({
            url: url,
            success: function(response)
            {
                jQuery('#modal_ajax .modal-body').html(response);
            }
        });
    }
</script>

