<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use common\components\MainHelper;

$this->title = MainHelper::getPageTitle(Yii::t('app', "Une erreur s'est produite"), '', true);
?>
		<div class="meetings-events-contact-us lightgray-bg pt-100 pb-100">
			<div class="container">
				<div class="our-hotels-list">
					<div class="contact-us-header experience-in-mauritius pb-5">
						<h1 class="bold-text mb-10 pb-5"><?= Yii::t('app', "Une erreur s'est produite") ?></h1>
					</div>
					<div class="contact-us-block flex pt-50 mt-10">
						<div class="flex-1 flex center-aligned-vert">
							<img src="assets/images/inspiration/meetings-events/meetings-events-icon.svg" alt="" class="block">
							<div class="contact-us-item ml-30">
								<span class="block mb-10 fs-14 lh-20 simplegray-text">+230 204 3820</span>
								<a href="tel:2302043820" class="gallery-items-link inline-block"><?= Yii::t('app', "Contactez-nous") ?></a>
							</div>
						</div>
						<div class="flex-1 flex center-aligned-vert">
							<img src="assets/images/inspiration/meetings-events/meetings-events-icon.svg" alt="" class="block">
							<div class="contact-us-item ml-30">
								<a href="mailto:marie@hotels-attitude.com" class="block mb-10 fs-14 lh-20 simplegray-text">resa@hotels-attitude.com
								</a><a href="mailto:resa@hotels-attitude.com" class="gallery-items-link inline-block"><?= Yii::t('app', "Nous envoyer un email") ?></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
