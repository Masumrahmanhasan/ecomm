<?php 
//$edit_data	=	$this->db->get_where('invoice' , array('invoice_id' => $param2) )->result_array();
foreach ($edit_data as $row):
?>

<div class="row">
	<div class="col-md-12">
        <div class="panel panel-default panel-shadow" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">Stock</div>
            </div>

            <div class="panel-body">
				<form class="form-horizontal" action="<?=base_url()?>Admin/stock/do_add" method="post">
					<input type="hidden" name="product" value="<?php echo $row['product_id']; ?>">
				<div class="form-group">
					<label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('current_quantity');?></label>
					<div class="col-sm-6">
						<input type="number" disabled value="<?php echo $row['current_stock']; ?>" class="form-control totals">
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-4 control-label" for="demo-hor-2"><?php echo translate('quantity');?></label>
					<div class="col-sm-6">
						<input type="number" name="quantity" min="0" id="quantity" class="form-control totals required">
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-4 control-label" for="demo-hor-3"><?php echo translate('rate');?></label>
					<div class="col-sm-6">
						<input type="number" name="rate" id="rate" value="<?php echo $row['purchase_price']; ?>" class="form-control totals">
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-4 control-label" for="demo-hor-4"><?php echo translate('total');?></label>
					<div class="col-sm-6">
						<input type="number" name="total" id="total" class="form-control totals">
					</div>
				</div>

				<div class="form-group">
					<label class="col-sm-4 control-label" for="demo-hor-5"><?php echo translate('reason_note');?></label>
					<div class="col-sm-6">
						<textarea name="reason_note" class="form-control" rows="3"></textarea>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-5">
						<input type="submit" name="Submit" class="btn btn-info">
					</div>
				</div>
				</form>
            </div>


        </div>
    </div>
</div>

<?php endforeach;?>

<script>
	$(document).ready(function() {

		total();
	});

	function total(){
		var total = Number($('#quantity').val())*Number($('#rate').val());
		$('#total').val(total);
	}

	$(".totals").change(function(){
		total();
	});


</script>
