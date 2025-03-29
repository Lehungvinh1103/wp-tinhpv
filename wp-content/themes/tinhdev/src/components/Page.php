<?php

namespace TinhDev\components;

use TinhDev\base\Base;
use TinhDev\base\BaseInterface;
use WP_Query;

class Page extends Base implements BaseInterface{

    /**
     * @return mixed
     */
    public static function render(){

        ?>
		<div class="box-banner-post" style="background-image:url(<?= get_the_post_thumbnail_url() ?>); height: 600px; background-attachment: unset"></div>

		<div class="section-page">
			<div class="title-breadcrumb py-5 text-center bg-light">
				<h1>
                    <?php the_title(); ?>
				</h1>
				<div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
                    <?php if (function_exists('bcn_display')){
                        bcn_display();
                    } ?>
				</div>
			</div>

			<div class="container">
				<div class="py-5">
                    <?php if (is_page('lien-he')):
                        $contact = get_field('contact', get_the_ID());
                        ?>
						<div class="contact-page">
							<div class="contact-slick">
                                <?php foreach ($contact['gallery'] as $item):
                                    ?>
									<div class="contact-item">
										<img class="w-100" src="<?= $item['url'] ?>" alt="">
									</div>
                                <?php endforeach; ?>
							</div>
							<div class="row">
								<div class="col-lg-6">
                                    <?php foreach ($contact['list_address'] as $item):
                                        ?>
										<div class="address">
											<h5 class="mt-5"><?= $item['name'] ?></h5>
											<a class="btn btn-primary" href="<?= $item['map'] ?>"><?= __('Chỉ đường',
                                                    'tinhdev') ?></a>
											<span><?= $item['address'] ?></span>

										</div>
                                    <?php endforeach; ?>
									<div class="bg-light border box-shadow p-3 mt-3 ">
                                        <?php the_content(); ?>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="rounded my-3">
                                        <?= do_shortcode('[gravityform id="1" title="true" description="true"]') ?>
									</div>
								</div>
							</div>
						</div>

                    <?php else: ?><?php the_content(); ?><?php endif; ?>

				</div>

			</div>
		</div>
        <?php
    }
}