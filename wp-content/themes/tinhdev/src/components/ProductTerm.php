<?php

namespace TinhDev\components;

use TinhDev\base\Base;
use TinhDev\base\BaseInterface;
use WP_Query;

class ProductTerm extends Base implements BaseInterface{

    public static function render(){
        $products             = get_field('products', 'option');
        if (!empty($products)):
            foreach ($products as $product):
                $args = [
                    'posts_per_page' => 10, // Grabs all of the featured products. Limit if needed
                    'post_type'      => 'product', // Ensures the post type is a product
                    'post_status'    => 'publish', // Ensures the product is published
                    'tax_query'      => [
                        [
                            'taxonomy' => 'product_cat', // Does a meta query on product visibility
                            'field'    => 'term_id', //This is optional, as it defaults to 'term_id'
                            'terms'    => $product['term']->term_id,
                            'operator' => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
                        ],
                    ]
                ];
                $list_product = new WP_Query($args);
                ?>
				<section class="section-product bg-light">
					<div class="container">
						<div class="section-title pe-2 d-flex justify-content-between align-items-center">
							<div class="box-icon">
								<img src="<?= $product['icon'] ?>" alt="<?= $product['term']->name ?? '' ?>">
							</div>
							<h5 class="term-name">
                                <?= $product['term']->name ?? '' ?>
							</h5>
							<a href="<?= get_category_link($product['term']->term_id) ?>" title="<?= $product['term']->name ?? '' ?>" class="viewmore">
								Xem thêm
							</a>
						</div>
						<div class="banner">
							<div class="box-icon">
								<a href="<?= $product['link_banner']['url'] ?>" title="<?= $product['link_banner']['title'] ?>">
									<img class="w-100" src="<?= $product['banner'] ?>" alt="<?= $product['term']->name ?? '' ?>">
								</a>
							</div>
						</div>
						<div class="list-product pb-3 d-flex flex-wrap">
                            <?php while ($list_product->have_posts()) : $list_product->the_post();
                                $ID             = get_the_ID();
                                $img            = get_the_post_thumbnail_url($ID, 'full');
                                $title          = get_the_title($ID);
                                $link           = get_permalink($ID);
                                $product        = wc_get_product($ID);
                                $max_percentage = parent::getProductPercentage($product);
                                ?>
								<div class="product-item bg-white">
									<div class="box-img">
										<a href="<?= $link ?>" title="<?= $title ?>">
											<img src="<?= $img ?>" alt="<?= $title ?>">
										</a>
									</div>

									<div class="info position-relative bg-white">
										<h3 class="title">
											<a href="<?= $link ?>" title="<?= $title ?>">
                                                <?= $title ?>
											</a>
										</h3>

                                        <?php if ($max_percentage > 0): ?>
											<div class="price">
												<del><?= number_format($product->get_regular_price()) . get_woocommerce_currency_symbol(); ?></del>
												<ins class="text-decoration-none">
													<strong><?= number_format($product->get_sale_price()) . get_woocommerce_currency_symbol(); ?></strong>
												</ins>
											</div>

											<div class="sale-off">
                                                <?= $max_percentage ?>%
											</div>
                                        <?php elseif ($product->get_regular_price() != 0): ?>
											<div class="price">
												<ins class="text-decoration-none">
													<strong><?= number_format($product->get_regular_price()) . get_woocommerce_currency_symbol(); ?></strong>
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
										<div class="rating text-secondary">
											<i class="fa-solid fa-star" aria-hidden="true"></i>
											<i class="fa-solid fa-star" aria-hidden="true"></i>
											<i class="fa-solid fa-star" aria-hidden="true"></i>
											<i class="fa-solid fa-star" aria-hidden="true"></i>
											<i class="fa-solid fa-star" aria-hidden="true"></i>
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
            <?php
            endforeach;
        endif;
    }
}