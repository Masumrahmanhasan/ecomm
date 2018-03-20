<body>
<div id="page-wraper">
<header>
    <!-- header-top-area-start -->
    <div class="header-top-area" id="sticky-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                    <!-- logo-area-start -->
                    <div class="logo-area">
                        <a href="index.html"><img src="<?= base_url()?>frontend_assets/img/logo/1.png" alt="logo" /></a>
                    </div>
                    <!-- logo-area-end -->
                </div>
                <div class="col-lg-7 col-md-7 hidden-sm hidden-xs">
                    <!-- menu-area-start -->
                    <div class="menu-area">
                        <nav>
                            <ul>
                                <li class="active"><a href="index.html">Home</a>
                                </li>
                                <?php
                                $category = $this->Admin_model->getAll('category');

                                for ($i = 0; $i < count($category); $i++) { $id = $category[$i]['id']; ?>
                                <li><a href="shop.html"><?=$category[$i]['name']?></a>
                                    <ul class="mega-menu">
                                        <?php  $sub_category = $this->Home_model->getByIdImran('sub_category',array('cat_id'=>$id));
                                        //print_r($sub_category);

                                        foreach ($sub_category as $sub_category) { $sid = $sub_category['id']; ?>
                                        <li><a href="#"><?=$sub_category['name']?></a>
                                            <ul class="sub-menu-2">
                                                <?php  $brand = $this->Home_model->getByIdImran('brands',array('sub_cat_id'=>$sid));
                                                //print_r($sub_category);
                                                foreach($brand as $brand) { ?>
                                                <li><a href="shop.html"><?php echo $brand['name'];?></a></li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                        <?php } ?>

                                    </ul>
                                </li>
                                <?php } ?>

                            </ul>
                        </nav>
                    </div>
                    <!-- menu-area-end -->
                </div>
                <div class="col-lg-3 col-md-3 com-sm-6 col-xs-6">
                    <!-- header-right-area-start -->
                    <div class="header-right-area">
                        <ul>
                            <li><a id="show-search" href="#"><i class="icon ion-ios-search-strong"></i></a>
                                <div class="search-content" id="hide-search">
                                    <div class="search-text">
                                        <h1>Search</h1>
                                        <form action="#">
                                            <input type="text" placeholder="search"/>
                                            <button class="btn" type="button">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </li>
                            <li><a href="cart.html"><i class="icon ion-bag"></i></a>
                                <span></span>
                                <div class="mini-cart-sub">
                                    <div class="cart-product" id="cart_details">
                                        
                                    </div>
                                    <div class="cart-totals">
                                        <h5>Total <span>£12.00</span></h5>
                                    </div>
                                    <div class="cart-bottom">
                                        <a href="checkout.html">Check out</a>
                                    </div>
                                </div>
                            </li>
                            <li id="show-cart"><a href="#"><i class="icon ion-drag"></i></a>
                                <div class="shapping-area" id="hide-cart">
                                    <div class="single-shapping mb-20">
                                        <span>Currency</span>
                                        <ul>
                                            <li><a href="#">€ Euro</a></li>
                                            <li><a href="#">£ Pound Sterling</a></li>
                                            <li><a href="#">$ US Dollar</a></li>
                                        </ul>
                                    </div>
                                    <div class="single-shapping mb-20">
                                        <span>Language</span>
                                        <ul>
                                            <li><a href="#"><img src="<?= base_url()?>frontend_assets/img/flag/1.jpg" alt="flag" />   English</a></li>
                                            <li><a href="#"><img src="<?= base_url()?>frontend_assets/img/flag/2.jpg" alt="flag" />   French</a></li>
                                        </ul>
                                    </div>
                                    <div class="single-shapping">
                                        <span>My Account</span>
                                        <ul>
                                            <li><a href="register.html">Register</a></li>
                                            <li><a href="login.html">Login</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- header-right-area-end -->
                </div>
            </div>
        </div>
    </div>
    <!-- header-top-area-end -->
    <!-- mobile-menu-area-start -->
    <div class="mobile-menu-area hidden-md hidden-lg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="mobile-menu">
                        <nav id="mobile-menu-active">
                            <ul id="nav">
                                <li><a href="index.html">Home</a>
                                    <ul>
                                        <li><a href="index-2.html">Home-2</a></li>
                                        <li><a href="index-3.html">Home-3</a></li>
                                        <li><a href="index-4.html">Home-4</a></li>
                                        <li><a href="index-5.html">Home-5</a></li>
                                        <li><a href="index-6.html">Home-6</a></li>
                                    </ul>
                                </li>
                                <li><a href="shop.html">Men</a>
                                    <ul>
                                        <li><a href="shop.html">finibus iaculis</a></li>
                                        <li><a href="shop.html">Integer rhoncus</a></li>
                                        <li><a href="shop.html">purus elittincidu</a></li>
                                        <li><a href="shop.html">tincidunt est</a></li>
                                        <li><a href="shop.html">Fusce eurhon</a></li>
                                        <li><a href="shop.html">iaculis ipsum</a></li>
                                        <li><a href="shop.html">ligula consectet</a></li>
                                        <li><a href="shop.html">vestibulum egest</a></li>
                                        <li><a href="shop.html">Integer rhoncus</a></li>
                                        <li><a href="shop.html">ipsum ametus</a></li>
                                        <li><a href="shop.html">Morbi vitae</a></li>
                                        <li><a href="shop.html">semper vulputate</a></li>
                                        <li><a href="shop.html">Aliquam acsus</a></li>
                                        <li><a href="shop.html">Morbi amimi</a></li>
                                        <li><a href="shop.html">pretium metus</a></li>
                                        <li><a href="shop.html">suscipit felis</a></li>
                                    </ul>
                                </li>
                                <li><a href="shop.html">Accessories</a>
                                    <ul>
                                        <li><a href="shop.html">Integer rhoncus</a></li>
                                        <li><a href="shop.html">ipsum ametus</a></li>
                                        <li><a href="shop.html">Morbi vitae</a></li>
                                        <li><a href="shop.html">semper vulputate</a></li>
                                        <li><a href="shop.html">Aliquam acsus</a></li>
                                        <li><a href="shop.html">Morbi amimi</a></li>
                                        <li><a href="shop.html">pretium metus</a></li>
                                        <li><a href="shop.html">suscipit felis</a></li>
                                    </ul>
                                </li>
                                <li><a href="shop.html">Women</a>
                                    <ul>
                                        <li><a href="shop.html">arcu dignissim</a></li>
                                        <li><a href="shop.html">congue quamm</a></li>
                                        <li><a href="shop.html">necfer mentuma</a></li>
                                        <li><a href="shop.html">ultricies volutpat</a></li>
                                        <li><a href="shop.html">acaliquet orci</a></li>
                                        <li><a href="shop.html">dignissim placera</a></li>
                                        <li><a href="shop.html">risussed trist</a></li>
                                        <li><a href="shop.html">Utsuscipit urna</a></li>
                                    </ul>
                                </li>
                                <li><a href="blog.html">blog</a>
                                    <ul>
                                        <li><a href="blog.html">Blog</a></li>
                                        <li><a href="blog-details.html">blog details</a></li>
                                    </ul>
                                </li>
                                <li><a href="shop.html">Pages</a>
                                    <ul>
                                        <li><a href="shop.html">Shop</a></li>
                                        <li><a href="product-details.html">product details</a></li>
                                        <li><a href="blog.html">Blog</a></li>
                                        <li><a href="blog-details.html">blog details</a></li>
                                        <li><a href="about.html">About</a></li>
                                        <li><a href="contact.html">Contact</a></li>
                                        <li><a href="checkout.html">Checkout</a></li>
                                        <li><a href="cart.html">Cart</a></li>
                                        <li><a href="login.html">Login</a></li>
                                        <li><a href="register.html">Register</a></li>
                                        <li><a href="wishlist.html">Wishlist</a></li>
                                        <li><a href="404.html">404 Page</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- mobile-menu-area-end -->
</header>