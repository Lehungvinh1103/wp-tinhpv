<?php

namespace TinhDev\components;

use TinhDev\base\Base;
use TinhDev\base\BaseInterface;

class PageNotFound extends Base implements BaseInterface{

    /**
     * @return mixed
     */
    public static function render(){ ?>
		<div class="page-not-found" style="background-image: url(<?= parent::$template_directory_uri . '/images/404.jpg' ?>)">

		</div>
    <?php }
}