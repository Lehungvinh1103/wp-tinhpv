<?php

namespace TinhDev\components;

use TinhDev\base\Base;
use TinhDev\base\BaseInterface;

class HomeContactUs extends Base implements BaseInterface{

    public static function render(){
        $contact_us = get_field('contact_us', 'option'); ?>
		<div class="contact-us">
			<div class="container">
				<div class="bg-light p-3 d-flex flex-wrap justify-content-between align-items-center">
					<div class="contact-section">
						<h2><?= $contact_us['title'] ?? '' ?></h2>
						<p><?= $contact_us['detail'] ?? '' ?></p>
					</div>
					<div class="btn btn-primary mb-5" data-bs-toggle="modal" data-bs-target="#contact-us">
						<span><?= __('LIÊN HỆ VỚI CHÚNG TÔI', 'tinhdev')?></span></div>
				</div>
			</div>
		</div>
		<div class="modal" id="contact-us" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-body">
                        <?= do_shortcode($contact_us['form'] ?? '') ?>
					</div>
				</div>
			</div>
		</div>
        <?php
    }
}