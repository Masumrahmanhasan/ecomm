<!--CONTENT CONTAINER-->
<?php 
		foreach($product_data as $row)
        { 
?>

<div class="layout-content">
    <div class="layout-content-body">
<h4 class="modal-title text-center padd-all"><?php echo translate('details_of');?> <?php echo $row['product_name'];?></h4>
	<hr style="margin: 10px 0 !important;">
    <div class="row">
    <div class="col-md-12">
        <div class="text-center pad-all">
            <div class="col-md-12" style="border-bottom: 1px solid #ebebeb;padding: 5px;">
                <a class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn" href="<?=base_url('Admin/all_products')?>">Back To Product List                            </a>
            </div>
            <div class="col-md-3">
                <div class="col-md-12">
                    <img class="img-responsive thumbnail" alt="Profile Picture" 
                        src="<?php echo $this->Admin_model->file_view('product',$row['product_id'],'','','thumb','src','multi','one'); ?>">
                </div>
                <div class="col-md-12" style="text-align:justify;">
                    <p><?php echo $row['description'];?></p>
                </div>
            </div>
            <div class="col-md-9">   
                <table class="table table-striped" style="border-radius:3px;">
                    <tr>
                        <th class="custom_td"><?php echo translate('name');?></th>
                        <td class="custom_td"><?php echo $row['product_name']?></td>
                    </tr>
                    <tr>
                        <th class="custom_td"><?php echo translate('category');?></th>
                        <td class="custom_td">
                            <?php echo $this->Admin_model->get_type_name_by_id('category',$row['cat_id'],'name');?>
                        </td>
                    </tr>
                    <tr>
                        <th class="custom_td"><?php echo translate('sub-category');?></th>
                        <td class="custom_td">
                            <?php echo $this->Admin_model->get_type_name_by_id('sub_category',$row['sub_cat_id'],'name');?>
                        </td>
                    </tr>
                    <tr>
                        <th class="custom_td"><?php echo translate('brand');?></th>
                        <td class="custom_td">
                            <?php echo $this->Admin_model->get_type_name_by_id('brands',$row['brand_id']); ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="custom_td"><?php echo translate('sale_price');?></th>
                        <td class="custom_td"><?php echo $row['sale_price']; ?></td>
                    </tr>
                    <tr>
                        <th class="custom_td"><?php echo translate('purchase_price');?></th>
                        <td class="custom_td"><?php echo $row['purchase_price']; ?></td>
                    </tr>
                    <?php if($row['shipping_cost'] != ''){ ?>
                    <tr>
                        <th class="custom_td"><?php echo translate('shipping_cost');?></th>
                        <td class="custom_td"><?php echo $row['shipping_cost']; ?></td>
                    </tr>
                    <?php } if($row['shipping_cost'] != ''){ ?>
                    <tr>
                        <th class="custom_td"><?php echo translate('tax');?></th>
                        <td class="custom_td">
                            <?php echo $row['tax']; ?>
                            <?php if($row['tax_type'] == 'percent'){ echo '%'; } elseif($row['tax_type'] == 'amount'){ echo '$'; } ?>

                        </td>
                    </tr>
                    <?php } if($row['discount'] != ''){ ?>
                    <tr>
                        <th class="custom_td"><?php echo translate('discount');?></th>
                        <td class="custom_td">
                            <?php echo $row['discount']; ?>
                            <?php if($row['discount_type'] == 'percent'){ echo '%'; } elseif($row['discount_type'] == 'amount'){ echo '$'; } ?>
                        </td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <th class="custom_td"><?php echo translate('featured');?></th>
                        <td class="custom_td"><?php echo $row['featured']; ?></td>
                    </tr>
                    <tr>
                        <th class="custom_td"><?php echo translate('tag');?></th>
                        <td class="custom_td">
                            <?php foreach(explode(',',$row['tags']) as $tag){ ?>
                                <?php echo $tag; ?>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="custom_td"><?php echo translate('status');?></th>
                        <td class="custom_td"><?php echo $row['status']; ?></td>
                    </tr>



                    <?php

                        }
                    ?>
                </table>
            </div>
            <hr>
        </div>
    </div>
</div>				
                </div>
    </div>
<?php 

?>
            
<style>
.custom_td{
border-left: 1px solid #ddd;
border-right: 1px solid #ddd;
border-bottom: 1px solid #ddd;
}
</style>

<script>
	$(document).ready(function(e) {
		proceed('to_list');
	});
</script>