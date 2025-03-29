<?php
/**
 * TINO CRAWLER
 *
 * @package           WPCRAWLER
 * @author            PHAN VAN TINH
 * @copyright         2022 PHAN VAN TINH
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       TINO CRAWLER
 * Plugin URI:        https://thietkewebsitecantho.com.vn
 * Description:       PLUGIN NÀY LÀM CHƠI NHA, TINHDEV.COM
 * Version:           1.0.3
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Phan Van Tinh
 * Author URI:        https://tinhdev.com
 * Text Domain:       tino-crawler
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Update URI:        https://thietkewebsitecantho.com.vn
 */

if (!defined('ABSPATH')){
    exit;
}
require_once 'settings.php';
require_once 'simple_html_dom.php';
require_once 'api.php';


//hàm này tạo bài viết mới
function createPost($post_category = []){
    $wordpress_post = [
        'post_title'    => 'Giá cà phê hôm nay ngày ' . date("d/m/y"),
        'post_content'  => getWebGiaCapheHomNay() . getWebGiaCaPheTheGioi(),
        'post_status'   => 'publish',
        'post_author'   => 1,
        'post_type'     => 'post',
        'feeds'         => 'post',
        'post_name'     => 'Giá cà phê hôm nay ngày ' . date("d/m/y"),
        'post_category' => $post_category
    ];

    return wp_insert_post($wordpress_post);
}

remove_filter('content_save_pre', 'wp_filter_post_kses');
remove_filter('content_filtered_save_pre', 'wp_filter_post_kses');


/*
 * Hàm này dùng để chạy lệnh crawl
 * **/
function bl_cron_exec(){
    createPost();
}

add_action('custom_cron_new_post', 'bl_cron_exec');


function getWebGiaCapheHomNay(){

    try{
        $data = api_get_post_by_webgia();
        if ($data !== FALSE){
            $html = str_get_html($data);
            if ($html !== FALSE){
                $trTags = $html->find('tr');
                foreach ($trTags as $key => $tr){
                    $tdTags = $tr->find('.text-right');
                    $small  = $tr->find('small');

                    foreach ($small as $key => $s){
                        if (!$s->hasClass('text-green') || !$s->hasClass('text-red')){
                            $s->innertext = 'SinhNguyen';
                        }
                    }
                    foreach ($tdTags as $key => $td){
                        $td->addClass('blstk');
                        $data     = $td->getAttribute('nb');
                        $smallTag = $td->find('small');
                        foreach ($smallTag as $small){
                            $td->innertext = $data;
                        }
                    }
                }
                $table = $html->find('ins');
                foreach ($table as $ta){
                    $ta->remove();
                }
                $scripts = $html->find('script');

                foreach ($scripts as $script){
                    $script->remove();
                }
                $styles = $html->find('style');

                foreach ($styles as $style){
                    $style->remove();
                }


                $gia = $html->find('article[id="main"]');
                foreach ($gia as $v){
                    // Chuỗi cần tìm và xóa
                    $chuoi_can_xoa = '<p>Xem thêm <a href="https://webgia.com/gia-hang-hoa/ca-phe-the-gioi/" title="Giá Cà Phê Thế Giới">Giá Cà Phê Thế Giới</a>: <a href="https://webgia.com/gia-hang-hoa/ca-phe-the-gioi/" title="Giá Cà Phê Thế Giới">https://webgia.com/gia-hang-hoa/ca-phe-the-gioi/</a></p>';
                    $script        = '<script> (adsbygoogle = window.adsbygoogle || []).push({}); </script>';
                    // Xóa chuỗi
                    $new_htmk = str_replace($chuoi_can_xoa, '', $v);
                    $new_htmk = str_replace($script, '', $new_htmk);
                    $content  = "<div class='gianoidia'>" . $new_htmk . "</div>";
                }
                $content .= "Xem thêm Giá Cà Phê Thế Giới: <a href='/gia-ca-phe-the-gioi'>https://sinhnguyencoffee.com/gia-ca-phe-the-gioi/ </a>";

                return $content;
            }else{
                return "Không thể phân tích dữ liệu HTML từ dữ liệu nhận được.";
            }
        }else{
            return "Lỗi khi lấy dữ liệu từ API.";
        }
    }catch (Exception $e){
        return "Lỗi: " . $e->getMessage();
    }
}

add_shortcode('auto_crawl_data_gia_ca_phe', 'getWebGiaCapheHomNay');


function getWebGiaCaPheTheGioi(){

    try{
        $data = api_get_post_by_webgiaGiaCaPheTheGioi();
        if ($data !== FALSE){


            $html = str_get_html($data);

            if ($html !== FALSE){
                $td = $html->find('td');
                foreach ($td as $key => $t){
                    if ($key == 0){
                        continue;
                    }else{
                        $t->addClass('blstk bnls');
                    }
                    $data     = $t->getAttribute('nb');
                    $smalls  = $t->find('small');

                    foreach ($smalls as $s){
                        if (!$s->hasClass('text-green') && !$s->hasAttribute('style') && !$s->hasClass('text-red')){
                            $s->innertext = $data;
                        }
                    }
                }
                $table = $html->find('ins');
                foreach ($table as $ta){
                    $ta->remove();
                }
                $scripts = $html->find('script');

                foreach ($scripts as $script){
                    $script->remove();
                }
                $styles = $html->find('style');

                foreach ($styles as $style){
                    $style->remove();
                }


                $gia = $html->find('article[id="main"]');
                foreach ($gia as $v){
                    // Chuỗi cần tìm và xóa
                    $chuoi_can_xoa = '<p>Xem thêm <a href="https://webgia.com/gia-hang-hoa/ca-phe-the-gioi/" title="Giá Cà Phê Thế Giới">Giá Cà Phê Thế Giới</a>: <a href="https://webgia.com/gia-hang-hoa/ca-phe-the-gioi/" title="Giá Cà Phê Thế Giới">https://webgia.com/gia-hang-hoa/ca-phe-the-gioi/</a></p>';
                    $script        = '<script> (adsbygoogle = window.adsbygoogle || []).push({}); </script>';
                    // Xóa chuỗi
                    $new_htmk = str_replace($chuoi_can_xoa, '', $v);
                    $new_htmk = str_replace($script, '', $new_htmk);

                    $content = "<div class='giathegioi'>" . $new_htmk . "</div>";
                }
                $content .= "Xem thêm Giá Cà Phê Nội địa: <a href='/gia-ca-phe-hom-nay/'>https://sinhnguyencoffee.com/gia-ca-phe-hom-nay/ </a>";

                return $content;
            }else{
                return "Không thể phân tích dữ liệu HTML từ dữ liệu nhận được.";
            }
        }else{
            return "Lỗi khi lấy dữ liệu từ API.";
        }
    }catch (Exception $e){
        return "Lỗi: " . $e->getMessage();
    }
}


add_shortcode('auto_crawl_data_gia_ca_phe_the_gioi', 'getWebGiaCaPheTheGioi');
