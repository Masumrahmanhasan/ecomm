
<div class="layout-content">
            <div class="layout-content-body">
                <div class="">
                    <div class="col-md-12">
                         <?php for($i=0; $i<count($option);$i++){?>
                            <div class="card">
                            <div class="card-header">
                                <strong><span class="icon icon-plus-circle"></span> EDIT PRODUCT</strong>
                            </div>
                            <div class="card-body">
                                <div id="msg"></div>
                                <form id="edit_option" class="form form-horizontal" style="margin-top: 30px" method="POST" onsubmit="return false">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" style="width: 20%;" for="name">Name</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                  <span class="input-group-addon">
                                                        <span class="icon icon-cube"></span>
                                                  </span>
                                                <input class="form-control" type="text" name="name" id="product_name" value="<?=$option[$i]->product_name;?>" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" style="width: 20%;" for="model">Sale Price</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                   <span class="input-group-addon">
                                                       <span class="icon icon-cube"></span>
                                                   </span>
                                                <input class="form-control" type="text" name="sale_price" id="sale_price" value="<?=$option[$i]->sale_price;?>">
                                            </div>
                                        </div>
                                    </div>
                                   
                                   
                                 
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" style="width: 20%" for="purchase_price">Purchase Price</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                   <span class="input-group-addon">
                                                       <span class="icon icon-dollar"></span>
                                                   </span>
                                                <input class="form-control" type="text" name="purchase_price" id="purchase_price" value="<?=$option[$i]->purchase_price;?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" style="width: 20%" for="selling_price">Discount</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                   <span class="input-group-addon">
                                                       <span class="icon icon-dollar"></span>
                                                   </span>
                                                <input class="form-control" type="text" name="discount" id="discount" value="<?=$option[$i]->discount;?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" style="width: 20%" for="discount">Status</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                   <span class="input-group-addon">
                                                       <span class="icon icon-cubes"></span>
                                                   </span>
                                                <input class="form-control" type="text" name="status" id="status"value="<?=$option[$i]->status;?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" style="width: 20%" for="tags">Tax</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                   <span class="input-group-addon">
                                                       <span class="icon icon-cubes"></span>
                                                   </span>
                                                <input class="form-control" type="text" name="tax" id="tax" value="<?=$option[$i]->tax;?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" style="width: 20%;" for="details">Tax type</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                   <span class="input-group-addon">
                                                       <span class="icon icon-cubes"></span>
                                                   </span>
                                                    <input class="form-control" type="text" value="<?=$option[$i]->tax_type;?>" name="tax_type" id="tax_type">
                                             </div>
                                        </div>
                                    </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" style="width: 20%;" for="details">Quantity</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="text" value="<?=$option[$i]->current_stock;?>" name="quantity" id="quantity">
                                            </div>
                                         </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" style="width: 20%;" for="details">Size</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" value="<?=$option[$i]->size;?>" name="size" id="size">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" style="width: 20%;">Color</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" value="<?=$option[$i]->color;?>"  type="text" name="color" id="color">
                                            <input type="hidden" id="id" value="<?=$option[$i]->options_id;?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" style="width: 20%;">Shipping Cost</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" value="<?=$option[$i]->shipping_cost;?>"  type="text" name="shipping" id="shipping">
                                            
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-md-3">
                                        <button class="btn btn-primary option_update" style="margin-left: 250px;padding: 6px 25px;!important;"
                                                type="submit">Save
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                         <?php }?>
                    </div>
                </div>
            </div>
        </div> 


