<?php

namespace TinhDev\components;

use TinhDev\base\Base;
use TinhDev\base\BaseInterface;
use TinhDev\base\bootstrap_5_wp_nav_menu_walker;
use WP_Query;

class Sidebar extends Base implements BaseInterface{

    public static function render(){
        $home_post = get_field('sidebar_post', 'option');

        $args_post_vertical = [
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'offset'         => 0,
            'orderby'        => 'ID',
            'order'          => 'DESC',
            'posts_per_page' => 10,
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
		<div class="mb-5">
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
                ?>
				<div class="post-item post-item-sidebar mb-2">
					<div class="d-flex gap-2">
						<div class="post-img">
							<a href="<?= $link ?>" title="<?= $title ?>">
								<img src="<?= $img ?>" width="100" alt="<?= $title ?>">
							</a>
						</div>
						<div class="post-info">
							<small class="text-success"><?= $date ?></small>
							<a href="<?= $link ?>" title="<?= $title ?>" class="title"><?= $title ?> </a>
						</div>
					</div>
				</div>
                <?php
            endwhile;
            ?>
		</div>
        <?php
    }
}