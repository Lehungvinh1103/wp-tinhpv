<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require __DIR__ . '/vendor/autoload.php';


use Sunra\PhpSimple\HtmlDomParser;

use TinhDev\base\Base;
use TinhDev\components\AboutUs;
use TinhDev\components\Header;
use TinhDev\components\Slider;
use TinhDev\components\Banner;
use TinhDev\components\BlogStyleCarousel;
use TinhDev\components\ContactOnline;
use TinhDev\components\ProductTab;
use TinhDev\components\ProductTerm;
use TinhDev\components\Footer;
use TinhDev\components\Archive;
use TinhDev\components\ArchiveProduct;
use TinhDev\components\Page;
use TinhDev\components\Single;
use TinhDev\components\SingleProduct;
use TinhDev\components\PageNotFound;
use TinhDev\components\Certificates;
use TinhDev\components\ProductFeatured;

$base = new Base();
$base->init();


add_action('init', 'remove_functions', 15);
function remove_functions(){
    remove_action('genesis_header', 'genesis_do_header');
    remove_action('genesis_footer', 'genesis_do_footer');
    remove_action('genesis_sidebar', 'genesis_do_sidebar');
    remove_action('genesis_loop', 'genesis_do_loop');
}

add_action('init', 'add_functions', 15);
function add_functions(){
    add_action('genesis_header', 'header_components');
    add_action('genesis_loop', 'home_components');
    add_action('genesis_loop', 'single_components');
    add_action('genesis_loop', 'page_components');
    add_action('genesis_loop', 'archive_components');
    add_action('genesis_footer', 'footer_components');
    add_action('genesis_loop', 'search_components');
    add_action('genesis_loop', 'page_not_found_components');
}

function header_components(){
    Header::render();
}

function home_components(){
    if (is_home()):
        Slider::render();
        AboutUs::render();
        Certificates::render();
    endif;
}

function single_components(){
    if (is_single()):
        if (class_exists('WooCommerce') && is_woocommerce()):
            SingleProduct::render();
            Certificates::render();
        else:
            Single::render();
        endif;
    endif;
}

function page_components(){
    if (is_page() && !is_page_template()):
        Page::render();
    endif;
}


function archive_components(){
    if (is_archive()):
        if (class_exists('WooCommerce') && is_woocommerce()):
            ArchiveProduct::render();
            Certificates::render();
        else:
            Archive::render();
        endif;
    endif;
}


function search_components(){
    if (is_search()):
        if (class_exists('WooCommerce') && is_woocommerce()):
            ArchiveProduct::render();
        else:
            Archive::render();
        endif;
    endif;
}


function page_not_found_components(){
    if (is_404()):
        PageNotFound::render();
    endif;
}


function footer_components(){
    Footer::render();
    ContactOnline::render();
}


function mmenu_setup(){
    $header = get_field('header', 'option');

    ?>

	<script>
        document.addEventListener("click", (evnt) => {
            if (evnt.target?.closest?.('a[href^="#/"]')) {
                evnt.preventDefault();
                alert("Thank you for clicking, but that's a demo link.");
            }
        });
        document.addEventListener('DOMContentLoaded', () => {
            new Mmenu("#menu-header-mobile", {
                theme: "white",
                offCanvas: {
                    position: "bottom"
                },
                navbars: [
                    {
                        height: 2,
                        content: [
                            '<a target="_blank" href="tel:<?=$header['phone'] ?? ''?>" class="fa fa-phone"></a>',
                            '<a class="mmenu-logo" href="/"><img class="img-fluid" height="50" src="<?= $header['logo'] ?? '' ?>" alt="<?php wp_title() ?>"></a>',
                            '<a target="_blank" href="mailto:<?=$header['email'] ?? ''?>" class="fa fa-envelope"></a>'
                        ]
                    },
                    {
                        content: ["<form action='/' method='get' class='p-3 input-group mb-3'>" +
                        "<input class='form-control' type='text' name='s' id='search' value='<?php the_search_query(); ?>' />" +
                        "<button class='btn btn-outline-secondary'><?php echo esc_attr_x('Tìm kiếm',
                            'tinhdev') ?></button>" +
                        "</form>"]
                    }, {
                        content: ["prev", "title"]
                    }]
            }, {});
        });

	</script>    <!-- Messenger Plugin chat Code -->
<?php }

add_action('wp_footer', 'mmenu_setup');

add_filter('get_the_archive_title', function ($title){
    if (is_category()){
        $title = single_cat_title('', FALSE);
    }elseif (is_tag()){
        $title = single_tag_title('', FALSE);
    }elseif (is_author()){
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    }elseif (is_tax()){ //for custom post types
        $title = sprintf(__('%1$s'), single_term_title('', FALSE));
    }elseif (is_post_type_archive()){
        $title = post_type_archive_title('', FALSE);
    }

    return $title;
});

remove_filter('the_excerpt', 'wpautop');

add_filter('rest_prepare_post', 'my_filter_post', 10, 3);
function my_filter_post($data, $post, $context){

    // Does this have categories?
    if (!empty($data->data['categories'])){
        $category_name = [];
        // Loop through them all
        foreach ($data->data['categories'] as $key => $category_id){
            // Get the actual Category Object
            $category                    = get_category($category_id);
            $category_name[$key]['id']   = $category_id;
            $category_name[$key]['name'] = $category->name;
        }
    }
    $data->data['categories'] = $category_name;

    if (!empty($data->data['featured_media'])){
        $data->data['featured_media'] = wp_get_attachment_url($data->data['featured_media']);
    }else{
        $data->data['featured_media'] = "";
    }

    return $data;
}


add_filter('rest_prepare_category', 'my_filter_category', 10, 3);
function my_filter_category($data, $post, $context){
    $data->data['featured_media'] = get_field('category_featured_media',
        get_term($data->data['id'])) ?? '';

    return $data;
}

add_action('after_setup_theme', 'tinhdev');

function tinhdev(){
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}

// Hàm để crawl dữ liệu từ một URL
function crawl_data_from_url($url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

    // Giả lập User Agent của một trình duyệt thực tế
    curl_setopt($ch, CURLOPT_USERAGENT,
        'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36');

    // Xử lý cookie
    curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
    curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');

    $output = curl_exec($ch);

    if ($output === FALSE){
        return 'Error: ' . curl_error($ch);
    }

    curl_close($ch);

    return $output;
}

// Hàm để phân tích cú pháp HTML và trích xuất nội dung dựa trên selector
function extract_data_with_selector($html, $selector){
    $dom = new DOMDocument();
    @$dom->loadHTML($html);
    $xpath    = new DOMXPath($dom);
    $elements = $xpath->query($selector);

    if ($elements->length == 0){
        return 'No elements found for the given selector';
    }

    $result = '';
    foreach ($elements as $element){
        $result .= $dom->saveHTML($element);
    }

    return $result;
}

function get_data2($href){
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_HEADER, FALSE);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($curl, CURLOPT_URL, $href);
    curl_setopt($curl, CURLOPT_REFERER, $href);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($curl, CURLOPT_USERAGENT,
        "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) AppleWebKit/533.4 (KHTML, like Gecko) Chrome/5.0.375.125 Safari/533.4");
    $str = curl_exec($curl);
    curl_close($curl);

    return $str;
}

// Ví dụ sử dụng hàm crawl và trích xuất dữ liệu
function get_external_content_with_selector(){
    $url = 'https://webgia.com/gia-hang-hoa/ca-phe-the-gioi/'; // Thay bằng URL bạn muốn crawl

    $dom     = HtmlDomParser::file_get_html($url);

    //    return $data; // Trả về dữ liệu để sử dụng trong shortcode
}

// Đăng ký shortcode để hiển thị dữ liệu trên trang WordPress
//add_shortcode('auto_crawl_data_gia_ca_phe', 'get_external_content_with_selector');
//
add_action( 'woocommerce_review_order_before_submit', 'bbloomer_add_checkout_privacy_policy', 9 );
    
function bbloomer_add_checkout_privacy_policy() {
   
woocommerce_form_field( 'privacy_policy', array(
   'type'          => 'checkbox',
   'class'         => array('form-row privacy'),
   'label_class'   => array('woocommerce-form__label woocommerce-form__label-for-checkbox checkbox'),
   'input_class'   => array('woocommerce-form__input woocommerce-form__input-checkbox input-checkbox'),
   'required'      => true,
   'label'         => 'Tôi đã đọc và đồng ý với <a href="/chinh-sach-bao-mat">Chính sách bảo mật</a>',
)); 
   
}
   
// Show notice if customer does not tick
    
add_action( 'woocommerce_checkout_process', 'bbloomer_not_approved_privacy' );
   
function bbloomer_not_approved_privacy() {
    if ( ! (int) isset( $_POST['privacy_policy'] ) ) {
        wc_add_notice( __( 'Please acknowledge the Privacy Policy' ), 'error' );
    }
}
