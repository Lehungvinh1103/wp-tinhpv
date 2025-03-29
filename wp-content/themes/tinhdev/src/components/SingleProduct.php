<?php

namespace TinhDev\components;

use TinhDev\base\Base;
use TinhDev\base\BaseInterface;
use WP_Query;

class SingleProduct extends Base implements BaseInterface{

    /**
     * @return mixed
     */
    public static function render(){
        global $product;
        if (is_woocommerce() || is_search()){
            $product = wc_get_product(get_the_ID());
        }
        $product_info = get_field('product_info', 'option');
        $args         = [
            'category__in'   => wp_get_post_categories(get_the_ID()),
            'posts_per_page' => 8,
            'post_type'      => 'product', // Ensures the post type is a product
            'post_status'    => 'publish', // Ensures the product is published
            'post__not_in'   => [get_the_ID()]
        ];


        ?>
		<section class="single-product py-5 section-product">
			<div class="container">
				<div class="row flex-row-reverse flex-lg-row">

					<div class="col-lg-12">
						<div class="breadcrumbs py-3">
                            <?php if (function_exists('bcn_display')){
                                bcn_display();
                            } ?>
						</div>

						<div id="thong-tin" class="text-justify">
                            <?php wc_get_template_part('content', 'single-product'); ?>
						</div>
					</div>

					<div class="col-lg-12">

                        <?php $list_product = new WP_Query($args);
                        if ($list_product->have_posts()): ?>
							<h2 class="title-dancing ">Sản phẩm liên quan</h2>
							<div class="list-product row related-product">
                                <?php while ($list_product->have_posts()) : $list_product->the_post();
                                    $ID    = get_the_ID();
                                    $img   = get_the_post_thumbnail_url($ID, 'full');
                                    $title = get_the_title($ID);
                                    $link  = get_permalink($ID);

                                    $product        = wc_get_product($ID);
                                    $max_percentage = parent::getProductPercentage($product)
                                    ?>
	                                <div class="col-6 col-sm-4 col-lg-6">
		                                <div class="product-item mb-5 bg-white">
			                                <div class="box-img">
				                                <a href="<?= $link ?>" title="<?= $title ?>">
					                                <img src="<?= $img ?>" alt="<?= $title ?>">
				                                </a>
			                                </div>

			                                <div class="info bg-white text-center">
				                                <h3 class="title text-center">
					                                <a href="<?= $link ?>" title="<?= $title ?>">
                                                        <?= $title ?>
					                                </a>
				                                </h3>
				                                <div class="d-flex justify-content-center">
                                                    <?php if ($max_percentage > 0): ?>
						                                <div class="price">
							                                <del><?= number_format($product->get_regular_price() ?? 0) . get_woocommerce_currency_symbol(); ?></del>
							                                <ins class="text-decoration-none">
								                                <strong><?= number_format($product->get_regular_price() ?? 0) . get_woocommerce_currency_symbol(); ?></strong>
							                                </ins>
						                                </div>

                                                    <?php elseif ($product->get_regular_price() != 0): ?>
						                                <div class="price">
							                                <ins class="text-decoration-none">
								                                <strong><?= number_format((int) $product->get_regular_price(),
                                                                        0, ',',
                                                                        '.') . get_woocommerce_currency_symbol(); ?></strong>
							                                </ins>
						                                </div>
                                                    <?php else: ?>
						                                <div class="price">
							                                <ins class="text-decoration-none">
								                                <strong><?= __('Liên hệ',
                                                                        'tinhdev') ?></strong>
							                                </ins>
						                                </div>
                                                    <?php endif; ?>
				                                </div>
				                                <a href="<?= $link ?>" class="btn mt-3 py-2 px-5 btn-primary rounded-0 text-white m-auto">
					                                XEM THÊM
				                                </a>
			                                </div>
		                                </div>
	                                </div>

                                <?php endwhile; ?>
							</div>
                        <?php endif; ?>
					</div>
				</div>
			</div>
		</section>
        <?php
    }
}