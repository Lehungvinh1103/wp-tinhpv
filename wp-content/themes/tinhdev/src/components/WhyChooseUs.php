<?php

namespace TinhDev\components;

use TinhDev\base\Base;
use TinhDev\base\BaseInterface;

class WhyChooseUs extends Base implements BaseInterface{

    public static function render(){
        $services   = get_field('services', 'option');
        $why_choose = get_field('why_choose', 'option');
        ?>
		<section class="why-choose-us bg-secondary about-us py-5">
			<div class="container">
				<div class="row">
                    <?php if (!empty($services)): ?>
						<div class="col-lg-6">
							<h3 class="title sub-title text-white sub-title-left">Dịch vụ của chúng tôi?</h3>
							<ul>
                                <?php foreach ($services as $key => $service): ?>
									<li class="mb-3">
										<a class="btn btn-light w-100 rounded-0 mb-3 text-left d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#service<?= $key ?>" role="button" aria-expanded="false" aria-controls="collapseExample">
                                            <?= $service['title'] ?? '' ?>
											<i class="fa-solid fa-plus" aria-hidden="true"></i>
										</a>
										<div class="collapse <?= $key == 0 ? 'show' : '' ?>" id="service<?= $key ?>">
											<div class="card card-body">
                                                <?= $service['detail'] ?? '' ?>
											</div>
										</div>
									</li>
                                <?php endforeach; ?>
							</ul>
						</div>
                    <?php endif; ?>
					<div class="col-lg-6">
						<div class="right-item text-white">
							<h3 class="title sub-title text-white sub-title-left">Tại sao chọn chúng tôi?</h3>
							<ul>
                                <?php foreach ($why_choose as $key => $service): ?>
									<h4 class="title">
										<span class="fa fa-check text-secondary"></span>
                                        <?= $service['title'] ?? '' ?>
									</h4>	<p class="detail mb-5">
                                        <?= $service['detail'] ?? '' ?>
									</p>
                                <?php endforeach; ?>
							</ul>
						</div>

					</div>
				</div>
			</div>
		</section>
        <?php
    }
}