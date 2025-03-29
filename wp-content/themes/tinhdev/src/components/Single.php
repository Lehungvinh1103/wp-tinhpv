<?php

namespace TinhDev\components;

use TinhDev\base\Base;
use TinhDev\base\BaseInterface;
use WP_Query;
use TinhDev\components\Sidebar;

class Single extends Base implements BaseInterface{

    /**
     * @return mixed
     */
    public static function render(){

        $args_related = [
            'category__in'   => wp_get_post_categories(get_the_ID()),
            'posts_per_page' => 6,
            'post__not_in'   => [get_the_ID()]
        ];

        $list_posts_related = new WP_Query($args_related);
        $banner = get_field('banner', get_the_ID());
        ?>

		<div class="box-banner-post" style="background-image:url(<?= $banner ?>)"></div>
		<div class="section-single section-page">
			<div class="title-breadcrumb text-center bg-light py-5">
				<h1 class="">
                    <?php the_title(); ?>
				</h1>
				<div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
                    <?php if (function_exists('bcn_display')){
                        bcn_display();
                    } ?>
				</div>
			</div>
			<div class="py-5">
				<div class="container">

					<div class="row">
						<div class="col-xl-9">
							<div class="fb-like" data-href="<?php the_permalink(); ?>" data-width="" data-layout="standard" data-action="like" data-size="small" data-share="true"></div>
							<hr>
							<div class="text-justify">
                                <?php the_content(); ?>

							</div>

                            <?php if ($list_posts_related->have_posts()): ?>
								<h6 class="title-dancing mt-5">Bài liên quan </h6>
								<div class="row list-post list-post-vertical">
                                    <?php
                                    while ($list_posts_related->have_posts()) :global $post;
                                        $list_posts_related->the_post();
                                        setup_postdata($post);
                                        $ID      = get_the_ID();
                                        $post    = setup_postdata($ID);
                                        $img     = get_the_post_thumbnail_url($ID, 'large');
                                        $title   = get_the_title($ID);
                                        $link    = get_permalink($ID);
                                        $excerpt = get_the_excerpt($ID); ?>
										<div class="col-lg-4">
											<div class="post-item border rounded shadow bg-white mb-3 mb-lg-2">
												<a href="<?= $link ?>" title="<?= $title ?>" class="d-flex flex-wrap">
                                                    <?php if (!empty($img)): ?>
														<span class="box-img d-block">
														<img class="img-fluid" width="320" height="190" src="<?= $img ?>" alt="<?= $title ?>">
													</span>
														<div class="info p-3">
															<h3 class="title"><?= $title ?></h3>
															<p class="expert"><?= $excerpt ?></p>
														</div>
                                                    <?php else: ?>
														<div class="info flex-grow-1 p-3">
															<h3 class="title "><?= $title ?></h3>
															<p class="expert"><?= $excerpt ?></p>
														</div>
                                                    <?php endif; ?>
												</a>
											</div>
										</div>
                                    <?php
                                    endwhile;

                                    wp_reset_postdata();
                                    wp_reset_query();
                                    ?>
								</div>
                            <?php endif; ?>
						</div>
						<div class="col-xl-3">
                            <?php Sidebar::render(); ?>
						</div>
					</div>

				</div>
			</div>
		</div>
    <?php }
}