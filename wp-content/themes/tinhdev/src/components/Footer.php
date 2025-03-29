<?php

namespace TinhDev\components;

use TinhDev\base\Base;
use TinhDev\base\BaseInterface;

class Footer extends Base implements BaseInterface{

    /**
     * @return mixed|void
     */
    public static function render(){
        $footer = get_field('footer', 'option');
        ?>
		<section class="footer border-top py-5">
			<div class="container">
				<div class="row">
					<div class="col-lg-4">
						<h6 class="section-title ">
							<?= __("VỀ CHÚNG TÔI","tinhdev");?>
							</h6>
                        <?= $footer['company_info'] ?? '' ?>
                        <?php if (!empty($footer['contact_info'])): ?><?php foreach ($footer['contact_info'] as $item): ?>
							<div class="info-item mb-3 d-flex">
								<div class="icon text-primary">
                                    <?= $item['icon'] ?>
								</div>
								<div class="info-contact ps-2">
									<strong>
                                        <?= $item['title'] ?>
									</strong>
									<span>
											<?= $item['content'] ?>
										</span>
								</div>
							</div>
                        <?php endforeach; ?><?php endif; ?>
						
					</div>


					<div class="col-lg-4">
						<h6 class="section-title ">
							<?=__("THÔNG TIN LIÊN HỆ","tinhdev"); ?> </h6>
						<div class="info">
                            <?= $footer['maps'] ?? '' ?>
						</div>

					</div>
					<div class="col-lg-4">
						<h6 class="section-title ">
							<?=__("CHÍNH SÁCH","tinhdev"); ?> </h6>
                        <?php
                        if (has_nav_menu('footer_menu_1')){
                            wp_nav_menu([
                                'theme_location'  => 'footer_menu_1',
                                'container'       => 'nav',
                                'container_class' => '',
                                'container_id'    => 'menu-footer',
                                'menu_class'      => 'menu-footer',
                            ]);
                        }
                        ?>
<a href="http://online.gov.vn/Home/WebDetails/125800" target="_blank"> <img height="50" src="http://sinhnguyencoffee.com/wp-content/uploads/2024/12/logoSaleNoti.png"  alt="Sinh Nguyễn - Bộ Công Thương"/></a>
					</div>
				</div>

			</div>
		</section>
		<div class="bg-secondary text-white py-3">
			<p class="text-center mb-0"> 
				© 2019. CÔNG TY TNHH SINH NGUYỄN ®. GPDKKD: 1801632299 do sở KH & ĐT TP.Cần Thơ cấp ngày 20/03/2019. Địa chỉ liên hệ và gửi chứng từ: Số 36AB/5 tổ 5, KV3, Phường An Khánh, 
				Quận Ninh Kiều, Thành phố Cần Thơ, Việt Nam. Điện thoại: 0908 529 587. Email: sinhnguyencoffee@gmail.com. Chịu trách nhiệm nội dung: Nguyễn Hoàng Sinh..
				</p>
		</div>
    <?php }
}