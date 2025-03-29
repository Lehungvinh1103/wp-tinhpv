<?php

namespace TinhDev\components;

use TinhDev\base\Base;
use TinhDev\base\BaseInterface;

class Gallery extends Base implements BaseInterface{

    public static function render(){
		$brick_factory = get_field('brick_factory', 'option');
		$ships = get_field('ships', 'option');
		?>
		<div class="gallery">
			<div class="container">
                <div class="row">
	                <div class="col-lg-6">

	                </div>
	                <div class="col-lg-6">

	                </div>
                </div>
			</div>
		</div>
    <?php }
}