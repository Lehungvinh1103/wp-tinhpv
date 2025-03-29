<?php

namespace TinhDev\components;

use TinhDev\base\Base;
use TinhDev\base\BaseInterface;
use WP_Query;

class Slider extends Base implements BaseInterface{

    /**
     * @return mixed|void
     */
    public static function render(){
        $slider = get_field('slider', 'option');
        ?>
		<div class="slider">
			<div class="d-flex flex-wrap">
				<div class="slide-left border-top border-primary">
                    <?= do_shortcode($slider['slide']) ?>
				</div>
				<div class="slide-right">
					<div class="d-flex flex-wrap">
                        <?php foreach ($slider['informations'] as $item): ?>
							<div class="box-content">
								<img class="w-100" src="<?= $item['image'] ?>" alt="<?= $item['link']['title'] ?>">
								<a href="<?= $item['link']['url'] ?>" class="rounded-0">
                                    <?= $item['link']['title'] ?>
								</a>
							</div>
                        <?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
    <?php }
}