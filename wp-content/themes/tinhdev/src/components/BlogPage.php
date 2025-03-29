<?php

namespace TinhDev\components;

use TinhDev\base\Base;
use TinhDev\base\BaseInterface;
use WP_Query;

class BlogPage extends Base implements BaseInterface{

    public static function render(){

        $home_post          = get_field('home_post', 'option');
        $args_post_vertical = [
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'offset'         => 0,
            'orderby'        => 'ID',
            'order'          => 'DESC',
            'posts_per_page' => 4,
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



		<div class="container mt-3">
		<div class="mb-3"><?php if (function_exists('bcn_display')){
                bcn_display();
            } ?></div>
		<div class="row">

		<div class="col-md-7">
			<h5 class="text-primary">Bài Viết Nổi Bật</h5>
            <?php
            while ($list_posts_vertical->have_posts()) : global $post;
                $list_posts_vertical->the_post();
                setup_postdata($post);
                $ID      = get_the_ID();
                $post    = setup_postdata($ID);
                $img     = get_the_post_thumbnail_url($ID, 'large');
                $title   = get_the_title($ID);
                $link    = get_permalink($ID);
                $excerpt = get_the_excerpt($ID);
                $date    = get_the_date('d/m/Y', $ID);
                $author  = get_the_author_meta('user_email');
                ?>

				<div class="post-item">
					<div class="post-img w-100">
						<img src="<?= $img ?>" alt="" class="">
					</div>
					<div class="text-primary">
                        <?= $date ?>
					</div>
					<div class="post-info w-100">

						<a href="<?= $link ?>" class="text-black title limit-2"><?= $title ?></a>
						<p class="excerpt "><?= $excerpt ?></p>
					</div>
				</div>

                <?php break;
            endwhile;
            ?>

			<div class="d-none d-lg-block">
				<div class="row border-top border-primary">
                    <?php
                    while ($list_posts_vertical->have_posts()) : global $post;
                        $list_posts_vertical->the_post();
                        setup_postdata($post);
                        $ID      = get_the_ID();
                        $post    = setup_postdata($ID);
                        $img     = get_the_post_thumbnail_url($ID, 'large');
                        $title   = get_the_title($ID);
                        $link    = get_permalink($ID);
                        $excerpt = get_the_excerpt($ID);
                        $date    = get_the_date('d/m/Y', $ID);
                        $author  = get_the_author_meta('user_email');
                        ?>
						<div class="col-md-4">
							<div class="post-item">
								<div class="text-primary"><?= $date ?></div>
								<div class="post-info">

									<a href="<?= $link ?>" class="title"><?= $title ?></a>
									<p class="excerpt limit-2"><?= $excerpt ?></p>
								</div>
							</div>
						</div>


                    <?php endwhile; ?>
				</div>
			</div>
		</div>


        <?php $home_post    = get_field('home_post', 'option');
        $args_post_vertical = [
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'offset'         => 0,
            'orderby'        => 'ID',
            'order'          => 'DESC',
            'posts_per_page' => 4,
            'tax_query'      => [
                [
                    'taxonomy' => 'category',
                    'field'    => 'term_id', //This is optional, as it defaults to 'term_id'
                    'terms'    => $home_post,
                    'operator' => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
                ]
            ]
        ];

        $list_posts_vertical = new WP_Query($args_post_vertical); ?>


		<div class="col-md-5">
			<h5 class="text-primary">Tin Tức Liên Quan</h5>


            <?php
            while ($list_posts_vertical->have_posts()) : global $post;
                $list_posts_vertical->the_post();
                setup_postdata($post);
                $ID      = get_the_ID();
                $post    = setup_postdata($ID);
                $img     = get_the_post_thumbnail_url($ID, 'large');
                $title   = get_the_title($ID);
                $link    = get_permalink($ID);
                $excerpt = get_the_excerpt($ID);
                $date    = get_the_date('d/m/Y', $ID);
                $author  = get_the_author_meta('user_email');
                ?>


				<div class="post-item mb-3">
					<div class="d-flex gap-2 ">
						<div class="post-img col-md-4">
							<img src="<?= $img ?>" class="img-fluid" alt="...">
						</div>
						<div class="post-info col-md-8">
							<div class="text-success"><?= $date ?></div>
							<a href="<?= $link ?>" class="title"><?= $title ?></a>
							<p class="excerpt limit-2">
                                <?= $excerpt ?>
							</p>
						</div>
					</div>

				</div>
            <?php endwhile ?>


		</div>


        <?php
        wp_reset_query();
        wp_reset_postdata();
        ?>


        <?php
    }
}
