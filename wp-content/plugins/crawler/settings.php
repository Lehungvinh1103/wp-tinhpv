<?php
/**
 * @internal never define functions inside callbacks.
 * these functions could be run multiple times; this would result in a fatal error.
 */


function addStyle(){ ?>
	<style>
		.table-radius {
			border-collapse: separate;
			border: solid #e9ecef 1px;
			border-radius: 4px;
			border-left: 0;
			border-top: 0;
		}
		.table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
			border-color: #e9ecef;
		}
		.table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
			padding: 8px;
			line-height: 1.42857143;
			vertical-align: top;
			border-top: 1px solid #ddd;

		}

		.bang-gia-ca-phe{position: relative;}
		.bang-gia-ca-phe table tr td{
			vertical-align: middle;
		}
		.bang-gia-ca-phe table tr td:nth-child(2){
			font-weight: bold;
		}
		.bang-gia-ca-phe table tr th{
			text-align: right;
		}
		.bang-gia-ca-phe small{
			display: block;
			font-size: 0.875rem;
		}

		.price-line{
			display: block;
			height: 2px;
			background-color: #fb0000;
			margin-top: 5px;
			text-align: left;
			width: 55px;
		}
		.price-line small {
			height: 2px;
			background: #00b600;
			border-right: 2px solid #000;
		}.text-red{color:#fb0000}.text-green{color:#00b600}
	</style><?php }

add_action('wp_head', 'addStyle');

function addScript1(){ ?>
	<script>
        var _0x26f62e=_0x2e99;function _0x2e99(_0x416c4b,_0x3823c5){var _0x41f221=_0x41f2();return _0x2e99=function(_0x2e9993,_0x29c58f){_0x2e9993=_0x2e9993-0x1c9;var _0x3f7db6=_0x41f221[_0x2e9993];return _0x3f7db6;},_0x2e99(_0x416c4b,_0x3823c5);}(function(_0x2baf33,_0x490cfd){var _0x14a2d3=_0x2e99,_0x3e6247=_0x2baf33();while(!![]){try{var _0x2ba10b=-parseInt(_0x14a2d3(0x1e3))/0x1+parseInt(_0x14a2d3(0x1e2))/0x2+-parseInt(_0x14a2d3(0x1d7))/0x3*(parseInt(_0x14a2d3(0x1d5))/0x4)+parseInt(_0x14a2d3(0x1ce))/0x5*(parseInt(_0x14a2d3(0x1d3))/0x6)+-parseInt(_0x14a2d3(0x1db))/0x7+parseInt(_0x14a2d3(0x1de))/0x8*(parseInt(_0x14a2d3(0x1e0))/0x9)+parseInt(_0x14a2d3(0x1cb))/0xa;if(_0x2ba10b===_0x490cfd)break;else _0x3e6247['push'](_0x3e6247['shift']());}catch(_0x1a2d1b){_0x3e6247['push'](_0x3e6247['shift']());}}}(_0x41f2,0x1f032),jQuery(document)[_0x26f62e(0x1c9)](function(_0x30faf5){var _0x186e5e=_0x26f62e;_0x30faf5(_0x186e5e(0x1ca))[_0x186e5e(0x1d8)](function(){var _0x2a24e7=_0x186e5e,_0x3c5bd1=_0x30faf5(this)[_0x2a24e7(0x1d4)]();console[_0x2a24e7(0x1d2)](_0x3c5bd1),_0x3c5bd1?_0x30faf5(this)['html'](gm(_0x3c5bd1)):_0x30faf5(this)[_0x2a24e7(0x1d1)]('-');}),_0x30faf5('.kk-star-wrap')[_0x186e5e(0x1d6)]();}));function gm(_0x14c54f){var _0x413446=_0x26f62e;_0x14c54f=_0x14c54f[_0x413446(0x1dd)](/A|B|C|D|E|F|G|H|I|J|K|L|M|N|O|P|Q|R|S|T|U|V|W|X|Y|Z/g,'');var _0x2a8e7d=[];for(var _0x2c80d4=0x0;_0x2c80d4<_0x14c54f[_0x413446(0x1d0)]-0x1;_0x2c80d4+=0x2){_0x2a8e7d[_0x413446(0x1cc)](parseInt(_0x14c54f[_0x413446(0x1e1)](_0x2c80d4,0x2),0x10));}return String[_0x413446(0x1cd)][_0x413446(0x1d9)](String,_0x2a8e7d);}function _0x41f2(){var _0x4e53d7=['fromCharCode','282760gTqksg','small:not([class])','length','html','log','18ficcdj','text','4FLYTDj','remove','353973LhmjFw','each','apply','small:not([style])','1131977ZWkreT','find','replace','80SlkXqW','.giathegioi\x20td.text-right','81387MJDJBw','substr','372414ztAnJo','212055ycKIoE','ready','.gianoidia\x20td.text-right','1724900UwFFLB','push'];_0x41f2=function(){return _0x4e53d7;};return _0x41f2();}jQuery(document)[_0x26f62e(0x1c9)](function(_0xd54b54){var _0x4a4fa4=_0x26f62e;_0xd54b54(_0x4a4fa4(0x1df))[_0x4a4fa4(0x1d8)](function(){var _0x3efcfd=_0x4a4fa4,_0x3b19af=_0xd54b54(this)[_0x3efcfd(0x1d4)]();(_0xd54b54(this)[_0x3efcfd(0x1dc)](_0x3efcfd(0x1da))[_0x3efcfd(0x1d0)]>0x0&&_0xd54b54(this)['find'](_0x3efcfd(0x1cf))[_0x3efcfd(0x1d0)]>0x0||_0xd54b54(this)[_0x3efcfd(0x1dc)]('a')[_0x3efcfd(0x1d0)]>0x0)&&(_0x3b19af?_0xd54b54(this)[_0x3efcfd(0x1d1)](gm(_0x3b19af)):_0xd54b54(this)['html']('-'));});});
	</script><?php }


add_action('wp_footer', 'addScript1');

//jQuery(document).ready(function ($) {
//    $(".gianoidia td.text-right").each(function () {
//        var gtls = $(this).text();
//        console.log(gtls);
//        if (gtls) {
//            // Giải mã và thay đổi nội dung của thẻ td
//            $(this).html(gm(gtls));
//        } else {
//            $(this).html("-");
//        }
//    });
//    $(".kk-star-wrap").remove(); // Xóa các phần tử có class .kk-star-wrap
//});
//
//function gm(r) {
//    r = r.replace(/A|B|C|D|E|F|G|H|I|J|K|L|M|N|O|P|Q|R|S|T|U|V|W|X|Y|Z/g, "");
//    var n = [];
//    for (var t = 0; t < r.length - 1; t += 2) {
//        n.push(parseInt(r.substr(t, 2), 16));
//    }
//    return String.fromCharCode.apply(String, n);
//}
//
//jQuery(document).ready(function ($) {
//    $(".giathegioi td.text-right").each(function () {
//        var gtls2 = $(this).text();
//        if (($(this).find('small:not([style])').length > 0 && $(this).find('small:not([class])').length > 0) || $(this).find('a').length > 0) {
//            if (gtls2) {
//                $(this).html(gm(gtls2));
//            } else {
//                $(this).html("-");
//            }
//        }
//    });
//});
