<!-- breadcrumbs-area-start -->
<div class="breadcrumbs-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-content text-center">
                    <h2>shop</h2>
                    <ul>
                        <li><a href="#">Home /</a></li>
                        <li class="active"><a href="#">shop</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumbs-area-end -->
<!-- shop-main-area-start -->
<div class="shop-main-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- page-bar-start -->
                <div class="page-bar">
                    <div id="msg"></div>

                    <div class="shop-tab">
                        <!-- tab-menu-start -->
                        <div class="tab-menu-3">
                            <ul>
                                <li class="active"><a href="#list" data-toggle="tab"><i class="fa fa-th"></i></a></li>
                            </ul>
                        </div>
                        <!-- tab-menu-end -->
                        <!-- toolbar-sorter-start -->
                        <div class="toolbar-sorter">
                            <select class="sorter-options" data-role="sorter">
                                <option selected="selected" value="Lowest">Sort By: Default</option>
                                <option value="Highest">Sort By: Name (A - Z)</option>
                                <option value="Product">Sort By: Name (Z - A)</option>
                            </select>
                        </div>
                        <!-- toolbar-sorter-end -->
                        <!-- toolbar-sorter-2-start -->
                        <div class="toolbar-sorter-2">
                            <select class="sorter-options" data-role="sorter">
                                <option selected="selected" value="Lowest">Show: 9</option>
                                <option value="Highest">Show: 25</option>
                                <option value="Product">Show: 50</option>
                            </select>
                        </div>
                        <!-- toolbar-sorter-2-end -->
                    </div>
                </div>
                <!-- page-bar-end -->
            </div>
        </div>
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 pull-right">
                <!-- shop-right-area-start -->
                <div class="shop-right-area mb-40-2 mb-30" id="all_products">
                    <!-- tab-area-start -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="list">
                            <div class="row">
                                <?php for ($i = 0; $i < count($products); $i++) { ?>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <!-- product-wrapper-start -->
                                        <div class="product-wrapper mb-40">
                                            <div class="product-img">
                                                <a href="#">
                                                    <img src="<?= base_url() ?>frontend_assets/img/product/1.jpg"
                                                         alt="product" class="primary"/>
                                                    <img src="<?= base_url() ?>frontend_assets/img/product/2.jpg"
                                                         alt="product" class="secondary"/>
                                                </a>
                                                <span class="sale">sale</span>
                                                <div class="product-icon">
                                                    <a href="#" data-toggle="tooltip" title="Add to Cart"><i
                                                            class="icon ion-bag"></i></a>
                                                    <a href="#" data-toggle="tooltip" title="Compare this Product"><i
                                                            class="icon ion-android-options"></i></a>
                                                    <a href="#" data-toggle="modal" data-target="#mymodal"
                                                       title="Quick View"><i class="icon ion-android-open"></i></a>
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
                                                <h2>
                                                    <a href="product-details.html"><?= $products[$i]['product_name']; ?></a>
                                                </h2>
                                                <div class="price">
                                                    <ul>
                                                        <li class="new-price">$122.00</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- product-wrapper-end -->
                                    </div>
                                <?php } ?>

                            </div>
                        </div>
                    </div>
                    <!-- tab-area-end -->
                    <!-- pagination-area-start -->
                    <div class="pagination-area">
                        <div class="pagination-number">
                            <ul>
                                <li><a href="#"><i class="fa fa-angle-left"></i></a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                            </ul>
                        </div>
                        <div class="product-count">
                            <p>Showing 1 - 12 of 13 items</p>
                        </div>
                    </div>
                    <!-- pagination-area-end -->
                </div>
                <!-- shop-right-area-end -->
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <!-- shop-left-area-start -->
                <div class="shop-left-area">
                    <!-- single-shop-start -->
                    <div class="single-shop mb-40">
                        <div class="Categories-title">
                            <h3>Categories</h3>
                        </div>
                        <div class="Categories-list">
                            <ul>
                                <?php if (!empty($categories)):
                                    foreach ($categories as $category) :
                                        $c_id = $category['id'];
                                        $items = $this->db->query("select count(1) as items from product WHERE cat_id = $c_id")->row_array();
                                        ?>
                                        <li><a href="#"
                                               onclick="getProducts(<?= $category['id'] ?>)"><?= $category['name'] ?>
                                                (<?= $items['items']; ?>)</a></li>
                                    <?php endforeach; endif; ?>
                            </ul>
                        </div>
                    </div>
                    <!-- single-shop-end -->
                    <!-- single-shop-start -->
                    <div class="single-shop mb-40">
                        <div class="Categories-title">
                            <h3>Price Filter</h3>
                        </div>
                        <div id="slider-range"></div>
                        <input type="text" name="text" id="amount"/>
                    </div>
                    <!-- single-shop-end -->
                    <!-- single-shop-start -->
                    <div class="single-shop mb-40">
                        <div class="Categories-title">
                            <h3>Brand</h3>
                        </div>
                        <div class="Categories-list">
                            <ul>
                                <li><a href="#">Calvin Klein (11)</a></li>
                                <li><a href="#">Diesel (15)</a></li>
                                <li><a href="#">Polo (13)</a></li>
                                <li><a href="#">Tommy Hilfiger (14)</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- single-shop-end -->
                    <!-- single-shop-start -->
                    <div class="single-shop mb-40">
                        <div class="Categories-title">
                            <h3>Size</h3>
                        </div>
                        <div class="Categories-list">
                            <ul>
                                <li><a href="#">L (14)</a></li>
                                <li><a href="#">M (11)</a></li>
                                <li><a href="#">S (12)</a></li>
                                <li><a href="#">XL (14)</a></li>
                                <li><a href="#">XS (12)</a></li>
                                <li><a href="#">XXL (13)</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- single-shop-end -->
                    <!-- single-shop-start -->
                    <div class="single-shop mb-40">
                        <div class="Categories-title">
                            <h3>Color</h3>
                        </div>
                        <div class="Categories-list">
                            <ul>
                                <li><a href="#">Black (12)</a></li>
                                <li><a href="#">Blue (10)</a></li>
                                <li><a href="#">Green (14)</a></li>
                                <li><a href="#">Grey (14)</a></li>
                                <li><a href="#">Red (12)</a></li>
                                <li><a href="#">White (13)</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- single-shop-end -->
                </div>
                <!-- shop-left-area-end -->
            </div>
        </div>
    </div>
</div>
<!-- shop-main-area-end -->
<!-- newslatter-area-start -->
<div class="newslatter-area pt-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="bt-top ptb-80">
                    <div class="newlatter-content text-center">
                        <h6>Special Offers For Subscribers</h6>
                        <h3>Ten Percent Member Discount</h3>
                        <p>Subscribe to our newsletters now and stay up to date with new collections, the latest
                            lookbooks and exclusive offers.</p>
                        <form action="#">
                            <input type="text" placeholder="Enter your email address here..."/>
                            <button type="submit">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function getProducts(id) {
        //alert(id);
        $("#msg").html('<div class="loading"></div>');
        //var fd = new FormData(this);
        $.ajax({
            url: '<?php echo site_url("Home/getProducts") ?>',
            data: {id: id},
            type: "POST",
            cache: false,
            success: function (res) {
                $(".loading").show();
                $("#all_products").html(res);
                $(".loading").hide();
            },
            error: function (xhr) {
                $("#msg").html("Error: - " + xhr.status + " " + xhr.statusText);
            }
        });
    }
</script>