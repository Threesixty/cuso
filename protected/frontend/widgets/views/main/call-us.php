<?php
use yii\helpers\Url;
use common\models\Option;
use common\components\MainHelper;
?>

	<div id="call-us" class="modal display-none">
		<div class="ah-popup-layer absolute flex center-aligned-hor center-aligned-vert">
			<div class="ah-popup-content call-me-back-popup call-up-popup white-bg relative full-width">
				<div class="ah-popup-top"><a href="#" class="ah-popup-close block absolute"></a></div>
				<div class="ah-popup-inner">
					<div class="centered-text">
						<h2 class="pt-5 mb-10 bold-text darkgray-text"><?= Yii::t('app', "Appelez-nous") ?></h2>
						<span class="gallery-items-category">+230 204 38 20</span>
					</div>
					<div class="mt-30 pb-10">
						<div class="flex flex-col fs-14 simplegray-text">
							<strong class="fs-16 darkgray-text bold-text"><?= Yii::t('app', "Contactez-nous") ?></strong>
							<span class="mt-20 mb-10"><?= Yii::t('app', "Du lundi au vendredi : 8h30 à 23h00.") ?></span>
							<span class="mb-10"><?= Yii::t('app', "Samedi : 9h00 à 16h00.") ?></span>
							<span class="mb-10"><?= Yii::t('app', "Les jours fériés : de 10h30 à 15h30.") ?></span>
							<span><?= Yii::t('app', "Fuseau horaire") ?> GMT+4</span>
						</div>
					</div>
					<div class="flex mt-30 center-aligned-hor">
						<a href="#" class="ah-btn fs-15 border-rad-4 flex center-aligned-vert center-aligned-hor border-1 darkgray-text popup-close"><?= Yii::t('app', "Annuler") ?></a>
						<a href="tel:+2302043820" class="ah-btn fs-15 border-rad-4 flex center-aligned-vert center-aligned-hor darkgray-bg white-text ml-20 gtm-clic" data-event="call_us_popin_submit"><?= Yii::t('app', "Appeler") ?></a>
					</div>
				</div>
			</div>
		</div>
	</div>
