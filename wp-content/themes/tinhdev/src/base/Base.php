<?php

namespace TinhDev\base;

class Base extends BaseAbstract{

    public function init(){
        if (class_exists('WooCommerce')):
            add_theme_support('woocommerce');
        endif;
        self::register_nav_menu();
        self::acf_add_options_page();
    }

    /**
     * @return void
     */
    function register_nav_menu(){
        register_nav_menus([
            'topbar_menu'   => __('Topbar Menu', 'tinhdev'),
            'primary_menu'  => __('Primary Menu', 'tinhdev'),
            'footer_menu_1' => __('Footer Menu 1', 'tinhdev'),
            'footer_menu_2' => __('Footer Menu 2', 'tinhdev'),
            'language_menu' => __('Ngôn ngữ', 'tinhdev'),
            'sidebar_menu' => __('Sidebar Menu', 'tinhdev'),
        ]);
    }

    /**
     * @return void
     */
    public function acf_add_options_page(){
        acf_add_options_page([
            'page_title' => 'Cài đặt cơ bản',
            'menu_title' => 'Cài đặt cơ bản',
            'menu_slug'  => 'theme-general-settings',
            'capability' => 'edit_posts',
            'redirect'   => FALSE
        ]);
    }

    /**
     * @param $product
     *
     * @return float|int
     */
    public static function getProductPercentage($product){
        $max_percentage = $percentage = 0;
        if (!$product->is_on_sale()){
            return 0;
        }
        if ($product->is_type('simple')){
            $max_percentage = (($product->get_regular_price() - $product->get_sale_price()) / $product->get_regular_price()) * 100;
        }elseif ($product->is_type('variable')){
            foreach ($product->get_children() as $child_id){
                $variation = wc_get_product($child_id);
                $price     = $variation->get_regular_price();
                $sale      = $variation->get_sale_price();
                if ($price != 0 && !empty($sale)){
                    $percentage = ($price - $sale) / $price * 100;
                }
                if ($percentage > $max_percentage){
                    $max_percentage = $percentage;
                }
            }
        }

        return $max_percentage;
    }
}