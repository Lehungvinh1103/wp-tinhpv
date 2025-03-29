<?php

namespace TinhDev\components;

use TinhDev\base\Base;
use TinhDev\base\BaseInterface;

class ContactOnline extends Base implements BaseInterface{

    public static function render(){
        $contact_online = get_field('contact_online', 'option');
        ?>
		<div class="contact-online">
            <?php if (!empty($contact_online['zalo'])):
                ?>
				<div class="contact contact-zalo">
					<a href="<?= $contact_online['zalo']['url'] ?>" class="contact-btn" target="_blank" title="<?= $contact_online['zalo']['title'] ?>">
						<img src="<?= parent::$template_directory_uri . '/images/zalo.png' ?>" alt="">
					</a>
				</div>
            <?php endif; ?>
            <?php if (!empty($contact_online['phone_list'])):
                ?>
				<div class="contact contact-phone">
					<div class="contact-btn">
						<img src="<?= parent::$template_directory_uri . '/images/btn-telephone.png' ?>" alt="">
					</div>
					<ul class="contact-list">
                        <?php foreach ($contact_online['phone_list'] as $phone): ?>
							<li>
								<a href="<?= $phone['phone_number']['url'] ?>"><?= $phone['phone_number']['title'] ?></a>
							</li>
                        <?php endforeach; ?>
					</ul>
				</div>
            <?php endif; ?>
            <?php if (!empty($contact_online['email'])):
                ?>
				<div class="contact contact-email">
					<a href="mailto:<?= $contact_online['email'] ?>" class="contact-btn" target="_blank" title="mailto:<?= $contact_online['email'] ?>">
						<img src="<?= parent::$template_directory_uri . '/images/mail.png' ?>" alt="">
					</a>
				</div>
            <?php endif; ?>
            <?php if (!empty($contact_online['phone_list'])):
                ?>
				<div class="contact contact-phone">
					<div class="contact-btn">
						<img src="<?= parent::$template_directory_uri . '/images/messenger.png' ?>" alt="">
					</div>
					<ul class="contact-list">
                        <?php foreach ($contact_online['messenger_facebook'] as $value): ?>
							<li>
								<a target="_blank" href="<?= $value['link']['url'] ?>"><?= $value['link']['title'] ?></a>
							</li>
                        <?php endforeach; ?>
					</ul>
				</div>
            <?php endif; ?>
		</div>

    <?php }
}