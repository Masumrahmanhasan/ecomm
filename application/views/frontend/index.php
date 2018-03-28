<?php
if ($this->crud_model->get_type_name_by_id('general_settings', '62', 'value') == 'ok') {
    include 'category_menu.php';
}
?>

<?php
include 'top_banner.php';
?>
<?php
if ($this->crud_model->get_type_name_by_id('ui_settings', '24', 'value') == 'ok') {
    include 'featured_products.php';
}
?>
<?php
include 'new_products.php';
include 'wide_banners.php';
include 'best_sales.php';
include 'new_arrivals.php';
include 'recently_viewed.php';
include 'most_viewed.php'; ?>
<?php if ($this->crud_model->get_type_name_by_id('general_settings', '58', 'value') == 'ok') {
    if ($this->crud_model->get_type_name_by_id('ui_settings', '25', 'value') == 'ok') {
        include 'vendors.php';
    }
}
?>
<div class="row" style="margin-bottom: 20px;">
    <div class="blog-page">
        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
            <section class="blog-post wow fadeInUp animated">
                <h4>Online shopping in India at its bes</h4>
                <p>It's no longer just the privilege of a metro city or an urban area to shop online for their favorite
                    products. Snapkart is one online shopping site that has made it possible for consumers even in the
                    remote areas of India to avail products from the best brands at low prices online. Considering the
                    present lifestyle of people, it's no surprise that they prefer to buy online most of the products
                    that they need on a daily basis like clothes for men and women, electronics, mobiles, home
                    appliances, products for personal beauty and care , and the like. The ultimate convenience of having
                    to simply browse through their favorite online shopping website and place orders from the comfort of
                    their home, and get it delivered in the shortest time possible at their doorstep is a service that
                    is unbeatable.

                </p>
            </section>

            <section class="blog-post wow fadeInUp animated">
                <h4>Every Order is a wish to be fulfilled - Ab Har Wish Hogi Poori</h4>
                <p>To Snapkart, a wish is something that it fulfills for every Pakistani, whenever , wherever. From a
                    massive collection to choose from, at delightful prices to fit into your budget, you choose your box
                    of happiness which will be delivered to you by us no matter how distant you are.</p>
            </section>
            <section class="blog-post wow fadeInUp animated">
                <h4>Shop online with the best deals & offers</h4>
                <p>When you find that your favorite clothes , like a nice shirt, jeans, a pair of trousers or t-shirt
                    from, say, UCB or Vero Moda is available online at very low prices under some great offers, nothing
                    could stop you from owning one. Online fashion shopping has become so much more comfortable and
                    affordable with the plethora of deals and offers we bring forth on a daily basis. Exciting both
                    women and men alike, offers and deals do rounds on Snapkart not only with apparel, footwear and
                    lifestyle accessories, but also with laptops, electronics, mobiles, television sets, air
                    conditioners, refrigerators, MP3 players, books and so many more. There is something for everyone
                    and that too from the most sought-after brands like Samsung, Motorola, Dell, HP, Canon, Nikon,
                    Philips, Adidas, Reebok, Nike and so on.
                </p>
            </section>
        </div>
    </div>
</div>

<div class="clearfix"></div>
