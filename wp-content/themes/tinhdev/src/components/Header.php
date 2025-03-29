<?php

namespace TinhDev\components;

use TinhDev\base\Base;
use TinhDev\base\BaseInterface;

class Header extends Base implements BaseInterface{

    /**
     * @return void
     */
    public static function render(){
        $header = get_field('header', 'option');
        ?>

		<header class="header">
			<div class="main-header shadow">
				<div class="container">
					<div class="d-flex justify-content-between align-items-center">
						<div class="logo d-flex justify-content-center justify-content-lg-start align-items-center">
							<a href="/" title="<?= get_bloginfo() ?>">
								<img height="70" src="<?= $header['logo'] ?>" alt="<?= $header['logo'] ?>">
							</a>
						</div>
                        <?php
                        if (has_nav_menu('primary_menu')){
                            wp_nav_menu([
                                'theme_location'  => 'primary_menu',
                                'container'       => 'nav',
                                'container_class' => 'primary-menu-nav w-100 d-none d-lg-block',
                                'menu_class'      => 'primary-menu d-flex w-100 justify-content-end',
                            ]);
                        }
                        ?>


                        <?php
                        if (has_nav_menu('language_menu')){
                            wp_nav_menu([
                                'theme_location'  => 'language_menu',
                                'container'       => 'nav',
                                'container_class' => 'language-menu-nav w-100 d-none d-lg-block',
                                'menu_class'      => 'language-menu d-flex w-100 justify-content-end',
                            ]);
                        }
                        ?>
						<div class="right-button d-flex align-items-center">
							<a href="#menu-header-mobile" class="btn btn-right d-block border-white text-white d-lg-none button-header">
								<i class="fa-solid fa-bars-staggered" aria-hidden="true"></i>
							</a>
						</div>
					</div>
				</div>
			</div>
		</header>
		<div class="d-none">
            <?php
            if (has_nav_menu('primary_menu')){
                wp_nav_menu([
                    'theme_location'  => 'primary_menu',
                    'container'       => 'nav',
                    'container_class' => 'menu-mobile',
                    'container_id'    => 'menu-header-mobile',
                    'menu_class'      => 'menu-header-mobile',
                ]);
            }
            ?>
		</div>

    <?php }
}