<?php

namespace TinhDev\components;

use TinhDev\base\Base;
use TinhDev\base\BaseInterface;
use WP_Query;

class BlogDefault extends Base implements BaseInterface{

    public static function render(){
        $home_post          = get_field('home_post', 'option');
        $args_post_vertical = [
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'offset'         => 0,
            'orderby'        => 'ID',
            'order'          => 'DESC',
            'posts_per_page' => 3,
            'tax_query'      => [
                [
                    'taxonomy' => 'category',
                    'field'    => 'term_id', //This is optional, as it defaults to 'term_id'
                    'terms'    => $home_post,
                    'operator' => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
                ]
            ]
        ];

        $list_posts_vertical = new WP_Query($args_post_vertical);

        ?>

		<div class="bg-white">
			<div class="container py-3 mb-3">
				<div class="d-flex justify-content-center align-items-center mb-3">
					<div class="intro-section">
						<h3 class="fw-bold text-center"><?= __('TIN TỨC HOẠT ĐỘNG',
                                'tinhdev') ?></h3>
						<div class="d-flex justify-content-center">
							<div class="contact_title_line">
								<img src="wp-content/themes/tinhdev/src/assets/images/logo_title.svg" alt="" class="logo-image">
							</div>
						</div>
					</div>
				</div>
				<div class="home-posts row ">
                    <?php
                    while ($list_posts_vertical->have_posts()) : global $post;
                        $list_posts_vertical->the_post();
                        setup_postdata($post);
                        $ID      = get_the_ID();
                        $post    = setup_postdata($ID);
                        $img     = get_the_post_thumbnail_url($ID, 'full');
                        $title   = get_the_title($ID);
                        $link    = get_permalink($ID);
                        $excerpt = get_the_excerpt($ID);
                        $date    = get_the_date('d/m/Y', $ID);
                        $author  = get_the_author_meta('user_email');
                        ?>
						<div class="col-md-7">
							<div class="post-item post-item-big mb-2">
								<div class="d-flex gap-2 ">
									<div class="post-img">
										<a href="<?= $link ?>" title="<?= $title ?>">
											<img src="<?= $img ?>" class="img-fluid h-100 object-fit-cover " alt="<?= $title ?>">
										</a>
									</div>
									<div class="post-info">
										<p class="text-success"><?= $date ?></p>
										<a href="<?= $link ?>" title="<?= $title ?>" class="title"><?= $title ?> </a>
										<p class="excerpt">
                                            <?= $excerpt ?>
										</p>
									</div>
								</div>
							</div>
						</div>
                        <?php
                        break;
                    endwhile;
                    ?>
					<div class="col-md-5">
                        <?php
                        while ($list_posts_vertical->have_posts()) : global $post;
                            $list_posts_vertical->the_post();
                            setup_postdata($post);
                            $ID      = get_the_ID();
                            $post    = setup_postdata($ID);
                            $img     = get_the_post_thumbnail_url($ID, 'full');
                            $title   = get_the_title($ID);
                            $link    = get_permalink($ID);
                            $excerpt = get_the_excerpt($ID);
                            $date    = get_the_date('d/m/Y', $ID);
                            $author  = get_the_author_meta('user_email');
                            ?>
							<div class="post-item mb-2">
								<div class="d-flex gap-2 ">
									<div class="post-img img-right col-md-4">
										<a href="<?= $link ?>" title="<?= $title ?>">
											<img src="<?= $img ?>" class="img-fluid" alt="<?= $title ?>">
										</a>
									</div>
									<div class="post-info col-md-8">
										<p class="text-success"><?= $date ?></p>
										<a href="<?= $link ?>" title="<?= $title ?>" class="title"><?= $title ?> </a>
										<p class="excerpt limit-2">
                                            <?= $excerpt ?>
										</p>
									</div>
								</div>
							</div>
                        <?php
                        endwhile;
                        ?>
					</div>
				</div>
			</div>
		</div>
        <?php
    }
}
