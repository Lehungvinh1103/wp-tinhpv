<?php

namespace TinhDev\components;

use TinhDev\base\Base;
use TinhDev\base\BaseInterface;
use WP_Query;

class BlogStyleCarousel extends Base implements BaseInterface{

    public static function render(){
        $home_post = get_field('post', 'option');

        $argsPost = [
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'offset'         => 0,
            'orderby'        => [
                'date' => 'DESC',
            ],
            'posts_per_page' => 6,
            'tax_query'      => [
                [
                    'taxonomy' => 'category',
                    'field'    => 'term_id', //This is optional, as it defaults to 'term_id'
                    'terms'    => $home_post['category_2']->term_id,
                    'operator' => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
                ]
            ]
        ];

        $argsPost1    = [
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'offset'         => 0,
            'orderby'        => [
                'date' => 'DESC',
            ],
            'posts_per_page' => 6,
            'tax_query'      => [
                [
                    'taxonomy' => 'category',
                    'field'    => 'term_id', //This is optional, as it defaults to 'term_id'
                    'terms'    => $home_post['category_1']->term_id,
                    'operator' => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
                ]
            ]
        ];
        $list_posts   = new WP_Query($argsPost);
        $list_posts_1 = new WP_Query($argsPost1);
        if ($list_posts->have_posts()):
            ?>


			<section class="section-blog bg-light py-5">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 mb-3">
							<h2 class="section-title">
                                <?= $home_post['category_1']->name ?? '' ?>
							</h2>
							<div class="row">
                                <?php while ($list_posts_1->have_posts()) :
                                    global $post;
                                    $list_posts_1->the_post();
                                    setup_postdata($post);
                                    $ID      = get_the_ID();
                                    $post    = setup_postdata($ID);
                                    $img     = get_the_post_thumbnail_url($ID, 'large');
                                    $title   = get_the_title($ID);
                                    $link    = get_permalink($ID);
                                    $excerpt = get_the_excerpt($ID);
                                    $date    = get_the_date('d/m/Y', $ID); ?>
									<div class="col-lg-4">
										<div class="post-item mb-5">

                                            <?php if (!empty($img)): ?>
												<div class="box-img">
													<a href="<?= $link ?>" class="position-relative" title="<?= $title ?>">
														<img class="img-fluid" width="320" height="190" src="<?= $img ?>" alt="<?= $title ?>">
													</a>
												</div>
                                            <?php endif; ?>
											<div class="info mb-3 p-3">
												<h3 class="title mb-0"><?= $title ?></h3>
												<p><small class="text-dark"><?= $date ?></small>
												</p>
												<p class="expert"><?= $excerpt ?></p>
												<a
												<a href="<?= $link ?>" class="text-primary fw-bold">Chi tiết</a>
											</div>

										</div>
									</div>

                                <?php
                                endwhile;
                                wp_reset_query();
                                wp_reset_postdata();
                                ?>
							</div>
						</div>
						<div class="col-lg-8">
							<h2 class="section-title">
                                <?= $home_post['category_2']->name ?? '' ?>
							</h2>
							<div class="row">
                                <?php while ($list_posts->have_posts()) :
                                    global $post;
                                    $list_posts->the_post();
                                    setup_postdata($post);
                                    $ID      = get_the_ID();
                                    $post    = setup_postdata($ID);
                                    $img     = get_the_post_thumbnail_url($ID, 'large');
                                    $title   = get_the_title($ID);
                                    $link    = get_permalink($ID);
                                    $excerpt = get_the_excerpt($ID);
                                    $date    = get_the_date('d/m/Y', $ID); ?>
									<div class="col-lg-6">
										<div class="post-item mb-5">

                                            <?php if (!empty($img)): ?>
												<div class="box-img">
													<a href="<?= $link ?>" class="position-relative" title="<?= $title ?>">
														<img class="img-fluid" width="320" height="190" src="<?= $img ?>" alt="<?= $title ?>">
													</a>
												</div>
                                            <?php endif; ?>
											<div class="info mb-3 p-3">
												<h3 class="title mb-0"><a href="<?= $link ?>" ><?= $title ?></a></h3>
												<p><small class="text-dark"><?= $date ?></small>
												</p>
												<p class="expert"><?= $excerpt ?></p>
												<a href="<?= $link ?>" class="text-primary fw-bold">Chi tiết</a>
											</div>
										</div>
									</div>
                                <?php
                                endwhile;
                                wp_reset_query();
                                wp_reset_postdata();
                                ?>
							</div>
						</div>
						<div class="col-lg-4">
                            <?php
                            $argsPost   = [
                                'post_type'      => 'post',
                                'post_status'    => 'publish',
                                'offset'         => 0,
                                'orderby'        => [
                                    'date' => 'DESC',
                                ],
                                'posts_per_page' => 6,
                                'tax_query'      => [
                                    [
                                        'taxonomy' => 'category',
                                        'field'    => 'term_id', //This is optional, as it defaults to 'term_id'
                                        'terms'    => $home_post['category_3']->term_id,
                                        'operator' => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
                                    ]
                                ]
                            ];
                            $list_posts = new WP_Query($argsPost);
                            if ($list_posts->have_posts()): ?>
								<h5 class="section-title">
                                    <?= $home_post['category_3']->name ?? '' ?>
								</h5>
                                <?php while ($list_posts->have_posts()) :
                                    global $post;
                                    $list_posts->the_post();
                                    setup_postdata($post);
                                    $ID      = get_the_ID();
                                    $post    = setup_postdata($ID);
                                    $img     = get_the_post_thumbnail_url($ID, 'large');
                                    $title   = get_the_title($ID);
                                    $link    = get_permalink($ID);
                                    $excerpt = get_the_excerpt($ID);
                                    $date    = get_the_date('d/m/Y', $ID); ?>
									<div class="post-item post-item-vertical mb-1">
										<a href="<?= $link ?>" class="position-relative d-flex align-items-center" title="<?= $title ?>">
                                            <?php if (!empty($img)): ?>
												<div class="box-img">
													<img class="img-fluid" width="320" height="190" src="<?= $img ?>" alt="<?= $title ?>">
												</div>
                                            <?php endif; ?>
											<div class="info mb-3 p-3">
												<h3 class="title mb-0"><a href="<?= $link ?>" ><?= $title ?></a></h3>
												<p><small class="text-dark"><?= $date ?></small>
												</p>
											</div>
										</a>
									</div>

                                <?php
                                endwhile;
                                wp_reset_query();
                                wp_reset_postdata();
                                ?><?php endif;
                            $args = [
                                'post_type'      => 'product',
                                'meta_key'       => 'total_sales',
                                'orderby'        => 'meta_value_num',
                                'posts_per_page' => 6,
                            ];
                            $loop = new WP_Query($args);
                            if ($loop->have_posts()):
                                ?>
								<h5 class="section-title">
									Sản phẩm bán chạy </h5>

                                <?php while ($loop->have_posts()) : $loop->the_post();
                                $ID             = get_the_ID();
                                $img            = get_the_post_thumbnail_url($ID, 'full');
                                $title          = get_the_title($ID);
                                $link           = get_permalink($ID);
                                $product        = wc_get_product($ID);
                                $max_percentage = parent::getProductPercentage($product);
                                $terms          = get_the_terms($ID, 'product_cat');

                                ?>
								<div class="product-item border-bottom pb-3 product-item-vertical d-flex mb-3 bg-white">
									<div class="box-img">
										<a href="<?= $link ?>" title="<?= $title ?>">
											<img src="<?= $img ?>" alt="<?= $title ?>">
										</a>
									</div>

									<div class="info px-3 py-1 bg-white">
										<h3 class="title">
											<a href="<?= $link ?>" title="<?= $title ?>">
                                                <?= $title ?>
											</a>
										</h3>
										<div class="d-flex">
                                            <?php if ($max_percentage > 0): ?>
												<div class="price">
													<del><?= number_format((int) $product->get_regular_price() ?? 0) . get_woocommerce_currency_symbol(); ?></del>
													<ins class="text-decoration-none">
														<strong><?= number_format((int) $product->get_regular_price() ?? 0) . get_woocommerce_currency_symbol(); ?></strong>
													</ins>
												</div>

												<div class="sale-off">
                                                    <?= round($max_percentage) ?>%
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

									</div>
								</div>
                            <?php endwhile; ?>

                            <?php endif; ?>
						</div>
					</div>
				</div>
			</section>
        <?php
        endif;
    }
}