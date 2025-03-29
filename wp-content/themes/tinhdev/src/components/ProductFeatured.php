<?php

namespace TinhDev\components;

use TinhDev\base\Base;
use TinhDev\base\BaseInterface;
use TinhDev\base\bootstrap_5_wp_nav_menu_walker;
use WP_Query;
use TinhDev\components\Sidebar;

class ProductFeatured extends Base implements BaseInterface{

    public static function render(){
        $args         = [
            'posts_per_page' => 50, // Grabs all of the featured products. Limit if needed
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
        $list_product = new WP_Query($args);
        if ($list_product->have_posts()): ?>
			<section class="section-product bg-white about-us py-5">
				<div class="container rounded py-3">
					<div class=" text-center">
						<h2 class="title">Sản phẩm nổi bật</h2>
					</div>

					<div class="list-product row">
                        <?php while ($list_product->have_posts()) : $list_product->the_post();
                            $ID             = get_the_ID();
                            $img            = get_the_post_thumbnail_url($ID, 'full');
                            $title          = get_the_title($ID);
                            $link           = get_permalink($ID);
                            $product        = wc_get_product($ID);
                            $max_percentage = parent::getProductPercentage($product);
                            $terms          = get_the_terms($ID, 'product_cat');

                            ?>
							<div class="col-6 col-sm-4 col-lg-3">
								<div class="product-item mb-3 bg-white">
									<div class="box-img">
										<a href="<?= $link ?>" title="<?= $title ?>">
											<img src="<?= $img ?>" alt="<?= $title ?>">
										</a>
									</div>

									<div class="info bg-white">
										<small class="text-primary">
                                            <?php
                                            foreach ($terms as $term){
                                                echo $term->name;
                                                break;
                                            }
                                            ?>
										</small>
										<h3 class="title text-center">
											<a href="<?= $link ?>" title="<?= $title ?>">
                                                <?= $title ?>
											</a>
										</h3>
										<div class="d-flex justify-content-center">
                                            <?php if ($max_percentage > 0): ?>
												<div class="price">
													<del><?= number_format($product->get_regular_price()) . get_woocommerce_currency_symbol(); ?></del>
													<ins class="text-decoration-none">
														<strong><?= number_format($product->get_sale_price()) . get_woocommerce_currency_symbol(); ?></strong>
													</ins>
												</div>

												<div class="sale-off">
                                                    <?= round($max_percentage) ?>%
												</div>
                                            <?php elseif ($product->get_regular_price() != 0): ?>
												<div class="price">
													<ins class="text-decoration-none">
														<strong><?= number_format((int) $product->get_regular_price()) . get_woocommerce_currency_symbol(); ?></strong>
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

									</div>
								</div>
							</div>
                        <?php endwhile; ?>
					</div>
				</div>
			</section>
        <?php endif;
    }
}
?>