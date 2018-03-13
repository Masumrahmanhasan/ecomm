<div class="layout-content">
    <div class="layout-content-body">
        <div class="row">
            <div style="left: 50%; transform: translateX(-50%);" class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <strong><span class="icon icon-edit"></span> VIEW PRODUCT DETAILS</strong>
                    </div>
                    <div class="card-body">
                        <div id="msg"></div>
                        <form id="product_detail" class="form form-horizontal" style="margin-top: 30px" method="POST">
                            <div class="row" align="center">
                                <div class="col-md-7">
                                  <?= $product_detail['details']?>
                                </div>
                            </div>
                            <br />
                            <div class="form-group">
                                <label class="col-sm-3 control-label" style="width: 20%;" for="name">Name</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" name="name" id="name" value="<?= $product_detail['name']?>" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" style="width: 20%;" for="model">Model/Part No.</label>
                                <div class="col-sm-9">
                                        <input class="form-control" type="text" name="part_no" id="part_no" value="<?= $product_detail['part_no']?>" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" style="width: 20%;" for="Category">Category</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" name="cat" id="cat" value="<?= $product_detail['cat_id']?>" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" style="width: 20%;" for="sub_category">Sub Category</label>
                                <div class="col-sm-9">
                                        <input class="form-control" type="text" name="sub_cat" id="sub_cat" value="<?= $product_detail['sub_cat_id']?>" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" style="width: 20%;" for="Brand">Brand</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" name="brand" id="brand" value="<?= $product_detail['brand_id']?>" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" style="width: 20%" for="purchase_price">Purchase Price</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" name="purchase_price" id="purchase_price" value="$<?= $product_detail['purchase_price']?>" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" style="width: 20%" for="selling_price">Selling Price</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" name="sale_price" id="sale_price"  value="$<?= $product_detail['purchase_price']?>" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" style="width: 20%" for="discount">Discount</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" name="discount" id="discount"  value="$<?= $product_detail['discount']?>" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" style="width: 20%" for="tags">Tags</label>
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" name="tags" id="tags" value="<?= $product_detail['tags']?>" readonly>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
