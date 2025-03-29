<?php

namespace TinhDev\components;

use TinhDev\base\Base;
use TinhDev\base\BaseInterface;
use WP_Query;

class ArchiveProduct extends Base implements BaseInterface{

    /**
     * @return mixed|void
     */
    public static function render(){
        ?>
		<div class="section-product archive-product ">
			<div class="box-title-breadcrumb bg-primary py-5 text-center text-white">
				<h1 class="title-dancing text-center">
                    <?php the_archive_title(); ?>
				</h1>
                <?php the_archive_description(); ?>
			</div>
			<div class="container mt-5">
				<div class="row">
                    <?php if (have_posts()): while (have_posts()) : the_post();
                        $ID             = get_the_ID();
                        $img            = get_the_post_thumbnail_url($ID, 'full');
                        $title          = get_the_title($ID);
                        $link           = get_permalink($ID);
                        $product        = wc_get_product($ID);
                        $max_percentage = parent::getProductPercentage($product);
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

                    <?php
                    endwhile; ?>
						<div class="col-12 mt-5">
                            <?php wp_pagenavi(); ?>
						</div>
                    <?php endif; ?>
				</div>
			</div>
		</div>
    <?php }
}