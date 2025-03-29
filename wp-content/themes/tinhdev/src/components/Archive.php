<?php

namespace TinhDev\components;

use TinhDev\base\Base;
use TinhDev\base\BaseInterface;
use TinhDev\components\Sidebar;

class Archive extends Base implements BaseInterface{

    /**
     * @return mixed
     */
    public static function render(){ ?>
		<div class="archive py-5">
			<div class="box-title-breadcrumb">
				<h1 class="text-center">
                    <?php the_archive_title(); ?>
				</h1>
			</div>
			<div class="container">
				<div class="row">
                    <?php if (have_posts()): while (have_posts()) :
                        the_post();
                        $ID      = get_the_ID();
                        $img     = get_the_post_thumbnail_url($ID, 'large');
                        $title   = get_the_title($ID);
                        $link    = get_permalink($ID);
                        $excerpt = get_the_excerpt($ID); ?>
						<div class=" col-md-6 col-lg-6">
							<div class="post-item border mb-5 rounded shadow bg-white">
								<a href="<?= $link ?>" title="<?= $title ?>">
                                    <?php if (!empty($img)): ?>
										<div class="box-img">
											<img class="img-fluid" width="320" height="190" src="<?= $img ?>" alt="<?= $title ?>">
										</div>
                                    <?php endif; ?>
									<div class="info mb-3 p-3">
										<h3 class="title"><?= $title ?></h3>
										<p class="expert"><?= $excerpt ?></p>
									</div>
								</a>
							</div>
						</div>
                    <?php
                    endwhile;
                        wp_pagenavi();
                    else: ?>

						<div class="col-12">
							<div class="alert alert-info">
                                <?= __('CHUYÊN MỤC NÀY ĐANG CẬP NHẬT NỘI DUNG, VUI LÒNG QUAY LẠI SAU!',
                                    'tinhdev') ?>
							</div>
							<form class="search-form " method="get" action="http://wp-sinhnguyenv2.local/" role="search" itemprop="potentialAction" itemscope="" itemtype="https://schema.org/SearchAction">
								<div class="mb-3 input-group">
									<input class="form-control" type="search" name="s" id="searchform-1" placeholder="<?= __('Tìm trên website',
                                        'tinhdev') ?>" itemprop="query-input">
									<button class="btn btn-primary"><?= __('Tìm kiếm',
                                            'tinhdev') ?></button>
								</div>
								<meta content="http://wp-sinhnguyenv2.local/?s={s}" itemprop="target">
							</form>
						</div>
                    <?php endif; ?>
				</div>

			</div>
		</div>
        <?php
    }
}