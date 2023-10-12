<?php

use yii\helpers\Url;
use yii\helpers\Json;
use yii\bootstrap\ActiveForm;
use common\models\Cms;
use common\models\Media;
use frontend\widgets\BlockWidget;
use common\components\MainHelper;

$this->title = MainHelper::getPageTitle($cms->title, '', true);
?>

		<div class="header short-header">
			<div class="header-slider">
				<div class="swiper-container">
					<div class="swiper-wrapper">
			            <?php
			            if (null !== $cms->photo_id) {
			                foreach (JSON::decode($cms->photo_id) as $photoId) {
			                    $photo = Media::findOne($photoId);
			                    if (null !== $photo) { ?>
									<div class="swiper-slide flex" style="background-image:url(<?= Yii::getAlias('@uploadWeb').'/'.$photo->path ?>)"></div>
			                    <?php }
			                }
			            } ?>
					</div>
				</div>
			</div>
		</div>

		<div class="contact-us pt-100">
			<div class="container">

				<div class="experience-in-mauritius mt-20 pb-50 prompt-para centered-text margin-auto-hor">
					<h1 class="selected-room-title mb-10 pb-5 bold-text"><?= $cms->meta_title ?></h1>
					<?= $cms->summary ?>
				</div>

				<div class="contact-us-block flex pt-10 mt-5 mb-20 pl-60 pr-60">
					<div class="centered-text ml-40 mr-40">
						<div class="contact-us-icon mb-20 lightgray-bg border-rad-full margin-auto-hor flex center-aligned-hor center-aligned-vert">
							<img src="<?= Yii::$app->request->BaseUrl ?>/images/call-us.svg" class="width-50" alt="">
						</div>
						<div class="contact-us-item">
							<a href="#call-us" class="gallery-items-link inline-block show-modal gtm-clic" data-event="call_us_popin_open"><?= Yii::t('app', "Appelez-nous") ?></a>
						</div>
					</div>
					<div class="centered-text ml-40 mr-40">
						<div class="contact-us-icon mb-20 lightgray-bg border-rad-full margin-auto-hor flex center-aligned-hor center-aligned-vert">
							<img src="<?= Yii::$app->request->BaseUrl ?>/images/call-me-back.svg" class="width-50" alt="">
						</div>
						<div class="contact-us-item">
							<a href="#call-me-back" class="gallery-items-link inline-block show-modal gtm-clic" data-event="call_me_back_popin_open"><?= Yii::t('app', "Appelez-moi") ?></a>
						</div>
					</div>
					<?php
					if (null !== $quoteForm) { ?>
						<div class="centered-text ml-40 mr-40">
							<div class="contact-us-icon mb-20 lightgray-bg border-rad-full margin-auto-hor flex center-aligned-hor center-aligned-vert">
								<img src="<?= Yii::$app->request->BaseUrl ?>/images/get-a-quote.svg" class="width-50" alt="">
							</div>
							<div class="contact-us-item">
								<a href="<?= Url::to(['site/content', 'url' => $quoteForm->url]) ?>" class="gallery-items-link inline-block"><?= $quoteForm->title ?></a>
							</div>
						</div>
					<?php }

					if (null !== $quoteEventForm) { ?>
						<div class="centered-text ml-40 mr-40">
							<div class="contact-us-icon mb-20 lightgray-bg border-rad-full margin-auto-hor flex center-aligned-hor center-aligned-vert">
								<img src="<?= Yii::$app->request->BaseUrl ?>/images/get-a-quote.svg" class="width-50" alt="">
							</div>
							<div class="contact-us-item">
								<a href="<?= Url::to(['site/content', 'url' => $quoteEventForm->url]) ?>" class="gallery-items-link inline-block"><?= $quoteEventForm->title ?></a>
							</div>
						</div>
					<?php } ?>
					<div class="centered-text ml-40 mr-40">
						<div class="contact-us-icon mb-20 lightgray-bg border-rad-full margin-auto-hor flex center-aligned-hor center-aligned-vert">
							<img src="<?= Yii::$app->request->BaseUrl ?>/images/write-us.svg" class="width-50" alt="">
						</div>
						<div class="contact-us-item">
							<a href="mailto:resa@hotels-attitude.com" class="gallery-items-link inline-block"><?= Yii::t('app', "Écrivez-nous") ?></a>
						</div>
					</div>
				</div>
				
				<div class="our-hotels-list pt-100 mb-40">
					<div class="mb-5 pb-50 centered-text">
						<strong class="result-item-title bigger-sized bold-text"><?= Yii::t('app', "Comment contacter nos hôtels ?") ?></strong>
					</div>
					<ul class="four-cols-gal flex flex-wrap">
						<?php
						foreach ($hotelList as $hotel) {
							$homeHotelsCms = Cms::getCmsByTag('home-hotel');
							$hotelCmsIdx = array_search($hotel->id, array_column($homeHotelsCms, 'hotel'));
							$hotelCmsUrl = isset($homeHotelsCms[$hotelCmsIdx]->url) ? Url::to(['site/content', 'url' => $homeHotelsCms[$hotelCmsIdx]->url]) : '#'; ?>

							<li class="pb-50 mb-20">
								<a href="<?= $hotelCmsUrl ?>" class="block relative">
				                    <?php
				                    if (null !== $hotel->photo_id) {
				                        foreach (JSON::decode($hotel->photo_id) as $key => $photoId) {
				                            $photo = Media::findOne($photoId);
				                            if (null !== $photo) { ?>
				                                <img src="<?= Yii::getAlias('@uploadWeb').'/'.$photo->path ?>" alt="" title="" class="gallery-item-img shorter block full-width">
				                            <?php }
				                        }
				                    } ?>
								</a>
								<div class="fs-13 gray-text">
									<a href="<?= $hotelCmsUrl ?>">
										<h2 class="mt-20 mb-20 fs-16 darkgray-text bold-text ellipsis"><?= $hotel->name ?></h2>
									</a>
									<p><?= $hotel->phone ?></p>
									<p><?= $hotel->email ?></p>
									<p><?= $hotel->address ?></p>
								</div>
							</li>

						<?php } ?>
					</ul>
				</div>
			</div>
		</div>

		<?php
		if (isset($mailSent) && $mailSent) { ?>

			<div class="ah-popup-layer absolute flex center-aligned-hor center-aligned-vert modal cover-body">
				<div class="ah-popup-content call-up-popup get-quote-popup white-bg relative centered-text full-width">
					<div class="ah-popup-top">
						<a href="#" class="ah-popup-close block absolute"></a>
					</div>
					<div class="ah-popup-inner">
						<div>
							<img src="<?= Yii::$app->request->BaseUrl ?>/images/icons/get-a-quote-popup.png" alt="" class="block margin-auto-hor">
							<span class="block mt-10 mb-20 fs-18 darkgray-text"><?= $popinTitle ?></span>
							<span class="fs-14 lh-20"><?= $popinContent ?></span>
						</div>
						<div class="flex mt-30 center-aligned-hor">
							<a href="#" class="ah-btn small-ah-btn fs-14 border-rad-4 flex center-aligned-vert center-aligned-hor border-1 darkgray-text popup-close">OK</a>
						</div>
					</div>
				</div>
			</div>

		<?php } ?>


