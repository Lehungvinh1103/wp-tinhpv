<?php

namespace TinhDev\components;

use TinhDev\base\Base;
use TinhDev\base\BaseInterface;

class VideoComment extends Base implements BaseInterface{

    public static function render(){
        $video_comment = get_field('video_comment', 'option');
        if (!empty($video_comment)):
            ?>
			<div class="video-comment ">
				<div class="container">
					<div class="row">
						<div class="col-lg-6">
							<div class="py-5">
								<h6><?= $video_comment['title_1'] ?? __('Video của chúng tôi',
                                        'tinhdev') ?></h6>
                                <?= $video_comment['video'] ?? '' ?>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="py-5">
								<h6>
                                    <?= $video_comment['title_2'] ?? __('Đánh giá của khách hàng',
                                        'tinhdev') ?>
								</h6>
                                <?php foreach ($video_comment['comments'] as $comment): ?>
									<div class="box-comment">
										<div class="comment bg-light rounded-3 border mt-2 p-3">
                                            <?= $comment['detail'] ?? '' ?>
										</div>
										<div class="title ">
                                            <?= $comment['title'] ?? '' ?>
										</div>
									</div>
                                <?php endforeach; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
        <?php
        endif;
    }
}