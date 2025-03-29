<?php

namespace TinhDev\components;

use TinhDev\base\Base;
use TinhDev\base\BaseInterface;

class AboutHistory extends Base implements BaseInterface
{

    /**
     * @return mixed|void
     */
    public static function render()
    {
?>


        <section class="container section_introduce pt-3">
            <div class="row">
                <div class="col-md-12">
                    <div>
                        <?php if (function_exists('bcn_display')) {
                            bcn_display();
                        } ?>
                    </div>
                    <div class="d-flex justify-content-center align-items-center mb-3">
                        <div class="intro-section">
                            <h3 class="fw-bold">GIỚI THIỆU</h3>
                            <div class="d-flex justify-content-center">
                                <div class="contact_title_line">
                                    <img src="<?php echo get_stylesheet_directory_uri() . '/src/assets/images/logo_title.svg'; ?>" alt="" class="logo-image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="container-fluid p-2 introduce_list">
                        <?php
                        if (has_nav_menu('about_menu')) {
                            wp_nav_menu([
                                'theme_location' => 'about_menu',
                                'container' => 'nav',
                                'container_class' => 'contact-menu',
                                'menu_class' => 'my-3',
                            ]);
                        }
                        ?>
                        <div class="line">
                            <a href="http://anminhagriculture.com/ban-lanh-dao/" class="d-flex justify-content-start gap-3">
                                = <p> Ban lãnh đạo</p>
                            </a>
                        </div>
                        <div class="line">
                            <a href="http://anminhagriculture.com/danh-hieu-va-giai-thuong/" class="d-flex justify-content-start gap-3">
                                = <p> Danh hiệu và giải thưởng</p>
                            </a>
                        </div>
                        <div class="line">
                            <a href="http://anminhagriculture.com/van-hoa-an-minh/" class="d-flex justify-content-start gap-3">
                                = <p> Văn hóa An Minh</p>
                            </a>
                        </div>
                        <div class="line">
                            <a href="http://anminhagriculture.com/cau-chuyen-lich-su/" class="d-flex justify-content-start gap-3">
                                = <p> Câu chuyện lịch sử</p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="introduce_information">
                        <div class="list">
                            <h5>CÂU CHUYỆN LỊCH SỬ CỦA AnMinhAgrimex</h5>

                            <p>
                            <?php $thongtin = get_field('gioi-thieu', 'option');
                                echo ($thongtin[0]['cau_chuyen_lich_su']);
                                ?>  </div>

                    </div>
                </div>
            </div>
        </section>

<?php
    }
}
