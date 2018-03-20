<div class="tab-content">
    <div class="tab-pane active" id="list">
        <div class="row">
            <?php if(!empty($products)){foreach ($products as $product) { ?>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <!-- product-wrapper-start -->
                <div class="product-wrapper mb-40">
                    <div class="product-img">
                        <a href="#">
                            <img src="<?=base_url()?><?=$product['image_name'];?>" alt="product" class="primary">
                            
                        </a>
                        <span class="sale">sale</span>
                        <div class="product-icon">
                            <button type="button" name="add_cart"
                                    class="btn btn-success add_cart" data-productname="<?=$product['product_name']?>"
                                    data-price="<?=$product['sale_price'];?>"
                                    data-productid="<?=$product['product_id'];?>"
                                    title="Add to Cart"><i class="icon ion-bag"></i> </button>
                            <a href="#" data-toggle="tooltip" title="" data-original-title="Compare this Product"><i class="icon ion-android-options"></i></a>
                            <a href="#" data-toggle="modal" data-target="#mymodal" title="Quick View"><i class="icon ion-android-open"></i></a>
                        </div>
                    </div>
                    <div class="product-content pt-20">
                        <div class="manufacture-product">
                            <a href="#">Armani</a>
                            <div class="rating">
                                <ul>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <h2><a href="product-details.html"><?php echo $product['product_name']?></a></h2>
                        <div class="price">
                            <ul>
                                <li class="new-price">$122.00</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- product-wrapper-end -->
            </div>
            <?php } }else{ ?>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <h2>No products in this category</h2>
                    </div>
            <?php } ?>

        </div>
    </div>
</div>