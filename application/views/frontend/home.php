<div class="slider-area">
    <div id="slider">
        <img src="<?= base_url() ?>frontend_assets/img/slider/1.jpg" alt="slider-img" title="#caption1"/>
        <img src="<?= base_url() ?>frontend_assets/img/slider/2.jpg" alt="slider-img" title="#caption2"/>
        <img src="<?= base_url() ?>frontend_assets/img/slider/3.jpg" alt="slider-img" title="#caption3"/>
    </div>
    <div class="nivo-html-caption" id="caption1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="slider-text">
                        <h5 class="wow fadeInLeft" data-wow-delay=".3s">clothing</h5>
                        <h5 class="wow fadeInLeft" data-wow-delay=".5s">new collection</h5>
                        <h2 class="wow fadeInRight" data-wow-delay=".7s">New arrivals!</h2>
                        <h1 class="wow fadeInRight" data-wow-delay=".9s">amazing mimosa</h1>
                        <p class="wow fadeInLeft" data-wow-delay="1.3s">We crack for this purely rock style with
                            stitched quills in relief and metallic <br/> hardware.</p>
                        <a href="#" class=" wow bounceInRight" data-wow-delay="1.5s">read more</a>
                    </div>
                </div><!-- col -->
            </div><!-- row -->
        </div><!-- container -->
    </div>
    <div class="nivo-html-caption" id="caption2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="slider-text">
                        <h5 class="wow fadeInLeft" data-wow-delay=".3s">handbag</h5>
                        <h5 class="wow fadeInLeft" data-wow-delay=".5s">new collection</h5>
                        <h2 class="wow fadeInRight" data-wow-delay=".7s">Clean & Elegant! </h2>
                        <h1 class="wow fadeInRight" data-wow-delay=".9s">Black Handbag</h1>
                        <p class="wow fadeInLeft" data-wow-delay="1.3s">BlackBird collection of minimal, sleek and
                            functional Carryalls were designed <br/> with creatives in mind.</p>
                        <a href="#" class=" wow bounceInRight" data-wow-delay="1.5s">read more</a>
                    </div>
                </div><!-- col -->
            </div><!-- row -->
        </div><!-- container -->
    </div>
    <div class="nivo-html-caption" id="caption3">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="slider-text">
                        <h5 class="wow fadeInLeft" data-wow-delay=".3s">handbag</h5>
                        <h5 class="wow fadeInLeft" data-wow-delay=".5s">new collection</h5>
                        <h2 class="wow fadeInRight" data-wow-delay=".7s">amazing product! </h2>
                        <h1 class="wow fadeInRight" data-wow-delay=".9s">backpack</h1>
                        <p class="wow fadeInLeft" data-wow-delay="1.3s">Inspired by the Kastrup backpack, but reimagined
                            for the modern woman, the <br/> Piper marries the functionality our backpacks are known for
                            with more feminine <br/> proportions and details. </p>
                        <a href="#" class=" wow bounceInRight" data-wow-delay="1.5s">read more</a>
                    </div>
                </div><!-- col -->
            </div><!-- row -->
        </div><!-- container -->
    </div>
</div>
<!-- slider-area-end -->
<!-- founder-area-start -->
<div class="founder-area ptb-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="founder-description text-center">
                    <h3>Who Are We</h3>
                    <h1>Welcome To Mimosa</h1>
                    <img src="img/banner/1.png" alt="banner"/>
                    <p>Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel
                        illum dolore eu feugiat nulla facilisis <br/> at vero eros et accumsan et iusto odio dignissim
                        qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla <br/> facilisi.
                    </p>
                    <h4>John Doe - <span>CEO Mimosa</span></h4>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- founder-area-end -->
<!-- banner-area-start -->
<div class="banner-area">
    <div class="container">
        <div class="row">
            <?php $categoryy = $this->Home_model->getAllImran('category',3);
            foreach ($categoryy as $item) { ?>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 mb-40-2">
                <!-- single-banner-start -->
                <div class="single-banner mb-20 mb-3">
                    <div class="banner-img">
                        <a href="#"><img src="<?= base_url() ?>frontend_assets/img/<?=$item['image']?>" alt="banner"/></a>
                    </div>
                    <div class="banner-content">
                        <a href="#"><?php echo $item['name'];?></a>
                    </div>
                </div>
                <!-- single-banner-start -->
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<!-- banner-area-end -->
<!-- feature-product-area-start -->
<div class="feature-product-area ptb-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title mb-30 text-center">
                    <h2>Featured Products</h2>
                    <p>Mirum est notare quam littera gothica, quam nunc putamus parum claram anteposuerit litterarum
                        formas.</p>
                </div>
            </div>
            <div class="col-lg-12">
                <!-- tab-menu-start -->
                <div class="tab-menu mb-50 text-center">
                    <ul>
                        <?php foreach ($category as $cat) { ?>
                        <li class="<?php if($cat['id'] == 1)echo "active";?>"><a href="#<?php echo $cat['id'];?>" data-toggle="tab"><?php echo $cat['name'];?></a></li>
                        <?php } ?>
                    </ul>
                </div>
                <!-- tab-menu-end -->
            </div>
        </div>
        <!-- tab-area-start -->
        <div class="tab-content">
            <?php 

            foreach ($category as $item) {
                $cid = $item['id'];
            $products = $this->db->query("select * from product where cat_id = $cid")->result_array();

            ?>
            <div class="tab-pane <?php if($item['id'] == 1)echo "active";?>" id="<?=$item['id']?>">
                <div class="row">
                    <div class="product-active">
                        <?php foreach ($products as $product) { $p_id = $product['product_id'];
                            $sub = $product['sub_cat_id'];
                            ?>
                        <div class="col-lg-12">
                            <!-- product-wrapper-start -->
                            <div class="product-wrapper">
                                <div class="product-img">
                                    <a href="#">
                                        <?php $p_images = $this->db->query("select * from product_image where product_id = $p_id")->result_array();
                                       // foreach ($p_images as $p_image) {
                                        ?>
                                        <img src="<?php echo $this->Admin_model->file_view('product', $product['product_id'], '100', '', 'thumb', 'src', 'multi', 'one'); ?>" alt="product"
                                             class="primary"/>

                                        <?php // } ?>
                                    </a>
                                    <span class="sale">sale</span>
                                    <div class="product-icon">
                                        <a href="#" data-toggle="tooltip" title="Add to Cart"><i
                                                class="icon ion-bag"></i></a>
                                        <a href="#" data-toggle="tooltip" title="Compare this Product"><i
                                                class="icon ion-android-options"></i></a>
                                        <a href="#" data-toggle="modal" data-target="#mymodal" title="Quick View"><i
                                                class="icon ion-android-open"></i></a>
                                    </div>
                                </div>
                                <div class="product-content pt-20">
                                    <div class="manufacture-product">
                                        <?php $brand = $this->db->query("SELECT (b.`name`) AS brand_name FROM brands AS b, sub_category AS s, category AS c, product AS p
WHERE p.`cat_id` = c.`id`
AND p.`sub_cat_id` = s.`id`
AND p.`brand_id` = b.`id`
AND p.`product_id` = $p_id")->row_array();
                                        // foreach ($p_images as $p_image) {
                                        ?>
                                        <a href="#"><?=$brand['brand_name'];?></a>
                                        <div class="rating">
                                            <ul>
                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <h2><a href="product-details.html"><?=$product['product_name']?></a>
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
                      <?php
            } ?>
        </div>
        <!-- tab-area-end -->
    </div>
</div>
<!-- feature-product-area-end -->
<!-- testimonial-area-start -->
<div class="testimonial-area bg ptb-80">
    <div class="container">
        <div class="row">
            <div class="testimonial-active">
                <div class="col-lg-12">
                    <div class="single-testimonial text-center">
                        <div class="testimonial-img">
                            <a href="#"><img src="<?= base_url() ?>frontend_assets/img/testimonial/1.jpg"
                                             alt="man"/></a>
                        </div>
                        <div class="testimonial-content">
                            <p>This is Photoshops version of Lorem Ipsum. Proin gravida nibh vel velit.Lorem ipsum dolor
                                sit amet, consectetur adipiscing elit. In molestie augue magna. Pellentesque felis
                                lorem, pulvinar sed eros n..</p>
                            <i class="fa fa-quote-right"></i>
                            <h4>Rebecka Filson</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="single-testimonial text-center">
                        <div class="testimonial-img">
                            <a href="#"><img src="<?= base_url() ?>frontend_assets/img/testimonial/1.jpg"
                                             alt="man"/></a>
                        </div>
                        <div class="testimonial-content">
                            <p>Mauris blandit, metus a venenatis lacinia, felis enim tincidunt est, condimentum
                                vulputate orci augue eu metus. Fusce dictum, nisi et semper ultricies, felis tortor
                                blandit odio, egestas consequat pur..</p>
                            <i class="fa fa-quote-right"></i>
                            <h4>Nathanael Jaworski</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- testimonial-area-end -->
<!-- arrivals-area-start -->
<div class="arrivals-area ptb-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title mb-30 text-center">
                    <h2>Latest Arrivals </h2>
                    <p>Mirum est notare quam littera gothica, quam nunc putamus parum claram anteposuerit litterarum
                        formas. </p>
                </div>
            </div>
        </div>
        <!-- tab-area-start -->
        <div class="tab-content">
            <div class="row">
                <div class="product-active">
                    <?php
                    $products_latest = $this->db->query("SELECT * FROM 
product AS p, brands AS b,product_image as pi
WHERE p.`brand_id` = b.`id`
AND pi.product_id = p.product_id
AND pi.class= 'primary' ORDER BY p.product_id DESC ")->result_array();
                    foreach ($products_latest as $product) { $p_id = $product['product_id'];
                    $sub = $product['sub_cat_id'];
                    ?>
                    <div class="col-lg-12">
                        <!-- product-wrapper-start -->
                        <div class="product-wrapper">
                            <div class="product-img">
                                <a href="#">
                                    <img src="<?= base_url() ?><?=$product['image_name'];?>" alt="product"
                                         class="primary"/>
                                </a>
                                <span class="sale">sale</span>
                                <div class="product-icon">
                                    <a href="#" data-toggle="tooltip" title="Add to Cart"><i
                                            class="icon ion-bag"></i></a>
                                    <a href="#" data-toggle="tooltip" title="Compare this Product"><i
                                            class="icon ion-android-options"></i></a>
                                    <a href="#" data-toggle="modal" data-target="#mymodal" title="Quick View"><i
                                            class="icon ion-android-open"></i></a>
                                </div>
                            </div>
                            <div class="product-content pt-20">
                                <div class="manufacture-product">
                                    <a href="#"><?=$product['name'];?></a>
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
                                <h2><a href="product-details.html"><?=$product['product_name'];?></a></h2>
                                <div class="price">
                                    <ul>
                                        <li class="new-price">Rs.<?=$product['sale_price'];?></li>
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
    </div>
</div>
<!-- arrivals-area-end -->
<!-- banner-area-start -->
<div class="banner-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <!-- single-banner-start -->
                <div class="single-banner mb-3">
                    <div class="banner-img">
                        <a href="#"><img src="<?= base_url() ?>frontend_assets/img/banner/7.jpg" alt="banner"/></a>
                    </div>
                    <div class="banner-content-2">
                        <h3>New Arrivals</h3>
                        <h2>White Sneakers</h2>
                        <h2>for Men’s</h2>
                        <a href="#">Shop now</a>
                    </div>
                </div>
                <!-- single-banner-end -->
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <!-- single-banner-start -->
                <div class="single-banner">
                    <div class="banner-img">
                        <a href="#"><img src="<?= base_url() ?>frontend_assets/img/banner/8.jpg" alt="banner"/></a>
                    </div>
                    <div class="banner-content-2">
                        <h3>Products amazing!</h3>
                        <h2>Short T-Shirts</h2>
                        <h2>for Women’s</h2>
                        <a href="#">Shop now</a>
                    </div>
                </div>
                <!-- single-banner-end -->
            </div>
        </div>
    </div>
</div>
<!-- banner-area-end -->
<!-- banner-area-2-start -->
<div class="banner-area-2">
    <div class="container">
        <div class="row">
            <div class="br-bottom ptb-80">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <!-- single-banner-2-start -->
                    <div class="single-banner-2 text-center mb-3">
                        <div class="banner-icon">
                            <a href="#"><img src="<?= base_url() ?>frontend_assets/img/banner/2.png" alt="banner"/></a>
                        </div>
                        <div class="banner-text">
                            <h2>Free Shipping Worldwide</h2>
                            <p>Mirum est notare quam littera gothica, quam nunc putamus parum claram</p>
                        </div>
                    </div>
                    <!-- single-banner-2-end -->
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <!-- single-banner-2-start -->
                    <div class="single-banner-2 text-center mb-3">
                        <div class="banner-icon">
                            <a href="#"><img src="<?= base_url() ?>frontend_assets/img/banner/3.png" alt="banner"/></a>
                        </div>
                        <div class="banner-text">
                            <h2>Money Back Guarantee</h2>
                            <p>Mirum est notare quam littera gothica, quam nunc putamus parum claram</p>
                        </div>
                    </div>
                    <!-- single-banner-2-end -->
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <!-- single-banner-2-start -->
                    <div class="single-banner-2 text-center">
                        <div class="banner-icon">
                            <a href="#"><img src="<?= base_url() ?>frontend_assets/img/banner/4.png" alt="banner"/></a>
                        </div>
                        <div class="banner-text">
                            <h2>online support 24/7</h2>
                            <p>Mirum est notare quam littera gothica, quam nunc putamus parum claram</p>
                        </div>
                    </div>
                    <!-- single-banner-2-end -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- banner-area-2-end -->
<!-- blog-area-start -->
<div class="blog-area ptb-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title mb-30 text-center">
                    <h2>From Our Blog</h2>
                    <p>Mirum est notare quam littera gothica, quam nunc putamus parum claram anteposuerit litterarum
                        formas.</p>
                </div>
            </div>
            <div class="blog-active">
                <div class="col-lg-12">
                    <!-- single-blog-start -->
                    <div class="single-blog">
                        <div class="blog-img">
                            <a href="#"><img src="<?= base_url() ?>frontend_assets/img/blog/1.jpg" alt="blog"/></a>
                            <div class="date">
                                Aug <span>09</span>
                            </div>
                        </div>
                        <div class="blog-content pt-20">
                            <h3><a href="blog-details.html">Aypi non habent claritatem insitam.</a></h3>
                            <span>HasTech</span>
                            <p>Aypi non habent claritatem insitam. Aypi non habent claritatem insitam. Aypi non habent
                                claritatem insitam.Aypi non habent claritatem insitam. Aypi non habent claritatem
                                insitam.</p>
                            <a href="blog-details.html">Read more ...</a>
                        </div>
                    </div>
                    <!-- single-blog-end -->
                </div>
                <div class="col-lg-12">
                    <!-- single-blog-start -->
                    <div class="single-blog">
                        <div class="blog-img">
                            <a href="#"><img src="<?= base_url() ?>frontend_assets/img/blog/2.jpg" alt="blog"/></a>
                            <div class="date">
                                Aug <span>09</span>
                            </div>
                        </div>
                        <div class="blog-content pt-20">
                            <h3><a href="blog-details.html">Bypi non habent claritatem insitam.</a></h3>
                            <span>HasTech</span>
                            <p>Aypi non habent claritatem insitam. Aypi non habent claritatem insitam. Aypi non habent
                                claritatem insitam.Aypi non habent claritatem insitam. Aypi non habent claritatem
                                insitam.</p>
                            <a href="blog-details.html">Read more ...</a>
                        </div>
                    </div>
                    <!-- single-blog-end -->
                </div>
                <div class="col-lg-12">
                    <!-- single-blog-start -->
                    <div class="single-blog">
                        <div class="blog-img">
                            <a href="#"><img src="<?= base_url() ?>frontend_assets/img/blog/3.jpg" alt="blog"/></a>
                            <div class="date">
                                Aug <span>09</span>
                            </div>
                        </div>
                        <div class="blog-content pt-20">
                            <h3><a href="blog-details.html">Cypi non habent claritatem insitam.</a></h3>
                            <span>HasTech</span>
                            <p>Aypi non habent claritatem insitam. Aypi non habent claritatem insitam. Aypi non habent
                                claritatem insitam.Aypi non habent claritatem insitam. Aypi non habent claritatem
                                insitam.</p>
                            <a href="blog-details.html">Read more ...</a>
                        </div>
                    </div>
                    <!-- single-blog-end -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- blog-area-end -->
<!-- newslatter-area-start -->
<div class="newslatter-area">
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
<!-- newslatter-area-end -->