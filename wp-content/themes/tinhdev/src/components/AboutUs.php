<?php

namespace TinhDev\components;

use TinhDev\base\Base;
use TinhDev\base\BaseInterface;

class AboutUs extends Base implements BaseInterface{

    /**
     * @return mixed|void
     */
    public static function render(){
        $about_us = get_field('about', 'option');

        if (!empty($about_us)):
            ?>
			<section class="about-us slider" style="background-image: url('<?= $about_us['background'] ?>')">
				<div class="d-flex flex-wrap">
					<div class="slide-left py-5">
						<div class="container-fluid">
							<div class="py-4">
								<h4 class="title text-center text-uppercase "><?= $about_us['title'] ?></h4>
								<p class="description">
                                    <?= $about_us['description'] ?>
								</p>
							</div>
							<div class="text-center">
								<a class="btn btn-primary rounded-pill text-white" href="<?= $about_us['url']['url'] ?>"><?= $about_us['url']['title'] ?></a>
							</div>
						</div>
					</div>
					<div class="slide-right">
						<div class="d-flex flex-wrap">
                            <?php foreach ($about_us['informations'] as $key => $item): ?>
								<div class="box-content <?= $key == 1 ? 'light' : '' ?>">
									<img class="w-100" src="<?= $item['image'] ?>" alt="<?= $item['link']['title'] ?>">
									<a href="<?= $item['link']['url'] ?>" class="rounded-0">
                                        <?= $item['link']['title'] ?>
									</a>
								</div>
                            <?php endforeach; ?>
						</div>
					</div>
				</div>
			</section>
        <?php
        endif;
    }
}