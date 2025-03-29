<?php

namespace TinhDev\components;

use TinhDev\base\Base;
use TinhDev\base\BaseInterface;
use WP_Query;

class ProductTab extends Base implements BaseInterface{

    public static function render(){
        $args_product_new = [
            'posts_per_page' => 8, // Grabs all of the featured products. Limit if needed
            'post_type'      => 'product', // Ensures the post type is a product
            'post_status'    => 'publish', // Ensures the product is published
            'orderby'        => 'ID',
            'order'          => 'DESC',
        ];

        $args_sale = [
            'post_type'      => 'product',
            'posts_per_page' => 8,
            'meta_query'     => [
                'relation' => 'OR',
                [ // Simple products type
                    'key'     => '_sale_price',
                    'value'   => 0,
                    'compare' => '>',
                    'type'    => 'numeric'
                ],
                [ // Variable products type
                    'key'     => '_min_variation_sale_price',
                    'value'   => 0,
                    'compare' => '>',
                    'type'    => 'numeric'
                ]
            ]
        ];

        $args_featured         = [
            'posts_per_page' => 8, // Grabs all of the featured products. Limit if needed
            'post_type'      => 'product', // Ensures the post type is a product
            'post_status'    => 'publish', // Ensures the product is published
            'tax_query'      => [
                [
                    'taxonomy' => 'product_visibility', // Does a meta query on product visibility
                    'field'    => 'name',
                    'terms'    => 'featured', // Makes sure we grab all products flagged as featured
                    'operator' => 'IN',
                ],
            ]
        ];
        $list_product_new      = new WP_Query($args_product_new);
        $list_product_sale     = new WP_Query($args_sale);
        $list_product_featured = new WP_Query($args_featured);

        ?>
		<section class="section-product bg-light py-5">
			<div class="container">
				<h2>
					<span class="d-inline-block p-2 px-4 rounded-pill bg-primary text-white">SẢN PHẨM MỚI NHẤT</span>
				</h2>

				<div class="row">

                    <?php while ($list_product_new->have_posts()) : $list_product_new->the_post();
                        $ID             = get_the_ID();
                        $img            = get_the_post_thumbnail_url($ID, 'full');
                        $title          = get_the_title($ID);
                        $link           = get_permalink($ID);
                        $product        = wc_get_product($ID);
                        $max_percentage = parent::getProductPercentage($product);

                        ?>
						<div class="col-6 col-md-6 col-lg-4 col-xl-3">
							<div class="product-item rounded-3 overflow-hidden border mb-3 bg-white">
								<div class="box-img">
									<a href="http://wp-sinhnguyen.local/san-pham/ca-phe-phin-giay-drip-bag-coffee/" title="CÀ PHÊ PHIN GIẤY (Hộp)">
										<img src="http://wp-sinhnguyen.local/wp-content/uploads/2020/06/IMG_7311-scaled.jpg" alt="CÀ PHÊ PHIN GIẤY (Hộp)">
									</a>
								</div>

								<div class="info p-3 bg-white">
									<h3 class="title">
										<a href="http://wp-sinhnguyen.local/san-pham/ca-phe-phin-giay-drip-bag-coffee/" title="CÀ PHÊ PHIN GIẤY (Hộp)">
											CÀ PHÊ PHIN GIẤY (Hộp) </a>
									</h3>

									<div class="price">
										<del>120,000&#8363;</del>
										<ins class="text-decoration-none">
											<strong>100,000&#8363;</strong>
										</ins>
									</div>

									<div class="sale-off">
										17%
									</div>

								</div>
							</div>
						</div>
                    <?php endwhile;
                    wp_reset_query();
                    wp_reset_postdata();
                    ?>
				</div>


			</div>
		</section>
		<section class="section-product bg-white py-5">
			<div class="container">
				<h2 class="mt-4">
					<span class="d-inline-block p-2 px-4 rounded-pill bg-primary text-white">SẢN PHẨM KHUYẾN MÃI</span>
				</h2>
				<div class="row">

                    <?php while ($list_product_sale->have_posts()) : $list_product_sale->the_post();
                        $ID             = get_the_ID();
                        $img            = get_the_post_thumbnail_url($ID, 'full');
                        $title          = get_the_title($ID);
                        $link           = get_permalink($ID);
                        $product        = wc_get_product($ID);
                        $max_percentage = parent::getProductPercentage($product);

                        ?>

	                    <div class="col-6 col-md-6 col-lg-4 col-xl-3">
		                    <div class="product-item rounded-3 overflow-hidden border mb-3 bg-white">
			                    <div class="box-img">
				                    <a href="http://wp-sinhnguyen.local/san-pham/ca-phe-phin-giay-drip-bag-coffee/" title="CÀ PHÊ PHIN GIẤY (Hộp)">
					                    <img src="http://wp-sinhnguyen.local/wp-content/uploads/2020/06/IMG_7311-scaled.jpg" alt="CÀ PHÊ PHIN GIẤY (Hộp)">
				                    </a>
			                    </div>

			                    <div class="info p-3 bg-white">
				                    <h3 class="title">
					                    <a href="http://wp-sinhnguyen.local/san-pham/ca-phe-phin-giay-drip-bag-coffee/" title="CÀ PHÊ PHIN GIẤY (Hộp)">
						                    CÀ PHÊ PHIN GIẤY (Hộp) </a>
				                    </h3>

				                    <div class="price">
					                    <del>120,000&#8363;</del>
					                    <ins class="text-decoration-none">
						                    <strong>100,000&#8363;</strong>
					                    </ins>
				                    </div>

				                    <div class="sale-off">
					                    17%
				                    </div>

			                    </div>
		                    </div>
	                    </div>
<!--						<div class="col-6 col-md-6 col-lg-4 col-xl-3">-->
<!--							<div class="product-item rounded-3 overflow-hidden border mb-3 bg-white">-->
<!--								<div class="box-img">-->
<!--									<a href="--><?php //= $link ?><!--" title="--><?php //= $title ?><!--">-->
<!--										<img src="--><?php //= $img ?><!--" alt="--><?php //= $title ?><!--">-->
<!--									</a>-->
<!--								</div>-->
<!---->
<!--								<div class="info p-3 bg-white">-->
<!--									<h3 class="title">-->
<!--										<a href="--><?php //= $link ?><!--" title="--><?php //= $title ?><!--">-->
<!--                                            --><?php //= $title ?>
<!--										</a>-->
<!--									</h3>-->
<!---->
<!--                                    --><?php //if ($max_percentage > 0): ?>
<!--										<div class="price">-->
<!--											<del>--><?php //= number_format($product->get_regular_price()) . get_woocommerce_currency_symbol(); ?><!--</del>-->
<!--											<ins class="text-decoration-none">-->
<!--												<strong>--><?php //= number_format($product->get_sale_price()) . get_woocommerce_currency_symbol(); ?><!--</strong>-->
<!--											</ins>-->
<!--										</div>-->
<!---->
<!--										<div class="sale-off">-->
<!--                                            --><?php //= ceil($max_percentage) ?><!--%-->
<!--										</div>-->
<!--                                    --><?php
//									elseif (!empty($product->get_regular_price())):
//                                        ?>
<!--										<div class="price">-->
<!--											<ins class="text-decoration-none">-->
<!--												<strong>--><?php //= number_format($product->get_regular_price()) . get_woocommerce_currency_symbol(); ?><!--</strong>-->
<!--											</ins>-->
<!--										</div>-->
<!--                                    --><?php //else: ?>
<!--										<div class="price">-->
<!--											<ins class="text-decoration-none">-->
<!--												<strong>--><?php //= __('Liên hệ', 'tinhdev') ?><!--</strong>-->
<!--											</ins>-->
<!--										</div>-->
<!--                                    --><?php //endif; ?>
<!---->
<!--								</div>-->
<!--							</div>-->
<!--						</div>-->
                    <?php endwhile;
                    wp_reset_query();
                    wp_reset_postdata();
                    ?>
				</div>
			</div>
		</section>
		<section class="section-product bg-light py-5">
			<div class="container">
				<h2 class="mt-4">
					<span class="d-inline-block p-2 px-4 rounded-pill bg-primary text-white">SẢN PHẨM NỔI BẬT</span>
				</h2>
				<div class="row">

                    <?php while ($list_product_featured->have_posts()) : $list_product_featured->the_post();
                        $ID             = get_the_ID();
                        $img            = get_the_post_thumbnail_url($ID, 'full');
                        $title          = get_the_title($ID);
                        $link           = get_permalink($ID);
                        $product        = wc_get_product($ID);
                        $max_percentage = parent::getProductPercentage($product);

                        ?>

	                    <div class="col-6 col-md-6 col-lg-4 col-xl-3">
		                    <div class="product-item rounded-3 overflow-hidden border mb-3 bg-white">
			                    <div class="box-img">
				                    <a href="http://wp-sinhnguyen.local/san-pham/ca-phe-phin-giay-drip-bag-coffee/" title="CÀ PHÊ PHIN GIẤY (Hộp)">
					                    <img src="http://wp-sinhnguyen.local/wp-content/uploads/2020/06/IMG_7311-scaled.jpg" alt="CÀ PHÊ PHIN GIẤY (Hộp)">
				                    </a>
			                    </div>

			                    <div class="info p-3 bg-white">
				                    <h3 class="title">
					                    <a href="http://wp-sinhnguyen.local/san-pham/ca-phe-phin-giay-drip-bag-coffee/" title="CÀ PHÊ PHIN GIẤY (Hộp)">
						                    CÀ PHÊ PHIN GIẤY (Hộp) </a>
				                    </h3>

				                    <div class="price">
					                    <del>120,000&#8363;</del>
					                    <ins class="text-decoration-none">
						                    <strong>100,000&#8363;</strong>
					                    </ins>
				                    </div>

				                    <div class="sale-off">
					                    17%
				                    </div>

			                    </div>
		                    </div>
	                    </div>
<!--						<div class="col-6 col-md-6 col-lg-4 col-xl-3">-->
<!--							<div class="product-item rounded-3 overflow-hidden border mb-3 bg-white">-->
<!--								<div class="box-img">-->
<!--									<a href="--><?php //= $link ?><!--" title="--><?php //= $title ?><!--">-->
<!--										<img src="--><?php //= $img ?><!--" alt="--><?php //= $title ?><!--">-->
<!--									</a>-->
<!--								</div>-->
<!---->
<!--								<div class="info p-3 bg-white">-->
<!--									<h3 class="title">-->
<!--										<a href="--><?php //= $link ?><!--" title="--><?php //= $title ?><!--">-->
<!--                                            --><?php //= $title ?>
<!--										</a>-->
<!--									</h3>-->
<!---->
<!--                                    --><?php //if ($max_percentage > 0): ?>
<!--										<div class="price">-->
<!--											<del>--><?php //= number_format($product->get_regular_price()) . get_woocommerce_currency_symbol(); ?><!--</del>-->
<!--											<ins class="text-decoration-none">-->
<!--												<strong>--><?php //= number_format($product->get_sale_price()) . get_woocommerce_currency_symbol(); ?><!--</strong>-->
<!--											</ins>-->
<!--										</div>-->
<!---->
<!--										<div class="sale-off">-->
<!--                                            --><?php //= ceil($max_percentage) ?><!--%-->
<!--										</div>-->
<!--                                    --><?php
//									elseif (!empty($product->get_regular_price())):
//                                        ?>
<!--										<div class="price">-->
<!--											<ins class="text-decoration-none">-->
<!--												<strong>--><?php //= number_format($product->get_regular_price()) . get_woocommerce_currency_symbol(); ?><!--</strong>-->
<!--											</ins>-->
<!--										</div>-->
<!--                                    --><?php //else: ?>
<!--										<div class="price">-->
<!--											<ins class="text-decoration-none">-->
<!--												<strong>--><?php //= __('Liên hệ', 'tinhdev') ?><!--</strong>-->
<!--											</ins>-->
<!--										</div>-->
<!--                                    --><?php //endif; ?>
<!---->
<!--								</div>-->
<!--							</div>-->
<!--						</div>-->
                    <?php endwhile;
                    wp_reset_query();
                    wp_reset_postdata();
                    ?>
				</div>

			</div>
		</section>
        <?php
    }
}