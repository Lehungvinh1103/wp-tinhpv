<?php

namespace TinhDev\components;

use TinhDev\base\Base;
use TinhDev\base\BaseInterface;
use WP_Query;

class BlogGallery extends Base implements BaseInterface{

    public static function render(){
        $home_post_media     = get_field('home_post_media', 'option');
        $home_post_vertical  = get_field('home_post_vertical', 'option');
        $args_post_vertical  = [
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'offset'         => 0,
            'orderby'        => 'ID',
            'order'          => 'DESC',
            'posts_per_page' => 5,
            'tax_query'      => [
                [
                    'taxonomy' => 'category',
                    'field'    => 'term_id', //This is optional, as it defaults to 'term_id'
                    'terms'    => $home_post_vertical->term_id,
                    'operator' => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
                ]
            ]
        ];
        $args_post_media     = [
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'offset'         => 0,
            'orderby'        => 'ID',
            'order'          => 'DESC',
            'posts_per_page' => 5,
            'tax_query'      => [
                [
                    'taxonomy' => 'category',
                    'field'    => 'term_id', //This is optional, as it defaults to 'term_id'
                    'terms'    => $home_post_media->term_id,
                    'operator' => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
                ]
            ]
        ];
        $list_posts_vertical = new WP_Query($args_post_vertical);
        $list_posts_media    = new WP_Query($args_post_media);

        ?>
		<div class="post-gallery py-5">
			<div class="container">
				<div class="row">
                    <?php if ($list_posts_vertical->have_posts()): ?>
						<div class="col-lg-5">
							<h2 class="title-dancing text-center my-3">
                                <?= $home_post_vertical->name ?>
							</h2>

							<div class="list-post list-post-vertical">
                                <?php
                                while ($list_posts_vertical->have_posts()) :global $post;
                                    $list_posts_vertical->the_post();
                                    setup_postdata($post);
                                    $ID      = get_the_ID();
                                    $post    = setup_postdata($ID);
                                    $img     = get_the_post_thumbnail_url($ID, 'large');
                                    $title   = get_the_title($ID);
                                    $link    = get_permalink($ID);
                                    $excerpt = get_the_excerpt($ID);
                                    $date    = get_the_date('d/m/Y', $ID); ?>
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
													<h3 class="title py-2"><?= $title ?></h3>
													<p class="expert"><?= $excerpt ?></p>
												</div>
                                            <?php endif; ?>
										</a>
									</div>
                                <?php
                                endwhile;
                                wp_reset_query();
                                wp_reset_postdata();
                                ?>
							</div>
						</div>
                    <?php endif; ?>

                    <?php if ($list_posts_media->have_posts()): ?>

						<div class="col-lg-7">
							<h2 class="title-dancing text-center my-3">
                                <?= $home_post_media->name ?>
							</h2>
							<div class="list-post flex-wrap list-post-media row">
                                <?php
                                $key = 1;
                                while ($list_posts_media->have_posts()) :global $post;
                                    $list_posts_media->the_post();
                                    setup_postdata($post);
                                    $ID    = get_the_ID();
                                    $post  = setup_postdata($ID);
                                    $img   = get_the_post_thumbnail_url($ID, 'large');
                                    $title = get_the_title($ID);
                                    $link  = get_permalink($ID);
                                    ?><?php if ($key == 1): ?>
										<div class="mb-4 col-12">
											<a href="<?= $link ?>" title="<?= $title ?>" class="d-flex flex-wrap position-relative post-item">
                                                <?php if (!empty($img)): ?>
													<span class="box-img d-block">
														<img class="img-fluid" width="320" height="190" src="<?= get_the_post_thumbnail_url($ID,
                                                            'full') ?>" alt="<?= $title ?>">
													</span>
													<span class="info">
														<h3 class="title text-white py-2"><?= $title ?></h3>
														<span class="view-more"><i class="fa-solid fa-arrow-right"></i><span>XEM THÊM</span>
													</span>
                                                </span>
                                                <?php endif; ?>
											</a>
										</div>
                                    <?php else: ?>
										<div class="col-12 mb-4 col-lg-6">
											<a class="post-item d-flex flex-wrap position-relative" href="<?= $link ?>" title="<?= $title ?>">
                                                <?php if (!empty($img)): ?>
													<span class="box-img d-block">
														<img class="img-fluid" width="320" height="190" src="<?= $img ?>" alt="<?= $title ?>">
													</span>
													<span class="info"><h3 class="title text-white"><?= $title ?></h3></span>
                                                <?php endif; ?>
											</a>
										</div>

                                    <?php endif; ?><?php
                                    $key ++;
                                endwhile;
                                ?>
							</div>
						</div>
                    <?php endif; ?>
				</div>
			</div>
		</div>
        <?php
    }
}