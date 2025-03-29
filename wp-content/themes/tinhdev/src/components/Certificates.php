<?php

namespace TinhDev\components;

use TinhDev\base\Base;
use TinhDev\base\BaseInterface;

class Certificates extends Base implements BaseInterface{

    public static function render(){
        $certifications = get_field('certifications', 'option');
        ?>
		<div class="certifications slider bg-light">
			<div class="d-flex  flex-wrap">
				<div class="slide-left py-5">
					<div class="container-fluid">
						<div class="text-center">
							<h2 class="title-dancing "><?= __('CHỨNG NHẬN VỀ CHẤT LƯỢNG',
                                    'tinhdev') ?> </h2>
						</div>
						<div class="row justify-content-center">
                            <?php foreach ($certifications['certifications'] as $certification):
	                            ?>
								<div class="col-lg-3 box-certification">
									<a data-src="<?= $certification['image'] ?? '' ?>" data-fancybox="gallery">
										<img class="w-100" src="<?= $certification['image'] ?? '' ?>" alt="<?= $certification['alt'] ?? '' ?>">
									</a>
								</div>
                            <?php endforeach; ?>
						</div>
					</div>
				</div>
				<div class="slide-right">
					<div class="d-flex flex-wrap">
                        <?php foreach ($certifications['informations'] as $key => $information):

	                        ?>
							<div class="box-content <?= $key == 1 ? 'light' : '' ?>">
								<img class="w-100" src="<?= $information['image'] ?>" alt="<?= $information['link']['title'] ?>">
								<a href="<?= $information['link']['url'] ?>" class="rounded-0">
                                    <?= $information['link']['title'] ?>
								</a>
							</div>
                        <?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
        <?php

    }
}